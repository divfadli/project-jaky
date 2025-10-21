<?php
include 'init.php';
ob_start();

// Protect access
if (empty($_SESSION['ID_USER'])) {
    header("Location: ./?access=failed");
    exit;
}

// Determine content file and title
$page = $_GET['page'] ?? 'dashboard';
$contentFile = "content/{$page}.php";
$title = ucfirst(str_replace('-', ' ', $page));

if (!file_exists($contentFile)) {
    $title = 'Not Found';
    $contentFile = 'content/404.php';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= htmlspecialchars($title) ?> - Adomx Admin</title>
    <meta name="robots" content="noindex, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <?php include '../admin/inc/css.php'; ?>
</head>

<body class="skin-dark">

    <div class="main-wrapper">
        <!-- Header -->
        <?php include '../admin/inc/header.php'; ?>

        <!-- Sidebar -->
        <?php include '../admin/inc/sidebar.php'; ?>

        <!-- Content Body Start -->
        <div class="content-body">
            <div class="row justify-content-between align-items-center mb-10">
                <?php include '../admin/inc/page-heading.php'; ?>
            </div>

            <!-- Main Content -->
            <div class="content-section">
                <?php include $contentFile; ?>
            </div>
        </div>
        <!-- Content Body End -->

        <!-- Footer -->
        <?php include '../admin/inc/footer.php'; ?>
    </div>

    <!-- JS -->
    <?php include '../admin/inc/js.php'; ?>

    <!-- Plugins -->
    <script src="../admin/assets/js/plugins/moment/moment.min.js"></script>
    <script src="../admin/assets/js/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="../admin/assets/js/plugins/daterangepicker/daterangepicker.active.js"></script>
    <script src="../admin/assets/js/plugins/chartjs/Chart.min.js"></script>
    <script src="../admin/assets/js/plugins/chartjs/chartjs.active.js"></script>
    <script src="../admin/assets/js/plugins/vmap/jquery.vmap.min.js"></script>
    <script src="../admin/assets/js/plugins/vmap/maps/jquery.vmap.world.js"></script>
    <script src="../admin/assets/js/plugins/vmap/maps/samples/jquery.vmap.sampledata.js"></script>
    <script src="../admin/assets/js/plugins/vmap/vmap.active.js"></script>

</body>

</html>