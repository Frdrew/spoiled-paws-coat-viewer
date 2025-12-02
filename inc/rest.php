<?php
if (!defined('ABSPATH')) exit;

// Load silhouettes manifest
function spcv_get_manifest() {
    if (!file_exists(SP_CV_MANIFEST)) return [];

    $json = file_get_contents(SP_CV_MANIFEST);
    $data = json_decode($json, true);

    return $data['silhouettes'] ?? [];
}

function sp_cv_register_rest() {

    /**
     * -----------------------------------------
     * ROUTE #1 — Coat Viewer Models (meta fields)
     * -----------------------------------------
     */
    // Get silhouettes from manifest
register_rest_route('spcv/v1', '/silhouettes', [
    'methods'  => 'GET',
    'callback' => function() {
        return spcv_get_manifest();
    },
    'permission_callback' => '__return_true'
]);


            $posts = get_posts([
                'post_type'   => 'cv_model',
                'numberposts' => -1
            ]);

            $data = [];

            foreach ($posts as $p) {
                $data[] = [
                    'id'        => $p->ID,
                    'title'     => $p->post_title,
                    'silhouette'=> get_post_meta($p->ID, 'cv_silhouette', true),
                    'front'     => get_post_meta($p->ID, 'cv_view_front', true),
                    'left'      => get_post_meta($p->ID, 'cv_view_left', true),
                    'right'     => get_post_meta($p->ID, 'cv_view_right', true),
                ];
            }

            return $data;
        },
        'permission_callback' => '__return_true'
    ]);



    /**
     * -----------------------------------------
