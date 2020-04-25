<?php
class Users {
	public function getUser($userId) {
		$stmt = Application::DBPrepQuery( "
			SELECT 
				`u`.`user_id`,
				`u`.`username`,
				`u`.`password`
			FROM `user` `u`
			WHERE `u`.`user_id` = ?;
		");
		$stmt->bind_param("i", $userId);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) {
			return $row;
		}
		return false;
	}
	public function updatePassword($userId, $password) {
        $response = false;
		if ($userId && $password) {
			$stmt = Application::DBPrepQuery( "
				UPDATE 
					`user`
				SET `password` = ?
				WHERE `user_id` = ?;
		    ");
			$stmt->bind_param("si", $password, $userId);
			$result = $stmt->execute();
			if ($result) {
				$response = true;
			}
		}
		return $response;
	}
}