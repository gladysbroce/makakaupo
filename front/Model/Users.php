<?php
class Users {
	public function getUser($username) {
		$stmt = Application::DBPrepQuery( "
			SELECT 
				`u`.`username`,
				`u`.`password`,
				`r`.`restaurant_id`
			FROM `user` `u`
			INNER JOIN `restaurant` `r` 
			    ON `r`.`user_id` = `u`.`user_id`
			WHERE `u`.`username` = ?;
		");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			return $row;
		}
		return false;
	}
	public function addUser($username, $password, $email) {
		$response = false;
		if ($username && $password && $email) {
			$stmt = Application::DBPrepQuery( "
			    INSERT INTO 
			    	`user`(`username`, `password`, `email`)
			    VALUES (?, ?, ?);
		    ");
			$stmt->bind_param("sss", $username, $password, $email);
			$result = $stmt->execute();
			$id = $stmt->insert_id;
		}
		return $id;
	}
}