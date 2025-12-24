<?php 
function sanitizeinput($input){
    return htmlspecialchars(trim($input));
}

function validateName($name){
    return preg_match("/[a-zA-Z]{4,}$/", $name);
}
function validateUsername($userName){
    return preg_match("/^([a-zA-z]{4,}[0-9_]*)$/",$userName);
       
}

function validateEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validateRol($rol){
    return in_array($rol, ['admin', 'user']);
}

function validatePassword($password){
        return preg_match("/[a-zA-Z0-9]{8,}$/", $password) ;
        
}
function confirmPassword ($pass1, $pass2){
        return $pass1 === $pass2 ;
}
function validateDates($appoinmentDate){
    $max_hours = 72;

    $currentDateTime = new DateTime();

    $reservationDateTime = new DateTime($appoinmentDate);

    $difference = $currentDateTime->diff($reservationDateTime);

    // Convert the difference to total hours
    $totalHours = ($difference->days * 24) + $difference->h;

    if ($totalHours >= $max_hours) {
        return true; 
    } else {

        return false; 
    }
}




?>