<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
    include ("../../src/Stored.class.php");
    $stored = new Stored;
    $stored->open();

    echo "Match wrong user: \n";
    if ($stored->matchUser("user", "password")) echo "Match";
    else echo "Non Match \n";
    echo "Match right user: \n";
    if ($stored->matchUser("user", "5f4dcc3b5aa765d61d8327deb882cf99")) echo "Match \n";
    else echo "Non Match \n";

    echo "Test user existance: Testing Test \n";
    echo "Admin: (" .$stored->userExists("admin"). ")\n";
    echo "Test: (" .$stored->userExists("test"). ")\n";

    $stored->close();
?>