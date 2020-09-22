<!DOCTYPE html>
<html>
<?php include "./Cream.class.php"; ?>
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

    <title>Cream Manager | Dashboard </title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <img src="img/cream_icon.png" class="icon text-center" alt="The Cream Icon Logo">
                <h3>Cream Manager</h3>
                <h6> <?php $Cream->GetCreamVersion(); ?></h6>
            </div>

            <ul class="list-unstyled components">
                <p>Welcome Marco!</p>
                <li class="active">
                    <a href="./index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-edit"></i> Page Editor</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                      <?php $fm = new FileManager; ?>
                      <?php $files = $fm->GetHtmlFiles(); ?>
                      <?php foreach ($files as $value): ?>
                        <li>
                            <a href="./editor.php?page=<?php echo $value; ?>">
                              <i class="fas fa-file"></i> <?php echo $value; ?>
                            </a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-coffee"></i> Toppings</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#"><i class="fas fa-cookie-bite"></i> People</a>
                            <a href="#"><i class="fas fa-cookie-bite"></i> Porfolio</a>
                            <a href="#"><i class="fas fa-cookie-bite"></i> Guestbook</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fas fa-images"></i> Gallery</a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-tools"></i> Settings</a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-expand">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <p class="page-indicator">Editor: <?php echo $pagestr; ?></p>
                </div>
            </nav>
            <div class="container m-3">
              <div class="row">
                <div class="col-12 text-center">
                  <button type="button" onclick="SaveAll();" class="btn btn-expand">
                      <i class="fas fa-check"></i>
                      <span>Save</span>
                  </button>
                  <button type="button" class="btn btn-expand">
                      <i class="fas fa-times"></i>
                      <span>Discard</span>
                  </button>
                </div>
              </div>
            </div>
            <!-- Proper editor -->
            <!-- Editor -->
            <div class="col-md-12">
                <div class="text-center">
                  <iframe onload="CreamStart()" src="../<?php echo $pagestr; ?>" class="embed-responsive-item editor" id="graphicalEditor"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom text and image editor container -->
    <!-- Gallery -->
    <div id="gallery">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4" id="current">
            <img id="current-image" class="img-fluid"/>
          </div>
          <div class="col-md-8">
            <div class="container text-center">
              <h2>Select the new image</h2>
              <div class="col-12 text-center md-2" style="padding: 20px">
                  <button type="button" onclick="SaveImage();" class="btn btn-expand">
                      <i class="fas fa-check"></i>
                      <span>Apply</span>
                  </button>
                  <button type="button" onclick="CloseGallery();"class="btn btn-expand">
                      <i class="fas fa-times"></i>
                      <span>Exit</span>
                  </button>
                </div>
              <div class="row" id="gallery-box">

              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="loading_spinner" class="spinner text-center">
        <p>Loading images</p>
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
      </div>
    </div>
    <!-- Save/Close buttons -->
    <div id="editButtons" style="position: fixed; opacity:0.0;">
      <button type="btn btn-expand" name="button"><i class="fas fa-check"></i></button>
      <button type="btn btn-expand" name="button"><i class="fas fa-times"></i></button>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- Editor js -->
    <script src="js/Cream.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>
