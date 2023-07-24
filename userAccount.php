<?php
    require_once("inc/config.inc.php");
    require_once("inc/Entity/Page.class.php");
    require_once("inc/Entity/User.class.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/UserDAO.class.php");
    require_once("inc/Utility/LoginManager.class.php");
    require_once("inc/Utility/Validate.class.php");

    UserDAO::init();

    $username = null;
    $email = null;
    $password = null;

    $isEditing = false;
    $validation_errors_edit_account = null;

    if(LoginManager::verifyLogin()){
        Page::header("MoviesLists", true, "account.css");

        //Get authenticated user object
        $authUser = UserDAO::getUser($_SESSION['loggedin']);
        $username = $authUser->getUsername();
        $email = $authUser->getEmail();
        $password = $authUser->getPassword();

        //Start editing
        if(isset($_GET['edit'])) {
            $isEditing = true;
        }

        //Get the edit action
        if(!empty($_POST)){

            //First we have to validate the input to update
            $validation_errors_edit_account = Validate::validateEditAccountForm();

            if(empty($validation_errors_edit_account)){
                $new_user = new User();
                $new_user->setUsername($_POST['username']);
                $new_user->setEmail($_POST['email']);
                //Check if password has been changed
                if($_POST['password'] != '' && !empty($_POST['password'])) {
                    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $new_user->setPassword($hashed_password);
                } else {
                    $new_user->setPassword($password);
                }

                try {
                    UserDAO::updateUser($new_user, $_SESSION['loggedin']);
                    $_SESSION['loggedin'] = $new_user->getUsername();
                    header("Location: userAccount.php");
                    exit();
                } catch(Exception $e) {
                    error_log($e->getMessage());
                }
                
            }
        }
    } else {
        header("Location: userLogin.php");
    }

?>
        <div class="account-wrapper body-wrapper">
            <div class="container">
                <div class="account-background">
                    <div class="account-left-side">
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="Account Image" 
                            class="account-image"> 
                        <div class="quote=wrapper">
                            <h3 class="quote">
                                "The cinema has no boundary.<br>It is a ribbon of a dream"
                            </h3>
                            <p class="author">
                                Orson Wells
                            </p>
                        </div>
                    </div>
                    <hr class="solid">
                    <div class="account-right-side">
                    <!-- Error messages -->
                    <?php echo ($isEditing == false) ?  '' : '<h2 class="mb-4 text-white">Editing Account</h2>'; ?>
                    <?php 
                        if(isset($validation_errors_edit_account) && !empty($validation_errors_edit_account)){
                            echo '<ul class="">';
                            foreach($validation_errors_edit_account as $name => $message){
                            echo "<li style='color:red;'>{$message}</li>";
                            error_log(date("Y-m-d H:i:s") . " - ERROR MESSAGE = " . $message . "\n", 3, 'log/error_log.txt');
                            }
                            error_log("\n", 3, 'log/error_log.txt');
                            echo '</ul>';
                        }
                    ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"]. "?edit=true"; ?>" method="post">
                        <!-- Form -->
                        <div class="form-outline mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Username" 
                                <?php echo ($isEditing == false) ?  'readonly' : ''; ?>
                                value=<?php echo isset($username) ?  $username : ''; ?>>
                        </div>
                        <div class="form-outline mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="Email" 
                            <?php echo ($isEditing == false) ?  'readonly' : ''; ?>
                                value=<?php echo isset($email) ?  $email : ''; ?>>
                        </div>
                        <div class="form-outline mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password"
                                <?php echo ($isEditing == false) ?  'readonly' : ''; ?>
                                value="">
                        </div>
                        <!-- Password message -->
                        <p class="mb-4 text-white">*If password empty, It will not be changed</p>
                        <?php echo ($isEditing == false) ?  '' : ''; ?>
                        <!-- Edit and Save buttons -->
                        <div class="d-flex mb-4 button-group">
                            <input type="hidden" name="action" value="edit">
                            <a type="button" href=<?php echo ($isEditing == false) ?  "userAccount.php?edit=true" : "userAccount.php"; ?>
                                <?php echo ($isEditing == false) ?  '' : 'style="background-color:#a3b18a !important;"'; ?>
                                class="btn text-white btn-left">Edit</a>
                            <button type="submit"
                                class="btn text-white btn-right"
                                <?php echo ($isEditing == false) ?  'disabled' : ''; ?>>Save</button>
                        </div>
                        <!-- Log Out and Delete Buttons -->
                        <?php echo ($isEditing == false) ?  '
                        <div class="d-flex button-group">
                            <a href="userLogout.php" type="button"
                                class="btn button text-white btn-left">Log Out</a>
                            <a type="button" class="btn button text-white btn-right" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                Delete Account
                            </a>
                        </div>
                        ' : ''; ?>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- This is a modal from bootstrap -->
        <div class="modal fade" id="deleteAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-black" id="staticBackdropLabel">Delete Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-black">
                        Are you sure you want to delete the account?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href=<?= "userDelete.php?userName=". $_SESSION['loggedin']?> type="button" class="btn btn-primary">Confirm</a>
                </div>
                </div>
            </div>
        </div>
    </div>


<?php
    Page::footer();
?>