<?php
class Catalog extends System {
	public function __construct() {
	}
	
	public function index()	{
		$this->setTemplate( 'View/Restaurants/index.phtml' );
	}
}