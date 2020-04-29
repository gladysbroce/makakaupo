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
			WHERE
			    `restaurant_name` IS NOT NULL AND 
				`restaurant_name` <> ''
			ORDER BY 
			    `restaurant`.`$sort` $order
			LIMIT $limit;
		");
		while ($row = $result->fetch_assoc()) {
			$restaurants[] = $row;
		}
		return $restaurants;
	}
	public function getRestaurants($name = '', $longitude, $latitude, $sort = '', $page = 1) {
		$restaurants = array();
		$name = '%'.$name.'%';
		$limit = 12;
		$page = ($page - 1) * $limit;
		$filterVacant = ($sort == "vacant") ? " AND `s`.`status_id` = 0" : "";
		$orderByCount = ($sort != "nearest") ? "`count` DESC," : "";
		$stmt = Application::DBPrepQuery( "
			SELECT 
				`r`.`restaurant_id`,
				`r`.`restaurant_name`,
				`r`.`address`,
				`r`.`image`,
				count(`s`.`seat_id`) AS `count`,
				( ACOS( COS( RADIANS(?)) 
                    * COS( RADIANS(`r`.`latitude`))
                    * COS( RADIANS(`r`.`longitude`) - RADIANS(?))
                    + SIN( RADIANS(?))
                    * SIN( RADIANS(`r`.`latitude`))
                    ) * 6371
				) AS distance_in_km
			FROM `restaurant` `r`
			LEFT JOIN 
			    `seat` `s` on `s`.`restaurant_id` = `r`.`restaurant_id`
			WHERE 
			    `r`.`restaurant_name` IS NOT NULL AND
				`r`.`restaurant_name` <> '' AND
			    `r`.`restaurant_name` LIKE ?
				$filterVacant
		    GROUP BY `r`.`restaurant_id`
			HAVING
			    distance_in_km < 50
			ORDER BY 
			    $orderByCount
				distance_in_km ASC
			LIMIT $page, $limit;
		");
		$stmt->bind_param("ssss", $latitude, $longitude, $latitude, $name);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$restaurants[] = $row;
		}
		return $restaurants;
	}
	public function getTotalRestaurants($name = '', $longitude, $latitude, $sort = '') {
		$countTotal = 0;
		$name = '%'.$name.'%';
		$filterVacant = ($sort == "vacant") ? " AND `s`.`status_id` = 0" : "";
		$stmt = Application::DBPrepQuery( "
		    SELECT
			    count(*) AS count
			FROM
			    (SELECT 
			    	( ACOS( COS( RADIANS(?)) 
                        * COS( RADIANS(`r`.`latitude`))
                        * COS( RADIANS(`r`.`longitude`) - RADIANS(?))
                        + SIN( RADIANS(?))
                        * SIN( RADIANS(`r`.`latitude`))
                        ) * 6371
			    	) AS distance_in_km
			    FROM `restaurant` `r`
			    LEFT JOIN 
			        `seat` `s` on `s`.`restaurant_id` = `r`.`restaurant_id`
			    WHERE 
			        `r`.`restaurant_name` IS NOT NULL AND
			    	`r`.`restaurant_name` <> '' AND
			        `r`.`restaurant_name` LIKE ?
			    	$filterVacant
		        GROUP BY `r`.`restaurant_id`
			    HAVING
			        distance_in_km < 50)
			AS x
		");
		$stmt->bind_param("ssss", $latitude, $longitude, $latitude, $name);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$countTotal = $row["count"];
		}
		return $countTotal;
	}
	public function addRestaurant($user_id) {
		$response = false;
		if ($user_id) {
			$stmt = Application::DBPrepQuery( "
			    INSERT INTO 
			    	`restaurant`(`user_id`)
			    VALUES (?);
		    ");
			$stmt->bind_param("i", $user_id);
			$result = $stmt->execute();
			if ($result) {
				$response = true;
			}
		}
		return $response;
	}
}