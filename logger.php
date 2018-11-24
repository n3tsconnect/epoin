<?php
    function action($action, $params = array(), $description = null){
        global $koneksi;
        $actionEsc = esc($action);
        $descriptionEsc = esc($description);
        $jsonParams = json_encode($params);
        $timestamp = date('Y-m-d H:i:s');
        $user = $_SESSION['id'];
        $koneksi->query("INSERT INTO tb_log (`action`, `description`, params, `timestamp`, `user`) VALUES ('$actionEsc', '$description', '$jsonParams', '$timestamp', '$user')");
    }
?>