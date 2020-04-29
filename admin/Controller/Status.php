<?php
class Status extends System {
	public function __construct() {
		parent::__construct();
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
		    $this->_seats = new Seats();
		    $this->_logs = new Logs();
	    } else {
			header( "Location: " . $this->getSiteURL());
			die();
		}
	}
	public function index()	{
		$this->menu = "status";
		$floors = $this->_seats->getFloors($_SESSION['restaurant_id']);
		$this->floors = array();
		foreach ($floors as $floor) {
			$this->floors[$floor['floor_id']] = $this->_seats->getSeats($_SESSION['restaurant_id'], $floor['floor_id']);
		}
		$this->setTemplate('View/Status/index.phtml');
	}
	public function update() {
		$seat = isset($_POST["seat"]) ? $_POST["seat"] : "";
		$status = isset($_POST["status"]) ? $_POST["status"] : 0;
		if ($seat) {
		    $response = $this->_seats->updateSeat($_SESSION['restaurant_id'], $seat["floor_id"], $seat["row_no"], $seat["col_no"], $status);
			if ($response) {
				$this->_logs->addLog($_SESSION['restaurant_id'], $seat["floor_id"], $seat["row_no"], $seat["col_no"], $status);
			}
		}
	}
	public function updateAll() {
		$floor_id = isset($_POST["floor_id"]) ? $_POST["floor_id"] : "";
		$status = isset($_POST["status"]) ? $_POST["status"] : 0;
		if ($floor_id) {
		    $response = $this->_seats->updateAllSeatsByFloor($_SESSION['restaurant_id'], $floor_id, $status);
			if ($response) {
				$seats = $this->_seats->getSeats($_SESSION['restaurant_id'], $floor_id);
				foreach ($seats as $seat) {
			        $this->_logs->addLog($_SESSION['restaurant_id'], $seat["floor_id"], $seat["row_no"], $seat["col_no"], $status);
		        }
			}
		}
	}
}