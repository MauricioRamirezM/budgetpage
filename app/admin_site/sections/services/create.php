<?php

require("../../../../settings/database.php");
 require("../../../../libs/functions.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   

    $icon = $mysqli->real_escape_string(sanitizeinput($_POST['icon']));
    $title = $mysqli->real_escape_string(sanitizeinput($_POST['title']));
    $description =$mysqli->real_escape_string(sanitizeinput($_POST['description']));


    $query = "INSERT INTO services (icone, title, description) VALUES (?,?,?)";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("sss", $icon, $title, $description );

   if( $statement->execute()){
    $message = "Added successfully";
    header("location: index.php?msg=$message");
   }else{
    $message = "there was an error storing the data";
    header("location: index.php?msg=$message");
   }
}



 require("../../templates/header.php"); 
 
 ?>

<div class="container card_container">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <p class="h2">CREATE SERVICE</p>
                </div>
                <div class="card-body">
                    <form action=""  enctype="multipart/form-data"  method="post">
                        <div class="form-group">
                            <label for="id">ID:</label>
                            <input readonly type="text"
                                class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                          <label for="icon">Icon:</label>
                          <input type="text"
                            class="form-control" name="icon" id="icon" aria-describedby="helpId" placeholder="fa icon">
                        </div>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text"
                                class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Enter a new title">
                        </div>
                        <div class="form-group">
                          <label for="description">Description:</label>
                          <textarea class="form-control" name="description" id="description" rows="8"></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text"
                                class="form-control" name="description" id="description" aria-describedby="helpId" placeholder="description">
                        </div> -->

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



<?php require("../../templates/footer.php"); ?>