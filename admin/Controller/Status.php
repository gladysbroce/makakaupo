<?php
class Status extends System {
	public function __construct() {
		$this->_seats = new Seats();
	}
	public function index()	{
		$restaurant_id = 1;
		$floors = $this->_seats->getFloors($restaurant_id);
		foreach ($floors as $floor) {
			$this->floors[$floor['floor_id']] = $this->_seats->getSeats($restaurant_id, $floor['floor_id']);
		}
		$this->setTemplate('View/Status/index.phtml');
	}
}