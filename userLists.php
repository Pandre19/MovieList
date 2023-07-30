<?php
    require_once("inc/config.inc.php");
    require_once("inc/Entity/Page.class.php");
    require_once("inc/Entity/User.class.php");
    require_once("inc/Entity/MovieList.class.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/UserDAO.class.php");
    require_once("inc/Utility/MovieListDAO.class.php");
    require_once("inc/Utility/LoginManager.class.php");
    require_once("inc/Utility/Validate.class.php");

    UserDAO::init();
    MovieListDAO::init();

    $MovieListsArray = null;

    if(LoginManager::verifyLogin()){
        Page::showHeader("MoviesLists", true, "lists.css");

        $authUser = UserDAO::getUser($_SESSION['loggedin']);

        if(!empty($_POST)){
            if($_POST['action'] == 'createList'){
               //get values and errors
                $validation_errors=Validate::validateCreateListForm();
        
                if(empty($validation_errors)){
                    //Get Attributes
                    $user_id = $authUser->getId();
                    $list_name = $_POST['list_name'];
                    $list_description = $_POST['list_description'];

                    //Create List
                    MovieListDAO::createList($user_id, $list_name, $list_description);
                } 
            }
          }
        
        $MovieListsArray = MovieListDAO::getLists($authUser->getId());

    } else {
        header("Location: userLogin.php");
        Page::showHeader("MoviesLists", false, "lists.css");
    }
?>

        <div class="lists-wrapper body-wrapper">
            <div class="container">
                <div class="title-wrapper">
                    <h1 class="title-page">
                        Your Lists
                    </h1>
                    <a type="button" class="btn button text-white btn-create-list" data-bs-toggle="modal" data-bs-target="#createListModal">
                        Create List
                    </a>
                </div>
                
                <div class="lists-container">
                    <?php
                    //Displaying the lists
                        if(isset($MovieListsArray)) {
                            if(count($MovieListsArray) == 0) {
                                echo "<h3> 
                                        Please add a new List
                                    </h3>";
                            } else {
                                foreach($MovieListsArray as $List){
                                    echo '<div class="list-container">';
                                    echo "<h2 class='title-list'>
                                                {$List->getListName()}
                                        </h2>";
                                    echo "<p class='description'> 
                                            {$List->getListDescription()}
                                        </p>";
                                    //Formatting the Creation date
                                    $dateTimeObj = new DateTime($List->getCreatedAt());
                                    $formattedDate = $dateTimeObj->format('m/d/y');
                                    echo "<p class='list-text'>
                                            <span>Created: </span> {$formattedDate}
                                        </p>";
                                    // echo "<p class='list-text'>
                                    //         <span>Average Rating</span> 5.6
                                    //     </p>";
                                    echo "<a href='singleList.php?listId={$List->getListId()}' class='button-list'><i class='fas fa-arrow-right'></i></a>
                                        </div>";
                                }
                            }
                            
                        } 
                    ?>
                </div>

            </div>
        </div>


        <!-- This is a modal from bootstrap. Create List Form -->
        <div class="modal fade" id="createListModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title fs-5 text-black" id="staticBackdropLabel">Create List</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php Page::showCreateListForm(Validate::$valid_status); ?>
                    </div>
                </div>
            </div>
        </div>

<?php
    Page::footer();
?>