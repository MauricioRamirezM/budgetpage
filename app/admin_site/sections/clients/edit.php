<?php
include("../../templates/header.php");
require("../../../../settings/database.php");
require("../../../../libs/functions.php");
if ($_SERVER['REQUEST_METHOD'] == "GET" ) {
        $id_client = $_GET['id'];

        $query = "SELECT * FROM clients WHERE id = ?";
        $statement = $mysqli->prepare($query);
        $statement->bind_param("i", $id_client);
        $statement->execute();
        $result =  $statement->get_result();
        $client_info = $result->fetch_assoc();
        $id = $client_info['id'];
        $name = $client_info['name'];
        $username = $client_info['username'];
        $email = $client_info['email'];
        $phone = $client_info['phone'];
    
        $query = "SELECT * FROM reservations WHERE client_id = ?";
        $statement = $mysqli->prepare($query);
        $statement->bind_param("i", $id_client);
        if ($statement->execute()) {
            $result = $statement->get_result();
            $appoinments = [];
            while ($row = $result->fetch_assoc()) {
                $appoinments[]  = $row;
            }
        }
    
   
  
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $client_id = $mysqli->real_escape_string(sanitizeinput($_POST['id']));
    $client_name = $mysqli->real_escape_string(sanitizeinput($_POST['name']));
    $client_username = $mysqli->real_escape_string(sanitizeinput($_POST['username']));
    $client_email = $mysqli->real_escape_string(sanitizeinput($_POST['email']));
    $client_phone = $mysqli->real_escape_string(sanitizeinput($_POST['phone']));
    $query = "UPDATE clients SET name=?,  username=?, email=?, phone = ? WHERE id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("sssis", $client_name, $client_username, $client_email, $client_phone, $client_id);
    if ($statement->execute()) {
        $message = "The admin was updated succesfully";
        header("Location: index.php?msg=$message");
    }
}
?>

<div class="container card_container mt-5">
    <div class="row">
        <!-- <div class="col-md-3">

        </div> -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <p class="h2">Edit Client</p>
                </div>
                <div class="card-body">
                    <form id="client_form" method="post">
                        <input name="id" type="hidden" value="<?php echo  $client_info['id']; ?>">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input value="<?php echo  $name ?>" required type="text" class="form-control" name="name" id="nameid" aria-describedby="helpId"
                                placeholder="Enter your name" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Only letters and blank spaces">
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input value="<?php echo  $username ?>" required type="text" class="form-control" name="username" id="usernameid"
                                aria-describedby="helpId" placeholder="Enter your username." pattern="^[a-zA-Z]{4,}[a-zA-Z0-9_]*$" title="Not specials cahracters (username_123)">
                        </div>

                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input value="<?php echo  $email ?>" required type="text" class="form-control" name="email" id="emailid"
                                aria-describedby="helpId" placeholder="youremail@example.com" pattern="^[a-z0-9]+(\.[a-z0-9_]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,15})$" title="The email format is not correct">

                        </div>
                        <div class="form-group">
                            <label for="phone">Phone number:</label>
                            <input value="<?php echo  $phone ?>" required type="text" class="form-control" name="phone" id="phoneid"
                                aria-describedby="helpId" placeholder="Enter your number" pattern="^\d{1,9}$" title="Only numbers. (max. 9)">
                        </div>


                        <div class="wrapper_btn">

                            <button type="submit" class="btn green_btn">Update</button>
                            <a href="index.php" class="btn red_btn">Back</a>
                        </div>
                </div>


                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class=" h2 card-header">
                    Client's appoinments
                </div>
                <div class="card-body">
                    <table class="table client_appo_table">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appoinments as $appo): ?>
                                <tr>
                                    <td><?php echo $appo['title']; ?></td>
                                    <td><?php echo $appo['date']; ?></td>
                                    <td><?php echo $appo['description']; ?></td>
                                    <td>
                                    <a href="edit_appo.php?appo_id=<?= $appo['id']; ?>&client_id=<?=$appo['client_id'];?>" class="btn green_btn">Edit</a>
                                    <a href="index.php?appo_id=<?= $appo['id']; ?>" class="btn red_btn">Delete</a>
                                    </td>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>



<? include("../../templates/footer.php") ?>