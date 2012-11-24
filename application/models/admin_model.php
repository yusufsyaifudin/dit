<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function count_all_post($username)
	{
		return $this->db->count_all_results($username);
	}

	function tambah($user,$keterangan,$jumlah,$tanggal,$kebutuhan,$catatan,$jenis)
	{
		$data = array('keterangan'=>$keterangan, 'jumlah'=>$jumlah, 'tanggal'=>$tanggal, 'kebutuhan'=>$kebutuhan, 'catatan'=>$catatan, 'jenis'=>$jenis);

		$this->db->insert($user, $data);
	}

	function tampilkan_semua($user,$limit,$start)
	{
		$this->db->order_by('tanggal','asc');
		$this->db->order_by('nomor','asc');
		$this->db->limit($limit,$start);

		$query	= $this->db->get($user);

		if ($query->num_rows() > 0) {
			foreach($query->result() as $key) {
				$data[] = $key;
			}
			return $data;
		}
		return false;
	}

	function tampilkan_perbulan($user,$bulan,$tahun)
	{
		$this->db->order_by('tanggal','asc');
		$this->db->where('YEAR(tanggal)',$tahun);
		$this->db->where('MONTH(tanggal)',$bulan);

		$query	= $this->db->get($user);
		return $query->result();
	}

	function jumlah_pemasukan()
	{
		$this->db->select_sum('jumlah');
		$this->db->where('jenis','pemasukan');
		$query = $this->db->get($this->session->userdata('username'));
		return $query->row();
	}

	function jumlah_pengeluaran()
	{
		$this->db->select_sum('jumlah');
		$this->db->where('jenis','pengeluaran');
		$query = $this->db->get($this->session->userdata('username'));
		return $query->row();
	}

	function jumlah_bulanan($bulan,$jenis)
	{
		$this->db->select_sum('jumlah');
		$this->db->where('jenis',$jenis);
		$this->db->where('MONTH(tanggal)',$bulan);
		$query = $this->db->get($this->session->userdata('username'));
		return $query->row();
	}
}
