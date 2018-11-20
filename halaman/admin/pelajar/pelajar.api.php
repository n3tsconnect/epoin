<?php
    if(isset($_GET['data_tabel-pelajar'])){
        $rowNo = 0;
        $data = $koneksi->query("SELECT tb_pelajar.*, tb_kelas.nama_kelas FROM tb_pelajar INNER JOIN tb_kelas ON tb_pelajar.kelas_pelajar = tb_kelas.id_kelas;");
        $result = array();
        $result['data'] = array();
        while($pelajar = $data->fetch_assoc()){
            $result['data'][$rowNo] = array();
            $result['data'][$rowNo][0] = $pelajar['id_pelajar'];
            $result['data'][$rowNo][1] = $pelajar['nama_kelas'];
            $result['data'][$rowNo][2] = $pelajar['nis_pelajar'];
            $result['data'][$rowNo][3] = $pelajar['nama_pelajar'];
            $result['data'][$rowNo][4] = $pelajar['poin_pelajar'];
            $result['data'][$rowNo][5] = null;
            $rowNo++;
        }

        echo json_encode($result);
    }
?>