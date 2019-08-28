<body>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-view-admin.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style-view-lupapass.css") ?>">
	<h1 align="center">Lupa Password</h1>
	<div id="content">
	<p>Untuk melakukan reset password, silakan masukkan alamat email anda. </p>   <br>

	<?php echo form_open('LupaPasswordAdmin') ?>
	 <p><b>Email :</b></p>   
	   <p>   
	     <input id="inputEmail" type="text" name="email" value=""/>   
	   </p>   
	   <p> <?php echo form_error('email'); ?> </p>  <br> 
	<a id="btn-back-lupa" href="<?php echo base_url('AdminLogin') ?>">Back</a>
	<input id="btn-submit" type="submit" name="submit" value="Simpan">
	</form>
	</div>
</body>