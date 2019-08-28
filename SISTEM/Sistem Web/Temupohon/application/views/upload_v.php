<div><h2>Daftar Hasil Upload</h2></div>
<div><?php echo $this->session->flashdata('pesan')?>
	<p><a href="<?php echo base_url()?>upload/add" class="btn btn-success">Tambah</a></p>
	<table border='1'>
		<tr>
			<th>Keterangan File</th>
			<th>Tipe File</th>
			<th>Gambar File</th>
			<th>Download</th>
		</tr>
		<?php if(empty($query)){ ?> <!-- Jika Data Kosong -->
			<tr>
				<td colspan="3">Data Tidak Ada</td>
			</tr>
		<?php } else {
			foreach($query as $rowdata){ ?> <!-- Menampilkan Data Dari Query Dengan Looping -->
			<tr>
				<td width='400'><?php echo $rowdata->ket_gambar ?></td>
				<td width='200'><?php echo $rowdata->tipe_gambar ?></td>
				<td width='300'><center><img src="assets/images/uploads/<?php echo $rowdata->nama_gambar?>" width='100' height='100'></center></td>
				<td><a href="<?php echo base_url('upload/download/'.$rowdata->nama_gambar); ?>">Download</a></td>
			</tr>
		<?php }} ?>
	</table>
</div>

<?php echo "<br/>";
echo anchor('login/logout', 'Logout'); ?>