<?php
class User extends System {
	public function __construct() {
		parent::__construct();
		if (empty($_SESSION['restaurant_id'])) {
			header( "Location: " . $this->getSiteURL());
			die();
		}
		$this->_users = new Users();
	}
	public function index()	{
		$this->menu = "user";
		$this->setTemplate('View/User/index.phtml');
	}
	public function update() {
		$result = 0;
		$currentPassword = $this->_getCurrentPassword();
		$newPassword = $this->_getNewPassword();
		$confirmPassword = $this->_getConfirmPassword();
		if (!($this->_checkCurrentPassword($currentPassword))){
            $result = 1;  // Error: Incorrect Password
		} else {
			if ($newPassword != $confirmPassword) {
				$result = 2;  // Error: New and Confirm password does not match
			} else {
				$password = hash('sha256', $newPassword);
                $response = $this->_users->updatePassword($_SESSION['user_id'], $password);
                if (!$response) {
                	$result = 3;  // Error: Problem when updating the password
                }
			}
		}
		echo $result;
	}
	private function _checkCurrentPassword($password) {
		$result = true;
		$user = $this->_users->getUser($_SESSION['user_id']);
		if (hash('sha256', $password) !== $user['password']){
            $result = false;  // Error: Incorrect Password
		}
		return $result;
	}
	private function _getCurrentPassword() {
		if (!empty($_POST['current']) && $password = trim($_POST['current'])) {
			return $password;
		}
		return false;
	}
	private function _getNewPassword() {
		if (!empty($_POST['new']) && $password = trim($_POST['new'])) {
			return $password;
		}
		return false;
	}
	private function _getConfirmPassword() {
		if (!empty($_POST['confirm']) && $password = trim($_POST['confirm'])) {
			return $password;
		}
		return false;
	}
}