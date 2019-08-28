<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('captcha_m','encrypt_m','auth_m', 'register_m'));		
	}
	
	function index(){
		if($this->auth_m->check_logged()===true)
			redirect(base_url().'login/');
		
		$data['title'] = 'Register';
		$sub_data['captcha_return']='';
		$sub_data['cap_img'] = $this->captcha_m->make_captcha();
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('nama','Nama','trim|required|xss_clean');
		$this->form_validation->set_rules('username','Username','trim|min_length[3]|max_length[20]|required|alpha_dash|min_length[3]|max_length[20]|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[5]|max_length[35]|matches[passconf]|xss_clean');
		$this->form_validation->set_rules('passconf','Confirm Password', 'trim|required|min_length[5]|max_length[35]|matches[passconf]|xss_clean');
		$this->form_validation->set_rules('email','Email','trim|required|min_length[5]|max_length[35]|valid_email');
		$this->form_validation->set_rules('alamat','Alamat','trim|required|xss_clean');
		$this->form_validation->set_rules('gender','Jenis Kelamin','trim|required|xss_clean');
		$this->form_validation->set_rules('terms','Terms of Services','trim|required|xss_clean');
	$this->form_validation->set_rules('captcha','Captcha','required');
		$this->form_validation->set_error_delimiters('<div style="color:red;">','</div>');
		
		if($this->form_validation->run()== false){
			$data['body'] = $this->load->view('register_v',$sub_data,true);
		}else{
			if($this->captcha_m->check_captcha()==TRUE){
				$nama = $this->input->post('nama');
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$alamat = $this->input->post('alamat');
				$gender = $this->input->post('gender');
				$term = $this->input->post('terms');
				$level = 'user';
				$cek = $this->register_m->check_query('user',$username);
				if($cek == false){
					$rand_salt = $this->encrypt_m->genRndSalt();
					$encrypt_pass = $this->encrypt_m->encryptUserPwd($this->input->post('password'),$rand_salt);
					$input_data = array(
						'nama' => $nama,
						'username' => $username,
						'email'=>$email,
						'password' => $encrypt_pass,
						'alamat' => $alamat,
						'gender' => $gender,
						'salt' => $rand_salt,
						'level' => $level
					);
					
					if($this->register_m->insert('user', $input_data)){
						redirect(base_url().'login/');
					}
					else {
						$data['body'] = 'error on query';
					}
				}
				else {
					$sub_data['captcha_return'] = "<div style='color:red;'>username atau email sudah ada, silahkan ubah</div><br/>";
					$data['body'] = $this->load->view('register_v',$sub_data,true);
				}
			}
			else {
				$sub_data['captcha_return'] = "<div style='color:red;'>Captcha tidak sesuai.Silahkan coba lagi</div><br/>";
					$data['body'] = $this->load->view('register_v',$sub_data,true);
			}
		}
		}else {
			$data['body'] = $this->load->view('register_v',$sub_data,true);
		}
		$this->load->view('output_html_v',$data);
		}
	}

/* End of File register.php */
/* Location: ./applications/controllers/register.php */