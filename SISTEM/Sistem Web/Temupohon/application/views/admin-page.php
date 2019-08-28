<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style-admin-page.css") ?>">

<body>

<header>

		<img src="<?php echo base_url("assets/images/big-icon.png") ?>"> 

		<h1 class="title-page">Welcome! Admin</h1>

		<?php echo anchor('AdminLogin/logout', 'Logout', "id='btn-logout'"); ?>



</header>

<div id="content1">

		<a class="btn-ubah-profil pesan-user" href="<?php echo base_url('AdminPage/pesanUser/') ?>">Lihat User</a>

</div>


<br>

<a id="btn-mPengunjung" href="<?php echo base_url("AdminPage/masukanPengunjung") ?>">Masukan dari Pengunjung</a>
<?php



	echo "<br />";

	echo form_open('AdminPage/');

	echo form_submit('btn_cari','Cari Pohon', "id='btn-cari'");

	echo form_input('search', '',"id='pencarian' size='30' maxlength='100' placeholder='Search by name'");

	echo "&nbsp;&nbsp;";

	echo form_close();

	echo "<br/> <br/>";



	echo  "<div id='content2'>";

	echo "<h1>DAFTAR POHON</h1>";

	echo "<table id='tabel-pohon'";

	echo "<thead>";

	echo "<tr>

				<th>No</th>

				<th>Gambar Pohon</th>

				<th>Nama Pohon</th>

				<th>Nama Latin</th>

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



	$no = 0;

	if(count($ListPohon) > 0) {

		foreach ($ListPohon as $row)

		{

		$no++;

		$link_qr = anchor('UserPage/print_qr/'.$row['id_pohon'], 'Print QR', "class='tombol-aksi' id='print_qr'");

		$link_more = anchor('UserPage/view/'.$row['id_pohon'], 'More', "class='tombol-aksi' id='more'");

		echo "<tbody>";

		echo "<tr>

				<td>".$no."</td>

				<td><img src='".base_url()."/assets/images/uploads/gambarPohon/".$row['nama_gambar']."' width='160px' height='100px'></td>

				<td>".$row['nama_pohon']."</td>

				<td><em>".$row['nama_latin']."</em></td>

				<td>".$link_qr.' '.$link_more."</td>

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

 </body>