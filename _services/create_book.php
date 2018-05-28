<?php

require_once("../global.php");
define('SERVICE_ID', 'create_book');

if(!LOGGED_IN or !USER_IS_ADMIN) {
    Core::Redirect(INDEX);
}

if(!isset($_POST["create-book-form"])) {
    @$response->success = 0;
    $response->message = "error request method must be POST from 'create-book-form'";
} else {
    @$response->success = 1;
    $response->message = "";
    $continue = true;
    
    $name = $_POST["name"];
    $edition = $_POST["edition"];
    $editorial_id = $_POST["editorial_id"];
    $editorial_name = $_POST["editorial_name"];
    $author_id = $_POST["author_id"];
    $author_name = $_POST["author_name"];
    $pages = $_POST["pages"];
    $isbn = $_POST["isbn"];
    $quantity = $_POST["quantity"];
    
    if($editorial_id === "other") {
        if($editorial_name !== "") {
            $editorial = Editorial::exists($editorial_name);
            if(!$editorial) {
                Editorial::create($editorial_name);
                $editorial_id = Core::db()->getLastIndex();
            } else {
                $editorial_id = $editorial->id;
            }
        } else {
            $response->success = 0;
            $response->message .= "Please set the new editorial name\n";
            $continue = false;
        }
    }
    
    if($author_id === "other") {
        if($author_name !== "") {
            $author = Author::exists($author_name);
            if(!$author) {
                Author::create($author_name);
                $author_id = Core::db()->getLastIndex();
            } else {
                $author_id = $author->id;
            }
        } else {
            $response->success = 0;
            $response->message .= "Please set the new author name";
            $continue = false;
        }
    }
    
    if($continue) {
        $result = Book::create($name, $edition, $pages, $isbn, $editorial_id, $author_id, $quantity);
    
        if($result) {
            $response->message = "Libro creado";
        } else {
            $response->success = 0;
            $response->message = Core::db()->getError();
        }
    }
}

$myJSON = json_encode($response);
echo $myJSON;

?>