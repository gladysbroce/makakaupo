<?php
class Restaurants {
	public function getRestaurant($restaurantId) {
		$stmt = Application::DBPrepQuery( "
			SELECT 
				`restaurant_id`,
				`restaurant_name`,
				`branch_name`,
				`short_desc`,
                `full_desc`,
				`business_hours`,
				`address`,
				`latitude`,
				`longitude`,
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
	public function updateRestaurant($restaurantId, $restaurantName, $branchName, $shortDesc, $longDesc, $hours, $address, $longitude, $latitude, $website, $phoneno, $image){
		$response = false;
		if ($restaurantId) {
			$stmt = Application::DBPrepQuery( "
				UPDATE 
					`restaurant`
				SET `restaurant_name` = ?,
				    `branch_name` = ?,
					`short_desc` = ?,
					`full_desc` = ?,
					`business_hours` = ?,
					`address` = ?,
					`longitude` = ?,
					`latitude` = ?,
					`website` = ?,
					`phone_no` = ?,
					`image` = ?
				WHERE `restaurant_id` = ?;
		    ");
			$stmt->bind_param("ssssssddsssi", $restaurantName, $branchName, $shortDesc, $longDesc, $hours, $address, $longitude, $latitude, $website, $phoneno, $image, $restaurantId);
			$result = $stmt->execute();
			if ($result) {
				$response = true;
			}
		}
		return $response;
	}
}