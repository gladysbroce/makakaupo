<?php
class Restaurants {
	public function getRestaurant($restaurantId) {
		$stmt = Application::DBPrepQuery( "
			SELECT 
				`restaurant`.`restaurant_id`,
				`restaurant`.`restaurant_name`,
				`restaurant`.`branch_name`,
				`restaurant`.`short_desc`,
				`restaurant`.`full_desc`,
				`restaurant`.`business_hours`,
				`restaurant`.`address`,
				`restaurant`.`website`,
				`restaurant`.`phone_no`,
				`restaurant`.`image`
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
	public function getNewRestaurants($sort = 'last_modified', $order = 'DESC', $limit = '3') {
		$restaurants = array();
		$result = Application::DBQuery( "
			SELECT 
				`restaurant`.*
			FROM `restaurant`
			ORDER BY `restaurant`.`$sort` $order
			LIMIT $limit;
		");
		while ($row = $result->fetch_assoc()) {
			$restaurants[] = $row;
		}
		return $restaurants;
	}
	public function getRestaurants($name = '', $longitude, $latitude, $sort = '') {
		$restaurants = array();
		$name = '%'.$name.'%';
		$limit = 12;
		$filterVacant = ($sort == "vacant") ? " AND `s`.`status_id` = 0" : "";
		$orderByCount = ($sort != "nearest") ? "`count` DESC," : "";
		$stmt = Application::DBPrepQuery( "
			SELECT 
				`r`.*,
				`s`.*,
				count(`s`.`seat_id`) AS `count`,
				( ACOS( COS( RADIANS(?)) 
                    * COS( RADIANS(`r`.`latitude`))
                    * COS( RADIANS(`r`.`longitude`) - RADIANS(?))
                    + SIN( RADIANS(?))
                    * SIN( RADIANS(`r`.`latitude`))
                    ) * 6371
				) AS distance_in_km
			FROM `restaurant` `r`
			LEFT JOIN `seat` `s` on `s`.`restaurant_id` = `r`.`restaurant_id`
			WHERE (`r`.`restaurant_name` LIKE ?)
				  $filterVacant
		    GROUP BY `r`.`restaurant_id`
			ORDER BY 
			    $orderByCount
				distance_in_km ASC
			LIMIT 0, $limit;
		");
		$stmt->bind_param("ssss", $latitude, $longitude, $latitude, $name);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$restaurants[] = $row;
		}
		return $restaurants;
	}
}