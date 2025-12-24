<?php 
include("templates/header.php"); 

?>

<div class="container  contact_wrapper">
    <div class="row">
        <?php if(!isset($_SESSION['client_username'])):?>
            <div class="alert green_box" role="alert">
                <strong>Register and obtain personalized assistance.</strong>
              
        </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['client_username'])):?>
            <div class="alert green_box" role="alert">
                <strong>In your profile can access to the personalized assistance.</strong>
              
        </div>
        <?php endif; ?>
        <div class="col-md-6">
        <div class="row alert_box ">
        <div class="alert mt-0 hide   contact-alert" role="alert">
          <strong class="msg_con"> </strong>
        </div>
      </div>
            <div class="card contact_card">
                <div class="card-header">
                    <p class="h3">Get in contact with us.</p>
                </div>
                <div class="card-body ">
                    <form id="contact_form" class="contact_form ">
                        <div class="form-group">
                            <label for="name">Name: </label>
                            <input required type="text"
                                class="form-control" name="name" id="nameid" aria-describedby="helpId" placeholder="Enter your name" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Only letters and blank spaces">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input required type="text"
                                class="form-control" name="phone" id="phoneid" aria-describedby="helpId" placeholder="+351 999-666-333" pattern="^\d{1,9}$"  title="Only numbers. (max. 9)">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input required type="email"
                                class="form-control" name="email" id="emailid" aria-describedby="helpId" placeholder="youremail@example.com" pattern="^[a-z0-9]+(\.[a-z0-9_]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,15})$" title="The email format is not correct" >
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea  required class="form-control" name="description" id="descriptionid" rows="5" placeholder="How may we assist you?"></textarea>
                        </div>
                        <button type="submit" id="contact_btn" name="contact_btn" class="btn apo_btn">Send</button>


                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            
            <div id="map" class="map" style="width: 100%; height: 400px;">
            </div>
            
            <ul class="contact_info">
                <li><i class="fa-solid fa-location-dot"></i>  R. de Dona Estefânia 84 - A, 1000-158 Lisboa</li>
                <li><i class="fa-solid fa-phone"></i>   +351 565 484 595</li>
                <li><i class="fa-solid fa-envelope"></i>  <a class="mailto" href="mailto:webminds@mail.com">webminds@mail.com</a></li>
            </ul>
        </div>
    </div>
</div>




<?php include("templates/footer.php"); ?>