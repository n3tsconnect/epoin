<?php
    function getProfile($photo_url){
        if($photo_url == null){
            return 'https://placekitten.com/g/200/200';
        }
        if (file_exists('gambar/profil/guru/'.$photo_url.'')) {
            return 'gambar/profil/guru/'.$photo_url.''; 
        } else {
            return 'https://placekitten.com/g/200/200';
        }
    }

?>