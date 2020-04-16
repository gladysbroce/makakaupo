<?php
class Report extends System {
	public function __construct() {
		parent::__construct();
		$this->_logs = new Logs();
	}
	public function index()	{
		$this->menu = "report";
		$restaurant_id = 1;
		$today = date("Y-m-d");
		$start = $today." 00:00:00";
		$end   = $today." 23:59:59";
		$this->customerLogs = $this->_logs->getCustomersPerDay($restaurant_id, $start, $end);
		$this->setTemplate('View/Report/index.phtml');
	}
	
	public function getCustomerLogs()	{
		$restaurant_id = 1;
		$today = date("Y-m-d");
		$startDate = isset($_POST["start"]) ? $_POST["start"] : "";
		$endDate   = isset($_POST["end"])   ? $_POST["end"]   : "";
		if ($startDate && $endDate) {
		    $start = $startDate." 00:00:00";
		    $end   = $endDate." 23:59:59";
		    $this->customerLogs = $this->_logs->getCustomersPerDay($restaurant_id, $start, $end);
			$this->setTemplate('View/Report/customer.phtml', false);
		}
	}
}