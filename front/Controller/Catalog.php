<?php
class Catalog extends System {
	public function __construct() {
		parent::__construct();
		$this->_restaurants = new Restaurants();
	}
	public function index(){
		$filter = isset($_GET["filter"]) ? $_GET["filter"] : "";
		$sort = isset($_GET["sort"]) ? $_GET["sort"] : "";
		$this->filter = $filter;
		$this->restaurants = $this->_restaurants->getRestaurants($filter, $sort);
		$this->setTemplate( 'View/Catalog/index.phtml' );
	}
}