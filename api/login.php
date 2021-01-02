<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
include_once ("../src/Stored.class.php");

session_start();
$stored = new Stored;
$stored->open();

if (isset($_POST['user']) and isset($_POST['password']))
{
    if ($stored->matchUser($_POST['user'], hash("md5", $_POST['password']))) {
        $_SESSION['user'] = $_POST['user'];
        echo 1;
    }
    else echo 0;
}
?>
