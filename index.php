<?php
include 'admin/koneksi.php';

$page = $_GET['page'] ?? 'project';
$contentFile = "content/{$page}.php";
$title = ucfirst(str_replace('-', ' ', $page));

if (!file_exists($contentFile)) {
  $title = 'Not Found';
  $contentFile = 'content/404.php';
}
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>N U V R ! O N</title>

  <!-- ===============================================-->
  <!--    Favicons-->
  <!-- ===============================================-->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
  <link rel="manifest" href="assets/img/favicons/manifest.json">
  <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
  <meta name="theme-color" content="#ffffff">

  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link href="assets/css/css?family=Raleway:100,200,300,400,500,700&amp;#x7c;Trirong:200,200i,300,300i,400,400i"
    rel="stylesheet">
  <link href="assets/css/css-1?family=Roboto:100,300,400,500,700,900&amp;#x7c" rel="stylesheet">
  <link href="assets/lib/lightbox2/css/lightbox.css" rel="stylesheet">
  <link href="assets/css/theme.css" rel="stylesheet">
</head>

<body>
  <!-- Navbar -->
  <?php include 'inc/navbar.php' ?>

  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main>

    <!-- ============================================-->
    <!-- Preloader ==================================-->
    <div class="preloader" id="preloader">
      <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-white-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    </div><!-- ============================================-->
    <!-- End of Preloader ===========================-->


    <?php include $contentFile; ?>

  </main><!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->


  <!-- Footer -->
  <?php include 'inc/footer.php' ?>

  <a class="btn-back-to-top" href="#top" data-fancyscroll=""><img src="assets/img/line-icons/upload-arrow.svg" width="8"
      alt=""></a>

  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <?php include 'inc/js.php' ?>
</body>

</html>