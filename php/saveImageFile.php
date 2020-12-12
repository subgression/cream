<?php
  if (isset($_POST['id']) and isset($_POST['val'])) {
    echo "Saving creamText with ID: " .$_POST['id'];
    $id = $_POST['id'];
    $value = $_POST['val'];
    $idFile = fopen("../creamimage/" . $id, "w");
    fwrite($idFile, $value);
    fclose($idFile);
  }
  else {
    echo "Cream ERROR: Malformed request";
  }
?>
