<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Pelanggaran</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Pelanggaran</li>
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
                                <strong class="card-title">Jenis-jenis pelanggaran</strong>
                            </div>
                        <div class="card-body">
                        <div class="col-sm-3">
                            <a href="?halaman=pelanggaran&aksi=tambah" class="btn btn-primary">Tambah</a>
                        </div><br/><br/>
                        <div style="overflow:auto;">
                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Poin</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                <?php
                $no   = 1;
                $sql  = $koneksi->query("SELECT * FROM tb_pelanggaran");
                while ($pelanggaran = $sql->fetch_assoc()){
                ?>
                    <tr>
                        <td><?php echo $no++;?></td>
                        <td><?php echo $pelanggaran['nama_pelanggaran']?></td>
                        <td><?php echo $pelanggaran['deskripsi_pelanggaran']?></td>
                        <td><?php echo $pelanggaran['poin_pelanggaran']?></td>
                        <td>
                            <a href="?halaman=pelanggaran&aksi=ubah&id=<?php echo $pelanggaran['id_pelanggaran']?>"
                            class="btn btn-success"><i title="Ubah" class="fa fa-edit"></i> Ubah</a>
                            <a onclick="return confirm ('Hapus pelanggaran ini?')" href="?halaman=pelanggaran&aksi=hapus&id=<?php echo $pelanggaran['id_pelanggaran']?>"
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
