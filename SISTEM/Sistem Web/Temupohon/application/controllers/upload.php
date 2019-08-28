<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller
{
	var $limit = 10;
	var $offset = 10;
	
	public function __construct(){
		parent :: __construct();
		$this->load->model(array('upload_m','auth_m'));
	}
	
	public function index($page = NULL, $offset = '', $key = NULL)
	{
		if($this->auth_m->check_logged() === FALSE){
			redirect(base_url().'RegisterUser/');
		} else {
			$this->data['title'] = 'Upload with CodeIgniter';
			$this->data['query'] = $this->upload_m->get_all_image();
			$data['body'] = $this->load->view('upload_v', $this->data);
			//tampilan awal saat controller diakses
			$this->load->view('output_html_v',$data);
		}
	}
	
	public function add() {
		$this->data['title'] = 'Form Upload with CodeIgniter';
		$data['body'] = $this->load->view('form_upload', $this->data);
		$this->load->view('output_html_v',$data);
	}
	
	public function insert(){
		$namafile = "file_".time();
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
			$data = array ('nama_gambar'=> $gambar['file_name'],
							'tipe_gambar'=> $gambar['file_type'],
							'ket_gambar'=> $this->input->post('textket'));
			$this->upload_m->get_insert($data);
			$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- success\" id=\"alert\">Upload Berhasil</div></div>");
			redirect('upload');
		} else {
			
			$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- danger\" id=\"alert\">Upload Gagal</div></div>");
			redirect('upload/add');
			}
		}
	}
	
	function download($file)
	{
		$name = $file;
		$data = file_get_contents('./assets/images/uploads/'.$file);
		force_download($name, $data);
		redirect('index','refresh');
	}

}