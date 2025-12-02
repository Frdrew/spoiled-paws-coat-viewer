<?php
if (!defined('ABSPATH')) exit;

class SPCV_Assets {

    public static function init() {
        add_action('wp_enqueue_scripts', [__CLASS__, 'load_assets']);
        add_action('enqueue_block_editor_assets', [__CLASS__, 'load_editor_assets']);
    }

    public static function load_assets() {

        $plugin_url = plugins_url('../assets', __FILE__);

        // CSS
        wp_enqueue_style('spcv-layout',  $plugin_url . '/css/coat-layout.css', [], '1.0');
        wp_enqueue_style('spcv-ui',      $plugin_url . '/css/coat-ui.css', [], '1.0');
        wp_enqueue_style('spcv-select',  $plugin_url . '/css/ui-coat-selector.css', [], '1.0');
        wp_enqueue_style('spcv-viewer',  $plugin_url . '/css/viewer.css', [], '1.0');
        wp_enqueue_style('spcv-anim',    $plugin_url . '/css/coat-animations.css', [], '1.0');

        // JS
        wp_enqueue_script('spcv-rotator', $plugin_url . '/js/rotator.js', [], '1.0', true);
        wp_enqueue_script('spcv-size',    $plugin_url . '/js/size-ui.js', [], '1.0', true);
        wp_enqueue_script('spcv-breed',   $plugin_url . '/js/breed-ui.js', [], '1.0', true);
        wp_enqueue_script('spcv-loader',  $plugin_url . '/js/loader-utils.js', [], '1.0', true);
        wp_enqueue_script('spcv-3d',      $plugin_url . '/js/viewer-3d.js', [], '1.0', true);
        wp_enqueue_script('spcv-ui',      $plugin_url . '/templates/viewer.js', [], '1.0', true);
    }

    public static function load_editor_assets() {
        $plugin_url = plugins_url('../assets', __FILE__);

        wp_enqueue_style('spcv-editor', $plugin_url . '/css/coat-ui.css', [], '1.0');
    }
}

SPCV_Assets::init();
<?php
if (!defined('ABSPATH')) exit;

class SPO_Custom_Order_Assets {

    public static function init() {
        add_action('wp_enqueue_scripts', [__CLASS__, 'load_assets']);
    }

    public static function load_assets() {

        $base = plugins_url('../assets', __FILE__);

        wp_enqueue_style('spo-form',      $base . '/css/form.css', [], '1.0');
        wp_enqueue_style('spo-fields',    $base . '/css/fields.css', [], '1.0');
        wp_enqueue_style('spo-steps',     $base . '/css/order-steps.css', [], '1.0');

        wp_enqueue_script('spo-form-js',        $base . '/js/form.js', [], '1.0', true);
        wp_enqueue_script('spo-measure-js',     $base . '/js/measurements.js', [], '1.0', true);
    }
}

SPO_Custom_Order_Assets::init();
<?php
if (!defined('ABSPATH')) exit;

class SP_MOM_DASH_ASSETS {

    public static function init() {
        add_action('admin_enqueue_scripts', [__CLASS__, 'load_assets']);
    }

    public static function load_assets() {

        $base = plugins_url('../assets', __FILE__);

        wp_enqueue_style('mom-dashboard', $base . '/css/dashboard.css', [], '1.0');
        wp_enqueue_style('mom-widgets',   $base . '/css/widgets.css', [], '1.0');
        wp_enqueue_style('mom-charts',    $base . '/css/charts.css', [], '1.0');

        wp_enqueue_script('mom-dashboard-js', $base . '/js/dashboard.js', [], '1.0', true);
    }
}

SP_MOM_DASH_ASSETS::init();
