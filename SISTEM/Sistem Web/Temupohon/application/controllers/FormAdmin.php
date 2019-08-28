<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class FormAdmin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('captcha_m','admin_encrypt_m','admin_auth_m', 'register_m', 'upload_m', 'Userpage_m'));	
		// $this->gallery_path = realpath(APPPATH.'../upload/imageKTP/');
		// $this->gallery_path_url = base_url(). '/upload/imageKTP/';	
	}
	
	function index(){
		if(!$this->admin_auth_m->check_logged()===true)
			redirect(base_url().'AdminLogin/');

		$data['title'] = 'Form Admin';
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
		$this->form_validation->set_rules('job', 'Pekerjaan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('terms','Terms of Services','trim|required|xss_clean');
		$this->form_validation->set_rules('captcha','Captcha','required');
		$this->form_validation->set_error_delimiters('<div style="color:red;">','</div>');
		
		if($this->form_validation->run()== false){
			$data['body'] = $this->load->view('form-admin',$sub_data,true);
		}else{
			if($this->captcha_m->check_captcha()==TRUE){
				$nama = $this->input->post('nama');
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$alamat = $this->input->post('alamat');
				$gender = $this->input->post('gender');
				$job = $this->input->post('job');
				$level = $this->input->post('level');
				$id_admin = time();

				$term = $this->input->post('terms');
				$cek = $this->register_m->check_query('admin',$username);
				$cek_email = $this->register_m->check_query2('admin', $email);
				if($cek == false and $cek_email == false){
					$rand_salt = $this->admin_encrypt_m->genRndSalt();
					$encrypt_pass = $this->admin_encrypt_m->encryptUserPwd($this->input->post('password'),$rand_salt);
					$input_data = array(
						'id_admin' => $id_admin,
						'nama' => $nama,
						'username' => $username,
						'email'=>$email,
						'password' => $encrypt_pass,
						'alamat' => $alamat,
						'gender' => $gender,
						'job' => $job,
						'salt' => $rand_salt,
						'level' => $level
					);	
					
					if($this->register_m->insert('admin', $input_data)){

						$ket_gambar='';
						if ($level == 'super-admin') {
							$ket_gambar= "Gambar Identitas Super Admin";
						} else if($level == 'admin') {
							$ket_gambar= "Gambar Identitas Admin";
						}

						$namafile = $id_admin.$username;
						
						$config['upload_path'] = './assets/images/uploads/imagektp/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
						
						$config['max_size'] = '2048';
						$config['max_width'] = '1288';
						$config['max_height'] = '768';
						$config['file_name'] = $namafile;
						
						$this->upload->initialize($config);
					

						if($_FILES['filefoto']['name']){
						if ($this->upload->do_upload('filefoto')){
							$gambar= $this->upload->data();
							$data = array (	'id_gambar' => time(),
											'nama_gambar'=> $gambar['file_name'],
											'tipe_gambar'=> $gambar['file_type'],
											'ket_gambar' => $ket_gambar);
							$where = array('id_gambar' => $id_admin);
							$this->upload_m->get_insert($data);
						
							// update tabel Admin
							$data = array('nama_gambar' => $gambar['file_name']);

							$this->Userpage_m->update_admin_by_id($data, $id_admin);
							
							$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- success\" id=\"alert\">Upload Berhasil</div></div>");
							 redirect('SuperAdminPage');
						} else {
							
							$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- danger\" id=\"alert\">Upload Gagal</div></div>");
							redirect('FormAdmin');
							}
								// redirect(base_url().'UserLogin/');
						}
						redirect(base_url().'AdminLogin/');
					}

					else {
						$data['body'] = 'error on query';
					}
				}
				else {
					$sub_data['captcha_return'] = "<div style='color:red;'>Username atau email sudah ada, silahkan ubah</div><br/>";
					$data['body'] = $this->load->view('form-admin',$sub_data,true);
				}
			}
			else {
				$sub_data['captcha_return'] = "<div style='color:red;'>Captcha tidak sesuai.Silahkan coba lagi</div><br/>";
					$data['body'] = $this->load->view('form-admin',$sub_data,true);
			}
		}
		}else {
			$data['body'] = $this->load->view('form-admin',$sub_data,true);
		}
		$this->load->view('output_html_v',$data);
		}
}

/* End of File register.php */
/* Location: ./applications/controllers/register.php */