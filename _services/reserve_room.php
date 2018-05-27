<?php

require_once("../global.php");
define('SERVICE_ID', 'reserve_room');

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["request-room-form"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'request-room-form'";
} else {
    @$response->success = 1;
    
    $date_reservation = $_POST["time"];
    $time = 2;
    $user_id = USER_ID;
    $room_id = $_POST["room_id"];
    
    $result = Request::createRoomReservation($date_reservation, $time, $user_id, $room_id);
    
    $response->message = "Room reservation created";
    if(!$result) {
        $response->success = 0;
        $response->message = Core::db()->getError();
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>