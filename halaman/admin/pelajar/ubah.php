<?php
    $id_pelajar     = (int) esc($_GET['id']);
    $sql            = $koneksi->query("SELECT * FROM tb_pelajar WHERE id_pelajar = '$id_pelajar'");
    $pelajar        = $sql->fetch_assoc();
?>
            <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Ubah pelajar</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="?halaman=pelajar">Pelajar</a></li>
                            <li><a href="?halaman=pelajar&aksi=lihat&id=<?php echo $id_pelajar;?>">Lihat pelajar</a></li>
                            <li class="active">Ubah pelajar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
            <div class="content mt-3">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data pelajar</strong>
                            </div>
                            <div class="card-body card-block">
                                <form method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class=" form-control-label">NIS</label>
                                                <input name="nis" type="number" class="form-control" value="<?php echo $pelajar['nis_pelajar'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Nama</label>
                                                <input name="nama" type="text" class="form-control" value="<?php echo $pelajar['nama_pelajar'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Surel</label>
                                                <input name="surel" type="email" class="form-control" value="<?php echo $pelajar['surel_pelajar'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Telp</label>
                                                <input name="notelp" type="number" class="form-control" value="<?php echo $pelajar['telp_pelajar'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="Aktif" <?php if($pelajar['status_pelajar']=='Aktif') { echo "selected"; } ?>>Aktif</option>
                                                    <option value="Nonaktif" <?php if($pelajar['status_pelajar']=='Nonaktif') { echo "selected"; } ?>>Nonaktif</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Foto profil</label>
                                                <img src="gambar/profil/pelajar/<?php echo $pelajar['foto_pelajar'];?>" class="form-control col-sm-2"/>
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
    $nis        = esc($_POST['nis']);
    $nama       = esc($_POST['nama']);
    $surel      = esc($_POST['surel']);
    $telp       = esc($_POST['notelp']);
    $status     = esc($_POST['status']);
    /*$foto       = $_FILES['gantifoto']['name'];
    $file       = $_FILES['gantifoto']['tmp_name'];
    $size       = $_FILES['gantifoto']['size'];
    $tipe       = $_FILES['gantifoto']['type'];
    $folder     = "gambar/profil/pelajar/";
    $saring     = array('gif','png' ,'jpg');*/

    // UPDATE tb_pelajar sesuai ID nya.
    $koneksi->query("UPDATE tb_pelajar SET nis_pelajar='$nis', nama_pelajar='$nama',
    surel_pelajar='$surel', telp_pelajar='$telp', status_pelajar='$status'
     WHERE id_pelajar='$id_pelajar'");
    action('PELAJAR_UPDATE', array('idPelajar' => $id_pelajar, 'nama' => $nama, 'nis' => $nis, 'surel' => $surel, 'telp' => $telp, 'status' => $status));
    ?>
    <script type="text/javascript">
    alert("Berhasil memperbarui data pelajar");
    window.location.href = "?halaman=pelajar&aksi=lihat&id=<?php echo $id_pelajar;?>";
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
                    // UPDATE tb_pelajar sesuai ID nya.
                    $koneksi->query("UPDATE tb_pelajar SET nis_pelajar='$nis', nama_pelajar='$nama',
                    surel_pelajar='$surel', telp_pelajar='$telp', status_pelajar='$status',
                    foto_pelajar='$img' WHERE id_pelajar='$id_pelajar'");
                    ?>
                    <script type="text/javascript">
                    alert("Berhasil memperbarui data pelajar");
                    window.location.href = "?halaman=pelajar&aksi=lihat&id=<?php echo $id_pelajar;?>";
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
        $koneksi->query("UPDATE tb_pelajar SET  nis_pelajar='$nis', nama_pelajar='$nama',
        surel_pelajar='$surel', telp_pelajar='$telp', status_pelajar='$status' WHERE id_pelajar='$id_pelajar'");
        ?>
        <script type="text/javascript">
        alert("Berhasil memperbarui data pelajar!");
        window.location.href = "?halaman=pelajar&aksi=lihat&id=<?php echo $id_pelajar;?>";
        </script>
        <?php
    }*/
}
?>