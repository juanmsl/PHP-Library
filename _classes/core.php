<?php

include_once("mysql.php");

class Core {
	public $execStart;
	private static $instance = null;
	public static $mysqlcon;
	
	public static function instance() {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
    
    public static function db() {
    	return static::$mysqlcon;
    }
	
	private function __construct() {
		$this->execStart = microtime(true);
		$this->ParseConfig();
		static::$mysqlcon = new MySQL($this, MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
	}
	
	private function ParseConfig() {
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
		if(DEBUG) {
			echo "<h1>ERROR</h1> \n <!-- \n $title \n\n  $text \n -->";
		}
		exit;
	}
	
	public static function Hash($input) {
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
	
	public static function CheckCookies() {
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
	
	public static function Clean($strInput, $ignoreHtml = false, $nl2br = false, $encoding = "UTF-8") {
		$strInput = stripslashes(trim($strInput));
		
		if (!$ignoreHtml) {
			$strInput = htmlspecialchars($strInput, ENT_QUOTES | ENT_HTML5, $encoding);
		}
		
		if ($nl2br) {
			$strInput = nl2br($strInput);
		}
		
		return $strInput;
	}
	
	public static function Redirect($url) {
		header("Location: " . $url);
		exit;
	}
	
	public static function ValidatePassword($password, $passwordconfirm) {
		$passwordErr = "";
		$validPassword = true;
		
		if (strlen($password) < '8') {
			$validPassword = false;
			$passwordErr .= "La contraseña debe tener minimo 8 caracteres". ENDL;
		}
		
		if(!preg_match("#[0-9]+#", $password)) {
			$validPassword = false;
			$passwordErr .= "La contraseña debe tener al menos un número" . ENDL;
		}
		
		if($password !== $passwordconfirm) {
			$validPassword = false;
			$passwordErr .= "Las contraseñas no coinciden" . ENDL;
		}
		
		return array($validPassword, $passwordErr);
	}
	
	public static function ValidateEmail($email, $emailconfirm) {
		$emailErr = "";
		$validEmail = true;
		
		if(!preg_match("/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/", $email)) {
			$validEmail = false;
			$emailErr .= "No es un correo valido" . ENDL;
		} 
		
		if($email !== $emailconfirm) {
			$validEmail = false;
			$emailErr .= "Los correos no coinciden" . ENDL;
		}
		
		return array($validEmail, $emailErr);
	}
}

?>