    <script src="admin/vendors/js/vendor.bundle.base.js"></script>

    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="./admin/vendors/chart.js/Chart.min.js"></script>
    <script src="./admin/vendors/moment/moment.min.js"></script>
    <script src="./admin/vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./admin/vendors/chartist/chartist.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="admin/js/off-canvas.js"></script>
    <script src="admin/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./admin/js/dashboard.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btn = document.getElementById("sidebarToggle");
            const sidebar = document.getElementById("sidebar");
            if (!btn || !sidebar) return;

            btn.addEventListener("click", function() {
                sidebar.classList.toggle("active");
            });
        });
    </script>

    <!-- End custom js for this page -->
