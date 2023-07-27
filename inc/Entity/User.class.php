<?php

class User{

    // attributes
    private $user_id = 0;
    private $username ="";
    private $email = "";
    private $password = "";

    // getters
    function getId() : int{
        return $this->user_id;
    }
    function getUsername(): string{
        return $this->username;
    }
    function getEmail(): string {
        return $this->email;
    }
    function getPassword(): string{
        return $this->password;
    }

    // setters
    function setUsername($username) {
        $this->username = $username;
    }

    function setEmail ($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    //verifyPassword
    function verifyPassword(string $passwordToVerify){
        return password_verify($passwordToVerify, $this->getPassword());
    }

}

?>