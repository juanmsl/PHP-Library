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
            	id, name, DATE_FORMAT(date, '%d de %M del %Y a las %H:%i') as date, place, guest_number,
            	(SELECT COUNT(*) FROM event_registry WHERE event_registry.event_id = event.id) AS inscribed
            FROM
            	event
            $extra;
        ";
        
        return Core::db()->doQuery($query);
    }
    
    public static function create($name, $date, $place, $guest_number) {
        $name = Core::clean($name);
        $date = Core::clean($date);
        $place = Core::clean($place);
        $guest_number = Core::clean($guest_number);
        
        $create = "
            INSERT INTO event (name, date, place, guest_number)
            VALUES ('$name', '$date', '$place', '$guest_number');
        ";
        
        return Core::db()->doQuery($create);
    }
    
    public static function delete($id) {
        $id = Core::Clean($id);
        
        $query = "
            DELETE FROM event WHERE id='$id'
        ";
        
        return Core::db()->doQuery($query);
    }
    
    public static function subscribeUser($event_id, $user_id, $user_email) {
        $event_id = Core::Clean($event_id);
        $user_id = Core::Clean($user_id);
        $user_email = Core::Clean($user_email);
        
        $subscribe = "
            INSERT INTO event_registry (user_email, user_id, event_id)
            VALUES ('$user_email', '$user_id', '$event_id');
        ";
        
        return Core::db()->doQuery($subscribe);
    }
    
}

?>