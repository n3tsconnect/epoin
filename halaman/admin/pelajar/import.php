<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Tambah pelajar</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="?halaman=pelajar">Pelajar</a></li>
                    <li class="active">Tambah pelajar</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data pelajar</strong>
                </div>
                <div class="card-body card-block">
                    <form id="form-upload" method="POST" enctype="multipart/form-data">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class=" form-control-label">File data</label>
                                <input name="importData" type="file" class="form-control" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button form="form-upload" name="simpan" type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Simpan
                    </button>
                    <button onclick="window.location.href='web/template-import-pelajar.csv'" name="download-template" type="button" class="btn btn-info btn-sm">
                        <i class="fa fa-download"></i> Template
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Daftar Kelas</strong>
                </div>
                <div class="card-body card-block">
                    <table id="tabel-kelas" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID Kelas</th>
                                <th>Nama Kelas</th>
                            </tr>
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
    $(document).ready(function(){
        $('#tabel-kelas').DataTable({
            ajax: "api.php?halaman=pelajar&aksi=import&data_tabel-kelas=1"
        });
    });
</script>
    <?php
if(isset($_POST['simpan'])){
    $currentDir = getcwd();
    $uploadDirectory = "/uploads/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['csv']; // Get all the file extensions

    $fileName = $_FILES['importData']['name'];
    $fileSize = $_FILES['importData']['size'];
    $fileTmpName  = $_FILES['importData']['tmp_name'];
    $fileType = $_FILES['importData']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a CSV file";
        }

        if ($fileSize > 10000000) {
            $errors[] = "This file is more than 10MB. Sorry, it has to be less than or equal to 10MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                echo "The file " . basename($fileName) . " has been uploaded\n";
                $koneksi->query("LOAD DATA LOCAL INFILE '$uploadPath' INTO TABLE tb_pelajar FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES (nis_pelajar, nama_pelajar, kelas_pelajar, poin_pelajar) SET level_pelajar = 'Pelajar';");
                action("PELAJAR_IMPORT", array("filename" => $fileName));
                if(!empty(mysqli_error($koneksi))){
                    echo "SQL ERROR: \n";
                    echo var_dump(mysqli_error($koneksi));
                } else {
                    echo "\nImport sukses!";
                }
                
            } else {
                echo "An error occurred somewhere. Try again or contact the admin\n";
                echo print_r(error_get_last());
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
}
?>