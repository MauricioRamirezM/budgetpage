<?php 
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "webminds");



try{
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
    if($mysqli->connect_error){
        throw new exception("Error connecting to the database" . $mysqli->connect_error);
    }
    // echo "connection successful";
} catch(throwable $error){
    echo "There was an error:" . $error->getMessage();
}

?>