<?php

require_once("../global.php");
define('SERVICE_ID', 'reserve_equipment');

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["request-equipment-form"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'request-equipment-form'";
} else {
    @$response->success = 1;
    
    $date_reservation = $_POST["time"];
    $time = 2;
    $user_id = USER_ID;
    $equipment_id = $_POST["equipment_id"];
    
    $result = Request::createEquipmentReservation($date_reservation, $time, $user_id, $equipment_id);
    
    $response->message = "Equipment reservation created";
    if(!$result) {
        $response->success = 0;
        $response->message = Core::db()->getError();
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>