<?php
/**
 * Plugin Name: Simple Contact Form 
 * Description: Simple email contact form
 * Author: Michael Jeter
 * Author URI: https:myhoststream.net
 * Version: 1.0.0
 * Text Domain: simple-contact-form
 */

 if( !defined('ABSPATH')) {
    exit;
 }

 class SimpleContactForm {


    public function __construct()
    {
      //   Create custom post type
        add_action('init', array($this, 'create_custom_post_type'));

        //   Add assets (css and js files)
        add_action('wp_enqueue_scripts', array($this, 'load_assets'));

        //   Add shortcode

        add_shortcode('contact-form', array($this, 'load_shortcode'));

        //  Load Javascript
        add_action('wp_footer', array($this, 'load_scripts'));

    }

    public function create_custom_post_type()
    {
        $args = array(

             'public' => true,
             'has_archive' =>true,
             'supports' => array('title'),
             'exclude_from_search' => true,
             'publicly_queryable' => false,
             'capability' => 'manage_options',
             'labels' => array(
                  'name' => 'Contact_form',
                  'singular_name' => 'Contact_form_entry',
             ),
             'menu_icon' => 'dashicons-media-text',
        );

        register_post_type('simple_contact_form', $args);


    }
    
    public function load_assets()
    {
        wp_enqueue_style('simple-contact-form',
         plugin_dir_url(__FILE__) . 'css/simple-contact-form.css',
          array(),
           '1.0.0',
            'all'
         );

        wp_enqueue_script('simple-contact-form',
         plugin_dir_url(__FILE__) . 'js/simple-contact-form.js',
          array('jquery'),
           '1.0.0',
            true
         );
    }

    public function load_shortcode()
    {?>
            <div class="simple-contact-form">
               <h1>Send us an email</h1>
               <p>Please fill out the form below</p>

                  <form id="simple-contact-form__form">
                     <div class="form-group mb-2">
                        <input name=name type="text" placeholder = "Name" class="form-control">
                     </div>
                     <div class="form-group mb-2">
                        <input name=email type="email" placeholder = "Email" class="form-control">
                     </div>
                     <div class="form-group mb-2">
                        <input name=phone type="tel" placeholder = "Phone" class="form-control">
                     </div>
                     <div class="form-group mb-2">
                        <textarea name=message placeholder = "Type Your Message" class="form-control"></textarea>
                     </div>
                     <div class="form-group">
                        <button type=submit class="btn btn-success btn-block w-100">Send Message</button>
                     </div>
                  </form>
            </div>
    <?php }

    public function load_scripts()
    {?>
        <script>
           $('simple-contact-form__form').submit(function(e) {


           } );
        </script>
    <?php }


 }

 new SimpleContactForm;