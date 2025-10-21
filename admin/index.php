<?php
include 'init.php';

// ---- Routing sederhana di index.php ----
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// Jika URL nya /admin/home, load home.php
if ($uri === 'admin/dashboard') {
    require 'home.php';
    exit;
}

// ---- Proses login ----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_assoc($query);

        // NOTE: sebaiknya pakai password_hash & password_verify
        if ($password === $row['password']) {
            $_SESSION['ID_USER'] = $row['id'];
            $_SESSION['NAME'] = $row['name'];

            // Redirect ke /admin/home (tanpa .php)
            header("Location: /admin/dashboard");
            exit;
        } else {
            header("Location: /admin?error=password");
            exit;
        }
    } else {
        header("Location: /admin?error=username");
        exit;
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Adomx - Responsive Bootstrap 4 Admin Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <?php include '../admin/inc/css.php' ?>

</head>

<body class="skin-dark">

    <div class="main-wrapper">

        <!-- Content Body Start -->
        <div class="content-body m-0 p-0">

            <div class="login-register-wrap">
                <div class="row">

                    <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-5 col-12">
                        <div class="login-register-form-wrap">

                            <div class="content">
                                <h1>Sign in</h1>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>

                            <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger">
                                <?php
                                    if ($_GET['error'] === 'password') {
                                        echo "Password salah!";
                                    } elseif ($_GET['error'] === 'username') {
                                        echo "Username tidak ditemukan!";
                                    }
                                    ?>
                            </div>
                            <?php endif; ?>

                            <div class="login-register-form">
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-12 mb-20"><input class="form-control" type="text"
                                                name="username" placeholder="Username"></div>
                                        <div class="col-12 mb-20"><input class="form-control" type="password"
                                                name="password" placeholder="Password"></div>
                                        <div class="col-12 mb-20"><label for="remember" class="adomx-checkbox-2"><input
                                                    id="remember" type="checkbox"><i class="icon"></i>Remember.</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="row justify-content-between">
                                                <div class="col-auto mb-15"><a href="#">Forgot Password?</a></div>
                                                <div class="col-auto mb-15">Dont have account? <a
                                                        href="register.html">Create Now.</a></div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-10"><button
                                                class="button button-primary button-outline">sign in</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="login-register-bg order-1 order-lg-2 col-lg-7 col-12">
                        <div class="content">
                            <h1>Sign in</h1>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div><!-- Content Body End -->

    </div>

    <!-- JS -->
    <?php include '../admin/inc/js.php' ?>

</body>

</html>