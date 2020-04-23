<?php
class Profile extends System {
	public function __construct() {
		parent::__construct();
		$this->_restaurants = new Restaurants();
	}
	public function index()	{
		$this->menu = "profile";
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
		$longitude = $this->_getLongitude();
		$latitude = $this->_getLatitude();
		$website = $this->_getWebsite();
		$phoneno = $this->_getPhoneNo();
		$image = "";
		if(!empty( $_FILES['image']['name'])){
			$dirname = $this->getImagesPath().'restaurants';
			$sourceFile = !empty( $_FILES['image']['tmp_name'] ) ? $_FILES['image']['tmp_name'] : $_FILES['image']['name'];
			$extension  = pathinfo( $_FILES["image"]["name"], PATHINFO_EXTENSION );
			$targetFile =  $dirname.'/'.$restaurantId.'.'.$extension;
			move_uploaded_file( $sourceFile, $targetFile );
			$this->compress($targetFile, $targetFile, 75);
			$image = $restaurantId.'.'.$extension;
		}
		$this->restaurant = $this->_restaurants->updateRestaurant($restaurantId, $restaurantName, $branchName, $shortDesc, $fullDesc, $hours, $address, $longitude, $latitude, $website, $phoneno, $image);
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
		if (!empty($_POST['shortDesc']) && $shortDesc = trim($_POST['shortDesc'])) {
			return $shortDesc;
		}
		return false;
	}
	private function _getFullDesc() {
		if (!empty($_POST['fullDesc']) && $fullDesc = trim($_POST['fullDesc'])) {
			return $fullDesc;
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
	private function _getLongitude() {
		if (!empty($_POST['longitude']) && $longitude = trim($_POST['longitude'])) {
			return $longitude;
		}
		return false;
	}
	private function _getLatitude() {
		if (!empty($_POST['latitude']) && $latitude = trim($_POST['latitude'])) {
			return $latitude;
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