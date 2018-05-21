<?php

class User {
    public $id;
    public $username;
    public $email;
    public $type;
    public $passhash;
    
    private function __construct($id, $username, $email, $passhash, $type) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->type = $type;
        $this->passhash = $passhash;
    }
    
    public static function exists($username, $email) {
        $username = Core::Clean($username);
        $email = Core::Clean($email);
        
        $row = Core::db()->evaluate("SELECT * FROM user WHERE username='$username' OR email='$email';");
        
        $user = null;
        if($row) {
            $user = new User($row["id"], $row["username"], $row["email"], $row["password"], $row["type"]);
        }
        return $user;
    }
    
    public static function get($entry, $password, $gethash = true) {
        $entry = Core::Clean($entry);
        
        if($gethash) {
            $password = Core::Hash($password);
        }
        
        $row = Core::db()->evaluate("SELECT * FROM user WHERE (username='$entry' OR email='$entry') AND password='$password';");
        
        $user = null;
        if($row) {
            $user = new User($row["id"], $row["username"], $row["email"], $row["password"], $row["type"]);
        }
        return $user;
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