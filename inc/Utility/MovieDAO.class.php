<?php

class MovieDAO   {
    private static $db;

    static function init()  {
        self::$db = new PDOAgent("Movie");    
    }    

    static function getMovie(string $movieId)  {
        $selectSQL = "SELECT * FROM Movie WHERE movie_id = :movieId";
        self::$db->query($selectSQL);
        self::$db->bind(":movieId", $movieId);
        self::$db->execute();
        return self::$db->singleResult();

    }

    static function getMovies($listId)  {
        $selectSQL = "SELECT * FROM Movie WHERE list_id = :listId ORDER BY movie_added_date DESC;";
        self::$db->query($selectSQL);
        self::$db->bind(":listId", $listId);
        self::$db->execute();
        return self::$db->getResultSet();    
    }

    static function createMovie($listId, $movieName, $movieRating) {
        $query = "INSERT INTO Movie (list_id, movie_name, movie_rating) VALUES (:listId, :movieName, :movieRating)";

        self::$db->query($query);
        self::$db->bind(":listId", $listId);
        self::$db->bind(":movieName", $movieName);
        self::$db->bind(":movieRating", $movieRating);
        self::$db->execute();

        return self::$db->lastInsertedId();
    }

    static function deleteMovie($movieId){
        try {
            $deleteQuery = "DELETE FROM Movie WHERE movie_id = :movieId";

            self::$db->query($deleteQuery);
            self::$db->bind(":movieId", $movieId);
            self::$db->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
        return true;
    }

    static function updateMovie($movieName, $movieRating, $movieId) {
        $updateQuery = "UPDATE Movie SET movie_name = :movieName, movie_rating = :movieRating";
        $updateQuery .= " WHERE movie_id = :movieId";

        self::$db->query($updateQuery);
        self::$db->bind(":movieName", $movieName);
        self::$db->bind(":movieRating", $movieRating);
        self::$db->bind(":movieId", $movieId);

        self::$db->execute();
        return self::$db->rowCount();
    }
}