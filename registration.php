<?php 
/* Template Name: Registration Page */
?>
<?php get_header(); ?>
   <div class="container">
      <div class="text-center"><a id="userRegistration" data-toggle="modal" data-target="#firstModal"><u>User Registration</u></a></div>
   </div>

   <!-- first Modal -->
   <div class="modal fade" id="firstModal" tabindex="-1" role="dialog" aria-labelledby="firstModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="firstModalLabel">First Modal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="inputUsername">Username</label>
                  <input type="text" class="form-control" id="inputUsername" placeholder="Enter Username" autocomplete="off">
               </div>
               <div class="form-group">
                  <label for="inputEmail">Email address</label>
                  <input type="email" class="form-control" id="inputEmail" placeholder="Enter email" autocomplete="off">
               </div>
               <div class="form-group">
                  <label for="inputPassword">Password</label>
                  <input type="password" class="form-control" id="inputPassword" placeholder="Password" autocomplete="new-password">
               </div>
               <div class="form-group">
                  <label for="inputRepeatPassword">Repeat Password</label>
                  <input type="password" class="form-control" id="inputRepeatPassword" placeholder="Repeat Password" autocomplete="off">
               </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="firstModalSave">Save changes</button>
            </div>
         </div>
      </div>
   </div>

   <!-- second Modal -->
   <div class="modal fade" id="secondModal" tabindex="-1" role="dialog" aria-labelledby="secondModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="secondModalLabel">Second Modal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="inputFirstName">First Name</label>
                  <input type="text" class="form-control" id="inputFirstName" placeholder="First Name" autocomplete="off">
               </div>
               <div class="form-group">
                  <label for="inputLastName">Last Name</label>
                  <input type="text" class="form-control" id="inputLastName" placeholder="Last Name" autocomplete="off">
                  <input type="hidden" name="nonce" id="inputNonce" value="<?= wp_create_nonce("modal_nonce"); ?>">
               </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="secondModalSave">Save changes</button>
            </div>
         </div>
      </div>
   </div>
<?php get_footer(); ?>
