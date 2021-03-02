<?php
/*
  -----------------------------------------------------------------------------
  FileManager.class.php
  This class handles all I/O operation beetween Cream files
  -----------------------------------------------------------------------------
*/
require_once("CreamTopping.class.php");
require_once("CreamPage.class.php");

class FileManager {
	/*
    -----------------------------------------------------------------------------
    Returns all the html files present in the root folder
    -----------------------------------------------------------------------------
    */
	public function GetHtmlFiles() {
		//echo "Getting PHP files...";
		$files = array();

		foreach (glob("../*.php") as $filename) {
			//Taking the last part only
			$exploded = explode("/", $filename);
			$filename = end($exploded);
			array_push($files, $filename);
		}

		return $files;
	}

	/**
    *-----------------------------------------------------------------------------
	* Returns all the pages files that are located in the main page folder
	* @return CreamPage[]
    * -----------------------------------------------------------------------------
    */
	public function GetPages() {
		$pages = array();
		foreach (scandir(__DIR__ . "/../../") as $possible_page) {
			$exploded = explode("/", $possible_page);
			$possible_filename = end($exploded);
			if (strpos($possible_filename, ".php") !== false) {
				// Cream Page will auto check if is valid or not, handle that
				$page = new CreamPage($possible_filename);
				if ($page->valid) array_push($pages, $page);
			}
		}
		return $pages;
	}

	/**
    *-----------------------------------------------------------------------------
	* Returns all the topping files that are located in the toppings local folder
	* @return CreamTopping[]
    * -----------------------------------------------------------------------------
    */
	public function GetToppings() {
		$toppings = array();
		foreach (scandir(__DIR__ . "/../toppings/") as $topping) {
			if ((strcmp($topping, ".") !== 0) && (strcmp($topping, "..") !== 0)) {
				//Taking the last part only
				$exploded = explode("/", $topping);
				$filename = end($exploded);
				$topping = new CreamTopping($filename);
				array_push($toppings, $topping);
			}
		}
		return $toppings;
	}

	/*
    -----------------------------------------------------------------------------
    Check if a proper text file is present into CreamText
    $id: the id to check
    -----------------------------------------------------------------------------
    */
	public function CheckTextFileById($id) {
		$textfiles = scandir("./cream/creamtext", 1);
		foreach ($textfiles as $textfile) {
			if ($textfile == $id) return true;
		}
		return false;
	}

	/*
    -----------------------------------------------------------------------------
    Check if a proper image file is present into CreamImage
    $id: the id to check
    -----------------------------------------------------------------------------
    */
	public function CheckImageFileById($id) {
		$textfiles = scandir("./cream/creamimage", 1);
		foreach ($textfiles as $textfile) {
			if ($textfile == $id) return true;
		}
		return false;
	}

	/*
    -----------------------------------------------------------------------------
    Save a text file by a given id and a value
    $id: the id to save
    $value: the text value for the id
    -----------------------------------------------------------------------------
    */
	public function SaveTextFileById($id, $value) {
		$idFile = fopen("./cream/creamtext/" . $id, "w");
		fwrite($idFile, $value);
	}

	/*
    -----------------------------------------------------------------------------
    Save an image file by a given id and a value
    $id: the id to save
    $value: the text value for the id
    -----------------------------------------------------------------------------
    */
	public function SaveImageFileById($id, $value) {
		$idFile = fopen("./cream/creamimage/" . $id, "w");
		fwrite($idFile, $value);
	}

	/*
    -----------------------------------------------------------------------------
    Save a text file by a given id and a value
    $id: the id to save
    $value: the text value for the id
    -----------------------------------------------------------------------------
    */
	public function GetTextFileById($id) {
		$idFileDir = "./cream/creamtext/" . $id;
		return file_get_contents($idFileDir);
	}

	/*
    -----------------------------------------------------------------------------
    Save a image file by a given id and a value
    $id: the id to save
    $value: the text value for the id
    -----------------------------------------------------------------------------
    */
	public function GetImageFileById($id) {
		$idFileDir = "./cream/creamimage/" . $id;
		return file_get_contents($idFileDir);
	}
}
$FileManager = new FileManager;
