<?php
include("../../templates/header.php");
require_once("../../../../settings/database.php");


$query = "SELECT * FROM users ";
$statement = $mysqli->prepare($query);
$statement->execute();
$result =  $statement->get_result();
$user_data = $result->fetch_all(MYSQLI_ASSOC);


if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "DELETE  FROM users WHERE id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("i", $user_id);
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
            <p class="h2">Admins</p>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user_data as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['phone']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $user['id']; ?>&role=<?= $user['role']; ?>" class="btn green_btn">Edit</a>
                                <a href="index.php?id=<?= $user['id']; ?>" class="btn red_btn">Delete</a>
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