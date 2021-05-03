<?php

if (!class_exists('IncludeScript')) {
   
   class IncludeScript{

      public function __construct(){
         add_action( 'wp_enqueue_scripts', array($this, 'add_bootstrap_css') );
         add_action( 'wp_enqueue_scripts', array($this, 'add_bootstrap_scripts') );
      }

      public function add_bootstrap_css(){
         wp_enqueue_style( 'bootstrap_css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array());
      }

      public function add_bootstrap_scripts(){
         wp_enqueue_script( 'jshashes_script', 'https://cdnjs.cloudflare.com/ajax/libs/jshashes/1.0.7/hashes.min.js', array ( 'jquery' ), '', true);
         wp_enqueue_script( 'popper_script', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array ( 'jquery' ), '', true);
         wp_enqueue_script( 'bootstrap_script', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array ( 'jquery' ), '', true);
         wp_register_script( 'custom_script', get_stylesheet_directory_uri() . '/js/script.js', array ( 'jquery' ), '', true);
         wp_localize_script( 'custom_script', 'ajaxData', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
         wp_enqueue_script('custom_script');
      }
   }
}
