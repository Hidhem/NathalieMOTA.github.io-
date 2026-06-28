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
    wp_localize_script(
        'main-js',
        'ajax_object',
        array(
            'ajax_url' => admin_url('admin-ajax.php')
        )
    );
}
add_action('wp_enqueue_scripts', 'theme_scripts');

function filter_photos() {
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8
    ];
    $tax_query = [];
    if (!empty($_POST['categorie'])) {
        $tax_query[] = [
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $_POST['categorie']
        ];
    }
    if (!empty($_POST['format'])) {
        $tax_query[] = [
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $_POST['format']
        ];
    }
    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }
    if (!empty($_POST['sort'])) {
        $args['orderby'] = 'date';
        $args['order'] = sanitize_text_field($_POST['sort']);
    }
    $photos = new WP_Query($args);
    if ($photos->have_posts()) :
        while ($photos->have_posts()) :
            $photos->the_post();
            get_template_part('template-parts/photo-card');
        endwhile;
    endif;
    wp_die();
}

add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');

//  more loadinge feature

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

function load_more_photos() {
    if (
        !isset($_POST['nonce']) ||
        !wp_verify_nonce($_POST['nonce'], 'load_more_photos')
    ) {
        wp_send_json_error();
    }
    ob_start();
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => intval($_POST['page'])
    ];
    $tax_query = [];
    if (!empty($_POST['categorie'])) {
        $tax_query[] = [
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $_POST['categorie']
        ];
    }
    if (!empty($_POST['format'])) {
        $tax_query[] = [
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $_POST['format']
        ];
    }
    if ($tax_query) {
        $args['tax_query'] = $tax_query;
    }
    if (!empty($_POST['sort'])) {
        $args['orderby'] = 'date';
        $args['order'] = sanitize_text_field($_POST['sort']);
    }
    $photos = new WP_Query($args);
    if ($photos->have_posts()) {
        while ($photos->have_posts()) {
            $photos->the_post();
            get_template_part('template-parts/photo-card');
        }
    }
    wp_reset_postdata();
    wp_send_json_success(ob_get_clean());
}