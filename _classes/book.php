<?php

class Book {

    public static function getBooks($field = "", $value = "") {
        
        $extra = "";
        
        if($field !== "" and $value !== "") {
            $field = Core::clean($field);
            $value = Core::clean($value);
            
            switch($field) {
                case "name":
                    $extra = "WHERE book.name LIKE '%$value%'";
                    break;
                case "author":
                    $extra = "WHERE CONCAT(author.surnames, ' ', author.names) LIKE '%$value%'";
                    break;
                case "editorial":
                    $extra = "WHERE editorial.name LIKE '%$value%'";
                    break;
                case "edition":
                    $extra = "WHERE edition LIKE '%$value%'";
                    break;
                case "pages":
                    $extra = "WHERE pages LIKE '%$value%'";
                    break;
                case "isbn":
                    $extra = "WHERE isbn LIKE '%$value%'";
                    break;
            }
        }
        
        $query = "
            SELECT
            	book.id AS id, book.name as name, edition, pages, quantity, isbn, editorial_id, author_id,
            	author.name AS author_name,
            	editorial.name AS editorial_name
            FROM
            	book JOIN editorial ON (editorial.id = book.editorial_id)
            	JOIN author ON (author.id = book.author_id)
            $extra;
        ";
        
        return Core::db()->doQuery($query);
    }
    
    public static function create($name, $edition, $pages, $isbn, $editorial_id, $author_id, $quantity) {
        $name = Core::Clean($name);
        $edition = Core::Clean($edition);
        $pages = Core::Clean($pages);
        $isbn = Core::Clean($isbn);
        $editorial_id = Core::Clean($editorial_id);
        $author_id = Core::Clean($author_id);
        $quantity = Core::Clean($quantity);
        
        $query = "
            INSERT INTO book (name, edition, pages, isbn, editorial_id, author_id, quantity)
            VALUES ('$name', '$edition', '$pages', '$isbn', '$editorial_id', '$author_id', '$quantity');
        ";
        
        return Core::db()->doQuery($query);
    }
    
    public static function delete($id) {
        $id = Core::Clean($id);
        
        $query = "
            DELETE FROM book WHERE id='$id'
        ";
        
        return Core::db()->doQuery($query);
    }
    
}

?>