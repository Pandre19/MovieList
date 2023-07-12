<?php
    require_once("inc/config.inc.php");
    require_once("inc/Entity/Page.class.php");
    require_once("inc/Entity/User.class.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/UserDAO.class.php");
    require_once("inc/Utility/LoginManager.class.php");
    require_once("inc/Utility/Validate.class.php");

    if(LoginManager::verifyLogin()){
        // UserDAO::init();
        // $user = UserDAO::getUser($_SESSION['loggedin']);
        header("Location: index.php");
    } 

    Page::header("Register", false);

    if(!empty($_POST)){
      $validation_errors=Validate::validateRegisterForm();
    } 

    Page::showLoginForm(Validate::$valid_status);
?>

<?php
    Page::footer();
?>