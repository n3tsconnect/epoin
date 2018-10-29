<?php
    $id_pelajar = esc($_GET['id']);
// Hapus id pelajarnya.
    $koneksi->query("DELETE FROM tb_pelajar WHERE id_pelajar = '$id_pelajar'");
?>
         <script type="text/javascript">
            alert("Data berhasil dihapus!");
            window.location.href="?halaman=pelajar";
        </script>
        <?php
?>