<?php
    require_once("inc/config.inc.php");
    require_once("inc/Entity/Page.class.php");
    require_once("inc/Entity/User.class.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/UserDAO.class.php");
    require_once("inc/Utility/LoginManager.class.php");

    if(LoginManager::verifyLogin()){
        // // UserDAO::init();
        // // $user = UserDAO::getUser($_SESSION['loggedin']);
        // header("Location: index.php");
        Page::header("MoviesLists", true, "lists.css");
    } else {
        // header("Location: userRegister.php");
        Page::header("MoviesLists", true, "lists.css");
    }

    $dummy_data = array("title"=>"Watch List","description" => "Movies to watch later","created_at"=>"12/12/2020");
?>

        <div class="lists-wrapper body-wrapper">
            <div class="container">
                <div class="title-wrapper">
                    <h1 class="title-page">
                        Your Lists
                    </h1>
                    <button type="submit" class="btn text-white btn-create-list">Create List</button>
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
                        <a href="#" class="button-list"><i class="fas fa-arrow-right"></i></a>
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
                        <a href="#" class="button-list"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>

            </div>
        </div>

<?php
    Page::footer();
?>