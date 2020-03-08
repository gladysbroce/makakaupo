<?php
class Status extends System {
	public function __construct() {
		$this->_seats = new Seats();
	}
	public function index()	{
		$restaurant_id = 1;
		$floors = $this->_seats->getFloors($restaurant_id);
		$this->floors = array();
		foreach ($floors as $floor) {
			$this->floors[$floor['floor_id']] = $this->_seats->getSeats($restaurant_id, $floor['floor_id']);
		}
		$this->setTemplate('View/Status/index.phtml');
	}
	public function update() {
		$restaurant_id = isset($_POST["restaurant_id"]) ? $_POST["restaurant_id"] : "";
		$seat = isset($_POST["seat"]) ? $_POST["seat"] : "";
		$status = isset($_POST["status"]) ? $_POST["status"] : 0;
		if ($restaurant_id && $seat) {
		    $this->_seats->updateSeat($restaurant_id, $seat["floor_id"], $seat["row_no"], $seat["col_no"], $status);
		}
	}
	public function updateAll() {
		$restaurant_id = isset($_POST["restaurant_id"]) ? $_POST["restaurant_id"] : "";
		$floor_id = isset($_POST["floor_id"]) ? $_POST["floor_id"] : "";
		$status = isset($_POST["status"]) ? $_POST["status"] : 0;
		if ($restaurant_id && $floor_id) {
		    $this->_seats->updateAllSeatsByFloor($restaurant_id, $floor_id, $status);
		}
	}
}