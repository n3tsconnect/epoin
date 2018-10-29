<?php
    $id_pelanggaran = esc((int) $_GET['id']);
    $ambil          = $koneksi->query("SELECT * FROM tb_pelanggaran WHERE id_pelanggaran = '$id_pelanggaran'");
    $lihat          = $ambil->fetch_assoc();
?>
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Ubah jenis pelanggaran</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="?halaman=pelanggaran">Pelanggaran</a></li>
                            <li class="active">Ubah jenis pelanggaran</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
            <div class="content mt-3">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Jenis pelanggaran</strong>
                            </div>
                            <div class="card-body card-block">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class=" form-control-label">Nama</label>
                                                <input name="nama_pelanggaran" type="text" class="form-control" value="<?php echo $lihat['nama_pelanggaran'];?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Deskripsi</label>
                                                <textarea class="form-control" rows="4" cols="50" name="deskripsi_pelanggaran" required><?php echo $lihat['deskripsi_pelanggaran'];?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class=" form-control-label">Poin</label>
                                                <input name="poin_pelanggaran" type="number" class="form-control" value="<?php echo $lihat['poin_pelanggaran'];?>" required>
                                            </div>
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
    $nama       = esc($_POST['nama_pelanggaran']);
    $desk       = esc($_POST['deskripsi_pelanggaran']);
    $poin       = esc($_POST['poin_pelanggaran']);
    // Simpan di table pelanggaran.
    $sql    = $koneksi->query("UPDATE tb_pelanggaran SET nama_pelanggaran = '$nama',
    deskripsi_pelanggaran = '$desk', poin_pelanggaran = '$poin' WHERE id_pelanggaran = '$id_pelanggaran'");

    // Jika berhasil disimpan.
    if($sql){
        ?>
        <script type="text/javascript">
        alert("Data berhasil disimpan!");
        window.location.href="?halaman=pelanggaran";
        </script>
        <?php
    }

}
?>