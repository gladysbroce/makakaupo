<?php
class Catalog extends System {
	public function __construct() {
		parent::__construct();
		$this->_restaurants = new Restaurants();
	}
	public function index(){
		$name      = isset($_GET["name"])     ? trim($_GET["name"]): "";
		$address   = isset($_GET["address"])  ? $_GET["address"]   : "";
		$longitude = isset($_GET["longitude"])? $_GET["longitude"] : "";
		$latitude  = isset($_GET["latitude"]) ? $_GET["latitude"]  : "";
		$page      = isset($_GET["page"])     ? $_GET["page"]      : 1;
		$sort      = "nearest";
		$this->name      = $name;
		$this->address   = $address;
		$this->longitude = $longitude;
		$this->latitude  = $latitude;
		$this->sort      = $sort;
		$this->restaurants = $this->_restaurants->getRestaurants($name, $longitude, $latitude, $sort, $page);
		if ($page == 1){
		    $this->setTemplate('View/Catalog/index.phtml');
		} else {
			$this->setTemplate('View/Catalog/restaurants.phtml', false);
		}
	}
	public function search(){
		$name      = isset($_GET["name"])     ? trim($_GET["name"]): "";
		$longitude = isset($_GET["longitude"])? $_GET["longitude"] : "";
		$latitude  = isset($_GET["latitude"]) ? $_GET["latitude"]  : "";
		$sort    = isset($_GET["sort"])    ? $_GET["sort"]          : "";
		$this->restaurants = $this->_restaurants->getRestaurants($name, $longitude, $latitude, $sort);
		$this->setTemplate('View/Catalog/restaurants.phtml', false);
	}
}