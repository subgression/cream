//This stores all the modificable tags
var modificableTagsID = new Array();
var modificableTagsValue = new Array();
var modificableTagsName = new Array();
var fileName;

CheckSession();

//Check if the user is connected to the system
//Using a SSO style login
function CheckSession()
{
  console.log("Controllo variabili di sessione");
  $.post("./php/get_session.php", {}, function(data){
    console.log(data);
    if (data != 1)
    {
      console.log("Uer loggato");
      window.location.href = "./index.html";
    }
  });
}

//Logout the user
function Logout()
{
  $.post("./php/logout.php", {}, function(data){
      console.log("Logout eseguito");
      window.location.href = "./index.html";
  });
}

//Generate a list of aviable pages
function CreatePagesList()
{
    $.post("./php/get_html_files.php", {}, function(data){
      $("#pagesList").empty();
      var parsed = JSON.parse(data);
      for (var i = 0; i < parsed.length; i++)
      {
        console.log("Genero un link");
        var fileName = parsed[i].substr(parsed[i].lastIndexOf('/') + 1);

        var onclick = "onclick=ChangeSrc(" + "'../" + fileName + "')";
        $("#pagesList").append('<i class="fas fa-file"></i>');
        $("#pagesList").append("<button class='btn btn-custom' "+onclick+">"+fileName+"</button><br>");
      }
    });
}

//Obtains all the images
function GetImages()
{
  $.post('./php/get_images.php', {}, function(data){
    var parsed = JSON.parse(data);
    for (var i = 0; i < parsed.length; i++)
    {
      /* Olf working style
      $("#gallery").append("<div class='col-md-1'>" +
      "<img onclick='ModifyImage(this);' src='" + parsed[i] + "' class='img-fluid gallery-image'></img>" +
      "</div>");
      */
      $("#imageGallery").append("<li>" +
      "<img onclick='ModifyImage(this);' src='" + parsed[i] + "' class='img-fluid gallery-image'></img>" +
      "</li>");
    }
    $("#imageGallery").lightSlider();
  });
}


//Changes src in the editor
function ChangeSrc(src)
{
    modificableTagsID = [];
    modificableTagsName = [];
    modificableTagsValue = [];
    console.log(src);
    $("#graphicalEditor").attr("src", src);
    $("#pageContainer").attr("src", src);
}

//Sets the filename
function SetFileName(src)
{
    var lastPathSegment = src.substr(src.lastIndexOf('/') + 1);
    lastPathSegment = lastPathSegment.substr(0, lastPathSegment.lastIndexOf('.'));
    //console.log("Pagina in modifica: " + lastPathSegment);
    fileName = lastPathSegment;
}

//Prints all the modificable tags array
function PrintModificableTagsArray()
{
    console.log("Dimensione vettore: " + modificableTagsID.length);
    for (var i = 0; i < modificableTagsID.length; i++)
    {
        console.log("ID: " + modificableTagsID[i]);
        console.log("Valore: " + modificableTagsValue[i]);
    }
}

//Saves all the modificable tags into a file in the server
//jQuery post call to php
function SaveModificableTagsArray()
{
  $.post("./php/save_file.php", {ids: JSON.stringify(modificableTagsID),
                                 values: JSON.stringify(modificableTagsValue),
                                 names: JSON.stringify(modificableTagsName),
                                 pageName: fileName},
  function(data){
    console.log(data);
  });
}

//Create the array of modificable tags
function CreateModificableArray(res)
{
    $("#pageContainer").attr("src", res);
    $("#graphicalEditor").attr("src", res);
    SetFileName(res);
}

//Creates the textual editor
function CreateTextualEditor()
{
  $("#editorContainer").empty();

  $.post("./php/read_file.php", {pageName: fileName},
  function(data)
  {
      var parsed = JSON.parse(data);
      //console.log(modificableTagsID.length);
      for (var i = 0; i < parsed.length; i++)
      {
          CreateModifierForTag(parsed[i].id,
                               parsed[i].value,
                               parsed[i].name);
      }
  });
}

//Creates textual modifier for a tag
function CreateModifierForTag(id, value, name)
{
  var id = PrettifyID(id);
  var tagName = PrettifyTagName(name);
  $("#editorContainer").append("<h7 class='font-weight-bold'>" + id + "(" + tagName + ")" +"</h7><br>");
  $("#editorContainer").append(CreateInputForm(tagName, id, value));
}

//Creates input form modifier for tag
function CreateInputForm(name, id, value)
{
    //console.log(value.length);
    if (value.length >= 30)
    {
        return '<textarea class="form-control" rows="'+Math.ceil(value.length / 30)+'" id="'+id+'" aria-describedby="emailHelp">' + value + "</textarea>";
    }
    if (name == "IMG")
    {
        return '<input type="text" class="form-control" id="'+id+'" aria-describedby="emailHelp" value="TODO: Da fare">';
    }
    return '<input type="text" class="form-control" id="'+id+'" aria-describedby="emailHelp" value="'+value+'">';
}

//Formats an id like thisIsAnId_MT
//into something like This Is An Id
function PrettifyID(id)
{
  //Removing _MT
  id = id.slice(0, -3);

  //Splitting by uppercase
  var split = id.split(/(?=[A-Z]+|[1-9])/);

  //Composing the new formatted string
  var formatted = "";
  for (var i = 0; i < split.length; i++)
  {
      formatted += (split[i] + " ");
  }
  id = formatted;

  return id[0].toUpperCase() + id.substr(1);
}

//Prettify the tag name
function PrettifyTagName(tagName)
{
  if (tagName == "TITLE") return "Titolo";
  if (tagName == "P") return "Paragrafo";
  if (tagName == "A") return "Link";
  if (tagName == "H4") return "Sotto Titolo";
  if (tagName == "IMG") return "Immagine";
  return tagName;
}

//Gets and sets all the modificable tags
function GetModificableTags()
{
    var gotData = false;
    //Getting the values
    $.post("./php/read_file.php", {pageName: fileName},
    function(data)
    {
        var parsed = JSON.parse(data);
        for (var i = 0; i < parsed.length; i++)
        {
            //console.log(parsed[i].id);
            modificableTagsID[i] = parsed[i].id;
            modificableTagsName[i] = parsed[i].name;
            modificableTagsValue[i] = parsed[i].value;
            gotData = true;
        }
    });
    return;
}

//This function will create a graphical overlay for the modificable page
//Creates an overlay for tag if its modificable
//=============================================
//===========MAIN METHOD=======================
//=============================================
function ModifierStart()
{
  //Even before starting ask the server how many pages
  //are in the website and then add them into the list
  CreatePagesList();

  var src = $("#graphicalEditor").attr("src");
  //Setting the page container src
  $('#pageContainer').attr("src", src);

  SetFileName(src);

  var frame = $("#graphicalEditor");
  //Disabling all links in order to modify correctly
  $(frame).contents().find('a').removeAttr('href');
  //Getting all the elements on the iframe
  $(frame).contents().find("*").each(function(index, tag){
      CreateOverlayForTag(tag, frame);
  });

  //Getting previously saved tags
  GetModificableTags();
  //When all the modifiertags have been setted up
  //Create the textual editor page
  CreateTextualEditor();
}

function CreateOverlayForTag(parentTag, frame)
{
  $(parentTag).each(function(index, tag)
  {
    //Removing all <br>
    var brs = tag.getElementsByTagName('br');
    while (brs.length) {
      brs[0].parentNode.removeChild(brs[0]);
    }

    try {
      //If is parent of other elements
      //Has at least another child?
      if($(tag).children().length > 0)
      {
        for (var i = 0; i < $(tag).children().length; i++)
        {
            CreateOverlayForTag($(tag).children().eq(i));
        }
      }
      //If is a child tag
      else
      {
        //Is a custom id?
        if (tag.id.toString().includes("_MT"))
        {
          try
          {
              //Adding overlay
              AddOverlay($(frame).contents().find("#" + tag.id));
              //Adding to the modifier array
              AddToModifierTagArray(tag);
              //console.log("Numero attuale di tag modificabili: " + currentModificableTags);
          }
          catch (err)
          {
              console.log("Impossibile generare overlay");
              console.log(err);
          }
        }
      }
    }
    catch(err)
    {
      console.log("errore di lettura nel tag: " + tag + " all indice " + index);
      //console.log(tag);
    }
  });
}

//Adds the overlay features on a modificable tag
function AddOverlay(tag)
{
  tag.css("border", "3px solid white");
  tag.css("border-radius", "10px");
  //Enabling transitions on this tag
  tag.css({
      WebkitTransition : 'border 0.2s ease-in-out',
      MozTransition    : 'border 0.2s ease-in-out',
      MsTransition     : 'border 0.2s ease-in-out',
      OTransition      : 'border 0.2s ease-in-out',
      transition       : 'border 0.2s ease-in-out'
  });
  //Adding mouseover event handler
  tag.on("mouseenter", function(event){
    HandleMouseEnter($(this), event);
  });
  //Adding mouseleave event handler
  tag.on("mouseleave", function(event){
    HandleMouseLeave($(this), event);
  });
  //Adding mouse click event handler
  tag.click(function(event){
    HandleClick($(this), event);
  });
}

//Add a tag to the modifiertag array
function AddToModifierTagArray(tag)
{
  if (!IsInModifierTagArray(tag))
  {
    //Checking if is an image
    if ($(tag).is("img"))
    {
        modificableTagsID.push(tag.id);
        modificableTagsValue.push($(tag).attr("src"));
        modificableTagsName.push(tag.tagName);
    }
    else
    {
        modificableTagsID.push(tag.id);
        modificableTagsValue.push(tag.innerHTML);
        modificableTagsName.push(tag.tagName);
    }
  }
}

//Check if a tag is already inside of the array
function IsInModifierTagArray(tag)
{
  for (var i = 0; i < modificableTagsID.length; i++)
  {
    if (tag.id == modificableTagsID[i])
    {
      return true;
    }
  }
  return false;
}

//Handles mouse over for modificable tags
function HandleMouseEnter(tag, event)
{
  //Getting the scroll value
  var scroll = $(window).scrollTop();

  $(tag).css("border", "3px solid green");

  //Spawning the infotooltip
  $("#infoToolTip").css({'top':event.screenY + scroll - 100,
                         'position':'absolute'});
  $("#infoToolTip").html('');
  $("#infoToolTip").append('<h7>Nome del tag: '+PrettifyID(tag[0].id)+'</h7><br>');
  $("#infoToolTip").append('<h7>Tipo del tag: '+PrettifyTagName(tag[0].tagName)+'</h7><br>');
  $("#infoToolTip").css({'opacity':1.0});
}

//Handles mouse leave for modificable tags
function HandleMouseLeave(tag, event)
{
  $(tag).css("border", "3px solid white");
  $("#infoToolTip").css({'opacity':0.0});
  //$("#textEditor").css({'opacity':0.0});
}

//Handles onclick event for modificable tags
function HandleClick(tag, event)
{
  //Getting the scroll value
  var scroll = $(window).scrollTop();

  //Spawns image editor
  if (tag.is("img"))
  {
      $("#infoToolTip").css({'opacity':0.0});
      GetImages();
      $("#imageEditor").css({'bottom':'0px'});
      $("#textEditor").css({'bottom':'-200px'});
      $("#imageEditor #id_holder")[0].value = tag[0].id;
      $("#imageEditor #tag_holder")[0].value = tag[0].tagName;
  }
  else
  {
      //Spawning the text editor and hiding the tooltip
      $("#infoToolTip").css({'opacity':0.0});
      $("#imageEditor").css({'bottom':'-200px'});
      $("#textEditor").css({'bottom':'0px'});
      //$("#textEditor").css({'bottom':'100px',
      //                       'position':'absolute'});
      $("#textEditor #input_label").html('');
      $("#textEditor #input_label").append(PrettifyID(tag[0].id));
      $("#textEditor #input_text")[0].value = tag[0].textContent;
      $("#textEditor #id_holder")[0].value = tag[0].id;
      $("#textEditor #tag_holder")[0].value = tag[0].tagName;
      //console.log(tag);
      $("#textEditor").css({'bottom': '0px'});
  }
}

//Returns the index of the id, return -1 if no id has been found
function GetIndexOfByID(id)
{
  for (var i = 0; i < modificableTagsID.length; i++)
  {
    if (id == modificableTagsID[i]) return i;
  }
  return -1;
}

//Handles when the image is being clicked
//Handles tag modification, than saves the new json file and reloads the page
function ModifyImage(image)
{
  console.log(image);
  //Hiding the texteditor
  $("#imageEditor").css({'bottom':"-"+$("#imageEditor")[0].clientHeight+"px"});

  //Finding the index of the id
  console.log($("#imageEditor").contents().find("#id_holder")[0].value);
  var index = GetIndexOfByID($("#imageEditor").contents().find("#id_holder")[0].value);

  var str = $(image).attr("src");
  str = str.substr(str.indexOf('/') + 2);

  //Setting up the new values
  console.log("Setto src dell'immagine: " + str);
  modificableTagsValue[index] = str;

  //Saving the new files
  SaveModificableTagsArray();

  //Reloading the graphicalEditor
  $('#graphicalEditor').attr('src', $('#graphicalEditor').attr('src'));
}

//Handles when the text editor button is being clicked
//Handles tag modification, than saves the new json file and reloads the page
function ModifyTag()
{
  $("textEditor").css({'bottom':'-200px'});
  //Finding the index of the id
  var index = GetIndexOfByID($("#textEditor").contents().find("#id_holder")[0].value)
  console.log($("#textEditor").contents().find("#id_holder")[0].value);
  //Setting up the new values
  modificableTagsValue[index] = $("#input_text").val();

  //Saving the new files
  SaveModificableTagsArray();

  //Hiding all editors
  $("#textEditor").css({'bottom':'-200px'});
  $("#imageEditor").css({'bottom':'-200px'});
  $("#tooltip").css({'opacity':0.0});

  //Reloading the graphicalEditor
  $('#graphicalEditor').attr('src', $('#graphicalEditor').attr('src'));
}

//Hides whatever editor is connected to this function
function HideEditor(editor)
{
  console.log();
  $("#" + editor).css({'bottom':"-"+$("#"+editor)[0].clientHeight+"px"});
}
