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
		$stmt->bind_param("i", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			return $row;
		}
		return false;
	}
}