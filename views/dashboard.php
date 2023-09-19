<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-hidden layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/template/addons/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Pepsico Settings</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/template/addons/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../assets/template/addons/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../assets/template/addons/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../assets/template/addons/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/template/addons/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/template/addons/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/template/addons/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/template/addons/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../assets/template/addons/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/template/addons/vendor/libs/typeahead-js/typeahead.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/template/addons/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../assets/template/addons/vendor/js/template-customizer.js"></script>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <!--  Logo  -->
                <div class="app-brand demo">
                    <a href="./dashboard.php" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold">HDCLucky</span>
                    </a>
                </div>
                <!--  End Logo  -->

                <!--  Sidebar -->
                <ul class="menu-inner py-1">

                    <li class="menu-item">
                        <a href="./data.php" class="menu-link" id="dbdata">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div data-i18n="Data">Dữ liệu</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="./result.php" class="menu-link" id="dbresult">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div data-i18n="Result">Kết quả</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="../index.php" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-file-description"></i>
                            <div data-i18n="Spin">Quay số</div>
                        </a>
                    </li>
                </ul>
                <!--  End Sidebar -->
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        testing
                    </div>
                    <div class="container-xxl flex-grow-2 container-p-y">
                        <?php
                        if (class_exists('ZipArchive')) {
                            echo 'ZipArchive is installed and enabled.<br>';
                        } else {
                            echo 'ZipArchive is NOT installed or enabled.<br>';
                        }
                        $zip = new ZipArchive;
                        echo 'ZipArchive class is available.';
                        ?>

                    </div>

                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                                <div>
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    - Copyright by <a href="https://Gyginee.dev" target="_blank" class="fw-medium">Gyginee | HDCreative</a>
                                </div>

                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->


                </div>
                <!-- Content wrapper -->

            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
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




    <script>
        // Function to load content dynamically and replace in the layout container
        function loadContent(text) {
            // Make an AJAX request to the PHP file
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Update the content in the layout container
                        document.querySelector('.content-wrapper').innerHTML = xhr.responseText;
                    } else {
                        console.error('Error loading content:', xhr.status);
                    }
                }
            };
            xhr.open('GET', text + '.php', true);
            xhr.send();
        }

        // Add an event listener to the menu item to trigger content loading
        const dataLink = document.querySelector('#dbdata');
        dataLink.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            loadContent('data'); // Load content when the menu item is clicked
        });

        // Add an event listener to the menu item to trigger content loading
        const resultLink = document.querySelector('#dbresult');
        resultLink.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            loadContent('result'); // Load content when the menu item is clicked
        });
    </script>

</body>


</html>