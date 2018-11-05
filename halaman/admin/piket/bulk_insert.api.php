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

    if(isset($_GET['data_nama'])){
        $rowNo = 0;
        $data = $koneksi->query("SELECT id_pelajar, nama_pelajar FROM tb_pelajar;");
        $result = array();
        while($pelajar = $data->fetch_assoc()){
            $result[$rowNo] = array();
            $result[$rowNo]['id'] = $pelajar['id_pelajar'];
            $result[$rowNo]['text'] = $pelajar['nama_pelajar'];
            $rowNo++;
        }

        echo json_encode($result);
    }

    if(isset($_POST['submit_pelanggaran'])){
        $data = $_POST['data'];
        $str = "";
        foreach($data as &$pelanggaran){
            $str .= $pelanggaran[0]." ".$pelanggaran[1]." ".$pelanggaran[2]."\n";
        }
        echo $str;
    }
?>