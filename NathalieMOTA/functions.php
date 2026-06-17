<?php

// calling style.css files
function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri() );
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// calling script.js files
function blankslate_scripts() {
    wp_enqueue_script('script-js',get_template_directory_uri() . '/assets/js/script.js',
        array(),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'blankslate_scripts');