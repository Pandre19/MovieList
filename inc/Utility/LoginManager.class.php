<?php

class LoginManager  {

    static function verifyLogin()   {
        if(session_id() == '' && !isset($_SESSION)){
            session_start();
        }

        if(isset($_SESSION['loggedin'])){
            return true;
        }
        else{
            session_destroy();
            return false;
        }
    }
        
}

?>