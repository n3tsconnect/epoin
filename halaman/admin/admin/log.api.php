<?php
    if(isset($_GET['data_log'])){
        $sql = $koneksi->query('SELECT id, `action`, params, `timestamp`, user, ip from tb_log ORDER BY id DESC');
        $rowNo = 0;
        $result = array();
        $result['data'] = array();
        while($log = $sql->fetch_assoc()){
            $result['data'][$rowNo] = array();
            $result['data'][$rowNo][0] = $log['id'];
            $result['data'][$rowNo][1] = $log['action'];
            $result['data'][$rowNo][2] = $log['params'];
            $result['data'][$rowNo][3] = $log['user'];
            $result['data'][$rowNo][4] = $log['timestamp'];
            $result['data'][$rowNo][5] = $log['ip'];
            $rowNo++;
        }

        echo json_encode($result);
    }
?>