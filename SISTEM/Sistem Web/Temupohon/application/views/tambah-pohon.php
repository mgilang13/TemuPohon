<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/style-tambah-pohon.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style-user-page.css") ?>">
<header>
		<img src="<?php echo base_url("assets/images/big-icon.png") ?>"> 
		<h1 class="title-page">Tambah Data Pohon</h1>
</header>
<div class="content">
<?php

	if(!empty($query)){
		$row = $query->row_array();		
	}else{
		$row['nama_pohon'] = '';
		$row['nama_latin'] = '';
		$row['sinonim'] = '';
		$row['perawakan'] = '';
		$row['biologi'] = '';
		$row['habitat'] = '';
		$row['potensi'] = '';
		$row['status_konservasi'] = '';
		$row['persebaran'] = '';
	}
	echo "<div id= 'form-left'>";
	echo form_open_multipart('UserPage/save/'.$is_update);
	echo "<table>";

	echo "<tr>";
	echo "<div class='form-control'>";
	echo "<td><h3>Nama Pohon</h3></td> <td>".form_input('nama_pohon',$row['nama_pohon']," class='field'");
	echo "</td>";
	echo "</div>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<div class='form-control'>";
	echo "<td><h3>Nama Latin</h3></td> <td>".form_input('nama_latin',$row['nama_latin'],"class='field'");
	echo "</td>";
	echo "</div>";
	echo "</tr>";

	echo "<tr>";
	echo "<div class='form-control'>";
	echo "<td><h3>Sinonim</h3></td> <td>".form_input('sinonim',$row['sinonim'],"class='field' ");
	echo "</td>";
	echo "</div>";
	echo "</tr>";

	echo "<tr>";
	echo "<div class='form-control'>";
	echo "<td><h3>Perawakan</h3></td> <td>".form_textarea('perawakan',$row['perawakan'],"class='field-area'");
	echo "</td>";
	echo "</div>";
	echo "</tr>";

	echo "<tr>";
	echo "<div class='form-control'>";
	echo "<td><h3>Biologi<h3></td> <td>".form_textarea('biologi',$row['biologi'],"class='field-area' ");
	echo "</td>";
	echo "</div>";
	echo "</tr>";

	echo "<tr>";
	echo "<div class='form-control'>";
	echo "<td><h3>Habitat<h3></td> <td>".form_textarea('habitat',$row['habitat'],"class='field-area' ");
	echo "</td>";
	echo "</div>";
	echo "</tr>";

	echo "<tr>";
	echo "<div class='form-control'>";
	echo "<td><h3>Potensi<h3></td> <td>".form_textarea('potensi',$row['potensi'],"class='field-area' ");
	echo "</td>";
	echo "</div>";
	echo "</tr>";

	echo "</table>";
	echo "</div>";
	echo "<div id='vr-line'><img src= '".base_url()."assets/icons/vr-line.png'> </div>";

	echo "<div id='form-right'>";
	echo "<table>";
	echo "<tr>";
	echo "<div class='form-control'>";
	echo "<td><h3>Status Konservasi</h3></td> <td>".form_textarea('status_konservasi',$row['status_konservasi'],"class='field-area'");
	echo "</td>";
	echo "</div>";
	echo "</tr>";	

	echo "<tr>";
	echo "<div class='form-control'>";
	echo "<td><h3>Persebaran</h3></td> <td>".form_textarea('persebaran',$row['persebaran'],"class='field-area'");
	echo "</td>";
	echo "</div>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<div class='form-control'>";
	echo "<td><h3>Gambar Pohon</h3></td> <td><input type='file' name='gambarPohon' id='inputGambar'> ";
	echo "</td>";
	echo "</div>";
	echo "</tr>";

	echo "<tr colspan='2'>";
	echo "<div>";
	echo "<td></td>";
	echo "<td>";
	echo form_submit('btn_simpan','Simpan', "id='simpanData'");
	echo "</td>";
	echo "</div>";
	echo "</tr>";
	echo "</table>";
	echo "</div>";
	echo form_close();
	
?>
</div>
</body>