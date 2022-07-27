<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengaduanController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		is_logged_in();
		if ($this->session->userdata('level') != 'admin') :
			redirect('Auth/BlockedController');
		endif;
		$this->load->model('Pengaduan_m');
	}

	// List all your items
	public function index()
	{
		$data['title'] = 'Pengaduan';
		$masyarakat = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
		$data['data_pengaduan'] = $this->Pengaduan_m->data_pengaduan()->result_array();

		$this->form_validation->set_rules('isi_laporan', 'Isi Laporan Pengaduan', 'trim|required');

		if ($this->form_validation->run() == FALSE) :
			$this->load->view('_part/backend_head', $data);
			$this->load->view('_part/backend_sidebar_v');
			$this->load->view('_part/backend_topbar_v');
			$this->load->view('admin/pengaduan');
			$this->load->view('_part/backend_footer_v');
			$this->load->view('_part/backend_foot');
		else :

			$params = [
				'tgl_pengaduan'  	=> date('Y-m-d'),
				'id_masyarakat'				=> $masyarakat['id_masyarakat'],
				'isi_laporan'		=> htmlspecialchars($this->input->post('isi_laporan', true)),
				'status'			=> '0',
			];

			$resp = $this->Pengaduan_m->create($params);

			if ($resp) :
				$this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">
						Laporan berhasil dibuat
						</div>');

				redirect('Admin/PengaduanController');
			else :
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
						Laporan gagal dibuat!
						</div>');

				redirect('Admin/PengaduanController');
			endif;

		endif;
	}

	public function pengaduan_detail($id)
	{

		$cek_data = $this->db->get_where('pengaduan', ['id_pengaduan' => htmlspecialchars($id)])->row_array();

		if (!empty($cek_data)) :

			$data['title'] = 'Detail Pengaduan';

			$data['data_pengaduan'] = $this->Pengaduan_m->data_pengaduan_tanggapan(htmlspecialchars($id))->row_array();
			if ($data['data_pengaduan']) :
				$this->load->view('_part/backend_head', $data);
				$this->load->view('_part/backend_sidebar_v');
				$this->load->view('_part/backend_topbar_v');
				$this->load->view('admin/pengaduan_detail');
				$this->load->view('_part/backend_footer_v');
				$this->load->view('_part/backend_foot');
			else :
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
					Pengaduan sedang di proses!
					</div>');

				redirect('Admin/PengaduanController');
			endif;

		else :
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
				data tidak ada
				</div>');

			redirect('Admin/PengaduanController');
		endif;
	}

	public function pengaduan_batal($id)
	{
		$cek_data = $this->db->get_where('pengaduan', ['id_pengaduan' => htmlspecialchars($id)])->row_array();

		if (!empty($cek_data)) :

			if ($cek_data['status'] == '0') :

				$resp = $this->db->delete('pengaduan', ['id_pengaduan' => $id]);

				if ($resp) :
					$this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">
						Hapus pengaduan berhasil
						</div>');

					redirect('Admin/PengaduanController');
				else :
					$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
						Hapus pengaduan gagal!
						</div>');

					redirect('Admin/PengaduanController');
				endif;

			else :
				$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
					Pengaduan sedang di proses!
					</div>');

				redirect('Admin/PengaduanController');
			endif;

		else :
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
				data tidak ada
				</div>');

			redirect('Admin/PengaduanController');
		endif;
	}

	public function edit($id)
	{
		$cek_data = $this->db->get_where('pengaduan', ['id_pengaduan' => htmlspecialchars($id)])->row_array();

		if (!empty($cek_data)) :

			if ($cek_data['status'] == '0') :

				$data['title'] = 'Edit Pengaduan';
				$data['pengaduan'] = $cek_data;

				$this->form_validation->set_rules('isi_laporan', 'Isi Laporan Pengaduan', 'trim|required');


				if ($this->form_validation->run() == FALSE) :
					$this->load->view('_part/backend_head', $data);
					$this->load->view('_part/backend_sidebar_v');
					$this->load->view('_part/backend_topbar_v');
					$this->load->view('admin/edit_pengaduan');
					$this->load->view('_part/backend_footer_v');
					$this->load->view('_part/backend_foot');
				else :

					$params = [
						'isi_laporan'		=> htmlspecialchars($this->input->post('isi_laporan', true)),

					];

					$resp = $this->db->update('pengaduan', $params, ['id_pengaduan' => $id]);;

					if ($resp) :
						$this->session->set_flashdata('msg', '<div class="alert alert-primary" role="alert">
								Laporan berhasil dibuat
								</div>');

						redirect('Admin/PengaduanController');
					else :
						$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
								Laporan gagal dibuat!
								</div>');

						redirect('Admin/PengaduanController');
					endif;

				endif;

			endif;

		else :
			$this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">
					Pengaduan sedang di proses!
					</div>');

			redirect('Admin/PengaduanController');
		endif;
	}
}

/* End of file PengaduanController.php */
/* Location: ./application/controllers/Admin/PengaduanController.php */
