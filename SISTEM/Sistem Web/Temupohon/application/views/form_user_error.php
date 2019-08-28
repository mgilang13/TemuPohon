<?php
    $ID = $this->input->post('ID',true);
    $username2 = $this->input->post('username2',true);
	echo form_open('user/save/'.$is_update);
	echo form_hidden('ID',$ID);
    echo form_hidden('username2',strtolower($username2));
	echo "<span>".validation_errors()."</span>";

	echo "Nama : ".form_input('nama',set_value('nama'),"size='50' maxlength='100'");
	echo "<br/><br/>";
	echo "Username : ".form_input('username',strtolower(set_value('username')),"size='50' maxlength='100'");
	echo "<br/><br/>";
	echo "Password : ".form_password('password','',"size='50' maxlength='100'");
	echo "<br/><br/>";
	echo "Email : ".form_input('email',set_value('email'),"size='50' maxlength='100'");
	echo "<br/><br/>";
	echo "Alamat : ".form_textarea('alamat',set_value('alamat'),"size='50' maxlength='100'");
	echo "<br/><br/>";
	echo "Jenis Kelamin : ".form_dropdown('gender',$opt_gender,set_value('gender'));
	echo "<br/><br/>";
	echo "Level : ".form_dropdown('level',$opt_level,set_value('level'));
	echo "<br/><br/>";
	echo form_submit('btn_simpan','Simpan');
	echo form_close();

/* End of file form_user.php */
/* Location: ./application/views/form_user.php */