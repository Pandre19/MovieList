<?php
    require_once("inc/config.inc.php");
    require_once("inc/Entity/Page.class.php");
    require_once("inc/Entity/User.class.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/UserDAO.class.php");
    require_once("inc/Utility/LoginManager.class.php");

    session_start();

    if(LoginManager::verifyLogin()){
        // UserDAO::init();
        // $user = UserDAO::getUser($_SESSION['loggedin']);
        header("Location: index.php");
    } else {
        header("Location: userLogin.php");
    }

?>