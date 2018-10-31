<?php
    if(isset($_POST['delete_pelanggaran'])){
        $id_pelanggaran = esc($_POST['id_pelanggaran']);
        $sql = $koneksi->query("DELETE FROM tb_datapelanggar WHERE id = '$id_pelanggaran'");
    }
?>