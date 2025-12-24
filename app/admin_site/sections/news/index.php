<?php
include("../../templates/header.php");
require_once("../../../../settings/database.php");


$query = "SELECT * FROM news";
$statement = $mysqli->prepare($query);
$statement->execute();
$result =  $statement->get_result();
$news_data = $result->fetch_all(MYSQLI_ASSOC);

$imgPath = "../../../../assets/img/news/";

if (isset($_GET['id'])) {
    $new_id = $_GET['id'];
    $query = "DELETE  FROM news WHERE id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("i", $new_id);
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
            <p class="h2">NEWS</p>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news_data as $new): ?>
                        <tr>
                            <td><?php echo $new['id']; ?></td>
                            <td>
                                <img style="width: 80px;" src="<?php echo $imgPath . $new['image']; ?>" alt="">
                            </td>
                            <td><?php echo $new['title']; ?></td>
                            <td><?php echo $new['description']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $new['id']; ?>" class="btn green_btn">Edit</a>
                                <a href="index.php?id=<?= $new['id']; ?>" class="btn red_btn">Delete</a>
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


<?php include("../../templates/footer.php"); ?>