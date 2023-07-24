<?php

class Page  {
    static function header($title, $isUserLoggedIn = true, $cssFileName = null) { ?>

        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <!-- <link rel="icon" href="../../img/favicon.ico" type="image/png"> -->
            <link rel="stylesheet" type="text/css" href="css/base.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <?php
                if($cssFileName != null){
                    echo "<link rel='stylesheet' type='text/css' href='css/{$cssFileName}'>";
                }
            ?>
            <title><?php echo $title; ?></title>
        </head>

        <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

        <!-- Reference:  https://getbootstrap.com/docs/5.3/components/navbar/-->
        <nav class="navbar fixed-top navbar-expand-lg bg-dark">
            <div class="container-md">
                <a class="navbar-brand text-white" href="index.php">MoviesList</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                    if($isUserLoggedIn){
                    ?>
                     <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="userLists.php">Lists</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link text-white" href="recommendation.php">Recommendation</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link text-white" href="userAccount.php">Account</a>
                            </li>
                        </ul>
                        </div>
                    <?php
                    } else {
                        ?>
                        <div class="collapse navbar-collapse" id="navbarNav">
                           <ul class="navbar-nav ms-auto">
                               <li class="nav-item">
                               <a class="nav-link active text-white" aria-current="page" href="userRegister.php">Register</a>
                               </li>
                               <li class="nav-item">
                               <a class="nav-link text-white" href="userLogin.php">Login</a>
                               </li>
                           </ul>
                           </div>
                       <?php
                    }
                ?>
                
            </div>
            </nav>


           
    <?php }

    static function footer()    { ?>
                    <footer class="text-center text-lg-start">
                        <div class="text-center p-3 bg-dark"> © 2020 Copyright: MoviesList </div>
                    </footer>
                </body>
            </html>
    <?php }

    static function showRegisterForm($validation_results = null) { ?>
        <section class="vh-100 bg-image body"
        style="background-image: url('https://w.wallha.com/ws/1/vRs0PSJL.jpg'); background-size: cover; background-position: center;">
            <div class="h-100 container">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="col-5">
                <div class="card shadow" style="border-radius:10px;">
                    <div class="card-body p-5">
                    <h2 class="text-center mb-5">Register</h2>
                    <?php
                        // If errors exists, then display them
                        echo '<ul class="">';
                        if(isset($_GET['userExistsError'])) {
                            echo "<li style='color:red;'>Please use other username. This username already exists</li>";
                        }
                        if(isset(Validate::$valid_status) && isset(Validate::$valid_status['errors'])){
                        if(count(Validate::$valid_status['errors']) > 0) {
                            
                            foreach(Validate::$valid_status['errors'] as $name => $message){
                            echo "<li style='color:red;'>{$message}</li>";
                            error_log(date("Y-m-d H:i:s") . " - ERROR MESSAGE = " . $message . "\n", 3, 'log/error_log.txt');
                            }
                            error_log("\n", 3, 'log/error_log.txt');
                            
                        }
                        echo '</ul>';
                        }
                    ?>
                    <form action="" method="post">
                        <div class="form-outline mb-4">
                        <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Username"
                            value=<?php echo array_key_exists('username', $validation_results) ?  (string) $validation_results['username'] : ''; ?>>
                        </div>
                        <div class="form-outline mb-4">
                        <input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="Email"
                            value=<?php echo array_key_exists('email', $validation_results) ?  (string) $validation_results['email'] : ''; ?>>
                        </div>
                        <div class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password"
                            value=<?php echo array_key_exists('email', $validation_results) ?  (string) $validation_results['email'] : ''; ?>>
                        </div>
                        <div class="form-outline mb-4">
                        <input type="password" id="repassword" name="repassword" class="form-control form-control-lg" placeholder="Confirm Password"/>
                        </div>
                        <div class="d-flex justify-content-center">
                        <button type="submit"
                            class="btn btn-btn-block btn-lg gradient-custom-4 text-white" style="background-color: #3a5a40;">Continue</button>
                        </div>
                        <p class="text-center text-muted mt-4 mb-0">Have an account? <a href="userLogin.php"
                            class="text-black">Login</a></p>
                    </form>

                    </div>
                </div>
                </div>
            </div>
            </div>

        </section>
    <?php }

    static function showLoginForm($validation_results = null) { 
        if(isset($_GET['createdUser'])) {
            echo '<script>alert("User has been created. Please login to your account.");</script>';
        }
        ?>
        <section class="vh-100 bg-image body"
        style="background-image: url('https://preview.redd.it/2jhtmqhg4mo81.png?width=1920&format=png&auto=webp&s=0d41709c3c478d2bcadfd8f2450271f175c0676f'); background-size: cover; background-position: center;">
            <div class="h-100 container">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="col-5">
                <div class="card shadow" style="border-radius:10px;">
                    <div class="card-body p-5">
                    <h2 class="text-center mb-5">Log In</h2>
                    <?php
                        // If errors exists, then display them
                        if(isset(Validate::$valid_status) && isset(Validate::$valid_status['errors'])){
                            if(count(Validate::$valid_status['errors']) > 0) {
                                echo '<ul class="">';
                                foreach(Validate::$valid_status['errors'] as $name => $message){
                                echo "<li style='color:red;'>{$message}</li>";
                                error_log(date("Y-m-d H:i:s") . " - ERROR MESSAGE = " . $message . "\n", 3, 'log/error_log.txt');
                                }
                                error_log("\n", 3, 'log/error_log.txt');
                                echo '</ul>';
                            }
                        }
                    ?>
                    <form action="" method="post">
                        <div class="form-outline mb-4">
                        <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Username"
                            value=<?php echo array_key_exists('username', $validation_results) ?  (string) $validation_results['username'] : ''; ?>>
                        </div>
                        <div class="form-outline mb-4">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password"
                            value=<?php echo array_key_exists('email', $validation_results) ?  (string) $validation_results['email'] : ''; ?>>
                        </div>
                        <div class="d-flex justify-content-center">
                        <button type="submit"
                            class="btn btn-btn-block btn-lg gradient-custom-4 text-white" style="background-color: #3a5a40;">Continue</button>
                        </div>
                        <p class="text-center text-muted mt-4 mb-0">Are you new? <a href="userRegister.php"
                            class="text-black">Register</a></p>
                    </form>

                    </div>
                </div>
                </div>
            </div>
            </div>

        </section>
    <?php }
}