<?php

    $id = (float) esc($_GET['id']);
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
                    <button name="pelanggaran" type="submit" class="btn btn-danger btn-sm" onclick='showModal("#modal-pelanggaran")'>
                        <i class="fa fa-plus"></i> Pelanggaran
                    </button>
                    <button name="izin" type="submit" class="btn btn-success btn-sm" onclick='showModal("#modal-izin")'>
                        <i class="fa fa-plus"></i> Izin
                    </button>
                    <?php
                        if($_GET['context'] == "lihatPelajar"){
                            ?>
                                <a class="btn btn-primary btn-sm" href="?halaman=pelajar&aksi=ubah&id=<?php echo $id;?>"><i class="fa fa-cogs"></i> Ubah</a>
                                <a href="?halaman=pelajar&aksi=gantikatasandi&id=<?php echo $id;?>" class="btn btn-info btn-sm"><i class="fa fa-lock"></i> Ganti kata sandi</a>
                                <a onclick="displayDeletePelajar()" class="btn btn-danger btn-sm" href="#!"><i class="fa fa-remove"></i> Hapus</a>
                            <?php
                        }
                    ?>
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
                                <th>ID</th><th>Pelanggaran</th><th>Keterangan</th><th>Poin</th><th>Timestamp</th><th>Petugas</th><th><i class="fa fa-cogs"></i></th>
                            </tr>
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
                                <th>ID</th><th>Izin</th><th>Keterangan</th><th>Dari</th><th>Sampai</th><th>Petugas</th><th><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="modal-pelanggaran" tabindex="-1" role="dialog" aria-labelledby="pelanggaranLabel" aria-hidden="true">
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
                    <input type="hidden" name="tambah-pelanggaran" value=1 />
                    <input type="hidden" name="id_pelajar" value=<?php echo $id ?> />
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
                <button id="dismiss-modal-pelanggaran" type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button onclick='tambahPelanggaran("#form-pelanggaran")' type="button" name="tambah-pelanggaran" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-izin" tabindex="-1" role="dialog" aria-labelledby="izinLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="izinLabel">Tambah izin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-izin">
                    <input type="hidden" name="tambah-izin" value=1 />
                    <input type="hidden" name="id_pelajar" value=<?php echo $id ?> />
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
                <button onclick='tambahIzin("#form-izin")' form="form-izin" type="button" name="tambah-izin" class="btn btn-primary">Tambah</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="modal-edit-pelanggaran" tabindex="-1" role="dialog" aria-labelledby="editPelanggaranLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPelanggaranLabel">Edit Pelanggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-edit-pelanggaran">
                    <input type="hidden" name="edit_pelanggaran" value=1 />
                    <input id="edit_id-pelanggaran" type="hidden" name="id-pelanggaran" />
                    <div class="form-group">
                        <label class="form-control-label">Jenis Pelanggaran</label>
                        <input id="edit_jenis-pelanggaran" class="form-control" disabled />
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Keterangan</label>
                        <textarea id="edit_keterangan-pelanggaran" class="form-control" rows="4" cols="50" name="keterangan-pelanggaran"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Poin</label>
                        <p name="poin" id="edit_poin-pelanggaran"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button onclick='editPelanggaran("#form-edit-pelanggaran")' type="button" name="tambah-pelanggaran" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-edit-izin" tabindex="-1" role="dialog" aria-labelledby="editIzinLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editIzinLabel">Edit Izin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="form-edit-izin">
                    <input type="hidden" name="edit_izin" value=1 />
                    <input id="edit_id-dispen" type="hidden" name="id_izin" />
                    <div class="form-group">
                        <label class="form-control-label">Nama Izin</label>
                        <input id="edit_nama-dispen" name="nama_dispen" type="text" class="form-control" placeholder="Misalnya : Pulang ke rumah, Barang tertinggal, dsb" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Deskripsi</label>
                        <textarea id="edit_deskripsi-dispen" class="form-control" rows="4" cols="50" name="deskripsi_dispen" placeholder="Misalnya : Ada barang yang tertinggal dirumah." required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Dari jam</label>
                        <input id="edit_start-dispen" name="dari_kapan" id="dispen-start" type="time" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Sampai jam</label>
                        <input id="edit_finish-dispen" name="sampai_kapan" id="dispen-end" type="time" class="form-control" required />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button onclick='editIzin("#form-edit-izin")' type="button" name="tambah-izin" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="modal-delete-pelajar" tabindex="-1" role="dialog" aria-labelledby="deletePelajarLabel" aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePelajarLabel">Delete Pelajar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="delete_id-pelajar" type="hidden" name="delete_id-pelajar" />
                Untuk delete pelajar dengan nama <br /> <br />
                <p class="text-center"><strong id="delete_nama-pelajar"></strong></p> <br />
                Silahkan konfirmasi nama pelajar tersebut:
                <input type="text" class="form-control" name="delete_konfirm-nama" id="delete_konfirm-nama">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button onclick='deletePelajar()' type="button" name="delete-pelajar" class="btn btn-primary">Submit</button>
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
    function deletePelajar(){
        var id_pelajar = $('#delete_id-pelajar').val();
        var nama_pelajar = $('#delete_nama-pelajar').text();
        var konfirm_nama = $('#delete_konfirm-nama').val();

        if(konfirm_nama.toUpperCase() == nama_pelajar.toUpperCase()){
            $.ajax({
                type: "POST",
                url: "api.php?halaman=pelajar&aksi=hapus",
                data: {
                    id: id_pelajar
                },
                success: function(data){
                    alert("SUCCESS DELETE " + nama_pelajar);
                    jQuery('#modal-delete-pelajar').modal('hide');
                    window.location.href = "index.php?halaman=pelajar";
                }
            });
        } else {
            alert("KONFIRMASI NAMA TIDAK SESUAI!");
            jQuery('#modal-delete-pelajar').modal('hide');
        }
    }

    function displayDeletePelajar(){
        let id_pelajar = "<?php echo $id; ?>";
        let nama_pelajar = "<?php echo $x['nama_pelajar']; ?>";

        $('#delete_id-pelajar').val(id_pelajar);
        $('#delete_nama-pelajar').text(nama_pelajar);
        $('#delete_konfirm-nama').val("");

        jQuery('#modal-delete-pelajar').modal('show');
    }
</script>

<script type="text/javascript">
    // Untuk reset form yang ada di modal tambah pelanggaran/izin.
    // Kalau tidak ada, setiap kali form dalam modal diisi kemudian ditutup
    // dan dibuka lagi, data form sebelumnya masih bertahan.
    // Modal edit tidak perlu karena setiap dimunculkan sudah dimasukkan
    // data awal.
    $(document).ready(function() {
        jQuery('#modal-pelanggaran').on('hidden.bs.modal', function() {
            $('#form-pelanggaran').trigger('reset');
        });

        jQuery('#modal-izin').on('hidden.bs.modal', function() {
            $('#form-izin').trigger('reset');
        });
    });


    // Modal yang ditrigger lewat data-toggle dan data-target tidak bisa diclose
    // sempurna dengan javascript. Saat diclose lewat js dan dibuka lagi lewat button,
    // modal tampil dengan style display: none (modal muncul sejenak kemudian hilang).
    // Jadi semua show/hide modal harus dengan js.
    function showModal(modalId){
        jQuery(modalId).modal("show");
    }

    // Ambil poin
    function previewPoin(element) {
        var poin = element.options[element.selectedIndex].getAttribute("data-poin");
        document.getElementById("previewPoin").innerHTML = poin;
    }


    function tambahPelanggaran(formId){
        var form = $(formId);
        $.ajax({
            type: 'POST',
            url: 'api.php?halaman=piket&aksi=poin',
            data: form.serialize(),
            beforeSend: function() {
                jQuery('#modal-pelanggaran').modal('hide');
            },
            success: function(data){
                $('#poin-pelajar').text(data);
                $("#tabel-pelanggaran").DataTable().ajax.reload();
            }
        });

    }

    function tambahIzin(formId){
        var form = $(formId);
        $.ajax({
            type: 'POST',
            url: 'api.php?halaman=piket&aksi=poin',
            data: form.serialize(),
            beforeSend: function() {
                jQuery('#modal-izin').modal('hide');
            },
            success: function(data){
                $("#tabel-izin").DataTable().ajax.reload();
            }
        });
    }

    function editIzin(formId){
        var form = $(formId);
        $.ajax({
            type: 'POST',
            url: 'api.php?halaman=piket&aksi=poin',
            data: form.serialize(),
            success: function(data){
                jQuery('#modal-edit-izin').modal('hide');
                $("#tabel-izin").DataTable().ajax.reload();
            }
        });
    }

    function editPelanggaran(formId){
        var form = $(formId);
        $.ajax({
            type: 'POST',
            url: 'api.php?halaman=piket&aksi=poin',
            data: form.serialize(),
            success: function(data){
                jQuery('#modal-edit-pelanggaran').modal('hide');
                $("#tabel-pelanggaran").DataTable().ajax.reload();
            }
        });
    }


    function displayEditPelanggaran(pelanggaran){
        // Isi form dengan data awal
        $('#edit_id-pelanggaran').val(pelanggaran[0]);
        $('#edit_jenis-pelanggaran').val(pelanggaran[1]);
        $('#edit_keterangan-pelanggaran').val(pelanggaran[2]);
        $('#edit_poin-pelanggaran').text(pelanggaran[3]);

        jQuery('#modal-edit-pelanggaran').modal('show');
    }

    function displayEditIzin(izin){
        // Isi form dengan data awal
        $('#edit_id-dispen').val(izin[0]);
        $('#edit_nama-dispen').val(izin[1]);
        $('#edit_deskripsi-dispen').val(izin[2]);

        // Ambil dalam format 00:00
        var dari_jam = izin[3].substring(0,5);
        var sampai_jam = izin[4].substring(0,5);

        $('#edit_start-dispen').val(dari_jam);
        $('#edit_finish-dispen').val(sampai_jam);
        jQuery('#modal-edit-izin').modal('show');
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
                success: function(data){
                    alert("Pelanggaran dengan id " + id_pelanggaran + " telah dihapus.");
                    $('#poin-pelajar').text(data);
                    $("#tabel-pelanggaran").DataTable().ajax.reload();
                }
            });
        }
    }

    function deleteIzin(id_izin){
        if(confirm("Delete izin dengan id " + id_izin + "?")){
            $.ajax({
                type: "POST",
                url: "api.php?halaman=piket&aksi=poin",
                data: {
                    delete_izin: 1,
                    id_izin: id_izin
                },
                success: function(data){
                    alert("Izin dengan id " + id_izin + " telah dihapus.");
                    $("#tabel-izin").DataTable().ajax.reload();
                }
            });
        }
    }

    // Initialize data tables
    $(document).ready(function() {
        var tabel_pelanggaran = $('#tabel-pelanggaran').DataTable({
            "ajax": 'api.php?halaman=piket&aksi=pindai&data_tabel-pelanggaran=1&id_pelajar=<?php echo $id ?>',
            order: [[0, "desc"]],
            "columnDefs": [{
                "targets": 6,
                "orderable": false,
                "defaultContent": '<td><a class="editPelanggaran" href="#!"><i class="fa fa-cog"></i></a>    <a class="deletePelanggaran" href="#!"><i class="fa fa-trash" style="color:red"></i></a></td>'
            }]
        });
        var tabel_izin = $('#tabel-izin').DataTable({
            "ajax": 'api.php?halaman=piket&aksi=pindai&data_tabel-izin=1&id_pelajar=<?php echo $id ?>',
            order: [[0, "desc"]],
            "columnDefs": [{
                "targets": 6,
                "orderable": false,
                "defaultContent": '<td><a class="editIzin" href="#!"><i class="fa fa-cog"></i></a>    <a class="printIzin" href="#!"><i class="fa fa-print"></i></a>    <a class="deleteIzin" href="#!"><i class="fa fa-trash" style="color:red"></i></a></td>'
            }]
        });

        // Definisi action tombol delete untuk tabel pelanggaran dan izin
        $('#tabel-pelanggaran tbody').on('click', '.deletePelanggaran', function(){
            var rowData = tabel_pelanggaran.row($(this).parents('tr')).data();
            deletePelanggaran(rowData[0]);
        });
        $('#tabel-izin tbody').on('click', '.deleteIzin', function(){
            var rowData = tabel_izin.row($(this).parents('tr')).data();
            deleteIzin(rowData[0]);
        });

        // Definisi action tombol edit untuk tabel pelanggaran dan izin
        $('#tabel-izin tbody').on('click', '.editIzin', function(){
            var rowData = tabel_izin.row($(this).parents('tr')).data();2
            displayEditIzin(rowData);
        });
        $('#tabel-pelanggaran tbody').on('click', '.editPelanggaran', function(){
            var rowData = tabel_pelanggaran.row($(this).parents('tr')).data();
            displayEditPelanggaran(rowData);
        });

        $('#tabel-izin tbody').on('click', '.printIzin', function(){
            var rowData = tabel_izin.row($(this).parents('tr')).data();
            window.open("halaman/admin/piket/cetak.php?id=" + rowData[0], '_blank');
        });
        jQuery("form").each(function() {
        var tokenElement = jQuery(document.createElement('input'));
        tokenElement.attr('type', 'hidden');
        tokenElement.attr('name', 'csrf_token');
        tokenElement.attr('value', <?= $token ?>);
        jQuery(this).append(tokenElement);
        });
    });
    
</script>

<script type="text/javascript">

</script>
