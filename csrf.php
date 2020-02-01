<?php
function getCSRFToken() {
  $generator = (new \RandomLib\Factory())->getMediumStrengthGenerator();
  $nonce = $generator->generateString(64);
  if (empty($_SESSION['csrf_tokens'])) {
      $_SESSION['csrf_tokens'] = array();
  }
  $_SESSION['csrf_tokens'][$nonce] = true;
  return $nonce;
}

function validateCSRFToken($token) {
  if (isset($_SESSION['csrf_tokens'][$token])) {
      return true;
  }
  return false;
}
?>