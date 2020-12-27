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
include_once("FileManager.class.php");
include_once("JSONDB.class.php");
include_once("CreamConfig.class.php");
// Required enums
include_once("enum/ETextTag.class.php");
include_once("enum/ECreamStorageMode.class.php");

class Cream {
  //The actual version of Cream
  const CREAM_VER = "v0.2.4a";
  // Type of storage mode
  const CREAM_STORAGE_MODE = ECreamStorageMode::FILE_MODE;
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

    switch($this::CREAM_STORAGE_MODE) {
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
          /** @todo add JSONDB save to file */
        }
        break;
      /** @todo: Add MYSQL_MODE */
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
    $FileManager = new FileManager;
    if ($FileManager->CheckImageFileById($id)) {
      echo $FileManager->GetImageFileById($id);
    } else {
      $FileManager->SaveImageFileById($id, $defaultSrc);
      echo $defaultSrc;
    }
  }
}

// ALWAYS singleton cream instance
$Cream = new Cream;
?>
