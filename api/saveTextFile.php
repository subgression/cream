<?php
	include_once ("../src/Stored.class.php");
	include_once ("../src/CreamConfig.class.php");
	include_once ("../src/JSONDB.class.php");
	include_once ("../src/models/BasicResponse.model.php");
	include_once ("../src/enum/ECreamStorageMode.class.php");
	
	$config = new CreamConfig;
	$creamStorageMode = $config->GetStorageMode();

	switch ($creamStorageMode) {
		case ECreamStorageMode::JSON_MODE:
			$jsondb = new JSONDB;
			$jsondb->SaveTextById($_POST['id'], $_POST['val']);
			$res = new BasicResponseModel(200, "Text file saved successuflly");
			$res->responde();
			break;
		case ECreamStorageMode::MYSQL_MODE:
			$stored = new Stored;
			$stored->open();
			if (!$stored->saveCreamText($_POST['id'], $_POST['val'])) {
				$res = new BasicResponseModel(500, "Something went wrong :(");
				$res->responde();
				$stored->close();
				return -1;
			}
			$stored->close();
			
			$res = new BasicResponseModel(200, "Text file saved successuflly");
			$res->responde();
			break;
	}
?>
