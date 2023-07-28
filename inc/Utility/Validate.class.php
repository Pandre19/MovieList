<?php

class Validate{

    static $valid_status=[];
    
    static function validateRegisterForm() {
        unset($valid_status);
        $errors = array();
        
        //Validate the username
        if(strlen(strip_tags($_POST['username'])) >= 8) {
            self::$valid_status['username'] = strip_tags($_POST['username']);
        } else{
            self::$valid_status['username'] = null;
            $errors['username'] = 'Username must be 8 characters long';
        }
        
        //Validate the email address, use filter_input    
        $filteredEmailStatus = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if($filteredEmailStatus == true) {
            self::$valid_status['email'] = $_POST['email'];
        } else {
            self::$valid_status['email'] = null;
            $errors['email'] = 'Please enter a valid email address.';
        }

        function validatePassword($pwd) {
            // Check if the password is 10 characters long
            if (strlen($pwd) < 10) {
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
        $filterPasswordStatus = filter_input(INPUT_POST, 'password', FILTER_CALLBACK, ['options' => 'validatePassword']);
        if($filterPasswordStatus == true) {
            if($_POST['password'] == $_POST['repassword']){
                self::$valid_status['password'] = $_POST['password'];
                self::$valid_status['repassword'] = $_POST['repassword'];
            } else {
                self::$valid_status['password'] = $_POST['password'];
                self::$valid_status['repassword'] = null;
                $errors['password'] = 'Please confirm your password';
            }
        } else {
            self::$valid_status['password'] = null;
            self::$valid_status['repassword'] = null;
            $errors['password'] = 'Password must be 10 characteres long, contain at least 1 number and 1 capital letter';
        }
        
        self::$valid_status['errors'] = $errors;
        
        return $errors;
    }

    static function validateLoginForm() {
        unset($valid_status);
        $errors = array();
        
        //Validate the username
        if(strlen(strip_tags($_POST['username'])) >= 8) {
            self::$valid_status['username'] = strip_tags($_POST['username']);
        } else{
            self::$valid_status['username'] = null;
            $errors['username'] = 'Username must be 8 characters long';
        }

        function validatePasswordLogin($pwd) {
            // Check if the password is 10 characters long
            if (strlen($pwd) < 10) {
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
        $filterPasswordStatus = filter_input(INPUT_POST, 'password', FILTER_CALLBACK, ['options' => 'validatePasswordLogin']);
        if($filterPasswordStatus == true) {
           self::$valid_status['password'] = $_POST['password'];
        } else {
            self::$valid_status['password'] = null;
            $errors['password'] = 'Password must be 10 characteres long, contain at least 1 number and 1 capital letter';
        }
        
        self::$valid_status['errors'] = $errors;
        
        return $errors;
    }

    static function validateEditAccountForm() {
        unset($valid_status);
        $errors = array();
        
        //Validate the username
        if(strlen(strip_tags($_POST['username'])) >= 8) {
            self::$valid_status['username'] = strip_tags($_POST['username']);
        } else{
            self::$valid_status['username'] = null;
            $errors['username'] = 'Username must be 8 characters long';
        }
        
        //Validate the email address, use filter_input    
        $filteredEmailStatus = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if($filteredEmailStatus == true) {
            self::$valid_status['email'] = $_POST['email'];
        } else {
            self::$valid_status['email'] = null;
            $errors['email'] = 'Please enter a valid email address.';
        }

        function validatePasswordEditAccount($pwd) {
            // Check if the password is 10 characters long
            if (strlen($pwd) < 10) {
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

        if($_POST['password'] != '' && !empty($_POST['password'])) {
            $filterPasswordStatus = filter_input(INPUT_POST, 'password', FILTER_CALLBACK, ['options' => 'validatePasswordEditAccount']);
            if($filterPasswordStatus == true) {
                self::$valid_status['password'] = $_POST['password'];
            } else {
                self::$valid_status['password'] = null;
                $errors['password'] = 'Password must be 10 characteres long, contain at least 1 number and 1 capital letter';
            }
        }
        
        self::$valid_status['errors'] = $errors;
        
        return $errors;
    }

    static function validateCreateListForm() {
        unset($valid_status);
        $errors = array();
        
        //Validate the list name
        if(strlen(strip_tags($_POST['list_name'])) >= 1) {
            self::$valid_status['list_name'] = strip_tags($_POST['list_name']);
        } else{
            self::$valid_status['list_name'] = null;
            $errors['list_name'] = 'List Name is required.';
        }

        //Validate the list description
        if(strlen(strip_tags($_POST['list_description'])) >= 1) {
            self::$valid_status['list_description'] = strip_tags($_POST['list_description']);
        } else{
            self::$valid_status['list_description'] = null;
            $errors['list_description'] = 'List Description is required.';
        }


        self::$valid_status['errors'] = $errors;
        
        return $errors;
    }

    static function validateAddMovieForm() {
        unset($valid_status);
        $errors = array();
        
        //Validate the Movie name
        if(strlen(strip_tags($_POST['movie_name'])) >= 1) {
            self::$valid_status['movie_name'] = strip_tags($_POST['movie_name']);
        } else{
            self::$valid_status['movie_name'] = null;
            $errors['movie_name'] = 'Movie Name is required.';
        }

        self::$valid_status['errors'] = $errors;
        
        return $errors;
    }
}