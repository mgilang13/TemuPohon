<?php if(!defined('BASEPATH'))exit('No direct script acces allowed');

class Security_admin_m extends CI_Model
{
	public function getAdminInfo($id) {
		$q = $this->db->get_where('admin', array('id_admin' =>$id), 1);
		if($this->db->affected_rows()>0) {
			$row = $q->row();
			
			return $row;

		} else {
			error_log('no user found!('.$id.')');
			return false;
		}
	}

	 public function getAdminInfoByEmail($email){  
     $q = $this->db->get_where('admin', array('email' => $email), 1);   
     if($this->db->affected_rows() > 0){  
       $row = $q->row();  
       return $row;  
     }  
   }  


	public function insertToken($admin_id) {
		$token = substr(sha1(rand()),0, 30);
		$date = date('Y-m-d');
		
		$string = array(
				'token' => $token,
				'admin_id' => $admin_id,
				'created' => $date
			);

		$query = $this->db->insert('tokens-admin', $string);
		
		return $token.$admin_id;
	}

	public function isTokenValid($token) {
		$tkn = substr($token, 0, 30);
		$uid = substr($token, 30);

		$q = $this->db->get_where('tokens-admin', array('tokens-admin.token' => $tkn,
			'tokens-admin.admin_id' => $uid), 1);

		if ($this->db->affected_rows()>0) {
			$row = $q->row();
			
			$created = $row->created;
			$createdTS = strtotime($created);
			$today = date('Y-m-d');
			$todayTS = strtotime($today);

			if ($createdTS != $todayTS) {
				return false;
			}

			$admin_info = $this->getAdminInfo($row->admin_id);
			return $admin_info;
		} else {
			return false;
		}
	}

	public function updatePassword($post) {
  
		$this->db->where('id_admin', $post['id_admin']);

		$this->db->update('admin', array('password' => $post['password']));
	
		return true;
	}
}

/* End of file upload_m.php */
/* Location: ./application/models/upload_m.php */