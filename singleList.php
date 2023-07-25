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
                <a type="button" class="btn button text-white btn-create-list" data-bs-toggle="modal" data-bs-target="#addMovieModal">
                    Add Movie
                </a>
                <a type="button" class="btn button text-white btn-create-list" data-bs-toggle="modal" data-bs-target="#editListModal">
                    Edit List
                </a>
                <a type="button" class="btn button text-white btn-create-list" data-bs-toggle="modal" data-bs-target="#deleteListModal">
                    Delete List
                </a>
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

    <!-- This is a modal from bootstrap. Delete List Form  -->
    <div class="modal fade" id="deleteListModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Delete List</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-black">
                    Are you sure you want to delete this list?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href=<?= "userDelete.php?userName=". $_SESSION['loggedin']?> type="button" class="btn btn-primary">Delete</a>
            </div>
            </div>
        </div>
    </div>

    <!-- This is a modal from bootstrap. Edit List Form  -->
    <div class="modal fade" id="editListModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Edit List</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-black">
                    Are you sure you want to delete this list?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href=<?= "userDelete.php?userName=". $_SESSION['loggedin']?> type="button" class="btn btn-primary">Edit</a>
            </div>
            </div>
        </div>
    </div>

    <!-- This is a modal from bootstrap. Add Movie Form  -->
    <div class="modal fade" id="addMovieModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Add Movie</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-black">
                    Are you sure you want to delete this list?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href=<?= "userDelete.php?userName=". $_SESSION['loggedin']?> type="button" class="btn btn-primary">Add</a>
            </div>
            </div>
        </div>
    </div>

<?php
Page::footer();
?>