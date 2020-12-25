<?php 
    /**
     * Renders the sidebar component
     */
    function cream_render_footer() {
        ob_start();
?>
    <!-- Footer -->
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    Made with 💖 by <a href="https://www.subgression.com"> Subgression </a>
                </div>
                <div class="col-lg-3">
                    Repo Link: <br>
                    <a href="https://www.subgression.com"> Subgression </a>
                </div>
                <div class="col-lg-3">
                    Cream is a trademark of Subgression, Via Michelagelo 12, Vaiano Cremasco (CR)
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
<?php
        echo ob_get_clean();
    }
?>