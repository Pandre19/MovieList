<?php
require_once("inc/config.inc.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/LoginManager.class.php");

if (LoginManager::verifyLogin()) {
    // // UserDAO::init();
    // // $user = UserDAO::getUser($_SESSION['loggedin']);
    // header("Location: index.php");
    Page::header("MoviesLists", true, "singleList.css");
} else {
    // header("Location: userRegister.php");
    Page::header("MoviesLists", true, "singleList.css");
}

$dummy_data = array("title" => "Watch List", "description" => "Movies to watch later", "created_at" => "12/12/2020");
?>

<div class="lists-wrapper body-wrapper">
    <div class="container">
        <div class="title-wrapper">
            <div class="title-content-wrapper">
                <h2 class="title-page">
                    <a href="userLists.php" class="arrow-left-tag">
                        <i class="fas fa-arrow-left" class="arrow-left"></i>
                    </a> 
                    Single List
                </h2>
                <p class="description">
                    Movies to watch later Movies to watch later
                </p>
                <p class="list-text">
                    <span>Created at</span> 12/12/12
                </p>
                <p class="list-text">
                    <span>Average Rating</span> 5.6
                </p>
            </div>
            
            <div class="list-group-button">
                <button type="submit" class="btn text-white btn-create-list">Add Movie</button>
                <button type="submit" class="btn text-white btn-create-list">Edit List</button>
                <button type="submit" class="btn text-white btn-create-list">Delete List</button>
            </div>
        </div>

        <div class="movies-container">

            <div class="movie-container">
                <img src="https://cdn.pixabay.com/photo/2017/11/10/05/24/add-2935429_960_720.png" alt="Movie image">
                <h3 class="title-list">
                    Watch List
                </h3>
                <p class="description">
                    <span class="movie-container-rating">Rating:</span> 5.5
                </p>
                <div class="movie-buttons-wrapper">
                    <a class="btn button-movie-delete"><i class="fas fa-trash"></i></a>
                    <a class="btn button-movie-move" href="singleMovie.php"><i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="movie-container">
                <img src="https://cdn.pixabay.com/photo/2017/11/10/05/24/add-2935429_960_720.png" alt="Movie image">
                <h3 class="title-list">
                    Watch List
                </h3>
                <p class="description">
                    <span class="movie-container-rating">Rating:</span> 5.5
                </p>
                <div class="movie-buttons-wrapper">
                    <a class="btn button-movie-delete"><i class="fas fa-trash"></i></a>
                    <a class="btn button-movie-move" href="singleMovie.php"><i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="movie-container">
                <img src="https://cdn.pixabay.com/photo/2017/11/10/05/24/add-2935429_960_720.png" alt="Movie image">
                <h3 class="title-list">
                    Watch List
                </h3>
                <p class="description">
                    <span class="movie-container-rating">Rating:</span> 5.5
                </p>
                <div class="movie-buttons-wrapper">
                    <a class="btn button-movie-delete"><i class="fas fa-trash"></i></a>
                    <a class="btn button-movie-move" href="singleMovie.php"><i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="movie-container">
                <img src="https://cdn.pixabay.com/photo/2017/11/10/05/24/add-2935429_960_720.png" alt="Movie image">
                <h3 class="title-list">
                    Watch List
                </h3>
                <p class="description">
                    <span class="movie-container-rating">Rating:</span> 5.5
                </p>
                <div class="movie-buttons-wrapper">
                    <a class="btn button-movie-delete"><i class="fas fa-trash"></i></a>
                    <a class="btn button-movie-move" href="singleMovie.php"><i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="movie-container">
                <img src="https://cdn.pixabay.com/photo/2017/11/10/05/24/add-2935429_960_720.png" alt="Movie image">
                <h3 class="title-list">
                    Watch List
                </h3>
                <p class="description">
                    <span class="movie-container-rating">Rating:</span> 5.5
                </p>
                <div class="movie-buttons-wrapper">
                    <a class="btn button-movie-delete"><i class="fas fa-trash"></i></a>
                    <a class="btn button-movie-move" href="singleMovie.php"><i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

        </div>

    </div>
</div>

<?php
Page::footer();
?>