<?php
  require '../../config.php';
  session_start();

  if ($_SESSION['user'] == USER) echo 1;
  else echo 2;
?>
