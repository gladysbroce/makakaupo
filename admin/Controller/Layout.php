<?php
class Layout extends System {
	public function __construct() {
		$this->_seats = new Seats();
	}
	public function index()	{
		$restaurant_id = 1;
		$floors = $this->_seats->getFloors($restaurant_id);
		foreach ($floors as $floor) {
			$this->floors[$floor['floor_id']] = $this->_seats->getSeats($restaurant_id, $floor['floor_id']);
		}
		$this->setTemplate('View/Layout/index.phtml');
	}
	public function add() {
		$restaurant_id = isset($_POST["restaurant_id"]) ? $_POST["restaurant_id"] : "";
		$seats = isset($_POST["seats"]) ? $_POST["seats"] : "";
		if ($restaurant_id && $seats) {
		    foreach ($seats as $seat) {
		    	$this->_seats->addSeat($restaurant_id, $seat["floor_id"], $seat["row_no"], $seat["col_no"]);
		    }
		}
	}
	public function delete() {
		$restaurant_id = isset($_POST["restaurant_id"]) ? $_POST["restaurant_id"] : "";
		$seats = isset($_POST["seats"]) ? $_POST["seats"] : "";
		if ($restaurant_id && $seats) {
		    foreach ($seats as $seat) {
		    	$this->_seats->deleteSeat($restaurant_id, $seat["floor_id"], $seat["row_no"], $seat["col_no"]);
		    }
		}
	}
}