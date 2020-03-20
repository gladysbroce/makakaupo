<?php
class Catalog extends System {
	public function __construct() {
		parent::__construct();
		$this->_restaurants = new Restaurants();
	}
	public function index()	{
		$this->restaurants = $this->_restaurants->getRestaurants('date_created', 'DESC', 12);
		$this->setTemplate( 'View/Catalog/index.phtml' );
	}
}