<body>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-view-admin.css') ?>">
	<h1 align="center">Identitas Lengkap Admin</h1>
	<div id="content" align="center">
	<?php 
		echo "<img alt='No Picture' src='".base_url()."/assets/images/uploads/imageKTP/".$query['nama_gambar']."'>";
	 ?>
	<table>
		<tr>
			<td class="th-vertical">Nama Lengkap </td>
			<td><?php echo $query['nama'] ?></td>
		</tr>
		<tr>
			<td class="th-vertical">Alamat Email </td>
			<td><?php echo $query['email'] ?></td>
		</tr>
		<tr>
			<td class="th-vertical">Username</td>
			<td><?php echo $query['username'] ?></td>
		</tr>
		<tr>
			<td class="th-vertical">Alamat Asal</td>
			<td><?php echo $query['alamat'] ?></td>
		</tr>
		<tr>
			<td class="th-vertical">Jenis Kelamin</td>
			<td><?php echo $query['gender'] ?></td>
		</tr>
		<tr>
			<td class="th-vertical">Pekerjaan</td>
			<td><?php echo $query['job'] ?></td>
		</tr>
	</table>
	<a href="<?php echo base_url('SuperAdminPage') ?>">Back</a>
		 </div>
</body>