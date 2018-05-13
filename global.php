<?php

define('DS',            DIRECTORY_SEPARATOR);
define('LB',            chr(13));
define('CWD',           dirname(__FILE__) . DS);
define('INCLUDES',      CWD . 'includes' . DS);
define('PAGES',         CWD . 'pages' . DS);
define('STATIC',        CWD . "static" . DS);
define('CLASSES',         CWD . "classes" . DS);
define('SITE_NAME',     "Proweb");
define('LANGUAGE',      "es");
define('THEME_COLOR',   "#0D91CF");

$global["TITLE"] =      SITE_NAME;

date_default_timezone_set('America/Bogota');
setlocale(LC_TIME, "Spanish_Colombia");

error_reporting(E_ALL);
@session_start();

include(CLASSES . "mysql.php");
include(CLASSES . "core.php");

$CORE = Core::Instance();

$DB = new MySQL($CORE, MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
$DB->connect();

if (isset($_SESSION['UBER_USER_E']) && isset($_SESSION['UBER_USER_H'])) {
	$username = $_SESSION['USER_NAME'];
	$password = $_SESSION['USER_PASS'];
	$usersql = dbquery("SELECT * FROM usuario WHERE username=$username AND password=$password");
	$myrow = mysqli_fetch_assoc($usersql);
	if (mysqli_num_rows($usersql) == 1) {
		define('LOGGED_IN', true);
		define('USER_NAME', $username);
		define('USER_HASH', $password);
		define('USER_ID', $myrow["id"]);
	} else {
		@session_destroy();
		header('Location: /');
		exit;
	}
} else {
	define('LOGGED_IN', false);
	define('USER_NAME', 'Invitado');
	define('USER_ID', -1);
	define('USER_HASH', null);
}

$CORE->CheckCookies();

?>