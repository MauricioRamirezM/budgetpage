<?php
require("../../../../settings/database.php");
require("../../../../libs/functions.php");

if($_SERVER['REQUEST_METHOD'] ===  "GET" && isset($_GET['appo_id'])){
    $appo_id= $_GET['appo_id'];
    $client_id = $_GET['client_id'];
    $query = "SELECT * FROM reservations WHERE id =? AND  client_id = ?";
        $statement = $mysqli->prepare($query);
        $statement->bind_param("ii", $appo_id, $client_id);
        $statement->execute();
        $result = $statement->get_result();
        $appo_info = $result->fetch_assoc();
        $title = $appo_info['title'];
        $date_get = $appo_info['date'];
        $description = $appo_info['description'];
        
};



if($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $mysqli->real_escape_string(sanitizeinput($_POST['apo_title']));
    $date = $mysqli->real_escape_string(sanitizeinput($_POST['apo_date']));
    $description = $mysqli->real_escape_string(sanitizeinput($_POST['apo_description']));
    $id = $mysqli->real_escape_string(sanitizeinput($_POST['apo_id']));
    $client_id = $mysqli->real_escape_string(sanitizeinput($_POST['apo_client']));
   
    // $query = "UPDATE users SET name=?,  role=?, phone = ? WHERE id=? AND role=?";
    $query = "UPDATE reservations SET title=?, date=?, description=? WHERE id=? AND client_id=?";
    $statement = $mysqli->prepare($query);
    $statement->bind_param("sssii", $title, $date, $description, $id, $client_id);
    $statement->execute();
    if($statement->affected_rows > 0) {
        $message = "The appoinment was updated successfully";
        header("Location: edit.php?id=$client_id");
        exit();
    } else {
        $message = "Error adding the new admin";
        header("Location: edit.php?id=$client_id");
        exit();
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
                        <strong class="msg"><?= $_GET['msg']; ?></strong>
                    </div>
                </div>
            <?php endif; ?>



            <div class="card admin_card">


                <article class="add_admin_logo">
                    <img class="" src="<?= $base_path ?>assets/img/logo.svg" alt="logo">

                </article>
                <div class="card-body">
                    <form id="apo_form" method="post">
                        <input value="<?php echo $appo_id;?>" type="hidden" class="id" name="apo_id" id="apo_id">
                        <input value="<?php echo $client_id;?>" type="hidden" class="id" name="apo_client" id="apo_clientid">

                        <div class="form-group">
                            <label for="apo_title">Subject:</label>
                            <input value="<?php echo $title;?>" required type="text"
                                class="form-control" name="apo_title" id="apo_titleid" aria-describedby="helpId" placeholder="Enter the subject of your appoinment" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Only letters and blank spaces">
                        </div>
                        <div class="form-group">
                            <label for="apo_date">Date:</label>
                            <input value="<?php echo $date_get;?>" required type="date"
                                class="form-control apo_date" name="apo_date" id="apo_dateid" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="apo_description" class="form-label">Description of your questions:</label>
                            <textarea required class="form-control" name="apo_description" id="apo_descriptionid" rows="3" placeholder="How may we assist you?"><?=$description;?></textarea>
                        </div>

                        <button type="submit" name="apo_btn" class="btn apo_btn green_btn">Edit appoinment</button>
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