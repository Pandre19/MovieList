<?php
    require_once("inc/config.inc.php");
    require_once("inc/Entity/Page.class.php");
    require_once("inc/Entity/User.class.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/UserDAO.class.php");
    require_once("inc/Utility/LoginManager.class.php");
    require_once("inc/Utility/Validate.class.php");

    UserDAO::init();

    Page::header("Login", false);

    if(!empty($_POST)){
      $validation_errors=Validate::validateLoginForm();

        if(empty($validation_errors)){
            $username = $_POST["username"];

            //get the user object
            $authUser = UserDAO::getUser($_POST['username']);

            if($authUser && $authUser->verifyPassword($_POST['password'])){
                // start the session
                session_start();

                // set the session that the user is logged in
                $_SESSION['loggedin'] = $authUser->getUserName();
            }
        }
    } 

    if(LoginManager::verifyLogin()){
        header("Location: userLists.php");
    } 

    Page::showLoginForm(Validate::$valid_status);
?>

<?php
    Page::footer();
?>