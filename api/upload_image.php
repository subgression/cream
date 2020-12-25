<?php
// Basic response class
$response = new stdClass;

// If folder does not exist, error
if (!isset($_POST['path']) || !file_exists($_POST['path'])) {
  $response->status = 404;
  $response->msg = "Cannot find path!";
  echo json_encode($response);
  return;
}

// upload.php
$files = $_FILES['files'];
$file_path = $files['tmp_name'][0]; // temporary upload path of the first file
$file_name = $files['name'][0]; // desired name of the file
$target_path = $_POST['path'];

if (move_uploaded_file($file_path, $target_path . basename($file_name))) {
  $response->status = 200;
  $response->msg = "OK!";
  $response->path = $target_path;
  $response->filePath = $target_path . basename($file_name);

  echo json_encode($response);
}
else {
  $response->status = 401;
  $response->msg = "No permission to write to this folder!";
  $response->path = $target_path;
  $response->filePath = $target_path . basename($file_name);

  echo json_encode($response);
}
?>