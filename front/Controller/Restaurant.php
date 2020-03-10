<?php
class Restaurant extends System {
	public function __construct() {
		parent::__construct();
		$this->_restaurants = new Restaurants();
		$this->_seats = new Seats();
	}
	public function index($restaurantId){
		$restaurantId = 1;
		// Restaurant Info
		$this->restaurant = $this->_restaurants->getRestaurant($restaurantId);
		// Seats
		$floors = $this->_seats->getFloors($restaurantId);
		$this->floors = array();
		foreach ($floors as $floor) {
			$this->floors[$floor['floor_id']] = $this->_seats->getSeats($restaurantId, $floor['floor_id']);
		}
		$this->setTemplate( 'View/Restaurant/index.phtml' );
	}
}