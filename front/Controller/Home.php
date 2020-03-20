<?php
class Home extends System {
	public function __construct() {
		parent::__construct();
		$this->_restaurants = new Restaurants();
	}
	public function index()	{
		$this->newRestaurants = $this->_restaurants->getRestaurants('date_created', 'DESC', 3);
		$this->setTemplate( 'View/Home/index.phtml' );
	}
	
}