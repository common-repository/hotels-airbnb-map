<?php
//Scripts
function map_add_scripts()
{
    //Main CSS file
    wp_enqueue_style('map-main-style', plugin_dir_url(__FILE__) . '../css/style.css');

    //Datepicker css
    wp_enqueue_style('map-daterangepicker-style', plugin_dir_url(__FILE__) . '../css/daterangepicker.css');

    //Spectrum css
    wp_enqueue_style('map-spectrum-style', plugin_dir_url(__FILE__) . '../css/spectrum.css');

    //Moment js
    wp_enqueue_script('map-moment-script', plugin_dir_url(__FILE__) . '../js/moment.min.js');

    //Datepicker js
    wp_enqueue_script('map-daterangepicker-script', plugin_dir_url(__FILE__) . '../js/daterangepicker.js');

    //Spectrum js
    wp_enqueue_script('map-spectrum-script', plugin_dir_url(__FILE__) . '../js/spectrum.js');

    //Main Script file
    wp_enqueue_script('map-main-script', plugin_dir_url(__FILE__) . '../js/main.js');

}

//When WordPress hits this hook, it's gonna know to hit 'map_add_scripts' and load the scripts
add_action('admin_enqueue_scripts', 'map_add_scripts');