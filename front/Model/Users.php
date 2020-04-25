<?php
class Users {
	public function getUser($username) {
		$stmt = Application::DBPrepQuery( "
			SELECT 
				`u`.`user_id`,
				`u`.`username`,
				`u`.`password`,
				`u`.`is_verified`,
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
	public function addUser($username, $password, $email, $token) {
		$id = "";
		$response = false;
        if ($username && $password && $email && $token) {
			$stmt = Application::DBPrepQuery( "
			    INSERT INTO 
			    	`user`(`username`, `password`, `email`, `token`)
			    VALUES (?, ?, ?, ?);
		    ");
			$stmt->bind_param("ssss", $username, $password, $email, $token);
			$result = $stmt->execute();
			$id = $stmt->insert_id;
		}
		return $id;
	}
	public function verifyUser($username, $token) {
		$response = false;
		if ($username && $token) {
			$stmt = Application::DBPrepQuery( "
				UPDATE 
					`user`
				SET `is_verified` = 1
				WHERE 
				    `username` = ? AND
				    `token` = ?;
		    ");
			$stmt->bind_param("ss", $username, $token);
			$result = $stmt->execute();
			if ($result) {
				$response = true;
			}
		}
		return $response;
	}
}