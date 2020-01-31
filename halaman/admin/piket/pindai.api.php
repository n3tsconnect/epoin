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
    if(isset($_GET['data_tabel-izin'])){
        $id_pelajar = esc($_GET['id_pelajar']);
        $rowNo = 0;
        $data = $koneksi->query("SELECT * FROM tb_datadispen, tb_pengguna
        WHERE tb_datadispen.id_pelajar = '$id_pelajar'
        AND tb_datadispen.id_guru = tb_pengguna.id_pengguna");
        $result = array();
        $result['data'] = array();
        while($izin = $data->fetch_assoc()){
            $result['data'][$rowNo] = array();
            $result['data'][$rowNo][0] =  $izin['id_dispen'];
            $result['data'][$rowNo][1] =  $izin['nama_dispen']; 
            $result['data'][$rowNo][2] =  $izin['deskripsi_dispen'];
            $result['data'][$rowNo][3] =  date("H:i", strtotime($izin["dari_kapan"])). "\n".date("Y-m-d", strtotime($izin["tgl_dibuat"]));
            $result['data'][$rowNo][4] =  date("H:i", strtotime($izin["sampai_kapan"])). "\n" .date("Y-m-d", strtotime($izin["tgl_dibuat"]));
            $result['data'][$rowNo][5] =  $izin['nama_pengguna'];
            $result['data'][$rowNo][6] = null;
            $rowNo++;
        }

        echo json_encode($result);
    }

?>
