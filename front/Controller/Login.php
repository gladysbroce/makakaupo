<?php
class Login extends System {
	public function __construct() {
		parent::__construct();
		$this->_users = new Users();
	}
	public function check()	{
		$result = "";
		if (!empty($_POST['username']) && !empty($_POST['password'])) {
			$user = $this->_users->getUser($_POST['username']);
			if($user && $this->_checkPassword($_POST['password'], $user['password'])){
				$_SESSION['username'] = $user['username'];
				$result = "ok";
			}
		}
		echo $result;
	}
	private function _checkPassword($password, $db_password) {
	    return hash( 'sha256', $password ) === $db_password;
	}
}