<?php
class Profile extends System {
	public function __construct() {
		parent::__construct();
		$this->_restaurants = new Restaurants();
	}
	public function index()	{
		$restaurantId = 1;
		$this->restaurant = $this->_restaurants->getRestaurant($restaurantId);
		$this->setTemplate('View/Profile/index.phtml');
	}
	public function update() {
		$restaurantId = 1;
		$restaurantName = $this->_getRestaurantName();
		$branchName = $this->_getBranchName();
		$shortDesc = $this->_getShortDesc();
		$fullDesc = $this->_getFullDesc();
		$hours = $this->_getBusinessHours();
		$address = $this->_getAddress();
		$website = $this->_getWebsite();
		$phoneno = $this->_getPhoneNo();
		$this->restaurant = $this->_restaurants->updateRestaurant($restaurantId, $restaurantName, $branchName, $shortDesc, $fullDesc, $hours, $address, $website, $phoneno);
	}
	private function _getRestaurantName() {
		if (!empty($_POST['name']) && $name = trim($_POST['name'])) {
			return $name;
		}
		return false;
	}
	private function _getBranchName() {
		if (!empty($_POST['branch']) && $branch = trim($_POST['branch'])) {
			return $branch;
		}
		return false;
	}
	private function _getShortDesc() {
		if (!empty($_POST['shortDesc']) && $desc = trim($_POST['shortDesc'])) {
			return $desc;
		}
		return false;
	}
	private function _getFullDesc() {
		if (!empty($_POST['fullDesc']) && $desc = trim($_POST['fullDesc'])) {
			return $desc;
		}
		return false;
	}
	private function _getBusinessHours() {
		if (!empty($_POST['hours']) && $hours = trim($_POST['hours'])) {
			return $hours;
		}
		return false;
	}
	private function _getAddress() {
		if (!empty($_POST['address']) && $address = trim($_POST['address'])) {
			return $address;
		}
		return false;
	}
	private function _getWebsite() {
		if (!empty($_POST['website']) && $website = trim($_POST['website'])) {
			return $website;
		}
		return false;
	}
	private function _getPhoneNo() {
		if (!empty($_POST['phoneno']) && $phoneno = trim($_POST['phoneno'])) {
			return $phoneno;
		}
		return false;
	}
}