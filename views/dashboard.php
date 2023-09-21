<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-hidden layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/template/addons/" data-template="vertical-menu-template">

<?php include 'static/head.php'; ?>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Add menu -->
            <?php include_once 'static/menu.php'; ?>

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div id="dynamic-content">

                        </div>
                    </div>
                    <!-- / Content -->
                    <?php include_once 'static/footer.php'; ?>

                </div>
                <!-- Content wrapper -->

            </div>
            <!-- / Layout page -->

        </div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../assets/template/addons/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/template/addons/vendor/libs/popper/popper.js"></script>
    <script src="../assets/template/addons/vendor/js/bootstrap.js"></script>
    <script src="../assets/template/addons/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../assets/template/addons/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/template/addons/vendor/libs/hammer/hammer.js"></script>
    <script src="../assets/template/addons/vendor/libs/i18n/i18n.js"></script>
    <script src="../assets/template/addons/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../assets/template/addons/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Main JS -->
    <script src="../assets/template/addons/js/main.js"></script>
    <script src="../assets/js/scripts.js"></script>

</body>


</html>