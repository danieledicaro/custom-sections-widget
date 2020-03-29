<?php
/**
 * Plugin Name:   Custom Sections Widget
 * Plugin URI:    https://github.com/danieledicaro/custom-sections-widget
 * Description:   Details Section
 * Version:       1.0
 * Author:        Daniele Di Caro
 * Author URI:    https://github.com/danieledicaro/
 */


include ('sections/details.php');


function register_details_widget() { 
  register_widget( 'details_Widget' );
}
add_action( 'widgets_init', 'register_details_widget' );