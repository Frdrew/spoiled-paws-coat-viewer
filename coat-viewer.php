<?php
/**
 * Plugin Name: Spoiled Paws – Coat Viewer
 * Description: Dog coat try-on viewer with silhouettes, feathers, overlays, stitching, and 3D rotation.
 * Version: 1.0.0
 * Author: Spoiled Paws
 * GitHub Plugin URI: Frdrew/spoiled-paws-coat-viewer
 * GitHub Branch: main
 */

if (!defined('ABSPATH')) exit;


// -----------------------------------------------------------------------------
// CONSTANTS
// -----------------------------------------------------------------------------

define('SPCV_PATH', plugin_dir_path(__FILE__));
define('SPCV_URL', plugin_dir_url(__FILE__));
define('SPCV_ASSETS', SPCV_URL . 'assets/');

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
// FRONTEND ENQUEUE
// -----------------------------------------------------------------------------

function spcv_enqueue_frontend_scripts() {

    // Base viewer UI
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

    // Additional UI CSS
    wp_enqueue_style(
        'spcv-ui',
        SPCV_ASSETS . 'css/coat-ui.css',
        [],
        '1.0'
    );

    // Coat UI logic
    wp_enqueue_script(
        'spcv-ui-js',
        SPCV_ASSETS . 'js/coat-ui.js',
        ['jquery'],
        '1.0',
        true
    );

    // Breed selector
    wp_enqueue_script(
        'spcv-breed-js',
        SPCV_ASSETS . 'js/breed-ui.js',
        ['jquery'],
        '1.0',
        true
    );

    // Size calculator
    wp_enqueue_script(
        'spcv-size-js',
        SPCV_ASSETS . 'js/size-ui.js',
        ['jquery'],
        '1.0',
        true
    );

    // Load manifest & JSON files safely
    wp_localize_script('spcv-ui-js', 'spcvConfig', [
        'manifest_url' => SPCV_ASSETS . 'images/manifest.json',
        'breeds_url'   => SPCV_ASSETS . 'images/breeds.json',
        'size_scale'   => json_decode(file_get_contents(SPCV_PATH . 'assets/config/size-scale.json'), true),
        'base_url'     => SPCV_ASSETS . 'images/'
    ]);

}
add_action('wp_enqueue_scripts', 'spcv_enqueue_frontend_scripts');

