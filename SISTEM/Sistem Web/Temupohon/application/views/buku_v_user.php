<?php
	echo "<br />";
	echo form_open('buku/');
	echo form_input('search', '' ,"size='50' maxlength='100'");
	echo form_submit('btn_cari','Cari');
	echo "&nbsp;&nbsp;";
	echo form_close();
	echo "<br/> <br/>";
	
	echo "<table border ='1'
			<tr>
				<th>No</th>
				<th>ID Buku</th>
				<th>Judul</th>
				<th>Pengarang</th>
				<th>Penerbit</th>
				<th>Tahun</th>
			<tr>";
	$no = 0;
	if(count($ListUser) > 0) {
		foreach ($ListUser as $row)
		{
		$no++;
		echo "<tr>
				<td>".$no."</td>
				<td>".$row['id_buku']."</td>
				<td>".$row['judul']."</td>
				<td>".$row['pengarang']."</td>
				<td>".$row['penerbit']."</td>
				<td>".$row['tahun']."</td>
				</tr>";
	}
	} else {
		echo "<div style='color:red;'><strong>Hasil pencarian tidak ditemukan.</strong></div>";
	}
	echo "</table>";
	
	echo "<br/>";
	echo $this->pagination->create_links();
	echo "<br/ ><br/ >";
	echo anchor('UserLogin/logout', 'Logout');
    

/* End of file buku_v.php */
/* Location: ./application/views/buku_v.php */