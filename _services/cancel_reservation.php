<?php

require_once("../global.php");
define('SERVICE_ID', 'cancel_reservation');

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["cancel-reservation-form"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'cancel-reservation-form'";
} else {
    @$response->success = 1;
    
    $reservation_detail_id = $_POST["reservation-detail-id"];
    
    $result = Request::cancelReservation($reservation_detail_id);
    
    $response->message = "Reservation cancelled";
    if(!$result) {
        $response->success = 0;
        $response->message = Core::db()->getError();
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>