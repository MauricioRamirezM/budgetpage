<?php 
require_once("../../settings/database.php");
require_once("../../libs/functions.php");
session_start();

class ResgisterController{
    private $conn;

    public function __construct(){
        global $mysqli;
        $this->conn = $mysqli ;
    }

    public function registerUser(){
        if($_POST){
            $name = $this->conn->real_escape_string( sanitizeinput($_POST["name"])) ;
            $userName =$this->conn->real_escape_string(sanitizeinput($_POST["username"])) ;
            $email = $this->conn->real_escape_string( sanitizeinput($_POST["email"])) ;
            $phoneNumber = $this->conn->real_escape_string(sanitizeinput($_POST["phone"])) ;
            $password = $this->conn->real_escape_string( sanitizeinput($_POST["password"])) ;
            $conf_password  =$this->conn->real_escape_string( sanitizeinput($_POST["conf_password"])) ;
            print_r($_POST);

            if(!confirmPassword($password, $conf_password) || !validatePassword($password)){
                $message = "The passwords are not correct";
                header("Location: ../../index.php?page=register&msg=$message");
                return;
            }
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "SELECT username FROM clients WHERE username = ?";
            $checkUserName = $this->conn->prepare($query); 
           
            $checkUserName->bind_param("s", $userName);
            $checkUserName->execute();
            $checkUserName->store_result();
            if($checkUserName->num_rows > 0){
                header("Location: ../../index.php?page=register&msg=userexists");
                return;
            }
            if(validateName($name) && validateUsername($userName) && validateEmail($email) && validatePassword($password)){
                $query = "INSERT INTO clients (name, username, email, phone, password) VALUES (?,?,?,?,?)";
            $statement = $this->conn->prepare($query);
            
            $statement->bind_param("sssss" , $name, $userName, $email,$phoneNumber, $hashedPassword);

            if($statement->execute()){
                
                header("Location: ../../index.php?page=login&msg=registered");
                exit();
            } 
            }else{
                $message = "The data i snot correct, please check it";
                header("Location: ../../index.php?page=register&msg=$message");
                exit();
            }
            


            
        }
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $register = new ResgisterController();
    $register->registerUser();
}
?>