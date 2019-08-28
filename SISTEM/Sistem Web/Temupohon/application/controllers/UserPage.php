<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class UserPage extends CI_Controller

{

	var $data = array();



	function __construct()

	{

		parent :: __construct();

		//$this->load->helper('form');

		$this->load->model(array('Userpage_m','auth_m','upload_m'));

		   $this->load->library('Ci_qr_code');
		   // $this->output->cache(20);

        $this->config->load('qr_code');

	}



	function index()

	{

		//$this->add_new();

		$data['title'] = 'User Page';

		if($this->auth_m->check_logged()===FALSE){

			redirect(base_url().'UserLogin/');

		}else{

			$data['search'] = $this->input->post('search');

			//set session user data untuk pencarian, untuk paging pencarian

			$this->session->set_userdata('sess_search', $data['search']);

			$this->db->like('nama_pohon', $data['search']);

			$this->db->from('datapohon');

			//Pagination init

			$config['base_url'] = base_url().'UserPage/index/page/';

			$config['total_rows'] = $this->db->count_all_results();

			$config['per_page'] = 5;

			$config['uri_segment'] = 4;

			$config['num_links'] = 4;

			$this->pagination->initialize($config);

			$this->data['ListPohon'] = $this->Userpage_m->search_result($config['per_page'], $this->uri->segment(4,0),$data['search']);

			$this->data['no'] = $this->uri->segment(4,0);

			$this->data['query'] = $this->Userpage_m->get_records();

			$data['body'] = $this->load->view('user-page', $this->data);

			$this->load->view('output_html_v', $data);

		}

    

	}

	

	function add_new()

	{

		$this->data['title'] = "Tambah Data Pohon";

		$this->data['is_update'] = 0;

		$data['body'] = $this->load->view('tambah-pohon',$this->data);

		$this->load->view('output_html_v', $data);

	}

	

	function view($id) {



		$this->data['title'] = "View Data Pohon";

		$data['query'] = $this->Userpage_m->get_records("id_pohon = '$id'")->row_array();



		// $data['nama_pohon'] = $this->input->post('nama_pohon', true);

		// $data['nama_latin'] = $this->input->post('nama_latin', true);

		// $data['sinonim'] = $this->input->post('sinonim', true);

		// $data['perawakan'] = $this->input->post('perawakan', true);

		// $data['biologi'] = $this->input->post('biologi', true);

		// $data['status_konservasi'] = $this->input->post('status_konservasi', true);

		// $data['persebaran'] = $this->input->post('persebaran', true);

		$data['body'] = $this->load->view('view-pohon', $data);

		$this->load->view('output_html_v', $data);

		

// if ($this->Userpage_m->view_by_id($data, $id)) {

// 		$data['body'] = $this->load->view('view-pohon', $this->data);

// 		$this->load->view('output_html_v', $data);



		

// 			redirect('UserPage/view');

// 		}

		

	}



	function edit($id){

		$this->data['title'] = "Update Data Pohon";

		$this->data['query'] = $this->Userpage_m->get_records("id_pohon = '$id'");

		// $this->data['query2'] = $this->Userpage_m->get_records("id_gambar = '$gambar'");

		$this->data['is_update'] = 1;



		$data['nama_gambar']= $id;

		$data['body'] = $this->load->view('update-pohon', $this->data);

		$this->load->view('output_html_v', $data);

	}

	

	function delete($id){

		

		if($this->Userpage_m->delete_by_id($id)) {

			redirect('UserPage');

		}

	}



	function deletePesanUser($id) {

		if ($this->Userpage_m->delete_pesan_by_id($id)) {

			redirect('UserPage/viewPesan');

		}

	}



	function save($is_update = 0){

		

		$id_pohon = $this->input->post('id_pohon', true);

		

		$namapohon = $this->input->post('nama_pohon',true);

		

		$data['nama_pohon'] = $this->input->post('nama_pohon', true);

		$data['nama_latin'] = $this->input->post('nama_latin', true);

		$data['sinonim'] = $this->input->post('sinonim', true);

		$data['perawakan'] = $this->input->post('perawakan', true);

		$data['biologi'] = $this->input->post('biologi', true);

		$data['habitat'] = $this->input->post('habitat', true);

		$data['potensi'] = $this->input->post('potensi', true);

		$data['status_konservasi'] = $this->input->post('status_konservasi', true);

		$data['persebaran'] = $this->input->post('persebaran', true);

		$data['add_by'] = $this->session->userdata('nama');

	



		if($is_update == 0){

			$data['id_pohon'] =  random_string('alnum');

			$idPohon = $data['id_pohon'];

			//Tambah Data Baru

			if($this->Userpage_m->insert($data)) {



				$ket_gambar= "Gambar Pohon";

				$config['upload_path'] = './assets/images/uploads/gambarPohon/';

				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

				

				$config['max_size'] = '2048';

				$config['max_width'] = '2000';

				$config['max_height'] = '2000';

				$config['file_name'] = $idPohon;

				
				$this->load->library('image_lib');

			    $img_cfg['image_library'] = 'gd2';
			    $img_cfg['source_image'] = './assets/images/uploads/gambarPohon/';
			    $img_cfg['maintain_ratio'] = TRUE;
			    $img_cfg['create_thumb'] = TRUE;
			    $img_cfg['new_image'] = './assets/images/uploads/gambarPohon/';
			    $img_cfg['width'] = 75;
			    $img_cfg['quality'] = 100;
			    $img_cfg['height'] = 40;

			    $this->image_lib->initialize($img_cfg);
			    $this->image_lib->resize();

				



				$this->upload->initialize($config);

			



				if($_FILES['gambarPohon']['name']){

				if ($this->upload->do_upload('gambarPohon')){

					$gambar= $this->upload->data();

					$data = array (

									'id_gambar' => $idPohon,

									'nama_gambar'=> $gambar['file_name'],

									'tipe_gambar'=> $gambar['file_type'],

									'ket_gambar' => $ket_gambar);

					$where= array('id_gambar'=> $idPohon); 



					$this->upload_m->get_insert($data);

					// update tabel Pohon

					$data = array('nama_gambar' => $gambar['file_name']);

					$this->Userpage_m->update_by_id($data, $idPohon);

					// var_dump($idPohon);

					// exit();

					// $this->upload_m->get_update($data, $where);

					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- success\" id=\"alert\">Upload Berhasil</div></div>");

					// redirect('RegisterUser');

				} else {

					

					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- danger\" id=\"alert\">Upload Gagal</div></div>");

					redirect('UserPage/add_new/');

					}

			}

			 redirect('UserPage');

		}

}else{

			//Update Data

			$id = $this->input->post('id_pohon');

			$nama_gambar = $this->input->post('nama_gambar');



			if($this->Userpage_m->update_by_id($data, $id)) {



				// $ket_gambar= "Gambar Pohon";

				$config['upload_path'] = './assets/images/uploads/gambarPohon/';

				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';

				

				$config['max_size'] = '2048';

				$config['max_width'] = '2000';

				$config['max_height'] = '2000';

				$config['file_name'] = $id;

        $config['overwrite'] = true; //overwrite user avatar

				

				

        		$this->load->library('image_lib');

			    $img_cfg['image_library'] = 'gd2';
			    $img_cfg['source_image'] = './assets/images/uploads/gambarPohon/';
			    $img_cfg['maintain_ratio'] = TRUE;
			    $img_cfg['create_thumb'] = TRUE;
			    $img_cfg['new_image'] = './assets/images/uploads/gambarPohon/';
			    $img_cfg['width'] = 75;
			    $img_cfg['quality'] = 100;
			    $img_cfg['height'] = 40;

			    $this->image_lib->initialize($img_cfg);
			    $this->image_lib->resize();



				$this->upload->initialize($config);

			



				if($_FILES['gambarPohon']['name']){

				if ($this->upload->do_upload('gambarPohon')){

					$gambar= $this->upload->data();

					$data = array (

									

									'nama_gambar'=> $gambar['file_name'],

									'tipe_gambar'=> $gambar['file_type']

									// 'ket_gambar' => $ket_gambar

									);

					$where= array('id_gambar'=> $id); 

					// $this->upload_m->get_insert($data);

					$this->upload_m->get_update($data, $where);



					$data = array('nama_gambar' => $gambar['file_name']);

					$this->Userpage_m->update_by_id($data, $idPohon);



					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- success\" id=\"alert\">Upload Berhasil</div></div>");

					// redirect('RegisterUser');

				} else {

					

					$this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert- danger\" id=\"alert\">Upload Gagal</div></div>");

					redirect('UserPage/edit/');

					}



				 redirect('UserPage');

			}



				redirect('UserPage');

			}

		}

}

	function viewPesan () {

		$data['title'] = 'View Pesan dari Admin';

		$data['search'] = $this->input->post('search');

			//set session user data untuk pencarian, untuk paging pencarian

		$this->session->set_userdata('sess_search', $data['search']);

		$this->db->like('id_pesan', $data['search']);

		$this->db->from('pesan-admin');





		//Pagination init

		$config['base_url'] = base_url().'UserPage/viewPesan/';

		$config['total_rows'] = $this->db->count_all_results();

		$config['per_page'] = "5";

		$config['uri_segment'] = 3;

		$config['num_links'] = 3;

		

		$this->pagination->initialize($config);

		$id_logged_user = $this->session->userdata('logged_user');

		// var_dump($id_logged_user);

		// exit();

		$this->data['ListPesanAdmin'] = $this->Userpage_m->search_pesan_admin($config['per_page'], $this->uri->segment(3,0),$data['search'], $id_logged_user);



		$this->data['no'] = $this->uri->segment(3,0);

		$data['body'] = $this->load->view('view-pesan-page', $this->data);

		$this->load->view('output_html_v', $data);

	}



	function viewPesanUser($id) {

		$data['title'] = "View Pesan Admin";

		$data['query'] = $this->Userpage_m->get_pesan_user_records("id_pesan = '$id'")->row_array();

		$data['body'] = $this->load->view('view-pesan-user', $data);

		$this->load->view('output_html_v', $data);

	}



	  function print_qr($id)

    {

        $qr_code_config = array();

        $qr_code_config['cacheable'] = $this->config->item('cacheable');

        $qr_code_config['cachedir'] = $this->config->item('cachedir');

        $qr_code_config['imagedir'] = $this->config->item('imagedir');

        $qr_code_config['errorlog'] = $this->config->item('errorlog');

        $qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');

        $qr_code_config['quality'] = $this->config->item('quality');

        $qr_code_config['size'] = $this->config->item('size');

        $qr_code_config['black'] = $this->config->item('black');

        $qr_code_config['white'] = $this->config->item('white');



        $this->ci_qr_code->initialize($qr_code_config);



        // get full data pohon

        $data_pohon = $this->Userpage_m->get_records("id_pohon = '$id'")->row_array();

        $image_name = $id . "qr.png";

       

        // create pohon content
        $codeContents = '';
        $codeContents .=$data_pohon['id_pohon'];

        // $codeContents = "Nama Pohon:";

        // $codeContents .= $data_pohon['nama_pohon'];

        // $codeContents .= "\n";

        // $codeContents .= "Nama Latin:";

        // $codeContents .=  $data_pohon['nama_latin'];

        // $codeContents .= "\n";

        // $codeContents .= "Sinonim :";

        // $codeContents .=  $data_pohon['sinonim'];

        // $codeContents .= "\n";

        // $codeContents .= "Perawakan: ";

        // $codeContents .=  $data_pohon['perawakan'];

        // $codeContents .= "\n";

        // $codeContents .= "Biologi: ";

        // $codeContents .=  $data_pohon['biologi'];

        // $codeContents .= "\n";

        // $codeContents .= "Status Konservasi : ";

        // $codeContents .=  $data_pohon['status_konservasi'];

        // $codeContents .= "\n";

        // $codeContents .= "Persebaran : ";

        // $codeContents .=  $data_pohon['persebaran'];



        $params['data'] = $codeContents;

        $params['level'] = 'H';

        $params['size'] = 2;



        $params['savepohon'] = FCPATH . $qr_code_config['imagedir'] . $image_name;

        $this->ci_qr_code->generate($params);


        $this->data['qr_code_image_url'] = base_url() . $qr_code_config['imagedir'] . $image_name;
// var_dump($this->data['qr_code_image_url']);
// exit();




        // save image path in tree table

        $this->Userpage_m->change_pohonqr($id, $image_name);

        // then redirect to see image link

        $file = $params['savepohon'];


        if(file_exists($file)){

            header('Content-Description: File Transfer');

            header("Content-Type: image/png");

            header('Content-Disposition: attachment; filename='.basename($file));

            header('Content-Transfer-Encoding: binary');

            header('Expires: 0');

            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

            header('Pragma: public');

            header('Content-Length: ' . filesize($file));

            // ob_clean();

            // flush();

            readfile($file);

            unlink($file); // deletes the temporary file



            exit;

        }

    }

}



/* End of file buku.php */

/* Location: ./application/controllers/buku.php */