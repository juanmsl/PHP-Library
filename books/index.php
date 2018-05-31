<?php

require_once("../global.php");
define('PAGE_ID', "books");

if(!LOGGED_IN) {
    Core::Redirect(INDEX);
}

$time = Core::FormatDate(time(), "Y-m-d");
$field = "";
$value = "";

if(isset($_GET["search-book"])) {
    $field = $_GET["category"];
    $value = $_GET["search"];
}

$books = Book::getBooks($field, $value);
$editorials = Editorial::getAll();
$authors = Author::getAll();

include(PAGES . "books.php");

?>