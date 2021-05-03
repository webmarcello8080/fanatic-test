<?php

if (!class_exists('Ajax')) {
   
   class Ajax{

      public function __construct(){
         add_action( 'wp_ajax_new_user', array($this, 'new_user') );
         add_action( 'wp_ajax_nopriv_new_user', array($this, 'new_user') );
      }

      public function new_user(){
         $result = array();

         if ( !wp_verify_nonce( $_POST['nonce'], "modal_nonce")) {
            exit("No naughty people here please");
         }
         
         $user_id = wp_insert_user( array(
            'user_login' => $_POST['username'],
            'user_pass' => $_POST['password'],
            'user_email' => $_POST['email'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'display_name' => $_POST['first_name'] . ' ' . $_POST['last_name'],
            'role' => 'editor'
         ));

         if(is_wp_error($user_id)){
            $result['type'] = "error";
            $result['error'] = $user_id->get_error_message();
         }else{
            $result['type'] = "success";
            $result['id'] = $user_id;
         }

         $result = json_encode($result);
         echo $result;

         die();
      }
   }
}