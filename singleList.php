<?php
require_once("inc/config.inc.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/MovieList.class.php");
require_once("inc/Entity/Movie.class.php");
require_once("inc/Utility/PDOAgent.class.php");
require_once("inc/Utility/UserDAO.class.php");
require_once("inc/Utility/MovieListDAO.class.php");
require_once("inc/Utility/MovieDAO.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Validate.class.php");

UserDAO::init();
MovieListDAO::init();
MovieDAO::init();

$singleList = null;
$moviesArray = null;

if (LoginManager::verifyLogin()) {
    Page::header("MoviesLists", true, "singleList.css");

    //GET the movies array from the database
    $moviesArray = MovieDAO::getMovies($_GET['listId']);

    if(isset($_GET['listId'])) {
        $singleList = MovieListDAO::getList($_GET['listId']);
    } 
    if(isset($_GET['deleteMovie'])) {
        MovieDAO::deleteMovie($_GET['deleteMovie']);
        header("Location: ".$_SERVER['PHP_SELF'] . "?listId=" . $_GET['listId']);
    }

    if(!empty($_POST)){
        //Delete List
        if($_POST['action'] == 'deleteList'){
            MovieListDAO::deleteList($_GET['listId']);
            header("Location: userLists.php");
        //Edit List
        } else if($_POST['action'] == 'editList'){
            $validation_errors=Validate::validateCreateListForm();
            if(empty($validation_errors)){
                MovieListDAO::updateList($_POST['list_name'], $_POST['list_description'], $_GET['listId']);
                header("Location: ".$_SERVER['PHP_SELF'] . "?listId=" . $_GET['listId']);
                exit;
            } 
        //Add Movie
        } else if($_POST['action'] == 'addMovie'){
            $validation_errors=Validate::validateAddMovieForm();
            if(empty($validation_errors)){
                MovieDAO::createMovie($_GET['listId'], $_POST['movie_name'], $_POST['movie_rating']);
                header("Location: ".$_SERVER['PHP_SELF'] . "?listId=" . $_GET['listId']);
                exit;
            } 
        } 
    }

} else {
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
                    <?= $singleList->getListName() ?>
                </h2>
                <p class="description">
                <?= $singleList->getListDescription() ?>
                </p>
                <p class="list-text">
                    <?php
                        $dateTimeObj = new DateTime($singleList->getCreatedAt());
                        $formattedDate = $dateTimeObj->format('m/d/y');
                        echo "<span>Created: </span> {$formattedDate}";
                    ?>
                </p>
                <p class="list-text">
                    <span>Average Rating: </span> 
                    <?php
                        //Calculate Average Rating from all the movies rating
                        $average_rating = 0;
                        foreach($moviesArray as $Movie){
                            $average_rating += number_format(intval($Movie->getMovieRating()), 1);
                        }
                        $average_rating = $average_rating / count($moviesArray);
                        echo $average_rating;
                    ?>
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
            <?php
                //Displaying the movies
                if(isset($moviesArray)) {
                    if(count($moviesArray) == 0) {
                        echo "<h3> 
                                Please add a new Movie
                            </h3>";
                    } else {
                        foreach($moviesArray as $Movie){
                            echo '<div class="movie-container">';
                            echo "<h3 class='title-list'>
                                    {$Movie->getMovieName()}
                                </h3>";
                            echo "<p class='description'>
                                    <span class='movie-container-rating'>Rating:</span> {$Movie->getMovieRating()}
                                </p>";
                            //Formatting the Creation date
                            $dateTimeObj = new DateTime($Movie->getMovieAddedDate());
                            $formattedDate = $dateTimeObj->format('m/d/y');
                            echo "<p class='description mb-4'>
                                    <span class='movie-container-rating'>Added Date:</span> {$formattedDate}
                                </p>";
                            echo "<div class='movie-buttons-wrapper'>
                                <a href='singleList.php?listId={$_GET['listId']}&deleteMovie={$Movie->getMovieId()}' class='btn button-movie-delete'><i class='fas fa-trash'></i></a>
                                <a class='btn button-movie-move' href='singleMovie.php'><i class='fas fa-edit'></i></a>
                            </div></div>";
                        }
                    }
                } 
            ?>
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
                <form action="" method="post">
                    <input type="hidden" name="action" value="deleteList">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </form>
                
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
                    <?php Page::showEditListForm($singleList->getListName(), $singleList->getListDescription()); ?>
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
                    <?php Page::showAddMovieForm(); ?>
                </div>
            </div>
        </div>
    </div>

<?php
Page::footer();
?>