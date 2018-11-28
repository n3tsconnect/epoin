<?php
    session_start();
    include ('../konfigurasi/koneksi.php');
    include ('../profilepic.php');
    include ('../logger.php');
    include ('tata_letak_pelajar/atas.php');

    $id_pelajar     = (int) esc($_SESSION['id_pending']);
    $sql            = $koneksi->query("SELECT * FROM tb_pelajar WHERE id_pelajar = '$id_pelajar'");
    $pelajar        = $sql->fetch_assoc();
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Buat password baru untuk NIS <?php echo $pelajar['nis_pelajar']; ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
<div class="card">
    <div class="card-header">
        <strong class="card-title">Passwrord</strong>
    </div>
    <div class="card-body card-block">
        <form method="POST" enctype="multipart/form-data">
            <div class='form-group'>
                <label class='form-control-label'>Nama Lengkap</label>
                <input name='nama_pelajar' type='text' class='form-control'/>
            </div>
            <div class="form-group">
                <label class=" form-control-label">Password baru</label>
                <input name="baru" type="password" class="form-control">
            </div>
            <div class="form-group">
                <label class=" form-control-label">Konfirmasi password baru</label>
                <input name="konfirm" type="password" class="form-control">
            </div>
    </div>
    <div class="card-footer">
        <button name="simpan" type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i> Simpan
        </button>
    </div>
</div>
</form>
<?php include ('tata_letak_pelajar/bawah.php')?>
<?php
if(isset($_POST['simpan'])){
    $nama_pelajar = esc($_POST['nama_pelajar']);
    $pass_baru    = esc($_POST['baru']);
    $konfirmpass  = esc($_POST['konfirm']);
    // Hash katasandi yang baru.
    $passfix        = password_hash($pass_baru, PASSWORD_DEFAULT);
    // Cek panjang karakter, harus 6 atau lebih.
    if(strlen($pass_baru) <= 6){
        ?>
        <script type='text/javascript'>
        alert('Panjang kata sandi minimal 6 karakter!');
        </script>
        <?php
        }else{
    // Jika pass baru sama konfirmasi nya cocok.
        if($pass_baru == $konfirmpass){
            $koneksi->query("UPDATE tb_pelajar SET pass_pelajar='$passfix' WHERE id_pelajar='$id_pelajar'");
            action('PELAJAR_SELF_REGISTER', array('idPelajar' => $id_pelajar, 'nama' => $nama_pelajar));
            ?>
            <script type='text/javascript'>
            alert('Berhasil self register!');
            <?php     
            session_start();
            $_SESSION['id_pending'] = null; ?>
            window.location.href='../masuk.php';
            </script>
            <?php
        }else{
            echo "<script type='text/javascript'>alert('Password konfirmasi tidak cocok!');</script>";
        }
    }
}
?>