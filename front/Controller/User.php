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
				$_SESSION['username'] = $user['username'];
				$_SESSION['restaurant_id'] = $user['restaurant_id'];
			} else {
				$result = 1;
			}
		} else {
			$result = 2;
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
		$username  = $_POST['username'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$email     = $_POST['email'];
		if (!empty($username) && !empty($password1) && !empty($password2) && !empty($email)) {
			if (!($this->_checkRegPassword($password1, $password2))) {
				$result = 1;
			} else {
				$user_id = $this->_users->addUser($username, hash('sha256', $password1), $email);
				$restaurant = $this->_restaurants->addRestaurant($user_id);
		        if (!$restaurant) {
					$result = 2;
				}
			}
		} else {
			$result = 3;
		}
		echo $result;
	}
	private function _checkRegPassword($password1, $password2) {
		return ($password1 === $password2) ? true : false;
	}
	private function _checkUser($password, $db_password) {
	    return hash('sha256', $password) === $db_password;
	}
}