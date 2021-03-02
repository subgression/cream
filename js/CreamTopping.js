/**
 * Cream Topping Frontend System
 */

//The current edited cream image
let currentCreamImage = null;
// The current template getting edited
let currentTemplate = null;

// Adds an inner topping (with default values)
function AddInnerTopping() {
    $.post("./api/toppings/add.php",
    {
        t: currentTemplate
    }, function (data) {
        console.log(data);
        window.location = window.location;
    });
}

function CreamToppingStart(ct) {
    currentTemplate = ct;

    console.log("Cream Topping v0.1 PHP Edition Starting");
    if (currentTemplate == undefined) {
        console.error("FATAL: Topping editor can't start, topping name not provided");
        return;        
    }

    console.log("Editing topping: " + currentTemplate);

    var creamTags = $("#graphicalEditor").contents().find('*[data-cream-topping-type]');

    console.log("Number of Cream Tags found: " + creamTags.length);

    for (var i = 0; i < creamTags.length; i++) {
        AddOverlay(creamTags[i]);
    }
}

//Adds the overlay features on a modificable tag
function AddOverlay(tag) {
    // Hard replacing image src if DEFAULT is set 
    if (tag.dataset.creamToppingType == "image") {
        tag.src = 'https://via.placeholder.com/150';
    } 

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
    var creamType = tag.dataset.creamToppingType;
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
 * Upload an Image inside Cream storage 
 * @param {*} imageID The image ID
 * @param {string} nameID The name ID of the image name
 */
async function UploadImage(imageID, nameID) {
    let image = docuemnt.getElementById(imageID).files[0];
    let name = doucmente.getElementById(name).innerHTML;
    let formData = new FormData();

    formData.append("image", image);
    await fetch('./api/upload_image.php', {
        method: "POST",
        body: formData
    });
}

/**
  Save all the topping information (currently edited) in the storage
*/
function SaveAll() {
    var textStrings = $("#graphicalEditor").contents().find('*[data-cream-topping-type]');
    var Topping = { "Text" : [], "Image" : [] };
    for (var i = 0; i < textStrings.length; i++) {
        switch (textStrings[i].dataset.creamToppingType) {
            case "text":
                var TextJSON = { "id" : textStrings[i].dataset.creamToppingName, "val" : textStrings[i].innerHTML };
                Topping.Text.push(TextJSON);
                break;
            case "image":
                var ImageJSON = { "id" : textStrings[i].dataset.creamToppingName, "val" : textStrings[i].src };
                Topping.Image.push(ImageJSON);
                break;
        }
    }

    console.log("[CreamTopping] Will be saved topping with values: ");
    console.log(Topping);

    //ReloadEditor();
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