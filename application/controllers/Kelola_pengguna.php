<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//load model and add alias
		//check session logged_in
			$this->load->model(array('m_pengguna'));
			$this->m_pengguna->check_session();

	}

	public function tambah_dosen()
	{
		$data['panel_title'] = 'Tambah Dosen';
    $data['konten'] = 'pengguna/v_tambah_dosen';
    $this->load->view('template_admin', $data);
	}

	public function tampil_dosen()
	{
		$data['panel_title'] = 'Tambah Dosen';
		$data['db'] = $this->m_pengguna->tampil_data_dosen();
    $data['konten'] = 'pengguna/v_tampil_dosen';
    $this->load->view('template_admin', $data);
	}

	public function tambah_dosen_proses()
	{
		$data_1 = array(
			"username" 			=> $this->input->post('username'),
			"password" 			=> md5($this->input->post('password')),
			"hak_akses" 		=> 2 ,
			"gambar" 				=> "dosen.png" ,
		);

		$id_pengguna = $this->m_pengguna->tambah_data_pengguna($data_1);

		$data_2 = array(
			"nama_dosen" 		=> $this->input->post('nama_dosen'),
			"kontak" 				=> $this->input->post('kontak'),
			"alamat" 				=> $this->input->post('alamat'),
			"id_pengguna"		=> $id_pengguna,
		);

		$this->m_pengguna->tambah_data_dosen($data_2);
		$alert	= "<script>alert('Data berhasil disimpan')</script>";
		$this->session->set_flashdata("alert", $alert);
		redirect('kelola_pengguna/tampil_dosen');

	}

	public function edit_dosen($id)
	{
		$data['panel_title'] = 'Edit Dosen';
    $data['db'] = $this->m_pengguna->lihat_dosen_by($id);
    $data['konten'] = 'pengguna/v_edit_dosen';
    $this->load->view('template_admin', $data);
	}

	public function edit_dosen_proses($id)
	{
		$id = $this->uri->segment('3');
		$data = array(
			"nama_dosen" 		=> $this->input->post('nama_dosen'),
			"kontak" 				=> $this->input->post('kontak'),
			"alamat" 				=> $this->input->post('alamat'),
		);

		$this->m_pengguna->edit_data_dosen($data, $id);
		$alert	= "<script>alert('Data berhasil disimpan')</script>";
		$this->session->set_flashdata("alert", $alert);
		redirect('kelola_pengguna/tampil_dosen');
	}

	public function hapus_dosen($id)
	{
		$id = $this->uri->segment('3');
		$this->m_pengguna->hapus_data_dosen($id);
		$alert	= "<script>alert('Data berhasil dihapus')</script>";
		$this->session->set_flashdata("alert", $alert);
		redirect('kelola_pengguna/tampil_dosen');
	}

	public function tambah_mahasiswa()
	{
		$data['panel_title'] = 'Tambah Mahasiswa';
		$data['konten'] = 'pengguna/v_tambah_mahasiswa';
		$this->load->view('template_admin', $data);
	}

	public function tampil_mahasiswa()
	{
		$data['panel_title'] = 'Tambah Mahasiswa';
		$data['db'] = $this->m_pengguna->tampil_data_mahasiswa();
		$data['konten'] = 'pengguna/v_tampil_mahasiswa';
		$this->load->view('template_admin', $data);
	}

	public function tambah_mahasiswa_proses()
	{
		$npm = $this->input->post('npm');
		$data_1 = array(
			"username" 			=>$this->input->post('username'),
			"password" 			=>  md5($this->input->post('password')),
			"hak_akses" 		=> 3 ,
			"gambar" 				=> "mahasiswa.png" ,
		);

		$id_pengguna = $this->m_pengguna->tambah_data_pengguna($data_1);

		$data_2 = array(
			"npm" 					=> $this->input->post('npm'),
			"nama_mahasiswa"=> $this->input->post('nama_mahasiswa'),
			"id_pengguna"		=> $id_pengguna,
		);

		$this->m_pengguna->tambah_data_mahasiswa($data_2);
		$alert	= "<script>alert('Data berhasil disimpan')</script>";
		$this->session->set_flashdata("alert", $alert);
		redirect('kelola_pengguna/tampil_mahasiswa');
	}

	public function edit_mahasiswa($id)
	{
		$data['panel_title'] = 'Edit Mahasiswa';
		$data['db'] = $this->m_pengguna->lihat_mahasiswa_by($id);
		$data['konten'] = 'pengguna/v_edit_mahasiswa';
		$this->load->view('template_admin', $data);
	}

	public function edit_mahasiswa_proses($id)
	{
		$id = $this->uri->segment('3');

		$data = array(
			"npm" 					=> $this->input->post('npm'),
			"nama_mahasiswa"=> $this->input->post('nama_mahasiswa'),
		);

		$this->m_pengguna->edit_data_mahasiswa($data, $id);
		$alert	= "<script>alert('Data berhasil diubah')</script>";
		$this->session->set_flashdata("alert", $alert);
		redirect('kelola_pengguna/tampil_mahasiswa');
	}

	public function hapus_mahasiswa($id)
	{
		$id = $this->uri->segment('3');
		$this->m_pengguna->hapus_data_mahasiswa($id);
		$alert	= "<script>alert('Data berhasil dihapus')</script>";
		$this->session->set_flashdata("alert", $alert);
		redirect('kelola_pengguna/tampil_mahasiswa');
	}

}
