<body>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-view-pohon.css') ?>">
<h1 align="center">Lihat Pesan User</h1>
<div id="content" align="center">
 <table>
 	<tr>
 		<td class="th-vertical">Nama Admin</td>
 		<td><?php echo $query['nama_admin'] ?></td>
 	</tr>
 	<tr>
 		<td class="th-vertical">Waktu Kirim</td>
 		<td><?php echo $query['waktu'] ?></td>
 	</tr>
 	<tr>
 		<td class="th-vertical">Isi Pesan</td>
 		<td><?php echo $query['isi_pesan'] ?></td>
 	</tr>
 </table>
 <a href="<?php echo base_url("UserPage/viewPesan") ?>">Back</a>
 
</div>
</body>