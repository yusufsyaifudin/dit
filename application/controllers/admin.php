<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->helper('url'); sudah ditambahkan di autoload.php
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->model('admin_model');
		$this->load->library(array('form_validation','session'));
	}

	public function index()
	{
		$this->load->view('home_view');
	}

	function dashboard()
	{
		$this->load->library('pagination');

		$config = array();
		$config['base_url'] = "http://localhost/dit/index.php/admin/dashboard";
		$config['total_rows'] = $this->admin_model->count_all_post($this->session->userdata('username'));
		$config['per_page'] = 10;
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['result'] = $this->admin_model->tampilkan_semua($this->session->userdata('username'),$config['per_page'],$page);
		$data['links'] = $this->pagination->create_links();

		$data['pemasukan']	= $this->admin_model->jumlah_pemasukan();
		$data['pengeluaran']	= $this->admin_model->jumlah_pengeluaran();
		$this->load->view('admin/dashboard',$data);
	}

	function bulanan()
	{
		$data['bulan']	= $this->input->post('bulan');
		$data['tahun']  = $this->input->post('tahun');
		$data['result'] = $this->admin_model->tampilkan_perbulan($this->session->userdata('username'),$data['bulan'],$data['tahun']);
		$data['pemasukan']	= $this->admin_model->jumlah_bulanan($data['bulan'],'pemasukan');
		$data['pengeluaran']= $this->admin_model->jumlah_bulanan($data['bulan'],'pengeluaran');
		$this->load->view('admin/bulanan',$data);
	}

	function tambah_pemasukan()
	{
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required|prep_for_form|min_length[1]');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required|prep_for_form|min_length[1]');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required|prep_for_form|min_length[9]');
		$this->form_validation->set_rules('catatan', 'catatan', 'xss_clean|max_length[500]');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/pemasukan');
		} else {

			$user		= $this->session->userdata('username');
			$keterangan = $this->input->post('keterangan');
			$jumlah		= $this->input->post('jumlah');
			$tanggal	= $this->input->post('tanggal');
			$catatan	= $this->input->post('catatan');
			$this->admin_model->tambah($user, $keterangan,$jumlah,$tanggal,'',$catatan,'pemasukan');
			$this->session->set_flashdata('message','Sudah dimasukkan ke daftar pemasukan. <a href="'.base_url('index.php/admin/tambah_pemasukan').'">Tambah lagi?</a>');
			redirect(base_url('index.php/admin/tambah_pemasukan'));
		}
	}

	function tambah_pengeluaran()
	{
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required|prep_for_form|min_length[1]');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required|prep_for_form|min_length[1]');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required|prep_for_form|min_length[9]');
		$this->form_validation->set_rules('catatan', 'catatan', 'xss_clean|max_length[500]');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/pengeluaran');
		} else {

			$user 		= $this->session->userdata('username');
			$keterangan = $this->input->post('keterangan');
			$jumlah		= $this->input->post('jumlah');
			$tanggal	= $this->input->post('tanggal');
			$kebutuhan	= $this->input->post('kebutuhan');
			$catatan	= $this->input->post('catatan');
			
			$this->admin_model->tambah($user,$keterangan,$jumlah,$tanggal,$kebutuhan,$catatan,'pengeluaran');
			$this->session->set_flashdata('message','Sudah dimasukkan ke daftar pengeluaran. <a href="'.base_url('index.php/admin/tambah_pengeluaran').'">Tambah lagi?</a>');
			redirect(base_url('index.php/admin/tambah_pengeluaran'));
		}
	}
}