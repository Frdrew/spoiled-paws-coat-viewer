<?php
/**
 * Plugin Name: Spoiled Paws — Coat Viewer
 * Description: Dog coat try-on viewer with silhouettes & coat overlays.
 * Version: 1.0.0
 * Author: Spoiled Paws
 */

if (!defined('ABSPATH')) exit;

// -----------------------------------------------------------------------------
// CONSTANTS
// -----------------------------------------------------------------------------

define('SPCV_PATH', plugin_dir_path(__FILE__));
define('SPCV_URL', plugin_dir_url(__FILE__));
define('SPCV_ASSETS', SPCV_URL . 'assets/');
define('SPCV_SILHOUETTES', SPCV_PATH . 'assets/images/silhouettes/svg/');
define('SPCV_COATS', SPCV_PATH . 'assets/images/coats/');

// -----------------------------------------------------------------------------
// LOAD FILES
// -----------------------------------------------------------------------------

require_once SPCV_PATH . 'inc/class-coat-viewer-api.php';
require_once SPCV_PATH . 'inc/class-coat-viewer-admin.php';
require_once SPCV_PATH . 'inc/class-coat-viewer-render.php';

// -----------------------------------------------------------------------------
// REGISTER BLOCK
// -----------------------------------------------------------------------------

function spcv_register_block() {
    register_block_type(__DIR__ . '/blocks/coat-viewer-block');
}
add_action('init', 'spcv_register_block');

// -----------------------------------------------------------------------------
// ENQUEUE FRONTEND
// -----------------------------------------------------------------------------

function spcv_enqueue_frontend_scripts() {
    wp_enqueue_style(
        'spcv-viewer-css',
        SPCV_ASSETS . 'css/viewer.css',
        [],
        filemtime(SPCV_PATH . 'assets/css/viewer.css')
    );

    wp_enqueue_script(
        'spcv-viewer-js',
        SPCV_ASSETS . 'js/viewer.js',
        [],
        filemtime(SPCV_PATH . 'assets/js/viewer.js'),
        true
    );

    wp_localize_script('spcv-viewer-js', 'SPCV_DATA', [
        'api' => [
            'silhouettes' => rest_url('spcv/v1/silhouettes'),
            'coats'       => rest_url('spcv/v1/coats'),
        ],
        'assets' => [
            'silhouettes' => SPCV_URL . 'assets/images/silhouettes/svg/',
            'coats'       => SPCV_URL . 'assets/images/coats/',
        ]
    ]);
}
add_action('wp_enqueue_scripts', 'spcv_enqueue_frontend_scripts');
