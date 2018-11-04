<?php
    if(isset($_GET['data_kelas'])){
        $rowNo = 0;
        $data = $koneksi->query("SELECT * FROM tb_kelas;");
        $result = array();
        while($kelas = $data->fetch_assoc()){
            $result[$rowNo] = array();
            $result[$rowNo]['id'] = $kelas['id_kelas'];
            $result[$rowNo]['text'] = $kelas['nama_kelas'];
            $rowNo++;
        }

        echo json_encode($result);
    }
?>