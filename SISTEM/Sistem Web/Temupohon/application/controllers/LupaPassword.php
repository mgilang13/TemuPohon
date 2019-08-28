<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class LupaPassword extends CI_Controller {



	function __construct()

	{

		parent::__construct();

		$this->load->model(array('security_m', 'encrypt_m','auth_m'));

	}



	public function index()

	{

		

			 $this->form_validation->set_rules('email', 'Email', 'required|valid_email');  



             if($this->form_validation->run() == FALSE) {  

             $data['title'] = 'Halaman Reset Password';  

             $data['body'] = $this->load->view('v_lupa_password');

             $this->load->view('output_html_v', $data);  

         	} else {  

             $email = $this->input->post('email');   

             $clean = $this->security->xss_clean($email);  



             $userInfo = $this->security_m->getUserInfoByEmail($clean);  



             if(!$userInfo){  

               $this->session->set_flashdata('sukses', 'email address salah, silakan coba lagi.');  

               redirect(site_url('UserLogin'),'refresh');   

             }    



         	//build token   

              $this->security_m->deleteToken();

             $token = $this->security_m->insertToken($userInfo->id_user); 

                       

             $qstring = $this->base64url_encode($token); 

			

             $url = site_url() . 'LupaPassword/reset_password/token/' . $qstring;  

             $link = '<a href="' . $url . '">' . $url . '</a>';   

            echo "<a href='http://www.gmail.com'>Login to Email</a>";

             $message = '';             

             $message .= 'Hai, anda menerima email ini karena ada permintaan untuk memperbaharui password anda.<br>';  

             $message .= 'Silakan klik link ini: ' . $link;         

             // echo $message;//send this through mail  

             

 

            

              // $this->load->library('email');



              // $this->email->from('achilgilang@gmail.com', 'Owner Temu Pohon Apps');

              // $this->email->to($email);

              // $this->email->subject('Reset Password Akun Temu Pohon');

              // $this->email->message($message);

              // $this->email->send();
$headers = "";
$headers .= "From: Owner Temu Pohon Apps <u320921785@srv109.main-hosting.eu> \r\n";
mail($email, 'Reset Password Akun Temu Pohon',$message, $headers);

    	 }

 	}



	public function reset_password()  

     {   



       $token = $this->base64url_decode($this->uri->segment(4));

     

       $cleanToken = $this->security->xss_clean($token);  

       

       $user_info = $this->security_m->isTokenValid($cleanToken); //either false or array();

      

       if(!$user_info){



         $this->session->set_flashdata('sukses', 'Token tidak valid atau kadaluarsa');  

         redirect(site_url('UserLogin'),'refresh');   

       

       }    

        

   

       $data = array(  

         'title'=> 'Halaman Reset Password',  

         'nama'=> $user_info->nama,   

         'email'=>$user_info->email,   

         'token'=>$this->base64url_encode($token)  

       );  

         

       $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');  

       $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');         

         

       if ($this->form_validation->run() == FALSE) {    

         $this->load->view('reset_pass', $data);

       }else{  

                           

         $post = $this->input->post(NULL, TRUE);          

         $cleanPost = $this->security->xss_clean($post);



         $rand_salt = $user_info->salt;

		 $encrypt_pass = $this->encrypt_m->encryptUserPwd($this->input->post('password'),$rand_salt);



         // $hashed = md5($cleanPost['password']);  



         $cleanPost['password'] = $encrypt_pass;  

         $cleanPost['id_user'] = $user_info->id_user; 



         unset($cleanPost['passconf']); 

      

         if(!$this->security_m->updatePassword($cleanPost)){  

           $this->session->set_flashdata('sukses', 'Update password gagal.');

         }else{  

           $this->session->set_flashdata('sukses', 'Password anda sudah  

             diperbaharui. Silakan login.');  

         }  

         redirect(site_url('UserLogin'),'refresh');         

       }  

     }  

       

   public function base64url_encode($data) {   

    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');   

   }   

   

   public function base64url_decode($data) {   

    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));   

   }    

 }  

