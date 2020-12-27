/**
 * Cream Frontend System
 */

// Goes to login
/**
 * @todo: Completely redo login system
 */
function Login() {
  var user = document.getElementById('inputUser').value;
  var password = document.getElementById('inputPassword').value;
  $.post("./api/login.php", {
    user: user,
    password: password
  }, function (data) {
    console.log(data);
    if (data == 1) window.location = "./index.php";
    console.error("Wrong user and password!");
  });
}

// Goes to Logout
function Logout() {
  $.post("./api/logout.php", {}, function (data) {
    window.location = "../"
  });
}

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
    WebkitTransition: 'border 0.2s ease-in-out',
    MozTransition: 'border 0.2s ease-in-out',
    MsTransition: 'border 0.2s ease-in-out',
    OTransition: 'border 0.2s ease-in-out',
    transition: 'border 0.2s ease-in-out'
  });
  //Adding mouseover event handler
  $(tag).on("mouseenter", function (event) {
    HandleMouseEnter(tag, event);
  });
  //Adding mouseleave event handler
  $(tag).on("mouseleave", function (event) {
    HandleMouseLeave(tag, event);
  });
  //Adding mouse click event handler
  $(tag).click(function (event) {
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
    let creamGallerySelector = new CreamGallerySelector(
      'gallerySelector', 
      'gallerySelectorGalleryContainer',
      'galleryEditorContainer',
      tag
      );
  }
}

/**
  Get all the images from the IMG_PATH configured in config.php
  this file can be configured from the user, the frontend or the backend developer easiliy
*/
/*
function GetImages() {
  console.log("Ottengo immagini");
  $.post('./api/get_images.php', {}, function (data) {
    var parsed = JSON.parse(data);
    console.log(parsed);
    for (var i = 0; i < parsed.length; i++) {
      $("#gallery-box").append("<div class='col-md-3 col-lg-2 mb-5'>" +
        "<img onclick='SelectImage(this);' src='" + parsed[i] + "' class='img img-fluid'></img>" +
        "</div>");
    }
  }).done(function () {
    $("#loading_spinner").css({
      'display': 'none'
    });
  });
}
*/

/**
 * Upload an Image inside Cream storage 
 * @param {*} imageID The image ID
 * @param {string} nameID The name ID of the image name
 */
async function UploadImage(imageID, nameID) {
  let image = docuemnt.getElementById(imageID).files[0];
  let name = doucmente.getElementById(name).innerHTML;
  let formData = new FormData();

  formData.append("image", image);
  await fetch('./api/upload_image.php', {method: "POST", body: formData});
}

/**
  Save all the tags into a single file stored in Cream* (CreamText, CreamImage, ecc...)
  @todo: Create database integration
*/
function SaveAll() {
  var textStrings = $("#graphicalEditor").contents().find('*[data-cream-type]');
  for (var i = 0; i < textStrings.length; i++) {
    console.log(textStrings[i].dataset.creamName);
    switch(textStrings[i].dataset.creamType) {
      case "text":
        console.log("POST request: id: " + textStrings[i].dataset.creamName + " value: " + textStrings[i].innerHTML);
        $.post("./api/saveTextFile.php", {
          id: textStrings[i].dataset.creamName,
          val: textStrings[i].innerHTML
        }, function (data) {
          console.log(data);
        });
        break;
      case "image":
        console.log(textStrings[i]);
        $.post("./api/saveImageFile.php", {
          id: textStrings[i].dataset.creamName,
          val: textStrings[i].src
        }, function (data) {
          console.log(data);
        });
        break;
    }
  }
  debugger;
  ReloadEditor();
}

function ReloadEditor() {
  $("#graphicalEditor").attr('src', $("#graphicalEditor").attr('src'));
}

function ResetDefaults() {
  console.log("[CREAM] Resetting defaults...");
  $.post("./api/reset_cream_files.php", null, function (data) {
    console.log(data);
  });
  window.location = window.location;
}
