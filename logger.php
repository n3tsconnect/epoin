<?php
    function action($action, $description = null, $params = array()){
        global $koneksi;
        $actionEsc = esc($action);
        $descriptionEsc = esc($description);
        $jsonParams = json_encode($params);
        $timestamp = date('Y-m-d H:i:s');
        echo $actionEsc;
        echo $jsonParams;
        echo $timestamp;
        echo var_dump(mysqli_error($koneksi));
        $koneksi->query("INSERT INTO tb_log (`action`, `description`, params, `timestamp`) VALUES ('$actionEsc', '$description', '$jsonParams', '$timestamp')");
    }
?>