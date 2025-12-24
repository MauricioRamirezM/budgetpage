<?php 
include("../../templates/header.php");
require("../../../../settings/database.php");
require("../../../../libs/functions.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
    $id_service =$_GET['id'];

    $query = "SELECT * FROM services WHERE id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("i", $id_service);
    $statement->execute();
    $result =  $statement->get_result();
    $service_info = $result->fetch_assoc();
        $id = $service_info['id'];
        $title = $service_info['title'];
        $description = $service_info['description'];
        $icon = $service_info['icone'];
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $service_id = $mysqli->real_escape_string(sanitizeinput($_POST['id']));
    $icon = $mysqli->real_escape_string(sanitizeinput($_POST['icon']));
    $title = $mysqli->real_escape_string(sanitizeinput($_POST['title']));
    $description= $mysqli->real_escape_string(sanitizeinput($_POST['description']));

    $query = "UPDATE services SET icone=?,  title=?, description = ? WHERE id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("sssi", $icon, $title, $description, $service_id);
    
        if($statement->execute()){
            $message = "Was updated succesfully";
            header("Location: index.php?msg=".$message);
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
                    <p class="h2">EDIT SERVICE</p>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="id">ID:</label>
                            <input value="<?=$id?>" readonly type="text"
                                class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="icon">Icon:</label>
                          <input value="<?=$icon?>" type="text"
                            class="form-control" name="icon" id="icon" aria-describedby="helpId" placeholder="fa icon">
                        </div>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input value="<?=$title?>" type="text"
                                class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Enter a new title">
                        </div>
                        <div class="form-group">
                          <label for="description">Description:</label>
                          <textarea class="form-control" name="description" id="description" rows="8"><?=$description?></textarea>
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
<?php require("../../templates/footer.php");?>