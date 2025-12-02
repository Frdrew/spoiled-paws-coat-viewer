<?php
if (!defined('ABSPATH')) exit;

function sp_cv_register_cpt() {
    register_post_type('cv_model', [
        'labels' => [
            'name' => 'Viewer Models',
            'singular_name' => 'Viewer Model',
        ],
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-pets',
        'supports' => ['title', 'thumbnail'],
    ]);
}
add_action('init', 'sp_cv_register_cpt');
