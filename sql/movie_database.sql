DROP DATABASE IF EXISTS movie_database;
create database movie_database;
USE movie_database;

CREATE TABLE User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) Engine=InnoDB;

CREATE TABLE MovieList (
    list_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    list_name VARCHAR(255) NOT NULL,
    list_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(user_id) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB;

CREATE TABLE Movie (
    movie_id INT AUTO_INCREMENT PRIMARY KEY,
    list_id INT,
    movie_name VARCHAR(255) NOT NULL,
    movie_rating INT NOT NULL,
    movie_added_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (list_id) REFERENCES MovieList(list_id) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB;


