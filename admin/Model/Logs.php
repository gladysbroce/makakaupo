<?php
class Logs {
	const LIMIT = 10;
	
	public function addLog($restaurantId, $floorId, $rowNo, $colNo, $status) {
		$response = false;
		if ($restaurantId && $floorId && $rowNo && $colNo && ($status >= 0 && $status <=3)) {
			$stmt = Application::DBPrepQuery( "
			    INSERT INTO 
			    	`seat_log`(`restaurant_id`, `floor_id`, `row_no`, `col_no`, `status_id`)
			    VALUES (?, ?, ?, ?, ?);
		    ");
			$stmt->bind_param("iiiii", $restaurantId, $floorId, $rowNo, $colNo, $status);
			$result = $stmt->execute();
			if ($result) {
				$response = true;
			}
		}
		return $response;
	}
	public function getCustomersPerDay($restaurantId, $start, $end, $page = 1) {
		$logs = array();
		$limit = self::LIMIT;
		$page = ($page - 1) * $limit;
		$stmt = Application::DBPrepQuery( "
			SELECT
			    DATE(`l`.`date_created`) AS `date`,
				COUNT(*) AS `count`
            FROM `seat_log` `l`
			WHERE
			    `l`.`restaurant_id` = ? AND 
				`l`.`status_id` = 1 AND
				(`l`.`date_created` >= ? AND `l`.`date_created` <= ?)
            GROUP BY 
			    DAY(`l`.`date_created`)
		    ORDER BY
			    `date` DESC
			LIMIT $page, $limit;
		");
		$stmt->bind_param("iss", $restaurantId, $start, $end);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$logs[] = $row;
		}
		return $logs;
	}
	public function getTopSeats($restaurantId, $start, $end, $page = 1) {
		$logs = array();
		$limit = self::LIMIT;
		$page = ($page - 1) * $limit;
		$stmt = Application::DBPrepQuery( "
			SELECT
			    `l`.`row_no`,
				`l`.`col_no`,
				COUNT(*) AS `count`
            FROM `seat_log` `l`
			WHERE
			    `l`.`restaurant_id` = ? AND 
				`l`.`status_id` = 1 AND
				(`l`.`date_created` >= ? AND `l`.`date_created` <= ?)
            GROUP BY 
			    `l`.`row_no`,
				`l`.`col_no`
		    ORDER BY
			    `count` DESC
			LIMIT $page, $limit;
		");
		$stmt->bind_param("iss", $restaurantId, $start, $end);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$logs[] = $row;
		}
		return $logs;
	}
}