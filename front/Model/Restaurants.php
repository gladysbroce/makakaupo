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
}