function CheckLogin()
{
    var user = $("#user")[0].value;
    var pass = $("#password")[0].value;

    $.post("./php/login.php", {user: user, password: pass}, function(data){
        console.log(data);
        if (data == 1)
        {
            window.location.href = "./modify.html";
        }
        else
        {
            ("#help")[0].value = "Password errata";
        }
    });
}
