<?php
class Logs {
	public function getLastModified($restaurantId) {
		$stmt = Application::DBPrepQuery( "
			SELECT
			    `date_created`
            FROM `seat_log`
			WHERE
			    `restaurant_id` = ?
		    ORDER BY
			    `date_created` DESC
			LIMIT 1;
		");
		$stmt->bind_param("i", $restaurantId);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		return $row;
	}
}