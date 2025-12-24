<?php
 require("../../../../settings/database.php");
 require("../../../../libs/functions.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   

    $title = $mysqli->real_escape_string(sanitizeinput($_POST['title']));
    $description =$mysqli->real_escape_string(sanitizeinput($_POST['description']));


    $image =  $_FILES['image']['name'] ;
    $dateTime =Time();
    
    if ($image != ""){
        $newImgName = $dateTime."_".$image;
    } else{
        return;
    } 
        echo $newImgName;
    $imgPath = "../../../../assets/img/news/";
    $tmp_name = $_FILES['image']['tmp_name'];
    if($tmp_name != ""){
        move_uploaded_file($tmp_name, $imgPath.$newImgName);
    }

    $query = "INSERT INTO news (title, description, image) VALUES ( ?,?,?)";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("sss", $title, $description, $newImgName );

   if( $statement->execute()){
    $message = "Added successfully";

    header("location: index.php?msg=$message");
   }else{
    $message = "there was an error storing the data";
    header("location: index.php?msg=$message");
   }
}




 include_once("../../templates/header.php"); 
  ?>
   <div class="alert_box ">
    <div class="alert hide admin_alert " role="alert">
        <strong class="msg"></strong>
    </div>
</div>

<div class="container card_container">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <p class="h2">NEWS MAKER</p>
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data"  method="post">
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
                          <textarea class="form-control" name="description" id="description" rows="10" ></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text"
                                class="form-control" name="description" id="description" aria-describedby="helpId" placeholder="description">
                        </div> -->
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
<img src="" alt="">



<?php include("../../templates/footer.php"); ?>