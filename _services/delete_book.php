<?php

require_once("../global.php");
define('SERVICE_ID', 'delete_book');

if(!LOGGED_IN or !USER_IS_ADMIN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["delete-book"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'delete-book'";
} else {
    @$response->success = 1;
    
    $id = $_POST["book-id"];
    
    $result = Book::delete($id);
    
    if($result) {
        $response->message = "Libro eliminado";
    } else {
        $response->success = 0;
        $response->message = Core::db()->getError();
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>