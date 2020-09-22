//CheckSession();

function GetImages()
{
  console.log("Ottengo immagini");
  $.post('./php/get_images.php', {}, function(data){
    console.log(data);
    var parsed = JSON.parse(data);
    for (var i = 0; i < parsed.length; i++)
    {
      $("#gallery").append("<div class='col-md-3'>" +
      "<img src='" + parsed[i] + "' class='img-fluid'></img>" +
      "</div>");
    }
    $("#loading_spinner").css({'display':'none'});
  });
}

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
