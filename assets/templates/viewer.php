<?php
if (!defined('ABSPATH')) exit;

class SPCV_Admin {

    public function __construct() {
        add_action('admin_menu', [$this, 'menu']);
    }

    public function menu() {
        add_menu_page(
            'Coat Viewer',
            'Coat Viewer',
            'manage_options',
            'spcv-admin',
            [$this, 'screen'],
            'dashicons-visibility'
        );
    }

    public function screen() {
        echo '<div class="wrap"><h1>Coat Viewer Settings</h1>';
        echo '<p>This plugin automatically loads any silhouettes dropped into:</p>';
        echo '<code>' . SPCV_SILHOUETTES . '</code>';
        echo '<p>And any coat overlays dropped into:</p>';
        echo '<code>' . SPCV_COATS . '</code>';
        echo '<p>No configuration required.</p>';
        echo '</div>';
    }
}

new SPCV_Admin();
