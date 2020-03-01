<?php
class Home extends System {
	public function __construct() {
		//$this->_users = new Users();
		//$this->_products = new Products();
	}
	
	public function index()	{
		//$this->featProducts = $this->_products->getFeaturedProducts();
        //$this->products = $this->_products->getProductsForHome();
		$this->setTemplate( 'View/Home/index.phtml' );
	}
}