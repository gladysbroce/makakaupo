<?php
class Register extends System {
	public function __construct() {
		parent::__construct();
		$this->_users = new Users();
	}
	public function index()	{
		$this->setTemplate( 'View/Register/index.phtml' );
	}
	public function save() {
        
	}
	private function _checkUser($password, $db_password) {
	    return hash( 'sha256', $password ) === $db_password;
	}
}