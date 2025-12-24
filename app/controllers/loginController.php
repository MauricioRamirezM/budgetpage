<?php 
require_once("../../libs/functions.php");
require_once("../../settings/database.php");
session_start();

class LoginController{
    private $conn;

    public function __construct(){
        global $mysqli;
        $this->conn = $mysqli ;
    }
    public function loginUser(){
        if($_POST){
            $username = $this->conn->real_escape_string(sanitizeinput($_POST['username']));
            $password = $this->conn->real_escape_string(sanitizeinput($_POST['password']));

            $query = "SELECT * FROM clients WHERE username = ?";
            $statement = $this->conn->prepare($query);
            $statement->bind_param("s", $username);
            $statement->execute();
            $result = $statement->get_result();

            if($result->num_rows == 1){
                $client = $result->fetch_assoc();
                if(password_verify($password, $client['password'])){
                    $_SESSION['client_username'] = $client['username'];
                    $_SESSION['client_id'] = $client['id'];

                    header("Location: ../../index.php?page=home");
                    exit();
                } else{
                    
                    $message = "The password or Username are not correct";
                       header("Location: ../../index.php?page=login&msg=$message");
                        return;      
                }   
            }else{
                $message = "The password or Username are not correct";
    
                header("Location: ../../index.php?page=login&msg=$message");
                exit();
            }
        }
    }
    public function loginAdmin(){
        if($_POST){
            $username = $this->conn->real_escape_string(sanitizeinput($_POST['username']));
            $password = $this->conn->real_escape_string(sanitizeinput($_POST['password']));

            $query = "SELECT * FROM users WHERE name = ?";
            $statement = $this->conn->prepare($query);
            $statement->bind_param("s", $username);
            $statement->execute();
            $result = $statement->get_result();

            if($result->num_rows == 1){
                $admin = $result->fetch_assoc();
                if(password_verify($password, $admin['password'])){
                    $_SESSION['admin_username'] = $admin['name'];
                    $_SESSION['admin_id'] = $admin['id'];
                    header("Location: ../admin_site/index.php");
                    exit();
                } else{
                    
                    $message = "The password or Username are not correct";
                    header("Location: ../../index.php?page=login&msg=$message");
                    return;      
                }   
            }else{
                $message = "The password or Username are not correct";
    
                header("Location: ../../index.php?page=login&msg=$message");
                exit();
            }
        }
    }
}

$login= new LoginController();

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['admin_box'] == "true"){
    $login->loginAdmin();
    
}else{

    $login->loginUser();
}




?>