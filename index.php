<?php
session_start();
include ('konfigurasi/koneksi.php');
include ('logger.php');
$judul  = "e-Poin";
if (!isset($_SESSION['id'])) {
    header("location: masuk.php");
}elseif($_SESSION['level'] == 'Pelajar'){
    header("location: pelajar/index.php");
}else {

    if(isset($_SESSION['waktu']) && (time() - $_SESSION['waktu'] > $_SESSION['habis'] )) {
        echo 'Kamu diem aja selama 30 Menit, silahkan <a href="masuk.php">masuk</a> lagi.';
        session_destroy();
    }else {
// Tiap masuk ke halaman, akan selalu di refresh waktu nya.
// Jik pengguna diem aja sampai waktu habis, maka akan di matikan session nya.
$_SESSION['waktu'] = time();
$sessionId = esc($_SESSION['id']);
$sql               = $koneksi->query("SELECT * FROM tb_pengguna WHERE id_pengguna = '$sessionId'");
$data              = $sql->fetch_assoc();
include ('tata_letak/atas.php');
?>
        <!-- Halaman dinamis -->
            <?php
            $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : "";
            $aksi    = isset($_GET['aksi']) ? $_GET['aksi'] : "";
            if ($halaman == ""){
                if ($aksi == ""){
                    include "halaman/beranda/beranda.php";
                }
            }
            if ($halaman == "profil"){
                if ($aksi == ""){
                    include "halaman/profil/profil.php";
                }
                if ($aksi == "gantikatasandi"){
                    include "halaman/profil/gantikatasandi.php";
                }
            }
            if ($halaman == "guru"){
                if($_SESSION['level'] == 'Admin'){
                if ($aksi == ""){
                    include "halaman/admin/guru/guru.php";
                }
                if ($aksi == "ubah"){
                    include "halaman/admin/guru/ubah.php";
                }
                if ($aksi == "tambah"){
                    include "halaman/admin/guru/tambah.php";
                }
                if ($aksi == "hapus"){
                    include "halaman/admin/guru/hapus.php";
                }
             }
                else {
                    echo "Permission Denied";
                }
            }
            if ($halaman == "pelajar"){
                if($_SESSION['level'] == 'Admin'){
                if ($aksi == ""){
                    include "halaman/admin/pelajar/pelajar.php";
                }
                if ($aksi == "lihat"){
                    include "halaman/admin/pelajar/lihat.php";
                }
                if ($aksi == "ubah"){
                    include "halaman/admin/pelajar/ubah.php";
                }
                if ($aksi == "tambah"){
                    include "halaman/admin/pelajar/tambah.php";
                }
                if ($aksi == "import"){
                    include "halaman/admin/pelajar/import.php";
                }
                if ($aksi == "hapus"){
                    include "halaman/admin/pelajar/hapus.php";
                }
                if ($aksi == "gantikatasandi"){
                    include "halaman/admin/pelajar/gantipass.php";
                }
             }
                else {
                    echo "Permission Denied";
                }
            }
            if ($halaman == "pelanggaran"){
                if($_SESSION['level'] == 'Admin'){
                if ($aksi == ""){
                    include "halaman/admin/pelanggaran/pelanggaran.php";
                }
                if ($aksi == "ubah"){
                    include "halaman/admin/pelanggaran/ubah.php";
                }
                if ($aksi == "tambah"){
                    include "halaman/admin/pelanggaran/tambah.php";
                }
                if ($aksi == "hapus"){
                    include "halaman/admin/pelanggaran/hapus.php";
                }
             }
                else {
                    echo "Permission Denied";
                }
            }
            // Untuk halaman guru saja.
            if ($halaman == "piket"){
                if ($aksi == ""){
                    include "halaman/admin/piket/piket.php";
                }
                if ($aksi == "pindai"){
                    include "halaman/admin/piket/pindai.php";
                }
                if ($aksi == "bulkinsert"){
                    include "halaman/admin/piket/bulk_insert.php";
                }
            }
            if ($halaman == "admin") {
                if($_SESSION['level'] == 'Admin'){
                include "halaman/admin/admin/admin.php";
                }
                else {
                echo '<script type="text/javascript">alert("Access Denied");</script>';
                include "halaman/beranda/beranda.php";
                }
            }
            ?>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->
</body>
<?php
include ('tata_letak/bawah.php')
?>
</html>
<?php
    }
}
?>
