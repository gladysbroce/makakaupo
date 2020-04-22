<?php
class Logout extends System {
	public function __construct() {
		parent::__construct();
	}
	public function index() {
		if (!empty($_SESSION['username'])){
			session_unset();
			session_destroy();
		} 
		header('Location: ' . $this->getSiteURL());
        return false;
	}
}