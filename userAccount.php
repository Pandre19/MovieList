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
        Page::header("MoviesLists", true, "account.css");
    } else {
        // header("Location: userRegister.php");
        Page::header("MoviesLists", true, "account.css");
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
                    <form action="" method="post">
                        <div class="form-outline mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Username" readonly
                                value="Username Testing">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="Email" readonly
                                value="Email Testing">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" readonly
                                value="Password Testing">
                        </div>
                        <div class="d-flex mb-4 button-group">
                            <button type="submit"
                                class="btn text-white btn-left">Edit</button>
                            <button type="submit"
                                class="btn text-white btn-right">Save</button>
                        </div>
                        <div class="d-flex button-group">
                            <button type="submit"
                                class="btn text-white btn-left">Log Out</button>
                            <button type="submit"
                                class="btn text-white btn-right">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php
    Page::footer();
?>