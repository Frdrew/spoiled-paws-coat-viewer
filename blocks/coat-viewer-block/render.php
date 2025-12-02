<?php
/**
 * Coat Viewer Block — Dynamic Render Template
 */

if (!defined('ABSPATH')) {
    exit;
}

// Load assets
wp_enqueue_style('coat-viewer-ui', plugins_url('../../assets/css/viewer.css', __FILE__));
wp_enqueue_script('coat-viewer-3d', plugins_url('../../assets/js/viewer-3d.js', __FILE__), ['jquery'], null, true);
wp_enqueue_script('coat-viewer-loader', plugins_url('../../assets/js/loader-utils.js', __FILE__), ['jquery'], null, true);
wp_enqueue_script('coat-viewer-rotator', plugins_url('../../assets/js/rotator.js', __FILE__), ['jquery'], null, true);

// Load config files from assets/config/
$coats_json   = plugins_url('../../assets/config/coat-catalog.json', __FILE__);
$breeds_json  = plugins_url('../../assets/config/breeds.json', __FILE__);
$sizes_json   = plugins_url('../../assets/config/size-scale.json', __FILE__);
$stitch_json  = plugins_url('../../assets/config/stitch-lines.json', __FILE__);
$manifest_json = plugins_url('../../assets/images/manifest.json', __FILE__);

?>

<div id="coat-viewer-root"
     class="spoiled-paws-coat-viewer"
     data-coats="<?php echo esc_url($coats_json); ?>"
     data-breeds="<?php echo esc_url($breeds_json); ?>"
     data-sizes="<?php echo esc_url($sizes_json); ?>"
     data-stitches="<?php echo esc_url($stitch_json); ?>"
     data-images="<?php echo esc_url($manifest_json); ?>"
>

    <div class="coat-viewer-ui">
        <!-- Breed Selector -->
        <div class="ui-section">
            <label>Choose Breed</label>
            <select id="cv-breed"></select>
        </div>

        <!-- Size Selector -->
        <div class="ui-section">
            <label>Choose Size</label>
            <select id="cv-size"></select>
        </div>

        <!-- Coat Selector -->
        <div class="ui-section">
            <label>Choose Coat Design</label>
            <select id="cv-coat"></select>
        </div>

        <div class="ui-note">
            Your dog’s outline updates automatically based on breed & size.
            Coat fits scale automatically.
        </div>
    </div>

    <!-- Viewer Stage -->
    <div class="coat-viewer-stage">
        <div class="dog-viewer-container">
            <img id="cv-dog-base" class="cv-layer" src="" alt="Dog silhouette">
            <img id="cv-coat-layer" class="cv-layer" src="" alt="Coat layer">
            <img id="cv-stitch-layer" class="cv-layer" src="" alt="Stitch layer">
        </div>

        <!-- Angle Controls -->
        <div class="viewer-angles">
            <button class="cv-angle" data-angle="front">Front</button>
            <button class="cv-angle" data-angle="left">Left</button>
            <button class="cv-angle" data-angle="right">Right</button>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    window.CoatViewer.init({
        root: "#coat-viewer-root",
        selectors: {
            breed: "#cv-breed",
            size: "#cv-size",
            coat: "#cv-coat"
        },
        layers: {
            dogBase: "#cv-dog-base",
            coat: "#cv-coat-layer",
            stitches: "#cv-stitch-layer"
        },
        angleButtons: ".cv-angle"
    });
});
</script>

