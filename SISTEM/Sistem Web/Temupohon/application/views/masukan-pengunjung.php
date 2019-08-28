<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style-super-admin.css") ?>">
<body>
<header>
		<img src="<?php echo base_url("assets/images/big-icon.png") ?>"> 
		<h1 class="title-page">Masukan dari Pengunjung</h1>
		
</header>

<?php

	echo "<br />";
	echo form_open('SuperAdminPage/masukanPengunjung');
	echo form_submit('btn_cari','Cari Pesan', "id='btn-cari'");
	echo form_input('search', '',"id='pencarian' size='30' maxlength='100' placeholder='Search by name'");
	echo "&nbsp;&nbsp;";
	echo form_close();
	echo "<br/> <br/>";

	echo  "<div id='content1'>";
	echo "<h2 align='center'>Daftar Pesan dari Pengunjung</h2>";
	echo "<table id='table-admin'";
	echo "<thead>";
	echo "<tr>
				<th>No</th>
				<th>Nama Pengunjung</th>
				<th>Waktu</th>
				<th>Email</th>
				<th>Isi Pesan</th>		
				<th>Aksi</th>
			</tr>";
	echo "</thead>";
	// if(empty($query)) {
	// 	 ."<tr><td colspan='3'>Data tidak ada</td></tr>".
	//  } else {
	//  	foreach ($query as $rowdata) {
	//  		# code...
	//  	}
	//  }

	// $no = 0;
	if(count($ListPesanAdmin) > 0) {
		foreach ($ListPesanAdmin as $row)
		{
		++$no;
		$link_more = anchor('SuperAdminPage/viewMasukanPengunjung/'.$row['id_pesan'], 'View');
		$link_delete = anchor('SuperAdminPage/deleteMasukanPengunjung/'.$row['id_pesan'], 'Delete', "onclick='return confirm(\"Hapus Pesan dari ".$row['nama_pengunjung']."?\")'");
		echo "<tbody>";
		echo "<tr>
				<td>".$no."</td>
				<td>".$row['nama_pengunjung']."</td>
				<td>".$row['waktu']."</td>
				<td>".$row['email_pengunjung']."</td>
				<td>".$row['isi_pesan']."</td>
				<td>".$link_more.' '.$link_delete."</td>
			</tr>";
		echo "</tbody>";
	}
	} else {
		echo "<div style='color:red;'><strong>Hasil pencarian tidak ditemukan.</strong></div>";
	}
	echo "</table>";
	echo "</div>";

	echo "<br/>";
	echo "<div id='pagination'>";
	echo $this->pagination->create_links();
	echo "</div>";
 ?>
 </body>