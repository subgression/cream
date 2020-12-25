<?php
    $response = new stdClass;
    $response->path = "../" .$_POST['path'];

    if (isset($_POST['path'])) {
        if (file_exists("../" .($_POST['path']))) {
            if (unlink("../" .$_POST['path'])) {
                $response->msg = "File removed succesfully";
                $response->code = 200;
            }
            else {
                $response->msg = "Error while unlinking image";
                $response->code = 402;
            }
        } 
        else {
            $response->msg = "File does not exists!";
            $response->code = 404;
        }
    }
    else {
        $response->msg = "No path given!!";
        $response->code = 403;
    }
    echo json_encode($response);
?>