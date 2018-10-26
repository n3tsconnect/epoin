<?php
include ('konfigurasi/koneksi.php');
if(isset($_POST["simpan"])){
    $pindai  = $_POST['pindai'];
    $sql     = $koneksi->query("SELECT * FROM tb_pelajar WHERE nis_pelajar = '$pindai'");
    $hasil   = $sql->fetch_assoc();
    $tujuan  = $hasil['nis_pelajar'];
    $cek     = $sql->num_rows;

    if($cek){
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?halaman=piket&aksi=pindai&nis=<?php echo $tujuan;?>";
            </script>
        <?php
    } else{
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?halaman=piket";
                alert("Pelajar tidak ditemukan!");
            </script>
        <?php
    }
} 
?>
<?php
if(isset($_POST["namasiswa"])){
    $pindai  = $_POST['nama_pelajar'];
    $sql     = $koneksi->query("SELECT nis_pelajar FROM tb_pelajar WHERE nama_pelajar = UPPER('$pindai')");
    $hasil   = $sql->fetch_assoc();
    $tujuan  = $hasil['nis_pelajar'];
    $cek     = $sql->num_rows;

    if($cek){
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?halaman=piket&aksi=pindai&nis=<?php echo $tujuan;?>";
            </script>
        <?php
    } else{
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?halaman=piket";
                alert("Pelajar tidak ditemukan!");
            </script>
        <?php
    }
} 
?>
