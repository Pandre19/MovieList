<?php
    require_once("inc/config.inc.php");
    require_once("inc/Entity/Page.class.php");
    require_once("inc/Entity/User.class.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/UserDAO.class.php");
    require_once("inc/Utility/LoginManager.class.php");
    require_once("inc/Utility/Validate.class.php");

    UserDAO::init();

    if(LoginManager::verifyLogin()){
        // UserDAO::init();
        // $user = UserDAO::getUser($_SESSION['loggedin']);
        header("Location: index.php");
    } 

    Page::header("Register", false);

    if(!empty($_POST)){
      //get values
        $validation_errors=Validate::validateRegisterForm();

      if(empty($validation_errors)){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        //Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //Check if there is a user with the same username in database
        if(UserDAO::checkUserAlreadyExists($username)) {
            header("Location: userRegister.php?userExistsError=true");
            
            exit();
        }

        //finally create the user
        try {
            UserDAO::createUser($username, $email, $hashed_password);
            header("Location: userLogin.php?createdUser=true");
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
      }
      
    } 

    Page::showRegisterForm(Validate::$valid_status);
?>

<?php
    Page::footer();
?>