<?php

class Floor {
    
    public static function getAll() {
        return Core::db()->doQuery("SELECT * FROM floor ORDER BY number;");
    }
    
    public static function getRoomsFloor($floor_id, $time, $tv = "", $available = "") {
        $floor_id = Core::Clean($floor_id);
        $tv = Core::Clean($tv);
        $available = Core::Clean($available);
        $time = Core::Clean($time);
        
        $extra = "";
        
        if($tv !== "" and $tv !== "n") $extra .= "AND tv = '$tv' ";
        if($available !== "" and $available !== "n") $extra .= "AND available = '$available' ";
        
        $query = "
            SELECT
            	room.id AS room_id, tv, room.number AS room_number, floor_id,
            	floor.number AS floor_number,
            	available
            FROM
            	room JOIN floor ON (floor.id = room.floor_id)
            	JOIN (
                    SELECT
            			room.id AS room_id,
                    	(
            		        SELECT
            		     		!COUNT(*)
            		     	FROM
            		        	room_reservation JOIN reservation_detail ON (reservation_detail.id = room_reservation.reservation_detail_id)
            		     	WHERE
            		        	room_reservation.room_id = room.id
            		        	AND (
            		                reservation_detail.date_reservation <= TIMESTAMP('$time')
            		                AND TIMESTAMP('$time') <= DATE_ADD(reservation_detail.date_reservation , INTERVAL reservation_detail.time HOUR)
             		           )
            		    ) AS available
            		FROM
            			room
                ) AS room_available ON (room.id = room_available.room_id)
            WHERE
                floor.id = '$floor_id'
                $extra
            ORDER BY room.number;
        ";
        
        return Core::db()->doQuery($query);
    }
}

?>