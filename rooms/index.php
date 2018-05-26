<?php

require_once("../global.php");
define('PAGE_ID', "rooms");

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

$time = Core::FormatDate(time());
$tv = "n";
$available = "n";

if(isset($_GET["find-room-form"])) {
    $time = $_GET["time"];
    $tv = $_GET["tv"];
    $available = $_GET["available"];
}

$floors = Floor::getAll();
$roomsFloors = array();

while($floor = $floors->fetch_object()) {
    $roomsFloors[] = array(
        "floor_id" => $floor->id,
        "floor_number" => $floor->number,
        "floor_rooms" => Floor::getRoomsFloor($floor->id, $time, $tv, $available)
    );
}

include(PAGES . "rooms.php");

echo "<script>"

?>