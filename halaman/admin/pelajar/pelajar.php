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
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Foto</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>No telp</th>
                        <th>Surel</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php
                $sql  = $koneksi->query("SELECT * FROM tb_pelajar");
                while ($pelajar = $sql->fetch_assoc()){
                ?>
                    <tr>
                        <td><img src="<?php
                        if (file_exists('gambar/profil/pelajar/'.$pelajar['foto_pelajar'].'')) { echo 'gambar/profil/pelajar/'.$pelajar['foto_pelajar'].''; } else {echo 'http://placekitten.com/g/200/200';}
                          ?>"
                        width="50" height="50"></td>
                        <td><?php echo $pelajar['nis_pelajar']?></td>
                        <td><?php echo $pelajar['nama_pelajar']?></td>
                        <td><?php echo $pelajar['telp_pelajar']?></td>
                        <td><?php echo $pelajar['surel_pelajar']?></td>
                        <td>
                            <a href="?halaman=pelajar&aksi=lihat&id=<?php echo $pelajar['id_pelajar']?>"
                            class="btn btn-info"><i title="Lihat" class="fa fa-search"></i> Lihat</a>
                        </td>
                      </tr>
                <?php } ?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
