<?php

class Event {
    
    public static function getEvents($field = "", $value = "") {
        
        $extra = "";
        
        if($field !== "" and $value !== "") {
            $field = Core::clean($field);
            $value = Core::clean($value);
            
            switch($field) {
                case "name":
                    $extra = "WHERE name LIKE '%$value%'";
                    break;
                case "place":
                    $extra = "WHERE place LIKE '%$value%'";
                    break;
            }
        }
        
        $query = "
            SELECT
            	id, name, date, place, guest_number
            FROM
            	event
            $extra;
        ";
        
        return Core::db()->doQuery($query);
    }
    
}

?>