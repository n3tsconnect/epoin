<?php
    $id_pelajar     = (int) esc($_GET['id']);
    $sql            = $koneksi->query("SELECT * FROM tb_pelajar WHERE id_pelajar = '$id_pelajar'");
    $pelajar        = $sql->fetch_assoc();
?>
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Pelajar</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="?halaman=pelajar">Pelajar</a></li>
                            <li class="active">Lihat pelajar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data pelajar</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="col-lg-3">
                                <img style="width:150px; height:150px;" src="<?php
                                if (file_exists('gambar/profil/pelajar/'.$pelajar['foto_pelajar'].'')) { echo 'gambar/profil/pelajar/'.$pelajar['foto_pelajar'].''; } else {echo 'https://placekitten.com/g/200/200';}
                                  ?>"/>
                                </div>
                                <div class="col-lg-3">
                                        <div class="form-group">
                                                <label class=" form-control-label">NIS</label>
                                                <p><?php echo $pelajar['nis_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">Nama</label>
                                                <p><?php echo $pelajar['nama_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">No Telp</label>
                                                <p><?php echo $pelajar['telp_pelajar'];?></p>
                                        </div>
                                </div>
                                <div class="col-lg-3">
                                        <div class="form-group">
                                                <label class=" form-control-label">Surel</label>
                                                <p><?php echo $pelajar['surel_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">Status</label>
                                                <p id="status"><?php echo $pelajar['status_pelajar'];?></p>
                                        </div>
                                        <div class="form-group">
                                                <label class=" form-control-label">Poin</label>
                                                <p><?php echo $pelajar['poin_pelajar'];?></p>
                                        </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-primary btn-sm" href="?halaman=pelajar&aksi=ubah&id=<?php echo $id_pelajar;?>"><i class="fa fa-cogs"></i> Ubah</a>
                                <a href="?halaman=pelajar&aksi=gantikatasandi&id=<?php echo $id_pelajar;?>" class="btn btn-info btn-sm"><i class="fa fa-lock"></i> Ganti kata sandi</a>
                                <a onclick="return confirm ('Hapus data pelajar ini?')" class="btn btn-danger btn-sm" href="?halaman=pelajar&aksi=hapus&id=<?php echo $id_pelajar;?>"><i class="fa fa-remove"></i> Hapus</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title"> Riwayat Pelanggaran</strong>
                            </div>
                            <div class="card-body">
                              <div style="overflow:auto;">
                                <table id="tabel-pelanggaran" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th><th>Pelanggaran</th><th>Keterangan</th><th>Poin</th><th>Timestamp</th><th>Petugas</th>
                                        </tr>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                $data = $koneksi->query("SELECT * FROM tb_datapelanggar, tb_pelanggaran, tb_pengguna
                                                WHERE tb_datapelanggar.id_pelajar = '$id_pelajar'
                                                AND tb_datapelanggar.id_pelanggaran = tb_pelanggaran.id_pelanggaran
                                                AND tb_datapelanggar.id_guru = tb_pengguna.id_pengguna");

                                                while($pelanggaran = $data->fetch_assoc()){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $pelanggaran['nama_pelanggaran']; ?></td>
                                                        <td><?php echo $pelanggaran['keterangan_pelanggaran']?></td>
                                                        <td><?php echo $pelanggaran['poin_pelanggaran']?></td>
                                                        <td><?php echo $pelanggaran['tanggal_pelanggaran']?></td>
                                                        <td><?php echo $pelanggaran['nama_pengguna']?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Riwayat Izin</strong>
                            </div>
                            <div class="card-body">
                              <div style="overflow:auto;">
                                <table id="tabel-izin" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th><th>Izin</th><th>Keterangan</th><th>Dari</th><th>Sampai</th><th>Petugas</th>
                                        </tr>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                $data = $koneksi->query("SELECT * FROM tb_datadispen, tb_pengguna
                                                WHERE tb_datadispen.id_pelajar = '$id_pelajar'
                                                AND tb_datadispen.id_guru = tb_pengguna.id_pengguna");

                                                while($izin = $data->fetch_assoc()){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $izin['nama_dispen']; ?></td>
                                                        <td><?php echo $izin['deskripsi_dispen']?></td>
                                                        <td><?php echo date("H:i", strtotime($izin["dari_kapan"]))?>
                                                        <?php echo date("Y-m-d", strtotime($izin["tgl_dibuat"]))?></td>
                                                        <td><?php echo date("H:i", strtotime($izin["sampai_kapan"]))?>
                                                        <?php echo date("Y-m-d", strtotime($izin["tgl_dibuat"]))?></td>
                                                        <td><?php echo $izin['nama_pengguna']?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                    </thead>
                                </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

<script src="web/js/lib/data-table/datatables.min.js"></script>
<script src="web/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="web/js/lib/data-table/dataTables.buttons.min.js"></script>
<script src="web/js/lib/data-table/buttons.bootstrap.min.js"></script>
<script src="web/js/lib/data-table/jszip.min.js"></script>
<script src="web/js/lib/data-table/pdfmake.min.js"></script>
<script src="web/js/lib/data-table/vfs_fonts.js"></script>
<script src="web/js/lib/data-table/buttons.html5.min.js"></script>
<script src="web/js/lib/data-table/buttons.print.min.js"></script>
<script src="web/js/lib/data-table/buttons.colVis.min.js"></script>
<script src="web/js/lib/data-table/datatables-init.js"></script>
<script type="text/javascript">
var status = document.getElementById('status').innerHTML;
if (status == "Aktif"){
 document.getElementById('status').style.color = "#2ecc71";
}
if(status == "Nonaktif"){
document.getElementById('status').style.color = "#e74c3c";
}

$(document).ready(function() {
        $('#tabel-pelanggaran').DataTable({
            order: [[0, "desc"]]
        });
        $('#tabel-izin').DataTable({
            order: [[0, "desc"]]
        });
    });
</script>
