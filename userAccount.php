<?php
    require_once("inc/config.inc.php");
    require_once("inc/Entity/Page.class.php");
    require_once("inc/Entity/User.class.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/UserDAO.class.php");
    require_once("inc/Utility/LoginManager.class.php");

    if(LoginManager::verifyLogin()){
        Page::header("MoviesLists", true, "account.css");
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
                            <a href="userLogout.php" type="submit"
                                class="btn text-white btn-left">Log Out</a>
                            <!-- <button type="submit"
                                class="btn text-white btn-right">Delete Account</button> -->
                            <a type="button" class="btn text-white btn-right" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                Delete Account
                            </a>
                        </div>
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
                    <a href=<?= "userDelete.php?userName=". $_SESSION['loggedin']?> type="button" class="btn btn-primary">Understood</a>
                </div>
                </div>
            </div>
        </div>


<?php
    Page::footer();
?>