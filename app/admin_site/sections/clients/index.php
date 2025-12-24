<?php
include("../../templates/header.php");
require_once("../../../../settings/database.php");


$query = "SELECT * FROM clients ";
$statement = $mysqli->prepare($query);
$statement->execute();
$result =  $statement->get_result();
$client_data = $result->fetch_all(MYSQLI_ASSOC);


if (isset($_GET['id'])) {
    $client_id = $_GET['id'];
    $query = "DELETE  FROM clients WHERE id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("i", $client_id);
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
            <p class="h2">Clients</p>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($client_data as $client): ?>
                        <tr>
                            <td><?php echo $client['id']; ?></td>
                            <td><?php echo $client['name']; ?></td>
                            <td><?php echo $client['username']; ?></td>
                            <td><?php echo $client['email']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $client['id']; ?>" class="btn green_btn">Edit</a>
                                <a href="index.php?id=<?= $client['id']; ?>" class="btn red_btn">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>


                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include("../../templates/footer.php"); ?>