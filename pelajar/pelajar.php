<?php
    $id = (float) esc($_SESSION['id']);
    $sql    = $koneksi->query("SELECT tb_pelajar.*, tb_kelas.nama_kelas FROM tb_pelajar 
    INNER JOIN tb_kelas 
    ON tb_pelajar.kelas_pelajar = tb_kelas.id_kelas 
    WHERE tb_pelajar.id_pelajar = '$id';");
    $x      = $sql->fetch_assoc();

    // NIS bisa diganti dari URL nya.
    // Cek nis lagi.
    $cek    = $sql->num_rows;
    // Jika nis tidak ditemukan.
    if($cek == 0){
        ?>
        <script type="text/javascript">
        window.location.href="?halaman=piket";
        </script>
        <?php
    }
?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Piket</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <ol class="breadcrumb text-right">
                <li><a href="?halaman=piket">Piket</a></li>
                <li class="active">Pelajar</li>
            </ol>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title"> Data Pelajar</strong>
                </div>
                <div class="card-body">
                    <div class="col-lg-3">
                        <img style="width:150px; height:150px;" src="<?php echo getProfile($data['foto_pengguna']); ?>"/>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Nama</label>
                            <p><?php echo $x['nama_pelajar'];?></p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Kelas</label>
                            <p><?php echo $x['nama_kelas'];?></p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">NIS</label>
                            <p><?php echo $x['nis_pelajar'];?></p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Poin</label>
                            <p id="poin-pelajar"><?php echo $x['poin_pelajar'];?></p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">No. Telp</label>
                            <p><?php echo $x['telp_pelajar'];?></p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Status</label>
                            <p id="status"><?php echo $x['status_pelajar'];?></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="?halaman=pelajar&aksi=gantikatasandi&id=<?php echo $id;?>" class="btn btn-info btn-sm"><i class="fa fa-lock"></i> Ganti kata sandi</a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title"> Riwayat Pelanggaran</strong>
                </div>
                <div class="card-body">
                    <table id="tabel-pelanggaran" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th><th>Pelanggaran</th><th>Keterangan</th><th>Poin</th><th>Timestamp</th><th>Petugas</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Riwayat Izin</strong>
                </div>
                <div class="card-body">
                    <table id="tabel-izin" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th><th>Izin</th><th>Keterangan</th><th>Dari</th><th>Sampai</th><th>Petugas</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../web/js/lib/data-table/datatables.min.js"></script>
<script src="../web/js/lib/data-table/dataTables.bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    var tabel_pelanggaran = $('#tabel-pelanggaran').DataTable({
        "ajax": '../api.php?halaman=piket&aksi=pindai&data_tabel-pelanggaran=1&id_pelajar=<?php echo $id ?>',
        order: [[0, "desc"]]
    });
    var tabel_izin = $('#tabel-izin').DataTable({
        "ajax": '../api.php?halaman=piket&aksi=pindai&data_tabel-izin=1&id_pelajar=<?php echo $id ?>',
        order: [[0, "desc"]]
    });
});
</script>