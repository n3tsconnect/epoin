<?php
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
        $koneksi->query("UPDATE tb_pelajar SET poin_pelajar=(poin_pelajar + $poin) WHERE id_pelajar='$id'");
        ?>
         <script type="text/javascript">
         alert("Data berhasil disimpan!");
         window.location.href="?halaman=piket&aksi=pindai&id=<?php echo $id_pelajar;?>";
         </script>
         <?php
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
        $id_dispen = $koneksi->insert_id;
        ?>
         <script type="text/javascript">
         window.location.href="?halaman=piket&aksi=pindai&id=<?php echo $id_pelajar;?>";
         window.open('halaman/admin/piket/cetak.php?id=<?php echo $id_dispen; ?>&guru=<?php echo $id_guru;?>', 'mywindow', 'toolbar=0,scrollbars=1,statusbar=0,menubar=0,resizable=0,height=500,width=420');
         </script>
         <?php
    }
    

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

    if(isset($_POST['edit_pelanggaran'])){
        $id_pelanggaran = esc($_POST['id-pelanggaran']);
        $keterangan_pelanggaran = esc($_POST['keterangan-pelanggaran']);
        // Data dimasukan ke table data pelanggar.
        $koneksi->query("UPDATE tb_datapelanggar SET keterangan_pelanggaran = '$keterangan_pelanggaran' WHERE id = '$id_pelanggaran'");
    }
?>