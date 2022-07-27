<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasyarakatController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		is_logged_in();
		if ($this->session->userdata('level') != 'admin') :
			redirect('Auth/BlockedController');
		endif;
		$this->load->model('Masyarakat_m');
	}

	// List all your items
	public function index()
	{
		$data['title'] = 'Data Masyarakat';
		$data['data_masyarakat'] = $this->db->get('masyarakat')->result_array();

		$this->form_validation->set_rules('username', 'username', 'trim|required|alpha_numeric_spaces');
		// $this->form_validation->set_rules('alamat', 'alamat', 'trim|required|alpha_numeric_spaces|callback_alamat_check');
		$this->form_validation->set_rules('telp', 'Telp', 'trim|required|numeric');

		if ($this->form_validation->run() == FALSE) :
			$this->load->view('_part/backend_head', $data);
			$this->load->view('_part/backend_sidebar_v');
			$this->load->view('_part/backend_topbar_v');
			$this->load->view('admin/masyarakat');
			$this->load->view('_part/backend_footer_v');
			$this->load->view('_part/backend_foot');
		else :
			$params = [
				'username'			=> htmlspecialchars($this->input->post('username', TRUE)),
				'alamat'				=> htmlspecialchars($this->input->post('alamat', TRUE)),
				// 'password'				=> password_hash(htmlspecialchars($this->input->post('password', TRUE)), PASSWORD_DEFAULT),
				'telp'					=> htmlspecialchars($this->input->post('telp', TRUE)),
				// 'level'					=> htmlspecialchars($this->input->post('level', TRUE)),
				// 'foto_profile'			=> 'user.png',
			];

			$resp = $this->Masyarakat_m->create($params);

			if ($resp) :
				$this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">
					Buat akun masyarakat berhasil
					</div>');

				redirect('Admin/MasyarakatController');
			else :
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
					Buat akun masyarakat berhasil!
					</div>');

				redirect('Admin/MasyarakatController');
			endif;
		endif;
	}

	public function delete($id)
	{

		$id_masyarakat = htmlspecialchars($id); // id petugas

		$cek_data = $this->db->get_where('masyarakat', ['id_masyarakat' => $id_masyarakat])->row_array();

		if (!empty($cek_data)) :
			$resp = $this->db->delete('masyarakat', ['id_masyarakat' => $id_masyarakat]);

			if ($resp) :
				$this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">
				Akun berhasil dihapus
				</div>');

				redirect('Admin/MasyarakatController');
			else :
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
				Akun gagal dihapus!
				</div>');

				redirect('Admin/MasyarakatController');
			endif;
		else :
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
			Data tidak ada
			</div>');

			redirect('Admin/MasyarakatController');
		endif;
	}

	public function edit($id)
	{
		$id_masyarakat = htmlspecialchars($id); // id petugas

		$cek_data = $this->db->get_where('masyarakat', ['id_masyarakat' => $id_masyarakat])->row_array();

		if (!empty($cek_data)) :

			$data['title'] = 'Edit Masyarakat';
			$data['masyarakat'] = $cek_data;

			$this->form_validation->set_rules('username', 'username', 'trim|required|alpha_numeric_spaces');
			// $this->form_validation->set_rules('alamat', 'alamat', 'trim|required|alpha_numeric_spaces|callback_alamat_check');
			$this->form_validation->set_rules('telp', 'Telp', 'trim|required|numeric');

			if ($this->form_validation->run() == FALSE) :
				$this->load->view('_part/backend_head', $data);
				$this->load->view('_part/backend_sidebar_v');
				$this->load->view('_part/backend_topbar_v');
				$this->load->view('admin/edit_masyarakat');
				$this->load->view('_part/backend_footer_v');
				$this->load->view('_part/backend_foot');
			else :

				$params = [
					'username'			=> htmlspecialchars($this->input->post('username', TRUE)),
					'alamat'				=> htmlspecialchars($this->input->post('alamat', TRUE)),
					// 'password'				=> password_hash(htmlspecialchars($this->input->post('password', TRUE)), PASSWORD_DEFAULT),
					'telp'					=> htmlspecialchars($this->input->post('telp', TRUE)),
					// 'level'					=> htmlspecialchars($this->input->post('level', TRUE)),
					// 'foto_profile'			=> 'user.png',
				];

				$resp = $this->db->update('masyarakat', $params, ['id_masyarakat' => $id_masyarakat]);

				if ($resp) :
					$this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">
					Akun petugas berhasil di edit
					</div>');

					redirect('Admin/MasyarakatController');
				else :
					$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
					Akun petugas gagal di edit!
					</div>');

					redirect('Admin/MasyarakatController');
				endif;

			endif;

		else :
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
				Data tidak ada
				</div>');

			redirect('Admin/MasyarakatController');
		endif;
	}

	// public function username_check($str = NULL)
	// {
	// 	if (!empty($str)) :
	// 		$masyarakat = $this->db->get_where('masyarakat', ['username' => $str])->row_array();

	// 		$petugas = $this->db->get_where('petugas', ['username' => $str])->row_array();

	// 		if ($masyarakat == true || $petugas == true) :

	// 			$this->form_validation->set_message('username_check', 'Username ini sudah terdaftar ada.');

	// 			return false;
	// 		else :
	// 			return true;
	// 		endif;
	// 	else :
	// 		$this->form_validation->set_message('username_check', 'Inputan Kosong');

	// 		return false;
	// 	endif;
	// }
}

/* End of file PetugasController.php */
/* Location: ./application/controllers/Admin/MasyarakatController.php */
