 <!DOCTYPE html>   
  <html>   
  <head>   
   <meta charset="UTF-8">   
   <title>   
     <?= $title;?>  
   </title> 
   <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style-reset-pass.css") ?>">  
 </head>   
 <body>   
   <h1 align="center">Reset Password</h1>
   <div id="content">   
   <h3>Hello <span><b><?php echo $nama; ?></b></span>, Silakan isi password baru anda.</h3>   <br>
   <?php echo form_open('LupaPassword/reset_password/token/'.$token); ?>  
   <p><b>Password Baru :</b></p>   
   <p>   
     <input class="inputPassword" type="password" name="password" value="<?php echo set_value('password'); ?>"/>   
   </p>   
   <p> <?php echo form_error('password'); ?> </p> <br>  
   <p><b>Konfirmasi Password : </b></p>   
   <p>   
     <input class="inputPassword" type="password" name="passconf" value="<?php echo set_value('passconf'); ?>"/>   
   </p>   
   <p> <?php echo form_error('passconf'); ?> </p>   
   <br>
   <p>   
     <input id="btn-reset" type="submit" name="btnSubmit" value="Reset" />   
   </p> 
   <?php echo form_close(); ?>  
  </div>
 </body>   
 </html>   