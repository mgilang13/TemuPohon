<div>
	<h1>Login</h1>
	<?php echo form_open(base_url().'login/') ?>
	<?php echo validation_errors(); ?>
	<span><b><?php echo $login_failed; ?></b></span>
	
	<div>
		<div>Username : </div>
		<div><input type="text" name="username" value="<?php echo set_value('username'); ?>" /></div>
	</div>

	<div>
		<div>Password : </div>
		<div><input type="password" name="password" value="<?php echo set_value('password'); ?>" /><br/></div>
	</div>
	
	<div>
		<input type="submit" value="Login" name="submit_login" />
	</div>
	
	<div>
		Apakah Anda Belum Register? <?php echo anchor('register', 'Register'); ?>
	</div>
	
	<?php echo form_close() ?>
</div>