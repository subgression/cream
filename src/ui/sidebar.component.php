<?php 
    /**
     * Renders the sidebar component
     */
    function cream_render_sidebar() {
        error_reporting(E_ALL);
        ini_set('display_errors', 'on');
        ob_start();
?>
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <img src="img/cream_icon.png" class="icon text-center" alt="The Cream Icon Logo">
                <h3>Cream Manager</h3>
                <?php $Cream = new Cream ?>
                <p><?php $Cream->GetCreamVersion(); ?></p>
            </div>

            <ul class="list-unstyled components">
                <p>Welcome <?php 
                session_start();
                if (isset($_SESSION['user'])) {
                    echo $_SESSION["user"] . "!";
                }
                else header('Location: ./login.php');
                ?></p>
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
                            <a href="#"><i class="fas fa-cookie-bite"></i> WIP </a>
                            <!--
                            <a href="#"><i class="fas fa-cookie-bite"></i> People</a>
                            <a href="#"><i class="fas fa-cookie-bite"></i> Porfolio</a>
                            <a href="#"><i class="fas fa-cookie-bite"></i> Guestbook</a>
                            -->
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#gallerySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-image"></i> Gallery</a>
                    <ul class="collapse list-unstyled" id="gallerySubmenu">
                        <?php
                            // Getting all image paths from Cream Config
                            $cc = new CreamConfig();
                            $nodes = $cc->GetAllImagePaths();
                            foreach ($nodes as $imageNode): ?>
                                <a href="./gallery.php?name=<?php echo $imageNode->name; ?>">
                                    <i class="fas fa-file"></i> <?php echo $imageNode->name; ?>
                                </a>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li>
                    <a href="#videoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-video"></i> Video Gallery</a>
                    <ul class="collapse list-unstyled" id="videoSubmenu">
                        <li>
                            <a href="#"><i class="fas fa-cookie-bite"></i> WIP </a>
                            <!--
                            <a href="#"><i class="fas fa-cookie-bite"></i> People</a>
                            <a href="#"><i class="fas fa-cookie-bite"></i> Porfolio</a>
                            <a href="#"><i class="fas fa-cookie-bite"></i> Guestbook</a>
                            -->
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="./image_upload.php"><i class="fas fa-arrow-up"></i> Image Upload</a>
                </li>
                <li>
                    <a href="./settings.php"><i class="fas fa-tools"></i> Settings</a>
                </li>
                <li>
                    <a href="./utilities.php"><i class="fas fa-screwdriver"></i> Utilities</a>
                </li>
                <li>
                    <a href="#" onclick="Logout()"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                </li>
            </ul>
        </nav>
        <!-- END sidebar -->
<?php
        echo ob_get_clean();
    }
?>