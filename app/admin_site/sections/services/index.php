<?php
 include("../../templates/header.php");
 require_once("../../../../settings/database.php");
 $imgPath = "../../../../assets/img/news/";

 $query = "SELECT * FROM services";
 $statement = $mysqli->prepare($query);
 $statement->execute();
 $result =  $statement->get_result();
 $service_data = $result->fetch_all( MYSQLI_ASSOC) ;

   
 if(isset($_GET['id'] )){
    $service_id = $_GET['id'];
    $query = "DELETE  FROM services WHERE id=?";
 $statement=$mysqli->prepare($query);
 $statement->bind_param("i", $service_id);
 $statement->execute();
 }
 
   
 
?>

<div class="container card_container mt-5">
<div class="alert_box ">
        <div class="alert hide admin_alert " role="alert">
            <strong class="msg"></strong>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <p class="h2">SERVICES</p>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($service_data as $service):?>
                    <tr>
                        <td><?php echo $service['id'];?></td>
                        <td><?php echo $service['icone'];?></td>
                        <td><?php echo $service['title'];?></td>
                        <td><?php echo $service['description'];?></td>
                        <td>
                            <a href="edit.php?id=<?=$service['id'];?>" class="btn green_btn">Edit</a>
                            <a href="index.php?id=<?=$service['id'];?>" class="btn red_btn">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            <a href="create.php" class="btn blue_btn">Add a new</a>
        </div>
    </div>
</div>


<?php require("../../templates/footer.php");?>