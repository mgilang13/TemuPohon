<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-daftar-user.css') ?>">
<header>
		<img src="<?php echo base_url("assets/images/big-icon.png") ?>"> 
		<h1 class="title-page">Daftar User</h1>
		
</header>
<a id="subtitle" href="<?php echo base_url('AdminPage') ?>">Back</a>
<?php

	echo "<br />";
	echo form_open('AdminPage/');
	echo form_submit('btn_cari','Cari User', "id='btn-cari'");
	echo form_input('search', '',"id='pencarian' size='30' maxlength='100' placeholder='Search by name'");
	echo "&nbsp;&nbsp;";
	echo form_close();
	echo "<br/> <br/>";

	echo "<table id='tabel-user'";
	echo "<thead>";
	echo "<tr>
				<th>No</th>
				<th>Scan KTP</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Username</th>
				<th>Profesi</th>
				<th>Jenis Kelamin</th>
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
	if(count($ListUser) > 0) {
		foreach ($ListUser as $row)
		{
		$no++;
		$link_more = anchor('AdminPage/view/'.$row['id_user'], 'More');
		$link_delete = anchor('AdminPage/delete/'.$row['id_user'], 'Delete', "onclick='return confirm(\"Data ".$row['nama']."Yakin Dihapus?\")'");
		echo "<tbody>";
		echo "<tr>
				<td>".$no."</td>
				<td><img src='".base_url()."/assets/images/uploads/imagektp/".$row['nama_gambar']."' width='160px' height='100px'></td>
				<td>".$row['nama']."</td>
				<td>".$row['email']."</td>
				<td>".$row['username']."</td>
				<td>".$row['job']."</td>
				<td>".$row['gender']."</td>
				<td>".$link_more.' ' .$link_delete."</td>
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
<div id="panel-pesan">
<h1 class="title-page">Kirim Pesan ke User</h1>
<?php echo form_open_multipart('AdminPage/sendMessages') ?>
<h2>USERNAME : </h2>
<select name="id_user" class="field">
	<?php foreach ($user as $data_user): ?>
		<option value="<?php echo $data_user['id_user'] ?>"><?php echo $data_user['nama'] ?></option>
	<?php endforeach ?>
</select>

<h2>PESAN : </h2><textarea placeholder="Tulis pesan di sini..." class="badan-pesan" name="isi_pesan"></textarea>
<input type="submit" id="btn-submit" value="SEND" name="submit">
<?php echo form_close() ?>
</div>