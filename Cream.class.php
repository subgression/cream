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
  include("FileManager.class.php");

  class Cream
  {
      //The actual version of Cream
      const CREAM_VER = "v0.2a";
      /*
      -----------------------------------------------------------------------------
      Returns current cream version
      -----------------------------------------------------------------------------
      */
      public function GetCreamVersion()
      {
          echo $this::CREAM_VER;
      }
      /*
      -----------------------------------------------------------------------------
      Render a text, if the id is not present in the folder CreamText, simply place the
      default value but save the id
      $id: The id of the text
      $defaultValue: default value to be displayed
      -----------------------------------------------------------------------------
      */
      public function Text($id, $defaultValue)
      {
          $FileManager = new FileManager;
          if ($FileManager->CheckTextFileById($id))
          {
              echo $FileManager->GetTextFileById($id);
          }
          else
          {
              $FileManager->SaveTextFileById($id, $defaultValue);
              echo $defaultValue;
          }
      }
      /*
      -----------------------------------------------------------------------------
      Render an image, if the id is not present in the folder CreamImage, simply place the
      default value but save the id
      $id: The id of the text
      $defaultSrc: default src to be displayed
      -----------------------------------------------------------------------------
      */
      public function Image($id, $defaultSrc)
      {
          $FileManager = new FileManager;
          if ($FileManager->CheckImageFileById($id))
          {
              echo $FileManager->GetImageFileById($id);
          }
          else
          {
              $FileManager->SaveImageFileById($id, $defaultSrc);
              echo $defaultSrc;
          }
      }
  }
  $Cream = new Cream;
?>
