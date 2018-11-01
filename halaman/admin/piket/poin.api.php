<?php
    if(isset($_POST['delete_pelanggaran'])){
        $id_pelanggaran = esc($_POST['id_pelanggaran']);
        $sql = $koneksi->query("DELETE FROM tb_datapelanggar WHERE id = '$id_pelanggaran'");
    }

    if(isset($_POST['delete_izin'])){
        $id_izin = esc($_POST['id_izin']);
        $sql = $koneksi->query("DELETE FROM tb_datadispen WHERE id_dispen = '$id_izin'");
    }
?>