<?php

require_once("../global.php");
define('PAGE_ID', "events");

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

$field = "";
$value = "";

if(isset($_GET["search-event"])) {
    $field = $_GET["category"];
    $value = $_GET["search"];
}

$events = Event::getEvents($field, $value);

include(PAGES . "events.php");

?>