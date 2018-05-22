<?php

require_once("../global.php");
define('PAGE_ID', "rooms");

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

include(PAGES . "rooms.php");

?>