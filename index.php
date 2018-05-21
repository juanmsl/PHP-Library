<?php

require_once("global.php");
define('PAGE_ID', "index");

if(LOGGED_IN) {
    Core::Redirect(HOME);
}

include(PAGES . "index.php");

?>