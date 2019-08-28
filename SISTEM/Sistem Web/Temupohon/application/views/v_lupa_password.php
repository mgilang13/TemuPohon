<body id="body">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-view-lupapass.css') ?>">
	<h1 align="center">Lupa Password</h1>
	<div id="content">
	<p>Untuk melakukan reset password, silakan masukkan alamat email anda. </p>   

	<?php echo form_open('LupaPassword') ?>
	<br>
	 <p id="bnr">Email:</p>   
	   <p>   
	     <input id="inputEmail" type="text" name="email" value=""/>   
	   </p>
	   <br>   
	   <p> <?php echo form_error('email'); ?> </p>   
	<a id="btn-back-lupa" href="<?php echo base_url('UserLogin') ?>">Back</a>
	<input id="btn-submit" type="submit" name="submit" value="Simpan">
	</form>
	</div>
</body>