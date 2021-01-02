<?php
    include_once ("../src/Stored.class.php");
    include_once ("../src/models/BasicResponse.model.php");

	$stored = new Stored;
	$stored->open();
	if (!$stored->saveCreamText($_POST['id'], $_POST['val'])) {
		$res = new BasicResponseModel(500, "Something went wrong :(");
		$res->responde();
		$stored->close();
		return -1;
	}
    $stored->close();
    
    $res = new BasicResponseModel(200, "Image file saved successuflly");
	$res->responde();
?>
