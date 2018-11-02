<?php
    if(isset($_POST['delete_pelanggaran'])){
        $id_pelanggaran = esc($_POST['id_pelanggaran']);
        $sql = $koneksi->query("DELETE FROM tb_datapelanggar WHERE id = '$id_pelanggaran'");
    }

    if(isset($_POST['delete_izin'])){
        $id_izin = esc($_POST['id_izin']);
        $sql = $koneksi->query("DELETE FROM tb_datadispen WHERE id_dispen = '$id_izin'");
    }

    if(isset($_POST['edit_izin'])){
        $id_izin        = esc($_POST['id_izin']);
        $nama           = esc($_POST['nama_dispen']);
        $desk           = esc($_POST['deskripsi_dispen']);
        $darikapan      = esc($_POST['dari_kapan']);
        $sampaikapan    = esc($_POST['sampai_kapan']);

        // Data dimasukan ke table data dispensasi.
        $koneksi->query("UPDATE tb_datadispen SET nama_dispen = '$nama', deskripsi_dispen = '$desk', 
        dari_kapan = '$darikapan', sampai_kapan = '$sampaikapan' WHERE id_dispen = '$id_izin'");
    }
?>