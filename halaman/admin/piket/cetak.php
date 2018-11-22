<?php
include ('../../../konfigurasi/koneksi.php');
$id     = esc($_GET['id']);
$ea = $koneksi->query("SELECT * FROM tb_datadispen, tb_pengguna, tb_pelajar WHERE id_dispen = '$id'
AND tb_datadispen.id_guru = tb_pengguna.id_pengguna AND tb_datadispen.id_pelajar = tb_pelajar.id_pelajar");
?>
<script type="text/javascript">
// Reload halaman saat pertama kali dibuka. Agar datanya muncul.
window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
    if (window.location.href.toLowerCase().indexOf("loaded") < 0) {
        window.location = window.location.href + '?loaded=1'
   }
}
</script>
<style>
@font-face{
    font-family: code128;
    src: url(../../barcode/code128.ttf);
}
hr.gaya1 {
	background-color: #fff;
	border-top: 2px dashed #8c8b8b;
}
hr.gaya2 {
    border: 0;
    height: 1px;
    background: #333;
    background-image: -webkit-linear-gradient(left, #ccc, #333, #ccc);
    background-image: -moz-linear-gradient(left, #ccc, #333, #ccc);
    background-image: -ms-linear-gradient(left, #ccc, #333, #ccc);
    background-image: -o-linear-gradient(left, #ccc, #333, #ccc);
}
tr.gaya3 {
	border-top: 1px dashed #8c8b8b;
}
fieldset.title {
    background: url(../../images/web/hr.png) repeat-x 0 0;
    border: 0;
    display: block;
    text-align: center;    
    padding-top: 2px;
    padding-bottom: 1px;
}

fieldset.title legend {
    padding: 5px 10px;
    background: #fff;
}
.ket, .nama {
    width: 300px;
    height: auto;
}
</style>
<?php
    $x = $ea->fetch_assoc();
?>
<center>

</center>
<fieldset class="title">
    <b><legend>DISPENSASI</legend></b>
</fieldset>
<table style="width:100%">
    <tr>
        <td>Dibuat tanggal</td>
        <td><?php echo $x['tgl_dibuat'];?></td>
    </tr>
    <tr>
        <td>Petugas</td>
        <td><?php echo $x['nama_pengguna'];?></td>
    </tr>
    <tr>
        <td>Nama pelajar</td>
        <td><?php echo $x['nama_pelajar'];?></td>
    </tr>
</table>
<br>
<b>Dispen :</b><br/>
<div class="nama">
<?php echo $x['nama_dispen'];?>
</div><br/>
<b>Keterangan :</b>
<div class="ket">
<?php echo $x['deskripsi_dispen'];?>
</div>
<hr class="gaya3">
<center>
    <p>Ini adalah kartu bukti dispensasi<br/> <b>JANGAN SAMPAI HILANG!</b></p>
</center>
