<?php

class Equipment {
    
    public static function getEquipments($field = "", $value = "") {
        
        $extra = "";
        
        if($field !== "" and $value !== "") {
            $field = Core::clean($field);
            $value = Core::clean($value);
            
            switch($field) {
                case "name":
                    $extra = "WHERE name LIKE '%$value%'";
                    break;
                case "manufacturer":
                    $extra = "WHERE manufacturer LIKE '%$value%'";
                    break;
                case "serial_number":
                    $extra = "WHERE serial_number LIKE '%$value%'";
                    break;
            }
        }
        
        $query = "
            SELECT
            	id, name, quantity, manufacturer, serial_number
            FROM
            	equipment
            $extra;
        ";
        
        return Core::db()->doQuery($query);
    }
    
    public static function create($name, $serial_number, $manufacturer, $quantity) {
        $name = Core::Clean($name);
        $serial_number = Core::Clean($serial_number);
        $manufacturer = Core::Clean($manufacturer);
        $quantity = Core::Clean($quantity);
        
        $query = "
            INSERT INTO equipment (name, quantity, manufacturer, serial_number)
            VALUES ('$name', '$quantity', '$manufacturer', '$serial_number');
        ";
        
        return Core::db()->doQuery($query);
    }
    
}

?>