<?php

class Seats {
	public function getSeats($restaurant_id) {
		$seats = array();
		$stmt = Application::DBQuery( "
			SELECT 
				*,
			FROM `seat`
			WHERE `restaurant_id` = ?;
		");
		$stmt->bind_param("i", $restaurant_id);
		$stmt->execute();
		$result = $stmt->get_result();
		while( $row = $result->fetch_assoc() ) {
			$seats[] = $row;
		}
		return $seats;
	}
	public function updateSeats($restaurant_id){
		$response = false;
		if($restaurant_id){
			$stmt = Application::DBPrepQuery( "
			UPDATE 
				`seat`
			SET `row_no` = 5
			WHERE `restaurant_id` = ?;
		    ");
			$stmt->bind_param("i", $restaurant_id);
			$result = $stmt->execute();
			if($result){
				$response = true;
			}
		}
		return $response;
	}
}