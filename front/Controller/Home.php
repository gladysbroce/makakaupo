<?php
class Home extends System {
	public function __construct() {
		parent::__construct();
		$this->_restaurants = new Restaurants();
	}
	public function index()	{
		$this->restaurants = $this->_restaurants->getNewRestaurants(3);
		$this->setTemplate( 'View/Home/index.phtml' );
	}
}