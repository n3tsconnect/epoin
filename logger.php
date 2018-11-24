<?php

    function action($action, $params = array()){
        global $koneksi;
        $actionEsc = esc($action);
        $jsonParams = json_encode($params);
        $timestamp = date('Y-m-d H:i:s');
        echo $actionEsc;
        echo $jsonParams;
        echo $timestamp;
        echo var_dump(mysqli_error($koneksi));
        $koneksi->query("INSERT INTO tb_log (`action`, params, `timestamp`) VALUES ('$actionEsc', '$jsonParams', '$timestamp')");
        
    }
?>