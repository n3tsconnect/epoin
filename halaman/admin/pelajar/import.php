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
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Data pelajar</strong>
        </div>
        <div class="card-body card-block">
            <form method="POST" enctype="multipart/form-data">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class=" form-control-label">File data</label>
                        <input name="importData" type="file" class="form-control" required>
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