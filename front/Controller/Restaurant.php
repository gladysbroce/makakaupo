<?php
class Restaurant extends System {
	public function __construct() {
	}
	
	public function index()	{
		$this->setTemplate( 'View/Restaurant/index.phtml' );
	}
}