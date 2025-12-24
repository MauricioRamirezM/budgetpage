<?php 
include_once("../../settings/database.php");
include_once("../../libs/functions.php");
header('Content-Type: application/json');

class ContactController{
    private $conn;
    
    public function __construct(){
        global $mysqli;
        $this->conn = $mysqli;
    }

    public function userContact($name, $phone, $email, $description){
        if(empty($name) || empty($phone) || empty($email) || empty($description)){
            echo json_encode([  
                'status' => 'error',
                'message' => 'All the fields are required'
            ]);
            
            exit();
        }
        if(!validateEmail($email)){
            echo json_encode([  
                'status' => 'error',
                'message' => 'The email format is incorrect'
            ]);
            
            exit();
        }
        
            $query = "INSERT INTO contact_requests (name, phone,email, message) VALUES (?,?,?,?)";
            $statement = $this->conn->prepare($query);
            $statement->bind_param('ssss', $name, $phone, $email, $description);
            if($statement->execute()){
                return true; 
            } else {
                echo json_encode([
                    "status" => 'error',
                    'message' => 'Database insertion failed'
                ]);
                exit();
            }
    }

    public function sendEmail($username, $userEmail){
        $subject = "thank you for contacting with us!";
        $emailBody = "Hello $username,\n\nThank you for reaching out! We have received your message and will get back to you soon.\n\nBest regards,\nYour Company Name";
        $headers = "From: webminds@gmail.com";
        if(empty($username) || empty($userEmail)){
            echo json_encode([  
                'status' => 'error',
                'message' => "Thank you, $username for your message. But we could not send a confirmation email"
            ]);
        }else{
            echo json_encode([  
                'status' => 'success',
                'message' => "Thank you, $username for your message. We'll get in touch soon."
            ]);
           
            exit();
        }
    

    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    return;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contact'])){
   
        $contact = new ContactController();
    $name = $mysqli->real_escape_string(sanitizeinput($_POST['name']));
    $phone = $mysqli->real_escape_string(sanitizeinput($_POST['phone']));
    $email = $mysqli->real_escape_string(sanitizeinput($_POST['email']));
    $description = $mysqli->real_escape_string(sanitizeinput($_POST['description']));

    
    if ($contact->userContact($name, $phone, $email, $description)) {
        $contact->sendEmail($name, $email);
    }
}





?>