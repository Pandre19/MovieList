DROP DATABASE IF EXISTS movie_database;
create database movie_database;

USE movie_database;

CREATE TABLE IF NOT EXISTS Image (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image_data LONGBLOB
);

CREATE TABLE IF NOT EXISTS User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_image_id INT,
    FOREIGN KEY (user_image_id) REFERENCES Image (image_id)
);

CREATE TABLE IF NOT EXISTS List (
    list_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(user_id)
);

CREATE TABLE IF NOT EXISTS Movie (
    movie_id INT AUTO_INCREMENT PRIMARY KEY,
    list_id INT,
    title VARCHAR(255) NOT NULL,
    rating DECIMAL(3, 1),
    release_date DATE,
    genre VARCHAR(255),
    description TEXT,
    movie_image_id INT,
    FOREIGN KEY (list_id) REFERENCES List(list_id),
    FOREIGN KEY (movie_image_id) REFERENCES Image(image_id)
);


