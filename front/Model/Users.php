<?php
class Users {
	public function getUser($username) {
		$stmt = Application::DBPrepQuery( "
			SELECT 
				`username`,
				`password`
			FROM `user`
			WHERE `username` = ?;
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
			if ($result) {
				$response = true;
			}
		}
		return $response;
	}
}