<?php
class Report extends System {
	public function __construct() {
		parent::__construct();
		if (empty($_SESSION['restaurant_id'])) {
			header( "Location: " . $this->getSiteURL());
			die();
		} 
		$this->_logs = new Logs();
	}
	public function index()	{
		$this->menu = "report";
		date_default_timezone_set('Asia/Manila');
		$today = date("Y-m-d");
		$start = $today." 00:00:00";
		$end   = $today." 23:59:59";
		$this->customerLogs = $this->_logs->getCustomersPerDay($_SESSION['restaurant_id'], $start, $end);
		$this->seatLogs = $this->_logs->getTopSeats($_SESSION['restaurant_id'], $start, $end);
		$this->setTemplate('View/Report/index.phtml');
	}
	public function getLogs() {
		$tbl       = isset($_POST["tbl"])   ? $_POST["tbl"]   : 1;
		$startDate = isset($_POST["start"]) ? $_POST["start"] : "";
		$endDate   = isset($_POST["end"])   ? $_POST["end"]   : "";
		$page = 1;
		if ($startDate && $endDate) {
		    $start = $startDate." 00:00:00";
		    $end   = $endDate." 23:59:59";
			if ($tbl == 1) {
		        $this->customerLogs = $this->_logs->getCustomersPerDay($_SESSION['restaurant_id'], $start, $end, $page);
			    $this->setTemplate('View/Report/customer.phtml', false);
			} else {
				$this->seatLogs = $this->_logs->getTopSeats($_SESSION['restaurant_id'], $start, $end, $page);
			    $this->setTemplate('View/Report/seat.phtml', false);
			}
		}
	}
	public function exportCSV() {
		$result = array();
		$tbl       = isset($_GET["tbl"])   ? $_GET["tbl"]   : 1;
		$startDate = isset($_GET["start"]) ? $_GET["start"] : "";
		$endDate   = isset($_GET["end"])   ? $_GET["end"]   : "";
		$page = 1;
		$filename = "";
		if ($startDate && $endDate) {
		    $start = $startDate." 00:00:00";
		    $end   = $endDate." 23:59:59";
			if ($tbl == 1) {
		        $result = $this->_logs->getCustomersPerDay($_SESSION['restaurant_id'], $start, $end, $page);
				$filename = "Customer_Logs";
			} else {
				$result = $this->_logs->getTopSeats($_SESSION['restaurant_id'], $start, $end, $page);
				$filename = "Seat_Logs";
			}
		}
		$this->_downloadSendHeaders($filename."_".date("Y-m-d").".csv");
        echo $this->_array2csv($result);
		die();
	}
	private function _array2csv(array &$array){
       if (count($array) == 0) {
         return null;
       }
       ob_start();
       $df = fopen("php://output", 'w');
       fputcsv($df, array_keys(reset($array)));
       foreach ($array as $row) {
          fputcsv($df, $row);
       }
       fclose($df);
       return ob_get_clean();
    }
    private function _downloadSendHeaders($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");
    
        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
    
        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }
	public function exportPDF() {
		$header = array();
		$result = array();
		$tbl       = isset($_GET["tbl"])   ? $_GET["tbl"]   : 1;
		$startDate = isset($_GET["start"]) ? $_GET["start"] : "";
		$endDate   = isset($_GET["end"])   ? $_GET["end"]   : "";
		$page = 1;
		$table = "";
		if ($startDate && $endDate) {
		    $start = $startDate." 00:00:00";
		    $end   = $endDate." 23:59:59";
			if ($tbl == 1) {
				$header = array("Date", "No. of Customers");
		        $result = $this->_logs->getCustomersPerDay($_SESSION['restaurant_id'], $start, $end, $page);
				$table = "Customer Logs";
			} else {
				$header = array("Row", "Column", "No. of Customers");
				$result = $this->_logs->getTopSeats($_SESSION['restaurant_id'], $start, $end, $page);
				$table = "Top Seats";
			}
		}
        require('fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
		// Table Name
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(40, 10, $table);
		$pdf->Ln();
		// Header
        $pdf->SetFillColor(136, 187, 228);
		$pdf->Cell(20, 12, "No", 1, 0, 'C', 1);
        foreach ($header as $heading) {
        	$pdf->Cell(50, 12, $heading, 1, 0, 'C', 1);
        }
		// Data
		$pdf->SetFillColor(255, 255, 255);
		$pdf->SetFont('Arial', '', 12);
        foreach ($result as $index => $row ) {
        	$pdf->Ln();
			$pdf->Cell(20, 12, $index+1, 1, 0, 'C', 1);
        	foreach($row as $column)
        		$pdf->Cell(50, 12, $column, 1, 0, 'C', 1);
        }
        $pdf->Output();
	}
}