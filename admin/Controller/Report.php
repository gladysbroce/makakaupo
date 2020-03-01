<?php
class Report extends System {
	public function __construct() {
	}
	
	public function index()	{
		$this->setTemplate( 'View/Report/index.phtml' );
	}
}