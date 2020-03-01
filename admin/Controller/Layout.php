<?php
class Layout extends System {
	public function __construct() {
	}
	
	public function index()	{
		$this->setTemplate('View/Layout/index.phtml');
	}
}