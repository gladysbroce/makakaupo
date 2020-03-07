<?php

class Seats {
	public function getSeats($restaurant_id, $floor_id) {
		$seats = array();
		$stmt = Application::DBPrepQuery( "
			SELECT 
				`seat`.`row_no`,
				`seat`.`col_no`,
				`seat_status`.`seat_status_name`
			FROM `seat`
			INNER JOIN `seat_status`
			 	ON `seat_status`.`seat_status_id` = `seat`.`status_id`
			WHERE `seat`.`restaurant_id` = ? AND `seat`.`floor_id` = ?;
		");
		$stmt->bind_param("ii", $restaurant_id, $floor_id);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$seats[] = $row;
		}
		return $seats;
	}
	public function getFloors($restaurant_id) {
		$floors = array();
		$stmt = Application::DBPrepQuery( "
			SELECT DISTINCT
				`floor_id`
			FROM `seat`
			WHERE `restaurant_id` = ?;
		");
		$stmt->bind_param("i", $restaurant_id);
		$stmt->execute();
		$floors = $stmt->get_result();
		return $floors;
		/*$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$floors[] = $row;
		}
		return $floors;*/
	}
	public function addSeat($restaurant_id, $floor_id, $row_no, $col_no){
		$response = false;
		if ($restaurant_id && $floor_id && $row_no && $col_no) {
			$stmt = Application::DBPrepQuery( "
			    INSERT INTO 
			    	`seat`(`restaurant_id`, `floor_id`, `row_no`, `col_no`, `status_id`)
			    VALUES (?, ?, ?, ?, 0);
		    ");
			$stmt->bind_param("iiii", $restaurant_id, $floor_id, $row_no, $col_no);
			$result = $stmt->execute();
			if($result){
				$response = true;
			}
		}
		return $response;
	}
	public function deleteSeat($restaurant_id, $floor_id, $row_no, $col_no){
		$response = false;
		if ($restaurant_id && $floor_id && $row_no && $col_no) {
			$stmt = Application::DBPrepQuery( "
			    DELETE
				FROM `seat`
				WHERE `restaurant_id` = ? AND `floor_id` = ? AND `row_no` = ? AND `col_no` = ?;
		    ");
			$stmt->bind_param("iiii", $restaurant_id, $floor_id, $row_no, $col_no);
			$result = $stmt->execute();
			if($result){
				$response = true;
			}
		}
		return $response;
	}
}