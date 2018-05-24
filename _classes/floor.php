<?php

class Floor {
    
    public static function getAll() {
        return Core::db()->doQuery("SELECT * FROM floor ORDER BY number;");
    }
    
    public static function getRoomsFloor($floor_id, $time, $tv = "", $available = "") {
        $floor_id = Core::Clean($floor_id);
        
        $extra = "";
        
        if($tv !== "" and $tv !== "n") $extra .= "AND tv = '$tv' ";
        if($available !== "" and $available !== "n") $extra .= "AND available = '$available' ";
        
        $query = "
            SELECT id, tv, number, floor_id, (
                select !count(rr.id)
                from room_reservation rr
                where (
                    	rr.date_reservation <= timestamp('$time')
                    	and timestamp('$time') <= DATE_ADD(rr.date_reservation , INTERVAL rr.time HOUR )
                	)
                 	and rr.room_id = r.id
                ) as available
            FROM room r
            WHERE floor_id = '$floor_id' " .
            $extra .
            "ORDER BY number;";
        
        return Core::db()->doQuery($query);
    }
}

?>