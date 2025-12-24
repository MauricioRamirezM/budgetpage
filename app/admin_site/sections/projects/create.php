<?php
 require("../../../../settings/database.php");
 require("../../../../libs/functions.php");


if($_SERVER['REQUEST_METHOD'] == 'POST'){
   

    $title = $mysqli->real_escape_string(sanitizeinput($_POST['title']));
    $description =$mysqli->real_escape_string(sanitizeinput($_POST['description']));
    $technologies = isset($_POST['technologies']) ? implode("," ,$_POST["technologies"]): "";



    $image = $_FILES['image']['name'] ;
    $dateTime =Time();
    
    if ($image != ""){
        $newImgName = $dateTime."_".$image;
    } else{
        return;
    } 
        echo $newImgName;
    $imgPath = "../../../../assets/img/projects/";
    $tmp_name = $_FILES['image']['tmp_name'];
    if($tmp_name != ""){
        move_uploaded_file($tmp_name, $imgPath.$newImgName);
    }

    $query = "INSERT INTO projects (title, description, image, technologies) VALUES ( ?,?,?,?)";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("ssss", $title, $description, $newImgName, $technologies );

   if( $statement->execute()){
    $message = "Added successfully";

    header("location: index.php?msg=$message");
    exit();
   }else{
    echo ("error");
    $message = "there was an error storing the data";
    header("location: index.php?error=$message");
    exit();
   }
}

 include("../../templates/header.php");
  ?>

<div class="container card_container mt-5">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <p class="h2">ADD PROYECT</p>
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="id">ID:</label>
                            <input readonly type="text"
                                class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text"
                                class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Enter a new title">
                        </div>
                        <div class="form-group">
                          <label for="description">Description:</label>
                          <textarea class="form-control" name="description" id="description" rows="7"></textarea>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="technologies[]" id="" value="html"> HTML 
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="technologies[]" id="" value="css"> CSS
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="technologies[]" id="" value="javascript"> Javascript
                            </label>
                        </div>
                        
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="technologies[]" id="" value="php"> PHP 
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="technologies[]" id="" value="mysql"> MySQL 
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file"
                                class="form-control" name="image" id="image" aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="btn_wrapper">
                            <button type="submit" class="btn green_btn">Add new</button>
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



<?php include("../../templates/footer.php"); ?>