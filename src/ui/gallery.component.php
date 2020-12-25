<?php

/**
 * Renders the gallery component
 * @param string $name The name of the file to load
 */
function cream_render_gallery($id = "gallery") {
    require_once("../cream/src/Debugger.php");
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
    ob_start();
    $targetID = $id;
?>
    <!-- Gallery Box -->
    <div id="<?php echo $targetID; ?>" style="display: contents;"></div>
<?php
    echo ob_get_clean();
}
?>