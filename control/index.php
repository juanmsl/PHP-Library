<?php

require_once("../global.php");
define('PAGE_ID', "control");

if(!LOGGED_IN or !USER_IS_ADMIN) {
    Core::Redirect(INDEX);
}

include(PAGES . "control.php");

?>