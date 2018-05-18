<?php

date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, "Spanish_Colombia");

error_reporting(E_ALL);
@session_start();

// ****************************************************************************

define('DS',            DIRECTORY_SEPARATOR);
define('ENDL',          chr(13));
define('CWD',           dirname(__FILE__) . DS);
define('CLASSES',       CWD . "_classes" . DS);
define('INCLUDES',      CWD . '_includes' . DS);
define('PAGES',         CWD . '_pages' . DS);
define('RESOURCES',     CWD . "_resources" . DS);
define('SELF_PAGE', 	$_SERVER["PHP_SELF"]);
define('SITE_NAME',     "Biblioteca PUJA");
define('LANGUAGE',      "es");
define('THEME_COLOR',   "#0D91CF");

// ****************************************************************************

include(CLASSES . "mysql.php");
include(CLASSES . "core.php");

$CORE = Core::Instance();
$DB = new MySQL($CORE, MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
$DB->connect();

// ****************************************************************************

define('INDEX', 		WWW . "/");
define('HOME',			WWW . "/app/home");

// ****************************************************************************

$global["TITLE"] =      SITE_NAME;

// ****************************************************************************

if (isset($_SESSION['USER_NAME']) && isset($_SESSION['USER_PASS'])) {
	$username = $_SESSION['USER_NAME'];
	$password = $_SESSION['USER_PASS'];
	$usersql = $DB->doQuery("SELECT * FROM usuario WHERE username=$username AND password=$password");
	$myrow = mysqli_fetch_assoc($usersql);
	if (mysqli_num_rows($usersql) == 1) {
		define('LOGGED_IN', true);
		define('USER_NAME', $username);
		define('USER_HASH', $password);
		define('USER_ID', $myrow["id"]);
	} else {
		@session_destroy();
		header("Location: " . INDEX);
		exit;
	}
} else {
	define('LOGGED_IN', false);
	define('USER_NAME', 'Invitado');
	define('USER_HASH', null);
	define('USER_ID', -1);
}

$CORE->CheckCookies();

?>