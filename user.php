<?php

include_once 'db-connect.php';

class User {

    private $db;
    private $db_table = "users";

    public function __construct() {
        $this->db = new DbConnect();
    }

    public function isLoginExist($username, $password) {
        $query = "SELECT * FROM ".$this->db_table."WHERE username = '$username' AND password = '$password' LIMIT 1";
        $result = mysqli_query($this->db->getDb(), $query); 
        if(mysqli_num_rows($result)>0) {
            mysqli_close($this->db->getDb());
            return true;
        }      

        mysqli_close($this->db->getDb());
        return false;
    }

    public function isUsernameEmailExist($username, $email) {
        $query = "SELECT * FROM ".$this->db_table."WHERE username = '$username' AND email = '$email' LIMIT 1";
        $result = mysqli_query($this->db->getDb(), $query);
        if(mysqli_num_rows($result)>0) {
            mysqli_close($this->db->getDb());
            return true;
        }

        mysqli_close($this->db->getDb());
        return false;
    }

    public function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function createNewRegisterUser($username, $password, $email) {

        $json = array();

        $isExisting = $this->isUsernameEmailExist($username, $password, $email);
        if($isExisting) {
            $json['success'] = 0;
            $json['message'] = "Username and Email already exist";
        }

        else {

            if($this->isValidEmail($email)) {
               $query = "INSERT INTO TABLE ".$this->db_table."(username, password, email, created_at, updated_at) VALUES ('$username', '$password', '$email', NOW(), NOW())"; 
               $inserted = mysqli_query($this->db->getDb(), $query);
               if($inserted == 1) {
                $json['success'] = 1;
                $json['message'] = "Registration successful";
               }

               else {
                $json['success'] = 0;
                $json['message'] = "Unknown error! Unable to register.";
               }

               mysqli_close($this->db->getDb());
            }

            else {
                $json['success'] = 0;
                $json['message'] = "Invalid email entered.";
            }

           
        }

        return $json;
    }

    public function loginUser($username, $password) {

        $json = array();

        $canUserLogin = $this->isLoginExist($username, $password);
        if($canUserLogin) {
            $json['success'] = 1;
            $json['message'] = "Login Success";
        }
        else {
            $json['success'] = 0;
            $json['message'] = "Login failed!";
        }
        
        return $json;
    }
}

?>