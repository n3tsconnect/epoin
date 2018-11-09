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
                            <li class="active">Pelajar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Pelajar</strong>
                            </div>
                        <div class="card-body">
                        <div class="col-sm-3">
                            <a href="?halaman=pelajar&aksi=tambah" class="btn btn-primary">Tambah</a>
                        </div>
                        <div class="col-sm-3 text-right float-right">
                            <a href="?halaman=pelajar&aksi=import" class="btn btn-primary">Import</a>
                        </div>
                        <br/><br/>
                  <table id="tabel-pelajar" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Kelas</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Poin</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                  </table>
                </div>
            </div>
        </div>
    </div>

<div class="modal" id="modal-delete-pelajar" tabindex="-1" role="dialog" aria-labelledby="deletePelajarLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePelajarLabel">Delete Pelajar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="id_pelajar" type="hidden" name="id_pelajar" />
                Untuk delete pelajar dengan nama <br /> <br /> 
                <p class="text-center"><strong id="nama_pelajar"></strong></p> <br />
                Silahkan konfirmasi nama pelajar tersebut:
                <input type="text" class="form-control" name="konfirm_nama" id="konfirm_nama">
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
        var id_pelajar = $('#id_pelajar').val();
        var nama_pelajar = $('#nama_pelajar').text();
        var konfirm_nama = $('#konfirm_nama').val();
        
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
                    $("#tabel-pelajar").DataTable().ajax.reload();
                }
            });
        } else {
            alert("KONFIRMASI NAMA TIDAK SESUAI!");
            jQuery('#modal-delete-pelajar').modal('hide');
        }
    }

    function displayDeletePelajar(id_pelajar, nama_pelajar){
        $('#id_pelajar').val(id_pelajar);
        $('#nama_pelajar').text(nama_pelajar);
        $('#konfirm_nama').val("");

        jQuery('#modal-delete-pelajar').modal('show');
    }

    // Initialize data tables
    $(document).ready(function() {
        var tabel_pelajar = $('#tabel-pelajar').DataTable({
            "ajax": 'api.php?halaman=pelajar&aksi=pelajar&data_tabel-pelajar=1',
            order: [[3, "asc"]],
            "columnDefs": [{
                "targets": 5,
                "orderable": false,
                "defaultContent": '<td><button class="btn btn-sm btn-info lihatPelajar" type="button"><i class="fa fa-eye"></i>  Lihat</button>   <button class="btn btn-sm btn-danger deletePelajar" type="button"><i class="fa fa-trash"></i></button></td>'
            }]
        });

        $('#tabel-pelajar tbody').on('click', '.lihatPelajar', function(){
            var rowData = tabel_pelajar.row($(this).parents('tr')).data();
            window.location.href = "index.php?halaman=piket&aksi=pindai&id=" + rowData[0] + "&context=lihatPelajar";
        });

        $('#tabel-pelajar tbody').on('click', '.deletePelajar', function(){
            var rowData = tabel_pelajar.row($(this).parents('tr')).data();
            displayDeletePelajar(rowData[0], rowData[3]);
        });
    });
</script>