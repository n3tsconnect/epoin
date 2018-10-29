<?php
    $id_pelajar     = (int) esc($_GET['id']);
    $sql            = $koneksi->query("SELECT * FROM tb_pelajar WHERE id_pelajar = '$id_pelajar'");
    $pelajar        = $sql->fetch_assoc();
?>
            <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Ganti kata sandi pelajar</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="?halaman=pelajar">Pelajar</a></li>
                            <li><a href="?halaman=pelajar&aksi=lihat&id=<?php echo $id_pelajar;?>">Lihat pelajar</a></li>
                            <li class="active">Ganti kata sandi pelajar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
            <div class="content mt-3">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Kata sandi</strong>
                            </div>
                            <div class="card-body card-block">
                                <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class=" form-control-label">Kata sandi baru</label>
                                                <input name="baru" type="password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Konfirmasi kata sandi baru</label>
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
<?php
if(isset($_POST['simpan'])){
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
            ?>
            <script type='text/javascript'>
            alert('Berhasil ganti kata sandi!');
            window.location.href = "?halaman=pelajar&aksi=lihat&id=<?php echo $id_pelajar;?>";
            </script>
            <?php
        }else{
            echo "<script type='text/javascript'>alert('Password konfirmasi tidak cocok!');</script>";
        }
    }
}
?>