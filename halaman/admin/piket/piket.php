<link rel="stylesheet" type="text/css" href="jquery.ajaxcomplete.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

   <!-- Including our scripting file. -->

<script type="text/javascript" src="halaman/admin/piket/script.js"></script>
<script>
	function Result(element) {
    var nama = element.textContent;
	document.getElementById("namapelajar").value = $(nama).selector;
	$('#display').html('');
	}
</script>
<style>
#display:empty {
	display:none;
}
</style>
<div class="content mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Pindai kartu pelajar</strong>
                </div>
                <div class="card-body">
                    Silakan pindai kartu pelajar atau ketik manual NIS.<br /><br />
                    <form id="inputnis" method="POST" action="index.php?halaman=piket&aksi=terimainput" class="col-sm-4">
                        <div class="form-group">
                            <input name="pindai" type="number" class="form-control" required autofocus />
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button form="inputnis" name="simpan" type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-sign-in"></i> Pindai
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Cari nama Siswa</strong>
                </div>
                <div class="card-body">
                    Cari siswa berdasarkan Nama<br /><br />
                    <form id="inputnama" method="POST" action="index.php?halaman=piket&aksi=terimainput" class="col-sm-6">
                        <div class="form-group">
                            <input name="nama_pelajar" id="namapelajar" class="form-control" placeholder="Cari nama" autocomplete="off">
                        </div>
                    </form>
			        <div id="display" style="position: absolute; background-color: white; padding: 5px 10px 0px 15px; top: 160px; margin: auto; left: 30px; border: 1px solid #ced4da;"></div>
                </div>
                <div class="card-footer">
                    <button form="inputnama" name="namasiswa" type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-sign-in"></i> Pindai
                    </button>
                </div>
            </div>
        </div>
    </div>

		<div class="row">
				<div class="col-sm-12">
					<div class="card">
							<div class="card-header">
								<strong class="card-title">Izin Aktif</strong>
							</div>

							<div class="card-body card-block" style="overflow:auto;">
							<table id="bootstrap-data-table" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Pelanggar</th>
											<th>Pelanggaran</th>
											<th>Keterangan</th>
											<th>Poin</th>
											<th>Tanggal</th>
											<th>Petugas</th>
										</tr>
									</thead>
									<tbody>
											<?php
											$no   = 1;
											$x  = $koneksi->query("SELECT * FROM tb_datapelanggar, tb_pelanggaran, tb_pengguna, tb_pelajar
											WHERE tb_datapelanggar.id_pelajar =  tb_pelajar.id_pelajar
											AND tb_datapelanggar.id_pelanggaran = tb_pelanggaran.id_pelanggaran
											AND tb_datapelanggar.id_guru = tb_pengguna.id_pengguna ORDER by tanggal_pelanggaran DESC LIMIT 20");
											while ($pelanggaran = $x->fetch_assoc()) {
											?>
									<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $pelanggaran['nama_pelajar']?></td>
											<td><?php echo $pelanggaran['nama_pelanggaran']?></td>
											<td><?php echo $pelanggaran['keterangan_pelanggaran']?></td>
											<td><?php echo $pelanggaran['poin_pelanggaran']?></td>
											<td><?php echo $pelanggaran['tanggal_pelanggaran']?></td>
											<td><?php echo $pelanggaran['nama_pengguna']?></td>
										</tr>
											<?php } ?>
									</tbody>
								</table>
							</div>

					</div>
				</div>
		</div>
