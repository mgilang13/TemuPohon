<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Encrypt_m extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	//Generate Random Digit
	function genRndDgt($length = 8, $specialCharacters = true){
		$digits = '';
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ23456789";
		
		if($specialCharacters === true)
			$chars .= "!?=/&+,.";
		
		for($i=0; $i < $length; $i++){
			$x = mt_rand(0, strlen($chars) -1);
			$digits .= $chars{$x}; 
		}
		return $digits;
	}
	
	//Generate Random Salt for Password Encryption
	function genRndSalt(){
		return $this->genRndDgt(8, true);
	}
	
	//Encrypt User Password
	function encryptUserPwd($pwd, $salt){
		return sha1(md5($pwd) . $salt);
	}
}

/* End of file encrypt_m.php */
/* Location: ./application/models/encrypt_m.php */