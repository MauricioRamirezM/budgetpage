<?php include("templates/header.php"); ?>
<div class="container-fluid  profile_wrapper">
  <div class="row">
     
    <div class="col-md-7">
      <div class="row apo_row">
        <div class="container apo_conte">
        <!-- <div class="alert alert-success hide alert_msg" role="alert">
        <strong class="msg"></strong>
      </div> -->
        <div class="card apo_card">
        <div class="card-header">
          <p class="h3">appoinment.</p>
        </div>
        <div class="card-body">
          <form id="apo_form"  method="" >
          <input type="hidden" class="id" name="id" id="apo_id">

            <div class="form-group">
              <label for="apo_title">Subject:</label>
              <input required type="text"
                class="form-control" name="apo_title" id="apo_titleid" aria-describedby="helpId" placeholder="Enter the subject of your appoinment"  pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Only letters and blank spaces" >
            </div>
            <div class="form-group">
              <label for="apo_date">Date:</label>
              <input required type="date"
                class="form-control apo_date" name="apo_date" id="apo_dateid" aria-describedby="helpId" placeholder="">
            </div>
            <div class="mb-3">
              <label for="apo_description" class="form-label">Description of your questions:</label>
              <textarea required class="form-control" name="apo_description" id="apo_descriptionid" rows="3" placeholder="How may we assist you?"></textarea>
            </div>

            <button type="submit" name="apo_btn" class="btn apo_btn green_btn">Make appoinment</button>
          </form>
        </div>
      </div>
        </div>
      
      </div>
      <div class="row alert_box">
          <div class="alert  hide  alert_msg" role="alert">
            <strong class="msg text-align-center"></strong>
          </div>
        </div>
      <div class=" apo_row ">
        
      
        <div id="table_conte mt-5" class="container table_conte">
        
        <table id="apo_table" class=" apo_table ">
          <thead>
         
          </tbody>
          
          
            
          </tbody>
         </table>
        </div>
         
      </div>
      

    </div>
    <div class="col-md-5">
      <div class="row alert_box">
        <div class="alert  hide alert_msg_pro" role="alert">
          <strong class="msg_pro"></strong>
        </div>
      </div>
    
      <div class="card profile_card ">
        <div class="card-header h3">
          Profile
          <?php if(isset($_SESSION['admin_username'])):?>
        <a href="app/admin_site" class="btn admin_btn">Admin panel</a>
        <?php endif;?>
        </div>
        <div class="card-body">
          <form id="profile_form" action="" method="post">
            <div class="form-group">
              <label for="name">Name:</label>
              <input required type="text"
                class="form-control" name="name" id="nameid" aria-describedby="helpId" placeholder="" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" title="Only letters and blank spaces" >
            </div>
            <div class="form-group">
              <label  for="username">Username</label>
              <input required type="text"
                class="form-control" name="username" id="usernameid" aria-describedby="helpId" placeholder=""  pattern="^[a-zA-Z]{4,}[a-zA-Z0-9_]*$" title="Not specials caharacters (username_123)">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input required type="text"
                class="form-control" name="email" id="emailid" aria-describedby="helpId" placeholder="" pattern="^[a-z0-9]+(\.[a-z0-9_]+)*@[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]{2,15})$" title="The email format is not correct">
            </div>
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input required type="text"
                class="form-control" name="phone" id="phoneid" aria-describedby="helpId" placeholder=""  pattern="^\d{1,9}$"  title="Only numbers. (max. 9)">
            </div>


            <div id="passwordChangeSection" style="display: none;">
              <div class="form-group">
                <label for="currentPassword">Current Password:</label>
                <input  type="password" class="form-control" name="currentPassword" id="currentPasswordid" placeholder=""  pattern="[a-zA-Z0-9]{8,}$"  title="Only letters and numbers (min. 8)">
              </div>
              <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input  type="password" class="form-control" name="newPassword" id="newPasswordid" placeholder="" pattern="[a-zA-Z0-9]{8,}$"  title="Only letters and numbers (min. 8)">
              </div>
              <div class="form-group">
                <label for="confirmPassword">Confirm New Password:</label>
                <input  type="password" class="form-control" name="confirmPassword" id="confirmPasswordid" placeholder="">
              </div>
            </div>
            <div class="form-group profile_btns">
              <button type="button" id="togglePasswordChange" class="btn changePassword_btn">Change Password</button>
              <button type="submit" name="update_info" class="btn profile_btn">Update my Info</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>

    <template id="template">
      <tr>
        <td class="id_tem"></td>
        <td class="title_tem"></td>
        <td class="date_tem"></td>
        <td class="description_tem"></td>
        <td>
          <button name="edit"   class="btn action_btn edit_btn ">Edit</button>
          <button name="delete" class="btn action_btn cancel_btn ">Cancel</button>
        </td>
      </tr>
    </template>



</div>
<?php include("templates/footer.php"); ?>