<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
include_once("./src/Stored.class.php");
/*
$Stored = new Stored;
$Stored->open();
echo "Checking database existance";
if ($Stored->databaseExists()) {
    echo "Database exists!";
}
else {
    echo "Database does not exist?"; 
    echo $Stored->CreateDatabase();
}
*/


// Getting where in the wizard step the user currently is
$currentStep = 0;
if (isset($_POST["step"])) $currentStep = $_POST["step"];
?>

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
                <div class="card wizard-card">
                    <div class="card-body" id="wizard-container">
                        <!-- This will be the wizard container -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php cream_render_footer(); ?>
    <?php cream_import_scripts(false); ?>

    <script>
        let creamWizard = new CreamWizard('wizard-container');
        creamWizard.createWelcomePage();
    </script>
</body>

</html>