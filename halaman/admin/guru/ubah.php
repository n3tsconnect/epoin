<?php
    $id_pengguna    = (int) esc($_GET['id']);
    $sql            = $koneksi->query("SELECT * FROM tb_pengguna WHERE id_pengguna = '$id_pengguna'");
    $pengguna       = $sql->fetch_assoc();
?>
            <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Ubah guru</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="?halaman=guru">Guru</a></li>
                            <li class="active">Ubah guru</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
            <div class="content mt-3">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data guru</strong>
                            </div>
                            <div class="card-body card-block">
                                <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class=" form-control-label">Nama</label>
                                                <input name="nama" type="text" class="form-control" value="<?php echo $pengguna['nama_pengguna'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Username</label>
                                                <input name="username" type="text" class="form-control" value="<?php echo $pengguna['username_pengguna'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Surel</label>
                                                <input name="surel" type="email" class="form-control" value="<?php echo $pengguna['surel_pengguna'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Foto profil</label>
                                                <img src="gambar/profil/guru/<?php echo $pengguna['foto_pengguna'];?>" class="form-control col-sm-2"/>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Ganti foto</label>
                                                <input name="gantifoto" type="file" class="form-control col-sm-3" disabled>
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
    $nama       = esc($_POST['nama']);
    $username   = esc($_POST['username']);
    $surel      = esc($_POST['surel']);
    /*$foto       = $_FILES['gantifoto']['name'];
    $file       = $_FILES['gantifoto']['tmp_name'];
    $size       = $_FILES['gantifoto']['size'];
    $tipe       = $_FILES['gantifoto']['type'];
    $folder     = "gambar/profil/guru/";
    $saring     = array('gif','png' ,'jpg');*/

    // UPDATE tb_pengguna sesuai ID nya.
    $koneksi->query("UPDATE tb_pengguna SET nama_pengguna='$nama', username_pengguna='$username',
    surel_pengguna='$surel' WHERE id_pengguna='$id_pengguna'");
    action("PENGGUNA_UPDATE", array("idPengguna" => $id_pengguna, "nama" => $nama, "username" => $username, "surel" => $surel));
    ?>
    <script type="text/javascript">
    alert("Berhasil memperbarui data guru");
    window.location.href = "?halaman=guru";
    </script>
    <?php

    /*if (strlen($foto)){
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
                    $koneksi->query("UPDATE tb_pengguna SET nama_pengguna='$nama', username_pengguna='$username',
                    surel_pengguna='$surel', foto_pengguna='$img' WHERE id_pengguna='$id_pengguna'");
                    ?>
                    <script type="text/javascript">
                    alert("Berhasil memperbarui data guru");
                    window.location.href = "?halaman=guru";
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
        // Jika tidak update Foto.
        $koneksi->query("UPDATE tb_pengguna SET nama_pengguna='$nama', username_pengguna='$username',
        surel_pengguna='$surel' WHERE id_pengguna='$id_pengguna'");
        ?>
        <script type="text/javascript">
        alert("Berhasil memperbarui data guru!");
        window.location.href = "?halaman=guru";
        </script>
        <?php
    }*/
}
?>