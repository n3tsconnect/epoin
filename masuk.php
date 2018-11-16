<?php
session_start();
include ('konfigurasi/koneksi.php');

if ($_SESSION['id']){
    header("location:index.php");
}else{
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="web/css/normalize.css">
    <link rel="stylesheet" href="web/css/bootstrap.min.css">
    <link rel="stylesheet" href="web/css/font-awesome.min.css">
    <link rel="stylesheet" href="web/css/themify-icons.css">
    <link rel="stylesheet" href="web/css/flag-icon.min.css">
    <link rel="stylesheet" href="web/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="web/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="web/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="/">
                        <img class="align-content" src="gambar/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST" action="konfigurasi/cek_masuk.php">
                        <div class="form-group">
                            <label>Username / Surel</label>
                            <input name="username" type="text" class="form-control" placeholder="Username / Surel" autofocus>
                        </div>
                        <div class="form-group">
                            <label>Kata sandi</label>
                            <input name="katasandi" type="password" class="form-control" placeholder="Kata sandi">
                        </div>
                        <button name="masuk" type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="web/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="web/js/popper.min.js"></script>
    <script src="web/js/plugins.js"></script>
    <script src="web/js/main.js"></script>


</body>
</html>
<?php } ?>