<?php
    /* WARNING!!!
        No token or challenge when calling this function
    */
    echo "#### Welcome to reset_cream_files.php";

    $textfiles = scandir("../cream/creamtext", 1);
    foreach ($textfiles as $textfile) {
        echo var_dump($textfile);
        unlink($textfile);
    }

    $imgfiles = scandir("../cream/creamimage", 1);
    foreach ($imgfiles as $imgfile) {
        echo var_dump($imgfile);
        unlink($imgfile);
    }
?>