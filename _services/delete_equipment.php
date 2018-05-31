<?php

require_once("../global.php");
define('SERVICE_ID', 'delete_equipment');

if(!LOGGED_IN or !USER_IS_ADMIN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["delete-equipment"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'delete-equipment'";
} else {
    @$response->success = 1;
    
    $id = $_POST["equipment-id"];
    
    $result = Equipment::delete($id);
    
    if($result) {
        $response->message = "Equipo eliminado";
    } else {
        $response->success = 0;
        $response->message = Core::db()->getError();
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>