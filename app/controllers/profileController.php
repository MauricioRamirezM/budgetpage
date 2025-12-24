<?php 
header('Content-Type: application/json');
require_once("../../libs/functions.php");
require_once("../../settings/database.php");
session_start();
class ProfileController{
    private $conn;
    private $username;

    public function __construct(){
        global $mysqli;
        $this->conn = $mysqli;
       
        $this->username = $_SESSION['client_username'];
    }

    public function getUserInfo(){
            $query  = "SELECT name, username, email, phone  FROM clients WHERE username =?";
            $statement = $this->conn->prepare($query);
            $statement->bind_param('s', $this->username);
            if ($statement->execute()) {
                $result = $statement->get_result();
                $client = $result->fetch_assoc();

                if ($client) {
                    echo json_encode([
                        'status' => 'success',
                        'data' => $client
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'User not found'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to execute query'
                ]);
            }
            

        

    }
    private function verifyPassword($password1){
        $query = "SELECT password FROM clients WHERE username = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param('s', $this->username);
        if($statement->execute()){
            $result = $statement->get_result();
            $client = $result->fetch_assoc();
            if($client && password_verify($password1, $client['password'])){
                return true;
            }
        }
    }
    public function updatePassword($currentPassword, $newPassword){ 
    
        if($this->verifyPassword($currentPassword)){ 
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE clients SET password = ? WHERE username = ?";
            $statement  = $this->conn->prepare($query);
            $statement->bind_param('ss', $newHashedPassword,$this->username);
            if($statement->execute()){
                if($statement->affected_rows >0){
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'The password was updated successfully'
                    ]);

                }else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'The new password must be different from the current one'
                    ]);
                }
            }    else{
                echo json_encode([
                    'status' => 'erro',
                    'message' => 'Error  updating the password'
                ]);
            }
        } else{
            echo json_encode([
                'status' => 'error',
                'message' => 'The password is not conrrect'
            ]);
        }
    
    }

    public function UpadateInfo($name, $username, $email, $phone, $password  ="", $newPassword = "", $conf_password=""){
        if(!empty($password)){
            if(!$this->verifyPassword($password) || $newPassword !== $conf_password){
                echo json_encode([
                    'status' => 'error',
                    'message' => 'The password is not conrrect'
                ]);
                return;
            }
            
        }
        $query = "UPDATE clients SET name=?, username = ?, email =?, phone =?";
        if(!empty($newPassword)){
            $query .= ", password = ?";
        }
        $query .= " WHERE username = ?";

        $statement = $this->conn->prepare($query);

        if(!empty($newPassword)){
            

            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $statement->bind_param("ssssss", $name, $username, $email, $phone, $newHashedPassword, $this->username );
        }else{
            $statement->bind_param("sssss", $name, $username, $email, $phone, $this->username);
        }
        if($statement->execute()){
            if($statement->affected_rows > 0){

                echo json_encode([
                    'status' => 'success',
                    'message' => 'The information was updated successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'No changes were made.'
                ]);
            }
            
        }else{
            echo json_encode([
                'status' => 'error',
                'message' => 'Error updating the information'
            ]);
        }



    }

    
            
}

class Apoinments{
    private $conn;
    private $username;
    private $client_id;

    public function __construct(){
        global $mysqli;
        $this->conn = $mysqli;
        if(!isset($_SESSION['client_username'])){
            throw NEW Exception("User is not logged in");
        }
        $this->username = $_SESSION['client_username'];
        $this->client_id = $_SESSION['client_id'];
    }

    public function makeAppoinment($title, $date, $description){
        $query = "INSERT INTO reservations (client_id, title, date, description )VALUES (?,?,?,?) ";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("isss", $this->client_id, $title, $date, $description);
        if($statement->execute()){
            echo json_encode([
                'status' => 'success',
                'message' => 'The appointment was successfully made.',
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'There was a problem. Please try again.',
            ]);
        }
    }

    public function getAppoinments(){
        $query = "SELECT * FROM reservations WHERE client_id =?";
        $statement=$this->conn->prepare($query);
        $statement->bind_param("s", $this->client_id);
        if($statement->execute()){
            $result = $statement->get_result();
            $appoinments = [];
            while( $row = $result->fetch_assoc()){
                $appoinments[]  = $row;
            }
            if(!empty($appoinments)){
                echo json_encode([
                    'status'=>'success',
                    'data' => $appoinments
                ]);
            
            }else{
                echo json_encode([
                    'status' => 'error',
                    'message' => 'There are not pending appointments '
                ]);
            }
        }

    }

    public function returnAppoinmet($id){

       
        $query = "SELECT * FROM reservations WHERE id = ? AND client_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("ii", $id, $this->client_id);
        if($statement->execute()){
            $result = $statement->get_result();
            $appo = $result->fetch_assoc();
            if(validateDates($appo['date'])){
                echo json_encode([
                    'status' => 'success',
                    'data' => $appo
                   ]) ;
             }else{
                echo json_encode([
                    'status' =>'error',
                    'data' => 'You can only modify the appointment at least 72 hours before'
                   ]) ;
             }
            
        }else{
            echo json_encode([
                'status' =>'error',
                'message' => 'was a problem executing the query'
               ]) ;
        }
       
        

       
    }
    public function updateAppoinment($id, $newDate){

        $query = "SELECT * FROM reservations WHERE id = ? AND client_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("ii", $id, $this->client_id);
        $statement->execute();
            $result = $statement->get_result();
            $appo = $result->fetch_assoc();
       
        $query = "UPDATE  reservations SET date = ? WHERE id= ? AND client_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param('sii', $newDate, $id, $this->client_id );
        if($statement->execute()){
            if($statement->affected_rows > 0){

                echo json_encode([
                    'status' => 'success',
                    'message' => 'The appoinment was updated successfully'
                ]);
            }
        }else{
            echo json_encode([
                'status' => 'error',
                'message' => 'Error updating th eappoinment'
            ]);
        }
    }
    public function deleteAppoinment($id){
        $query = "DELETE   FROM reservations WHERE id = ? AND client_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("ii", $id, $this->client_id);
        if($statement->execute()){
                echo json_encode([
                    'status' => 'success',
                    'message' => 'The appoinment was deleted'
                ]);
        }else{  
            echo json_encode([
                'status' => 'error',
                'message' => 'something went wrong executing the query'
            ]);
        }

    }

    
}
            
      
if(!isset($_SESSION['client_username'])){
    return;
}else{
    $appo = new Apoinments();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){   
   
    
    
    if(isset($_POST['id']) && $_POST['id'] === ""){
        $title =sanitizeinput( $_POST['title']);
        $date = sanitizeinput($_POST['date']);
        $description =sanitizeinput( $_POST['description']);
        $appo->makeAppoinment($title, $date, $description);
    
        
    }
    if( isset($_POST['id']) && isset($_POST['date']) && $_POST['id'] !== ""){
        $id = sanitizeinput($_POST['id']);
        $newDate = sanitizeinput($_POST['date']);
        $appo->updateAppoinment($id, $newDate);
    }
    if(isset($_POST['username'])){
        $name = sanitizeinput($_POST['name']);
        $username = sanitizeinput($_POST['username']);
        $email = sanitizeinput($_POST['email']);
        $phone= sanitizeinput($_POST['phone']);
        $crr_password = sanitizeinput($_POST['crr_password']);
        $new_password = sanitizeinput($_POST['new_password']);
        $conf_password = sanitizeinput($_POST['conf_password']);
        $userinfo = new ProfileController();
        $userinfo->UpadateInfo($name, $username, $email, $phone, $crr_password, $new_password, $conf_password);

    }
}


    

if($_SERVER['REQUEST_METHOD'] === 'GET' ){

    if( isset($_GET['action']) && $_GET['action'] == "fetch" ) $appo->getAppoinments();
    if( isset($_GET['action']) && $_GET['action'] == "edit")$appo->returnAppoinmet($_GET['id']);
    if( isset($_GET['action']) && $_GET['action'] == "delete")$appo->deleteAppoinment($_GET['id']);
    if(isset($_GET['userinfo'])){
        $user = new ProfileController();
        $user->getUserInfo();
    }

    
    
   
   
   
    
}


    
 





?>