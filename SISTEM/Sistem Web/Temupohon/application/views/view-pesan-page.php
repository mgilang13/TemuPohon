<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style-super-admin.css") ?>">
<body>
<header>
		<img src="<?php echo base_url("assets/images/big-icon.png") ?>"> 
		<h1 class="title-page">View Pesan Admin</h1>
		
</header>

<?php

	echo "<br />";
	echo form_open('UserPage/viewPesan');
	echo form_submit('btn_cari','Cari Pesan', "id='btn-cari'");
	echo form_input('search', '',"id='pencarian' size='30' maxlength='100' placeholder='Search by nama admin'");
	echo "&nbsp;&nbsp;";
	echo form_close();
	echo "<br/> <br/>";

	echo  "<div id='content1'>";
	echo "<h2 align='center'>Daftar Pesan dari Admin</h2>";
	echo "<table id='table-admin'";
	echo "<thead>";
	echo "<tr>
				<th>No</th>
				<th>Nama Admin</th>
				<th>Waktu</th>
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
		$link_more = anchor('UserPage/viewPesanUser/'.$row['id_pesan'], 'View');
		$link_delete = anchor('UserPage/deletePesanUser/'.$row['id_pesan'], 'Delete', "onclick='return confirm(\"Hapus Pesan dari ".$row['nama_admin']."?\")'");
		echo "<tbody>";
		echo "<tr>
				<td>".$no."</td>
				<td>".$row['nama_admin']."</td>
				<td>".$row['waktu']."</td>
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