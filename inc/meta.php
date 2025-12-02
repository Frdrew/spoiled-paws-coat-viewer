<?php
if (!defined('ABSPATH')) exit;

function sp_cv_register_meta() {

    register_post_meta('cv_model', 'cv_silhouette', [
        'single' => true,
        'type'   => 'string',
        'show_in_rest' => true,
    ]);

    register_post_meta('cv_model', 'cv_view_front', [
        'single' => true,
        'type'   => 'string',
        'show_in_rest' => true,
    ]);

    register_post_meta('cv_model', 'cv_view_left', [
        'single' => true,
        'type'   => 'string',
        'show_in_rest' => true,
    ]);

    register_post_meta('cv_model', 'cv_view_right', [
        'single' => true,
        'type'   => 'string',
        'show_in_rest' => true,
    ]);

}
add_action('init', 'sp_cv_register_meta');
