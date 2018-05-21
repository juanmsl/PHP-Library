<?php

require_once("../global.php");
define('PAGE_ID', 'home');

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

include(PAGES . "home.php");

?>