<?php 
include("templates/header.php");
$base_path  ="http://localhost/final_project_php/";
?>


    <div class="container register_wrapper">
        <div class="row">
            <div class="col-md-3"> </div>
            <div class="col-md-6 register_col">
                
                <div class="card register_card">
                    <?php if(isset($_GET['msg'])):?>
                            <div class=" red_box" role="alert">
                                <strong><?php echo $_GET['msg'];?></strong>
                            </div>
                    <?php endif;?>

                    <article class="register_logo">
                        <img class="" src="<?=$base_path?>assets/img/logo.svg" alt="logo">

                    </article>
                    <div class="card-body">
                        <form id="register_form" action="app/controllers/registerController.php" method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input required type="text" class="form-control" name="name" id="nameid" aria-describedby="helpId"
                                    placeholder="Enter your name"  pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Only letters and blank spaces" >
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input required type="text" class="form-control" name="username" id="usernameid"
                                    aria-describedby="helpId" placeholder="Enter your username." pattern="^[a-zA-Z]{4,}[a-zA-Z0-9_]*$" title="Not specials cahracters (username_123)">
                            </div>

                            <div class="form-group">
                                <label for="email">Email: </label>
                                <input required type="text" class="form-control" name="email" id="emailid"
                                    aria-describedby="helpId" placeholder="youremail@example.com"  pattern="^[a-z0-9]+(\.[a-z0-9_]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,15})$" title="The email format is not correct" >
                                    
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone number:</label>
                                <input required type="text" class="form-control" name="phone" id="phoneid"
                                    aria-describedby="helpId" placeholder="Enter your number" pattern="^\d{1,9}$"  title="Only numbers. (max. 9)">
                            </div>
                            <div class="form-group">
                                <label for="password">Password: </label>
                                <input required type="password" class="form-control" name="password" id="passwordid"
                                    placeholder="Enter your password" pattern="[a-zA-Z0-9]{8,}$"  title="Only letters and numbers (min. 8)">
                            </div>
                            <div class="mb-3">
                                <label for="conf_password" class="form-label">Confirm your password:</label>
                                <input required type="password" class="form-control" name="conf_password" id="conf_password" placeholder="Confirm your password." />
                            </div>

                            <div class="wrapper_btn">

                                <button type="submit" class="btn register_btn">Register</button>
                                <a href="index.php?page=login" class="btn login_link">Log in</a>
                            </div>


                        </form>
                    </div>
                    <div class="card-footer text-muted">
                    </div>
                </div>
            </div>
            <div class="col-md-3"> </div>
        </div>
    </div>

<script src="public/js/validateInputs.js"></script>
</body>

</html>