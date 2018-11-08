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
        var tabel_pelajar = $('#tabel-pelajar').DataTable({
            "ajax": 'api.php?halaman=pelajar&aksi=pelajar&data_tabel-pelajar=1',
            order: [[3, "asc"]],
            "columnDefs": [{
                "targets": 5,
                "orderable": false,
                "defaultContent": '<td><button class="btn btn-sm btn-info lihatPelajar" type="button"><i class="fa fa-eye"></i>  Lihat</button>   <button class="btn btn-sm btn-danger deleteIzin" href="#!"><i class="fa fa-trash"></i></button></td>'
            }]
        });

        $('#tabel-pelajar tbody').on('click', '.lihatPelajar', function(){
            var rowData = tabel_pelajar.row($(this).parents('tr')).data();
            window.location.href = "index.php?halaman=piket&aksi=pindai&id=" + rowData[0] + "&context=lihatPelajar";
        });
    });
</script>