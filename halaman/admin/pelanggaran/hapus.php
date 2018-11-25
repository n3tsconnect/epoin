<?php
    $id = esc($_GET['id']);
// Hapus id pelajarnya.
    $koneksi->query("DELETE FROM tb_pelanggaran WHERE id_pelanggaran = '$id'");
    action("JENIS_PELANGGARAN_DELETE", array("idPelanggaran" => $id));
?>
         <script type="text/javascript">
            alert("Data berhasil dihapus!");
            window.location.href="?halaman=pelanggaran";
        </script>
