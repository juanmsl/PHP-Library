<?php

require_once("../global.php");
define('SERVICE_ID', 'create_book');

if(!LOGGED_IN or !USER_IS_ADMIN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["create-equipment-form"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'create-equipment-form'";
} else {
    @$response->success = 1;
    $response->message = "";
    $continue = true;
    
    $name = $_POST["name"];
    $serial_number = $_POST["serial_number"];
    $manufacturer = $_POST["manufacturer"];
    $quantity = $_POST["quantity"];
    
    
    $result = Equipment::create($name, $serial_number, $manufacturer, $quantity);

    if($result) {
        $response->message = "Equipo creado";
    } else {
        $response->success = 0;
        $response->message = Core::db()->getError();
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>