<?php

require_once("global.php");
define('PAGE_ID', "index");

if(LOGGED_IN) {
    header("Location: " . HOME);
	exit;
}

include(PAGES . "index.php");

?>