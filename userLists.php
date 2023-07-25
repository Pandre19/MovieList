<?php
    require_once("inc/config.inc.php");
    require_once("inc/Entity/Page.class.php");
    require_once("inc/Entity/User.class.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/UserDAO.class.php");
    require_once("inc/Utility/LoginManager.class.php");

    if(LoginManager::verifyLogin()){
        Page::header("MoviesLists", true, "lists.css");
    } else {
        header("Location: userLogin.php");
        Page::header("MoviesLists", false, "lists.css");
    }

    $dummy_data = array("title"=>"Watch List","description" => "Movies to watch later","created_at"=>"12/12/2020");
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
                    <div class="list-container">
                        <h2 class="title-list">
                             Watch List
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
                        <a href="singleList.php" class="button-list"><i class="fas fa-arrow-right"></i></a>
                    </div>
                    <div class="list-container">
                        <h2 class="title-list">
                             Watch List
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
                        <a href="singleList.php" class="button-list"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

            </div>
        </div>


        <!-- This is a modal from bootstrap. Create List Form -->
        <div class="modal fade" id="createListModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5 text-black" id="staticBackdropLabel">Create List</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-black">
                        Are you sure you want to delete the account?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href=<?= "userDelete.php?userName=". $_SESSION['loggedin']?> type="button" class="btn btn-primary">Create</a>
                </div>
                </div>
            </div>
        </div>

<?php
    Page::footer();
?>