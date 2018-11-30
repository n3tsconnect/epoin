<div class="content mt-3">
    <div class='row'>
        <div class='col-md-12'>
            <div class='card'>
                <div class='card-header'><strong class='card-title'>Lihat Log</strong></div>
                <div class='card-body'>
                    <table id='tabel-log' class='table table-striped table-bordered'>
                        <thead>
                            <tr><th>ID</th><th>Title</th><th>Parameter</th><th>User</th><th>Timestamp</th><th>IP</th></tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="web/js/lib/data-table/datatables.min.js"></script>
<script src="web/js/lib/data-table/dataTables.bootstrap.min.js"></script>
<script src="web/js/lib/data-table/datatables-init.js"></script>

<script type='text/javascript'>
    $(document).ready(function(){
        $('#tabel-log').DataTable({
            'ajax': 'api.php?halaman=log&data_log',
            order: [[0, "desc"]],
            "deferRender": true       
        })
    });
</script>