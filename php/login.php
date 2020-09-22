<?php

require '../../config.php';

session_start();

if (isset($_POST['user']) and isset($_POST['password']))
{
    if ($_POST['user'] == USER and $_POST['password'] == PASSWORD)
    {
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['password'] = $_POST['password'];
        echo 1;
    }
    else echo 0;
}
?>
