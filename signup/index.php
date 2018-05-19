<?php

require_once("../global.php");
define('PAGE_ID', "signup");

if(LOGGED_IN) {
    header("Location: " . HOME);
	exit;
}

include(PAGES . "signup.php");

?>