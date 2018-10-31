<?php
    $id = (float) esc($_GET['id']);
    $sql    = $koneksi->query("SELECT * FROM tb_pelajar WHERE id_pelajar = '$id'");
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
                        <img style="width:150px; height:150px;" src="<?php
                        if (file_exists('gambar/profil/pelajar/'.$x['foto_pelajar'].'')) { echo 'gambar/profil/pelajar/'.$x['foto_pelajar'].''; } else {echo 'http://placekitten.com/g/200/200';}
                          ?>"/>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Nama</label>
                            <p><?php echo $x['nama_pelajar'];?></p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Kelas</label>
                            <p><?php echo $x['kelas_pelajar'];?></p>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">NIS</label>
                            <p><?php echo $x['nis_pelajar'];?></p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">Poin</label>
                            <p><?php echo $x['poin_pelajar'];?></p>
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
                    <button name="pelanggaran" type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-pelanggaran">
                        <i class="fa fa-plus"></i> Pelanggaran
                    </button>
                    <button name="izin" type="submit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-izin">
                        <i class="fa fa-plus"></i> Izin
                    </button>
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
                                <th>No</th><th>Pelanggaran</th><th>Keterangan</th><th>Poin</th><th>Timestamp</th><th>Petugas</th><th><i class="fa fa-cogs"></i></th>
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
                                <th>No</th><th>Izin</th><th>Keterangan</th><th>Dari</th><th>Sampai</th><th>Petugas</th>
                            </tr>
                            <tbody>
                                <?php
                                    $no = 1;
                                    $data = $koneksi->query("SELECT * FROM tb_datadispen, tb_pengguna
                                    WHERE tb_datadispen.id_pelajar = '$id'
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

<!-- Modal -->
<div class="modal fade" id="modal-pelanggaran" tabindex="-1" role="dialog" aria-labelledby="pelanggaranLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pelanggaranLabel">Tambah Pelanggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-pelanggaran">
                    <div class="form-group">
                        <label class="form-control-label">Jenis Pelanggaran</label>
                        <select name="jenis-pelanggaran" class="form-control" onClick="previewPoin(this)">
                            <?php
                                $data = $koneksi->query("SELECT * FROM tb_pelanggaran ORDER BY id_pelanggaran");
                                while ($pelanggaran = $data->fetch_assoc()){
                                    echo "<option data-poin='$pelanggaran[poin_pelanggaran]' value='$pelanggaran[id_pelanggaran]'>$pelanggaran[nama_pelanggaran]</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Keterangan</label>
                        <textarea class="form-control" rows="4" cols="50" name="keterangan"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Poin</label>
                        <p name="poin" id="previewPoin"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button form="form-pelanggaran" type="submit" name="tambah-pelanggaran" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-izin" tabindex="-1" role="dialog" aria-labelledby="izinLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="izinLabel">Tambah izin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-izin" onsubmit="printfunction()">
                    <div class="form-group">
                        <label class=" form-control-label">Nama dispen</label>
                        <input name="nama_dispen" type="text" class="form-control" placeholder="Misalnya : Pulang ke rumah, Barang tertinggal, dsb" required/>
                    </div>
                    <div class="form-group">
                        <label class=" form-control-label">Deskripsi</label>
                        <textarea class="form-control" rows="4" cols="50" name="deskripsi_dispen" placeholder="Misalnya : Ada barang yang tertinggal dirumah." required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Dari jam</label>
                        <input name="dari_kapan" id="dispen-start" type="time" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Sampai jam</label>
                        <input name="sampai_kapan" id="dispen-end" type="time" class="form-control" required />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button form="form-izin" type="submit" name="tambah-izin" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['tambah-pelanggaran'])){
        $id_pelanggaran = esc($_POST['jenis-pelanggaran']);
        $keterangan = esc($_POST['keterangan']);
        $id_guru        = esc($_SESSION['id']);
        $setting        = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $tanggal        = $setting->format('Y-m-d H:i:s');
        // Cek poin.
        $lihat          = $koneksi->query("SELECT * FROM tb_pelanggaran
        WHERE id_pelanggaran = '$id_pelanggaran'");
        $data           = $lihat->fetch_assoc();
        $poin           = $data['poin_pelanggaran'];
        // Data dimasukan ke table data pelanggar.
        $koneksi->query("INSERT INTO tb_datapelanggar (id_pelajar, id_pelanggaran, poin_pelanggaran,
        id_guru, tanggal_pelanggaran, keterangan_pelanggaran) VALUES ('$id', '$id_pelanggaran', '$poin', '$id_guru', '$tanggal', '$keterangan')");
        // Tambah poin di table pelajar.
        $koneksi->query("UPDATE tb_pelajar SET poin_pelajar=(poin_pelajar + $poin) WHERE id_pelajar='$id'");
        ?>
         <script type="text/javascript">
         alert("Data berhasil disimpan!");
         window.location.href="?halaman=piket&aksi=pindai&id=<?php echo $id;?>";
         </script>
         <?php
    }
    if(isset($_POST['tambah-izin'])){
        $nama           = esc($_POST['nama_dispen']);
        $desk           = esc($_POST['deskripsi_dispen']);
        $darikapan      = esc($_POST['dari_kapan']);
        $sampaikapan    = esc($_POST['sampai_kapan']);
        $id_guru        = esc($_SESSION['id']);
        $setting        = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
        $tanggal        = $setting->format('Y-m-d H:i:s');
        // Data dimasukan ke table data dispensasi.
        $koneksi->query("INSERT INTO tb_datadispen (id_pelajar, nama_dispen, deskripsi_dispen,
        id_guru, dari_kapan, sampai_kapan, tgl_dibuat)
        VALUES ('$id', '$nama', '$desk', '$id_guru', '$darikapan', '$sampaikapan', '$tanggal')");
        $id_dispen = $koneksi->insert_id;
        ?>
         <script type="text/javascript">
         window.location.href="?halaman=piket&aksi=pindai&id=<?php echo $id;?>";
         window.open('halaman/admin/piket/cetak.php?id=<?php echo $id_dispen; ?>&guru=<?php echo $id_guru;?>', 'mywindow', 'toolbar=0,scrollbars=1,statusbar=0,menubar=0,resizable=0,height=500,width=420');
         </script>
         <?php
    }
?>

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
    // Ambil poin
    function previewPoin(element) {
        var poin = element.options[element.selectedIndex].getAttribute("data-poin");
        document.getElementById("previewPoin").innerHTML = poin;
    }
    
    function deletePelanggaran(id_pelanggaran){
        if(confirm("Delete pelanggaran dengan id " + id_pelanggaran + "?")){
            $.ajax({
                type: "POST",
                url: "api.php?halaman=piket&aksi=poin",
                data: {
                    delete_pelanggaran: 1,
                    id_pelanggaran: id_pelanggaran
                },
                success: function(html){
                    alert("Pelanggaran dengan id " + id_pelanggaran + " telah dihapus.");
                    location.reload();
                }
            });
        }
    }

    // Initialize data tables
    $(document).ready(function() {
        $('#tabel-pelanggaran').DataTable({
            "ajax": 'api.php?halaman=piket&aksi=pindai&data_tabel-pelanggaran=1&id_pelajar=<?php echo $id ?>',
            order: [[4, "desc"]],
            "columnDefs": [{
                "targets": 6,
                "orderable": false,
                "defaultContent": '<td><a href="#"><i class="fa fa-cog"></i></a>    <a onclick="deletePelanggaran(<?php echo $pelanggaran['id']; ?>)" href="#"><i class="fa fa-trash" style="color:red"></i></a></td>'
            }]
        });
        $('#tabel-izin').DataTable({
            order: [[0, "desc"]]
        });
    });
</script>
