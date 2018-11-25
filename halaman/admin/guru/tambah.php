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
                            <li class="active">Tambah guru</li>
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
                            <div class="card-body card-block col-lg-6">
                                <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class=" form-control-label">Nama</label>
                                                <input name="nama" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Username</label>
                                                <input name="username" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Surel</label>
                                                <input name="surel" type="email" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">No telp</label>
                                                <input name="notelp" type="number" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Level</label>
                                                    <select name="level" class="form-control">
                                                        <option value="">Pilih level</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Guru">Guru</option>
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Kata sandi</label>
                                                <input name="pass" type="password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Foto</label>
                                                <input name="foto" type="file" class="form-control" disabled>
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
    $nama           = esc($_POST['nama']);
    $username       = esc($_POST['username']);
    $surel          = esc($_POST['surel']);
    $notelp         = esc($_POST['notelp']);
    $level          = esc($_POST['level']);
    $pass           = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    /*$foto           = $_FILES['foto']['name'];
    $file           = $_FILES['foto']['tmp_name'];
    $size           = $_FILES['foto']['size'];
    $tipe           = $_FILES['foto']['type'];
    $folder         = "gambar/profil/guru/";
    $saring         = array('gif','png' ,'jpg');*/

    // UPDATE tb_pengguna sesuai ID nya.
    $koneksi->query("INSERT INTO tb_pengguna (username_pengguna, nama_pengguna, surel_pengguna,
    telp_pengguna, level_pengguna, pass_pengguna)
    VALUES('$username', '$nama', '$surel', '$notelp', '$level', '$pass')");
    action("PENGGUNA_TAMBAH", array("nama" => $nama, "level" => $level));
    ?>
    <script type="text/javascript">
    alert("Berhasil menambahkan guru/admin baru");
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
                    $koneksi->query("INSERT INTO tb_pengguna (username_pengguna, nama_pengguna, surel_pengguna,
                    telp_pengguna, level_pengguna, pass_pengguna, foto_pengguna)
                    VALUES('$username', '$nama', '$surel', '$notelp', '$level', '$pass', '$img')");
                    ?>
                    <script type="text/javascript">
                    alert("Berhasil menambahkan guru baru");
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
        // Jika tidak ada foto.
        ?>
        <script type="text/javascript">
        alert("Fotonya mana ?!");
        </script>
        <?php
    }*/
}
?>