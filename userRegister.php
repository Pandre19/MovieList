<?php
    require_once("inc/config.inc.php");
    require_once("inc/Entity/Page.class.php");
    require_once("inc/Entity/User.class.php");
    require_once("inc/Utility/PDOAgent.class.php");
    require_once("inc/Utility/UserDAO.class.php");
    require_once("inc/Utility/LoginManager.class.php");

    if(LoginManager::verifyLogin()){
        // UserDAO::init();
        // $user = UserDAO::getUser($_SESSION['loggedin']);
        header("Location: index.php");
    } 

    if(!empty($_POST)){
      $validation_results=Validate::validateRegisterForm();
      if(5 > 0){
          foreach(Validate::$valid_status['errors'] as $name => $message) {
              error_log(date("Y-m-d H:i:s") . " - ERROR MESSAGE = " . $message . "\n", 3, 'log/error_log.txt');
          }
          error_log("\n", 3, 'log/error_log.txt');
      } else {
      }
  } 

    Page::header("MovieList", false);
?>

<section class="vh-100 bg-image"
  style="background-image: url('https://w.wallha.com/ws/1/vRs0PSJL.jpg'); background-size: cover; background-position: center;">
    <div class="h-100 container">
      <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="col-5">
          <div class="card shadow" style="border-radius:10px;">
            <div class="card-body p-5">
              <h2 class="text-center mb-5">Register</h2>

              <?php
                // If errors exists, then display them
              ?>
              <!-- Errors display -->
              <ul class="">

              </ul>

              <form action="" method="post">

                <div class="form-outline mb-4">
                  <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Username"/>
                </div>

                <div class="form-outline mb-4">
                  <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email"/>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password"/>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="repassword" name="repassword" class="form-control form-control-lg" placeholder="Confirm Password"/>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit"
                    class="btn btn-btn-block btn-lg gradient-custom-4 text-white" style="background-color: #3a5a40;">Continue</button>
                </div>

                <p class="text-center text-muted mt-4 mb-0">Have an account? <a href="#!"
                    class="text-black">Login</a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

</section>


<?php
    Page::footer();
?>