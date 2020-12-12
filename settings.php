<!DOCTYPE html>
<?php
    include "src/CreamLoader.php";
    cream_loader();
?>
<html>
<?php
  //Looks for a GET request, telling what page to load
  $pagestr = '';
  if (isset($_GET['page']))
  {
    $pagestr = $_GET['page'];
  }
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Cream Manager | Settings </title>

    <?php cream_import_links(); ?>
</head>

<body>
    <div class="wrapper">
        <?php cream_render_sidebar(); ?>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-expand">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <p class="page-indicator"> Settings</p>
                </div>
            </nav>

            <!-- Settings Container -->
            <div class="container">
              <div class="row">
                <div class="col-lg-6">
                  <h2> Images configuration </h2>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="cream-autocompress-img">
                    <label class="form-check-label" for="cream-autocompress-img">Auto compress images</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="cream-user-upload-img">
                    <label class="form-check-label" for="cream-user-upload-img">Allow user upload</label>
                  </div>
                </div>
                <div class="col-lg-6">
                  <h2> Pages configuration </h2>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="cream-custom-routes">
                    <label class="form-check-label" for="cream-custom-routes">Allow custom routes</label>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="cream-page-caching">
                    <label class="form-check-label" for="cream-page-caching">Allow page caching</label>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>

    <?php cream_import_scripts(); ?>
</body>

</html>
