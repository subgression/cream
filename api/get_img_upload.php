<?php
    require "../src/CreamLoader.php";
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
    echo $_SERVER['REQUEST_URI'] . "<br>";
    echo var_dump(scandir('../src/'));

    cream_render_img_upload();
?>