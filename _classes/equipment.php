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
    
}

?>