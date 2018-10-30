<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Profil saya</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Profil</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
            <div class="content mt-3">
                <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Foto profil</strong>
                            </div>
                            <div class="card-body">
                                <div class="mx-auto d-block">
                                    <img class="rounded-circle mx-auto d-block" style="width:85px; height:85px;" src="<?php
                                        if (file_exists('gambar/profil/guru/'.$data['foto_pengguna'].'')) { echo 'gambar/profil/guru/'.$data['foto_pengguna'].''; } else {echo 'http://placekitten.com/g/200/200';}
                                    ?>" alt="Card image cap">
                                    <h5 class="text-sm-center mt-2 mb-1"><?php echo $data['nama_pengguna']?></h5>
                                    <div class="location text-sm-center"><i class="fa fa-lightbulb-o"></i> <?php echo $data['level_pengguna']?></div>
                                </div>
                                <hr>
                                <div class="card-text text-sm-center">
                                    <a class="btn btn-outline-primary btn-lg btn-block" href="#" data-toggle="modal" data-target="#gantifoto">Ganti foto profil</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data diri</strong>
                            </div>
                            <div class="card-body card-block">
                        <form method="POST">
                        <div class="form-group">
                            <label class=" form-control-label">Username</label>
                            <input type="text" value="<?php echo $data['username_pengguna'];?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Nama</label>
                            <input name="nama" type="text" value="<?php echo $data['nama_pengguna'];?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Surat elektronik</label>
                            <input name="surel" type="email" value="<?php echo $data['surel_pengguna'];?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">No Telp</label>
                            <input name="notelp" type="number" value="<?php echo $data['telp_pengguna'];?>" class="form-control">
                        </div>
                        </div>
                        <div class="card-footer">
                        <button name="simpan" type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Simpan
                        </button>
                        <a href="?halaman=profil&aksi=gantikatasandi" class="btn btn-info btn-sm"><i class="fa fa-lock"></i> Ganti kata sandi</a>
                      </div>
                      </form>
                    </div>
                </div>
<?php
    if(isset($_POST['simpan'])){
        $nama       = $_POST['nama'];
        $surel      = $_POST['surel'];
        $notelp     = $_POST['notelp'];
    // Simpan ke database table tb_pengguna.
    $simpan = $koneksi->query("UPDATE tb_pengguna SET nama_pengguna = '$nama',
    surel_pengguna = '$surel', telp_pengguna = '$notelp' WHERE id_pengguna = '$_SESSION[id]'");
    // Jika berhasil disimpan.
    if ($simpan){
        ?>
        <script type="text/javascript">
        alert ("Berhasil memperbarui profil!");
        window.location.href = "index.php";
        </script>
        <?php
    }else{
        ?>
        <script type="text/javascript">
        alert ("Gagal memperbarui profil!");
        </script>
        <?php
    }
}
?>

 <div class="modal fade" id="gantifoto" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticModalLabel">Ganti foto profil</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="file" name="fotobaru" class="form-control"/>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button name="gantifoto" type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
<?php
if(isset($_POST['gantifoto'])){
    $foto     = $_FILES['fotobaru']['name'];
    $file     = $_FILES['fotobaru']['tmp_name'];
    $size     = $_FILES['fotobaru']['size'];
    $tipe     = $_FILES['fotobaru']['type'];
    $folder   = "gambar/profil/guru/";
    $saring   = array('gif','png' ,'jpg');
    if (strlen($foto)){
        // Cek format foto.
        $ext = pathinfo($foto, PATHINFO_EXTENSION);
        if(in_array($ext, $saring)){
            // Cek ukurannya.
            // 5242880 = 5MB.
            if($size<5242880){
                // Encrypt nama jadi hash sha1.
                $img     = sha1($foto);
                // Jika Mencoba upload & jika berhasil di upload
                if(move_uploaded_file($file, $folder.$img)){
                    // UPDATE tb_pengguna sesuai ID nya.
                    $koneksi->query("UPDATE tb_pengguna SET foto_pengguna='$img' WHERE id_pengguna='$_SESSION[id]'");
                    ?>
                    <script type="text/javascript">
                    alert("Berhasil mengganti foto profil!");
                    window.location.href = "?halaman=profil";
                    </script>
                    <?php
                }else{
                    // Jika gagal di upload.
                    ?>
                    <script type="text/javascript">
                    alert("Error!");
                    </script>
                    <?php
                }
            }else{
                // Jika gambar melebihi ukuran yang ditentukan.
                ?>
                <script type="text/javascript">
                alert("Ukuran gambar terlalu besar! (Max : 5MB)");
                </script>
                <?php
            }
        }else{
            // Jika format gambar tidak sesuai dengan $saring
            ?>
            <script type="text/javascript">
            alert("Format gambar tidak dizinkan!");
            </script>
            <?php
        }
    }else{
        // Jika belum memilih file foto.
        ?>
        <script type="text/javascript">
        alert("File foto belum dipilih!");
        window.location.href="index.php";
        </script>
        <?php
    }
}
?>                