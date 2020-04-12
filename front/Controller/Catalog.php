<?php
class Catalog extends System {
	public function __construct() {
		parent::__construct();
		$this->_restaurants = new Restaurants();
	}
	public function index(){
		$name    = isset($_GET["name"])    ? trim($_GET["name"])    : "";
		$address = isset($_GET["address"]) ? trim($_GET["address"]) : "";
		$sort    = "total";
		$this->name = $name;
		$this->address = $address;
		$this->sort = $sort;
		$this->restaurants = $this->_restaurants->getRestaurants($name, $address, $sort);
		$this->setTemplate('View/Catalog/index.phtml');
	}
	public function search(){
		$name    = isset($_GET["name"])    ? trim($_GET["name"])    : "";
		$address = isset($_GET["address"]) ? trim($_GET["address"]) : "";
		$sort    = isset($_GET["sort"])    ? $_GET["sort"]          : "";
		$this->restaurants = $this->_restaurants->getRestaurants($name, $address, $sort);
		$this->setTemplate('View/Catalog/search.phtml', false);
	}
}