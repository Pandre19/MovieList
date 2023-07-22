<?php
    require_once("inc/config.inc.php");
    require_once("inc/Entity/Page.class.php");
    require_once("inc/Entity/User.class.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/UserDAO.class.php");
    require_once("inc/Utility/LoginManager.class.php");

    if(!LoginManager::verifyLogin()){
        header("Location: login.php");
        exit();
    }

    UserDAO::init();

    try {
        UserDAO::deleteUser($_GET['userName']);

        // Destroy the session
        session_destroy();
        header("Location: userLogin.php");
        exit();
    } catch(Exception $e) {
        error_log($e->getMessage());
    }

    

?>