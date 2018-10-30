<div class="content mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Bulk Insert</strong>
                </div>
                <div class="card-body">
                    <form id="form-insert">
                        <div class="col-md-2">
                            <div class="form-group">
                            <input name="kelas" id="input-kelas" class="form-control" placeholder="Kelas" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <input name="nama" id="input-nama" class="form-control" placeholder="Nama" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="jenis-pelanggaran" class="form-control">
                                <?php
                                    $data = $koneksi->query("SELECT * FROM tb_pelanggaran ORDER BY id_pelanggaran");
                                    while ($pelanggaran = $data->fetch_assoc()){
                                        echo "<option data-poin='$pelanggaran[poin_pelanggaran]' value='$pelanggaran[id_pelanggaran]'>$pelanggaran[nama_pelanggaran]</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-success">
                            <i class="fa fa-plus"></i>  Tambah</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-sm btn-primary">
                    <i class="fa fa-check"></i> Submit</button>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Daftar Submit</strong>
                </div>
                <div class="card-body">
                    <table id="tabel-pelanggaran" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th><th>Nama</th><th>Pelanggaran</th><th>Keterangan</th><th>Poin</th><th>Timestamp</th>
                                </tr>
                                <tbody>
                                    <?php
                                        $no = 1;
                                        $data = $koneksi->query("SELECT * FROM tb_datapelanggar, tb_pelanggaran, tb_pengguna
                                        WHERE tb_datapelanggar.id_pelajar = '$id'
                                        AND tb_datapelanggar.id_pelanggaran = tb_pelanggaran.id_pelanggaran
                                        AND tb_datapelanggar.id_guru = tb_pengguna.id_pengguna");

                                        while($pelanggaran = $data->fetch_assoc()){
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $pelanggaran['nama_pelanggaran']; ?></td>
                                                <td><?php echo $pelanggaran['id_pelajar']; ?></td>
                                                <td><?php echo $pelanggaran['keterangan_pelanggaran']?></td>
                                                <td><?php echo $pelanggaran['poin_pelanggaran']?></td>
                                                <td><?php echo $pelanggaran['tanggal_pelanggaran']?></td>
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
    // Initialize data tables
    $(document).ready(function() {
        $('#tabel-pelanggaran').DataTable({
            order: [[0, "desc"]]
        });
    });
</script>
