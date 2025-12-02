<?php
if (!defined('ABSPATH')) exit;

class SP_Theme_Assets {

    public static function init() {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue']);
    }

    public static function enqueue() {

        $theme = get_template_directory_uri() . '/assets';

        // CSS
        wp_enqueue_style('sp-layout',      $theme . '/css/layout.css', [], '1.0');
        wp_enqueue_style('sp-transitions', $theme . '/css/transitions.css', [], '1.0');
        wp_enqueue_style('sp-effects',     $theme . '/css/effects.css', [], '1.0');
        wp_enqueue_style('sp-wc',          $theme . '/css/woocommerce-skin.css', [], '1.0');

        // JS
        wp_enqueue_script('sp-scroll-effects', $theme . '/js/scroll-effects.js', [], '1.0', true);
        wp_enqueue_script('sp-tilts',          $theme . '/js/coat-card-tilt.js', [], '1.0', true);
        wp_enqueue_script('sp-transitions',    $theme . '/js/transitions.js', [], '1.0', true);
    }
}

SP_Theme_Assets::init();
