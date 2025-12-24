<?php
 include("../../templates/header.php");
 require_once("../../../../settings/database.php");


 $query = "SELECT * FROM projects";
 $statement = $mysqli->prepare($query);
 $statement->execute();
 $result =  $statement->get_result();
 $projects_data = $result->fetch_all( MYSQLI_ASSOC) ;

 $imgPath = "../../../../assets/img/projects/";

 if(isset($_GET['id'] )){
        $project_id = $_GET['id'];
        $query = "DELETE  FROM news WHERE id=?";
        $statement=$mysqli->prepare($query);
        $statement->bind_param("i", $project_id);
        $statement->execute();
    }
 
?>

<div class="container card_container">
<div class="alert_box ">
        <div class="alert hide admin_alert " role="alert">
            <strong class="msg"></strong>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <p class="h2">PROYECTS</p>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Technologies</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($projects_data as $project): ?>
                        <tr>
                            <td><?php echo $project['id'];?></td>
                            <td>
                            <img style="width: 80px;" src="<?php echo $imgPath.$project['image']; ?>" alt="">
                            </td>
                            <td><?php echo $project['title'];?></td>
                            <td><?php echo $project['description'];?></td>
                            <td><?php echo $project['technologies'];?></td>
                            <td>
                                <a href="edit.php?id=<?= $project['id'];?>" class="btn green_btn">Edit</a>
                                <a href="index.php?id=<?= $project['id'];?>" class="btn red_btn">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            <a href="create.php" class="btn blue_btn">Add a new</a>
        </div>
    </div>
</div>


<?php require("../../templates/footer.php");?>