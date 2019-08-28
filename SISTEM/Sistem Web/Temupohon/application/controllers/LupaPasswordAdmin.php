<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class LupaPasswordAdmin extends CI_Controller {



	function __construct()

	{

		parent::__construct();

		$this->load->model(array('security_admin_m', 'admin_encrypt_m','admin_auth_m'));

	}



	public function index()

	{

		

			 $this->form_validation->set_rules('email', 'Email', 'required|valid_email');  



             if($this->form_validation->run() == FALSE) {  

             $data['title'] = 'Halaman Reset Password';  

             $data['body'] = $this->load->view('v_lupa_pass_admin');

             $this->load->view('output_html_v', $data);  

         	} else {  

             $email = $this->input->post('email');   

             $clean = $this->security->xss_clean($email);  



             $adminInfo = $this->security_admin_m->getAdminInfoByEmail($clean);  



             if(!$adminInfo){  

               $this->session->set_flashdata('sukses', 'email address salah, silakan coba lagi.');  

               redirect(site_url('AdminLogin'),'refresh');   

             }    



         	//build token   

                       

             $token = $this->security_admin_m->insertToken($adminInfo->id_admin); 

                       

             $qstring = $this->base64url_encode($token); 

			

             $url = site_url() . 'LupaPasswordAdmin/reset_password/token/' . $qstring;  

             $link = '<a href="' . $url . '">' . $url . '</a>';   

               

             $message = '';             

             $message .= 'Hai, anda menerima email ini karena ada permintaan untuk memperbaharui password anda.';  

             $message .= 'Silakan klik link ini:' . $link;         

             echo "<a href='http://www. gmail.com'>Login to Email</a>";//send this through mail  

             $headers = "";
            $headers .= "From: Owner Temu Pohon Apps <u320921785@srv109.main-hosting.eu> \r\n";
            mail($email, 'Reset Password Akun Temu Pohon',$message, $headers); 

    	 }

 	}



	public function reset_password()  

     {   



       $token = $this->base64url_decode($this->uri->segment(4));

     

       $cleanToken = $this->security->xss_clean($token);  

       

       $admin_info = $this->security_admin_m->isTokenValid($cleanToken); //either false or array();

      

       if(!$admin_info){



         $this->session->set_flashdata('sukses', 'Token tidak valid atau kadaluarsa');  

         redirect(site_url('AdminLogin'),'refresh');   

       

       }    

        

   

       $data = array(  

         'title'=> 'Halaman Reset Password',  

         'nama'=> $admin_info->nama,   

         'email'=>$admin_info->email,   

         'token'=>$this->base64url_encode($token)  

       );  

         

       $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');  

       $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');         

         

       if ($this->form_validation->run() == FALSE) {    

         $this->load->view('reset_pass_admin', $data);

       }else{  

                           

         $post = $this->input->post(NULL, TRUE);          

         $cleanPost = $this->security->xss_clean($post);



         $rand_salt = $admin_info->salt;

		 $encrypt_pass = $this->admin_encrypt_m->encryptUserPwd($this->input->post('password'),$rand_salt);



         // $hashed = md5($cleanPost['password']);  



         $cleanPost['password'] = $encrypt_pass;  

         $cleanPost['id_admin'] = $admin_info->id_admin; 



         unset($cleanPost['passconf']); 

      

         if(!$this->security_admin_m->updatePassword($cleanPost)){  

           $this->session->set_flashdata('sukses', 'Update password gagal.');

         }else{  

           $this->session->set_flashdata('sukses', 'Password anda sudah  

             diperbaharui. Silakan login.');  

         }  

         redirect(site_url('AdminLogin'),'refresh');         

       }  

     }  

       

   public function base64url_encode($data) {   

    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');   

   }   

   

   public function base64url_decode($data) {   

    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));   

   }    

 }  

