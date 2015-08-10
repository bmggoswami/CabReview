<?php
define ('CONFIG_PATH','config.ini');
class Database{

	private $_connection;
	private static $_instance;
	private $_config;
	
	public static function getInstance(){
		if( !self::$_instance ){
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	private function __construct(){
		$this->_config = parse_ini_file(CONFIG_PATH);
		$this->_connection = new mysqli(
								$this->_config['host'],
								$this->_config['user'],
								$this->_config['pass'],
								$this->_config['db']
							);
       if(mysqli_connect_error()) {
			die("Failed to conencto to MySQL: " . mysql_connect_error());
		}												
	}
	
	private function __clone() { }
	
	public function getConnection() {
		return $this->_connection;
	}
}
?>
