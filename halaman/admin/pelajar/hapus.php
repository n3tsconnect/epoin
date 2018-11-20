<?php
    $id_pelajar = esc($_POST['id']);
    // Hapus id pelajarnya.
    $koneksi->query("DELETE FROM tb_pelajar WHERE id_pelajar = '$id_pelajar'");

    echo "DONE";