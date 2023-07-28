<?php

class Movie{
    // attributes
    private $movie_id = 0;
    private $list_id = 0;
    private $movie_name ="";
    private $movie_rating = "";
    private $movie_added_date = "";

    // getters
    function getMovieId() : int{
        return $this->movie_id;
    }
    function getListId() : int{
        return $this->list_id;
    }
    function getMovieName(): string{
        return $this->movie_name;
    }
    function getMovieRating(): string {
        return $this->movie_rating;
    }
    function getMovieAddedDate(): string{
        return $this->movie_added_date;
    }

    // setters
    function setMovieName($movieName) {
        $this->movie_name = $movieName;
    }
    function setMovieRating($movieRating) {
        $this->movie_rating = $movieRating;
    }
    function setMovieAddedDate($movieAddedDate) {
        $this->movie_added_date = $movieAddedDate;
    }
}
?>