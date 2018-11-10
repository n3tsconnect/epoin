<?php
    if(isset($_GET['data_tabel-kelas'])){
        $rowNo = 0;
        $data = $koneksi->query("SELECT * FROM tb_kelas;");
        $result = array();
        $result['data'] = array();
        while($pelajar = $data->fetch_assoc()){
            $result['data'][$rowNo] = array();
            $result['data'][$rowNo][0] = $pelajar['id_kelas'];
            $result['data'][$rowNo][1] = $pelajar['nama_kelas'];
            $rowNo++;
        }

        echo json_encode($result);
    }
?>