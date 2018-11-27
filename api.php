<?php
session_start();
include ('konfigurasi/koneksi.php');
include ('logger.php');
$judul  = "e-Poin";
if (!isset($_SESSION['id'])) {
    header("location: masuk.php");
}elseif($_SESSION['level'] == 'Pelajar'){
    $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : "";
    $aksi    = isset($_GET['aksi']) ? $_GET['aksi'] : "";
    if ($aksi == "pindai"){
        include "halaman/admin/piket/pindai.api.php";
    }
}else {
    if(isset($_SESSION['waktu']) && (time() - $_SESSION['waktu'] > $_SESSION['habis'] )) {
        echo 'Kamu diem aja selama 30 Menit, silahkan <a href="masuk.php">masuk</a> lagi.';
        session_destroy();
    }else {
        $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : "";
        $aksi    = isset($_GET['aksi']) ? $_GET['aksi'] : "";
        // Untuk halaman guru saja.
        if ($halaman == "piket"){
            if ($aksi == "terimainput"){
                include "halaman/admin/piket/terima_input.php";
            }
            if ($aksi == "poin"){
                include "halaman/admin/piket/poin.api.php";
            }
            if ($aksi == "pindai"){
                include "halaman/admin/piket/pindai.api.php";
            }
            if ($aksi == "bulkinsert"){
                include "halaman/admin/piket/bulk_insert.api.php";
            }
        }
        
        if ($halaman == "pelajar"){
            if ($aksi == "pelajar"){
                include "halaman/admin/pelajar/pelajar.api.php";
            }
            
            if ($aksi == "hapus"){
                include "halaman/admin/pelajar/hapus.php";
            }

            if ($aksi == "import"){
                include "halaman/admin/pelajar/import.api.php";
            }
        }
    }
}
?>
