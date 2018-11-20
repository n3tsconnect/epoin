<?php
$host   = "localhost";
$user   = "epoin";
$pass   = "bismillah";
$db     = "epoin";

$koneksi = new mysqli("$host", "$user", "$pass", "$db");
if (mysqli_connect_error())
  {
  echo "Waduh error gan :( </br> " . mysqli_connect_error();
  }
  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

function esc_trim($string){
  global $koneksi;
  return mysqli_real_escape_string($koneksi, trim($string));
}

function esc($string){
  global $koneksi;
  return mysqli_real_escape_string($koneksi, $string);
}
?>

