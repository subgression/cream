<?php
/*
  -----------------------------------------------------------------------------
  Cream.class.php
  The class that handles all operation of rendering and editing for all tags
  and custom toppings
  -----------------------------------------------------------------------------
  */
?>

<?php
//Required imports
require_once("FileManager.class.php");
require_once("JSONDB.class.php");
require_once("CreamConfig.class.php");
require_once("Stored.class.php");
require_once("Debugger.php");
require_once("CreamTopping.class.php");
// Required enums
require_once("enum/ETextTag.class.php");
require_once("enum/ECreamStorageMode.class.php");

class Cream {
	//The actual version of Cream
	const CREAM_VER = "v0.3.0a";

	private $creamStorageMode = ECreamStorageMode::JSON_MODE;

	private $firstJSONsave = false;

	function __construct() {
		// Fetching config to detect what method is currently used to store data
		$config = new CreamConfig;
		$this->creamStorageMode = $config->GetStorageMode();
	}
	
	/**
	 * Returns current cream version
	 */
	public function GetCreamVersion() {
		echo $this::CREAM_VER;
	}

	/**
	 * Render a text, if the id is not present in the folder CreamText, simply place the
	 * default value but save the id
	 * @param string $id The current ID of the Text Element
	 * @param string $defaultValue The default value for this text
	 * @param ETextTag $tag_type The text type supported by Cream (p, h1, h2, span, etc...)
	 */
	public function Text($id, $defaultValue) {
		$text = "Update failed, Cream Error!";

		switch ($this->creamStorageMode) {
			case ECreamStorageMode::FILE_MODE:
				$FileManager = new FileManager;
				if ($FileManager->CheckTextFileById($id)) {
					$text = $FileManager->GetTextFileById($id);
				} else {
					$FileManager->SaveTextFileById($id, $defaultValue);
					$text = $defaultValue;
				}
				break;
			case ECreamStorageMode::JSON_MODE:
				$JSONDB = new JSONDB;
				if ($JSONDB->CheckTextByID($id)) {
					$text = $JSONDB->GetTextByID($id);
				} else {
					$JSONDB->SaveTextById($id, $defaultValue);
					$text = $defaultValue;
				}
				break;
			case ECreamStorageMode::MYSQL_MODE:
				if (!$this->firstJSONsave) return;
				$stored = new Stored;
				$stored->open();
				if ($stored->creamTextExists($id) != -1) {
					$text = $stored->getCreamText($id);
				}
				else {
					$stored->saveCreamText($id, $defaultValue);
					$text = $defaultValue;
				}
				$stored->close();
				$this->firstJSONsave = true;
				break;
		}
		echo $text;
	}

	/**
	 * Renders the text accordingly to the ETextTag type
	 * @param string $text The text to render
	 * @param ETextTag $tag_type The text type supported by Cream (p, h1, h2, span, etc...)
	 * @todo handle more tags
	 */
	private function RenderText($text, $tag_type) {
		switch ($tag_type) {
			case ETextTag::H2:
				echo "<h2>" . $text . "</h2>";
				break;
			case ETextTag::P:
				echo "<p>" . $text . "</p>";
				break;
			default:
				echo "Tag type currently not handled, Cream Error!";
				break;
		}
	}

	/**
	 * Render an image, if the id is not present in the folder CreamImage, simply place the
	 * default value but save the id
	 * @param string $id The current ID of this image tag element
	 * @param string $defaultSrc default src for this img tag
	 * @todo Add internal img tag handling
	 */
	public function Image($id, $defaultSrc) {
		switch ($this->creamStorageMode) {
			case ECreamStorageMode::FILE_MODE:
				$FileManager = new FileManager;
				if ($FileManager->CheckImageFileById($id)) {
					echo $FileManager->GetImageFileById($id);
				} else {
					$FileManager->SaveImageFileById($id, $defaultSrc);
					echo $defaultSrc;
				}
				break;
			case ECreamStorageMode::JSON_MODE:
				$JSONDB = new JSONDB;
				if ($JSONDB->CheckImageByID($id)) {
					$src = $JSONDB->GetImageByID($id);
				} else {
					$JSONDB->SaveImageById($id, $defaultSrc);
					$src = $defaultSrc;
				}
				echo $src;
				break;
			case ECreamStorageMode::MYSQL_MODE:
				$src = null;
				$stored = new Stored;
				$stored->open();
				if ($stored->creamImageExists($id) != -1) {
					$src = $stored->getCreamImage($id);
				}
				else {
					$stored->saveCreamImage($id, $defaultSrc);
					$src = $defaultSrc;
				}
				$stored->close();
				echo $src;
				break;
		}
	}

	/**
	 * Renders the topping by checking if values are existing in the various DB
	 * otherwhise it will create the DB entry
	 * @param strign $id the id of the topping
	 */
	public function Topping($id) {
		//$topping = new CreamTopping($id);
		$topping = null;

		switch ($this->creamStorageMode) {
			case ECreamStorageMode::FILE_MODE:
				break;
			case ECreamStorageMode::JSON_MODE:
				$JSONDB = new JSONDB;
				if ($JSONDB->CheckToppingByID($id)) {
					$topping = $JSONDB->GetToppingByID($id);
				} else {
					$topping = new CreamTopping($id);
					$JSONDB->SaveTopping($topping);
				}
				$topping->Build();
				break;
			case ECreamStorageMode::MYSQL_MODE:
				break;
		}
	}
}

// ALWAYS singleton cream instance
$Cream = new Cream;
?>
