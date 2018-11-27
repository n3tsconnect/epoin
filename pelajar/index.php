<?php
session_start();
include ('../konfigurasi/koneksi.php');
$judul  = "e-Poin";
if (!isset($_SESSION['id'])) {
    header("location: ../masuk.php");
}
else {
    if(isset($_SESSION['waktu']) && (time() - $_SESSION['waktu'] > $_SESSION['habis'] )) {
        echo 'Kamu diem aja selama 30 Menit, silahkan <a href="masuk.php">masuk</a> lagi.';
        session_destroy();
    }
else {
// Tiap masuk ke halaman, akan selalu di refresh waktu nya.
// Jik pengguna diem aja sampai waktu habis, maka akan di matikan session nya.
$_SESSION['waktu'] = time();
$id_pelajar = $_SESSION['id'];
$sql = $koneksi->query("SELECT * FROM tb_pelajar WHERE id_pelajar = $id_pelajar;");
$pelajar = $sql->fetch_assoc();
include ('tata_letak_pelajar/atas.php');
?>
        <!-- Halaman dinamis -->
            <?php
            $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : "";
            $aksi    = isset($_GET['aksi']) ? $_GET['aksi'] : "";
            if ($halaman == ""){
                if ($aksi == ""){
                    include "pelajar.php";
                }
            }
            ?>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->
</body>
<?php
include ('tata_letak_pelajar/bawah.php')
?>
</html>
<?php
    }
}
?>
