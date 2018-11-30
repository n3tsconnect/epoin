<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Guru</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Guru</li>
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
                                <strong class="card-title">Data Guru</strong>
                            </div>
                        <div class="card-body">
                        <div class="col-sm-3">
                            <a href="?halaman=guru&aksi=tambah" class="btn btn-primary">Tambah</a>
                        </div><br/><br/>
                  <div style="overflow:auto;">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>No telp</th>
                        <th>Surel</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php
                $sql  = $koneksi->query("SELECT * FROM tb_pengguna");
                while ($pengguna = $sql->fetch_assoc()){
                ?>
                    <tr>
                        <td><img src="<?php echo getProfile($pengguna['foto_pengguna']); ?>" height="50px" width="50px"></td>
                        <td><?php echo $pengguna['nama_pengguna']?></td>
                        <td><?php echo $pengguna['telp_pengguna']?></td>
                        <td><?php echo $pengguna['surel_pengguna']?></td>
                        <td>
                            <a href="?halaman=guru&aksi=ubah&id=<?php echo $pengguna['id_pengguna']?>"
                            class="btn btn-success"><i title="Ubah" class="fa fa-edit"></i> Ubah</a>
                            <a onclick="return confirm ('Hapus pengguna ini?')" href="?halaman=guru&aksi=hapus&id=<?php echo $pengguna['id_pengguna']?>"
                            class="btn btn-danger"><i title="Hapus" class="fa fa-window-close"></i> Hapus</a>
                        </td>
                      </tr>
                <?php } ?>
                    </tbody>
                  </table>
                </div>
                </div>
            </div>
        </div>
    </div>
