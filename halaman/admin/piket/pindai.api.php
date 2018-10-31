<?php
    if(isset($_GET['data_tabel-pelanggaran'])){
        $id_pelajar = esc($_GET['id_pelajar']);
        $no = 0;
        $data = $koneksi->query("SELECT * FROM tb_datapelanggar, tb_pelanggaran, tb_pengguna
        WHERE tb_datapelanggar.id_pelajar = '$id_pelajar'
        AND tb_datapelanggar.id_pelanggaran = tb_pelanggaran.id_pelanggaran
        AND tb_datapelanggar.id_guru = tb_pengguna.id_pengguna");
        $result = array();
        while($pelanggaran = $data->fetch_assoc()){
            $result[$no] = array();
            $result[$no]['no'] = $no + 1;
            $result[$no]['nama'] = $pelanggaran['nama_pelanggaran'];
            $result[$no]['keterangan'] = $pelanggaran['keterangan_pelanggaran'];
            $result[$no]['poin'] = $pelanggaran['poin_pelanggaran'];
            $result[$no]['tanggal'] = $pelanggaran['tanggal_pelanggaran'];
            $result[$no]['nama_piket'] = $pelanggaran['nama_pengguna'];
            $no++;
        }

        echo json_encode($result);
    }
?>
