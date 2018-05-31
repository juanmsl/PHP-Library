<?php

class Request {
    
    public static function getRoomRequest($status = "") {
        $status = Core::Clean($status);
        
        $query = "
            SELECT
            	DATE_FORMAT(date_request, '%Y-%m-%dT%H:%i') AS date_request,
            	DATE_FORMAT(date_reservation, '%Y-%m-%dT%H:%i') AS date_reservation,
            	room_reservation.id AS id, time, status, item, user_id, room_id,
            	username, email, type
            	tv, room.number AS room_number,
            	floor.number AS floor_number
            FROM
            	room_reservation JOIN room ON (room.id = room_reservation.room_id)
            	JOIN floor ON (room.floor_id = floor.id)
            	JOIN reservation_detail ON (reservation_detail.id = room_reservation.reservation_detail_id)
            	JOIN user ON (reservation_detail.user_id = user.id)
            WHERE status like '%$status%' ORDER BY date_request;
        ";
        
        return Core::db()->doQuery($query);
    }
    
    public static function getBookRequest($status = "") {
        $status = Core::Clean($status);
        
        $query = "
            SELECT
            	DATE_FORMAT(date_request, '%Y-%m-%dT%H:%i') AS date_request,
            	DATE_FORMAT(date_reservation, '%Y-%m-%d') AS date_reservation,
            	book_reservation.id AS id, time, status, item, user_id, book_id,
            	username, email, type,
            	book.name as book_name, edition, pages, isbn, editorial_id, author_id, quantity,
            	author.name as author_name,
            	editorial.name as editorial_name
            FROM
            	book_reservation JOIN book on (book.id = book_reservation.book_id)
            	JOIN author on (book.author_id = author.id)
            	JOIN editorial on (book.editorial_id = editorial.id)
            	JOIN reservation_detail ON (reservation_detail.id = book_reservation.reservation_detail_id)
            	JOIN user on (reservation_detail.user_id = user.id)
            WHERE status like '%$status%' ORDER BY date_request;
        ";
        
        return Core::db()->doQuery($query);
    }
    
    public static function getEquipmentRequest($status = "") {
        $status = Core::Clean($status);
        
        $query = "
            SELECT
            	DATE_FORMAT(date_request, '%Y-%m-%dT%H:%i') AS date_request,
            	DATE_FORMAT(date_reservation, '%Y-%m-%dT%H:%i') AS date_reservation,
            	equipment_reservation.id AS id, time, status, item, user_id, equipment_id,
            	username, email, type,
            	equipment.name as equipment_name, quantity, manufacturer, serial_number
            FROM
            	equipment_reservation JOIN equipment on (equipment.id = equipment_reservation.equipment_id)
            	JOIN reservation_detail ON (reservation_detail.id = equipment_reservation.reservation_detail_id)
            	JOIN user on (reservation_detail.user_id = user.id)
            WHERE status like '%$status%' ORDER BY date_request;
        ";
        
        return Core::db()->doQuery($query);
    }
    
    private static function createReservationDetail($date_reservation, $time, $user_id, $item) {
        $date_reservation = Core::Clean($date_reservation);
        $time = Core::Clean($time);
        $user_id = Core::Clean($user_id);
        $item = Core::Clean($item);
        
        $reservation_detail = "
            INSERT INTO reservation_detail (date_reservation, time, user_id, item)
            VALUES ('$date_reservation', '$time', '$user_id', '$item');
        ";
        
        return Core::db()->doQuery($reservation_detail);
    }
    
    public static function createRoomReservation($date_reservation, $time, $user_id, $room_id) {
        $room_id = Core::Clean($room_id);
        
        $result = static::createReservationDetail($date_reservation, $time, $user_id, 'room');
        
        if($result) {
            $reservation_detail_id = Core::db()->getLastIndex();
            $room_reservation = "
                INSERT INTO room_reservation (reservation_detail_id, room_id)
                VALUES ('$reservation_detail_id', '$room_id');
            ";
            
            $result = Core::db()->doQuery($room_reservation);
        }
        
        return $result;
    }
    
    public static function createBookReservation($date_reservation, $time, $user_id, $book_id) {
        $book_id = Core::Clean($book_id);
        
        $result = static::createReservationDetail($date_reservation, $time, $user_id, 'book');
        
        if($result) {
            $reservation_detail_id = Core::db()->getLastIndex();
            $book_reservation = "
                INSERT INTO book_reservation (reservation_detail_id, book_id)
                VALUES ('$reservation_detail_id', '$book_id');
            ";
            
            $result = Core::db()->doQuery($book_reservation);
        }
        
        return $result;
    }
}

?>