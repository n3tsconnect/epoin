<?php include ('../../../konfigurasi/koneksi.php'); ?>
<table id="bootstrap-data-table2" class="table table-striped table-bordered" style="overflow:auto;">
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
        <th>Waktu Tersisa</th>
        <th>Status</th>
        <th>Control</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $no   = 1;
        $y  = $koneksi->query("SELECT * FROM tb_datadispen, tb_pengguna, tb_pelajar
        WHERE tb_datadispen.id_pelajar = tb_pelajar.id_pelajar
        AND tb_datadispen.id_guru = tb_pengguna.id_pengguna
        AND CURTIME() > tb_datadispen.dari_kapan
        AND CURTIME() < DATE_ADD(tb_datadispen.sampai_kapan, '7200') 
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
        <td><?php echo gmdate("H:i:s", strtotime($pelanggaran["sampai_kapan"]) - time()) ?></td>
        <td><?php echo "<p style='color:green'><b>Valid</b></p>" ?></td> 
        <td><?php echo "<button class='btn btn-danger'>Revoke</button>" ?></td>
      </tr>
        <?php } ?>
    </tbody>
  </table>
