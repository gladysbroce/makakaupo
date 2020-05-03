<?php
class User extends System {
	public function __construct() {
		parent::__construct();
		$this->_users = new Users();
		$this->_restaurants = new Restaurants();
	}
	public function checkLogin() {
		$result   = 0;
		$username = $_POST['username'];
		$password = $_POST['password'];
		if (!empty($username) && !empty($password)) {
			$user = $this->_users->getUser($username);
			if ($user && $this->_checkLoginPassword($password, $user['password'])) {
				if ($user['is_verified'] == 0){
					$result = -1;
				}
				$_SESSION['loggedin'] = true;
				$_SESSION['user_id'] = $user['user_id'];
				$_SESSION['username'] = $user['username'];
				$_SESSION['restaurant_id'] = $user['restaurant_id'];
				$_SESSION["is_verified"] = $user['is_verified'];
			} else {
				$result = "Incorrect username or password.";
			}
		} else {
			$result = "Please enter both username and password.";
		}
		echo $result;
	}
	private function _checkLoginPassword($password, $db_password) {
	    return hash('sha256', $password) === $db_password;
	}
	public function register() {
		$this->setTemplate( 'View/User/index.phtml' );
	}
	public function add() {
		$result    = 0;
		$username  = trim($_POST['username']);
		$password1 = trim($_POST['password1']);
		$password2 = trim($_POST['password2']);
		$email     = trim($_POST['email']);
		if (empty($username) || empty($password1) || empty($password2) || empty($email)) {
			$result = 1;  // Error: Incomplete input 
		} else {
            if (!($this->_checkRegUsername($username))){
            	$result = 2;  // Error: Invalid Username
            } else {
				if (!($this->_checkRegPassword($password1, $password2))) {
					$result = 3;  // Error: Invalid Password
				} else {
					$token = $this->_generateToken();
					$userId = $this->_users->addUser($username, hash('sha256', $password1), $email, $token);
					$restaurant = $this->_restaurants->addRestaurant($userId);
			        if (!$restaurant) {
						$result = 4;  // Error: Problem when adding to DB
					} else {
						$result = $this->_sendEmail($username, $email, $token);
						if ($result != 0){
							$result = 5;  // Error: Problem when sending email
						}
					}
				}
		    }
		}
		echo $result;
	}
	private function _checkRegUsername($username) {
	    $user = $this->_users->getUser($username);
	    $result = (!$user) ? true : false;
		return $result;
	}
	private function _checkRegPassword($password1, $password2) {
		return ($password1 === $password2) ? true : false;
	}
	private function _generateToken() {
		$token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);
        return $token;
	}
    private function _sendEmail($username, $recipientEmail, $token) {
    	$result = 0;
    	$url = "https://makakaupo.ga/user/verify?t=".$token."&user=".$username;
        $link = '<a href="'.$url.'">'.$url.'</a>';
		require("sendgrid-php/sendgrid-php.php");
		$email = new \SendGrid\Mail\Mail(); 
		$email->setFrom("noreply@makakaupo.ga", "Makakaupo");
		$email->setSubject("Registration Verification");
		$email->addTo($recipientEmail, $username);
		$email->addContent(
		    "text/html", 
		    "Hello ".$username.",<br/><br/>".
		    "Welcome to Makakaupo!<br/><br/>".
		    "Please click the link below to complete your account registration.<br/>".
            $link."<br/><br/>".
		    "Regards,<br/>".
		    "Makakaupo Support Team"
		);
		$sendgrid = new \SendGrid('');
		try {
		    $response = $sendgrid->send($email);
		} catch (Exception $e) {
		    $result = 1;  // Error: Problem when sending email
		}
		return $result;
    }
    public function verify() {
    	$username = isset($_GET["user"]) ? trim($_GET["user"]): "";
        $token    = isset($_GET["t"])    ? trim($_GET["t"])   : "";
        $response = $this->_users->verifyUser($username, $token);
        if ($response) {
        	$this->verifyMsg = "Your account has been successfully verified.";
        } else {
            $this->verifyMsg = "Your account verification has failed.";
        }
        $this->restaurants = $this->_restaurants->getNewRestaurants('last_modified', 'DESC', 3);
        $this->setTemplate('View/Home/index.phtml');
    }
}