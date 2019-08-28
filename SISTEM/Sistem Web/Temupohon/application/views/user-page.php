<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style-user-page.css") ?>">

<body>

<header>

		<img src="<?php echo base_url("assets/images/big-icon.png") ?>"> 

		<h1 class="title-page">Welcome! <?php echo $this->session->userdata('nama'); ?></h1><br>

		<?php echo anchor('UserLogin/logout', 'Logout', "id='btn-logout'"); ?>

		<!-- <button class="btn-ubah-profil"><a href="www.google.com">UBAH PROFIL</a></button> -->

</header>

<div id="content1">

	<?php echo anchor('UserPage/viewPesan', 'Pesan dari Admin', "class='btn-ubah-profil pesan-admin'"); ?>

	<?php echo anchor('UserPage/add_new', 'Tambah Pohon', "id='tambah-pohon'"); ?>

</div>



<?php



	echo "<br />";

	echo form_open('UserPage/');

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



	// $no = 0;

	if(count($ListPohon) > 0) {

		foreach ($ListPohon as $row)

		{

		$no++;

		$link_qr = anchor('UserPage/print_qr/'.$row['id_pohon'], 'Print QR', "class='tombol-aksi' id='print_qr'");

		$link_more = anchor('UserPage/view/'.$row['id_pohon'], 'More', "class='tombol-aksi' id='more'");

		$link_edit = anchor('UserPage/edit/'.$row['id_pohon'], 'Update', "class='tombol-aksi' id='update'");
		
		$link_delete = "<a class='tombol-aksi' id='delete' href=".base_url()."UserPage/delete/".$row['id_pohon']." onclick=\"return confirm('Are You Sure?')\" >Delete</a>";
		
		echo "<tbody>";

		echo "<tr>

				<td>".$no."</td>

				<td><img src='".base_url()."/assets/images/uploads/gambarPohon/".$row['nama_gambar']."?rand=".rand(900,22)."' width='160px' height='100px'></td>

				<td>".$row['nama_pohon']."</td>

				<td><em>".$row['nama_latin']."</em></td>

				<td>".$link_qr.' '.$link_more.' '.$link_edit.' ' .$link_delete."</td>

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