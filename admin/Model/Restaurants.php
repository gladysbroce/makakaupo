<?php
class Restaurants {
	public function getRestaurant($restaurantId) {
		$stmt = Application::DBPrepQuery( "
			SELECT 
				`restaurant_id`,
				`restaurant_name`,
				`branch_name`,
				`description`,
				`business_hours`,
				`address`,
				`website`,
				`phone_no`
			FROM `restaurant`
			WHERE `restaurant_id` = ?;
		");
		$stmt->bind_param("i", $restaurantId);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			return $row;
		}
		return false;
	}
	public function updateRestaurant($restaurantId, $restaurantName, $branchName, $desc, $hours, $address, $website, $phoneno){
		$response = false;
		if ($restaurantId) {
			$stmt = Application::DBPrepQuery( "
				UPDATE 
					`restaurant`
				SET `restaurant_name` = ?,
				    `branch_name` = ?,
					`description` = ?,
					`business_hours` = ?,
					`address` = ?,
					`website` = ?,
					`phone_no` = ?
				WHERE `restaurant_id` = ?;
		    ");
			$stmt->bind_param("sssssssi", $restaurantName, $branchName, $desc, $hours, $address, $website, $phoneno, $restaurantId);
			$result = $stmt->execute();
			if ($result) {
				$response = true;
			}
		}
		return $response;
	}
}