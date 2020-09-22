//This stores all the modificable tags
var modificableTagsID = new Array();
var modificableTagsValue = new Array();
var modificableTagsName = new Array();

$(document).ready(function () {
  GetModificableTags();
});

//Gets and sets all the modificable tags
function GetModificableTags()
{
    //I need to nest 3 post requests before calling the other function
    //Getting the ids
    $.post("./modifier/php/read_file.php", {pageName: GetCurentFileName()},
    function(data)
    {
        //Removing []
        //data = data.substr(1, data.lenght - 1);
        //console.log(data);

        var parsed = JSON.parse(data);
        for (var i = 0; i < parsed.length; i++)
        {
            modificableTagsID.push(parsed[i].id);
            modificableTagsName.push(parsed[i].name);
            modificableTagsValue.push(parsed[i].value);
        }

        SetModificableTags();
    });
}

//Sets all the variables
function SetModificableTags()
{
  for (var i = 0; i < modificableTagsID.length; i++)
  {
    //Handling image modification
    if (modificableTagsName[i] == "IMG")
    {
      console.log("Sto modificando una immagine");
      $("#" + modificableTagsID[i]).attr("src", modificableTagsValue[i]);
    }
    else
    {
      $("#" + modificableTagsID[i]).text(modificableTagsValue[i]);
    }
  }
}

//Returns the current file name
function GetCurentFileName()
{
    var pagePathName = window.location.pathname;
    var lastPathSegment = pagePathName.substr(pagePathName.lastIndexOf('/') + 1);
    lastPathSegment = lastPathSegment.substr(0, lastPathSegment.lastIndexOf('.'));
    if (lastPathSegment == "") lastPathSegment = "index";
    return lastPathSegment;
}
