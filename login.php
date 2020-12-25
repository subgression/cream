<!DOCTYPE html>
<?php
include "src/CreamLoader.php";
cream_loader();
?>
<?php  ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Cream Manager | Login </title>
    <?php cream_import_links(); ?>
</head>

<body>
    <div class="wrapper">

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <p class="page-indicator">Login</p>
                </div>
            </nav>

            <div class="container text-center">
                <form class="form-signin">
                    <img class="mb-4" src="./img/cream_icon.png" alt="" width="72" height="72">
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <label for="inputEmail" class="sr-only">User</label>
                    <input type="text" id="inputUser" class="form-control mb-3" placeholder="User" required="" autofocus="">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control mb-3" placeholder="Password" required="">
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button type="button" class="btn btn-main mt-5" onclick="Login()">
                            <i class="fas fa-align-left"></i>
                            <span class="ml-2"> Login</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php cream_render_footer(); ?>
    <?php cream_import_scripts(false); ?>
</body>

</html>