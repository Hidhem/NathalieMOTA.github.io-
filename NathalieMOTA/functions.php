<?php

// calling style.css files
function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri() );
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// calling script.js files and jQuerry
function theme_scripts() {
    wp_enqueue_script(
        'main-js',
        get_template_directory_uri() . '/assets/js/script.js',
        array('jquery'),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'theme_scripts');
