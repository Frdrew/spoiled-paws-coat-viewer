<?php
if (!defined('ABSPATH')) exit;

function sp_cv_add_metaboxes() {
    add_meta_box(
        'spcv-images',
        'Coat Viewer Images',
        'sp_cv_render_metabox',
        'cv_model',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'sp_cv_add_metaboxes');

function sp_cv_render_metabox($post) {
    $silhouette = get_post_meta($post->ID, 'cv_silhouette', true);
    $front      = get_post_meta($post->ID, 'cv_view_front', true);
    $left       = get_post_meta($post->ID, 'cv_view_left', true);
    $right      = get_post_meta($post->ID, 'cv_view_right', true);

    echo '<p><strong>Dog Silhouette (SVG recommended):</strong></p>';
    echo sp_cv_admin_image_field('cv_silhouette', $silhouette);

    echo '<p><strong>Front View Coat:</strong></p>';
    echo sp_cv_admin_image_field('cv_view_front', $front);

    echo '<p><strong>Left View Coat:</strong></p>';
    echo sp_cv_admin_image_field('cv_view_left', $left);

    echo '<p><strong>Right View Coat:</strong></p>';
    echo sp_cv_admin_image_field('cv_view_right', $right);
}

function sp_cv_admin_image_field($name, $value) {
    return '
        <input style="width:80%;" type="text" name="'.$name.'" value="'.$value.'">
        <button class="button spcv-upload" data-target="'.$name.'">Upload</button>
        <script>
        jQuery(function($){
            $(".spcv-upload").on("click", function(e){
                e.preventDefault();
                var button = $(this);
                var target = button.data("target");
                var frame = wp.media({
                    title: "Select Image",
                    multiple: false
                });
                frame.on("select", function(){
                    var url = frame.state().get("selection").first().toJSON().url;
                    $("input[name="+target+"]").val(url);
                });
                frame.open();
            });
        });
        </script>
    ';
}
