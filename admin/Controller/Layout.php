<?php
class Layout extends System {
	public function __construct() {
		parent::__construct();
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
		    $this->_seats = new Seats();
	    } else {
			header( "Location: " . $this->getSiteURL());
			die();
		}
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
	public function update() {
		$added_seats   = isset($_POST["added_seats"])   ? $_POST["added_seats"]   : "";
		$deleted_seats = isset($_POST["deleted_seats"]) ? $_POST["deleted_seats"] : "";
		if ($added_seats) {
		    foreach ($added_seats as $seat) {
		    	$this->_seats->addSeat($_SESSION['restaurant_id'], $seat["floor_id"], $seat["row_no"], $seat["col_no"]);
		    }
		}
		if ($deleted_seats) {
		    foreach ($deleted_seats as $seat) {
		    	$this->_seats->deleteSeat($_SESSION['restaurant_id'], $seat["floor_id"], $seat["row_no"], $seat["col_no"]);
		    }
		}
	}
}