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
        // header("Location: userRegister.php");
        Page::header("MoviesLists", true, "index.css");
    }

?>


<?php
    Page::footer();
?>

