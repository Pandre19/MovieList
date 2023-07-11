<?php

class Validate{

    static $valid_status=[];
    
    static function validateRegisterForm() {
        unset($valid_status);
        $errors = array();
        
        //Validate the username
        if(strlen(strip_tags($_POST['fullName']))>8) {
            self::$valid_status['fullName'] = strip_tags($_POST['fullName']);
        } else{
            self::$valid_status['fullName'] = null;
            $errors['fullName'] = 'Please enter a valid name.';
        }
        
        //Validate the email address, use filter_input    
        $filteredEmailStatus = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if($filteredEmailStatus == true) {
            self::$valid_status['email'] = $_POST['email'];
        } else {
            self::$valid_status['email'] = null;
            $errors['email'] = 'Please enter a valid email address.';
        }

       

        self::$valid_status['errors'] = $errors;
        
        return $errors;
    }

    static function validatePassword($pwd) {
        // Check if the password is 10 characters long
        if (strlen($pwd) !== 10) {
            return false;
        }
        // Check if the password contains at least one number
        if (!preg_match('/\d/', $pwd)) {
            return false;
        }
        // Check if the password contains at least one capital letter
        if (!preg_match('/[A-Z]/', $pwd)) {
            return false;
        }
    
        return true; 
    }

    static function validateLoginForm() {
        unset($valid_status);
    }

    static function validateImage(){
        unset($valid_status);
    }
}