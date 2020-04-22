<?php
class Layout extends System {
	public function __construct() {
		parent::__construct();
		if (empty($_SESSION['restaurant_id'])) {
			header( "Location: " . $this->getSiteURL());
			die();
		}
		$this->_seats = new Seats();
	}
	public function index()	{
		$this->menu = "layout";
		$floors = $this->_seats->getFloors($_SESSION['restaurant_id']);
		$this->floors = array();
		foreach ($floors as $floor) {
			$this->floors[$floor['floor_id']] = $this->_seats->getSeats($_SESSION['restaurant_id'], $floor['floor_id']);
		}
		$this->setTemplate('View/Layout/index.phtml');
	}
	public function add() {
		$seats = isset($_POST["seats"]) ? $_POST["seats"] : "";
		if ($seats) {
		    foreach ($seats as $seat) {
		    	$this->_seats->addSeat($_SESSION['restaurant_id'], $seat["floor_id"], $seat["row_no"], $seat["col_no"]);
		    }
		}
	}
	public function delete() {
		$seats = isset($_POST["seats"]) ? $_POST["seats"] : "";
		if ($seats) {
		    foreach ($seats as $seat) {
		    	$this->_seats->deleteSeat($_SESSION['restaurant_id'], $seat["floor_id"], $seat["row_no"], $seat["col_no"]);
		    }
		}
	}
}