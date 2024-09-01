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

    public function list_import_joint_saving()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['structure'] = $this->SavingsModel->get_structure_account();
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_import_joint_savings', $data);
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
                'message' => "NIS Nasabah telah digunakan sebelumnya",
            ));
        } else {
            $check_import = $this->SavingsModel->get_number_import_personal_saving($number);

            if ($check_import >= 2) {
                $isAvailable = false;
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "NIS <b>Duplikat</b> di File Excel",
                ));
            } else if ($check_import == 1 && ($number_old != $nis)) {
                $isAvailable = false;
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "NIS <b>Duplikat</b> di file Excel",
                ));
            } else {
                $isAvailable = true;
                echo json_encode(array(
                    'valid' => $isAvailable,
                ));
            }
        }
    }

    public function check_number_import_joint_saving()
    {

        $norek = $this->input->post('nomor_rekening_bersama');
        $number = $this->security->xss_clean($norek);

        $old_norek = $this->input->post('old_nomor_rekening_bersama');
        $number_old = $this->security->xss_clean($old_norek);

        $check = $this->SavingsModel->get_number_joint_saving($number);

        if ($check) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "Nomor Rekening telah digunakan sebelumnya",
            ));
        } else {
            $check_import = $this->SavingsModel->get_number_import_joint_saving($number);

            if ($check_import >= 2) {
                $isAvailable = false;
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "Nomor Rekening <b>Duplikat</b> di File Excel",
                ));
            } else if ($check_import == 1 && ($number_old != $number)) {
                $isAvailable = false;
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "Nomor Rekening <b>Duplikat</b> di File Excel",
                ));
            } else {
                $isAvailable = true;
                echo json_encode(array(
                    'valid' => $isAvailable,
                ));
            }
        }
    }

    public function check_name_import_personal_saving()
    {

        $nis = $this->input->post('nis_siswa');
        $number = $this->security->xss_clean($nis);

        $old_name = $this->input->post('old_nama');
        $old_name = $this->security->xss_clean($old_name);

        $name = $this->input->post('nama');
        $name = $this->security->xss_clean($name);

        $name = preg_replace("/['\"-]/", "", $name);
        $check = $this->SavingsModel->check_student_by_name_and_number($number, strtoupper($name));

        if ($check) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "Nama Nasabah dengan NIS <b>" . $nis . "</b> telah Terpakai",
            ));
        } else {
            $check_transition = $this->SavingsModel->get_number_name_import_personal_saving($number, strtoupper($name));

            if ($check_transition >= 2) {
                $isAvailable = false;
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "Nama Nasabah dengan NIS <b>" . $nis . "</b> duplikat di file Excel",
                ));
            } else if (($check_transition == 1) && (strtoupper($name) != strtoupper($old_name))) {
                $isAvailable = false;
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "Nama Nasabah dengan NIS <b>" . $nis . "</b> duplikat di file Excel",
                ));
            } else {
                $isAvailable = true;
                echo json_encode(array(
                    'valid' => $isAvailable,
                ));
            }
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

    public function get_all_import_joint_customer()
    {
        $data = $this->SavingsModel->get_all_import_joint_customer();

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
		$data['input_nama_nasabah'] = preg_replace("/['\"-]/", "", $data['input_nama_nasabah']);

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

                    if ($data['input_saldo_tabungan_umum'] >= 1000) {

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

                        if (!$input_umum['status']) {
                            $status_umum = "<b>Rp. $data[input_saldo_tabungan_umum], STATUS:</b> <b class='text-danger'>GAGAL</b>";
                        } else {
                            $status_umum = "<b>Rp. $data[input_saldo_tabungan_umum], STATUS:</b> <b class='text-success'>BERHASIL</b>";
                        }

                        $keterangan_umum = "<b>->TRANSAKSI DI TABUNGAN UMUM SEBESAR </b>$status_umum<br>";

                    } else if ($data['input_saldo_tabungan_umum'] == "" or $data['input_saldo_tabungan_umum'] == null or $data['input_saldo_tabungan_umum'] == 0) {

                        $keterangan_umum = "";
                    } else {

                        $keterangan_umum = "<b>->TRANSAKSI DI TABUNGAN UMUM SEBESAR Rp. $data[input_saldo_tabungan_umum], STATUS:</b> <b class='text-danger'>GAGAL</b> <b>(NOMINAL TIDAK BOLEH KURANG DARI 1000)</b><br>";
                    }

                    if ($data['input_saldo_tabungan_qurban'] >= 1000) {

                        $data_qurban = array(
                            'nomor_transaksi_qurban' => "TQ01/" . $random_number . "/" . date('YmdHis'),
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

                        if (!$input_qurban['status']) {
                            $status_qurban = "<b>Rp. $data[input_saldo_tabungan_qurban], STATUS:</b> <b class='text-danger'>GAGAL</b>";
                        } else {
                            $status_qurban = "<b>Rp. $data[input_saldo_tabungan_qurban], STATUS:</b> <b class='text-success'>BERHASIL</b>";
                        }
                        $keterangan_qurban = "<b>->TRANSAKSI DI TABUNGAN QURBAN SEBESAR </b>$status_qurban<br>";

                    } else if ($data['input_saldo_tabungan_qurban'] == "" or $data['input_saldo_tabungan_qurban'] == null or $data['input_saldo_tabungan_qurban'] == 0) {

                        $keterangan_qurban = "";
                    } else {

                        $keterangan_qurban = "<b>->TRANSAKSI DI TABUNGAN QURBAN SEBESAR Rp. $data[input_saldo_tabungan_umum], STATUS:</b> <b class='text-danger'>GAGAL</b> <b>(NOMINAL TIDAK BOLEH KURANG DARI 1000)</b><br>";
                    }

                    if ($data['input_saldo_tabungan_wisata'] >= 1000) {

                        $data_wisata = array(
                            'nomor_transaksi_wisata' => "TW01/" . $random_number . "/" . date('YmdHis'),
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

                        if (!$input_wisata['status']) {
                            $status_wisata = "<b>Rp. $data[input_saldo_tabungan_wisata], STATUS:</b> <b class='text-danger'>GAGAL</b>";
                        } else {
                            $status_wisata = "<b>Rp. $data[input_saldo_tabungan_wisata], STATUS:</b> <b class='text-success'>BERHASIL</b>";
                        }
                        $keterangan_wisata = "<b>->TRANSAKSI DI TABUNGAN WISATA SEBESAR </b>$status_wisata<br>";

                    } else if ($data['input_saldo_tabungan_wisata'] == "" or $data['input_saldo_tabungan_wisata'] == null or $data['input_saldo_tabungan_wisata'] == 0) {

                        $keterangan_wisata = "";
                    } else {

                        $keterangan_wisata = "<b>->TRANSAKSI DI TABUNGAN WISATA SEBESAR Rp. $data[input_saldo_tabungan_wisata], STATUS:</b> <b class='text-danger'>GAGAL</b> <b>(NOMINAL TIDAK BOLEH KURANG DARI 1000)</b><br>";
                    }

                    $transaction = array(
                        array(
                            "jenis_tabungan" => "UMUM",
                            "nomor_transaksi" => @$input_umum['data']->nomor_transaksi_umum,
                            "waktu_transaksi" => @date('d/m/Y H:i:s', strtotime(@$input_umum['data']->waktu_transaksi)),
                            "saldo" => @number_format((double) @$input_umum['data']->saldo, 0, ',', '.'),
                        ),
                        array(
                            "jenis_tabungan" => "QURBAN",
                            "nomor_transaksi" => @$input_qurban['data']->nomor_transaksi_qurban,
                            "waktu_transaksi" => @date('d/m/Y H:i:s', strtotime($input_qurban['data']->waktu_transaksi)),
                            "saldo" => @number_format((double) @$input_qurban['data']->saldo, 0, ',', '.'),
                        ),
                        array(
                            "jenis_tabungan" => "WISATA",
                            "nomor_transaksi" => $input_wisata['data']->nomor_transaksi_wisata,
                            "waktu_transaksi" => @date('d/m/Y H:i:s', strtotime(@$input_wisata['data']->waktu_transaksi)),
                            "saldo" => @number_format((double) @$input_wisata['data']->saldo, 0, ',', '.'),
                        ),
                    );

                    $trans_msg = array("nama_nasabah" => $data['input_nama_nasabah'],
                        "nomor_rekening" => $data['input_nomor_rekening'],
                        "tingkat" => $data['input_tingkat'],
                        "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_umum['data']->waktu_transaksi)),
                        "array_transaction" => $transaction);

                    $trans_msg_json = json_encode($trans_msg);

                    $this->session->set_flashdata('print_transaction', $trans_msg_json);
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
        $data['input_nama_tabungan_bersama'] = preg_replace("/['\"-]/", "", $data['input_nama_tabungan_bersama']);

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/savings/add_joint_saving');
        } else {

            $check_number = $this->SavingsModel->get_number_joint_saving($data['input_nomor_rekening_bersama']);

            if (empty($check_number)) {

                $input = $this->SavingsModel->insert_joint_saving($this->user_finance[0]->id_akun_keuangan, $data);

                if ($input == true) {

                    if ($data['input_nominal_saldo'] != "" or $data['input_nominal_saldo'] >= 1000 or $data['input_nominal_saldo'] != null) {

                        $data['saldo_akhir'] = $data['input_nominal_saldo'];

                        $transaksi = $this->SavingsModel->insert_joint_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);

                        if (!$transaksi['status']) {
                            $status_transaksi = "<b>Rp. $data[input_nominal_saldo], STATUS:</b> <b class='text-danger'>GAGAL</b> <b>(SYSTEM ERROR!)</b>";
                        } else {
                            $status_transaksi = "<b>Rp. $data[input_nominal_saldo], STATUS:</b> <b class='text-success'>BERHASIL</b>";
                        }

                        $transaksi_bersama = "<b>TRANSAKSI DI TABUNGAN BERSAMA SEBESAR </b>$status_transaksi<br>";
                    } else {

                        $transaksi_bersama = "<b>->TRANSAKSI DI TABUNGAN WISATA SEBESAR Rp. $data[input_nominal_saldo], STATUS:</b> <b class='text-danger'>GAGAL</b> <b>(NOMINAL TIDAK BOLEH KURANG DARI 1000)</b><br>";
                    }

                    $trans_msg = array("nama_tabungan" => strtoupper($data['input_nama_tabungan_bersama']),
                        "nomor_rekening" => $data['input_nomor_rekening_bersama'],
                        "tingkat" => $data['input_tingkat'],
                        "nomor_transaksi" => $transaksi['data']->nomor_transaksi_bersama,
                        "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($transaksi['data']->waktu_transaksi)),
                        "saldo" => $transaksi['data']->saldo);

                    $this->session->set_flashdata('print_transaction', $trans_msg);
                    $this->session->set_flashdata('flash_message', succ_msg("Data Tabungan Bersama Baru <b>'ATAS NAMA: " . strtoupper($data['input_nama_tabungan_bersama']) . ", NOREK: $data[input_nomor_rekening_bersama]'</b> telah ditambahakan dengan Rincian Transaksi berikut: <br>$transaksi_bersama <br><b class='text-danger'>*Silahkan cek Data Nasabah Bersama di menu Daftar Tabungan Bersama, Terima Kasih.</b>"));

                    redirect('finance/savings/list_joint_saving');
                } else {

                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan lakukan input ulang.'));
                    redirect('finance/savings/add_joint_saving');
                }

            } else {
                $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Nomor Rekening Telah Digunakan, Silahkan inputkan nomor rekening lain.'));
                redirect('finance/savings/add_joint_saving');
            }
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_kredit'], $check_pin[0]->pin_akun)) {

                    if ($get_balance[0]->saldo_tabungan_bersama == 0) {

                        $data['saldo_akhir'] = $data['input_nominal_saldo'];

                    } else if ($data['input_nominal_saldo'] < 1000) {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                        echo json_encode($output);
                        exit();

                    } else {

                        $data['saldo_akhir'] = $data['input_nominal_saldo'] + $get_balance[0]->saldo_tabungan_bersama;
                    }

                    $input_credit = $this->SavingsModel->insert_joint_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);
                    $update_balance = $this->SavingsModel->update_balance_joint_saving($data['input_nomor_rekening_bersama'], $data['saldo_akhir']);

                    if ($input_credit['status'] == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "nomor_transaksi" => $input_credit['data']->nomor_transaksi_bersama,
                            "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_credit['data']->waktu_transaksi)),
                            "saldo_akhir" => $input_credit['data']->saldo,
                            "messages" => "Berhasil Disetor!, Setor Tabungan Bersama Atas Nama <b>" . $get_balance[0]->nama_tabungan_bersama . " (" . $get_balance[0]->nomor_rekening_bersama . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Bersama.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_kredit'], $check_pin[0]->pin_akun)) {

                    if ($get_balance[0]->saldo_tabungan_umum == 0) {

                        $data['saldo_akhir'] = $data['nominal'];

                    } else if ($data['nominal'] < 1000) {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                        echo json_encode($output);
                        exit();

                    } else {

                        $data['saldo_akhir'] = $data['nominal'] + $get_balance[0]->saldo_tabungan_umum;

                    }

                    $input_credit = $this->SavingsModel->insert_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);
                    $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($input_credit['status'] == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "nomor_transaksi" => $input_credit['data']->nomor_transaksi_umum,
                            "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_credit['data']->waktu_transaksi)),
                            "saldo_akhir" => $input_credit['data']->saldo,
                            "messages" => "Berhasil Disetor!, Setor Tabungan Umum Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Umum.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);

                if (password_verify($data['pin_verification_kredit'], $check_pin[0]->pin_akun)) {

                    if ($get_balance[0]->saldo_tabungan_qurban == 0) {

                        $data['saldo_akhir'] = $data['nominal'];

                    } else if ($data['nominal'] < 1000) {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                        echo json_encode($output);
                        exit();

                    } else {

                        $data['saldo_akhir'] = $data['nominal'] + $get_balance[0]->saldo_tabungan_qurban;

                    }

                    $input_credit = $this->SavingsModel->insert_qurban_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);
                    $update_balance = $this->SavingsModel->update_qurban_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($input_credit['status'] == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "nomor_transaksi" => $input_credit['data']->nomor_transaksi_qurban,
                            "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_credit['data']->waktu_transaksi)),
                            "saldo_akhir" => $input_credit['data']->saldo,
                            "messages" => "Berhasil Disetor!, Setor Tabungan Qurban Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Qurban.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);

                if (password_verify($data['pin_verification_kredit'], $check_pin[0]->pin_akun)) {

                    if ($get_balance[0]->saldo_tabungan_wisata == 0) {

                        $data['saldo_akhir'] = $data['nominal'];

                    } else if ($data['nominal'] < 1000) {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                        echo json_encode($output);
                        exit();

                    } else {

                        $data['saldo_akhir'] = $data['nominal'] + $get_balance[0]->saldo_tabungan_wisata;

                    }

                    $input_credit = $this->SavingsModel->insert_tour_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);
                    $update_balance = $this->SavingsModel->update_tour_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($input_credit['status'] == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "nomor_transaksi" => $input_credit['data']->nomor_transaksi_wisata,
                            "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_credit['data']->waktu_transaksi)),
                            "saldo_akhir" => $input_credit['data']->saldo,
                            "messages" => "Berhasil Disetor!, Setor Tabungan Wisata Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Wisata.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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
        $data['nama_nasabah'] = preg_replace("/['\"-]/", "", $data['nama_nasabah']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {
                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_kredit'], $check_pin[0]->pin_akun)) {

                    $data['saldo_akhir'] = $data['nominal'];

                    $input_client = $this->SavingsModel->insert_client($data);
                    $input_credit = $this->SavingsModel->insert_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);

                    if ($input_client == true && $input_credit['status'] == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "nomor_transaksi" => $input_credit['data']->nomor_transaksi_umum,
                            "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_credit['data']->waktu_transaksi)),
                            "saldo_akhir" => $input_credit['data']->saldo,
                            "messages" => "Berhasil Disetor!, Setor Tabungan Umum Atas Nama <b>" . $data['nama_nasabah'] . " (" . $data['nis'] . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Umum.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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
        $data['nama_nasabah'] = preg_replace("/['\"-]/", "", $data['nama_nasabah']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_kredit'], $check_pin[0]->pin_akun)) {

                    $data['saldo_akhir'] = $data['nominal'];

                    $input_client = $this->SavingsModel->insert_qurban_client($data);
                    $input_credit = $this->SavingsModel->insert_qurban_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);

                    if ($input_client == true && $input_credit['status'] == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "nomor_transaksi" => $input_credit['data']->nomor_transaksi_qurban,
                            "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_credit['data']->waktu_transaksi)),
                            "saldo_akhir" => $input_credit['data']->saldo,
                            "messages" => "Berhasil Disetor!, Setor Tabungan Qurban Atas Nama <b>" . $data['nama_nasabah'] . " (" . $data['nis'] . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Qurban.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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
        $data['nama_nasabah'] = preg_replace("/['\"-]/", "", $data['nama_nasabah']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_kredit'], $check_pin[0]->pin_akun)) {

                    $data['saldo_akhir'] = $data['nominal'];

                    $input_client = $this->SavingsModel->insert_tour_client($data);
                    $input_credit = $this->SavingsModel->insert_tour_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);

                    if ($input_client == true && $input_credit['status'] == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "nomor_transaksi" => $input_credit['data']->nomor_transaksi_qurban,
                            "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_credit['data']->waktu_transaksi)),
                            "saldo_akhir" => $input_credit['data']->saldo,
                            "messages" => "Berhasil Disetor!, Setor Tabungan Wisata Atas Nama <b>" . $data['nama_nasabah'] . " (" . $data['nis'] . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Wisata.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_kredit_edit'], $check_pin[0]->pin_akun)) {

                    if (($get_balance[0]->saldo_tabungan_bersama - $get_transaction[0]->nominal) == 0) {

                        $data['saldo_akhir'] = $data['input_nominal_saldo'];

                    } else if ($data['input_nominal_saldo'] < 1000) {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                        echo json_encode($output);
                        exit();

                    } else {

                        $data['saldo_akhir'] = $data['input_nominal_saldo'] + ($get_balance[0]->saldo_tabungan_bersama - $get_transaction[0]->nominal);

                    }

                    $update_credit = $this->SavingsModel->update_credit_joint_saving($data['input_id_transaksi_bersama'], $data);
                    $update_balance = $this->SavingsModel->update_balance_joint_saving($data['input_nomor_rekening_bersama'], $data['saldo_akhir']);

                    if ($update_credit == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "nomor_transaksi" => $get_transaction[0]->nomor_transaksi_bersama,
                            "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($get_transaction[0]->waktu_transaksi)),
                            "saldo_akhir" => $data['saldo_akhir'],
                            "messages" => "Berhasil Diubah!, Perubahan Setor Tabungan Bersama Atas Nama <b>" . $get_balance[0]->nama_tabungan_bersama . " (" . $get_balance[0]->nomor_rekening_bersama . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Bersama.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_kredit_edit'], $check_pin[0]->pin_akun)) {

                    if (($get_balance[0]->saldo_tabungan_umum - $get_transaction[0]->nominal) == 0) {

                        $data['saldo_akhir'] = $data['nominal'];

                    } else if ($data['nominal'] < 1000) {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                        echo json_encode($output);
                        exit();

                    } else {

                        $data['saldo_akhir'] = $data['nominal'] + ($get_balance[0]->saldo_tabungan_umum - $get_transaction[0]->nominal);

                    }

                    $update_credit = $this->SavingsModel->update_credit_saving($data['id_transaksi'], $data);
                    $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($update_credit == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "nomor_transaksi" => $get_transaction[0]->nomor_transaksi_umum,
                            "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($get_transaction[0]->waktu_transaksi)),
                            "saldo_akhir" => $data['saldo_akhir'],
                            "messages" => "Berhasil Diubah!, Perubahan Setor Tabungan Umum Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Umum.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_kredit_edit'], $check_pin[0]->pin_akun)) {

                    if (($get_balance[0]->saldo_tabungan_qurban - $get_transaction[0]->nominal) == 0) {

                        $data['saldo_akhir'] = $data['nominal'];

                    } else if ($data['nominal'] < 1000) {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                        echo json_encode($output);
                        exit();

                    } else {

                        $data['saldo_akhir'] = $data['nominal'] + ($get_balance[0]->saldo_tabungan_qurban - $get_transaction[0]->nominal);

                    }

                    $update_credit = $this->SavingsModel->update_qurban_credit_saving($data['id_transaksi'], $data);
                    $update_balance = $this->SavingsModel->update_qurban_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($update_credit == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "nomor_transaksi" => $get_transaction[0]->nomor_transaksi_qurban,
                            "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($get_transaction[0]->waktu_transaksi)),
                            "saldo_akhir" => $data['saldo_akhir'],
                            "messages" => "Berhasil Diubah!, Perubahan Setor Tabungan Qurban Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Qurban.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_kredit_edit'], $check_pin[0]->pin_akun)) {

                    if (($get_balance[0]->saldo_tabungan_wisata - $get_transaction[0]->nominal) == 0) {

                        $data['saldo_akhir'] = $data['nominal'];

                    } else if ($data['nominal'] < 1000) {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                        echo json_encode($output);
                        exit();

                    } else {

                        $data['saldo_akhir'] = $data['nominal'] + ($get_balance[0]->saldo_tabungan_wisata - $get_transaction[0]->nominal);

                    }

                    $update_credit = $this->SavingsModel->update_tour_credit_saving($data['id_transaksi'], $data);
                    $update_balance = $this->SavingsModel->update_tour_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($update_credit == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "nomor_transaksi" => $get_transaction[0]->nomor_transaksi_wisata,
                            "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($get_transaction[0]->waktu_transaksi)),
                            "saldo_akhir" => $data['saldo_akhir'],
                            "messages" => "Berhasil Diubah!, Perubahan Setor Tabungan Wisata Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Wisata.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_debet'], $check_pin[0]->pin_akun)) {

                    if (($get_balance[0]->saldo_tabungan_bersama > 0) && ($data['input_nominal_saldo'] <= $get_balance[0]->saldo_tabungan_bersama)) {

                        $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_bersama - $data['input_nominal_saldo'];

                        $input_debet = $this->SavingsModel->insert_debet_joint_saving($this->user_finance[0]->id_akun_keuangan, $data);
                        $update_balance = $this->SavingsModel->update_balance_joint_saving($data['input_nomor_rekening_bersama'], $data['saldo_akhir']);

                        if ($input_debet['status'] == true && $update_balance == true) {

                            $output = array("status" => true,
                                "token" => $token,
                                "nomor_transaksi" => $input_debet['data']->nomor_transaksi_bersama,
                                "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_debet['data']->waktu_transaksi)),
                                "saldo_akhir" => $input_debet['data']->saldo,
                                "messages" => "Berhasil Ditarik!, Penarikan Tabungan Bersama Atas Nama <b>" . $get_balance[0]->nama_tabungan_bersama . " (" . $get_balance[0]->nomor_rekening_bersama . ")</b> telah ditarik. Silahkan cek Rekap/Histori Tabungan Bersama  di Menu Daftar Tabungan Bersama.",
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
                    } else if (($data['input_nominal_saldo'] < 1000)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                    } else if (($data['input_nominal_saldo'] > $get_balance[0]->saldo_tabungan_bersama)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                        );

                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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
                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_debet'], $check_pin[0]->pin_akun)) {

                    if (($get_balance[0]->saldo_tabungan_umum > 0) && ($data['nominal'] <= $get_balance[0]->saldo_tabungan_umum)) {

                        $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_umum - $data['nominal'];

                        $input_debet = $this->SavingsModel->insert_debet_saving($this->user_finance[0]->id_akun_keuangan, $data);
                        $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);

                        if ($input_debet['status'] == true && $update_balance == true) {

                            $output = array("status" => true,
                                "token" => $token,
                                "nomor_transaksi" => $input_debet['data']->nomor_transaksi_umum,
                                "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_debet['data']->waktu_transaksi)),
                                "saldo_akhir" => $input_debet['data']->saldo,
                                "messages" => "Berhasil Ditarik!, Penarikan Tabungan Umum Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditarik. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Umum.",
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
                    } else if (($data['nominal'] < 1000)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                    } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_umum)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                        );

                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_debet'], $check_pin[0]->pin_akun)) {

                    if (($get_balance[0]->saldo_tabungan_qurban > 0) && ($data['nominal'] <= $get_balance[0]->saldo_tabungan_qurban)) {

                        $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_qurban - $data['nominal'];

                        $input_debet = $this->SavingsModel->insert_qurban_debet_saving($this->user_finance[0]->id_akun_keuangan, $data);
                        $update_balance = $this->SavingsModel->update_qurban_balance_saving($data['nis'], $data['saldo_akhir']);

                        if ($input_debet['status'] == true && $update_balance == true) {

                            $output = array("status" => true,
                                "token" => $token,
                                "nomor_transaksi" => $input_debet['data']->nomor_transaksi_qurban,
                                "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_debet['data']->waktu_transaksi)),
                                "saldo_akhir" => $input_debet['data']->saldo,
                                "messages" => "Berhasil Ditarik!, Penarikan Tabungan Qurban Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditarik. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Qurban.",
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
                    } else if (($data['nominal'] < 1000)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                    } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_qurban)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                        );
                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_debet'], $check_pin[0]->pin_akun)) {

                    if (($get_balance[0]->saldo_tabungan_wisata > 0) && ($data['nominal'] <= $get_balance[0]->saldo_tabungan_wisata)) {

                        $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_wisata - $data['nominal'];

                        $input_debet = $this->SavingsModel->insert_tour_debet_saving($this->user_finance[0]->id_akun_keuangan, $data);
                        $update_balance = $this->SavingsModel->update_tour_balance_saving($data['nis'], $data['saldo_akhir']);

                        if ($input_debet['status'] == true && $update_balance == true) {

                            $output = array("status" => true,
                                "token" => $token,
                                "nomor_transaksi" => $input_debet['data']->nomor_transaksi_wisata,
                                "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($input_debet['data']->waktu_transaksi)),
                                "saldo_akhir" => $input_debet['data']->saldo,
                                "messages" => "Berhasil Ditarik!, Penarikan Tabungan Wisata Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah ditarik. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Wisata.",
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
                    } else if (($data['nominal'] < 1000)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                    } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_wisata)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                        );

                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_debet_edit'], $check_pin[0]->pin_akun)) {

                    if ((($get_transaction[0]->saldo + $get_transaction[0]->nominal) > 0) && ($data['input_nominal_saldo'] <= ($get_transaction[0]->saldo + $get_transaction[0]->nominal))) {

                        $data['saldo_akhir'] = ($get_transaction[0]->saldo + $get_transaction[0]->nominal) - $data['input_nominal_saldo'];

                        $update_debet = $this->SavingsModel->update_debet_joint_saving($data['input_id_transaksi_bersama'], $data);
                        $update_balance = $this->SavingsModel->update_balance_joint_saving($data['input_nomor_rekening_bersama'], $data['saldo_akhir']);

                        if ($update_debet == true && $update_balance == true) {

                            $output = array("status" => true,
                                "token" => $token,
                                "nomor_transaksi" => $get_transaction[0]->nomor_transaksi_bersama,
                                "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($get_transaction[0]->waktu_transaksi)),
                                "saldo_akhir" => $data['saldo_akhir'],
                                "messages" => "Berhasil Diubah!, Perubahan Penarikan Tabungan Bersama Atas Nama <b>" . $get_balance[0]->nama_tabungan_bersama . " (" . $get_balance[0]->nomor_rekening_bersama . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Bersama.",
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
                    } else if (($data['input_nominal_saldo'] < 1000)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                    } else if (($data['input_nominal_saldo'] > $get_balance[0]->saldo_tabungan_bersama)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                        );

                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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
                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_debet_edit'], $check_pin[0]->pin_akun)) {

                    if ((($get_transaction[0]->saldo + $get_transaction[0]->nominal) > 0) && ($data['nominal'] <= ($get_transaction[0]->saldo + $get_transaction[0]->nominal))) {

                        $data['saldo_akhir'] = ($get_transaction[0]->saldo + $get_transaction[0]->nominal) - $data['nominal'];

                        $update_debet = $this->SavingsModel->update_debet_saving($data['id_transaksi'], $data);
                        $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);

                        if ($update_debet == true && $update_balance == true) {

                            $output = array("status" => true,
                                "token" => $token,
                                "nomor_transaksi" => $get_transaction[0]->nomor_transaksi_umum,
                                "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($get_transaction[0]->waktu_transaksi)),
                                "saldo_akhir" => $data['saldo_akhir'],
                                "messages" => "Berhasil Diubah!, Perubahan Penarikan Tabungan Umum Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Umum.",
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
                    } else if (($data['nominal'] < 1000)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                    } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_umum)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                        );

                    }
                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_debet_edit'], $check_pin[0]->pin_akun)) {

                    if ((($get_transaction[0]->saldo + $get_transaction[0]->nominal) > 0) && ($data['nominal'] <= ($get_transaction[0]->saldo + $get_transaction[0]->nominal))) {

                        $data['saldo_akhir'] = ($get_transaction[0]->saldo + $get_transaction[0]->nominal) - $data['nominal'];

                        $update_debet = $this->SavingsModel->update_qurban_debet_saving($data['id_transaksi'], $data);
                        $update_balance = $this->SavingsModel->update_qurban_balance_saving($data['nis'], $data['saldo_akhir']);

                        if ($update_debet == true && $update_balance == true) {

                            $output = array("status" => true,
                                "token" => $token,
                                "nomor_transaksi" => $get_transaction[0]->nomor_transaksi_qurban,
                                "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($get_transaction[0]->waktu_transaksi)),
                                "saldo_akhir" => $data['saldo_akhir'],
                                "messages" => "Berhasil Diubah!, Perubahan Penarikan Tabungan Qurban Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Qurban.",
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
                    } else if (($data['nominal'] < 1000)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                    } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_qurban)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                        );

                    }

                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

                $check_pin = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_debet_edit'], $check_pin[0]->pin_akun)) {

                    if ((($get_transaction[0]->saldo + $get_transaction[0]->nominal) > 0) && ($data['nominal'] <= ($get_transaction[0]->saldo + $get_transaction[0]->nominal))) {

                        $data['saldo_akhir'] = ($get_transaction[0]->saldo + $get_transaction[0]->nominal) - $data['nominal'];

                        $update_debet = $this->SavingsModel->update_tour_debet_saving($data['id_transaksi'], $data);
                        $update_balance = $this->SavingsModel->update_tour_balance_saving($data['nis'], $data['saldo_akhir']);

                        if ($update_debet == true && $update_balance == true) {

                            $output = array("status" => true,
                                "token" => $token,
                                "nomor_transaksi" => $get_transaction[0]->nomor_transaksi_wisata,
                                "waktu_transaksi" => date('d/m/Y H:i:s', strtotime($get_transaction[0]->waktu_transaksi)),
                                "saldo_akhir" => $data['saldo_akhir'],
                                "messages" => "Berhasil Diubah!, Perubahan Penarikan Tabungan Wisata Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Wisata.",
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
                    } else if (($data['nominal'] < 1000)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        );

                    } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_wisata)) {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                        );

                    }

                } else {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf., PIN Anda salah!",
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

            if ($data['nomor_rekening_bersama'] && $data['id_transaksi_bersama'] && $data['password']) {

                $check_pass = $this->SavingsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['password'], $check_pass[0]->password)) {

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
                        "messages" => "Opps!, Password Anda Salah, Silahkan coba lagi.",
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

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi'] && $data['password']) {

                $check_pass = $this->SavingsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['password'], $check_pass[0]->password)) {

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
                        "messages" => "Opps!, Password Anda Salah, Silahkan coba lagi.",
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

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi'] && $data['password']) {

                $check_pass = $this->SavingsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['password'], $check_pass[0]->password)) {

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
                        "messages" => "Opps!, Password Anda Salah, Silahkan coba lagi.",
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

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi'] && $data['password']) {

                $check_pass = $this->SavingsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['password'], $check_pass[0]->password)) {

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
                        "messages" => "Opps!, Password Anda Salah, Silahkan coba lagi.",
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

            if ($data['nomor_rekening_bersama'] && $data['id_transaksi_bersama'] && $data['password']) {

                $check_pass = $this->SavingsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['password'], $check_pass[0]->password)) {

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
                        "messages" => "Opps!, Password Anda Salah, Silahkan coba lagi.",
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

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi'] && $data['password']) {

                $check_pass = $this->SavingsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['password'], $check_pass[0]->password)) {

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
                        "messages" => "Opps!, Password Anda Salah, Silahkan coba lagi.",
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

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi'] && $data['password']) {

                $check_pass = $this->SavingsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['password'], $check_pass[0]->password)) {

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
                        "messages" => "Opps!, Password Anda Salah, Silahkan coba lagi.",
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

            if ($data['nis'] && $data['id_transaksi'] && $data['nomor_transaksi'] && $data['password']) {

                $check_pass = $this->SavingsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['password'], $check_pass[0]->password)) {

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
                        "messages" => "Opps!, Password Anda Salah, Silahkan coba lagi.",
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

    public function update_import_personal_saving()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $data['nama_nasabah'] = preg_replace("/['\"-]/", "", $data['nama_nasabah']);

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
                    if ($check_import >= 2) {
                        $data['status_nasabah'] = '3';
                    } else if ($check_import == 1 && ($data['nis'] != $data['old_nis'])) {
                        $data['status_nasabah'] = '3';
                    } else {
                        $data['status_nasabah'] = '2';
                    }
                }

                $check_transition = $this->SavingsModel->get_number_name_import_personal_saving($data['nis'], strtoupper($data['nama_nasabah']));
                if ($check_transition >= 2) {
                    $data['status_nama_nasabah'] = '3';
                } else if (($check_transition == 1) && (strtoupper($data['nama_nasabah']) != strtoupper($data['old_nama_nasabah']))) {
                    $data['status_nama_nasabah'] = '3';
                } else {
                    $result = $this->SavingsModel->check_match_name(trim($data['nama_nasabah']));

                    if ($result) {
                        for ($j = 0; $j < count($result); $j++) {
                            $score = $this->matching->single_text_match(strtoupper(trim($result[$j]->nama_lengkap)), strtoupper(trim($data['nama_nasabah'])));
                            if ($score >= 80 && $score <= 100) {
                                $data['status_nama_nasabah'] = '1';
                                break;
                            } else {
                                $data['status_nama_nasabah'] = '2';
                                break;
                            }
                        }
                    } else {
                        $data['status_nama_nasabah'] = '2';
                        // var_dump($data);exit;
                    }
                }

                $check_student_name_and_number = $this->SavingsModel->check_student_by_name_and_number(trim($data['nis']), trim($data['nama_nasabah']));
                if ($check_student_name_and_number) {
                    $data['password'] = $check_student_name_and_number[0]->password;
                    $data['status_nama_nasabah'] = '4';
                } else {
                    $data['password'] = password_hash(paramEncrypt(trim($data['nis'])), PASSWORD_DEFAULT, array('cost' => 12));
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

            $this->db->query('SET SESSION interactive_timeout = 28000');
            $this->db->query('SET SESSION wait_timeout = 28000');
            $this->db2->query('SET SESSION interactive_timeout = 28000');
            $this->db2->query('SET SESSION wait_timeout = 28000');
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
                        $password = '';
                        $status_nama = "";

                        $data_array = array();
                        // Initialize arrays for tracking

                        $seenNIS = [];
                        $duplicateNIS = [];

                        $seenName = [];
                        $duplicateName = [];

                        for ($i = 1; $i < count($sheetData); $i++) {

                            $currentName = trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1']));
                            $currentNIS = trim($sheetData[$i]['0']);

                            $student = $this->SavingsModel->get_student_nis($sheetData[$i]['0']);

                            if (!$student) {

                                if (isset($seenName[$currentName])) {
                                    $duplicateName[$currentName] = true;
                                    $status_nama = 3;
                                } else {
                                    $seenName[$currentName] = true;
                                    $result = $this->SavingsModel->check_match_name(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1'])));
                                    if ($result) {
                                        for ($j = 0; $j < count($result); $j++) {
                                            $score = $this->matching->single_text_match(strtoupper($result[$j]->nama_lengkap), strtoupper(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1']))));
                                            if ($score >= 80 && $score <= 100) {
                                                $status_nama = 1;
                                                break;
                                            } else {
                                                $status_nama = 2;
                                                break;
                                            }
                                        }
                                    } else {
                                        $status_nama = 2;
                                    }
                                }

                                if (isset($seenNIS[$currentNIS])) {
                                    $duplicateNIS[$currentNIS] = true;
                                    $status_nis = 3;
                                } else {
                                    $seenNIS[$currentNIS] = true;
                                    $status_nis = 2;
                                }

                                $password = password_hash(paramEncrypt(trim($sheetData[$i]['0'])), PASSWORD_DEFAULT, array('cost' => 12));
                            } else {

                                $status_nis = 1;
                                if (isset($seenName[$currentName])) {
                                    $duplicateName[$currentName] = true;
                                    $status_nama = 3;
                                } else {
                                    $seenName[$currentName] = true;
                                    $result = $this->SavingsModel->check_match_name(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1'])));
                                    if ($result) {
                                        for ($j = 0; $j < count($result); $j++) {
                                            $score = $this->matching->single_text_match(strtoupper($result[$j]->nama_lengkap), strtoupper(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1']))));
                                            if ($score >= 80 && $score <= 100) {
                                                $status_nama = 1;
                                                break;
                                            } else {
                                                $status_nama = 2;
                                                break;
                                            }
                                        }
                                    } else {
                                        $status_nama = 2;
                                    }
                                }

                                $check_student_name_and_number = $this->SavingsModel->check_student_by_name_and_number(trim($sheetData[$i]['0']), trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1'])));
                                if ($check_student_name_and_number) {
                                    $password = $student[0]->password;
                                    $status_nama = 4;
                                } else {
                                    $password = password_hash(paramEncrypt(trim($sheetData[$i]['0'])), PASSWORD_DEFAULT, array('cost' => 12));
                                }
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
                                    'password' => (trim($password)),
                                    'nama_nasabah' => (filter_var(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1'])), FILTER_SANITIZE_STRING)),
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
                                    'status_nama_nasabah' => (filter_var(trim($status_nama), FILTER_SANITIZE_STRING)),
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
                $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf., PIN Anda salah!'));
                redirect('finance/savings/list_personal_saving');
            }
        }
    }

    public function update_import_joint_saving()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['id_nasabah_bersama'] == "" or empty($data['id_nasabah_bersama']) or $data['id_nasabah_bersama'] == null) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                $check_norek = $this->SavingsModel->get_number_joint_saving($data['nomor_rekening_bersama']);
                if ($check_norek) {
                    $data['status_nasabah'] = '1';
                } else {
                    $check_import = $this->SavingsModel->get_number_import_joint_saving($data['nomor_rekening_bersama']);
                    if ($check_import >= 2) {
                        $data['status_nasabah'] = '3';
                    } else if ($check_import == 1 && ($data['old_nomor_rekening_bersama'] != $data['nomor_rekening_bersama'])) {
                        $data['status_nasabah'] = '3';
                    } else {
                        $data['status_nasabah'] = '2';
                    }
                }

                $check_pj = $this->SavingsModel->get_number_personal_saving($data['id_siswa_penanggung_jawab']);
                if ($check_pj) {
                    $data['status_pj'] = '1';
                } else {
                    $data['status_pj'] = '2';
                }

                $update_joint = $this->SavingsModel->update_import_joint_saving($data['id_nasabah_bersama'], $data);

                if ($update_joint == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Diubah!, Perubahan Data Import Tabungan Bersama Atas Nama <b>" . $data['nama_tabungan_bersama'] . " (" . $data['nomor_rekening_bersama'] . ")</b> telah diubah. Silahkan cek Hasil Data Import.",
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

    public function import_joint_saving()
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
            redirect('finance/savings/list_joint_saving');
        } else {
            $check_pass = $this->SavingsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);

            // pass verify
            if (password_verify(($data['pin_verification']), $check_pass[0]->pin_akun)) {
                // gcaptha verify
                if ($this->googleCaptachStore($recaptchaResponse, $userIp) == 1) {

                    $this->db->query('SET SESSION interactive_timeout = 28000');
                    $this->db->query('SET SESSION wait_timeout = 28000');
                    $this->db2->query('SET SESSION interactive_timeout = 28000');
                    $this->db2->query('SET SESSION wait_timeout = 28000');

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

                    if (isset($_FILES['file_joint_saving']['name']) && in_array($_FILES['file_joint_saving']['type'], $file_mimes)) {
                        $this->SavingsModel->clear_import_data_joint_saving();

                        $arr_file = explode('.', $_FILES['file_joint_saving']['name']);
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
                        $spreadsheet = $reader->load($_FILES['file_joint_saving']['tmp_name']);
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();

                        $status_nis = '';
                        $status_norek = '';
                        $tingkat = '';

                        $data_array = array();

                        $seenNorek = [];
                        $duplicateNorek = [];

                        for ($i = 1; $i < count($sheetData); $i++) {

                            $currentNorek = trim($sheetData[$i]['0']);

                            $student = $this->SavingsModel->get_student_nis($sheetData[$i]['1']);
                            if ($student) {
                                $status_nis = '1';
                            } else {
                                $status_nis = '2';
                            }

                            $norek = $this->SavingsModel->get_number_joint_saving($sheetData[$i]['0']);
                            if (!$norek) {

                                if (isset($seenNorek[$currentNorek])) {
                                    $duplicateNorek[$currentNorek] = true;
                                    $status_norek = '3';
                                } else {
                                    $seenNorek[$currentNorek] = true;
                                    $status_norek = '2';
                                }
                            } else {
                                $status_norek = '1';
                            }

                            if (strtoupper($sheetData[$i]['4']) == 'DC') {
                                $tingkat = '6';
                            } else if (strtoupper($sheetData[$i]['4']) == 'KB') {
                                $tingkat = '1';
                            } else if (strtoupper($sheetData[$i]['4']) == 'TK') {
                                $tingkat = '2';
                            } else if (strtoupper($sheetData[$i]['4']) == 'SD') {
                                $tingkat = '3';
                            } else if (strtoupper($sheetData[$i]['4']) == 'SMP') {
                                $tingkat = '4';
                            }

                            if ($sheetData[$i]['0']) {
                                $data_array[$i] = array(
                                    'id_pegawai' => (filter_var(trim($this->user_finance[0]->id_akun_keuangan), FILTER_SANITIZE_STRING)),
                                    'nomor_rekening_bersama' => (filter_var(trim($sheetData[$i]['0']), FILTER_SANITIZE_STRING)),
                                    'id_siswa_penanggung_jawab' => (filter_var(trim($sheetData[$i]['1']), FILTER_SANITIZE_STRING)),
                                    'nama_tabungan_bersama' => (filter_var(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['2'])), FILTER_SANITIZE_STRING)),
                                    'saldo_bersama' => (filter_var(trim($sheetData[$i]['3']), FILTER_SANITIZE_STRING)),
                                    'tahun_ajaran' => (filter_var(trim($data['input_tahun_ajaran']), FILTER_SANITIZE_STRING)),
                                    'tingkat' => (filter_var(trim($tingkat), FILTER_SANITIZE_STRING)),
                                    'tanggal_transaksi' => (filter_var(trim($data['input_tanggal_transaksi']), FILTER_SANITIZE_STRING)),
                                    'nama_wali' => (filter_var(trim($sheetData[$i]['5']), FILTER_SANITIZE_STRING)),
                                    'nomor_hp_wali' => (filter_var(trim($sheetData[$i]['6']), FILTER_SANITIZE_STRING)),
                                    'keterangan_bersama' => ("tabungan bersama penanggung jawab nis: " . trim($sheetData[$i]['1'])),
                                    'status_nasabah_bersama' => (filter_var(trim($status_norek), FILTER_SANITIZE_STRING)),
                                    'status_penanggung_jawab' => (filter_var(trim($status_nis), FILTER_SANITIZE_STRING)),
                                );
                            }
                        }

                        $import_data = $this->db2->insert_batch('import_nasabah_bersama', $data_array);

                        if ($import_data == true) {

                            $this->session->set_flashdata('flash_message', warn_msg("Peringatan!, File <b>" . $_FILES['file_joint_saving']['name'] . "</b> Telah diproses, Silahkan melakukan <b>PENGECEKAN & PERSETUJUAN</b> untuk mengimpor seluruh data file tersebut. Jika terjadi ketidaksamaan dengan Data Asli, dimohon untuk <b>MENGUBAH DATA</b>. Terima Kasih"));
                            redirect('finance/savings/list_import_joint_saving/' . paramEncrypt("sekolah_utsman"));
                        } else {

                            $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan import ulang...'));
                            redirect('finance/savings/list_joint_saving');
                        }
                    } else {

                        $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Silahkan Import file berformat csv/xls/xlsx'));
                        redirect('finance/savings/list_joint_saving');
                    }
                } else {

                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Google Recaptcha terdapat kesalahan.'));
                    redirect('finance/savings/list_joint_saving');
                }
            } else {
                $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf.,PIN Anda salah!'));
                redirect('finance/savings/list_joint_saving');
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

                $this->db->query('SET SESSION interactive_timeout = 28000');
                $this->db->query('SET SESSION wait_timeout = 28000');
                $this->db2->query('SET SESSION interactive_timeout = 28000');
                $this->db2->query('SET SESSION wait_timeout = 28000');

                $check_used_number = $this->SavingsModel->check_used_number_import_data_personal_saving($data['data_check']);
                if ($check_used_number >= 1 && $data['status_similiar'] == 'false') {

                    $output = array("status" => false,
                        "confirm" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-danger'>TERPAKAI</b>. Silahkan revisi data Import Anda.",
                    );

                } else {
                    $check_duplicate = $this->SavingsModel->check_duplicate_import_data_personal_saving($data['data_check']);
                    if ($check_duplicate >= 1 && $data['status_similiar'] == 'false') {
                        $output = array("status" => false,
                            "confirm" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-danger'>DUPLIKAT</b>. Silahkan revisi data Import Anda.",
                        );

                    } else {
                        $check_similiar = $this->SavingsModel->check_similiar_import_data_personal_saving($data['data_check']);
                        if ($check_similiar >= 1 && $data['status_similiar'] == 'false') {
                            $output = array("status" => true,
                                "confirm" => true,
                                "token" => $token,
                                "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-warning'>MIRIP</b>. Revisi atau Lanjutkan ?.",
                            );

                        } else if (($check_similiar >= 1 && $data['status_similiar'] == 'true') || ($check_similiar == 0 && $data['status_similiar'] == 'false')) {

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

                                if ($transaksi_umum) {
                                    $this->db2->insert_batch('transaksi_tabungan_umum', $transaksi_umum);
                                }

                                if ($transaksi_qurban) {
                                    $this->db2->insert_batch('transaksi_tabungan_qurban', $transaksi_qurban);
                                }

                                if ($transaksi_wisata) {
                                    $this->db2->insert_batch('transaksi_tabungan_wisata', $transaksi_wisata);
                                }

                                $this->SavingsModel->clear_import_data_personal_saving();

                                $output = array("status" => true,
                                    "token" => $token,
                                    "confirm" => false,
                                    "messages" => "Berhasil!, Seluruh Data Nasabah telah diimport ke database. Dimohon untuk melakukan <b>PENGECEKAN ULANG</b>. Terima Kasih.",
                                );

                            } else {
                                $output = array("status" => false,
                                    "token" => $token,
                                    "confirm" => false,
                                    "messages" => "Mohon Maaf!, Terjadi Kesalahan, Silahkan import ulang..",
                                );
                            }
                        }
                    }
                }

            } else {

                $output = array("status" => false,
                    "confirm" => false,
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

    public function accept_import_joint_saving()
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

                $this->db->query('SET SESSION interactive_timeout = 28000');
                $this->db->query('SET SESSION wait_timeout = 28000');
                $this->db2->query('SET SESSION interactive_timeout = 28000');
                $this->db2->query('SET SESSION wait_timeout = 28000');

                $check_used_number = $this->SavingsModel->check_used_number_import_data_joint_saving($data['data_check']);
                if ($check_used_number >= 1 && $data['status_pj'] == 'false') {

                    $output = array("status" => false,
                        "confirm" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-danger'>TERPAKAI</b>. Silahkan revisi data Import Anda.",
                    );

                } else {

                    $check_duplicate = $this->SavingsModel->check_duplicate_import_data_joint_saving($data['data_check']);
                    if ($check_duplicate >= 1 && $data['status_pj'] == 'false') {
                        $output = array("status" => false,
                            "confirm" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-danger'>DUPLIKAT</b>. Silahkan revisi data Import Anda.",
                        );

                    } else {

                        $check_pj = $this->SavingsModel->check_responsible_person_import_data_joint_saving($data['data_check']);

                        if ($check_pj >= 1 && $data['status_pj'] == 'false') {
                            $output = array("status" => true,
                                "confirm" => true,
                                "token" => $token,
                                "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat Penanggung Jawab yang <b class='text-danger'>TIDAK TERDAFTAR</b>. Revisi atau Lanjutkan ?.",
                            );

                        } else if (($check_pj >= 1 && $data['status_pj'] == 'true') || ($check_pj == 0 && $data['status_pj'] == 'false')) {

                            $input = $this->SavingsModel->accept_import_data_joint_saving($data['data_check']);
                            if ($input == true) {

                                $transaksi_bersama = array();
                                $result_import = $this->SavingsModel->get_import_joint_saving($data['data_check'], 2);

                                for ($i = 0; $i < count($result_import); $i++) {

                                    $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);

                                    if ($result_import[$i]['saldo_bersama'] != 0 && $result_import[$i]['saldo_bersama'] != null && $result_import[$i]['saldo_bersama'] != "" && !empty($result_import[$i]['saldo_bersama'])) {

                                        $transaksi_bersama[$i] = array(
                                            'nomor_transaksi_bersama' => "TB01" . $random_number . "/" . date('YmdHis'),
                                            'nomor_rekening_bersama' => $result_import[$i]['nomor_rekening_bersama'],
                                            'id_pegawai' => $this->user_finance[0]->id_akun_keuangan,
                                            'id_tingkat' => $result_import[$i]['tingkat'],
                                            'saldo' => $result_import[$i]['saldo_bersama'],
                                            'catatan' => "transaksi import awal",
                                            'nominal' => $result_import[$i]['saldo_bersama'],
                                            'status_kredit_debet' => "1",
                                            'th_ajaran' => $result_import[$i]['tahun_ajaran'],
                                            'tanggal_transaksi' => $result_import[$i]['tanggal_transaksi'],
                                        );
                                    }
                                }

                                if ($transaksi_bersama) {
                                    $this->db2->insert_batch('transaksi_tabungan_bersama', $transaksi_bersama);
                                }

                                $this->SavingsModel->clear_import_data_joint_saving();

                                $output = array("status" => true,
                                    "confirm" => false,
                                    "token" => $token,
                                    "messages" => "Berhasil!, Seluruh Data Nasabah Tabungan Bersama telah diimport ke database. Dimohon untuk melakukan <b>PENGECEKAN ULANG</b>. Terima Kasih.",
                                );

                            } else {
                                $output = array("status" => false,
                                    "confirm" => false,
                                    "token" => $token,
                                    "messages" => "Mohon Maaf!, Terjadi Kesalahan, Silahkan import ulang..",
                                );
                            }
                        }
                    }
                }

            } else {

                $output = array("status" => false,
                    "confirm" => false,
                    "token" => $token,
                    "messages" => "Opss!, Password Anda salah, Coba ulangi sekali lagi..",
                );
            }
        }
        echo json_encode($output);
    }

    public function reject_import_joint_saving()
    {

        $token = $this->security->get_csrf_hash();
        $input = $this->SavingsModel->clear_import_data_joint_saving();

        if ($input == true) {

            $output = array("status" => true,
                "token" => $token,
                "messages" => "Pemberitahuan!, Seluruh Data Nasabah Bersama batal diimport ke database. Terima Kasih.",
            );

        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf!, Terjadi Kesalahan, Silahkan import ulang..",
            );
        }
        echo json_encode($output);
    }

    public function delete_import_personal_saving()
    {
        $id_nasabah = $this->input->post('id_nasabah');
        $nis = $this->input->post('nis');
        $nama_siswa = $this->input->post('nama_siswa');
        $password = $this->input->post('password');

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($id_nasabah) {

                $check_pass = $this->SavingsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($password, $check_pass[0]->password)) {

                    $delete = $this->SavingsModel->delete_import_personal_saving_by_id($id_nasabah);

                    if ($delete == true) {
                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil, Data Import Tabungan Personal atas nama <b>" . strtoupper($nama_siswa) . " (" . $nis . ")</b> Telah Terhapus..",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Data Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                        );
                    }
                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Password Anda Salah, Silahkan coba lagi.",
                    );
                }
            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, ID Nasabah belum diinputkan, Silahkan coba lagi.",
                );
            }
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );
        }
        echo json_encode($output);
    }

    public function delete_import_joint_saving()
    {
        $id_nasabah = $this->input->post('id_nasabah');
        $norek = $this->input->post('nomor_rekening');
        $nama_tabungan = $this->input->post('nama_tabungan');
        $password = $this->input->post('password');

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($id_nasabah) {

                $check_pass = $this->SavingsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($password, $check_pass[0]->password)) {

                    $delete = $this->SavingsModel->delete_import_joint_saving_by_id($id_nasabah);

                    if ($delete == true) {
                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil, Data Import Tabungan Bersama atas nama <b>" . strtoupper($nama_tabungan) . " (" . $norek . ")</b> Telah Terhapus..",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Data Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                        );
                    }
                } else {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Password Anda Salah, Silahkan coba lagi.",
                    );
                }
            } else {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, ID Nasabah belum diinputkan, Silahkan coba lagi.",
                );
            }
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
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

    public function get_name_similliar($names = '')
    {
        $name = $this->security->xss_clean(urldecode(str_replace('_', '-', $names)));
        $name = preg_replace("/['\"-]/", "", $name);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $transaction = array();
            $result = $this->SavingsModel->check_match_name(trim($name));

            if ($result) {
                foreach ($result as $index => $item) {
                    // Perform the text match and check if it's above the threshold
                    $score = $this->matching->single_text_match(strtoupper(trim(preg_replace("/'/", "", $item->nama_lengkap))), strtoupper(trim($name)));
                    if ($score >= 80 && $score <= 100) {
                        $transaction[] = array(
                            'nis' => $item->nis,
                            'nama_lengkap' => $item->nama_lengkap,
                            'level_tingkat' => $item->level_tingkat,
                            'email' => $item->email,
                            'nomor_handphone' => $item->nomor_handphone,
                            'tahun_ajaran' => $item->tahun_ajaran,
                            'saldo_tabungan_umum' => $item->saldo_tabungan_umum,
                            'saldo_tabungan_qurban' => $item->saldo_tabungan_qurban,
                            'saldo_tabungan_wisata' => $item->saldo_tabungan_wisata,
                            'score' => $score,
                        );
                    }
                }
                if ($transaction) {
                    $output = array(
                        "status" => true,
                        "data" => $transaction,
                        "messages" => "Opps!, Nama tersebut kemungkinan terdapat kesalahan penulisan atau telah dipakai dengan berbeda NIS karena terdapat kesamaan dengan Nama Lainnya, Silahkan cek kesamaan Nama dibawah ini!. *ABAIKAN JIKA MEMANG BERBEDA & REVISI JIKA SALAH*",
                    );
                } else {
                    $output = array(
                        "status" => false,
                        "messages" => "Ok!, Nama dengan Nomor Bayar tersebut telah sesuai.",
                    );
                }
            } else {
                $output = array(
                    "status" => false,
                    "messages" => "Ok!, Nama dengan Nomor Bayar tersebut telah sesuai.",
                );
            }
        } else {
            $output = array("status" => false,
                "messages" => "Ok!, Nama Tidak Terdaftar, Silahkan coba lagi.",
            );
        }
        echo json_encode($output);
    }

    //-----------------------------------------------------------------------//
//
}
