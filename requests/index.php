<?php

require_once("../global.php");
define('PAGE_ID', "requests");

if(!LOGGED_IN or !USER_IS_ADMIN) {
    Core::Redirect(INDEX);
}

$room_requests = Request::getRoomRequest('request');
$book_requests = Request::getBookRequest('request');
$equipment_requests = Request::getEquipmentRequest('request');

$requests = array();

if($room_requests->num_rows > 0) {
    $requests[] = array(
        "title" => "Salas",
        "data" => $room_requests
    );
}

if($book_requests->num_rows > 0) {
    $requests[] = array(
        "title" => "Libros",
        "data" => $book_requests
    );
}

if($equipment_requests->num_rows > 0) {
    $requests[] = array(
        "title" => "Equipos",
        "data" => $equipment_requests
    );
}

include(PAGES . "requests.php");

?>