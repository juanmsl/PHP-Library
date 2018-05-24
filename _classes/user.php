<?php

class User {
    
    public static function exists($username, $email) {
        $username = Core::Clean($username);
        $email = Core::Clean($email);
        
        return Core::db()->evaluate("SELECT * FROM user WHERE username='$username' OR email='$email';");
    }
    
    public static function get($entry, $password, $gethash = true) {
        $entry = Core::Clean($entry);
        
        if($gethash) {
            $password = Core::Hash($password);
        }
        
        return Core::db()->evaluate("SELECT * FROM user WHERE (username='$entry' OR email='$entry') AND password='$password';");
    }
    
    public static function create($username, $email, $password, $type, $gethash = true) {
        $username = Core::Clean($username);
        $email = Core::Clean($email);
        $type = Core::Clean($type);
        
        if($gethash) {
            $password = Core::Hash($password);
        }
        
        $row = Core::db()->doQuery("INSERT INTO user (username, email, password, type) VALUES ('$username', '$email', '$password', '$type');");
        
        $user = null;
        if($row) {
            $user = static::get($username, $password, false);
        }
        return $user;
    }
}

?>