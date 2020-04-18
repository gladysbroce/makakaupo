<?php
class Seats {
	public function getSeats($restaurantId, $floorId = "") {
		$seats = array();
		$stmt = Application::DBPrepQuery( "
			SELECT
				`seat`.`floor_id`,
				`seat`.`row_no`,
				`seat`.`col_no`,
				`seat_status`.`seat_status_name`
			FROM `seat`
			INNER JOIN `seat_status`
			 	ON `seat_status`.`seat_status_id` = `seat`.`status_id`
			WHERE `seat`.`restaurant_id` = ? AND `seat`.`floor_id` = ?;
		");
		$stmt->bind_param("ii", $restaurantId, $floorId);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$seats[] = $row;
		}
		return $seats;
	}
	public function getFloors($restaurantId) {
		$floors = array();
		$stmt = Application::DBPrepQuery( "
			SELECT DISTINCT
				`floor_id`
			FROM `seat`
			WHERE `restaurant_id` = ?
			ORDER BY `floor_id` ASC;
		");
		$stmt->bind_param("i", $restaurantId);
		$stmt->execute();
		$floors = $stmt->get_result();
		return $floors;
	}
	public function addSeat($restaurantId, $floorId, $rowNo, $colNo){
		$response = false;
		if ($restaurantId && $floorId && $rowNo && $colNo) {
			$stmt = Application::DBPrepQuery( "
			    INSERT INTO 
			    	`seat`(`restaurant_id`, `floor_id`, `row_no`, `col_no`, `status_id`)
			    VALUES (?, ?, ?, ?, 0);
		    ");
			$stmt->bind_param("iiii", $restaurantId, $floorId, $rowNo, $colNo);
			$result = $stmt->execute();
			if ($result) {
				$response = true;
			}
		}
		return $response;
	}
	public function deleteSeat($restaurantId, $floorId, $rowNo, $colNo){
		$response = false;
		if ($restaurantId && $floorId && $rowNo && $colNo) {
			$stmt = Application::DBPrepQuery( "
			    DELETE
				FROM `seat`
				WHERE `restaurant_id` = ? AND `floor_id` = ? AND `row_no` = ? AND `col_no` = ?;
		    ");
			$stmt->bind_param("iiii", $restaurantId, $floorId, $rowNo, $colNo);
			$result = $stmt->execute();
			if ($result) {
				$response = true;
			}
		}
		return $response;
	}
	public function updateSeat($restaurantId, $floorId, $rowNo, $colNo, $status){
		$response = false;
		if ($restaurantId && $floorId && $rowNo && $colNo) {
			$stmt = Application::DBPrepQuery( "
				UPDATE 
					`seat`
				SET `status_id` = ?
				WHERE `restaurant_id` = ? AND `floor_id` = ? AND `row_no` = ? AND `col_no` = ?;
		    ");
			$stmt->bind_param("iiiii", $status, $restaurantId, $floorId, $rowNo, $colNo);
			$result = $stmt->execute();
			if ($result) {
				$response = true;
			}
		}
		return $response;
	}
	public function updateAllSeatsByFloor($restaurantId, $floorId, $status){
		$response = false;
		if ($restaurantId && $floorId) {
			$stmt = Application::DBPrepQuery( "
				UPDATE 
					`seat`
				SET `status_id` = ?
				WHERE `restaurant_id` = ? AND `floor_id` = ?;
		    ");
			$stmt->bind_param("iii", $status, $restaurantId, $floorId);
			$result = $stmt->execute();
			if ($result) {
				$response = true;
			}
		}
		return $response;
	}
}