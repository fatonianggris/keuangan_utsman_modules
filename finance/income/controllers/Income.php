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
        $this->db2 = $this->load->database('secondary_db', true);

        if ($this->session->userdata('sias-finance') == false) {
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

    public function add_income_dpb()
    {

        $data['nav_in'] = 'menu-item-here';
        $data['schoolyear'] = $this->IncomeModel->get_schoolyear_sias();

        $this->template->load('template_finance/template_finance', 'finance_add_income_dpb', $data);
    }

    public function add_income_du()
    {

        $data['nav_in'] = 'menu-item-here';
        $data['schoolyear'] = $this->IncomeModel->get_schoolyear_sias();

        $this->template->load('template_finance/template_finance', 'finance_add_income_du', $data);
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

    public function check_invoice_number_du_add()
    {
        $invoice = $this->input->post('nomor_invoice');

        $check = $this->IncomeModel->check_invoice_du_duplicate($invoice);

        if ($invoice == null || $invoice == "") {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == true) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == false) {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        }
    }

    public function check_invoice_number_dpb_add()
    {
        $invoice = $this->input->post('nomor_invoice');

        $check = $this->IncomeModel->check_invoice_dpb_duplicate($invoice);

        if ($invoice == null || $invoice == "") {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == true) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == false) {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        }
    }

    public function check_payment_number_dpb_add()
    {

        $name = $this->input->post('nama');
        $name = $this->security->xss_clean($name);

        $pay = $this->input->post('nomor_pembayaran');
        $pay = $this->security->xss_clean($pay);

        $name = preg_replace("/['\"-]/", "", $name);
        $check = $this->IncomeModel->check_payment_dpb_duplicate($pay);

        if ($pay == null || $pay == "") {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "<span class='text-danger'>Nomor Pembayaran <b>TIDAK DITEMUKAN</b></span>",
                'status' => false,
            ));
        } else if ($check == true) {
            $isAvailable = false;

            $student = $this->IncomeModel->check_student_by_nomor_pembayaran_dpb($pay);
            $score = $this->matching->single_text_match(strtoupper(trim($student[0]->nama_lengkap)), strtoupper(trim($name)));

            if ($score == 100) {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-success'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => true,
                ));
            } else if ($score >= 90 && $score < 100) {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-warning'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => true,
                ));
            } else {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-danger'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => false,
                ));
            }

        } else if ($check == false) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "<span class='text-warning'>Nomor Pembayaran <b>BELUM TERDAFATAR</b> di Database</span>",
                'status' => true,
            ));
        }
    }

    public function check_payment_number_du_add()
    {

        $name = $this->input->post('nama');
        $name = $this->security->xss_clean($name);

        $pay = $this->input->post('nomor_pembayaran');
        $pay = $this->security->xss_clean($pay);

        $name = preg_replace("/['\"-]/", "", $name);
        $check = $this->IncomeModel->check_payment_du_duplicate($pay);

        if ($pay == null || $pay == "") {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "<span class='text-danger'>Nomor Pembayaran <b>TIDAK DITEMUKAN</b></span>",
                'status' => false,
            ));
        } else if ($check == true) {
            $isAvailable = false;

            $student = $this->IncomeModel->check_student_by_nomor_pembayaran_du($pay);
            $score = $this->matching->single_text_match(strtoupper(trim($student[0]->nama_lengkap)), strtoupper(trim($name)));

            if ($score == 100) {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-success'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => true,
                ));
            } else if ($score >= 90 && $score < 100) {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-warning'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => true,
                ));
            } else {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-danger'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => false,
                ));
            }

        } else if ($check == false) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "<span class='text-warning'>Nomor Pembayaran <b>BELUM TERDAFATAR</b> di Database</span>",
                'status' => true,
            ));
        }
    }

    public function check_invoice_number_dpb()
    {
        $id = $this->input->post('id_tagihan');
        $id = paramDecrypt($id);
        $invoice = $this->input->post('nomor_invoice');

        $check = $this->IncomeModel->check_invoice_dpb_duplicate($invoice);
        $check_old = $this->IncomeModel->get_income_dpb_by_id($id);

        if ($id == null || $invoice == null || $id == "" || $invoice == "") {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == true && $check_old[0]->id_invoice != $invoice) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == true && $check_old[0]->id_invoice == $invoice) {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == false) {
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

        if ($id == null || $invoice == null || $id == "" || $invoice == "") {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == true && $check_old[0]->id_invoice != $invoice) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == true && $check_old[0]->id_invoice == $invoice) {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == false) {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        }
    }

    public function check_payment_number_dpb()
    {
        $old_number = $this->input->post('nomor_pembayaran_old');
        $old_number = $this->security->xss_clean($old_number);

        $name = $this->input->post('nama');
        $name = $this->security->xss_clean($name);

        $pay = $this->input->post('nomor_pembayaran');
        $pay = $this->security->xss_clean($pay);

        $name = preg_replace("/['\"-]/", "", $name);
        $check = $this->IncomeModel->check_payment_dpb_duplicate($pay);

        if ($old_number == null || $pay == null || $old_number == "" || $pay == "") {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "<span class='text-danger'>Nomor Pembayaran <b>TIDAK DITEMUKAN</b></span>",
                'status' => false,
            ));
        } else if ($check == true && $old_number != $pay) {
            $isAvailable = false;

            $student = $this->IncomeModel->check_student_by_nomor_pembayaran_dpb($pay);
            $score = $this->matching->single_text_match(strtoupper(trim($student[0]->nama_lengkap)), strtoupper(trim($name)));

            if ($score == 100) {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-success'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => true,
                ));
            } else if ($score >= 90 && $score < 100) {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-warning'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => true,
                ));
            } else {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-danger'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => false,
                ));
            }

        } else if ($check == true && $old_number == $pay) {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == false) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "<span class='text-warning'>Nomor Pembayaran <b>BELUM TERDAFATAR</b> di Database.</span>",
                'status' => true,
            ));
        }
    }

    public function check_payment_number_du()
    {
        $old_number = $this->input->post('nomor_pembayaran_old');
        $old_number = $this->security->xss_clean($old_number);

        $name = $this->input->post('nama');
        $name = $this->security->xss_clean($name);

        $pay = $this->input->post('nomor_pembayaran');
        $pay = $this->security->xss_clean($pay);

        $name = preg_replace("/['\"-]/", "", $name);
        $check = $this->IncomeModel->check_payment_du_duplicate($pay);

        if ($old_number == null || $pay == null || $old_number == "" || $pay == "") {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "<span class='text-danger'>Nomor Pembayaran <b>TIDAK DITEMUKAN</b></span>",
                'status' => false,
            ));
        } else if ($check == true && $old_number != $pay) {
            $isAvailable = false;

            $student = $this->IncomeModel->check_student_by_nomor_pembayaran_du($pay);
            $score = $this->matching->single_text_match(strtoupper(trim($student[0]->nama_lengkap)), strtoupper(trim($name)));

            if ($score == 100) {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-success'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => true,
                ));
            } else if ($score >= 90 && $score < 100) {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-warning'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => true,
                ));
            } else {
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "<span class='text-danger'>Nomor Pembayaran telah <b>TERDAFATAR</b> atas nama <b> " . $student[0]->nama_lengkap . " (" . $student[0]->nomor_pembayaran_du . ")</b></span>",
                    'status' => false,
                ));
            }

        } else if ($check == true && $old_number == $pay) {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        } else if ($check == false) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "<span class='text-warning'>Nomor Pembayaran <b>BELUM TERDAFATAR</b> di Database.</span>",
                'status' => true,
            ));
        }
    }

    public function check_invoice_number_du_transition()
    {

        $old_invoice = $this->input->post('old_nomor_invoice');
        $old_invoice = $this->security->xss_clean($old_invoice);

        $invoice = $this->input->post('nomor_invoice');
        $invoice = $this->security->xss_clean($invoice);

        $check = $this->IncomeModel->check_invoice_du_duplicate($invoice);

        if ($check) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "ID Invoice telah digunakan di Tagihan sebelumnya",
            ));
        } else {
            $check_transition = $this->IncomeModel->get_transition_income_du_by_id($invoice);

            if ($check_transition >= 2) {
                $isAvailable = false;
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "ID Invoice <b>Duplikat</b> di File Excel",
                ));
            } else if (($check_transition == 1) && ($invoice != $old_invoice)) {
                $isAvailable = false;
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "ID Invoice <b>Duplikat</b> di File Excel",
                ));
            } else {
                $isAvailable = true;
                echo json_encode(array(
                    'valid' => $isAvailable,
                ));
            }
        }
    }

    public function check_invoice_number_dpb_transition()
    {

        $old_invoice = $this->input->post('old_nomor_invoice');
        $old_invoice = $this->security->xss_clean($old_invoice);

        $invoice = $this->input->post('nomor_invoice');
        $invoice = $this->security->xss_clean($invoice);

        $check = $this->IncomeModel->check_invoice_dpb_duplicate($invoice);

        if ($check) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "ID Invoice telah digunakan di Tagihan sebelumnya",
            ));
        } else {
            $check_transition = $this->IncomeModel->get_transition_income_dpb_by_id($invoice);

            if ($check_transition >= 2) {
                $isAvailable = false;
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "ID Invoice <b>Duplikat</b> di File Excel",
                ));
            } else if (($check_transition == 1) && ($invoice != $old_invoice)) {
                $isAvailable = false;
                echo json_encode(array(
                    'valid' => $isAvailable,
                    'message' => "ID Invoice <b>Duplikat</b> di File Excel",
                ));
            } else {
                $isAvailable = true;
                echo json_encode(array(
                    'valid' => $isAvailable,
                ));
            }
        }
    }

    public function check_payment_number_du_transition()
    {
        $old_number_pay = $this->input->post('old_nomor_pembayaran');
        $old_number_pay = $this->security->xss_clean($old_number_pay);

        $number_pay = $this->input->post('nomor_pembayaran');
        $number_pay = $this->security->xss_clean($number_pay);

        $check_transition = $this->IncomeModel->get_transition_income_du_by_number($number_pay);

        if ($check_transition >= 2) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "Nomor Bayar <b>Duplikat</b> di File Excel",
            ));
        } else if (($check_transition == 1) && ($number_pay != $old_number_pay)) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "Nomor Bayar <b>Duplikat</b> di File Excel",
            ));
        } else {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        }

    }

    public function check_payment_number_dpb_transition()
    {
        $old_number_pay = $this->input->post('old_nomor_pembayaran');
        $old_number_pay = $this->security->xss_clean($old_number_pay);

        $number_pay = $this->input->post('nomor_pembayaran');
        $number_pay = $this->security->xss_clean($number_pay);

        $check_transition = $this->IncomeModel->get_transition_income_dpb_by_number($number_pay);

        if ($check_transition >= 2) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "Nomor Bayar <b>Duplikat</b> di File Excel",
            ));
        } else if (($check_transition == 1) && ($number_pay != $old_number_pay)) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "Nomor Bayar <b>Duplikat</b> di File Excel",
            ));
        } else {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        }
    }

    public function check_name_du_transition()
    {

        $old_name = $this->input->post('old_nama');
        $old_name = $this->security->xss_clean($old_name);

        $name = $this->input->post('nama');
        $name = $this->security->xss_clean($name);

        $number_pay = $this->input->post('nomor_pembayaran');
        $number_pay = $this->security->xss_clean($number_pay);

        $name = preg_replace("/['\"-]/", "", $name);
        $check_transition = $this->IncomeModel->get_transition_income_du_by_number_name($number_pay, strtoupper($name));

        if ($check_transition >= 2) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "Nama Tertagih dengan Nomor Bayar <b>" . $number_pay . "</b> duplikat di file Excel",
            ));
        } else if (($check_transition == 1) && (strtoupper($name) != strtoupper($old_name))) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "Nama Tertagih dengan Nomor Bayar <b>" . $number_pay . "</b> duplikat di file Excel",
            ));
        } else {
            $isAvailable = true;
            echo json_encode(array(
                'valid' => $isAvailable,
            ));
        }
    }

    public function check_name_dpb_transition()
    {

        $old_name = $this->input->post('old_nama');
        $old_name = $this->security->xss_clean($old_name);

        $name = $this->input->post('nama');
        $name = $this->security->xss_clean($name);

        $number_pay = $this->input->post('nomor_pembayaran');
        $number_pay = $this->security->xss_clean($number_pay);

        $name = preg_replace("/['\"-]/", "", $name);
        $check_transition = $this->IncomeModel->get_transition_income_dpb_by_number_name($number_pay, strtoupper($name));

        if ($check_transition >= 2) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "Nama Tertagih dengan Nomor Bayar <b>" . $number_pay . "</b> duplikat di file Excel",
            ));
        } else if (($check_transition == 1) && (strtoupper($name) != strtoupper($old_name))) {
            $isAvailable = false;
            echo json_encode(array(
                'valid' => $isAvailable,
                'message' => "Nama Tertagih dengan Nomor Bayar <b>" . $number_pay . "</b> duplikat di file Excel",
            ));
        } else {
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
        $data['schoolyear'] = $this->IncomeModel->get_schoolyear_sias();

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
        $data['schoolyear'] = $this->IncomeModel->get_schoolyear_sias();

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

    public function get_name_similliar($names = '')
    {
        $name = $this->security->xss_clean(urldecode(str_replace('_', '-', $names)));
        $name = preg_replace("/['\"-]/", "", $name);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $transaction = array();
            $result = $this->IncomeModel->check_match_name(trim($name));

            if ($result) {
                foreach ($result as $index => $item) {
                    // Perform the text match and check if it's above the threshold
                    $score = $this->matching->single_text_match(strtoupper(trim(preg_replace("/'/", "", $item->nama_lengkap))), strtoupper(trim($name)));
                    if ($score >= 80 && $score <= 100) {
                        $transaction[] = array(
                            'nis' => $item->nis,
                            'nomor_pembayaran_du' => $item->nomor_pembayaran_du,
                            'nomor_pembayaran_dpb' => $item->nomor_pembayaran_dpb,
                            'nama_lengkap' => $item->nama_lengkap,
                            'level_tingkat' => $item->level_tingkat,
                            'email' => $item->email,
                            'nomor_handphone' => $item->nomor_handphone,
                            'tahun_ajaran' => $item->tahun_ajaran,
                            'score' => $score,
                        );
                    }
                }
                if ($transaction) {
                    $output = array(
                        "status" => true,
                        "data" => $transaction,
                        "messages" => "Opps!, Nama tersebut kemungkinan terdapat kesalahan penulisan atau telah dipakai dengan berbeda Nomor Bayar karena terdapat kesamaan dengan Nama Lainnya, Silahkan cek kesamaan Nama dibawah ini!. *ABAIKAN JIKA MEMANG BERBEDA & REVISI JIKA SALAH*",
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

    public function list_transition_income_dpb($id = '')
    {
        $id = paramDecrypt($id);
        $data['nav_in'] = 'menu-item-here';

        $data['income_dpb'] = $this->IncomeModel->get_all_transition_income_dpb();
        $data['schoolyear'] = $this->IncomeModel->get_schoolyear_sias();

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

        $data['income_du'] = $this->IncomeModel->get_all_transition_income_du();
        $data['schoolyear'] = $this->IncomeModel->get_schoolyear_sias();

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

        if ($data['income'] == false or empty($id)) {
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

        if ($data['income'] == false or empty($id)) {
            $this->load->view('error_404', $data);
        } else {
            $this->template->load('template_finance/template_finance', 'finance_detail_income_dpb', $data);
        }
    }

    public function post_income_dpb()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $status_data = false;
        $message = "";

        $this->form_validation->set_rules('nomor_invoice', 'Nomor Invoice Tagihan', 'required');
        $this->form_validation->set_rules('nomor_pembayaran', 'Nomor Pembayaran Tagihan', 'required');
        $this->form_validation->set_rules('nominal_tagihan', 'Total Nominal Tagihan', 'required');
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('nis', 'NIS Siswa', 'required');
        $this->form_validation->set_rules('level_tingkat', 'Tingkat Siswa', 'required');
        $this->form_validation->set_rules('tanggal_invoice', 'Tanggal Invoice', 'required');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');

        $data['nama_siswa'] = preg_replace("/['\"-]/", "", $data['nama_siswa']);

        $invoice = $this->IncomeModel->check_invoice_dpb_duplicate($data['nomor_invoice']);
        $check = $this->IncomeModel->check_payment_dpb_duplicate($data['nomor_pembayaran']);

        $student = $this->IncomeModel->check_student_by_nomor_pembayaran_dpb($data['nomor_pembayaran']);

        $data['tanggal_invoice'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['tanggal_invoice'])));

        if ($invoice == true) {
            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor/Kode Invoice yang anda inputkan telah terpakai."));
            redirect('finance/income/income/add_income_dpb/');
        } else {

            if ($data['nomor_invoice'] == null || $data['nomor_pembayaran'] == null || $data['nomor_invoice'] == "" || $data['nomor_pembayaran'] == "") {
                $status_data = false;
                $message = "Mohon Maaf, Nomor Pembayaran yang Anda tidak ditemukan.";
            } else if ($check == true && $data['nomor_pembayaran']) {

                $score = $this->matching->single_text_match(strtoupper(trim($student[0]->nama_lengkap)), strtoupper(trim($data['nama_siswa'])));

                if ($score >= 90 && $score <= 100) {
                    $status_data = true;
                    $data['password'] = $student[0]->password;
                    $data['th_ajaran'] = $student[0]->th_ajaran;
                    $message = "Berhasil Ditambahkan, Data Tagihan Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> telah ditambahkan. Terima Kasih";
                } else {
                    $status_data = false;
                    $message = "Mohon Maaf, Nomor Pembayaran yang anda inputkan telah Terdafatar Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> ";
                }
            } else if ($check == false) {
                $status_data = true;
                $data['th_ajaran'] = $data['tahun_ajaran'];
                $data['password'] = password_hash(paramEncrypt($data['nis']), PASSWORD_DEFAULT, array('cost' => 12));
                $message = "Berhasil Ditambahkan, Data Tagihan Siswa dan Data Siswa Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> telah ditambahkan ke Database. Terima Kasih";
            }

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
                redirect('finance/income/income/add_income_dpb/');
            } else {

                if ($status_data == true) {
                    $input = $this->IncomeModel->insert_income_dpb_and_student($data);
                    if ($input == true) {
                        $this->session->set_flashdata('flash_message', succ_msg($message));
                        redirect('finance/income/income/add_income_dpb/');
                    } else {
                        $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang.'));
                        redirect('finance/income/income/add_income_dpb/');
                    }
                } else {
                    $this->session->set_flashdata('flash_message', warn_msg($message));
                    redirect('finance/income/income/add_income_dpb/');
                }
            }

        }
    }

    public function post_income_du()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $status_data = false;
        $message = "";

        $this->form_validation->set_rules('nomor_invoice', 'Nomor Invoice Tagihan', 'required');
        $this->form_validation->set_rules('nomor_pembayaran', 'Nomor Pembayaran Tagihan', 'required');
        $this->form_validation->set_rules('nominal_tagihan', 'Total Nominal Tagihan', 'required');
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('nis', 'NIS Siswa', 'required');
        $this->form_validation->set_rules('level_tingkat', 'Tingkat Siswa', 'required');
        $this->form_validation->set_rules('tanggal_invoice', 'Tanggal Invoice', 'required');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');

        $data['nama_siswa'] = preg_replace("/['\"-]/", "", $data['nama_siswa']);

        $invoice = $this->IncomeModel->check_invoice_du_duplicate($data['nomor_invoice']);
        $check = $this->IncomeModel->check_payment_du_duplicate($data['nomor_pembayaran']);

        $student = $this->IncomeModel->check_student_by_nomor_pembayaran_du($data['nomor_pembayaran']);

        $data['tanggal_invoice'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['tanggal_invoice'])));

        if ($invoice == true) {
            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor/Kode Invoice yang anda inputkan telah terpakai."));
            redirect('finance/income/income/add_income_du/');
        } else {

            if ($data['nomor_invoice'] == null || $data['nomor_pembayaran'] == null || $data['nomor_invoice'] == "" || $data['nomor_pembayaran'] == "") {
                $status_data = false;
                $message = "Mohon Maaf, Nomor Pembayaran yang Anda tidak ditemukan.";
            } else if ($check == true && $data['nomor_pembayaran']) {

                $score = $this->matching->single_text_match(strtoupper(trim($student[0]->nama_lengkap)), strtoupper(trim($data['nama_siswa'])));

                if ($score >= 90 && $score <= 100) {
                    $status_data = true;
                    $data['password'] = $student[0]->password;
                    $data['th_ajaran'] = $student[0]->th_ajaran;
                    $message = "Berhasil Ditambahkan, Data Tagihan Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> telah ditambahkan. Terima Kasih";
                } else {
                    $status_data = false;
                    $message = "Mohon Maaf, Nomor Pembayaran yang anda inputkan telah Terdafatar Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> ";
                }
            } else if ($check == false) {
                $status_data = true;
                $data['th_ajaran'] = $data['tahun_ajaran'];
                $data['password'] = password_hash(paramEncrypt($data['nis']), PASSWORD_DEFAULT, array('cost' => 12));
                $message = "Berhasil Ditambahkan, Data Tagihan Siswa dan Data Siswa Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> telah ditambahkan ke Database. Terima Kasih";
            }

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
                redirect('finance/income/income/add_income_du/');
            } else {

                if ($status_data == true) {
                    $input = $this->IncomeModel->insert_income_du_and_student($data);
                    if ($input == true) {
                        $this->session->set_flashdata('flash_message', succ_msg($message));
                        redirect('finance/income/income/add_income_du/');
                    } else {
                        $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang.'));
                        redirect('finance/income/income/add_income_du/');
                    }
                } else {
                    $this->session->set_flashdata('flash_message', warn_msg($message));
                    redirect('finance/income/income/add_income_du/');
                }
            }

        }
    }

    public function update_income_dpb($id = '')
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $id = paramDecrypt($id);
        $status_data = false;
        $message = "";

        $this->form_validation->set_rules('nomor_invoice', 'Nomor Invoice Tagihan', 'required');
        $this->form_validation->set_rules('nomor_pembayaran', 'Nomor Pembayaran Tagihan', 'required');
        $this->form_validation->set_rules('nominal_tagihan', 'Total Nominal Tagihan', 'required');
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('nis', 'NIS Siswa', 'required');
        $this->form_validation->set_rules('level_tingkat', 'Tingkat Siswa', 'required');
        $this->form_validation->set_rules('tanggal_invoice', 'Tanggal Invoice', 'required');

        $data['nama_siswa'] = preg_replace("/['\"-]/", "", $data['nama_siswa']);

        $invoice = $this->IncomeModel->check_invoice_dpb_duplicate($data['nomor_invoice']);
        $check = $this->IncomeModel->check_payment_dpb_duplicate($data['nomor_pembayaran']);

        $check_old = $this->IncomeModel->get_income_dpb_by_id($id);
        $student = $this->IncomeModel->check_student_by_nomor_pembayaran_dpb($data['nomor_pembayaran']);
        $tahun_ajaran = $this->IncomeModel->get_schoolyear_now();

        $data['tanggal_invoice'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['tanggal_invoice'])));

        if ($invoice == true && strtoupper(strtolower($data['nomor_invoice'])) != strtoupper(strtolower($check_old[0]->id_invoice))) {
            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor/Kode Invoice yang anda inputkan telah terpakai."));
            redirect('finance/income/income/edit_income_dpb/' . paramEncrypt($id));
        } else {

            if ($data['nomor_pembayaran_old'] == null || $data['nomor_pembayaran'] == null || $data['nomor_pembayaran_old'] == "" || $data['nomor_pembayaran'] == "") {
                $status_data = false;
                $message = "Mohon Maaf, Nomor Pembayaran yang Anda tidak ditemukan.";
            } else if ($check == true && $data['nomor_pembayaran_old'] != $data['nomor_pembayaran']) {

                $score = $this->matching->single_text_match(strtoupper(trim($student[0]->nama_lengkap)), strtoupper(trim($data['nama_siswa'])));

                if ($score >= 90 && $score <= 100) {
                    $status_data = true;
                    $data['password'] = $student[0]->password;
                    $data['th_ajaran'] = $student[0]->th_ajaran;
                    $message = "Berhasil Diupdate, Data Tagihan dan Data Siswa Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> telah diupdate. Terima Kasih";
                } else {
                    $status_data = false;
                    $message = "Mohon Maaf, Nomor Pembayaran yang anda inputkan telah Terdafatar Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> ";
                }

            } else if ($check == true && $data['nomor_pembayaran_old'] == $data['nomor_pembayaran']) {
                $status_data = true;
                $data['password'] = $student[0]->password;
                $data['th_ajaran'] = $student[0]->th_ajaran;
                $message = "Berhasil Diupdate, Data Tagihan Siswa Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> telah diupdate. Terima Kasih";
            } else if ($check == false) {
                $status_data = true;
                $data['th_ajaran'] = $tahun_ajaran[0]->id_tahun_ajaran;
                $data['password'] = password_hash(paramEncrypt($data['nis']), PASSWORD_DEFAULT, array('cost' => 12));
                $message = "Berhasil Diupdate dan Ditambahkan, Data Tagihan Siswa Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> telah diupdate dan ditambahkan ke Database. Terima Kasih";
            }

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
                redirect('finance/income/income/edit_income_dpb/' . paramEncrypt($id));
            } else {

                if ($status_data == true) {
                    $input = $this->IncomeModel->update_income_dpb_and_student($id, $data);
                    if ($input == true) {
                        $this->session->set_flashdata('flash_message', succ_msg($message));
                        redirect('finance/income/income/edit_income_dpb/' . paramEncrypt($id));
                    } else {
                        $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang.'));
                        redirect('finance/income/income/edit_income_dpb/' . paramEncrypt($id));
                    }
                } else {
                    $this->session->set_flashdata('flash_message', warn_msg($message));
                    redirect('finance/income/income/edit_income_dpb/' . paramEncrypt($id));
                }
            }

        }
    }

    public function update_income_du($id = '')
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $id = paramDecrypt($id);
        $status_data = false;
        $message = "";

        $this->form_validation->set_rules('nomor_invoice', 'Nomor Invoice Tagihan', 'required');
        $this->form_validation->set_rules('nomor_pembayaran', 'Nomor Pembayaran Tagihan', 'required');
        $this->form_validation->set_rules('nominal_tagihan', 'Total Nominal Tagihan', 'required');
        $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('nis', 'NIS Siswa', 'required');
        $this->form_validation->set_rules('level_tingkat', 'Tingkat Siswa', 'required');
        $this->form_validation->set_rules('tanggal_invoice', 'Tanggal Invoice', 'required');

        $data['nama_siswa'] = preg_replace("/['\"-]/", "", $data['nama_siswa']);

        $invoice = $this->IncomeModel->check_invoice_du_duplicate($data['nomor_invoice']);
        $check = $this->IncomeModel->check_payment_du_duplicate($data['nomor_pembayaran']);

        $check_old = $this->IncomeModel->get_income_du_by_id($id);
        $student = $this->IncomeModel->check_student_by_nomor_pembayaran_du($data['nomor_pembayaran']);
        $tahun_ajaran = $this->IncomeModel->get_schoolyear_now();

        $data['tanggal_invoice'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['tanggal_invoice'])));

        if ($invoice == true && strtoupper(strtolower($data['nomor_invoice'])) != strtoupper(strtolower($check_old[0]->id_invoice))) {
            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor/Kode Invoice yang anda inputkan telah terpakai."));
            redirect('finance/income/income/edit_income_du/' . paramEncrypt($id));
        } else {

            if ($data['nomor_pembayaran_old'] == null || $data['nomor_pembayaran'] == null || $data['nomor_pembayaran_old'] == "" || $data['nomor_pembayaran'] == "") {
                $status_data = false;
                $message = "Mohon Maaf, Nomor Pembayaran yang Anda tidak ditemukan.";
            } else if ($check == true && $data['nomor_pembayaran_old'] != $data['nomor_pembayaran']) {

                $score = $this->matching->single_text_match(strtoupper(trim($student[0]->nama_lengkap)), strtoupper(trim($data['nama_siswa'])));

                if ($score >= 90 && $score <= 100) {
                    $status_data = true;
                    $data['password'] = $student[0]->password;
                    $data['th_ajaran'] = $student[0]->th_ajaran;
                    $message = "Berhasil Diupdate, Data Tagihan dan Data Siswa Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> telah diupdate. Terima Kasih";
                } else {
                    $status_data = false;
                    $message = "Mohon Maaf, Nomor Pembayaran yang anda inputkan telah Terdafatar Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b>";
                }

            } else if ($check == true && $data['nomor_pembayaran_old'] == $data['nomor_pembayaran']) {
                $status_data = true;
                $data['password'] = $student[0]->password;
                $data['th_ajaran'] = $student[0]->th_ajaran;
                $message = "Berhasil Diupdate, Data Tagihan Siswa Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> telah diupdate. Terima Kasih";
            } else if ($check == false) {
                $status_data = true;
                $data['th_ajaran'] = $tahun_ajaran[0]->id_tahun_ajaran;
                $data['password'] = password_hash(paramEncrypt($data['nis']), PASSWORD_DEFAULT, array('cost' => 12));
                $message = "Berhasil Diupdate dan Ditambahkan, Data Tagihan Siswa Atas Nama <b>" . strtoupper($data['nama_siswa']) . " (" . ($data['nomor_pembayaran']) . ")</b> telah diupdate dan ditambahkan ke Database. Terima Kasih";
            }

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
                redirect('finance/income/income/edit_income_du/' . paramEncrypt($id));
            } else {
                if ($status_data == true) {
                    $input = $this->IncomeModel->update_income_du_and_student($id, $data);
                    if ($input == true) {
                        $this->session->set_flashdata('flash_message', succ_msg($message));
                        redirect('finance/income/income/edit_income_du/' . paramEncrypt($id));
                    } else {
                        $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang.'));
                        redirect('finance/income/income/edit_income_du/' . paramEncrypt($id));
                    }
                } else {
                    $this->session->set_flashdata('flash_message', warn_msg($message));
                    redirect('finance/income/income/edit_income_du/' . paramEncrypt($id));
                }
            }

        }
    }

    public function update_income_du_transition($id = '')
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $id = paramDecrypt($id);

        $status_invoice = false;
        $status_payment = false;
        $status_name = false;

        $this->form_validation->set_rules('id_invoice', 'ID Invoice Tagihan', 'required');
        $this->form_validation->set_rules('nomor_bayar', 'Nomor Pembayaran Tagihan', 'required');
        $this->form_validation->set_rules('nama', 'Nama Tertagih', 'required');
        $this->form_validation->set_rules('tanggal_invoice', 'Tanggal Invoice', 'required');
        $this->form_validation->set_rules('nominal_tagihan', 'Total Nominal Tagihan', 'required');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');
        $this->form_validation->set_rules('level_tingkat', 'Tingkat', 'required');

        $data['tanggal_invoice'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['tanggal_invoice'])));
        $data['nama'] = preg_replace("/['\"-]/", "", $data['nama']);

        $cek_invoice = $this->IncomeModel->check_invoice_du_duplicate($data['id_invoice']);
        $check_name = $this->IncomeModel->check_student_by_name_and_number_du($data['nomor_bayar'], strtoupper($data['nama']));
        $check_number = $this->IncomeModel->check_student_by_nomor_pembayaran_du($data['nomor_bayar']);
        $check_invoice_transition = $this->IncomeModel->get_transition_income_du_by_id($data['id_invoice']);
        $check_payment_transition = $this->IncomeModel->get_transition_income_du_by_number($data['nomor_bayar']);
        $check_name_transition = $this->IncomeModel->get_transition_income_du_by_name(strtoupper($data['nama']));

        if ($cek_invoice) {
            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, ID Invoice yang anda inputkan telah digunakan sebelumnya."));
            redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
        } else {

            if ($check_invoice_transition >= 2) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, ID Invoice yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
            } else if (($check_invoice_transition == 1) && ($data['id_invoice'] != $data['old_id_invoice'])) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, ID Invoice yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
            } else {
                $status_invoice = true;
                $data['status_invoice_duplikat'] = 1;
            }
        }

        if ($check_number) {
            $status_payment = true;
            $data['status_nomor_terdaftar'] = 1;
        } else {
            if ($check_payment_transition >= 2) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor Pembayaran yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
            } else if (($check_payment_transition == 1) && ($data['nomor_bayar'] != $data['old_nomor_bayar'])) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor Pembayaran yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
            } else {
                $status_payment = true;
                $data['status_nomor_terdaftar'] = 2;
            }
        }

        if ($check_name) {
            $status_name = true;
            $data['status_nama_duplikat'] = 1;
        } else {
            if ($check_name_transition >= 2) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nama Tertagih yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
            } else if (($check_name_transition == 1) && (strtoupper($data['nama']) != strtoupper($data['old_nama']))) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nama Tertagih yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
            } else {
                $status_name = true;
                $data['status_nama_duplikat'] = 2;
            }
        }

        $new_nis = "9" . substr($data['nomor_bayar'], 1);
        $check_student = $this->IncomeModel->get_student_by_id($new_nis);
        if ($check_student) {
            $check_student_name_and_number = $this->IncomeModel->check_student_by_name_and_number_du(trim($data['nomor_bayar']), trim($data['nama']));
            if ($check_student_name_and_number) {
                $data['password'] = $check_student[0]->password;
            } else {
                $data['password'] = password_hash(paramEncrypt(trim($new_nis)), PASSWORD_DEFAULT, array('cost' => 12));
            }
        } else {
            $data['password'] = password_hash(paramEncrypt($new_nis), PASSWORD_DEFAULT, array('cost' => 12));
        }

        if ($status_invoice == true && $status_payment == true && $status_name == true) {
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
                redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
            } else {
                $input = $this->IncomeModel->update_income_payment_transition($id, $data);
                if ($input == true) {
                    $this->session->set_flashdata('flash_message', succ_msg("Berhasil Diupdate, Data Tagihan <b>" . $data['id_invoice'] . "</b> Atas Nama <b>" . strtoupper($data['nama']) . "</b> Anda telah diupdate. Terima Kasih"));
                    redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
                } else {
                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang.'));
                    redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
                }
            }
        } else {
            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Terdapat kesalahan pada ID Invoice dan Nomor Pembayaran yang anda inputkan, Silahkan cek ulang."));
            redirect('finance/income/income/list_transition_income_du/' . paramEncrypt("sekolah_utsman"));
        }

    }

    public function update_income_dpb_transition($id = '')
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $id = paramDecrypt($id);

        $status_invoice = false;
        $status_payment = false;
        $status_name = false;

        $this->form_validation->set_rules('id_invoice', 'ID Invoice Tagihan', 'required');
        $this->form_validation->set_rules('nomor_bayar', 'Nomor Pembayaran Tagihan', 'required');
        $this->form_validation->set_rules('nama', 'Nama Tertagih', 'required');
        $this->form_validation->set_rules('tanggal_invoice', 'Tanggal Invoice', 'required');
        $this->form_validation->set_rules('nominal_tagihan', 'Total Nominal Tagihan', 'required');
        $this->form_validation->set_rules('tahun_ajaran', 'Tahun Ajaran', 'required');
        $this->form_validation->set_rules('level_tingkat', 'Tingkat', 'required');

        $data['tanggal_invoice'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['tanggal_invoice'])));
        $data['nama'] = preg_replace("/['\"-]/", "", $data['nama']);

        $cek_invoice = $this->IncomeModel->check_invoice_dpb_duplicate($data['id_invoice']);
        $check_name = $this->IncomeModel->check_student_by_name_and_number_dpb($data['nomor_bayar'], strtoupper($data['nama']));
        $check_number = $this->IncomeModel->check_student_by_nomor_pembayaran_dpb($data['nomor_bayar']);
        $check_invoice_transition = $this->IncomeModel->get_transition_income_dpb_by_id($data['id_invoice']);
        $check_payment_transition = $this->IncomeModel->get_transition_income_dpb_by_number($data['nomor_bayar']);
        $check_name_transition = $this->IncomeModel->get_transition_income_dpb_by_name(strtoupper($data['nama']));

        if ($cek_invoice) {
            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, ID Invoice yang anda inputkan telah digunakan sebelumnya."));
            redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
        } else {

            if ($check_invoice_transition >= 2) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, ID Invoice yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
            } else if (($check_invoice_transition == 1) && ($data['id_invoice'] != $data['old_id_invoice'])) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, ID Invoice yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
            } else {
                $status_invoice = true;
                $data['status_invoice_duplikat'] = 1;
            }
        }

        if ($check_number) {
            $status_payment = true;
            $data['status_nomor_terdaftar'] = 1;
        } else {
            if ($check_payment_transition >= 2) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor Pembayaran yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
            } else if (($check_payment_transition == 1) && ($data['nomor_bayar'] != $data['old_nomor_bayar'])) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nomor Pembayaran yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
            } else {
                $status_payment = true;
                $data['status_nomor_terdaftar'] = 2;
            }
        }

        if ($check_name) {
            $status_name = true;
            $data['status_nama_duplikat'] = 1;
        } else {
            if ($check_name_transition >= 2) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nama Tertagih yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
            } else if (($check_name_transition == 1) && (strtoupper($data['nama']) != strtoupper($data['old_nama']))) {
                $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nama Tertagih yang anda inputkan <b>DUPLIKAT</b> di file Excel."));
                redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
            } else {
                $status_name = true;
                $data['status_nama_duplikat'] = 2;
            }
        }

        $check_student = $this->IncomeModel->get_student_by_id($data['nomor_bayar']);
        if ($check_student) {
            $check_student_name_and_number = $this->IncomeModel->check_student_by_name_and_number_dpb(trim($data['nomor_bayar']), trim($data['nama']));
            if ($check_student_name_and_number) {
                $data['password'] = $check_student[0]->password;
            } else {
                $data['password'] = password_hash(paramEncrypt(trim($data['nomor_bayar'])), PASSWORD_DEFAULT, array('cost' => 12));
            }
        } else {
            $data['password'] = password_hash(paramEncrypt($data['nomor_bayar']), PASSWORD_DEFAULT, array('cost' => 12));
        }

        if ($status_invoice == true && $status_payment == true && $status_name == true) {
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
                redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
            } else {
                $input = $this->IncomeModel->update_income_payment_transition($id, $data);
                if ($input == true) {
                    $this->session->set_flashdata('flash_message', succ_msg("Berhasil Diupdate, Data Tagihan <b>" . $data['id_invoice'] . "</b> Atas Nama <b>" . strtoupper($data['nama']) . "</b> Anda telah diupdate. Terima Kasih"));
                    redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
                } else {
                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang.'));
                    redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
                }
            }
        } else {
            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Terdapat kesalahan pada ID Invoice dan Nomor Pembayaran yang anda inputkan, Silahkan cek ulang."));
            redirect('finance/income/income/list_transition_income_dpb/' . paramEncrypt("sekolah_utsman"));
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

        $token = $this->security->get_csrf_hash();
        $check_pass = $this->IncomeModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
        // pass verify
        if (password_verify(($data['password']), $check_pass[0]->password)) {

            if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
                );
            } else {

                $this->db->query('SET SESSION interactive_timeout = 28000');
                $this->db->query('SET SESSION wait_timeout = 28000');
                $this->db2->query('SET SESSION interactive_timeout = 28000');
                $this->db2->query('SET SESSION wait_timeout = 28000');

                $check_used_number = $this->IncomeModel->check_used_number_import_data_payment($data['data_check']);
                if ($check_used_number >= 1 && $data['status_similiar'] == 'false') {

                    $output = array("status" => false,
                        "confirm" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-danger'>TERPAKAI</b>. Silahkan revisi data Import Anda.",
                    );

                } else {
                    $check_duplicate = $this->IncomeModel->check_duplicate_import_data_payment($data['data_check']);
                    if ($check_duplicate >= 1 && $data['status_similiar'] == 'false') {
                        $output = array("status" => false,
                            "confirm" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-danger'>DUPLIKAT</b>. Silahkan revisi data Import Anda.",
                        );

                    } else {
                        $check_similiar = $this->IncomeModel->check_similiar_not_registered_import_data_payment($data['data_check']);
                        if ($check_similiar >= 1 && $data['status_similiar'] == 'false') {
                            $output = array("status" => true,
                                "confirm" => true,
                                "token" => $token,
                                "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat status peringatan <b class='text-warning'>TIDAK TERDAFATAR/MIRIP</b>. Revisi atau Lanjutkan ?.",
                            );

                        } else if (($check_similiar >= 1 && $data['status_similiar'] == 'true') || ($check_similiar == 0 && $data['status_similiar'] == 'false')) {

                            $input_siswa = $this->IncomeModel->accept_import_data_siswa_du($data['data_check']);
                            if ($input_siswa == true) {

                                $input_payment = $this->IncomeModel->accept_import_data_payment_du($data['data_check']);
                                if ($input_payment == true) {

                                    $this->IncomeModel->clear_import_data_payment();
                                    $output = array("status" => true,
                                        "confirm" => false,
                                        "token" => $token,
                                        "messages" => "Berhasil!, Seluruh Data Tagihan DU & Data Siswa Terpilih telah diimport ke database. dimohon untuk melakukan <b>Pengecekan Ulang</b>. Terima Kasih.",
                                    );
                                } else {
                                    $output = array("status" => false,
                                        "confirm" => false,
                                        "token" => $token,
                                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                                    );
                                }
                            } else {
                                $output = array("status" => false,
                                    "confirm" => false,
                                    "token" => $token,
                                    "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                                );
                            }
                        }
                    }
                }
            }
        } else {
            $output = array("status" => false,
                "confirm" => false,
                "token" => $token,
                "messages" => "Mohon Maaf., Password yang Anda inputkan salah!",
            );
        }
        echo json_encode($output);
    }

    // public function coba()
    // {

    //     $result = $this->IncomeModel->check_match_name("ABDURRAHMAN MALIK");

    //     var_dump($result);exit;
    // }

    public function accept_import_payment_dpb()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();
        $check_pass = $this->IncomeModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
        // pass verify
        if (password_verify(($data['password']), $check_pass[0]->password)) {

            if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
                );
            } else {

                $this->db->query('SET SESSION interactive_timeout = 28000');
                $this->db->query('SET SESSION wait_timeout = 28000');
                $this->db2->query('SET SESSION interactive_timeout = 28000');
                $this->db2->query('SET SESSION wait_timeout = 28000');

                $check_used_number = $this->IncomeModel->check_used_number_import_data_payment($data['data_check']);
                if ($check_used_number >= 1 && $data['status_similiar'] == 'false') {

                    $output = array("status" => false,
                        "confirm" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-danger'>TERPAKAI</b>. Silahkan revisi data Import Anda.",
                    );

                } else {
                    $check_duplicate = $this->IncomeModel->check_duplicate_import_data_payment($data['data_check']);
                    if ($check_duplicate >= 1 && $data['status_similiar'] == 'false') {
                        $output = array("status" => false,
                            "confirm" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-danger'>DUPLIKAT</b>. Silahkan revisi data Import Anda.",
                        );

                    } else {
                        $check_similiar = $this->IncomeModel->check_similiar_not_registered_import_data_payment($data['data_check']);
                        if ($check_similiar >= 1 && $data['status_similiar'] == 'false') {
                            $output = array("status" => true,
                                "confirm" => true,
                                "token" => $token,
                                "messages" => "Mohon Maaf!, Data yang Anda pilih terdapat status peringatan <b class='text-warning'>TIDAK TERDAFATAR/MIRIP</b>. Revisi atau Lanjutkan ?.",
                            );

                        } else if (($check_similiar >= 1 && $data['status_similiar'] == 'true') || ($check_similiar == 0 && $data['status_similiar'] == 'false')) {

                            $input_siswa = $this->IncomeModel->accept_import_data_siswa_dpb($data['data_check']);
                            if ($input_siswa == true) {

                                $input_payment = $this->IncomeModel->accept_import_data_payment_dpb($data['data_check']);

                                if ($input_payment == true) {

                                    $this->IncomeModel->clear_import_data_payment();
                                    $output = array("status" => true,
                                        "confirm" => false,
                                        "token" => $token,
                                        "messages" => "Berhasil!, Seluruh Data Tagihan DPB & Data Siswa Terpilih telah diimport ke database. dimohon untuk melakukan <b>Pengecekan Ulang</b>. Terima Kasih.",
                                    );
                                } else {
                                    $output = array("status" => false,
                                        "confirm" => false,
                                        "token" => $token,
                                        "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                                    );
                                }
                            } else {
                                $output = array("status" => false,
                                    "confirm" => false,
                                    "token" => $token,
                                    "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                                );
                            }
                        }
                    }
                }
            }
        } else {
            $output = array("status" => false,
                "confirm" => false,
                "token" => $token,
                "messages" => "Mohon Maaf., Password yang Anda inputkan salah!",
            );
        }
        echo json_encode($output);
    }

    public function reject_import_payment_du()
    {
        $token = $this->security->get_csrf_hash();
        $input = $this->IncomeModel->clear_import_data_payment();

        if ($input == true) {

            $output = array("status" => true,
                "token" => $token,
                "messages" => "Pemberitahuan!, Seluruh Data Tagihan DU sebelumnya batal diimport ke database. Terima Kasih.",
            );

        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf!, Terjadi Kesalahan, Silahkan import ulang..",
            );
        }
        echo json_encode($output);
    }

    public function reject_import_payment_dpb()
    {
        $token = $this->security->get_csrf_hash();
        $input = $this->IncomeModel->clear_import_data_payment();

        if ($input == true) {
            $output = array("status" => true,
                "token" => $token,
                "messages" => "Pemberitahuan!, Seluruh Data Tagihan DPB sebelumnya batal diimport ke database. Terima Kasih.",
            );

        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf!, Terjadi Kesalahan, Silahkan import ulang..",
            );
        }
        echo json_encode($output);
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

            $this->db->query('SET SESSION interactive_timeout = 28000');
            $this->db->query('SET SESSION wait_timeout = 28000');
            $this->db2->query('SET SESSION interactive_timeout = 28000');
            $this->db2->query('SET SESSION wait_timeout = 28000');
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
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
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

                        $index_header_rincian = [];
                        for ($z = 0; $z < count($sheetData[0]); $z++) {
                            if (strpos($sheetData[0][$z], 'rincian') !== false) {
                                $index_header_rincian[] = array('index_kolom' => $z, 'nama_kolom' => implode(' ', explode('_', explode('_', $sheetData[0][$z], 2)[1])));
                            }
                        }

                        $index_header_info = [];
                        for ($z = 0; $z < count($sheetData[0]); $z++) {
                            if (strpos($sheetData[0][$z], 'info') !== false) {
                                $index_header_info[] = array('index_kolom' => $z, 'nama_kolom' => implode(' ', explode('_', explode('_', $sheetData[0][$z], 2)[1])));
                            }
                        }

                        $data_siswa_array = array();
                        $start_date = '1900-01-01';
                        $level_tingkat = "";
                        $status_no_dpb = "";
                        $status_invoice = "";
                        $password = "";
                        $status_nama = "";

                        // Initialize arrays for tracking
                        $seenIdInv = [];
                        $duplicateIdInv = [];

                        $seenNoPay = [];
                        $duplicateNoPay = [];

                        $seenName = [];
                        $duplicateName = [];

                        $tahun_ajaran = $this->IncomeModel->get_schoolyear_now();

                        for ($i = 1; $i < count($sheetData); $i++) {

                            $rincian = "";
                            $info = "";
                            $last_index_rincian = "";
                            $last_index_info = "";
                            $currentIdInv = trim($sheetData[$i]['0']);
                            $currentNoPay = trim($sheetData[$i]['1']);
                            $currentName = trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3']));

                            $student = $this->IncomeModel->check_student_by_nomor_pembayaran_dpb($sheetData[$i]['1']);
                            $invoice = $this->IncomeModel->check_invoice_dpb_duplicate($sheetData[$i]['0']);

                            if ($student) {

                                if (isset($seenNoPay[$currentNoPay])) {
                                    $duplicateNoPay[$currentNoPay] = true;
                                    $status_no_dpb = 3; //nis terdafatar dan nama tidak mirip
                                } else {
                                    $seenNoPay[$currentNoPay] = true;
                                    $status_no_dpb = 1; //nis terdafatar dan nama mirip
                                }

                                if (isset($seenName[$currentName]) && isset($seenNoPay[$currentNoPay])) {
                                    $duplicateName[$currentName] = true;
                                    $status_nama = 3;
                                } else {
                                    $seenName[$currentName] = true;
                                    $result = $this->IncomeModel->check_match_name(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3'])));
                                    if ($result) {
                                        for ($j = 0; $j < count($result); $j++) {
                                            $score = $this->matching->single_text_match(strtoupper($result[$j]->nama_lengkap), strtoupper(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3']))));
                                            if ($score == 100) {
                                                $status_nama = 1;
                                                break;
                                            } elseif ($score >= 80 && $score < 100) {
                                                $status_nama = 4;
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

                                $check_student_name_and_number = $this->IncomeModel->check_student_by_name_and_number_dpb(trim($sheetData[$i]['1']), trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3'])));
                                if ($check_student_name_and_number) {
                                    $status_nama = 1;
                                    $password = $student[0]->password;
                                } else {
                                    $password = password_hash(paramEncrypt(trim($sheetData[$i]['1'])), PASSWORD_DEFAULT, array('cost' => 12));
                                }

                            } else {

                                if (isset($seenNoPay[$currentNoPay])) {
                                    $duplicateNoPay[$currentNoPay] = true;
                                    $status_no_dpb = 3;
                                } else {
                                    $seenNoPay[$currentNoPay] = true;
                                    $status_no_dpb = 2;
                                }

                                if (isset($seenName[$currentName]) && isset($seenNoPay[$currentNoPay])) {
                                    $duplicateName[$currentName] = true;
                                    $status_nama = 3;
                                } else {
                                    $seenName[$currentName] = true;
                                    $result = $this->IncomeModel->check_match_name(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3'])));
                                    if ($result) {
                                        for ($j = 0; $j < count($result); $j++) {
                                            $score = $this->matching->single_text_match(strtoupper($result[$j]->nama_lengkap), strtoupper(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3']))));
                                            if ($score >= 80 && $score <= 100) {
                                                $status_nama = 4;
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
                                $password = password_hash(paramEncrypt(trim($sheetData[$i]['1'])), PASSWORD_DEFAULT, array('cost' => 12));
                            }

                            if ($invoice) {
                                $status_invoice = 2; // jika duplikat
                            } else {
                                if (isset($seenIdInv[$currentIdInv])) {
                                    $duplicateIdInv[$currentIdInv] = true;
                                    $status_invoice = 3;
                                } else {
                                    $seenIdInv[$currentIdInv] = true;
                                    $status_invoice = 1;
                                }
                            }

                            for ($j = 0; $j < count($index_header_rincian); $j++) {
                                $rincian .= $index_header_rincian[$j]['nama_kolom'] . ": " . $sheetData[$i][$index_header_rincian[$j]['index_kolom']] . ", ";
                                $last_index_rincian = $index_header_rincian[$j]['index_kolom'];
                            }

                            for ($j = 0; $j < count($index_header_info); $j++) {
                                $info .= $index_header_info[$j]['nama_kolom'] . ": " . $sheetData[$i][$index_header_info[$j]['index_kolom']] . ", ";
                                $last_index_info = $index_header_info[$j]['index_kolom'];
                            }

                            if (strpos((strtoupper($sheetData[$i][intval($last_index_info)])), 'KB') !== false) {
                                $level_tingkat = "1";
                            } else if (strpos((strtoupper($sheetData[$i][intval($last_index_info)])), 'TK') !== false) {
                                $level_tingkat = "2";
                            } else if (strpos((strtoupper($sheetData[$i][intval($last_index_info)])), 'SD') !== false) {
                                $level_tingkat = "3";
                            } else if (strpos((strtoupper($sheetData[$i][intval($last_index_info)])), 'SMP') !== false) {
                                $level_tingkat = "4";
                            } else if (strpos((strtoupper($sheetData[$i][intval($last_index_info)])), 'DC') !== false) {
                                $level_tingkat = "6";
                            }

                            if ($sheetData[$i]['0']) {
                                $data_siswa_array[$i] = array(
                                    'id_invoice' => (filter_var(trim($sheetData[$i]['0']), FILTER_SANITIZE_STRING)),
                                    'level_tingkat' => (filter_var(trim($level_tingkat), FILTER_SANITIZE_STRING)),
                                    'tipe_tagihan' => (filter_var(trim(2), FILTER_SANITIZE_STRING)),
                                    'tanggal_invoice' => (filter_var(date('Y-m-d', strtotime("$start_date + " . ((int) $sheetData[$i]['4'] - 2) . " days")), FILTER_SANITIZE_STRING)),
                                    'nomor_siswa' => (filter_var(trim($sheetData[$i]['1']), FILTER_SANITIZE_STRING)),
                                    'password' => (trim($password)),
                                    'nama' => (filter_var(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3'])), FILTER_SANITIZE_STRING)),
                                    'informasi' => (filter_var(trim($info), FILTER_SANITIZE_STRING)),
                                    'nama_kelas' => (filter_var(trim($sheetData[$i][(intval($last_index_info))]), FILTER_SANITIZE_STRING)),
                                    'rincian' => (filter_var(trim($rincian), FILTER_SANITIZE_STRING)),
                                    'nominal_tagihan' => (filter_var(trim($sheetData[$i][(intval($last_index_rincian) + 1)]), FILTER_SANITIZE_STRING)),
                                    'catatan' => (filter_var(trim($sheetData[$i][(intval($last_index_rincian) + 4)]), FILTER_SANITIZE_STRING)),
                                    'email' => (filter_var(trim($sheetData[$i][(intval($last_index_rincian) + 2)]), FILTER_SANITIZE_STRING)),
                                    'nomor_hp' => (filter_var(trim(str_replace('+62', '0', $sheetData[$i][(intval($last_index_rincian) + 3)])), FILTER_SANITIZE_STRING)),
                                    'th_ajaran' => (filter_var(trim($tahun_ajaran[0]->id_tahun_ajaran), FILTER_SANITIZE_STRING)),
                                    'status_pembayaran' => (filter_var(trim('MENUNGGU'), FILTER_SANITIZE_STRING)),
                                    'status_nomor_terdaftar' => (filter_var(trim($status_no_dpb), FILTER_SANITIZE_STRING)),
                                    'status_nama_duplikat' => (filter_var(trim($status_nama), FILTER_SANITIZE_STRING)),
                                    'status_invoice_duplikat' => (filter_var(trim($status_invoice), FILTER_SANITIZE_STRING)),
                                );
                            }

                        }

                        $import_data = $this->db2->insert_batch('transisi_tagihan_pembayaran', $data_siswa_array);

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

            $this->db->query('SET SESSION interactive_timeout = 28000');
            $this->db->query('SET SESSION wait_timeout = 28000');
            $this->db2->query('SET SESSION interactive_timeout = 28000');
            $this->db2->query('SET SESSION wait_timeout = 28000');
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
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
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

                        $index_header_rincian = [];
                        for ($z = 0; $z < count($sheetData[0]); $z++) {
                            if (strpos($sheetData[0][$z], 'rincian') !== false) {
                                $index_header_rincian[] = array('index_kolom' => $z, 'nama_kolom' => implode(' ', explode('_', explode('_', $sheetData[0][$z], 2)[1])));
                            }
                        }

                        $index_header_info = [];
                        for ($z = 0; $z < count($sheetData[0]); $z++) {
                            if (strpos($sheetData[0][$z], 'info') !== false) {
                                $index_header_info[] = array('index_kolom' => $z, 'nama_kolom' => implode(' ', explode('_', explode('_', $sheetData[0][$z], 2)[1])));
                            }
                        }

                        $data_siswa_array = array();
                        $start_date = '1900-01-01';
                        $level_tingkat = "";
                        $status_no_du = "";
                        $status_invoice = "";
                        $status_nama = "";
                        $password = "";

                        // Initialize arrays for tracking
                        $seenIdInv = [];
                        $duplicateIdInv = [];

                        $seenNoPay = [];
                        $duplicateNoPay = [];

                        $seenName = [];
                        $duplicateName = [];

                        $tahun_ajaran = $this->IncomeModel->get_schoolyear_now();

                        for ($i = 1; $i < count($sheetData); $i++) {

                            $rincian = "";
                            $info = "";
                            $last_index_rincian = "";
                            $last_index_info = "";
                            $currentIdInv = trim($sheetData[$i]['0']);
                            $currentNoPay = trim($sheetData[$i]['1']);
                            $currentName = trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3']));

                            $student = $this->IncomeModel->check_student_by_nomor_pembayaran_du($sheetData[$i]['1']);
                            $invoice = $this->IncomeModel->check_invoice_du_duplicate($sheetData[$i]['0']);

                            if ($student) {

                                if (isset($seenNoPay[$currentNoPay])) {
                                    $duplicateNoPay[$currentNoPay] = true;
                                    $status_no_du = 3; //nis terdafatar dan nama tidak mirip
                                } else {
                                    $seenNoPay[$currentNoPay] = true;
                                    $status_no_du = 1; //nis terdafatar dan nama mirip
                                }

                                if (isset($seenName[$currentName]) && isset($seenNoPay[$currentNoPay])) {
                                    $duplicateName[$currentName] = true;
                                    $status_nama = 3;
                                } else {
                                    $seenName[$currentName] = true;
                                    $result = $this->IncomeModel->check_match_name(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3'])));
                                    if ($result) {
                                        for ($j = 0; $j < count($result); $j++) {
                                            $score = $this->matching->single_text_match(strtoupper($result[$j]->nama_lengkap), strtoupper(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3']))));
                                            if ($score == 100) {
                                                $status_nama = 1;
                                                break;
                                            } elseif ($score >= 80 && $score < 100) {
                                                $status_nama = 4;
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

                                $check_student_name_and_number = $this->IncomeModel->check_student_by_name_and_number_du(trim($sheetData[$i]['1']), trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3'])));
                                if ($check_student_name_and_number) {
                                    $status_nama = 1;
                                    $password = $student[0]->password;
                                } else {
                                    $password = password_hash(paramEncrypt(trim($sheetData[$i]['1'])), PASSWORD_DEFAULT, array('cost' => 12));
                                }

                            } else {

                                if (isset($seenNoPay[$currentNoPay])) {
                                    $duplicateNoPay[$currentNoPay] = true;
                                    $status_no_du = 3;
                                } else {
                                    $seenNoPay[$currentNoPay] = true;
                                    $status_no_du = 2;
                                }

                                if (isset($seenName[$currentName]) && isset($seenNoPay[$currentNoPay])) {
                                    $duplicateName[$currentName] = true;
                                    $status_nama = 3;
                                } else {
                                    $seenName[$currentName] = true;
                                    $result = $this->IncomeModel->check_match_name(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3'])));
                                    if ($result) {
                                        for ($j = 0; $j < count($result); $j++) {
                                            $score = $this->matching->single_text_match(strtoupper($result[$j]->nama_lengkap), strtoupper(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3']))));
                                            if ($score >= 80 && $score <= 100) {
                                                $status_nama = 4;
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
                                $password = password_hash(paramEncrypt(trim($sheetData[$i]['1'])), PASSWORD_DEFAULT, array('cost' => 12));
                            }

                            if ($invoice) {
                                $status_invoice = 2; // jika duplikat
                            } else {
                                if (isset($seenIdInv[$currentIdInv])) {
                                    $duplicateIdInv[$currentIdInv] = true;
                                    $status_invoice = 3;
                                } else {
                                    $seenIdInv[$currentIdInv] = true;
                                    $status_invoice = 1;
                                }
                            }

                            for ($j = 0; $j < count($index_header_rincian); $j++) {
                                $rincian .= $index_header_rincian[$j]['nama_kolom'] . ": " . $sheetData[$i][$index_header_rincian[$j]['index_kolom']] . ", ";
                                $last_index_rincian = $index_header_rincian[$j]['index_kolom'];
                            }

                            for ($j = 0; $j < count($index_header_info); $j++) {
                                $info .= $index_header_info[$j]['nama_kolom'] . ": " . $sheetData[$i][$index_header_info[$j]['index_kolom']] . ", ";
                                $last_index_info = $index_header_info[$j]['index_kolom'];
                            }

                            if (strpos((strtoupper($sheetData[$i][intval($last_index_info)])), 'KB') !== false) {
                                $level_tingkat = "1";
                            } else if (strpos((strtoupper($sheetData[$i][intval($last_index_info)])), 'TK') !== false) {
                                $level_tingkat = "2";
                            } else if (strpos((strtoupper($sheetData[$i][intval($last_index_info)])), 'SD') !== false) {
                                $level_tingkat = "3";
                            } else if (strpos((strtoupper($sheetData[$i][intval($last_index_info)])), 'SMP') !== false) {
                                $level_tingkat = "4";
                            } else if (strpos((strtoupper($sheetData[$i][intval($last_index_info)])), 'DC') !== false) {
                                $level_tingkat = "6";
                            }

                            if ($sheetData[$i]['0']) {
                                $data_siswa_array[$i] = array(
                                    'id_invoice' => (filter_var(trim($sheetData[$i]['0']), FILTER_SANITIZE_STRING)),
                                    'level_tingkat' => (filter_var($level_tingkat, FILTER_SANITIZE_STRING)),
                                    'tipe_tagihan' => (filter_var(trim(1), FILTER_SANITIZE_STRING)),
                                    'tanggal_invoice' => (filter_var(date('Y-m-d', strtotime("$start_date + " . ((int) $sheetData[$i]['4'] + 80) . " days")), FILTER_SANITIZE_STRING)),
                                    'nomor_siswa' => (filter_var(trim($sheetData[$i]['1']), FILTER_SANITIZE_STRING)),
                                    'password' => (trim($password)),
                                    'nama' => (filter_var(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['3'])), FILTER_SANITIZE_STRING)),
                                    'informasi' => (filter_var(trim($info), FILTER_SANITIZE_STRING)),
                                    'nama_kelas' => (filter_var(trim($sheetData[$i][(intval($last_index_info))]), FILTER_SANITIZE_STRING)),
                                    'rincian' => (filter_var(trim(strtoupper($rincian)), FILTER_SANITIZE_STRING)),
                                    'nominal_tagihan' => (filter_var(trim($sheetData[$i][(intval($last_index_rincian) + 1)]), FILTER_SANITIZE_STRING)),
                                    'catatan' => (filter_var(trim($sheetData[$i][(intval($last_index_rincian) + 4)]), FILTER_SANITIZE_STRING)),
                                    'email' => (filter_var(trim($sheetData[$i][(intval($last_index_rincian) + 2)]), FILTER_SANITIZE_STRING)),
                                    'nomor_hp' => (filter_var(trim(str_replace('+62', '0', $sheetData[$i][(intval($last_index_rincian) + 3)])), FILTER_SANITIZE_STRING)),
                                    'th_ajaran' => (filter_var(trim($tahun_ajaran[0]->id_tahun_ajaran), FILTER_SANITIZE_STRING)),
                                    'status_pembayaran' => (filter_var(trim('MENUNGGU'), FILTER_SANITIZE_STRING)),
                                    'status_nomor_terdaftar' => (filter_var(trim($status_no_du), FILTER_SANITIZE_STRING)),
                                    'status_nama_duplikat' => (filter_var(trim($status_nama), FILTER_SANITIZE_STRING)),
                                    'status_invoice_duplikat' => (filter_var(trim($status_invoice), FILTER_SANITIZE_STRING)),
                                );
                            }

                        }

                        $import_data = $this->db2->insert_batch('transisi_tagihan_pembayaran', $data_siswa_array);

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
        $id = $this->security->xss_clean($id);
        $id_dpb = paramDecrypt($id);

        $password = $this->input->post('password');
        $password = $this->security->xss_clean($password);

        $token = $this->security->get_csrf_hash();

        $income_dpb = $this->IncomeModel->get_income_dpb_by_id($id_dpb);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($id_dpb) {

                $check_pass = $this->IncomeModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($password, $check_pass[0]->password)) {
                    $delete = $this->IncomeModel->delete_income_dpb_by_id($id_dpb);
                    if ($delete == true) {
                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil, Tagihan DPB Atas Nama <b>" . $income_dpb[0]->nama_lengkap . " (" . $income_dpb[0]->nis . ")</b> Telah Terhapus..",
                        );

                    } else {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi Kesalahan, Silahkan hapus ulang..",
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
                    "messages" => "Opps!, ID Tagihan belum diinputkan, Silahkan coba lagi.",
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

    public function delete_income_du()
    {
        $id = $this->input->post('id');
        $id = $this->security->xss_clean($id);
        $id_du = paramDecrypt($id);

        $password = $this->input->post('password');
        $password = $this->security->xss_clean($password);

        $token = $this->security->get_csrf_hash();
        $income_du = $this->IncomeModel->get_income_du_by_id($id_du);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($id_du) {

                $check_pass = $this->IncomeModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($password, $check_pass[0]->password)) {
                    $delete = $this->IncomeModel->delete_income_du_by_id($id_du);
                    if ($delete == true) {
                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil, Tagihan DU Atas Nama <b>" . $income_du[0]->nama_lengkap . " (" . $income_du[0]->nis . ")</b> Telah Terhapus..",
                        );

                    } else {
                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi Kesalahan, Silahkan hapus ulang..",
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
                    "messages" => "Opps!, ID Tagihan belum diinputkan, Silahkan coba lagi.",
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

    public function delete_income_dpb_transition()
    {
        $id_tagihan = $this->input->post('id_tagihan');
        $id_invoice = $this->input->post('id_invoice');
        $nomor_bayar = $this->input->post('nomor_bayar');
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');

        $id = paramDecrypt($id_tagihan);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($id_tagihan) {

                $check_pass = $this->IncomeModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($password, $check_pass[0]->password)) {

                    $delete = $this->IncomeModel->delete_income_transition_by_id($id);

                    if ($delete == true) {
                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil, Data Impor Tagihan DPB <b>" . $id_invoice . "</b> Atas Nama <b>" . strtoupper($nama) . " (" . $nomor_bayar . ")</b> Telah Terhapus..",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Data Tagihan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
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
                    "messages" => "Opps!, ID Tagihan belum diinputkan, Silahkan coba lagi.",
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

    public function delete_income_du_transition()
    {
        $id_tagihan = $this->input->post('id_tagihan');
        $id_invoice = $this->input->post('id_invoice');
        $nomor_bayar = $this->input->post('nomor_bayar');
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');

        $id = paramDecrypt($id_tagihan);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($id_tagihan) {

                $check_pass = $this->IncomeModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($password, $check_pass[0]->password)) {

                    $delete = $this->IncomeModel->delete_income_transition_by_id($id);
                    if ($delete == true) {
                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil, Data Impor Tagihan DU <b>" . $id_invoice . "</b> Atas Nama <b>" . strtoupper($nama) . " (" . $nomor_bayar . ")</b> Telah Terhapus..",
                        );
                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Data Tgauhan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
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
                    "messages" => "Opps!, ID Tagihan belum diinputkan, Silahkan coba lagi.",
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

    public function send_notification($title = '', $proposal = '', $pemohon = '', $postlink = '')
    {

        $data = array(
            "app_id" => "affc3d22-cafb-4334-9814-91c150a08ea2",
            "included_segments" => array('Subscribed Users'),
            "headings" => array(
                "en" => "$title",
            ),
            "contents" => array(
                "en" => "PEMASUKAN: $proposal - ($pemohon)",
            ),
            "url" => "$postlink",
        );

        // Print Output in JSON Format
        $data_string = json_encode($data);
        // API URL
        $url = "https://onesignal.com/api/v1/notifications";
        //Curl Headers
        $headers = array(
            'Authorization: Basic NmIwYjFjOGMtMjkxMC00ZTM2LWE1NDctYWQxZjZmN2U4OWJj',
            'Content-Type: application/json; charset = utf-8',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

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
            if ($id_grad != '' || $id_grad != null) {
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
            $data[$i]['nominal_tagihan_formated'] = number_format($data[$i]['nominal_tagihan'], 0, ',', '.');
        }

        // count data
        $totalRecords = $totalDisplay = count($data);

        // filter by general search keyword
        if (isset($_REQUEST['search'])) {
            $data = $this->filterKeyword($data, $_REQUEST['search']);
            $totalDisplay = count($data);
        }

        if (isset($_REQUEST['columns']) && is_array($_REQUEST['columns'])) {
            foreach ($_REQUEST['columns'] as $column) {
                if (isset($column['search'])) {
                    $data = $this->filterKeyword($data, $column['search'], $column['data']);
                    $totalDisplay = count($data);
                }
            }
        }
        // sort
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['order'][0]['column'];
            $dir = $_REQUEST['order'][0]['dir'];
            usort($data, function ($a, $b) use ($column, $dir) {
                $aValue = array_values($a)[$column];
                $bValue = array_values($b)[$column];

                if ($dir === 'asc') {
                    return $aValue > $bValue ? 1 : -1;
                }

                return $aValue < $bValue ? 1 : -1;
            });
        }

        // pagination length
        if (isset($_REQUEST['length']) && $_REQUEST['length'] > 0) {
            $data = array_splice($data, $_REQUEST['start'], $_REQUEST['length']);
        }

        // return array values only without the keys
        if (isset($_REQUEST['array_values']) && $_REQUEST['array_values']) {
            $tmp = $data;
            $data = [];
            foreach ($tmp as $d) {
                $data[] = array_values($d);
            }
        }

        $result = [
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data' => $data,
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

        // Encrypt the 'id_tagihan_pembayaran_dpb' and add it to each item in the array
        for ($i = 0; $i < count($data); $i++) { // Use '<' instead of '<='
            $data[$i]['id_encrypt'] = paramEncrypt($data[$i]['id_tagihan_pembayaran_dpb']);
            $data[$i]['nominal_tagihan_formated'] = number_format($data[$i]['nominal_tagihan'], 0, ',', '.');
        }

        // count data
        $totalRecords = $totalDisplay = count($data);

        // filter by general search keyword
        if (isset($_REQUEST['search'])) {
            $data = $this->filterKeyword($data, $_REQUEST['search']);
            $totalDisplay = count($data);
        }

        if (isset($_REQUEST['columns']) && is_array($_REQUEST['columns'])) {
            foreach ($_REQUEST['columns'] as $column) {
                if (isset($column['search']) && $column['search'] !== '') {
                    $data = $this->filterKeyword($data, $column['search'], $column['data']);
                    $totalDisplay = count($data);
                }
            }
        }

        // sort
        if (isset($_REQUEST['order'][0]['column']) && $_REQUEST['order'][0]['dir']) {
            $column = $_REQUEST['order'][0]['column'];
            $dir = $_REQUEST['order'][0]['dir'];
            usort($data, function ($a, $b) use ($column, $dir) {
                $aValue = array_values($a)[$column];
                $bValue = array_values($b)[$column];

                if ($dir === 'asc') {
                    return $aValue > $bValue ? 1 : -1;
                }

                return $aValue < $bValue ? 1 : -1;
            });
        }

        // pagination length
        if (isset($_REQUEST['length']) && $_REQUEST['length'] > 0) {
            $data = array_splice($data, $_REQUEST['start'], $_REQUEST['length']);
        }

        // return array values only without the keys
        if (isset($_REQUEST['array_values']) && $_REQUEST['array_values']) {
            $tmp = $data;
            $data = [];
            foreach ($tmp as $d) {
                $data[] = array_values($d);
            }
        }

        $result = [
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data' => $data,
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
                $from = $filter[0];
                $to = $filter[1];
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
                $from = $filter[0];
                $to = $filter[0];
                if ($from <= $current && $to >= $current) {
                    return true;
                }

                return false;
            });
        }

        return $data;
    }
}
