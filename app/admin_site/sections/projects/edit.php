<?php 
require("../../templates/header.php");
require("../../../../settings/database.php");
require("../../../../libs/functions.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
    $project_id =$_GET['id'];

    $query = "SELECT * FROM projects WHERE id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("i", $project_id);
    $statement->execute();
    $result =  $statement->get_result();
    $project_info = $result->fetch_assoc();
    $project_id = $project_info['id'];
    $title = $project_info['title'];
    $description = $project_info['description'];
    $image = $project_info['image'] ?? "";
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $project_id = $mysqli->real_escape_string(sanitizeinput($_POST['id']));
    $title = $mysqli->real_escape_string(sanitizeinput($_POST['title']));
    $description= $mysqli->real_escape_string(sanitizeinput($_POST['description']));
    $technologies = isset($_POST['technologies']) ? implode("," ,$_POST["technologies"]): "";

    $query = "UPDATE projects SET title=?, description = ?, technologies=? WHERE id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("sssi", $title, $description, $technologies, $project_id);
    $statement->execute();

    if($_FILES['image']['name'] != "" ){

        $image = $_FILES['image']['name'] ?? "" ;
        $dateTime = time();
        $newImgName = ($image != "") ? $dateTime ."_". $image : "";
        $tmp_name = $_FILES['image']['tmp_name'];
        $imgPath = "../../../../assets/img/projects/";
        move_uploaded_file($tmp_name, $imgPath.$newImgName);

       
        $query = "SELECT image FROM projects WHERE id=?";
        $statement=$mysqli->prepare($query);
        $statement->bind_param("i", $project_id);
        $statement->execute();
        $result = $statement->get_result();
        $image_info = $result->fetch_assoc();
        $image = $image_info['image'];

        if(isset($image_info['image'])){
            if(file_exists($imgPath.$image_info['image'])){
            unlink($imgPath.$image_info['image']);
            }
        }

        $query = "UPDATE projects SET image = ? WHERE id=?";
        $statement= $mysqli->prepare($query);
        $statement->bind_param("si", $newImgName, $project_id);
        if($statement->execute()){
            $message = "Was updated succesfully";
            header("Location: index.php?msg=".$message);
        }
         
    }
}

?>

<div class="container card_container">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <p class="h2">EDIT PROYECT</p>
                </div>
                <div class="card-body">
                    <form action=""  enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="id">ID:</label>
                            <input value="<?=$project_id?>" readonly type="text"
                                class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input value="<?=$title?>" type="text"
                                class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Enter a new title">
                        </div>
                        <div class="form-group">
                          <label for="description">Description:</label>
                          <textarea class="form-control" name="description" id="description" rows="7"><?=$description?></textarea>
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
                            <img style="width: 80px;" src="../../../../assets/img/projects/<?php echo $image;?>" alt="">
                            <?php echo $image;?>
                            <input  type="file"
                                class="form-control" required name="image" id="image" aria-describedby="helpId" placeholder="">
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