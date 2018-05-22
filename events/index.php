<?php

require_once("../global.php");
define('PAGE_ID', "events");

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

include(PAGES . "events.php");

?>