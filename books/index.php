<?php

require_once("../global.php");
define('PAGE_ID', "books");

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

$field = "";
$value = "";

if(isset($_GET["search-book"])) {
    $field = $_GET["category"];
    $value = $_GET["search"];
}

$books = Book::getBooks($field, $value);

include(PAGES . "books.php");

?>