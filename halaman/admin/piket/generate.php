<?php
if(!isset($_SESSION['csrf_tokens'][$token])) {
        $token = getCSRFToken();
}
?>