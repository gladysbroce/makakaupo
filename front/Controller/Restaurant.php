<?php
class Restaurant extends System {
	public function __construct() {
		parent::__construct();
		$this->_restaurants = new Restaurants();
		$this->_seats = new Seats();
		$this->_logs = new Logs();
	}
	public function index($args = array()){
		$restaurantId = -1;
        if (!empty($args) && is_numeric($args[0])) {
			$restaurantId = intval($args[0]);
		}
		// Restaurant Info
		$this->restaurant = $this->_restaurants->getRestaurant($restaurantId);
		// Seats
		$floors = $this->_seats->getFloors($restaurantId);
		$this->floors = array();
		foreach ($floors as $floor) {
			$this->floors[$floor['floor_id']] = $this->_seats->getSeats($restaurantId, $floor['floor_id']);
		}
		if ($this->floors) {
		    $log = $this->_logs->getLastModified($restaurantId);
			$date = new DateTime($log['date_created']);
			$date->add(new DateInterval('PT8H'));
            $this->lastModified = $date->format('F j, Y g:i A');
		}
		$this->setTemplate( 'View/Restaurant/index.phtml' );
	}
}