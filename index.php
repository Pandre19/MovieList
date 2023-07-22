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
        Page::header("MoviesLists", true, "index.css");
    } else {
        header("Location: userRegister.php");
        // Page::header("MoviesLists", true, "index.css");
    }

?>

        <div class="index-title-wrapper body">
            <div class="semicircle"></div>
            <div class="container">
                <h1>MoviesLists</h1>
                <p>Plan and edit your future experiences</p>
                <a href="userRegister.php" class="btn btn-success btn-lg">For Movie Lovers</a>
            </div>
        </div>

<?php
    Page::footer();
?>

