<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//helper 'url' sudah diset di autoload.php
		$this->load->helper('form');
		$this->load->library(array('form_validation','encrypt'));
	}

	public function index()
	{
		$this->load->view('home_view');
	}

	function login()
	{
		$username = mysql_real_escape_string($this->input->post('username'));
		$password = mysql_real_escape_string($this->input->post('password'));
		$password = md5($password);

			//query untuk mengecek apakah username DAN password ada dalam database
			$query = $this->db->query("SELECT * FROM user WHERE username='$username' AND password='$password' ");
				if ($query->num_rows() == 1) {
					$username  = $query->row()->username;
					$privilege = $query->row()->privilege;

					//jika query TRUE kemudian simpan username kedalam session
					$data_session = array('username'=>$username, 'privilege'=>$privilege, 'masuk'=>TRUE);

					$this->session->set_userdata($data_session);
					redirect('admin/dashboard');
				} else {
					$this->session->set_flashdata('message', 'Username atau Password yang Anda masukkan salah!');
					redirect('home');
				}
				
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

	function daftar()
	{
		$this->load->model('home_model');
		$this->load->dbforge();

		$this->form_validation->set_rules('username', 'username', 'required|prep_for_form|min_length[1]');
		$this->form_validation->set_rules('password', 'password', 'required|prep_for_form|min_length[1]');
		$this->form_validation->set_rules('email', 'email', 'required|prep_for_form|valid_email');

		if ($this->form_validation->run() == false) {
			redirect(base_url());
		} else {

			$fields = array(
                        'nomor' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 20,
                                                 'unsigned' => TRUE,
                                                 'auto_increment' => TRUE
                                          ),
                        'keterangan' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '50',
                                          ),
                        'jumlah' => array(
                                                 'type' =>'INT',
                                                 'constraint' => '10',
                                          ),
                        'tanggal' => array(
                                                 'type' => 'date',
                                          ),
                        'kebutuhan' => array(
                        						'type'=>'VARCHAR',
                        						'constraint' => '50',
                        	),
                        'catatan' => array(
                        						'type' => 'VARCHAR',
                        						'constraint' => '500',
                        	),
                        'jenis' => array(
                        						'type' => 'VARCHAR',
                        						'constraint' => '20',
                        	),
                );

			//Mendapatkan nilai dari input user
			$username 	= $this->input->post('username');
			$password 	= $this->input->post('password');
			$password 	= md5($password);
			$email 		= $this->input->post('email');

			//Membuat tabel baru di database dengan nama tabel sesuai username
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('nomor', TRUE);
			$this->dbforge->create_table($username);

			$this->home_model->daftar($username,$password,$email);
			$this->session->set_flashdata('message','Sudah terdaftar.');
			redirect(base_url());
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */