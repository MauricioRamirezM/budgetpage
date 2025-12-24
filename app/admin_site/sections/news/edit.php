<?php 
require("../../templates/header.php");
require("../../../../settings/database.php");
require("../../../../libs/functions.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
    $id_new =$_GET['id'];

    $query = "SELECT * FROM news WHERE id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("i", $id_new);
    $statement->execute();
    $result =  $statement->get_result();
    $new_info = $result->fetch_assoc();
        $id = $new_info['id'];
        $title = $new_info['title'];
        $description = $new_info['description'];
        $image_get = $new_info['image'];
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $new_id = $mysqli->real_escape_string(sanitizeinput($_POST['id']));
    $title = $mysqli->real_escape_string(sanitizeinput($_POST['title']));
    $description= $mysqli->real_escape_string(sanitizeinput($_POST['description']));

    $query = "UPDATE news SET title=?, description = ? WHERE id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("ssi", $title, $description, $new_id);
    $statement->execute();

    if($_FILES['image']['name'] != ""){

        $image = $_FILES['image']['name'] ;
        $dateTime = time();
        $newImgName = ($image != "") ? $dateTime ."_". $image : "";
        $tmp_name = $_FILES['image']['tmp_name'];
        $imgPath = "../../../../assets/img/news/";
        move_uploaded_file($tmp_name, $imgPath.$newImgName);

       
        $query = "SELECT image FROM news WHERE id=?";
        $statement=$mysqli->prepare($query);
        $statement->bind_param("i", $new_id);
        $statement->execute();
        $result = $statement->get_result();
        $image_info = $result->fetch_assoc();

        if(isset($image_info['image'])){
            if(file_exists($imgPath.$image_info['image'])){
            unlink($imgPath.$image_info['image']);
            }
        }

        $query = "UPDATE news SET image = ? WHERE id=?";
        $statement= $mysqli->prepare($query);
        $statement->bind_param("si", $newImgName, $new_id);
        if($statement->execute()){
            $message = "Was updated succesfully";
            header("Location: index.php?msg=".$message);
        }
       
        

        
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
                    <p class="h2">EDIT NEW</p>
                </div>
                <div class="card-body">
                    <form action=""  enctype="multipart/form-data"method="post">
                        <div class="form-group">
                            <label for="id">ID:</label>
                            <input value="<?=$id?>" readonly type="text"
                                class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input value="<?=$title?>"  type="text"
                                class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Enter a new title">
                        </div>
                        <div class="form-group">
                          <label for="description">Description:</label>
                          <textarea class="form-control" name="description" id="description" rows="10"><?=$description?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <img style="width: 80px;" src="../../../../assets/img/news/<?php echo $image_get;?>" alt="">
                            <?php echo $image_get;?>
                            <input required  type="file"
                                class="form-control" name="image" id="image" aria-describedby="helpId" placeholder="">
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