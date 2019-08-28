<?php
	echo "<br />";
	echo form_open('user/');
	echo form_input('search', '' ,"size='50' maxlength='100'");
	echo form_submit('btn_cari','Cari');
	echo "&nbsp;&nbsp;";
	echo anchor('user/add_new', 'Tambah User');
	echo "&nbsp;&nbsp;";
	echo anchor('user/topdf','Eksport PDF');
	echo "&nbsp;&nbsp;";
	echo anchor('user/toexcel','Eksport Excel');
	echo form_close();
	echo "<br /> <br />";
	
	echo "<table border = '1'
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Username</th>
					<th>Email</th>
					<th>Alamat</th>
					<th>Jenis Kelamin</th>
					<th>Level</th>
					<th>Aksi</th>
				</tr>";
		$no = 0;

		if(count($ListUser) > 0) {
			foreach ($ListUser as $row)
			{
			$no++;
			$level = $row['level'];
			$gender = $row['gender'];
			$link_edit = anchor('user/edit/'.$row['ID'], 'Edit');
			$link_delete = anchor('user/delete/'.$row['ID'], 'Hapus', "onclick='return confirm(\"Data yakin dihapus?\")'");

			echo "<tr>
				<td>".$no."</td>
				<td>".$row['nama']."</td>
				<td>".$row['username']."</td>
				<td>".$row['email']."</td>
				<td>".$row['alamat']."</td>
				<td>".$opt_gender[$gender]."</td>
				<td>".$opt_level[$level]."</td>
				<td>".$link_edit.' ' .$link_delete."</td>
			</tr>";
		}
		} else {
			echo "<div style='color:red;'><strong>Hasil pencarian tidak ditemukan.</strong></div>";
		}
		echo "</table>";

		echo "<br/>";
		echo $this->pagination->create_links();
		echo "<br/ ><br/ >";
		echo anchor('login/logout', 'Logout');

/* End of file user_v.php */
/* Location: ./application/views/user_v.php */