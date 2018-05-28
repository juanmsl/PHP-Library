<?php

class Author {
    
    public static function getAll() {
        $query = "
            SELECT * FROM author;
        ";
        
        return Core::db()->doQuery($query);
    }
    
    public static function exists($name) {
        $name = Core::Clean($name);
        
         $query = "
            SELECT * FROM author WHERE name='$name';
        ";
        
        return Core::db()->evaluate($query);
    }
    
    public static function create($name) {
        $name = Core::Clean($name);
        
         $query = "
            INSERT INTO author (name)
            VALUES ('$name');
        ";
        
        return Core::db()->doQuery($query);
    }
    
}

?>