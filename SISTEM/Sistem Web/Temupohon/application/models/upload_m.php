<?php if(!defined('BASEPATH'))exit('No direct script acces allowed');

class Upload_m extends CI_Model
{
	var $table_name = 'uploadimage';
	
	function __construct(){
		parent::__construct();
	}
	
	//fungsi untuk menampilkan semua data dari tabel
	function get_all_image(){
		$this->db->from($this->table_name);
		$query = $this->db->get();
		
			//cek apakah ada data
			if($query->num_rows() > 0){
				return $query->result();
			}
	}
	
	//fungsi insert ke database
	function get_insert($data){
		$this->db->insert($this->table_name, $data);
		return TRUE;
	}

	function get_update($data, $where) {
		//cek gambar
		if(file_exists($data['nama_gambar'])) {
			@unlink($data['nama_gambar']);
		}
		$this->db->update($this->table_name, $data, $where);
		return TRUE;
	}
}

/* End of file upload_m.php */
/* Location: ./application/models/upload_m.php */