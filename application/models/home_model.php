<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function daftar($username,$password,$email)
	{
		$data = array('username'=>$username, 'password'=>$password, 'email'=>$email);

		$this->db->insert('user', $data);
	}
}