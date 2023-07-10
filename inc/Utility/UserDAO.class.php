<?php

class UserDAO   {
    private static $db;

    static function init()  {
        self::$db = new PDOAgent("User");    
    }    

    static function getUser(string $userName)  {
        $selectSQL = "SELECT * FROM USER WHERE username = :username;";
        self::$db->query($selectSQL);
        self::$db->bind(":username", $userName);
        self::$db->execute();
        return self::$db->singleResult();

    }

    static function getUsers()  {
        $selectSQL = "SELECT * FROM users";
        self::$db->query($selectSQL);
        self::$db->execute();
        return self::$db->getResultSet();    

    }

    static function setPassword($userName, $newPassword)    {

        return self::$db->rowCount();

    }

    
    
    
}