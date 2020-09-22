//The current edited cream image
let currentCreamImage = null;

function CreamStart() {
    console.log("Cream v0.2 PHP Edition Starting");

    var creamTags = $("#graphicalEditor").contents().find('*[data-cream-type]');

    console.log("Number of Cream Tags found: " + creamTags.length);

    for (var i = 0; i < creamTags.length; i++) {
        AddOverlay(creamTags[i]);
    }
}

//Adds the overlay features on a modificable tag
function AddOverlay(tag) {
  $(tag).css("border", "3px solid #ece0d1");
  $(tag).css("border-radius", "10px");
  //Enabling transitions on this tag
  $(tag).css({
      WebkitTransition : 'border 0.2s ease-in-out',
      MozTransition    : 'border 0.2s ease-in-out',
      MsTransition     : 'border 0.2s ease-in-out',
      OTransition      : 'border 0.2s ease-in-out',
      transition       : 'border 0.2s ease-in-out'
  });
  //Adding mouseover event handler
  $(tag).on("mouseenter", function(event){
    HandleMouseEnter(tag, event);
  });
  //Adding mouseleave event handler
  $(tag).on("mouseleave", function(event){
    HandleMouseLeave(tag, event);
  });
  //Adding mouse click event handler
  $(tag).click(function(event){
    HandleClick(tag, event);
  });
}

/**
  Handles mouseOver for each CreamTags, when a mouse is over, darken the border
  @param: tag: The creamTag to control
  @param: event: The actual event
*/
function HandleMouseEnter(tag, event) {
  $(tag).css("border", "3px solid #967259");
}

/**
  Handles mouse leave for modificable tags, setting the color to the default one
  @param: tag: The creamTag to control
  @param: event: The actual event
*/
function HandleMouseLeave(tag, event) {
  $(tag).css("border", "3px solid #ece0d1");
}


/**
  Handles click for each modificable tags, it will trigger some methods depending
  on the type of the Cream Tag
  @param: tag: The creamTag to control
  @param: event: The actual event
*/
function HandleClick(tag, event) {
  var creamType = tag.dataset.creamType;
  //Changing color to edit color
  $(tag).css("border", "3px solid #38220f");
  // Editing creamText
  if (creamType == "text") {
    //Setting text to content editable
    $(tag).attr("contenteditable", true);
  }
  // Editing
  if (creamType == "image") {
    //Spawning the image gallery
    console.log("Editing immagine");
    currentCreamImage = tag;
    $("#gallery").animate({height: "100%"}, 500, function() {
      $("#gallery-box").text("");
      $("#current-image").attr('src', $(tag).attr('src'));
      $("#loading_spinner").css({'display':'inherit'});
      GetImages();
    });
  }
}

/**
  Get all the images from the IMG_PATH configured in config.php
  this file can be configured from the user, the frontend or the backend developer easiliy
*/
function GetImages() {
  console.log("Ottengo immagini");
  $.post('./php/get_images.php', {}, function(data){
    var parsed = JSON.parse(data);
    console.log(parsed);
    for (var i = 0; i < parsed.length; i++)  {
      $("#gallery-box").append("<div class='col-md-3'>" +
      "<img onclick='SelectImage(this);' src='" + parsed[i] + "' class='img-fluid'></img>" +
      "</div>");
    }
  }).done(function() {
    $("#loading_spinner").css({'display':'none'});
  });
}

/**
 * Select the image, if the save button is clicked, store it in CreamImages
 */
function SelectImage(img) {
  let src = img.src;

  $("#current-image").attr('src', src);

  console.log(src);
}

/**
 * Save the current selected image from the gallery
 */
function SaveImage() {
  let _id = currentCreamImage.dataset.creamName;
  let src = $("#current-image").attr('src');
  
  $.post("./php/saveImageFile.php", {id: _id, val: src}, function(data) {
    console.log(data);
  });
  CloseGallery();
}

/**
  Closes the gallery
*/
function CloseGallery() {
  $("#gallery").animate({height: "0%"}, 500, function() {
  });
  ReloadEditor();
}

/**
  Save all the tags into a single file stored in Cream* (CreamText, CreamImage, ecc...)
  @todo: Create database integration
*/
function SaveAll() {
  var textStrings = $("#graphicalEditor").contents().find('*[data-cream-type]');
  for (var i = 0; i < textStrings.length; i++)
  {
      console.log("POST request: id: " + textStrings[i].dataset.creamName + " value: " + textStrings[i].innerHTML);
      $.post("./php/saveTextFile.php", {id : textStrings[i].dataset.creamName,
                                        val: textStrings[i].innerHTML}, function(data) {
        console.log(data);
      });
  }
  ReloadEditor();
}

function ReloadEditor() {
  $("#graphicalEditor").attr('src', $("#graphicalEditor").attr('src'));
}
