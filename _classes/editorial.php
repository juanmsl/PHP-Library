<?php

class Editorial {
    
    public static function getAll() {
        $query = "
            SELECT * FROM editorial;
        ";
        
        return Core::db()->doQuery($query);
    }
    
    public static function exists($name) {
        $name = Core::Clean($name);
        
         $query = "
            SELECT * FROM editorial WHERE name='$name';
        ";
        
        return Core::db()->evaluate($query);
    }
    
    public static function create($name) {
        $name = Core::Clean($name);
        
         $query = "
            INSERT INTO editorial (name)
            VALUES ('$name');
        ";
        
        return Core::db()->doQuery($query);
    }
    
}

?>