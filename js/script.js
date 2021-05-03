jQuery(function ($) {

   $('#firstModalSave').on('click', function () {
      // get form input values
      var username = $('#inputUsername').val();
      var email = $('#inputEmail').val();
      var password = $('#inputPassword').val();
      var repeat_password = $('#inputRepeatPassword').val();
      var error = false;
      var valid_password = false;

      // remove existing error messages
      $(".error").remove();

      // validate
      error = validateFirstModal(username, email, password, repeat_password);

      // call the API
      valid_password = checkBreachedPassword(password);
      console.log(valid_password);

      // if everything went OK open second modal
      if (error === false && valid_password === true) {
         $('#firstModal').modal('hide');
         $('#secondModal').modal('show');
      }
   });

   $('#secondModalSave').on('click', function () {
      // get form input values
      var first_name = $('#inputFirstName').val();
      var last_name = $('#inputLastName').val();
      var error = false;

      // remove existing error messages
      $(".error").remove();

      // validate
      error = validateSecondModal(first_name, last_name);

      // if everything went OK run ajax and insert new user
      if (error === false) {
         registerUser();
         $('#secondModal').modal('hide');
      }
   });

   function validateFirstModal(username, email, password, repeat_password) {
      var error = false;

      if (username.length < 1) {
         $('#inputUsername').after('<span class="error text-danger">This field is required</span>');
         error = true;
      } else {
         var regEx = /^[a-zA-Z0-9.-]+$/;
         var validName = regEx.test(username);
         if (!validName) {
            $('#inputUsername').after('<span class="error text-danger">Enter a valid username</span>');
            error = true;
         }
      }
      if (email.length < 1) {
         $('#inputEmail').after('<span class="error text-danger">This field is required</span>');
         error = true;
      } else {
         var regEx = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
         var validEmail = regEx.test(email);
         if (!validEmail) {
            $('#inputEmail').after('<span class="error text-danger">Enter a valid email</span>');
            error = true;
         }
      }
      if (password.length < 8) {
         $('#inputPassword').after('<span class="error text-danger">Password must be at least 8 characters long</span>');
         error = true;
      }
      if (repeat_password !== password) {
         $('#inputRepeatPassword').after('<span class="error text-danger">The passwords don\'t match</span>');
         error = true;
      }
      return error;
   }

   function validateSecondModal(first_name, last_name) {
      var error = false;

      if (first_name.length < 1) {
         $('#inputFirstName').after('<span class="error text-danger">This field is required</span>');
         error = true;
      } else {
         var regEx = /^[a-zA-Z ]+$/;
         var validName = regEx.test(first_name);
         if (!validName) {
            $('#inputFirstName').after('<span class="error text-danger">Enter a valid Name</span>');
            error = true;
         }
      }
      if (last_name.length < 1) {
         $('#inputLastName').after('<span class="error text-danger">This field is required</span>');
         error = true;
      } else {
         var regEx = /^[a-zA-Z ,.'-]+$/;
         var validName = regEx.test(last_name);
         if (!validName) {
            $('#inputLastName').after('<span class="error text-danger">Enter a valid Last Name</span>');
            error = true;
         }
      }

      return error;
   }

   function registerUser() {
      var username = $('#inputUsername').val();
      var email = $('#inputEmail').val();
      var password = $('#inputPassword').val();
      var first_name = $('#inputFirstName').val();
      var last_name = $('#inputLastName').val();
      var nonce = $('#inputNonce').val();
      var result;

      $.ajax({
         type: 'POST',
         url: ajaxData.ajaxurl,
         dataType: 'json',
         data: {
            action: 'new_user',
            username: username,
            email: email,
            password: password,
            first_name: first_name,
            last_name: last_name,
            nonce: nonce
         },
         success: function (response) {
            if (response.type == 'error') {
               result = false;
               alert('Impossible insert new User: ' + response.error);
            }
            else {
               result = true;
               alert('New User inserted, user ID: ' + response.id);
            }
         }
      })
      return result;
   }

   function checkBreachedPassword(password) {
      var passwordDigest = new Hashes.SHA1().hex(password);
      var digestFive = passwordDigest.substring(0, 5).toUpperCase();
      var queryURL = "https://api.pwnedpasswords.com/range/" + digestFive;
      var checkDigest = passwordDigest.substring(5, 41).toUpperCase();
      var result;

      $.ajax({
         url: queryURL,
         type: 'GET',
         async: false,
         success: function (res) {
            if (res.search(checkDigest) > -1) {
               result = false;
               $('#inputPassword').after('<span class="error text-danger">Password Breached<br/></span>');
            } else {
               result = true;
               $('#inputPassword').after('<span class="error text-success">Password Not Breached<br/></span>');
            }
         }
      });
      return result;
   }
});

