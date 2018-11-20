<?php
    function getProfile($photo_url){
        if (file_exists('gambar/profil/guru/'.$photo_url.'')) {
            return 'gambar/profil/guru/'.$photo_url.''; 
        } else {
            return 'https://placekitten.com/g/200/200';
        }
    }

?>