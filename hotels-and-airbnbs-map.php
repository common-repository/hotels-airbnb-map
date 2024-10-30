<?php
/**
 * @package Stay22Plugin
 */
/*
Plugin Name: Hotels & Airbnb Map
Plugin URI: http://stay22.com/
Description: Accommodation map to help businesses provide their customers with a great experience when looking for a place to stay near their destination.
Version: 1.0.0
Author: Stay22
Author URI: http://stay22.com
License: OK
Text Domain: stay22-plugin
 */

//Prevent users to access the plugin directly
if(!defined('ABSPATH'))
    exit;

//Load the scripts file
require_once(plugin_dir_path(__FILE__).'/includes/map-scripts.php');

//Load class
require_once(plugin_dir_path(__FILE__).'/includes/map-class.php');

//Register widget
function stay22_register_map(){
    register_widget('stay22_map_widget');
}

//Hook the function
add_action('widgets_init', 'stay22_register_map');