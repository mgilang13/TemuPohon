<body id="background-login">
<div id="form-login">

	<?php echo form_open(base_url().'UserLogin/') ?>
	<?php echo validation_errors(); ?>

	<?php 
		 if($this->session->flashdata('sukses')) {   
   		  echo '<p class="warning" style="margin: 10px 20px;">'.$this->session->flashdata('sukses').'</p>';   
   		}   
   	?>  
	<span><b><?php echo $login_failed; ?></b></span>

		<table>
		<tbody>
			<tr class="row-form1">
				<td><h3>Username</h3></td>
				<td><input id="username-field" type="text" name="username" value="<?php echo set_value("username"); ?>"></td>
				<td></td>
			</tr>
			<tr class="row-form2">
				<td><h3>Password</h3></td>
				<td><input id="password-field" type="password" name="password" value="<?php echo set_value("password"); ?>"></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="tombol-login" id="tombol-user" value="Login" name="submit_login"></td>
			</tr>
			</tr>
		</tbody>
		</table>
		<p id="register-link">Have an Account? <a href="<?php echo base_url("RegisterUser/") ?>">Register</a></p>
		


	<?php echo form_close() ?>
	<a id="lupaPassword" href="<?php echo base_url('LupaPassword') ?>">Forgot Password?</a>
	<a id='btn-back' href="<?php echo base_url('Welcome') ?>">Back</a>
	
	</div>
	</body>