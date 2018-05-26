<?php

class Request {
    
    public static function getRoomRequest($status = "") {
        $status = Core::Clean($status);
        
        $query = "
            SELECT
            	DATE_FORMAT(date_request, '%Y-%m-%dT%H:%i') as date_request,
            	DATE_FORMAT(date_reservation, '%Y-%m-%dT%H:%i') as date_reservation,
            	room_reservation.id as id, time, status, user_id, room_id, username, email, type
            	tv, room.number as room_number, floor.number as floor_number
            FROM
            	room_reservation join user on (room_reservation.user_id = user.id)
            	join room on (room.id = room_reservation.room_id)
            	join floor on (room.floor_id = floor.id)
            WHERE status like '%$status%' ORDER BY date_request;
        ";
        
        return Core::db()->doQuery($query);
    }
    
    public static function getBookRequest($status = "") {
        $status = Core::Clean($status);
        
        $query = "
            SELECT
            	DATE_FORMAT(date_request, '%Y-%m-%dT%H:%i') as date_request,
            	DATE_FORMAT(date_return, '%Y-%m-%dT%H:%i') as date_return,
            	book_reservation.id as id, time, status, user_id, book_id,
            	username, email, type,
            	book.name as book_name, edition, pages, isbn, editorial_id, author_id,
            	author.names as author_names, author.surnames as author_surnames,
            	editorial.name as editorial_name
            FROM
            	book_reservation join user on (book_reservation.user_id = user.id)
            	join book on (book.id = book_reservation.book_id)
            	join author on (book.author_id = author.id)
            	join editorial on (book.author_id = author.id)
            WHERE status like '%$status%' ORDER BY date_request;
        ";
        
        return Core::db()->doQuery($query);
    }
    
    public static function getEquipmentRequest($status = "") {
        $status = Core::Clean($status);
        
        $query = "
            SELECT
            	DATE_FORMAT(date_request, '%Y-%m-%dT%H:%i') as date_request,
            	DATE_FORMAT(date_return, '%Y-%m-%dT%H:%i') as date_return,
            	equipment_reservation.id as id, time, status, user_id, equipment_id,
            	username, email, type,
            	equipment.name as equipment_name, quantity, manufacturer, serial_number
            FROM
            	equipment_reservation join user on (equipment_reservation.user_id = user.id)
            	join equipment on (equipment.id = equipment_reservation.equipment_id)
            WHERE status like '%$status%' ORDER BY date_request;
        ";
        
        return Core::db()->doQuery($query);
    }
}

?>