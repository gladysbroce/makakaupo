<?php
class Seats {
	public function getSeats($restaurantId, $floorId) {
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
}