<?php

class Page  {
    static function header($title, $isUserLoggedIn = true) { ?>

        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
            <!-- <link rel="icon" href="../../img/favicon.ico" type="image/png"> -->
            <link rel="stylesheet" type="text/css" href="css/base.css">
            <title><?php echo $title; ?></title>
        </head>

        <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

        <!-- Reference:  https://getbootstrap.com/docs/5.3/components/navbar/-->
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-md">
                <a class="navbar-brand text-white" href="#">MoviesList</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                    if($isUserLoggedIn){
                    ?>
                     <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link text-white" href="#">Features</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link text-white" href="#">Pricing</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link text-white disabled">Disabled</a>
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
                    <footer class="bg-light text-center text-lg-start">
                        <div class="text-center p-3 bg-dark"> © 2020 Copyright: MoviesList </div>
                    </footer>
                </body>
            </html>
    <?php }

}