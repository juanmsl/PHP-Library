<?php

require_once("../global.php");
define('SERVICE_ID', 'aprove_reservation');

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["aprove-reservation-form"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'aprove-reservation-form'";
} else {
    @$response->success = 1;
    
    $reservation_detail_id = $_POST["reservation-detail-id"];
    $time = $_POST["time"];
    
    $result = Request::approveReservation($reservation_detail_id, $time);
    
    $response->message = "Room reservation created";
    if(!$result) {
        $response->success = 0;
        $response->message = Core::db()->getError();
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>