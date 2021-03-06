<?php
class Application {
	const
		HOST = '',
		USER = '',
		PW = '',
		DB = '';
	private $_controller = '',
		$_action = '',
		$_args = array();
	private static $_instance = NULL;
	private static $_db = NULL;
	public static function GetInstance() {
		if (null === self::$_instance)
			self::$_instance = new self();
		return self::$_instance;
	}
	public function setController($controller) {
		if (!empty($controller) && class_exists($controller )) {
			$this->_controller = $controller;
		} else {
			die('No controller exists');
		}
		return $this;
	}	
	public function setAction($action) {
		if (!empty($action) && method_exists($this->getController(), $action )) {
			$this->_action = $action;
		} else {
			//die( 'No method exists' );
		}
		return $this;
	}
	public function setArgs( $args ) {
		if (!empty($args)) {
			$this->_args = $args;
		}
		return $this;
	}
	public function getController()	{
		return $this->_controller;
	}
	public function getAction()	{
		return $this->_action;
	}
	public static function DB()	{
		if (null === self::$_db) {
			self::$_db = mysqli_connect( self::HOST, self::USER, self::PW, self::DB );
			mysqli_set_charset(self::$_db, "utf8");
		}
		return self::$_db;
	}
	public static function DBQuery($query) {
		if (!empty($query)) {
			if (null === self::$_db) self::$_db = self::DB();
			return self::$_db->query( $query );
		}
		return false;
	}
	public static function DBPrepQuery($query) {
		if (!empty($query)) {
			if (null === self::$_db) self::$_db = self::DB();
			return self::$_db->prepare($query);
		}
		return false;
	}
	public static function DBExecutePrepQuery($query) {
		if (!empty($query)) {
			if (null === self::$_db) self::$_db = self::DB();
			$stmt = self::$_db->prepare( $query );
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			unset($stmt);
			return $result;
		}
		return false;
	}
	public function dispatch() {
		$cntlr = $this->getController();
		$action = $this->getAction();
		$cObj = new $cntlr();
		$cObj->$action($this->_args);
	}
}
