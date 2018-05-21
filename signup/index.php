<?php

require_once("../global.php");
define('PAGE_ID', "signup");

if(LOGGED_IN) {
    Core::Redirect(HOME);
}

include(PAGES . "signup.php");

?>