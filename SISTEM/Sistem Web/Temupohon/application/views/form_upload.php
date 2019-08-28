<div><h2>Form Upload</h2></div>
<div><?php echo $this->session->flashdata('pesan');?>
	<?php echo form_open_multipart('upload/insert');?>
	<table>
		<tr>
			<td>File Gambar</td>
			<td><div><input type="file" name="filefoto" class="form-control"></div></td>
		</tr>
		<tr>
			<td>Keterangan Gambar</td>
			<td><div><textarea name="textket" class="form-control"></textarea></div></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" class="btn btn-success" value="Simpan"></td>
		</tr>
	</table>
</div>