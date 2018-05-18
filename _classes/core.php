<?php

class Core {
	public $execStart;
	static $instance = null;
	
	public static function instance() {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
	
	private function __construct() {
		$this->execStart = microtime(true);
		$this->ParseConfig();
	}
	
	public function ParseConfig() {
		$configPath = CLASSES . 'config.php';
		if (!file_exists($configPath)) {
			$this->systemError('Configuration Error', 'The configuration file could not be located at ' . $configPath);
		}
		require_once $configPath;
		if (!isset($config) || count($config) < 2) {
			$this->systemError('Configuration Error', 'The configuration file was located, but is in an invalid format. Data is missing or in the wrong format.');
		}
		
		define('WWW', $config['Site']['www']);
		define('MYSQL_HOSTNAME', $config['MySQL']['hostname']);
		define('MYSQL_USERNAME', $config['MySQL']['username']);
		define('MYSQL_PASSWORD', $config['MySQL']['password']);
		define('MYSQL_DATABASE', $config['MySQL']['database']);
	}
	
	public static function SystemError($title, $text) {
		echo "<h1>ERROR</h1> \n <!-- \n $title \n\n  $text \n -->";
		exit;
	}
	
	public function UberHash($input) {
		//return $input;
		//return base64_encode($input);
		return sha1($input);
	}
	
	public static function GetIP() {
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
			return $_SERVER["HTTP_X_FORWARDED_FOR"];
		if (isset($_SERVER["HTTP_CLIENT_IP"]))
			return $_SERVER["HTTP_CLIENT_IP"];
		return $_SERVER["REMOTE_ADDR"];
	}
	
	public function CheckCookies() {
		if (LOGGED_IN) {
			return;
		}
		if (isset($_COOKIE['rememberme']) && $_COOKIE['rememberme'] =="true" &&
			isset($_COOKIE['rememberme_token']) &&
			isset($_COOKIE['rememberme_name'])) {
			
			$name = filter($_COOKIE['rememberme_name']);
			$token = filter($_COOKIE['rememberme_token']);
			$find = dbquery("SELECT null FROM estudiantes WHERE usuario = '" . $name . "' AND contrasena = '" . $token . "' LIMIT 1");
			if (mysqli_num_rows($find) > 0) {
				$_SESSION['USER_NAME'] = $name;
				$_SESSION['USER_PASS'] = $token;
				$_SESSION['set_cookies'] = true;
				header("Location: " . WWW . "/security_check.php");
				exit;
			}
		}
	}
}

?>