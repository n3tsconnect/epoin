<?php
    $id = esc($_GET['id']);
// Hapus id pelajarnya.
    $koneksi->query("DELETE FROM tb_pengguna WHERE id_pengguna = '$id'");
    action("PENGGUNA_DELETE", array("idPengguna" => $id));
?>
         <script type="text/javascript">
            alert("Data berhasil dihapus!");
            window.location.href="?halaman=guru";
        </script>
