<?php
  session_start();

  if ($_SESSION['user'] == "user") echo 1;
  else echo 2;
?>
