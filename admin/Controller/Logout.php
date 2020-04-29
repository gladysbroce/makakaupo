<?php
class Logout extends System {
	public function __construct() {
		parent::__construct();
	}
	public function index() {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			session_unset();
			session_destroy();
		} 
		header('Location: ' . $this->getSiteURL());
        return false;
	}
}