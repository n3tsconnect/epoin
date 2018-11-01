<?php
    if(isset($_GET['data_tabel-pelanggaran'])){
        $id_pelajar = esc($_GET['id_pelajar']);
        $rowNo = 0;
        $data = $koneksi->query("SELECT * FROM tb_datapelanggar, tb_pelanggaran, tb_pengguna
        WHERE tb_datapelanggar.id_pelajar = '$id_pelajar'
        AND tb_datapelanggar.id_pelanggaran = tb_pelanggaran.id_pelanggaran
        AND tb_datapelanggar.id_guru = tb_pengguna.id_pengguna");
        $result = array();
        $result['data'] = array();
        while($pelanggaran = $data->fetch_assoc()){
            $result['data'][$rowNo] = array();
            $result['data'][$rowNo][0] = $pelanggaran['id'];
            $result['data'][$rowNo][1] = $pelanggaran['nama_pelanggaran'];
            $result['data'][$rowNo][2] = $pelanggaran['keterangan_pelanggaran'];
            $result['data'][$rowNo][3] = $pelanggaran['poin_pelanggaran'];
            $result['data'][$rowNo][4] = $pelanggaran['tanggal_pelanggaran'];
            $result['data'][$rowNo][5] = $pelanggaran['nama_pengguna'];
            $result['data'][$rowNo][6] = null;
            $rowNo++;
        }

        echo json_encode($result);
    }
?>
