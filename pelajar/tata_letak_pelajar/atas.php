<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $judul;?></title>
    <meta name="description" content="e-Poin <?php echo $judul;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="../../gambar/logo_rafipriatnablog.png">

    <link rel="stylesheet" href="../../web/css/normalize.css">
    <link rel="stylesheet" href="../../web/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../web/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../web/css/themify-icons.css">
    <link rel="stylesheet" href="../../web/css/flag-icon.min.css">
    <link rel="stylesheet" href="../../web/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="web/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../../web/scss/style.css">
    <link href="../../web/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../web/css/lib/datatable/dataTables.bootstrap.min.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>




    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">


                    </div>

                <!-- Rafi Priatna -->
                <div class="modal fade" id="rafiModal" tabindex="-1" role="dialog" aria-labelledby="rafiModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rafiModalLabel">e-Poin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Aplikasi <b>e-Poin</b> dikembangkan dengan <i style="color:#FF80AB" class="fa fa-heart"></i> oleh
                                    <a href="https://www.rafipriatna.web.id" target="_blank">Rafi Priatna</a>.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" style="width:35px; height:35px;" src="<?php if (file_exists('../gambar/profil/pelajar/'.$pelajar['foto_pelajar'].'')) { echo '../gambar/profil/pelajar/'.$pelajar['foto_pelajar'].''; } else {echo 'https://placekitten.com/g/200/200';} ?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="keluar.php"><i class="fa fa-power -off"></i>Keluar</a>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
