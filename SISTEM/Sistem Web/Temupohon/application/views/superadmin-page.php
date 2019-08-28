<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style-super-admin.css") ?>">

<body>

<header>

		<img src="<?php echo base_url("assets/images/big-icon.png") ?>"> 

		<h1 class="title-page">Welcome! Super Admin</h1><br><br>

		<?php echo anchor('AdminLogin/logout', 'Logout', "id='btn-logout'"); ?>

		



		

</header>

<br>

<br>

<a id="btn-mPengunjung" style="display:none" href="<?php echo base_url("SuperAdminPage/masukanPengunjung") ?>">Masukan dari Pengunjung</a>

<?php



	echo "<br />";

	echo form_open('AdminPage/');

	echo form_submit('btn_cari','Cari Pohon', "id='btn-cari'");

	echo form_input('search', '',"id='pencarian' size='30' maxlength='100' placeholder='Search by name'");

	echo "&nbsp;&nbsp;";

	echo form_close();

	echo "<br/> <br/>";



	echo  "<div id='content1'>";

	echo "<h1>DAFTAR ADMIN</h1>";

	echo "<table id='table-admin'";

	echo "<thead>";

	echo "<tr>

				<th>No</th>

				<th>Scan KTP</th>

				<th>Nama</th>

				<th>Username</th>

			

				<th>Profesi</th>

				<th>Gender</th>

		

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

	if(count($ListAdmin) > 0) {

		foreach ($ListAdmin as $row)

		{

		++$no;

		$link_more = anchor('SuperAdminPage/view/'.$row['id_admin'], 'View');

		$link_delete = anchor('SuperAdminPage/delete/'.$row['id_admin'], 'Delete', "onclick='return confirm(\"Data ".$row['nama']."Yakin Dihapus?\")'");

		echo "<tbody>";

		echo "<tr>

				<td>".$no."</td>

				<td><img src='".base_url()."/assets/images/uploads/imageKTP/".$row['nama_gambar']."' width='160px' height='100px'></td>

				<td>".$row['nama']."</td>

				<td>".$row['username']."</td>

				<td>".$row['job']."</td>

				<td>".$row['gender']."</td>

				<td>".$link_more.' '.$link_delete."</td>

				<td><input type='hidden' name='nama_gambar' value=".$row['nama_gambar']."></td>

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

 <div id="content1">

		<a href="<?php echo base_url('FormAdmin') ?>" class='btn-ubah-profil pesan-admin'>Input Data Admin</a>

</div>

 </body>