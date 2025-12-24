<?php 
include("../../templates/header.php");
require("../../../../settings/database.php");
require("../../../../libs/functions.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
    $role_admin =$_GET['role'];
    $id_admin = $_GET['id'];

    $query = "SELECT * FROM users WHERE id = ? AND role=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("is", $id_admin,  $role_admin);
    $statement->execute();
    $result =  $statement->get_result();
    $user_info = $result->fetch_assoc();
    $id = $user_info['id'];
    $name = $user_info['name'];
    $phone = $user_info['phone'];
    $role = $user_info['role'];
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id_admin= $mysqli->real_escape_string(sanitizeinput($_POST['id']));
    $role_admin = $mysqli->real_escape_string(sanitizeinput($_POST['role']));
    $name_admin = $mysqli->real_escape_string(sanitizeinput($_POST['name']));
    $phone_admin = $mysqli->real_escape_string(sanitizeinput($_POST['phone']));

    $query = "UPDATE users SET name=?,  role=?, phone = ? WHERE id=? AND role=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("sssis", $name_admin, $role_admin, $phone_admin, $id_admin, $role_admin);
    if($statement->execute()){
        $message = "The admin was updated succesfully";
        header("Location: index.php?msg=$message");
    }
    
       
        

        
    
}
?>

<div class="container card_container mt-5">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <p class="h2">EDIT ADMIN</p>
                </div>
                <div class="card-body">
                    <form action=""  method="post">
                        <div class="form-group">
                            <label for="id">ID:</label>
                            <input value="<?=$id?>" readonly type="text"
                                class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="role">Role:</label>
                          <input value="<?=$role?>" readonly type="text"
                            class="form-control" name="role" id="role" aria-describedby="helpId" placeholder="Role">
                        </div>
                        <div class="form-group">
                          <label for="name">Name:</label>
                          <input value="<?=$name?>" type="text"
                            class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="fa icon">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input value="<?=$phone?>" type="text"
                                class="form-control" name="phone" id="phone" aria-describedby="helpId" placeholder="Enter a new title">
                        </div>
                        

                        <div class="btn_wrapper">
                            <button type="submit" class="btn green_btn">Update</button>
                            <a href="index.php" class="btn red_btn">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1">

        </div>
    </div>

</div>


<? include("../../templates/footer.php") ?>