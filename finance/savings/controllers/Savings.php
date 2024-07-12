<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Savings extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('SavingsModel');
        $this->user_finance = $this->session->userdata("sias-finance");
        $this->db2 = $this->load->database('secondary_db', true);

        if ($this->session->userdata('sias-finance') == false) {
            redirect('finance/auth');
        }
        $this->load->library('form_validation');
        $this->load->library('pdfgenerator');
    }

    //
    //-------------------------------DASHBOARD------------------------------//
    //

    public function list_personal_saving()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['structure'] = $this->SavingsModel->get_structure_account();
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_personal_savings_view_all', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function list_joint_saving()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['structure'] = $this->SavingsModel->get_structure_account();
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_joint_savings_view_all', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function list_import_personal_saving()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['structure'] = $this->SavingsModel->get_structure_account();
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_import_personal_savings', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function savings_recap()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();
        $data['transaksi'] = $this->SavingsModel->get_new_transaction();
        $data['kredit'] = $this->SavingsModel->get_transaction_credit_insight();

        $data['debet'] = $this->SavingsModel->get_transaction_debet_insight();
        $data['kredit_debet'] = $this->SavingsModel->get_credit_debet_insight();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_savings_view_recap_all', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
        //$this->template->load('template_finance/template_finance', 'under_dev', $data);
    }

    public function joint_saving_transaction()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['structure'] = $this->SavingsModel->get_structure_account();
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_savings_joint_transaction', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function saving_general_transaction()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['structure'] = $this->SavingsModel->get_structure_account();
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_savings_general_transaction', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function saving_qurban_transaction()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['structure'] = $this->SavingsModel->get_structure_account();
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_savings_qurban_transaction', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }
    public function saving_tour_transaction()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['structure'] = $this->SavingsModel->get_structure_account();
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_savings_tour_transaction', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function check_number_personal_saving()
    {

        $param = $this->input->post('input_nomor_rekening');
        $number = $this->security->xss_clean($param);

        $check = $this->SavingsModel->get_number_personal_saving($number);

        if ($check) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        }
    }

    public function check_number_import_personal_saving()
    {

        $nis = $this->input->post('nis_siswa');
        $number = $this->security->xss_clean($nis);

        $old_nis = $this->input->post('old_nis');
        $number_old = $this->security->xss_clean($old_nis);

        $check = $this->SavingsModel->get_number_personal_saving($number);

        if ($check) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else {
            $check_import = $this->SavingsModel->get_number_import_personal_saving($number);

            if ($check_import && ($number_old != $check_import->nis)) {
                $isAvailable = false;
                echo json_encode(array(
                    'valid' => $isAvailable,
                ));
            } else {
                $isAvailable = true;
                echo json_encode(array(
                    'valid' => $isAvailable,
                ));
            }
        }
    }

    public function check_number_joint_saving()
    {

        $param = $this->input->post('input_nomor_rekening_bersama');
        $number = $this->security->xss_clean($param);

        $check = $this->SavingsModel->get_number_joint_saving($number);

        if ($check) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        }
    }

    public function add_joint_saving()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['structure'] = $this->SavingsModel->get_structure_account();
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_add_joint_savings', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function add_personal_saving()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['structure'] = $this->SavingsModel->get_structure_account();
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_add_personal_savings', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }

    }

    public function get_all_student()
    {
        $data = $this->SavingsModel->get_student();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, Data tidak ditemukan, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_all_joint_saving()
    {
        $data = $this->SavingsModel->get_joint_saving();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, Nama Tabungan Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_student_by_nis($id = "")
    {
        $data['data_siswa'] = $this->SavingsModel->get_student_by_nis($id);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, NIS Siswa Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_all_joint_customer()
    {
        $param = $this->input->get();
        $get = $this->security->xss_clean($param);

        $data = $this->SavingsModel->get_all_joint_customer($get['start_date'], $get['end_date']);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_all_personal_customer()
    {
        $param = $this->input->get();
        $get = $this->security->xss_clean($param);

        $data = $this->SavingsModel->get_all_personal_customer($get['start_date'], $get['end_date']);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );
            echo json_encode($output);
        }
    }

    public function get_all_import_personal_customer()
    {
        $data = $this->SavingsModel->get_all_import_personal_customer();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );
            echo json_encode($output);
        }
    }

    public function get_all_transaction()
    {
        $param = $this->input->get();
        $get = $this->security->xss_clean($param);

        $data = $this->SavingsModel->get_all_general_transaction_savings($get['start_date'], $get['end_date']);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_all_qurban_transaction()
    {
        $param = $this->input->get();
        $get = $this->security->xss_clean($param);

        $data = $this->SavingsModel->get_all_qurban_transaction_savings($get['start_date'], $get['end_date']);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_all_tour_transaction()
    {
        $param = $this->input->get();
        $get = $this->security->xss_clean($param);

        $data = $this->SavingsModel->get_all_tour_transaction_savings($get['start_date'], $get['end_date']);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_all_joint_transaction()
    {
        $param = $this->input->get();
        $get = $this->security->xss_clean($param);

        $data = $this->SavingsModel->get_all_joint_transaction_savings($get['start_date'], $get['end_date']);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_student_recap_transaction($nis = '')
    {
        $param = $this->input->get();
        $get = $this->security->xss_clean($param);

        $data = $this->SavingsModel->get_student_transaction_recap_by_nis($nis, $get['start_date'], $get['end_date']); //?

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_joint_recap_transaction($norek = '')
    {
        $param = $this->input->get();
        $get = $this->security->xss_clean($param);

        $data = $this->SavingsModel->get_joint_transaction_recap_by_acc_number($norek, $get['start_date'], $get['end_date']); //?

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_student_info($nis = '')
    {
        $data['info_siswa'] = $this->SavingsModel->get_student_by_nis($nis);
        $data['info_tabungan'] = $this->SavingsModel->get_info_student_transaction($nis);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_joint_saving_info_recap($norek = '')
    {
        $data['info_tabungan'] = $this->SavingsModel->get_joint_saving_by_acc_number($norek);
        $data['info_transaksi'] = $this->SavingsModel->get_info_joint_saving_transaction($norek);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, Tabungan Bersama Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_student_qurban_info($nis = '')
    {
        $data['info_siswa'] = $this->SavingsModel->get_student_by_nis($nis);
        $data['info_tabungan'] = $this->SavingsModel->get_info_student_transaction_qurban($nis);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_student_tour_info($nis = '')
    {
        $data['info_siswa'] = $this->SavingsModel->get_student_by_nis($nis);
        $data['info_tabungan'] = $this->SavingsModel->get_info_student_transaction_tour($nis);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_student_info_recap($nis = '')
    {
        $data['info_siswa'] = $this->SavingsModel->get_student_by_nis($nis);
        $data['info_tabungan_umum'] = $this->SavingsModel->get_info_student_transaction($nis);
        $data['info_tabungan_qurban'] = $this->SavingsModel->get_info_student_transaction_qurban($nis);
        $data['info_tabungan_wisata'] = $this->SavingsModel->get_info_student_transaction_tour($nis);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_student_transaction_recap()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        if (empty($data['nis_siswa']) or $data['nis_siswa'] == "") {
            $this->load->view('error_404', $data);
        } else {
            if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
                redirect('finance/savings/recap_transaction/' . $data['nis_siswa']);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function get_joint_transaction_recap()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        if (empty($data['nomor_rekening_bersama']) or $data['nomor_rekening_bersama'] == "") {
            $this->load->view('error_404', $data);
        } else {
            if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
                redirect('finance/savings/recap_joint_transaction/' . $data['nomor_rekening_bersama']);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function recap_transaction($nis = '')
    {

        $data['nav_save'] = 'menu-item-here';

        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        $data['info_siswa'] = $this->SavingsModel->get_student_by_nis($nis);
        $data['info_transaksi'] = $this->SavingsModel->get_info_student_transaction($nis);

        if ($nis == "" or empty($nis)) {
            $this->load->view('error_404', $data);
        } else {
            if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
                $this->template->load('template_finance/template_finance', 'finance_savings_recap_balance', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function recap_joint_transaction($norek = '')
    {

        $data['nav_save'] = 'menu-item-here';

        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        $data['info_joint'] = $this->SavingsModel->get_joint_saving_by_acc_number($norek);
        $data['info_transaksi'] = $this->SavingsModel->get_info_joint_saving_transaction($norek);

        if ($norek == "" or empty($norek)) {
            $this->load->view('error_404', $data);
        } else {
            if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
                $this->template->load('template_finance/template_finance', 'finance_savings_recap_joint_balance', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function post_personal_savings()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $this->form_validation->set_rules('input_nomor_rekening', 'Nomor Rekening Nasabah/Siswa', 'required');
        $this->form_validation->set_rules('input_nama_nasabah', 'Nama Nasabah/Siswa', 'required');
        $this->form_validation->set_rules('input_tahun_ajaran', 'Tahun Ajaran', 'required');
        $this->form_validation->set_rules('input_tingkat', 'Tingkat Nasabah/Siswa', 'required');
        $this->form_validation->set_rules('input_saldo_tabungan_umum', 'Nominal Saldo Tabungan Umum', 'required');
        $this->form_validation->set_rules('input_tanggal_transaksi', 'Tanggal Transaksi', 'required');

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/savings/add_personal_saving');
        } else {

            $check_number = $this->SavingsModel->get_number_personal_saving($data['input_nomor_rekening']);

            if (empty($check_number)) {

                $input_bank_customer = $this->SavingsModel->insert_personal_saving($data);

                if ($input_bank_customer == true) {

                    $keterangan_umum = "";
                    $keterangan_qurban = "";
                    $keterangan_wisata = "";

                    $status_umum = "";
                    $status_qurban = "";
                    $status_wisata = "";

                    if ($data['input_saldo_tabungan_umum'] >= 5000) {

                        $data_umum = array(
                            'nomor_transaksi_umum' => "TU01" . $random_number . "/" . date('YmdHis'),
                            'id_tingkat' => $data['input_tingkat'],
                            'nis' => $data['input_nomor_rekening'],
                            'nominal' => $data['input_saldo_tabungan_umum'],
                            'jenis_tabungan' => 1,
                            'saldo_akhir' => $data['input_saldo_tabungan_umum'],
                            'catatan_kredit' => $data['input_catatan_umum'],
                            'tanggal_transaksi' => $data['input_tanggal_transaksi'],
                            'status_kredit_debet' => "1",
                            'tahun_ajaran' => $data['input_tahun_ajaran'],
                        );

                        $input_umum = $this->SavingsModel->insert_credit_saving($this->user_finance[0]->id_akun_keuangan, $data_umum);

                        if (!$input_umum) {
                            $status_umum = "<b>Rp. $data[input_saldo_tabungan_umum], STATUS:</b> <b class='text-danger'>GAGAL</b>";
                        } else {
                            $status_umum = "<b>Rp. $data[input_saldo_tabungan_umum], STATUS:</b> <b class='text-success'>BERHASIL</b>";
                        }

                        $keterangan_umum = "<b>->TRANSAKSI DI TABUNGAN UMUM SEBESAR </b>$status_umum<br>";

                    } else if ($data['input_saldo_tabungan_umum'] == "" or $data['input_saldo_tabungan_umum'] == null or $data['input_saldo_tabungan_umum'] == 0) {

                        $keterangan_umum = "";
                    } else {

                        $keterangan_umum = "<b>->TRANSAKSI DI TABUNGAN UMUM SEBESAR Rp. $data[input_saldo_tabungan_umum], STATUS:</b> <b class='text-danger'>GAGAL</b> <b>(NOMINAL TIDAK BOLEH KURANG DARI 5000)</b><br>";
                    }

                    if ($data['input_saldo_tabungan_qurban'] >= 5000) {

                        $data_qurban = array(
                            'nomor_transaksi_qurban' => "TQ01/" . date('YmdHis'),
                            'id_tingkat' => $data['input_tingkat'],
                            'nis' => $data['input_nomor_rekening'],
                            'nominal' => $data['input_saldo_tabungan_qurban'],
                            'jenis_tabungan' => 2,
                            'saldo_akhir' => $data['input_saldo_tabungan_qurban'],
                            'catatan_kredit' => $data['input_catatan_qurban'],
                            'tanggal_transaksi' => $data['input_tanggal_transaksi'],
                            'status_kredit_debet' => "1",
                            'tahun_ajaran' => $data['input_tahun_ajaran'],
                        );

                        $input_qurban = $this->SavingsModel->insert_qurban_credit_saving($this->user_finance[0]->id_akun_keuangan, $data_qurban);

                        if (!$input_qurban) {
                            $status_qurban = "<b>Rp. $data[input_saldo_tabungan_qurban], STATUS:</b> <b class='text-danger'>GAGAL</b>";
                        } else {
                            $status_qurban = "<b>Rp. $data[input_saldo_tabungan_qurban], STATUS:</b> <b class='text-success'>BERHASIL</b>";
                        }
                        $keterangan_qurban = "<b>->TRANSAKSI DI TABUNGAN QURBAN SEBESAR </b>$status_qurban<br>";

                    } else if ($data['input_saldo_tabungan_qurban'] == "" or $data['input_saldo_tabungan_qurban'] == null or $data['input_saldo_tabungan_qurban'] == 0) {

                        $keterangan_qurban = "";
                    } else {

                        $keterangan_qurban = "<b>->TRANSAKSI DI TABUNGAN QURBAN SEBESAR Rp. $data[input_saldo_tabungan_umum], STATUS:</b> <b class='text-danger'>GAGAL</b> <b>(NOMINAL TIDAK BOLEH KURANG DARI 5000)</b><br>";
                    }

                    if ($data['input_saldo_tabungan_qurban'] >= 5000) {

                        $data_wisata = array(
                            'nomor_transaksi_wisata' => "TW01/" . date('YmdHis'),
                            'id_tingkat' => $data['input_tingkat'],
                            'nis' => $data['input_nomor_rekening'],
                            'nominal' => $data['input_saldo_tabungan_wisata'],
                            'jenis_tabungan' => 3,
                            'saldo_akhir' => $data['input_saldo_tabungan_wisata'],
                            'catatan_kredit' => $data['input_catatan_wisata'],
                            'tanggal_transaksi' => $data['input_tanggal_transaksi'],
                            'status_kredit_debet' => "1",
                            'tahun_ajaran' => $data['input_tahun_ajaran'],
                        );

                        $input_wisata = $this->SavingsModel->insert_tour_credit_saving($this->user_finance[0]->id_akun_keuangan, $data_wisata);

                        if (!$input_wisata) {
                            $input_wisata = "<b>Rp. $data[input_saldo_tabungan_wisata], STATUS:</b> <b class='text-danger'>GAGAL</b>";
                        } else {
                            $input_wisata = "<b>Rp. $data[input_saldo_tabungan_wisata], STATUS:</b> <b class='text-success'>BERHASIL</b>";
                        }
                        $keterangan_wisata = "<b>->TRANSAKSI DI TABUNGAN WISATA SEBESAR </b>$status_wisata<br>";

                    } else if ($data['input_saldo_tabungan_wisata'] == "" or $data['input_saldo_tabungan_wisata'] == null or $data['input_saldo_tabungan_wisata'] == 0) {

                        $keterangan_wisata = "";
                    } else {

                        $keterangan_wisata = "<b>->TRANSAKSI DI TABUNGAN WISATA SEBESAR Rp. $data[input_saldo_tabungan_wisata], STATUS:</b> <b class='text-danger'>GAGAL</b> <b>(NOMINAL TIDAK BOLEH KURANG DARI 5000)</b><br>";
                    }

                    $this->session->set_flashdata('flash_message', succ_msg("Data Nasabah/Siswa Baru <b>'ATAS NAMA: " . strtoupper($data['input_nama_nasabah']) . ", NIS/NOREK: $data[input_nomor_rekening]'</b> telah ditambahakan dengan Rincian Transaksi berikut: <br>$keterangan_umum $keterangan_qurban $keterangan_wisata <br> <b class='text-danger'>*Silahkan cek Data Nasabah di menu Daftar Nasabah, Terima Kasih.</b>"));
                    redirect('finance/savings/list_personal_saving');
                } else {

                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan lakukan input ulang..'));
                    redirect('finance/savings/add_personal_saving');
                }
            } else {
                $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Nomor Rekening Telah Digunakan, Silahkan inputkan nomor rekening lain.'));
                redirect('finance/savings/add_personal_saving');
            }
        }
    }

    public function post_joint_savings()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $this->form_validation->set_rules('input_nomor_rekening_bersama', 'Nomor Rekening Bersama', 'required');
        $this->form_validation->set_rules('input_nama_tabungan_bersama', 'Nama Tabungan Bersama', 'required');
        $this->form_validation->set_rules('input_nominal_saldo', 'Nominal Saldo Awal', 'required');
        $this->form_validation->set_rules('input_tahun_ajaran', 'Tahun Ajaran', 'required');
        $this->form_validation->set_rules('input_tingkat', 'Tingkat Siswa', 'required');
        $this->form_validation->set_rules('input_nama_wali', 'Nama Wali Penanggung Jawab', 'required');
        $this->form_validation->set_rules('input_nomor_hp_wali', 'Nomor HP Penanggng Jawab', 'required');
        $this->form_validation->set_rules('input_tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('input_nama_siswa_penanggungjawab', 'Nama Siswa Penanggung Jawab', 'required');

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['input_status_kredit_debet'] = "1";
        $data['input_nomor_transaksi_bersama'] = "TB01" . $random_number . "/" . date('YmdHis');

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/savings/add_joint_saving');
        } else {

            $check_number = $this->SavingsModel->get_number_joint_saving($data['input_nomor_rekening_bersama']);

            if (empty($check_number)) {

                $input = $this->SavingsModel->insert_joint_saving($this->user_finance[0]->id_akun_keuangan, $data);

                if ($input == true) {

                    if ($data['input_nominal_saldo'] != "" or $data['input_nominal_saldo'] >= 5000 or $data['input_nominal_saldo'] != null) {

                        $data['saldo_akhir'] = $data['input_nominal_saldo'];

                        $transaksi = $this->SavingsModel->insert_joint_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);

                        if (!$transaksi) {
                            $status_transaksi = "<b>Rp. $data[input_nominal_saldo], STATUS:</b> <b class='text-danger'>GAGAL</b> <b>(SYSTEM ERROR!)</b>";
                        } else {
                            $status_transaksi = "<b>Rp. $data[input_nominal_saldo], STATUS:</b> <b class='text-success'>BERHASIL</b>";
                        }

                        $transaksi_bersama = "<b>TRANSAKSI DI TABUNGAN BERSAMA SEBESAR </b>$status_transaksi<br>";
                    } else {

                        $transaksi_bersama = "<b>->TRANSAKSI DI TABUNGAN WISATA SEBESAR Rp. $data[input_nominal_saldo], STATUS:</b> <b class='text-danger'>GAGAL</b> <b>(NOMINAL TIDAK BOLEH KURANG DARI 5000)</b><br>";
                    }

                    $this->session->set_flashdata('flash_message', succ_msg("Data Tabungan Bersama Baru <b>'ATAS NAMA: " . strtoupper($data['input_nama_tabungan_bersama']) . ", NOREK: $data[input_nomor_rekening_bersama]'</b> telah ditambahakan dengan Rincian Transaksi berikut: <br>$transaksi_bersama <br><b class='text-danger'>*Silahkan cek Data Nasabah Bersama di menu Daftar Tabungan Bersama, Terima Kasih.</b>"));
                    redirect('finance/savings/list_joint_saving');
                } else {

                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan lakukan input ulang..'));
                    redirect('finance/savings/add_joint_saving');
                }

            } else {
                $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Nomor Rekening Telah Digunakan, Silahkan inputkan nomor rekening lain.'));
                redirect('finance/savings/add_joint_saving');
            }
        }
    }

    public function post_joint_saving_credit()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);

        $data['input_status_kredit_debet'] = "1";
        $data['input_nomor_transaksi_bersama'] = "TB01" . $random_number . "/" . date('YmdHis');
        $get_balance = $this->SavingsModel->get_joint_saving_balance($data['input_nomor_rekening_bersama']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['input_nomor_rekening_bersama'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if ($get_balance[0]->saldo_tabungan_bersama == 0) {

                    $data['saldo_akhir'] = $data['input_nominal_saldo'];

                } else if ($data['input_nominal_saldo'] < 5000) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 5000, Silahkan input ulang.",
                    );

                    echo json_encode($output);
                    exit();

                } else {

                    $data['saldo_akhir'] = $data['input_nominal_saldo'] + $get_balance[0]->saldo_tabungan_bersama;
                }

                $input_credit = $this->SavingsModel->insert_joint_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);
                $update_balance = $this->SavingsModel->update_balance_joint_saving($data['input_nomor_rekening_bersama'], $data['saldo_akhir']);

                if ($input_credit == true && $update_balance == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Disetor!, Setor Tabungan Bersama Atas Nama <b>" . $get_balance[0]->nama_tabungan_bersama . " (" . $get_balance[0]->nomor_rekening_bersama . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Bersama.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function post_credit()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['status_kredit_debet'] = "1";
        $data['nomor_transaksi_umum'] = "TU01" . $random_number . "/" . date('YmdHis');
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if ($get_balance[0]->saldo_tabungan_umum == 0) {

                    $data['saldo_akhir'] = $data['nominal'];

                } else if ($data['nominal'] < 5000) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 5000, Silahkan input ulang.",
                    );

                    echo json_encode($output);
                    exit();

                } else {

                    $data['saldo_akhir'] = $data['nominal'] + $get_balance[0]->saldo_tabungan_umum;

                }

                $input_credit = $this->SavingsModel->insert_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);
                $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);

                if ($input_credit == true && $update_balance == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Disetor!, Setor Tabungan Umum Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Umum.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function post_qurban_credit()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['status_kredit_debet'] = "1";
        $data['nomor_transaksi_qurban'] = "TQ01" . $random_number . "/" . date('YmdHis');
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if ($get_balance[0]->saldo_tabungan_qurban == 0) {

                    $data['saldo_akhir'] = $data['nominal'];

                } else if ($data['nominal'] < 5000) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 5000, Silahkan input ulang.",
                    );

                    echo json_encode($output);
                    exit();

                } else {

                    $data['saldo_akhir'] = $data['nominal'] + $get_balance[0]->saldo_tabungan_qurban;

                }

                $input_credit = $this->SavingsModel->insert_qurban_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);
                $update_balance = $this->SavingsModel->update_qurban_balance_saving($data['nis'], $data['saldo_akhir']);

                if ($input_credit == true && $update_balance == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Disetor!, Setor Tabungan Qurban Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Qurban.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function post_tour_credit()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['status_kredit_debet'] = "1";
        $data['nomor_transaksi_wisata'] = "TW01" . $random_number . "/" . date('YmdHis');
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if ($get_balance[0]->saldo_tabungan_wisata == 0) {

                    $data['saldo_akhir'] = $data['nominal'];

                } else if ($data['nominal'] < 5000) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 5000, Silahkan input ulang.",
                    );

                    echo json_encode($output);
                    exit();

                } else {

                    $data['saldo_akhir'] = $data['nominal'] + $get_balance[0]->saldo_tabungan_wisata;

                }

                $input_credit = $this->SavingsModel->insert_tour_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);
                $update_balance = $this->SavingsModel->update_tour_balance_saving($data['nis'], $data['saldo_akhir']);

                if ($input_credit == true && $update_balance == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Disetor!, Setor Tabungan Wisata Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Wisata.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function post_credit_new_client()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['status_kredit_debet'] = "1";
        $data['nomor_transaksi_umum'] = "TU01" . $random_number . "/" . date('YmdHis');
        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                $data['saldo_akhir'] = $data['nominal'];

                $input_client = $this->SavingsModel->insert_client($data);
                $input_credit = $this->SavingsModel->insert_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);

                if ($input_client == true && $input_credit == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Disetor!, Setor Tabungan Umum Atas Nama <b>" . $data['nama_nasabah'] . " (" . $data['nis'] . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Umum.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function post_qurban_credit_new_client()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['status_kredit_debet'] = "1";
        $data['nomor_transaksi_qurban'] = "TQ01" . $random_number . "/" . date('YmdHis');
        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                $data['saldo_akhir'] = $data['nominal'];

                $input_client = $this->SavingsModel->insert_qurban_client($data);
                $input_credit = $this->SavingsModel->insert_qurban_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);

                if ($input_client == true && $input_credit == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Disetor!, Setor Tabungan Qurban Atas Nama <b>" . $data['nama_nasabah'] . " (" . $data['nis'] . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Qurban.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function post_tour_credit_new_client()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['status_kredit_debet'] = "1";
        $data['nomor_transaksi_wisata'] = "TW01" . $random_number . "/" . date('YmdHis');
        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                $data['saldo_akhir'] = $data['nominal'];

                $input_client = $this->SavingsModel->insert_tour_client($data);
                $input_credit = $this->SavingsModel->insert_tour_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);

                if ($input_client == true && $input_credit == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Disetor!, Setor Tabungan Wisata Atas Nama <b>" . $data['nama_nasabah'] . " (" . $data['nis'] . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Wisata.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function update_personal_saving()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['id_siswa'] == "" or empty($data['id_siswa']) or $data['id_siswa'] == null) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                $update_personal = $this->SavingsModel->update_personal_saving($data['id_siswa'], $data);

                if ($update_personal == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Diubah!, Perubahan Profil Nasabah Atas Nama <b>" . $data['nama_lengkap'] . " (" . $data['nis'] . ")</b> telah diubah. Silahkan cek Profil Nasabah menu Daftar Nasabah.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }

            echo json_encode($output);

        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function update_import_personal_saving()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['id_nasabah'] == "" or empty($data['id_nasabah']) or $data['id_nasabah'] == null) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                $check = $this->SavingsModel->get_number_personal_saving($data['nis']);

                if ($check) {
                    $data['status_nasabah'] = '1';
                } else {
                    $check_import = $this->SavingsModel->get_number_import_personal_saving($data['nis']);

                    if ($check_import && ($data['old_nis'] != $check_import->nis)) {
                        $data['status_nasabah'] = '1';
                    } else {
                        $data['status_nasabah'] = '2';
                    }
                }

                $update_personal = $this->SavingsModel->update_import_personal_saving($data['id_nasabah'], $data);

                if ($update_personal == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Diubah!, Perubahan Data Import Atas Nama <b>" . $data['nama_nasabah'] . " (" . $data['nis'] . ")</b> telah diubah. Silahkan cek Hasil Data Import.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }

            echo json_encode($output);

        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }
    public function update_joint_saving()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['id_tabungan_bersama'] == "" or empty($data['id_tabungan_bersama']) or $data['id_tabungan_bersama'] == null) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                $update_joint = $this->SavingsModel->update_joint_saving($data['id_tabungan_bersama'], $data);
                $update_personal = $this->SavingsModel->update_name_hp_customer($data['id_siswa_penanggung_jawab'], $data);

                if ($update_joint == true && $update_personal == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Diubah!, Perubahan Profil Tabungan Bersama Atas Nama <b>" . $data['nama_tabungan_bersama'] . " (" . $data['nomor_rekening_bersama'] . ")</b> telah diubah. Silahkan cek Profil Tabungan Bersama menu Daftar Tabungan Bersama.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }

            echo json_encode($output);

        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function update_joint_saving_credit()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $get_transaction = $this->SavingsModel->get_joint_transaction_last($data['input_id_transaksi_bersama']);
        $get_balance = $this->SavingsModel->get_joint_saving_balance($data['input_nomor_rekening_bersama']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['input_nomor_rekening_bersama']) or empty($data['input_id_transaksi_bersama'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if (($get_balance[0]->saldo_tabungan_bersama - $get_transaction[0]->nominal) == 0) {

                    $data['saldo_akhir'] = $data['input_nominal_saldo'];

                } else if ($data['input_nominal_saldo'] < 5000) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 5000, Silahkan input ulang.",
                    );

                    echo json_encode($output);
                    exit();

                } else {

                    $data['saldo_akhir'] = $data['input_nominal_saldo'] + ($get_balance[0]->saldo_tabungan_bersama - $get_transaction[0]->nominal);

                }

                $input_credit = $this->SavingsModel->update_credit_joint_saving($data['input_id_transaksi_bersama'], $data);
                $update_balance = $this->SavingsModel->update_balance_joint_saving($data['input_nomor_rekening_bersama'], $data['saldo_akhir']);

                if ($input_credit == true && $update_balance == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Diubah!, Perubahan Setor Tabungan Bersama Atas Nama <b>" . $get_balance[0]->nama_tabungan_bersama . " (" . $get_balance[0]->nomor_rekening_bersama . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Bersama.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }
            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function update_credit()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $get_transaction = $this->SavingsModel->get_student_transaction_last($data['id_transaksi']);
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis']) or empty($data['id_transaksi'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if (($get_balance[0]->saldo_tabungan_umum - $get_transaction[0]->nominal) == 0) {

                    $data['saldo_akhir'] = $data['nominal'];

                } else if ($data['nominal'] < 5000) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 5000, Silahkan input ulang.",
                    );

                    echo json_encode($output);
                    exit();

                } else {

                    $data['saldo_akhir'] = $data['nominal'] + ($get_balance[0]->saldo_tabungan_umum - $get_transaction[0]->nominal);

                }

                $input_credit = $this->SavingsModel->update_credit_saving($data['id_transaksi'], $data);
                $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);

                if ($input_credit == true && $update_balance == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Diubah!, Perubahan Setor Tabungan Umum Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Umum.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }
            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function update_qurban_credit()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $get_transaction = $this->SavingsModel->get_student_transaction_qurban_last($data['id_transaksi']);
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis']) or empty($data['id_transaksi'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if (($get_balance[0]->saldo_tabungan_qurban - $get_transaction[0]->nominal) == 0) {

                    $data['saldo_akhir'] = $data['nominal'];

                } else if ($data['nominal'] < 5000) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 5000, Silahkan input ulang.",
                    );

                    echo json_encode($output);
                    exit();

                } else {

                    $data['saldo_akhir'] = $data['nominal'] + ($get_balance[0]->saldo_tabungan_qurban - $get_transaction[0]->nominal);

                }

                $input_credit = $this->SavingsModel->update_qurban_credit_saving($data['id_transaksi'], $data);
                $update_balance = $this->SavingsModel->update_qurban_balance_saving($data['nis'], $data['saldo_akhir']);

                if ($input_credit == true && $update_balance == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Diubah!, Perubahan Setor Tabungan Qurban Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Qurban.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }
            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }
    public function update_tour_credit()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $get_transaction = $this->SavingsModel->get_student_transaction_tour_last($data['id_transaksi']);
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis']) or empty($data['id_transaksi'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if (($get_balance[0]->saldo_tabungan_wisata - $get_transaction[0]->nominal) == 0) {

                    $data['saldo_akhir'] = $data['nominal'];

                } else if ($data['nominal'] < 5000) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 5000, Silahkan input ulang.",
                    );

                    echo json_encode($output);
                    exit();

                } else {

                    $data['saldo_akhir'] = $data['nominal'] + ($get_balance[0]->saldo_tabungan_wisata - $get_transaction[0]->nominal);

                }

                $input_credit = $this->SavingsModel->update_tour_credit_saving($data['id_transaksi'], $data);
                $update_balance = $this->SavingsModel->update_tour_balance_saving($data['nis'], $data['saldo_akhir']);

                if ($input_credit == true && $update_balance == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Diubah!, Perubahan Setor Tabungan Wisata Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Wisata.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    );
                }

            }
            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function post_joint_saving_debet()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['status_kredit_debet'] = "2";
        $data['input_nomor_transaksi_bersama'] = "TB02" . $random_number . "/" . date('YmdHis');
        $get_balance = $this->SavingsModel->get_joint_saving_balance($data['input_nomor_rekening_bersama']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['input_nomor_rekening_bersama'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if (($get_balance[0]->saldo_tabungan_bersama > 0) && ($data['input_nominal_saldo'] <= $get_balance[0]->saldo_tabungan_bersama)) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_bersama - $data['input_nominal_saldo'];

                    $input_debet = $this->SavingsModel->insert_debet_joint_saving($this->user_finance[0]->id_akun_keuangan, $data);
                    $update_balance = $this->SavingsModel->update_balance_joint_saving($data['input_nomor_rekening_bersama'], $data['saldo_akhir']);

                    if ($input_debet == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Ditarik!, Penarikan Tabungan Bersama Atas Nama <b>" . $get_balance[0]->nama_tabungan_bersama . " (" . $get_balance[0]->nomor_rekening_bersama . ")</b> telah ditarik. Silahkan cek Rekap/Histori Tabungan Bersama menu Daftar Tabungan Bersama.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else if (($get_balance[0]->saldo_tabungan_bersama <= 0)) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Saldo Mencukupi, Tidak Boleh <= 0, Silahkan input ulang.",
                    );
                } else if (($data['input_nominal_saldo'] < 2000)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 2000, Silahkan input ulang.",
                    );

                } else if (($data['input_nominal_saldo'] > $get_balance[0]->saldo_tabungan_bersama)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                    );

                }

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function post_debet()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['jenis_tabungan'] = "1";
        $data['status_kredit_debet'] = "2";
        $data['nomor_transaksi_umum'] = "TU02" . $random_number . "/" . date('YmdHis');
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if (($get_balance[0]->saldo_tabungan_umum > 0) && ($data['nominal'] <= $get_balance[0]->saldo_tabungan_umum)) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_umum - $data['nominal'];

                    $input_debet = $this->SavingsModel->insert_debet_saving($this->user_finance[0]->id_akun_keuangan, $data);
                    $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($input_debet == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Ditarik!, Penarikan Tabungan Umum Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditarik. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Umum.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else if (($get_balance[0]->saldo_tabungan_umum <= 0)) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Saldo Mencukupi, Tidak Boleh <= 0, Silahkan input ulang.",
                    );
                } else if (($data['nominal'] < 2000)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 2000, Silahkan input ulang.",
                    );

                } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_umum)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                    );

                }

            }
            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function post_qurban_debet()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['jenis_tabungan'] = "2";
        $data['status_kredit_debet'] = "2";
        $data['nomor_transaksi_qurban'] = "TQ02" . $random_number . "/" . date('YmdHis');
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if (($get_balance[0]->saldo_tabungan_qurban > 0) && ($data['nominal'] <= $get_balance[0]->saldo_tabungan_qurban)) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_qurban - $data['nominal'];

                    $input_debet = $this->SavingsModel->insert_qurban_debet_saving($this->user_finance[0]->id_akun_keuangan, $data);
                    $update_balance = $this->SavingsModel->update_qurban_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($input_debet == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Ditarik!, Penarikan Tabungan Qurban Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditarik. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Qurban.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else if (($get_balance[0]->saldo_tabungan_qurban <= 0)) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Saldo Mencukupi, Tidak Boleh <= 0, Silahkan input ulang.",
                    );
                } else if (($data['nominal'] < 2000)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 2000, Silahkan input ulang.",
                    );

                } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_qurban)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                    );

                }

            }
            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function post_tour_debet()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['jenis_tabungan'] = "3";
        $data['status_kredit_debet'] = "2";
        $data['nomor_transaksi_wisata'] = "TW02" . $random_number . "/" . date('YmdHis');
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if (($get_balance[0]->saldo_tabungan_wisata > 0) && ($data['nominal'] <= $get_balance[0]->saldo_tabungan_wisata)) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_wisata - $data['nominal'];

                    $input_debet = $this->SavingsModel->insert_tour_debet_saving($this->user_finance[0]->id_akun_keuangan, $data);
                    $update_balance = $this->SavingsModel->update_tour_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($input_debet == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Ditarik!, Penarikan Tabungan Wisata Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditarik. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Wisata.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else if (($get_balance[0]->saldo_tabungan_wisata <= 0)) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Saldo Mencukupi, Tidak Boleh <= 0, Silahkan input ulang.",
                    );
                } else if (($data['nominal'] < 2000)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 2000, Silahkan input ulang.",
                    );

                } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_wisata)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                    );

                }

            }
            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function update_joint_saving_debet()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $get_transaction = $this->SavingsModel->get_joint_transaction_last($data['input_id_transaksi_bersama']);
        $get_balance = $this->SavingsModel->get_joint_saving_balance($data['input_nomor_rekening_bersama']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['input_id_transaksi_bersama']) or empty($data['input_nomor_rekening_bersama'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if ((($get_transaction[0]->saldo + $get_transaction[0]->nominal) > 0) && ($data['input_nominal_saldo'] <= ($get_transaction[0]->saldo + $get_transaction[0]->nominal))) {

                    $data['saldo_akhir'] = ($get_transaction[0]->saldo + $get_transaction[0]->nominal) - $data['input_nominal_saldo'];

                    $update_debet = $this->SavingsModel->update_debet_joint_saving($data['input_id_transaksi_bersama'], $data);
                    $update_balance = $this->SavingsModel->update_balance_joint_saving($data['input_nomor_rekening_bersama'], $data['saldo_akhir']);

                    if ($update_debet == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Diubah!, Perubahan Penarikan Tabungan Bersama Atas Nama <b>" . $get_balance[0]->nama_tabungan_bersama . " (" . $get_balance[0]->nomor_rekening_bersama . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Bersama.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else if (($get_transaction[0]->saldo + $get_transaction[0]->nominal) <= 0) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Saldo Mencukupi, Tidak Boleh <= 0, Silahkan input ulang.",
                    );
                } else if (($data['input_nominal_saldo'] < 2000)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 2000, Silahkan input ulang.",
                    );

                } else if (($data['input_nominal_saldo'] > $get_balance[0]->saldo_tabungan_bersama)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                    );

                }
            }
            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function update_debet()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $get_transaction = $this->SavingsModel->get_student_transaction_last($data['id_transaksi']);
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            if ($data == false or empty($data['nis']) or empty($data['id_transaksi'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if ((($get_transaction[0]->saldo + $get_transaction[0]->nominal) > 0) && ($data['nominal'] <= ($get_transaction[0]->saldo + $get_transaction[0]->nominal))) {

                    $data['saldo_akhir'] = ($get_transaction[0]->saldo + $get_transaction[0]->nominal) - $data['nominal'];

                    $update_debet = $this->SavingsModel->update_debet_saving($data['id_transaksi'], $data);
                    $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($update_debet == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Diubah!, Perubahan Penarikan Tabungan Umum Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Umum.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else if (($get_transaction[0]->saldo + $get_transaction[0]->nominal) <= 0) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Saldo Mencukupi, Tidak Boleh <= 0, Silahkan input ulang.",
                    );
                } else if (($data['nominal'] < 2000)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 2000, Silahkan input ulang.",
                    );

                } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_umum)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                    );

                }

            }
            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function update_qurban_debet()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $get_transaction = $this->SavingsModel->get_student_transaction_qurban_last($data['id_transaksi']);
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            if ($data == false or empty($data['nis']) or empty($data['id_transaksi'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if ((($get_transaction[0]->saldo + $get_transaction[0]->nominal) > 0) && ($data['nominal'] <= ($get_transaction[0]->saldo + $get_transaction[0]->nominal))) {

                    $data['saldo_akhir'] = ($get_transaction[0]->saldo + $get_transaction[0]->nominal) - $data['nominal'];

                    $update_debet = $this->SavingsModel->update_qurban_debet_saving($data['id_transaksi'], $data);
                    $update_balance = $this->SavingsModel->update_qurban_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($update_debet == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Diubah!, Perubahan Penarikan Tabungan Qurban Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Qurban.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else if (($get_transaction[0]->saldo + $get_transaction[0]->nominal) <= 0) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Saldo Mencukupi, Tidak Boleh <= 0, Silahkan input ulang.",
                    );
                } else if (($data['nominal'] < 2000)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 2000, Silahkan input ulang.",
                    );

                } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_qurban)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                    );

                }

            }
            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function update_tour_debet()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $get_transaction = $this->SavingsModel->get_student_transaction_tour_last($data['id_transaksi']);
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            if ($data == false or empty($data['nis']) or empty($data['id_transaksi'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if ((($get_transaction[0]->saldo + $get_transaction[0]->nominal) > 0) && ($data['nominal'] <= ($get_transaction[0]->saldo + $get_transaction[0]->nominal))) {

                    $data['saldo_akhir'] = ($get_transaction[0]->saldo + $get_transaction[0]->nominal) - $data['nominal'];

                    $update_debet = $this->SavingsModel->update_tour_debet_saving($data['id_transaksi'], $data);
                    $update_balance = $this->SavingsModel->update_tour_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($update_debet == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Diubah!, Perubahan Penarikan Tabungan Wisata Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Wisata.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else if (($get_transaction[0]->saldo + $get_transaction[0]->nominal) <= 0) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Saldo Mencukupi, Tidak Boleh <= 0, Silahkan input ulang.",
                    );
                } else if (($data['nominal'] < 2000)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 2000, Silahkan input ulang.",
                    );

                } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_wisata)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                    );

                }

            }
            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function delete_joint_credit_transaction()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['nomor_rekening_bersama'] && $data['id_transaksi_bersama']) {

                $get_transaction = $this->SavingsModel->get_joint_transaction_last($data['id_transaksi_bersama']);
                $get_balance = $this->SavingsModel->get_joint_saving_balance($data['nomor_rekening_bersama']);

                if ($get_transaction == true && $get_balance == true) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_bersama - $get_transaction[0]->nominal;

                    $update_balance = $this->SavingsModel->update_balance_joint_saving($data['nomor_rekening_bersama'], $data['saldo_akhir']);
                    $delete = $this->SavingsModel->delete_joint_transaction($data['id_transaksi_bersama']);

                    if ($update_balance == true && $delete == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Dihapus!, Kredit Tabungan Bersama <b>" . $data['nomor_transaksi'] . "</b> Atas Nama <b>" . $get_balance[0]->nama_tabungan_bersama . " (" . $get_balance[0]->nomor_rekening_bersama . ")</b> telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Bersama.",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Kredit Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                        );

                    }
                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, ID transaksi/Nomor Rekening Bersama tidak ditemukan didalam sistem, Silahkan coba lagi.",
                    );
                }

            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, ID transaksi/Nomor Rekening Bersama belum diinputkan, Silahkan coba lagi.",
                );

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }
    public function delete_credit_transaction()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi']) {

                $get_transaction = $this->SavingsModel->get_student_transaction_last($data['id_transaksi']);
                $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

                if ($get_transaction == true && $get_balance == true) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_umum - $get_transaction[0]->nominal;

                    $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);
                    $delete = $this->SavingsModel->delete_transaction($data['id_transaksi']);

                    if ($update_balance == true && $delete == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Dihapus!, Transaksi Kredit Tabungan Umum <b>" . $data['nomor_transaksi'] . "</b> Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Umum.",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Transaksi Kredit Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                        );

                    }
                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, ID transaksi/NIS tidak ditemukan didalam sistem, Silahkan coba lagi.",
                    );
                }

            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, ID transaksi/NIS belum diinputkan, Silahkan coba lagi.",
                );

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function delete_qurban_credit_transaction()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi']) {

                $get_transaction = $this->SavingsModel->get_student_transaction_qurban_last($data['id_transaksi']);
                $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

                if ($get_transaction == true && $get_balance == true) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_qurban - $get_transaction[0]->nominal;

                    $update_balance = $this->SavingsModel->update_qurban_balance_saving($data['nis'], $data['saldo_akhir']);
                    $delete = $this->SavingsModel->delete_qurban_transaction($data['id_transaksi']);

                    if ($update_balance == true && $delete == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Dihapus!, Transaksi Kredit Tabungan Qurban <b>" . $data['nomor_transaksi'] . "</b> Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Qurban.",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Transaksi Kredit Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                        );

                    }
                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, ID transaksi/NIS tidak ditemukan didalam sistem, Silahkan coba lagi.",
                    );
                }

            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, ID transaksi/NIS belum diinputkan, Silahkan coba lagi.",
                );

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function delete_tour_credit_transaction()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi']) {

                $get_transaction = $this->SavingsModel->get_student_transaction_tour_last($data['id_transaksi']);
                $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

                if ($get_transaction == true && $get_balance == true) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_wisata - $get_transaction[0]->nominal;

                    $update_balance = $this->SavingsModel->update_tour_balance_saving($data['nis'], $data['saldo_akhir']);
                    $delete = $this->SavingsModel->delete_tour_transaction($data['id_transaksi']);

                    if ($update_balance == true && $delete == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Dihapus!, Transaksi Kredit Tabungan Wisata <b>" . $data['nomor_transaksi'] . "</b> Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Wisata.",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Transaksi Kredit Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                        );

                    }
                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, ID transaksi/NIS tidak ditemukan didalam sistem, Silahkan coba lagi.",
                    );
                }

            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, ID transaksi/NIS belum diinputkan, Silahkan coba lagi.",
                );

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function delete_joint_debet_transaction()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['nomor_rekening_bersama'] && $data['id_transaksi_bersama']) {

                $get_transaction = $this->SavingsModel->get_joint_transaction_last($data['id_transaksi_bersama']);
                $get_balance = $this->SavingsModel->get_joint_saving_balance($data['nomor_rekening_bersama']);

                if ($get_transaction == true && $get_balance == true) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_bersama + $get_transaction[0]->nominal;

                    $update_balance = $this->SavingsModel->update_balance_saving($data['nomor_rekening_bersama'], $data['saldo_akhir']);
                    $delete = $this->SavingsModel->delete_transaction($data['id_transaksi_bersama']);

                    if ($update_balance == true && $delete == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Dihapus!, Debet Tabungan Bersama <b>" . $data['nomor_transaksi'] . "</b> Atas Nama " . $get_balance[0]->nama_tabungan_bersama . " (" . $get_balance[0]->nomor_rekening_bersama . ") telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan.",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Debet Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                        );

                    }
                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, ID transaksi/Nomor Rekening Bersama tidak ditemukan didalam sistem, Silahkan coba lagi.",
                    );
                }

            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, ID transaksi/Nomor Rekening Bersama belum diinputkan, Silahkan coba lagi.",
                );

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function delete_debet_transaction()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi']) {

                $get_transaction = $this->SavingsModel->get_student_transaction_last($data['id_transaksi']);
                $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

                if ($get_transaction == true && $get_balance == true) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_umum + $get_transaction[0]->nominal;

                    $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);
                    $delete = $this->SavingsModel->delete_transaction($data['id_transaksi']);

                    if ($update_balance == true && $delete == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Dihapus!, Transaksi Debet Tabungan Umum <b>" . $data['nomor_transaksi'] . "</b> Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan.",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Transaksi Debet Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                        );

                    }
                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, ID transaksi/NIS tidak ditemukan didalam sistem, Silahkan coba lagi.",
                    );
                }

            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, ID transaksi/NIS belum diinputkan, Silahkan coba lagi.",
                );

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }
    public function delete_qurban_debet_transaction()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi']) {

                $get_transaction = $this->SavingsModel->get_student_transaction_qurban_last($data['id_transaksi']);
                $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

                if ($get_transaction == true && $get_balance == true) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_qurban + $get_transaction[0]->nominal;

                    $update_balance = $this->SavingsModel->update_qurban_balance_saving($data['nis'], $data['saldo_akhir']);
                    $delete = $this->SavingsModel->delete_qurban_transaction($data['id_transaksi']);

                    if ($update_balance == true && $delete == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Dihapus!, Transaksi Debet Tabungan Qurban <b>" . $data['nomor_transaksi'] . "</b> Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan.",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Transaksi Debet Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                        );

                    }
                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, ID transaksi/NIS tidak ditemukan didalam sistem, Silahkan coba lagi.",
                    );
                }

            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, ID transaksi/NIS belum diinputkan, Silahkan coba lagi.",
                );

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function delete_tour_debet_transaction()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi']) {

                $get_transaction = $this->SavingsModel->get_student_transaction_tour_last($data['id_transaksi']);
                $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

                if ($get_transaction == true && $get_balance == true) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_wisata + $get_transaction[0]->nominal;

                    $update_balance = $this->SavingsModel->update_tour_balance_saving($data['nis'], $data['saldo_akhir']);
                    $delete = $this->SavingsModel->delete_tour_transaction($data['id_transaksi']);

                    if ($update_balance == true && $delete == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Dihapus!, Transaksi Debet Tabungan Wisata <b>" . $data['nomor_transaksi'] . "</b> Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan.",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Transaksi Debet Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                        );

                    }
                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, ID transaksi/NIS tidak ditemukan didalam sistem, Silahkan coba lagi.",
                    );
                }

            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, ID transaksi/NIS belum diinputkan, Silahkan coba lagi.",
                );

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    //------------------------------- IMPORT DATA----------------------------------------//

    public function check_pin_number()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['pin_number']) {

                $check_pass = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);

                if (password_verify(($data['pin_number']), $check_pass[0]->pin_akun)) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "PIN Telah diverifikasi.",
                    );

                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "PIN Anda salah, Silahkan coba lagi.",
                    );
                }

            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, PIN belum diinputkan, Silahkan coba lagi.",
                );

            }

            echo json_encode($output);
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }

    }

    public function import_personal_saving()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $this->form_validation->set_rules('pin_verification', 'PIN Anda', 'required');
        $this->form_validation->set_rules('input_tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('input_tahun_ajaran', 'Tahun Ajaran', 'required');

        $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
        $userIp = $this->input->ip_address();

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/savings/list_personal_saving');
        } else {
            $check_pass = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
            // pass verify
            if (password_verify(($data['pin_verification']), $check_pass[0]->pin_akun)) {
                // gcaptha verify
                if ($this->googleCaptachStore($recaptchaResponse, $userIp) == 1) {

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
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    );

                    if (isset($_FILES['file_personal_saving']['name']) && in_array($_FILES['file_personal_saving']['type'], $file_mimes)) {
                        $this->SavingsModel->clear_import_data_personal_saving();

                        $arr_file = explode('.', $_FILES['file_personal_saving']['name']);
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
                        $spreadsheet = $reader->load($_FILES['file_personal_saving']['tmp_name']);
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();

                        $status_nis = '';
                        $tingkat = '';

                        $data_array = array();
                        for ($i = 1; $i < count($sheetData); $i++) {

                            $student = $this->SavingsModel->get_student_nis($sheetData[$i]['0']);
                            if (!$student) {
                                $status_nis = '2';
                            } else {
                                $status_nis = '1';
                            }

                            if (strtoupper($sheetData[$i]['2']) == 'DC') {
                                $tingkat = '6';
                            } else if (strtoupper($sheetData[$i]['2']) == 'KB') {
                                $tingkat = '1';
                            } else if (strtoupper($sheetData[$i]['2']) == 'TK') {
                                $tingkat = '2';
                            } else if (strtoupper($sheetData[$i]['2']) == 'SD') {
                                $tingkat = '3';
                            } else if (strtoupper($sheetData[$i]['2']) == 'SMP') {
                                $tingkat = '4';
                            }

                            if ($sheetData[$i]['0']) {
                                $data_array[$i] = array(
                                    'nis' => (filter_var(trim($sheetData[$i]['0']), FILTER_SANITIZE_STRING)),
                                    'nama_nasabah' => (filter_var(trim($sheetData[$i]['1']), FILTER_SANITIZE_STRING)),
                                    'tanggal_transaksi' => (filter_var(trim($data['input_tanggal_transaksi']), FILTER_SANITIZE_STRING)),
                                    'tahun_ajaran' => (filter_var(trim($data['input_tahun_ajaran']), FILTER_SANITIZE_STRING)),
                                    'tingkat' => (filter_var(trim($tingkat), FILTER_SANITIZE_STRING)),
                                    'nama_wali' => (filter_var(trim($sheetData[$i]['3']), FILTER_SANITIZE_STRING)),
                                    'nomor_hp_wali' => (filter_var(trim($sheetData[$i]['4']), FILTER_SANITIZE_STRING)),
                                    'email_nasabah' => (filter_var(trim($sheetData[$i]['5']), FILTER_SANITIZE_STRING)),
                                    'saldo_umum' => (filter_var(trim($sheetData[$i]['6']), FILTER_SANITIZE_STRING)),
                                    'saldo_qurban' => (filter_var(trim($sheetData[$i]['7']), FILTER_SANITIZE_STRING)),
                                    'saldo_wisata' => (filter_var(trim($sheetData[$i]['8']), FILTER_SANITIZE_STRING)),
                                    'status_nasabah' => (filter_var(trim($status_nis), FILTER_SANITIZE_STRING)),
                                );
                            }
                        }

                        $import_data = $this->db2->insert_batch('import_nasabah_personal', $data_array);

                        if ($import_data == true) {

                            $this->session->set_flashdata('flash_message', warn_msg("Peringatan!, File <b>" . $_FILES['file_personal_saving']['name'] . "</b> Telah diproses, Silahkan melakukan <b>PENGECEKAN & PERSETUJUAN</b> untuk mengimpor seluruh data file tersebut. Jika terjadi ketidaksamaan dengan Data Asli, dimohon untuk <b>MENGUBAH DATA</b>. Terima Kasih"));
                            redirect('finance/savings/list_import_personal_saving/' . paramEncrypt("sekolah_utsman"));
                        } else {

                            $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan import ulang...'));
                            redirect('finance/savings/list_personal_saving');
                        }
                    } else {

                        $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Silahkan Import file berformat csv/xls/xlsx'));
                        redirect('finance/savings/list_personal_saving');
                    }
                } else {

                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Google Recaptcha terdapat kesalahan.'));
                    redirect('finance/savings/list_personal_saving');
                }
            } else {
                $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf., Password Anda salah!'));
                redirect('finance/savings/list_personal_saving');
            }
        }
    }

    public function accept_import_personal_saving()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        $check_pass = $this->SavingsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);

        if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

            $output = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
            );

        } else {
            // pass verify
            if (password_verify(($data['password']), $check_pass[0]->password)) {

                $input = $this->SavingsModel->accept_import_data_personal_saving($data['data_check']);

                if ($input == true) {

                    $transaksi_umum = array();
                    $transaksi_qurban = array();
                    $transaksi_wisata = array();

                    $result_import = $this->SavingsModel->get_import_personal_saving($data['data_check'], 2);

                    for ($i = 0; $i < count($result_import); $i++) {

						$random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);

                        if ($result_import[$i]['saldo_umum'] != 0 && $result_import[$i]['saldo_umum'] != null && $result_import[$i]['saldo_umum'] != "" && !empty($result_import[$i]['saldo_umum'])) {

                            $transaksi_umum[$i] = array(
                                'nomor_transaksi_umum' => "TU01" . $random_number . "/" . date('YmdHis'),
                                'id_pegawai' => $this->user_finance[0]->id_akun_keuangan,
                                'id_tingkat' => $result_import[$i]['tingkat'],
                                'nis_siswa' => $result_import[$i]['nis'],
                                'nominal' => $result_import[$i]['saldo_umum'],
                                'jenis_tabungan' => 1,
                                'saldo' => $result_import[$i]['saldo_umum'],
                                'catatan' => "transaksi import awal",
                                'tanggal_transaksi' => $result_import[$i]['tanggal_transaksi'],
                                'status_kredit_debet' => "1",
                                'th_ajaran' => $result_import[$i]['tahun_ajaran'],
                            );
                        }

                        if ($result_import[$i]['saldo_qurban'] != 0 && $result_import[$i]['saldo_qurban'] != null && $result_import[$i]['saldo_qurban'] != "" && !empty($result_import[$i]['saldo_qurban'])) {

                            $transaksi_qurban[$i] = array(
                                'nomor_transaksi_qurban' => "TQ01" . $random_number . "/" . date('YmdHis'),
                                'id_pegawai' => $this->user_finance[0]->id_akun_keuangan,
                                'id_tingkat' => $result_import[$i]['tingkat'],
                                'nis_siswa' => $result_import[$i]['nis'],
                                'nominal' => $result_import[$i]['saldo_qurban'],
                                'jenis_tabungan' => 2,
                                'saldo' => $result_import[$i]['saldo_qurban'],
                                'catatan' => "transaksi import awal",
                                'tanggal_transaksi' => $result_import[$i]['tanggal_transaksi'],
                                'status_kredit_debet' => "1",
                                'th_ajaran' => $result_import[$i]['tahun_ajaran'],
                            );
                        }

                        if ($result_import[$i]['saldo_wisata'] != 0 && $result_import[$i]['saldo_wisata'] != null && $result_import[$i]['saldo_wisata'] != "" && !empty($result_import[$i]['saldo_wisata'])) {

                            $transaksi_wisata[$i] = array(
                                'nomor_transaksi_wisata' => "TW01" . $random_number . "/" . date('YmdHis'),
                                'id_pegawai' => $this->user_finance[0]->id_akun_keuangan,
                                'id_tingkat' => $result_import[$i]['tingkat'],
                                'nis_siswa' => $result_import[$i]['nis'],
                                'nominal' => $result_import[$i]['saldo_wisata'],
                                'jenis_tabungan' => 3,
                                'saldo' => $result_import[$i]['saldo_wisata'],
                                'catatan' => "transaksi import awal",
                                'tanggal_transaksi' => $result_import[$i]['tanggal_transaksi'],
                                'status_kredit_debet' => "1",
                                'th_ajaran' => $result_import[$i]['tahun_ajaran'],
                            );
                        }
                    }

                    $this->db2->insert_batch('transaksi_tabungan_umum', $transaksi_umum);
                    $this->db2->insert_batch('transaksi_tabungan_qurban', $transaksi_qurban);
                    $this->db2->insert_batch('transaksi_tabungan_wisata', $transaksi_wisata);

                    $this->SavingsModel->clear_import_data_personal_saving();

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil!, Seluruh Data Nasabah telah diimport ke database. Dimohon untuk melakukan <b>PENGECEKAN ULANG</b>. Terima Kasih.",
                    );

                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Terjadi Kesalahan, Silahkan import ulang..",
                    );
                }

            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opss!, Password Anda salah, Coba ulangi sekali lagi..",
                );
            }
        }
        echo json_encode($output);
    }

    public function reject_import_personal_saving()
    {

        $token = $this->security->get_csrf_hash();
        $input = $this->SavingsModel->clear_import_data_personal_saving();

        if ($input == true) {

            $output = array("status" => true,
                "token" => $token,
                "messages" => "Pemberitahuan!, Seluruh Data Nasabah batal diimport ke database. Terima Kasih.",
            );

        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf!, Terjadi Kesalahan, Silahkan import ulang..",
            );
        }
        echo json_encode($output);
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

    //-----------------------------------------------------------------------//
//
}
