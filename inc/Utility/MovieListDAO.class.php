<?php

class MovieListDAO   {
    private static $db;

    static function init()  {
        self::$db = new PDOAgent("MovieList");    
    }    

    static function getLists($userId)  {
        $selectSQL = "SELECT * FROM MovieList WHERE user_id = :userId ORDER BY created_at DESC";
        self::$db->query($selectSQL);
        self::$db->bind(":userId", $userId);
        self::$db->execute();
        return self::$db->getResultSet();

    }

    static function getList($listId)  {
        $selectSQL = "SELECT * FROM MovieList WHERE list_id = :listId;";
        self::$db->query($selectSQL);
        self::$db->bind(":listId", $listId);
        self::$db->execute();
        return self::$db->singleResult();    
    }

    static function createList($userId, $listName, $listDescription) {
        $query = "INSERT INTO MovieList (user_id, list_name, list_description) VALUES (:userId, :listName, :listDescription)";

        self::$db->query($query);
        self::$db->bind(":userId", $userId);
        self::$db->bind(":listName", $listName);
        self::$db->bind(":listDescription", $listDescription);
        self::$db->execute();

        return self::$db->lastInsertedId();
    }

    static function deleteList($listId){
        try {
            $deleteQuery = "DELETE FROM MovieList WHERE list_id = :listId";
            self::$db->query($deleteQuery);
            self::$db->bind(":listId", $listId);
            self::$db->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
        return true;
    }

    static function updateList($listName, $listDescription, $listId) {
        $updateQuery = "UPDATE MovieList SET list_name = :listName, list_description = :listDescription";
        $updateQuery .= " WHERE list_id = :listId";

        self::$db->query($updateQuery);
        self::$db->bind(":listName", $listName);
        self::$db->bind(":listDescription", $listDescription);
        self::$db->bind(":listId", $listId);

        self::$db->execute();
        
        return self::$db->rowCount();
    }    
    
}