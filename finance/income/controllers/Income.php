<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Income extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('IncomeModel');
		$this->user_finance = $this->session->userdata("sias-finance");
		$this->db2 = $this->load->database('secondary_db', TRUE);

		if ($this->session->userdata('sias-finance') == FALSE) {
			redirect('finance/auth');
		}

		if ($this->user_finance[0]->role_akun != 5) {
			redirect('finance/dashboard');
		}
		$this->load->library('form_validation');
	}

	//
	//-------------------------------DASHBOARD------------------------------//
	//

	public function list_income_du()
	{
		$data['nav_in'] = 'menu-item-here';

		$data['payment'] = $this->IncomeModel->get_du_total_all();
		$data['schoolyear'] = $this->IncomeModel->get_schoolyear_sias();

		$this->template->load('template_finance/template_finance', 'finance_list_income_du', $data);
	}

	public function list_income_dpb()
	{
		$data['nav_in'] = 'menu-item-here';

		$data['payment'] = $this->IncomeModel->get_dpb_total_all();
		$data['schoolyear'] = $this->IncomeModel->get_schoolyear_sias();

		$this->template->load('template_finance/template_finance', 'finance_list_income_dpb', $data);
	}

	public function edit_income_dpb($id = '')
	{
		$id = paramDecrypt($id);
		$data['nav_in'] = 'menu-item-here';
		$data['income_dpb'] = $this->IncomeModel->get_income_dpb_by_id($id);

		$this->template->load('template_finance/template_finance', 'finance_edit_income_dpb', $data);
	}

	public function edit_income_du($id = '')
	{
		$id = paramDecrypt($id);
		$data['nav_in'] = 'menu-item-here';
		$data['income_du'] = $this->IncomeModel->get_income_du_by_id($id);

		$this->template->load('template_finance/template_finance', 'finance_edit_income_du', $data);
	}

	public function check_invoice_number_dpb()
	{
		$id = $this->input->post('id_tagihan');
		$id = paramDecrypt($id);
		$invoice = $this->input->post('nomor_invoice');

		$check = $this->IncomeModel->check_invoice_dpb_duplicate($invoice);
		$check_old = $this->IncomeModel->get_income_dpb_by_id($id);

		if ($check == TRUE && $id == NULL) {
			$isAvailable = false;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == TRUE && $check_old[0]->id_invoice != $invoice) {
			$isAvailable = false;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == TRUE && $check_old[0]->id_invoice == $invoice) {
			$isAvailable = true;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == FALSE) {
			$isAvailable = true;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		}
	}

	public function check_invoice_number_du()
	{
		$id = $this->input->post('id_tagihan');
		$id = paramDecrypt($id);
		$invoice = $this->input->post('nomor_invoice');

		$check = $this->IncomeModel->check_invoice_du_duplicate($invoice);
		$check_old = $this->IncomeModel->get_income_du_by_id($id);

		if ($check == TRUE && $id == NULL) {
			$isAvailable = false;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == TRUE && $check_old[0]->id_invoice != $invoice) {
			$isAvailable = false;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == TRUE && $check_old[0]->id_invoice == $invoice) {
			$isAvailable = true;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == FALSE) {
			$isAvailable = true;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		}
	}

	public function check_payment_number_dpb()
	{
		$id = $this->input->post('id_tagihan');
		$id = paramDecrypt($id);
		$pay = $this->input->post('nomor_pembayaran');

		$check = $this->IncomeModel->check_payment_dpb_duplicate($pay);
		$check_old = $this->IncomeModel->get_income_dpb_by_id($id);

		if ($check == TRUE && $id == NULL) {
			$isAvailable = false;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == TRUE && $check_old[0]->nomor_siswa != $pay) {
			$isAvailable = false;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == TRUE && $check_old[0]->nomor_siswa == $pay) {
			$isAvailable = true;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == FALSE) {
			$isAvailable = true;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		}
	}

	public function check_payment_number_du()
	{
		$id = $this->input->post('id_tagihan');
		$id = paramDecrypt($id);
		$pay = $this->input->post('nomor_pembayaran');

		$check = $this->IncomeModel->check_payment_du_duplicate($pay);
		$check_old = $this->IncomeModel->get_income_du_by_id($id);

		if ($check == TRUE && $id == NULL) {
			$isAvailable = false;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == TRUE && $check_old[0]->nomor_siswa != $pay) {
			$isAvailable = false;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == TRUE && $check_old[0]->nomor_siswa == $pay) {
			$isAvailable = true;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		} else if ($check == FALSE) {
			$isAvailable = true;
			echo json_encode(array(
				'valid' => $isAvailable,
			));
		}
	}

	public function search_list_payment_dpb_student($id = '')
	{
		$id = paramDecrypt($id);
		$data['nav_in'] = 'menu-item-here';
		$data['income'] = $this->IncomeModel->get_income_dpb_by_nomor_pembayaran($id);
		$data['payment'] = $this->IncomeModel->get_dpb_total_by_nomor_pembayaran($id);

		if ($data) {
			$this->template->load('template_finance/template_finance', 'finance_list_income_dpb_student', $data);
		} else {
			$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf!, Siswa dengan Nomor Pembayaran DPB: ' . $data["nomor_pembayaran_dpb"] . ' tidak ditemukan.'));
			redirect('finance/income/income/list_income_dpb');
		}
	}

	public function search_list_payment_du_student($id = '')
	{
		$id = paramDecrypt($id);
		$data['nav_in'] = 'menu-item-here';
		$data['income'] = $this->IncomeModel->get_income_du_by_nomor_pembayaran($id);
		$data['payment'] = $this->IncomeModel->get_du_total_by_nomor_pembayaran($id);

		if ($data) {
			$this->template->load('template_finance/template_finance', 'finance_list_income_du_student', $data);
		} else {
			$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf!, Siswa dengan Nomor Pembayaran DU: ' . $data["nomor_pembayaran_du"] . ' tidak ditemukan.'));
			redirect('finance/income/income/list_income_du');
		}
	}

	public function search_student_payment_dpb()
	{
		$param = $this->input->post();
		$data = $this->security->xss_clean($param);

		$data['nav_in'] = 'menu-item-here';
		$data['income'] = $this->IncomeModel->get_income_dpb_by_nomor_pembayaran($data['nomor_pembayaran_dpb']);

		if ($data['income']) {
			redirect('finance/income/income/search_list_payment_dpb_student/' . paramEncrypt($data['nomor_pembayaran_dpb']));
		} else {
			$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf!, Siswa dengan Nomor Pembayaran DPB: ' . $data["nomor_pembayaran_dpb"] . ' tidak ditemukan. Silahkan Cek ulang'));
			redirect('finance/income/income/list_income_dpb');
		}
	}

	public function search_student_payment_du()
	{
		$param = $this->input->post();
		$data = $this->security->xss_clean($param);

		$data['nav_in'] = 'menu-item-here';
		$data['income'] = $this->IncomeModel->get_income_du_by_nomor_pembayaran($data['nomor_pembayaran_du']);

		if ($data['income']) {
			redirect('finance/income/income/search_list_payment_du_student/' . paramEncrypt($data['nomor_pembayaran_du']));
		} else {
			$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf!, Siswa dengan Nomor Pembayaran DU: ' . $data["nomor_pembayaran_du"] . ' tidak ditemukan. Silahkan Cek ulang'));
			redirect('finance/income/income/list_income_du');
		}
	}

	///------------------------------------KHUSUS IMPORT-------------------------------------------//

	public function list_transition_income_dpb($id = '')
	{
		$id = paramDecrypt($id);
		$data['nav_in'] = 'menu-item-here';
		$data['income_insert'] = $this->IncomeModel->get_all_transition_income_dpb_insert();
		$data['income_update'] = $this->IncomeModel->get_all_transition_income_dpb_update();
		$data['income_delete'] = $this->IncomeModel->get_all_transition_income_dpb_delete();

		$data['income_update_dup'] = $this->IncomeModel->get_all_income_dpb_update_duplicate();
		$data['income_delete_dup'] = $this->IncomeModel->get_all_income_dpb_delete_duplicate();

		if ($id == 'sekolah_utsman') {
			$this->template->load('template_finance/template_finance', 'finance_list_transition_income_dpb', $data);
		} else {
			$this->load->view('error_404', $data);
		}
	}

	public function list_transition_income_du($id = '')
	{
		$id = paramDecrypt($id);
		$data['nav_in'] = 'menu-item-here';
		$data['income_insert'] = $this->IncomeModel->get_all_transition_income_du_insert();
		$data['income_update'] = $this->IncomeModel->get_all_transition_income_du_update();
		$data['income_delete'] = $this->IncomeModel->get_all_transition_income_du_delete();

		if ($id == 'sekolah_utsman') {
			$this->template->load('template_finance/template_finance', 'finance_list_transition_income_du', $data);
		} else {
			$this->load->view('error_404', $data);
		}
	}

	public function detail_income_du($id = '')
	{
		$id = paramDecrypt($id);

		$data['nav_in'] = 'menu-item-here';
		$data['income'] = $this->IncomeModel->get_income_du_by_id($id); //? 

		if ($data['income'] == FALSE or empty($id)) {
			$this->load->view('error_404', $data);
		} else {
			$this->template->load('template_finance/template_finance', 'finance_detail_income_du', $data);
		}
	}

	public function detail_income_dpb($id = '')
	{
		$id = paramDecrypt($id);

		$data['nav_in'] = 'menu-item-here';
		$data['income'] = $this->IncomeModel->get_income_dpb_by_id($id); //? 

		if ($data['income'] == FALSE or empty($id)) {
			$this->load->view('error_404', $data);
		} else {
			$this->template->load('template_finance/template_finance', 'finance_detail_income_dpb', $data);
		}
	}

	public function update_income_dpb($id = '')
	{
		$param = $this->input->post();
		$data = $this->security->xss_clean($param);

		$id = paramDecrypt($id);

		$this->form_validation->set_rules('nomor_invoice', 'Nomor Invoice Tagihan', 'required');
		$this->form_validation->set_rules('nomor_pembayaran', 'Nomor Pembayaran Tagihan', 'required');
		$this->form_validation->set_rules('nominal_tagihan', 'Total Nominal Tagihan', 'required');
		$this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required');
		$this->form_validation->set_rules('tanggal_invoice', 'Tanggal Invoice', 'required');

		$invoice = $this->IncomeModel->check_invoice_dpb_duplicate($data['nomor_invoice']);
		$payment = $this->IncomeModel->check_payment_dpb_duplicate($data['nomor_pembayaran']);

		$check_old = $this->IncomeModel->get_income_dpb_by_id($id);

		if ($invoice == TRUE && strtoupper(strtolower($data['nomor_invoice'])) != strtoupper(strtolower($check_old[0]->id_invoice))) {
			$this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor/Kode Invoice yang anda inputkan telah terpakai."));
			redirect('finance/income/income/edit_income_dpb/' . paramEncrypt($id));
		} else {
			if ($payment == TRUE && strtoupper(strtolower($data['nomor_pembayaran'])) != strtoupper(strtolower($check_old[0]->nomor_siswa))) {
				$this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor Pembayaran yang anda inputkan telah terpakai."));
				redirect('finance/income/income/edit_income_dpb/' . paramEncrypt($id));
			} else {
				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
					redirect('finance/income/income/edit_income_dpb/' . paramEncrypt($id));
				} else {
					$input = $this->IncomeModel->update_income_dpb($id, $data);
					if ($input == true) {
						$this->session->set_flashdata('flash_message', succ_msg("Berhasil Diupdate, Data Tagihan Atas Nama " . strtoupper($data['nama_siswa']) . " Anda telah diupdate. Terima Kasih"));
						redirect('finance/income/income/edit_income_dpb/' . paramEncrypt($id));
					} else {
						$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang.'));
						redirect('finance/income/income/edit_income_dpb/' . paramEncrypt($id));
					}
				}
			}
		}
	}

	public function update_income_du($id = '')
	{
		$param = $this->input->post();
		$data = $this->security->xss_clean($param);

		$id = paramDecrypt($id);

		$this->form_validation->set_rules('nomor_invoice', 'Nomor Invoice Tagihan', 'required');
		$this->form_validation->set_rules('nomor_pembayaran', 'Nomor Pembayaran Tagihan', 'required');
		$this->form_validation->set_rules('nominal_tagihan', 'Total Nominal Tagihan', 'required');
		$this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required');
		$this->form_validation->set_rules('tanggal_invoice', 'Tanggal Invoice', 'required');

		$invoice = $this->IncomeModel->check_invoice_du_duplicate($data['nomor_invoice']);
		$payment = $this->IncomeModel->check_payment_du_duplicate($data['nomor_pembayaran']);

		$check_old = $this->IncomeModel->get_income_du_by_id($id);

		if ($invoice == TRUE && strtoupper(strtolower($data['nomor_invoice'])) != strtoupper(strtolower($check_old[0]->id_invoice))) {
			$this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor/Kode Invoice yang anda inputkan telah terpakai."));
			redirect('finance/income/income/edit_income_du/' . paramEncrypt($id));
		} else {
			if ($payment == TRUE && strtoupper(strtolower($data['nomor_pembayaran'])) != strtoupper(strtolower($check_old[0]->nomor_siswa))) {
				$this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor Pembayaran yang anda inputkan telah terpakai."));
				redirect('finance/income/income/edit_income_du/' . paramEncrypt($id));
			} else {
				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
					redirect('finance/income/income/edit_income_du/' . paramEncrypt($id));
				} else {
					$input = $this->IncomeModel->update_income_du($id, $data);
					if ($input == true) {
						$this->session->set_flashdata('flash_message', succ_msg("Berhasil Diupdate, Data Tagihan Atas Nama " . strtoupper($data['nama_siswa']) . " Anda telah diupdate. Terima Kasih"));
						redirect('finance/income/income/edit_income_du/' . paramEncrypt($id));
					} else {
						$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang.'));
						redirect('finance/income/income/edit_income_du/' . paramEncrypt($id));
					}
				}
			}
		}
	}

	public function confirm_update_income()
	{
		$param = $this->input->post();
		$data = $this->security->xss_clean($param);

		$check_pass = $this->IncomeModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
		// pass verify
		if (password_verify(($data['password']), $check_pass[0]->password)) {
			echo '1';
		} else {
			echo '0';
		}
	}

	public function accept_import_payment_du()
	{
		$param = $this->input->post();
		$data = $this->security->xss_clean($param);

		$check_pass = $this->IncomeModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
		// pass verify
		if (password_verify(($data['password']), $check_pass[0]->password)) {

			$input = $this->IncomeModel->accept_import_data_payment_du();
			if ($input == true) {
				$this->IncomeModel->clear_import_data_payment();
				echo '1';
				$this->session->set_flashdata('flash_message', succ_msg("Berhasil!, Seluruh Data Tagihan DU sebelumnya telah diimport ke database. dimohon untuk melakukan <b>Pengecekan Ulang</b>. Terima Kasih."));
			} else {
				echo '0';
			}
		} else {
			echo '0';
		}
	}

	public function accept_import_payment_dpb()
	{
		$param = $this->input->post();
		$data = $this->security->xss_clean($param);

		$check_pass = $this->IncomeModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
		// pass verify
		if (password_verify(($data['password']), $check_pass[0]->password)) {

			$input = $this->IncomeModel->accept_import_data_payment_dpb();
			if ($input == true) {
				$this->IncomeModel->clear_import_data_payment();
				echo '1';
				$this->session->set_flashdata('flash_message', succ_msg("Berhasil!, Seluruh Data Tagihan DPB sebelumnya telah diimport ke database. dimohon untuk melakukan <b>Pengecekan Ulang</b>. Terima Kasih."));
			} else {
				echo '0';
			}
		} else {
			echo '0';
		}
	}

	public function reject_import_payment_du()
	{

		$input = $this->IncomeModel->clear_import_data_payment();

		if ($input == true) {
			echo '1';
			$this->session->set_flashdata('flash_message', warn_msg("Peringatan!, Seluruh Data Tagihan DU sebelumnya batal diimport ke database."));
		} else {
			echo '0';
		}
	}

	public function reject_import_payment_dpb()
	{

		$input = $this->IncomeModel->clear_import_data_payment();

		if ($input == true) {
			echo '1';
			$this->session->set_flashdata('flash_message', warn_msg("Peringatan!, Seluruh Data Tagihan DPB sebelumnya batal diimport ke database."));
		} else {
			echo '0';
		}
	}

	public function import_dpb_payment()
	{
		$param = $this->input->post();
		$data = $this->security->xss_clean($param);

		$this->form_validation->set_rules('pass_verification', 'Password Anda', 'required');
		$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
		$userIp = $this->input->ip_address();

		if ($this->form_validation->run() == false) {

			$this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
			redirect('finance/income/income/list_income_dpb');
		} else {
			$check_pass = $this->IncomeModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
			// pass verify
			if (password_verify(($data['pass_verification']), $check_pass[0]->password)) {
				// gcaptha verify
				if ($this->googleCaptachStore($recaptchaResponse, $userIp) == 1) {
					$this->IncomeModel->clear_import_data_payment();
					// If file uploaded
					$file_mimes = array(
						'text/x-comma-separated-values',
						'text/comma-separated-values',
						'application/octet-stream',
						'application/vnd.ms-excel',
						'application/x-csv',
						'text/x-csv',
						'text/csv',
						'application/csv',
						'application/excel',
						'application/vnd.msexcel',
						'text/plain',
						'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
					);

					if (isset($_FILES['file_tagihan_dpb']['name']) && in_array($_FILES['file_tagihan_dpb']['type'], $file_mimes)) {
						$arr_file = explode('.', $_FILES['file_tagihan_dpb']['name']);
						$extension = end($arr_file);

						if ($extension == 'csv') {
							$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
						} elseif ($extension == 'xlsx') {
							$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
						} else {
							$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
						}

						$reader->setReadDataOnly(true);
						$reader->setReadEmptyCells(false);
						$spreadsheet = $reader->load($_FILES['file_tagihan_dpb']['tmp_name']);
						$sheetData = $spreadsheet->getActiveSheet()->toArray();

						$index_header = [];
						for ($z = 0; $z < count($sheetData[0]); $z++) {
							if (strpos($sheetData[0][$z], 'rincian') !== false) {
								$index_header[] = array('index_kolom' => $z, 'nama_kolom' => implode(' ', explode('_', explode('_', $sheetData[0][$z], 2)[1])));
							}
						}

						$data_mhs_array = array();
						for ($i = 1; $i < count($sheetData); $i++) {

							$rincian = "";
							$last_index = "";
							$student = $this->IncomeModel->get_student_by_nomor_pembayaran_dpb($sheetData[$i]['1']);
							$tahun_ajaran = $this->IncomeModel->get_schoolyear_now();

							if (!$student) {
								$this->session->set_flashdata('flash_message', err_msg("Mohon Maaf, Data dengan Nomor Pembayaran Siswa (" . $sheetData[$i]['1'] . ") Atas Nama '" . strtoupper($sheetData[$i]['3']) . "' Tidak ditemukan didalam database, Silahkan mengecek & upload ulang."));
								redirect('finance/income/list_income_dpb');
							} else {
								for ($j = 0; $j < count($index_header); $j++) {
									$rincian .= $index_header[$j]['nama_kolom'] . ": " . $sheetData[$i][$index_header[$j]['index_kolom']] . ", ";
									$last_index = $index_header[$j]['index_kolom'];
								}

								if ($sheetData[$i]['0']) {
									$data_mhs_array[$i] = array(
										'id_invoice' => (filter_var(trim($sheetData[$i]['0']), FILTER_SANITIZE_STRING)),
										'id_siswa' => (filter_var(trim($student[0]->id_siswa), FILTER_SANITIZE_STRING)),
										'id_kelas' => (filter_var(trim($student[0]->id_kelas), FILTER_SANITIZE_STRING)),
										'id_tingkat' => (filter_var(trim($student[0]->id_tingkat), FILTER_SANITIZE_STRING)),
										'level_tingkat' => (filter_var(trim($student[0]->level_tingkat), FILTER_SANITIZE_STRING)),
										'tipe_tagihan' => (filter_var(trim(1), FILTER_SANITIZE_STRING)),
										'tanggal_invoice' => (filter_var(trim(date('Y-m-d', strtotime($sheetData[$i]['4']))), FILTER_SANITIZE_STRING)),
										'nomor_siswa' => (filter_var(trim($sheetData[$i]['1']), FILTER_SANITIZE_STRING)),
										'nama' => (filter_var(trim($sheetData[$i]['3']), FILTER_SANITIZE_STRING)),
										'nominal_tagihan' => (filter_var(trim($sheetData[$i][(intval($last_index) + 1)]), FILTER_SANITIZE_STRING)),
										'informasi' => (filter_var(trim($sheetData[$i]['6']), FILTER_SANITIZE_STRING)),
										'rincian' => (filter_var(trim($rincian), FILTER_SANITIZE_STRING)),
										'catatan' => (filter_var(trim($sheetData[$i][(intval($last_index) + 4)]), FILTER_SANITIZE_STRING)),
										'th_ajaran' => (filter_var(trim($tahun_ajaran[0]->id_tahun_ajaran), FILTER_SANITIZE_STRING)),
										'status_pembayaran' => (filter_var(trim('MENUNGGU'), FILTER_SANITIZE_STRING)),
									);
								}
							}
						}

						$import_data = $this->db2->insert_batch('transisi_tagihan_pembayaran', $data_mhs_array);

						if ($import_data == true) {
							$this->session->set_flashdata('flash_message', warn_msg("Peringatan!, File <b>" . $_FILES['file_tagihan_dpb']['name'] . "</b> Telah terbaca, Silahkan melakukan <b>PENGECEKAN & PERSETUJUAN</b> untuk mengimpor seluruh data file tersebut. Jika terjadi ketidaksamaan dengan Data Asli, dimohon untuk <b>UPLOAD ULANG</b>. Terima Kasih"));
							redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
						} else {
							$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan import ulang...'));
							redirect('finance/income/income/list_income_dpb');
						}
					} else {
						$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Silahkan Import file berformat csv/xls/xlsx'));
						redirect('finance/income/income/list_income_dpb');
					}
				} else {

					$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Google Recaptcha terdapat kesalahan.'));
					redirect('finance/income/income/list_income_dpb');
				}
			} else {
				$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf., Password Anda salah!'));
				redirect('finance/income/income/list_income_dpb');
			}
		}
	}

	public function import_du_payment()
	{
		$param = $this->input->post();
		$data = $this->security->xss_clean($param);

		$this->form_validation->set_rules('pass_verification', 'Password Anda', 'required');
		$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
		$userIp = $this->input->ip_address();

		if ($this->form_validation->run() == false) {

			$this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
			redirect('finance/income/income/list_income_du');
		} else {
			$check_pass = $this->IncomeModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
			// pass verify
			if (password_verify(($data['pass_verification']), $check_pass[0]->password)) {
				// gcaptha verify
				if ($this->googleCaptachStore($recaptchaResponse, $userIp) == 1) {
					$this->IncomeModel->clear_import_data_payment();
					// If file uploaded
					$file_mimes = array(
						'text/x-comma-separated-values',
						'text/comma-separated-values',
						'application/octet-stream',
						'application/vnd.ms-excel',
						'application/x-csv',
						'text/x-csv',
						'text/csv',
						'application/csv',
						'application/excel',
						'application/vnd.msexcel',
						'text/plain',
						'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
					);

					if (isset($_FILES['file_tagihan_du']['name']) && in_array($_FILES['file_tagihan_du']['type'], $file_mimes)) {
						$arr_file = explode('.', $_FILES['file_tagihan_du']['name']);
						$extension = end($arr_file);

						if ($extension == 'csv') {
							$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
						} elseif ($extension == 'xlsx') {
							$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
						} else {
							$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
						}

						$reader->setReadDataOnly(true);
						$reader->setReadEmptyCells(false);
						$spreadsheet = $reader->load($_FILES['file_tagihan_du']['tmp_name']);
						$sheetData = $spreadsheet->getActiveSheet()->toArray();

						//var_dump($sheetData);exit;

						$index_header = [];
						for ($z = 0; $z < count($sheetData[0]); $z++) {
							if (strpos($sheetData[0][$z], 'rincian') !== false) {
								$index_header[] = array('index_kolom' => $z, 'nama_kolom' => implode(' ', explode('_', explode('_', $sheetData[0][$z], 2)[1])));
							}
						}

						$data_mhs_array = array();

						for ($i = 1; $i < count($sheetData); $i++) {

							$rincian = "";
							$last_index = "";
							$student = $this->IncomeModel->get_student_by_nomor_pembayaran_du($sheetData[$i]['1']);
							$tahun_ajaran = $this->IncomeModel->get_schoolyear_now();

							if (!$student) {
								$this->session->set_flashdata('flash_message', err_msg("Mohon Maaf,Data dengan Nomor Pembayaran Siswa (" . $sheetData[$i]['1'] . ") Atas Nama '" . strtoupper($sheetData[$i]['3']) . "' Tidak ditemukan didalam database, Silahkan mengecek & upload ulang."));
								redirect('finance/income/list_income_du');
							} else {

								for ($j = 0; $j < count($index_header); $j++) {
									$rincian .= $index_header[$j]['nama_kolom'] . ": " . $sheetData[$i][$index_header[$j]['index_kolom']] . ", ";
									$last_index = $index_header[$j]['index_kolom'];
								}

								if ($sheetData[$i]['0']) {
									$data_mhs_array[$i] = array(
										'id_invoice' => (filter_var(trim($sheetData[$i]['0']), FILTER_SANITIZE_STRING)),
										'id_siswa' => (filter_var(trim($student[0]->id_siswa), FILTER_SANITIZE_STRING)),
										'id_kelas' => (filter_var(trim($student[0]->id_kelas), FILTER_SANITIZE_STRING)),
										'id_tingkat' => (filter_var(trim($student[0]->id_tingkat), FILTER_SANITIZE_STRING)),
										'level_tingkat' => (filter_var(trim($student[0]->level_tingkat), FILTER_SANITIZE_STRING)),
										'tipe_tagihan' => (filter_var(trim(2), FILTER_SANITIZE_STRING)),
										'tanggal_invoice' => (filter_var(trim(date('Y-m-d', strtotime($sheetData[$i]['4']))), FILTER_SANITIZE_STRING)),
										'nomor_siswa' => (filter_var(trim($sheetData[$i]['1']), FILTER_SANITIZE_STRING)),
										'nama' => (filter_var(trim($sheetData[$i]['3']), FILTER_SANITIZE_STRING)),
										'nominal_tagihan' => (filter_var(trim($sheetData[$i][(intval($last_index) + 1)]), FILTER_SANITIZE_STRING)),
										'informasi' => (filter_var(trim($sheetData[$i]['6']), FILTER_SANITIZE_STRING)),
										'rincian' => (filter_var(trim($rincian), FILTER_SANITIZE_STRING)),
										'catatan' => (filter_var(trim($sheetData[$i][(intval($last_index) + 4)]), FILTER_SANITIZE_STRING)),
										'th_ajaran' => (filter_var(trim($tahun_ajaran[0]->id_tahun_ajaran), FILTER_SANITIZE_STRING)),
										'status_pembayaran' => (filter_var(trim('MENUNGGU'), FILTER_SANITIZE_STRING)),
									);
								}
							}
						}

						$import_data = $this->db2->insert_batch('transisi_tagihan_pembayaran', $data_mhs_array);

						if ($import_data == true) {
							$this->session->set_flashdata('flash_message', warn_msg("Peringatan!, File <b>" . $_FILES['file_tagihan_du']['name'] . "</b> Telah terbaca, Silahkan melakukan <b>PENGECEKAN & PERSETUJUAN</b> untuk mengimpor seluruh data file tersebut. Jika terjadi ketidaksamaan dengan Data Asli, dimohon untuk <b>UPLOAD ULANG</b>. Terima Kasih"));
							redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
						} else {
							$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan import ulang...'));
							redirect('finance/income/income/list_income_du');
						}
					} else {
						$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Silahkan Import file berformat csv/xls/xlsx'));
						redirect('finance/income/income/list_income_du');
					}
				} else {

					$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Google Recaptcha terdapat kesalahan.'));
					redirect('finance/income/income/list_income_du');
				}
			} else {
				$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf., Password Anda salah!'));
				redirect('finance/income/income/list_income_du');
			}
		}
	}

	public function delete_income_dpb()
	{
		$id = $this->input->post('id');
		$id = paramDecrypt($id);

		$income_dpb = $this->IncomeModel->get_income_dpb_by_id($id);
		$delete = $this->IncomeModel->delete_income_dpb_by_id($id);
		if ($delete == true) {
			$this->session->set_flashdata('flash_message', succ_msg("Berhasil, Tagihan DPB Atas Nama " . $income_dpb[0]->nama_lengkap . " (" . $income_dpb[0]->nis . ") Telah Terhapus.."));
		} else {
			$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan...'));
		}
	}

	public function delete_income_du()
	{
		$id = $this->input->post('id');
		$id = paramDecrypt($id);

		$income_du = $this->IncomeModel->get_income_du_by_id($id);
		$delete = $this->IncomeModel->delete_income_du_by_id($id);
		if ($delete == true) {
			$this->session->set_flashdata('flash_message', succ_msg("Berhasil, Tagihan DU Atas Nama " . $income_du[0]->nama_lengkap . " (" . $income_du[0]->nis . ") Telah Terhapus.."));
		} else {
			$this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan...'));
		}
	}

	public function googleCaptachStore($gpost = '', $ip_address = '')
	{

		$recaptchaResponse = $gpost;

		$userIp = $ip_address;
		$secret = $this->config->item('google_secret_key');
		$url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);

		$status = json_decode($output, true);

		if ($status['success']) {
			return 1;
		} else {
			return 0;
		}
	}

	public function send_notification($title = '', $proposal = '', $pemohon = '', $postlink = '')
	{

		$data = array(
			"app_id" => "affc3d22-cafb-4334-9814-91c150a08ea2",
			"included_segments" => array('Subscribed Users'),
			"headings" => array(
				"en" => "$title"
			),
			"contents" => array(
				"en" => "PEMASUKAN: $proposal - ($pemohon)"
			),
			"url" => "$postlink"
		);

		// Print Output in JSON Format
		$data_string = json_encode($data);
		// API URL
		$url = "https://onesignal.com/api/v1/notifications";
		//Curl Headers
		$headers = array(
			'Authorization: Basic NmIwYjFjOGMtMjkxMC00ZTM2LWE1NDctYWQxZjZmN2U4OWJj',
			'Content-Type: application/json; charset = utf-8'
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		// Variable for Print the Result
		$response = curl_exec($ch);

		curl_close($ch);

		if ($response) {
			echo '1';
			var_dump($response);
		} else {
			echo '0';
			var_dump($response);
		}
	}

	public function add_ajax_grade($id_grad_lvl = '', $id_grad = '')
	{

		$query = $this->db2->get_where('tingkat', array('level_tingkat' => $id_grad_lvl));
		$data = "<option value=''>Pilih Kelas</option>";
		foreach ($query->result() as $value) {
			if ($id_grad != '' || $id_grad != NULL) {
				if ($id_grad == $value->id_tingkat) {
					$data .= "<option selected value='" . $value->nama_tingkat . "'>" . strtoupper($value->nama_tingkat) . "</option>";
				} else {
					$data .= "<option value='" . $value->nama_tingkat . "'>" . strtoupper($value->nama_tingkat) . "</option>";
				}
			} else {
				$data .= "<option value='" . $value->nama_tingkat . "'>" . strtoupper($value->nama_tingkat) . "</option>";
			}
		}
		$data .= "<option value=''>Semua</option>";
		echo $data;
	}


	public function get_data_income_du()
	{

		// get all raw data
		$data = $this->IncomeModel->get_all_income_du();

		for ($i = 0; $i < count($data); $i++) {
			$data[$i]['id_encrypt'] = paramEncrypt($data[$i]['id_tagihan_pembayaran_du']);
		}

		// count data
		$totalRecords = $totalDisplay = count($data);

		// filter by general search keyword
		if (isset($_REQUEST['search'])) {
			$data         = $this->filterKeyword($data, $_REQUEST['search']);
			$totalDisplay = count($data);
		}

		if (isset($_REQUEST['columns']) && is_array($_REQUEST['columns'])) {
			foreach ($_REQUEST['columns'] as $column) {
				if (isset($column['search'])) {
					$data         = $this->filterKeyword($data, $column['search'], $column['data']);
					$totalDisplay = count($data);
				}
			}
		}

		// sort
		if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
			$column = $_REQUEST['order'][0]['column'];
			$dir    = $_REQUEST['order'][0]['dir'];
			usort($data, function ($a, $b) use ($column, $dir) {
				$a = array_slice($a, $column, 1);
				$b = array_slice($b, $column, 1);
				$a = array_pop($a);
				$b = array_pop($b);

				if ($dir === 'asc') {
					return $a > $b ? true : false;
				}

				return $a < $b ? true : false;
			});
		}

		// pagination length
		if (isset($_REQUEST['length'])) {
			$data = array_splice($data, $_REQUEST['start'], $_REQUEST['length']);
		}

		// return array values only without the keys
		if (isset($_REQUEST['array_values']) && $_REQUEST['array_values']) {
			$tmp  = $data;
			$data = [];
			foreach ($tmp as $d) {
				$data[] = array_values($d);
			}
		}

		$result = [
			'recordsTotal'    => $totalRecords,
			'recordsFiltered' => $totalDisplay,
			'data'            => $data,
		];

		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

		echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	public function get_data_income_dpb()
	{
		// get all raw data
		$data = $this->IncomeModel->get_all_income_dpb();

		for ($i = 0; $i < count($data); $i++) {
			$data[$i]['id_encrypt'] = paramEncrypt($data[$i]['id_tagihan_pembayaran_dpb']);
		}

		// count data
		$totalRecords = $totalDisplay = count($data);

		// filter by general search keyword
		if (isset($_REQUEST['search'])) {
			$data         = $this->filterKeyword($data, $_REQUEST['search']);
			$totalDisplay = count($data);
		}

		if (isset($_REQUEST['columns']) && is_array($_REQUEST['columns'])) {
			foreach ($_REQUEST['columns'] as $column) {
				if (isset($column['search'])) {
					$data         = $this->filterKeyword($data, $column['search'], $column['data']);
					$totalDisplay = count($data);
				}
			}
		}

		// sort
		if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
			$column = $_REQUEST['order'][0]['column'];
			$dir    = $_REQUEST['order'][0]['dir'];
			usort($data, function ($a, $b) use ($column, $dir) {
				$a = array_slice($a, $column, 1);
				$b = array_slice($b, $column, 1);
				$a = array_pop($a);
				$b = array_pop($b);

				if ($dir === 'asc') {
					return $a > $b ? true : false;
				}

				return $a < $b ? true : false;
			});
		}

		// pagination length
		if (isset($_REQUEST['length'])) {
			$data = array_splice($data, $_REQUEST['start'], $_REQUEST['length']);
		}

		// return array values only without the keys
		if (isset($_REQUEST['array_values']) && $_REQUEST['array_values']) {
			$tmp  = $data;
			$data = [];
			foreach ($tmp as $d) {
				$data[] = array_values($d);
			}
		}

		$result = [
			'recordsTotal'    => $totalRecords,
			'recordsFiltered' => $totalDisplay,
			'data'            => $data,
		];

		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

		echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	//--------------------------------------------------------------------------------------//
	//-----------------------------------REMOTE---------------------------------------------//
	//

	public function list_filter($list, $args = array(), $operator = 'AND')
	{
		if (!is_array($list)) {
			return array();
		}

		$util = $this->load->library("list_util", $list);

		return $util->filter($args, $operator);
	}


	public function filterArray($array, $allowed = [])
	{
		return array_filter(
			$array,
			function ($val, $key) use ($allowed) { // N.b. $val, $key not $key, $val
				return isset($allowed[$key]) && ($allowed[$key] === true || $allowed[$key] === $val);
			},
			ARRAY_FILTER_USE_BOTH
		);
	}

	public function filterKeyword($data, $search, $field = '')
	{
		$filter = '';
		if (isset($search['value'])) {
			$filter = $search['value'];
		}
		if (!empty($filter)) {
			if (!empty($field)) {
				if (strpos(strtolower($field), 'format') !== false) {
					// filter by date range
					$data = $this->filterByDateRange($data, $filter, $field);
				} else if (strpos(strtolower($field), 'tanggal') !== false) {
					// filter by date range
					$data = $this->filterByDate($data, $filter, $field);
				} else {
					// filter by column
					$data = array_filter($data, function ($a) use ($field, $filter) {
						return (bool) preg_match("/$filter/i", $a[$field]);
					});
				}
			} else {
				// general filter
				$data = array_filter($data, function ($a) use ($filter) {
					return (bool) preg_grep("/$filter/i", (array) $a);
				});
			}
		}

		return $data;
	}

	public function filterByDateRange($data, $filter, $field)
	{
		// filter by range
		if (!empty($range = array_filter(explode('|', $filter)))) {
			$filter = $range;
		}

		if (is_array($filter)) {
			foreach ($filter as &$date) {
				// hardcoded date format
				$date = date_create_from_format('d/m/Y', stripcslashes($date));
			}
			// filter by date range
			$data = array_filter($data, function ($a) use ($field, $filter) {
				// hardcoded date format
				$current = date_create_from_format('d/m/Y', $a[$field]);
				$from    = $filter[0];
				$to      = $filter[1];
				if ($from <= $current && $to >= $current) {
					return true;
				}

				return false;
			});
		}

		return $data;
	}

	public function filterByDate($data, $filter, $field)
	{
		// filter by range
		if (!empty($range = array_filter(explode('|', $filter)))) {
			$filter = $range;
		}

		if (is_array($filter)) {
			foreach ($filter as &$date) {
				// hardcoded date format
				$date = date_create_from_format('d/m/Y', stripcslashes($date));
			}
			// filter by date range
			$data = array_filter($data, function ($a) use ($field, $filter) {
				// hardcoded date format
				$current = date_create_from_format('d/m/Y', $a[$field]);
				$from    = $filter[0];
				$to      = $filter[0];
				if ($from <= $current && $to >= $current) {
					return true;
				}

				return false;
			});
		}

		return $data;
	}
}
