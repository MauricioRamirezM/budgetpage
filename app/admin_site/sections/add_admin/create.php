<?php
require("../../../../settings/database.php");
require("../../../../libs/functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $mysqli->real_escape_string(sanitizeinput($_POST['name']));
    $phone = $mysqli->real_escape_string(sanitizeinput($_POST['phone']));
    $role = $mysqli->real_escape_string(sanitizeinput($_POST['role'])) ;
    $password = $mysqli->real_escape_string(sanitizeinput($_POST['password']));
    $conf_password = $mysqli->real_escape_string(sanitizeinput($_POST['conf_password']));
    if (!confirmPassword($password, $conf_password) || !validatePassword($password)) {
        $message = "The passwords are not correct";
        header("Location: create.php?msg=$message");
        return;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);



    $query = "INSERT INTO users (name, phone, password, role) VALUES (?,?,?,?)";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("ssss", $name, $phone, $hashedPassword, $role);
    if ($statement->execute()) {
        $message = "Admin added successfully";
        header("Location: index.php?msg=$message");
    } else {
        $message = "Error adding the new admin";
        header("Location: index.php?msg=$message");
    }
}

include("../../templates/header.php");

?>

<div class="container-fluid mt-5 card_container">
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4 ">
            <?php if (isset($_GET['msg'])): ?>
                <div class="alert_box ">
                    <div class="alert  alert-danger " role="alert">
                        <strong class="msg"><?=$_GET['msg'];?></strong>
                    </div>
                </div>
            <?php endif; ?>



            <div class="card admin_card">


                <article class="add_admin_logo">
                    <img class="" src="<?= $base_path ?>assets/img/logo.svg" alt="logo">

                </article>
                <div class="card-body">
                    <form id="admin_form" action="" method="post">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input required type="text" class="form-control" name="name" id="nameid" aria-describedby="helpId"
                                placeholder="Enter your name" pattern="^[a-zA-Z]{4,}[a-zA-Z0-9_]*$" title="Not specials cahracters or blankspaces (username_123)">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone number:</label>
                            <input required type="text" class="form-control" name="phone" id="phoneid"
                                aria-describedby="helpId" placeholder="Enter your number" pattern="^\d{1,9}$" title="Only numbers. (max. 9)">
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <input readonly  value="admin" type="text"
                                class="form-control" name="role" id="role" aria-describedby="helpId" placeholder="Enter the role (admin)" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Only letters and blank spaces">
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input required type="password" class="form-control" name="password" id="passwordid"
                                placeholder="Enter your password" pattern="[a-zA-Z0-9]{8,}$" title="Only letters and numbers (min. 8)">
                        </div>
                        <div class="mb-3">
                            <label for="conf_password" class="form-label">Confirm your password:</label>
                            <input required type="password" class="form-control" name="conf_password" id="conf_password" placeholder="Confirm your password." />
                        </div>


                        <button type="submit" class="btn green_btn">Add admin</button>
                        <a href="index.php" class="btn red_btn">Back</a>


                    </form>
                </div>
                <div class="card-footer text-muted">
                </div>
            </div>
        </div>
        <div class="col-md-4"> </div>
    </div>
</div>


<? include("../../templates/footer.php") ?>