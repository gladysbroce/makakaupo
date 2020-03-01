<?php
class Status extends System {
	public function __construct() {
	}
	
	public function index()	{
		$this->setTemplate( 'View/Status/index.phtml' );
	}
}