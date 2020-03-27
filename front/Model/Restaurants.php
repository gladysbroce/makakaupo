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
				`restaurant`.`phone_no`
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
	public function getNewRestaurants($sort = 'date_created', $order = 'DESC', $limit = '3') {
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
	public function getRestaurants($filter = '', $sort = '') {
		$restaurants = array();
		$filter = '%'.$filter.'%';
		$limit = 15;
		$stmt = Application::DBPrepQuery( "
			SELECT 
				`restaurant`.*
			FROM `restaurant`
			WHERE `restaurant`.`restaurant_name` LIKE ? OR 
			      `restaurant`.`address` LIKE ?;
		");
		$stmt->bind_param("ss", $filter, $filter);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			$restaurants[] = $row;
		}
		return $restaurants;
	}
}