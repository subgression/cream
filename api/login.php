<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

session_start();

if (isset($_POST['user']) and isset($_POST['password']))
{
    if ($_POST['user'] == "user" and $_POST['password'] == "password")
    {
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['password'] = $_POST['password'];
        echo 1;
    }
    else echo 0;
}
?>
