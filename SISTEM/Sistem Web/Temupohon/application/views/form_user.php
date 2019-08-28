<?php
	if (!empty($query)) {
		$row = $query->row_array();
	}
	else
	{
		$row['ID'] = '';
		$row['nama'] = '';
		$row['username'] = '';
		$row['password'] = '';
		$row['email'] = '';
		$row['alamat'] = '';
		$row['gender'] = '';
		$row['level'] = '';
	}

	echo form_open('user/save/'.$is_update);
	echo form_hidden('username2',strtolower($row['username']));
    echo form_hidden('ID',$row['ID']);
	
	echo "Nama : ".form_input('nama',$row['nama'],"size='50' maxlength='100'");
	echo "<br/><br/>";
	echo "Username : ".form_input('username',strtolower($row['username']),"size='50' maxlength='100'");
	echo "<br/><br/>";
	echo "Password : ".form_password('password','',"size='50' maxlength='100'");
	echo "<br/><br/>";
	echo "Email : ".form_input('email',$row['email'],"size='50' maxlength='100'");
	echo "<br/><br/>";
	echo "Alamat : ".form_textarea('alamat',$row['alamat'],"size='50' maxlength='100'");
	echo "<br/><br/>";
	echo "Jenis Kelamin : ".form_dropdown('gender',$opt_gender,$row['gender']);
	echo "<br/><br/>";
	echo "Level : ".form_dropdown('level',$opt_level,$row['level']);
	echo "<br/><br/>";
	echo form_submit('btn_simpan','Simpan');
	echo form_close();

/* End of file form_user.php */
/* Location: ./application/views/form_user.php */