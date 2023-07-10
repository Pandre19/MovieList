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

    Page::header("MovieList");
    
?>

<section class="vh-100 bg-image"
  style="background-image: url('https://w.wallha.com/ws/1/vRs0PSJL.jpg'); background-size: cover; background-position: center;">
    <div class="h-100 container">
      <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="col-5">
          <div class="card shadow" style="border-radius:10px;">
            <div class="card-body p-5">
              <h2 class="text-center mb-5">Register</h2>

              <form>

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" placeholder="Username"/>
                </div>

                <div class="form-outline mb-4">
                  <input type="email" id="form3Example3cg" class="form-control form-control-lg" placeholder="Email"/>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cg" class="form-control form-control-lg" placeholder="Password"/>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4cdg" class="form-control form-control-lg" placeholder="Confirm Password"/>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have an account? <a href="#!"
                    class="fw-bold text-dark"><u>Login</u></a></p>

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