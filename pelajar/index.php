<?php
session_start();
include ('../konfigurasi/koneksi.php');
include ('tata_letak_pelajar/atas.php');
if (!isset($_SESSION['id'])) {
    header("location: masuk.php");
}
$id_pelajar = $_SESSION['id'];
$sql = $koneksi->query("SELECT * FROM tb_pelajar WHERE id_pelajar = $id_pelajar;");
$pelajar = $sql->fetch_assoc();
?>
<?php
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : "";
$aksi    = isset($_GET['aksi']) ? $_GET['aksi'] : "";
if ($halaman == ""){
    if ($aksi == ""){
        include "pelajar/pelajar.php";
    }
} ?>

<?php
include('tata_letak_pelajar/bawah.php');
?>
