<?php

class MovieListDAO   {
    private static $db;

    static function init()  {
        self::$db = new PDOAgent("MovieList");    
    }    

    static function getList(string $userName)  {
        $selectSQL = "SELECT * FROM User WHERE username = :username";
        self::$db->query($selectSQL);
        self::$db->bind(":username", $userName);
        self::$db->execute();
        return self::$db->singleResult();

    }

    static function getLists()  {
        $selectSQL = "SELECT * FROM User;";
        self::$db->query($selectSQL);
        self::$db->execute();
        return self::$db->getResultSet();    
    }

    static function createList($userName, $email, $hashedPassword) {
        $query = "INSERT INTO User (username, email, password) VALUES (:userName, :Email, :hashed_Password)";

        self::$db->query($query);
        self::$db->bind(":userName", $userName);
        self::$db->bind(":Email", $email);
        self::$db->bind(":hashed_Password", $hashedPassword);
        self::$db->execute();

        return self::$db->lastInsertedId();
    }

    static function deleteList($userName){
        try {
            $deleteQuery = "DELETE FROM User WHERE username = :username";

            self::$db->query($deleteQuery);
            self::$db->bind(":username", $userName);
            self::$db->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
        return true;
    }

    static function updateList(User $userToUpdate, $lastUsername) {
        $updateQuery = "UPDATE User SET username = :userName, email = :Email, password = :Password";
        $updateQuery .= " WHERE username = :lastUsername";

        self::$db->query($updateQuery);
        self::$db->bind(":userName", $userToUpdate->getUsername());
        self::$db->bind(":Email", $userToUpdate->getEmail());
        self::$db->bind(":Password", $userToUpdate->getPassword());
        self::$db->bind(":lastUsername", $lastUsername);

        self::$db->execute();
        
        return self::$db->rowCount();
    }    
    
}