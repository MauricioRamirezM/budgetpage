<?php 
include("templates/header.php");
$base_path  ="http://localhost/final_project_php/";
?>


    <div class="container  ">
        <div class="row">
            <div class="col-md-3"> </div>
            <div class="col-md-6">
                <div class="card login_card">
                   
                    <div class="card-body">
                        <?php if(isset($_GET['msg'])):?>
                            <div class="alert green_box" role="alert">
                                <strong><?php echo $_GET['msg'];?></strong>
                            </div>
                        <?php endif;?>

                        <article class="login_logo">
                            <img class="login_img" src="<?=$base_path?>assets/img/logo.svg" alt="lotipo">
                        </article>

                        <form class="login_form" action="app/controllers/loginController.php" method="post">

                            <div class="form-group">
                                <label for="username">Username: </label>
                                <input  type="text" class="form-control" name="username" id="usernameid"
                                    aria-describedby="helpId" placeholder="Username1234" pattern="^[a-zA-Z]{4,}[a-zA-Z0-9_]*$" title="Not specials characters (username_123)" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password: </label>
                                <input  type="password" class="form-control" name="password" id="passwordid"
                                    placeholder="Enter your password" pattern="[a-zA-Z0-9]{8,}$" title="Only letters and numbers (min. 8)" required>
                            </div>
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="admin_box" id="admin_box" value="true" >
                                Admin
                              </label>
                            </div>

                           
                            
                            

                            <button type="submit" class="btn login_btn">Login</button>
                        </form>

                    </div>
                    
                </div>
                <a class="dont_have" href="?page=register">Don't have account? Sing up.</a>

            </div>
            <div class="col-md-3"> </div>
        </div>
    </div>

<script src="public/js/validateInputs.js"></script>
</body>

</html>