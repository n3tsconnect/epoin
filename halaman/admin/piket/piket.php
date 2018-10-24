
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
                    <form id="inputnis" method="POST" action="api.php?halaman=piket&aksi=terimainput" class="col-sm-4">
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
                    <form id="inputnama" method="POST" action="api.php?halaman=piket&aksi=terimainput" class="col-sm-6">
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
					<div class="card" style="overflow:auto;">
							<div class="card-header">
									<strong class="card-title">Izin Terbaru</strong>
							</div>
							<div class="card-body card-block">
							<table id="bootstrap-data-table2" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Siswa/i</th>
											<th>Izin</th>
											<th>Keterangan</th>
											<th>Dari</th>
											<th>Sampai</th>
											<th>Tanggal</th>
											<th>Petugas</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
											<?php
											$no   = 1;
											$y  = $koneksi->query("SELECT * FROM tb_datadispen, tb_pengguna, tb_pelajar
											WHERE tb_datadispen.id_pelajar = tb_pelajar.id_pelajar
											AND tb_datadispen.id_guru = tb_pengguna.id_pengguna
											AND CURTIME() > tb_datadispen.dari_kapan
											AND CURTIME() < tb_datadispen.sampai_kapan
											AND DATE(tb_datadispen.tgl_dibuat) = CURDATE()
											ORDER by tgl_dibuat DESC LIMIT 10");
											while ($pelanggaran = $y->fetch_assoc()){
											?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $pelanggaran['nama_pelajar']?></td>
											<td><?php echo $pelanggaran['nama_dispen']?></td>
											<td><?php echo $pelanggaran['deskripsi_dispen']?></td>
											<td><?php echo date("H:i", strtotime($pelanggaran["dari_kapan"]))?>
											<td><?php echo date("H:i", strtotime($pelanggaran["sampai_kapan"]))?></td>
											<td><?php echo date("Y-m-d", strtotime($pelanggaran["tgl_dibuat"]))?></td>
											<td><?php echo $pelanggaran['nama_pengguna']?></td>
											<td><?php if (time() > $pelanggaran["dari_kapan"] and time() < $pelanggaran["sampai_kapan"]) { echo "Aktif" } ?></td>
										</tr>
											<?php } ?>
									</tbody>
								</table>
							</div>
					</div>
				</div>
		</div>
