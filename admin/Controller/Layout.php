<?php
class Layout extends System {
	public function __construct() {
		parent::__construct();
		$this->_seats = new Seats();
	}
	
	public function index()	{
		$this->setTemplate('View/Layout/index.phtml');
	}
	
	public function update($args = array()) {
		//header('Content-Type: application/json; charset=utf-8');
		$restaurant_id = 1;
		$this->_seats->updateSeats($restaurant_id);
	}
}