<?php
include_once("../../../csrf.php");
if (validateCSRFToken()) {
    if(isset($_POST['tambah-pelanggaran'])){
        $id_pelajar = esc($_POST['id_pelajar']);
        $id_pelanggaran = esc($_POST['jenis-pelanggaran']);
        $keterangan = esc($_POST['keterangan']);
        $id_guru        = esc($_SESSION['id']);
        $setting        = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $tanggal        = $setting->format('Y-m-d H:i:s');
        // Cek poin.
        $lihat          = $koneksi->query("SELECT * FROM tb_pelanggaran
        WHERE id_pelanggaran = '$id_pelanggaran'");
        $data           = $lihat->fetch_assoc();
        $poin           = $data['poin_pelanggaran'];
        // Data dimasukan ke table data pelanggar.
        $koneksi->query("INSERT INTO tb_datapelanggar (id_pelajar, id_pelanggaran, poin_pelanggaran,
        id_guru, tanggal_pelanggaran, keterangan_pelanggaran) VALUES ('$id_pelajar', '$id_pelanggaran', '$poin', '$id_guru', '$tanggal', '$keterangan')");
        // Tambah poin di table pelajar.
        $koneksi->query("UPDATE tb_pelajar SET poin_pelajar=(poin_pelajar + $poin) WHERE id_pelajar='$id_pelajar'");

        $currentPoin = $koneksi->query("SELECT poin_pelajar FROM tb_pelajar WHERE id_pelajar='$id_pelajar'");
        action("PELANGGARAN_TAMBAH", array("pelajar" => $id_pelajar, "keterangan" => $keterangan, "pelanggaran" => $id_pelanggaran));
        echo $currentPoin->fetch_assoc()['poin_pelajar'];
}

    if(isset($_POST['tambah-izin'])){
        $id_pelajar = esc($_POST['id_pelajar']);
        $nama           = esc($_POST['nama_dispen']);
        $desk           = esc($_POST['deskripsi_dispen']);
        $darikapan      = esc($_POST['dari_kapan']);
        $sampaikapan    = esc($_POST['sampai_kapan']);
        $id_guru        = esc($_SESSION['id']);
        $setting        = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $tanggal        = $setting->format('Y-m-d H:i:s');
        // Data dimasukan ke table data dispensasi.
        $koneksi->query("INSERT INTO tb_datadispen (id_pelajar, nama_dispen, deskripsi_dispen,
        id_guru, dari_kapan, sampai_kapan, tgl_dibuat)
        VALUES ('$id_pelajar', '$nama', '$desk', '$id_guru', '$darikapan', '$sampaikapan', '$tanggal')");
        action("IZIN_TAMBAH", array("pelajar" => $id_pelajar, "nama" => $nama, "deskripsi" => $desk, "dari" => $darikapan, "sampai" => $sampaikapan));
    }
    

    if(isset($_POST['delete_pelanggaran'])){
        $id_pelanggaran = esc($_POST['id_pelanggaran']);
        $sqlPelanggaran = $koneksi->query("SELECT * FROM tb_datapelanggar WHERE id = '$id_pelanggaran'");
        $dataPelanggaran = $sqlPelanggaran->fetch_assoc();
        $id_pelajar = $dataPelanggaran['id_pelajar'];
        $jenis_pelanggaran = $dataPelanggaran['id_pelanggaran'];
    
        // Cek poin.
        $lihat          = $koneksi->query("SELECT poin_pelanggaran FROM tb_pelanggaran WHERE id_pelanggaran = '$jenis_pelanggaran'");
        $data           = $lihat->fetch_assoc();
        $poin           = $data['poin_pelanggaran'];

        $sql = $koneksi->query("DELETE FROM tb_datapelanggar WHERE id = '$id_pelanggaran'");
        $koneksi->query("UPDATE tb_pelajar SET poin_pelajar = (poin_pelajar - '$poin') WHERE id_pelajar='$id_pelajar'");

        $currentPoin = $koneksi->query("SELECT poin_pelajar FROM tb_pelajar WHERE id_pelajar='$id_pelajar'");
        action("PELANGGARAN_DELETE", array("pelajar" => $id_pelajar, "idPelanggaran" => $id_pelanggaran));
        echo $currentPoin->fetch_assoc()['poin_pelajar'];
    }

    if(isset($_POST['delete_izin'])){
        $id_izin = esc($_POST['id_izin']);
        $sql = $koneksi->query("DELETE FROM tb_datadispen WHERE id_dispen = '$id_izin'");
        action("IZIN_DELETE", array("idIzin" => $id_izin));
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
        action("IZIN_UPDATE", array("idIzin" => $id_izin, "nama" => $nama, "deskripsi" => $desk, "dari" => $darikapan, "sampai" => $sampaikapan));
    }

    if(isset($_POST['edit_pelanggaran'])){
        $id_pelanggaran = esc($_POST['id-pelanggaran']);
        $keterangan_pelanggaran = esc($_POST['keterangan-pelanggaran']);
        // Data dimasukan ke table data pelanggar.
        $koneksi->query("UPDATE tb_datapelanggar SET keterangan_pelanggaran = '$keterangan_pelanggaran' WHERE id = '$id_pelanggaran'");
        action("PELANGGARAN_UPDATE", array("idPelanggaran" => $id_pelanggaran, "keterangan" => $keterangan_pelanggaran));
    }
}
?>