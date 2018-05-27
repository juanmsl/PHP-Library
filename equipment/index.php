<?php

require_once("../global.php");
define('PAGE_ID', "equipment");

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

$field = "";
$value = "";

if(isset($_GET["search-equipment"])) {
    $field = $_GET["category"];
    $value = $_GET["search"];
}

$equipments = Equipment::getEquipments($field, $value);

include(PAGES . "equipment.php");

?>