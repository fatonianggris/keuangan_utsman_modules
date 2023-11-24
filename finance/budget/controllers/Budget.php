<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Budget extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('BudgetModel');
        $this->user_finance = $this->session->userdata("sias-finance");

        if ($this->session->userdata('sias-finance') == FALSE) {
            redirect('finance/auth');
        }
        $this->load->library('form_validation');
    }

    //
    //-------------------------------DASHBOARD------------------------------//
    //
    
    public function list_budget_fondation() {
        $data['nav_bud'] = 'menu-item-here';

        $data['structure'] = $this->BudgetModel->get_structure_account();
        $data['account'] = $this->BudgetModel->get_all_account();
        $data['schoolyear'] = $this->BudgetModel->get_schoolyear();
        $data['budget'] = $this->BudgetModel->get_budget_fondation();

        $this->template->load('template_finance/template_finance', 'finance_list_budget_fondation', $data);
    }

    public function list_budget_division() {
        $data['nav_bud'] = 'menu-item-here';

        $data['structure'] = $this->BudgetModel->get_structure_account();
        $data['account'] = $this->BudgetModel->get_core_account();
        $data['schoolyear'] = $this->BudgetModel->get_schoolyear();
        $data['budget'] = $this->BudgetModel->get_budget_division($this->user_finance[0]->role_akun);

        $this->template->load('template_finance/template_finance', 'finance_list_budget_division', $data);
    }

    public function detail_budget_fondation($id = '') {
        $id = paramDecrypt($id);

        $data['nav_bud'] = 'menu-item-here';
        $data['budget'] = $this->BudgetModel->get_budget_fondation_id($id); //? 
        $data['foto_bukti'] = $this->BudgetModel->get_img_recipe($data['budget'][0]->token);

        if ($data['budget'] == FALSE or empty($id)) {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        } else {
            $this->template->load('template_finance/template_finance', 'finance_detail_budget_fondation', $data);
        }
    }

    public function add_budget_fondation() {
        $data['nav_bud'] = 'menu-item-here';

        //$data['structure'] = $this->BudgetModel->get_structure_account();
        $data['schoolyear'] = $this->BudgetModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 4 || $this->user_finance[0]->id_role_struktur == 5 || $this->user_finance[0]->id_role_struktur == 6 || $this->user_finance[0]->id_role_struktur == 9) {
            $this->template->load('template_finance/template_finance', 'finance_add_budget_fondation', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function upload_lpj_fondation($id = '') {
        $id = paramDecrypt($id);

        $data['nav_bud'] = 'menu-item-here';
        $data['budget'] = $this->BudgetModel->get_budget_fondation_id($id);

        if ($data['budget'] == FALSE or empty($id)) {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        } else {
            if (($this->user_finance[0]->id_role_struktur == 4 || $this->user_finance[0]->id_role_struktur == 5 || $this->user_finance[0]->id_role_struktur == 6 || $this->user_finance[0]->id_role_struktur == 9) && ($data['budget'][0]->status_acc_proposal == 2 || $data['budget'][0]->status_acc_lpj == 3)) {
                $this->template->load('template_finance/template_finance', 'finance_upload_lpj_fondation', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function edit_proposal_fondation($id = '') {
        $id = paramDecrypt($id);

        $data['nav_bud'] = 'menu-item-here';
        $data['budget'] = $this->BudgetModel->get_budget_fondation_id($id);

        if ($data['budget'] == FALSE or empty($id)) {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        } else {
            if (($this->user_finance[0]->id_role_struktur == 4 || $this->user_finance[0]->id_role_struktur == 5 || $this->user_finance[0]->id_role_struktur == 6 || $this->user_finance[0]->id_role_struktur == 9) && ($data['budget'][0]->status_acc_proposal == 0 || $data['budget'][0]->status_acc_proposal == 3)) {
                $this->template->load('template_finance/template_finance', 'finance_edit_budget_fondation', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function post_budget_fondation() {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $this->form_validation->set_rules('nama_anggaran', 'Nama Proposal Anggaran', 'required');
        $this->form_validation->set_rules('nominal_dana_awal', 'Total Dana Anggaran ', 'required');
        $this->form_validation->set_rules('waktu', 'Waktu Penggunaan Anggaran', 'required');
        $this->form_validation->set_rules('id_tahun_ajaran', 'Tahun Ajaran Anggaran', 'required');
        $this->form_validation->set_rules('token', 'Token', 'required');

        $check = $this->BudgetModel->check_budget_duplicate($data['nama_anggaran']);
        $nama_bidang = $this->BudgetModel->check_name_division($this->user_finance[0]->role_akun);

        if ($check == TRUE) {

            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nama Anggaran tersebut Telah Tersedia."));
            redirect('finance/budget/budget/add_budget_fondation');
        } else {
            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
                redirect('finance/budget/budget/add_budget_fondation');
            } else {
                $this->load->library('upload'); //load library upload file

                if (!empty($_FILES['file_laporan_proposal']['tmp_name'])) {

                    $path = 'uploads/laporan/files/';
                    //config upload file
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 25048; //set without limit
                    $config['overwrite'] = FALSE; //if have same name, add number
                    $config['remove_spaces'] = TRUE; //change space into _
                    $config['encrypt_name'] = TRUE;
                    //initialize config upload
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file_laporan_proposal')) {//if success upload data
                        $result['upload'] = $this->upload->data();
                        $name = $result['upload']['file_name'];
                        $data['file_laporan_proposal'] = $path . $name;
                    } else {

                        $this->session->set_flashdata('flash_message', warn_msg($this->upload->display_errors()));
                        redirect('finance/budget/budget/add_budget_fondation');
                    }
                } else {

                    $this->session->set_flashdata('flash_message', warn_msg('Mohon Maaf, Silahkan Upload File Proposal Anggaran terlebih dahulu...'));
                    redirect('finance/budget/budget/add_budget_fondation');
                }
                $input = $this->BudgetModel->insert_budget_fondation($this->user_finance[0]->id_akun_keuangan, $data);

                if ($input == true) {

                    $this->apply_proposal($data['nama_anggaran'], $nama_bidang[0]->nama_struktur);
                    $this->send_notification_prop('PENGAJUAN PROPOSAL', $data['nama_anggaran'], $nama_bidang[0]->nama_struktur, site_url("/finance/budget/list_budget_fondation"));

                    $this->session->set_flashdata('flash_message', succ_msg("Berhasil Diajukan, Proposal '$data[nama_anggaran]' Anda telah diajukan. Silahkan cek Pengajuan Proposal Anda di menu Daftar Anggaran Yayasan"));
                    redirect('finance/budget/budget/add_budget_fondation');
                } else {

                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang...'));
                    redirect('finance/budget/budget/add_budget_fondation');
                }
            }
        }
    }

    public function update_budget_fondation($id = '') {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $id = paramDecrypt($id);

        $this->form_validation->set_rules('nama_anggaran', 'Nama Proposal Anggaran', 'required');
        $this->form_validation->set_rules('nominal_dana_awal', 'Total Dana Anggaran ', 'required');
        $this->form_validation->set_rules('waktu', 'Waktu Penggunaan Anggaran', 'required');
        $this->form_validation->set_rules('id_tahun_ajaran', 'Tahun Ajaran Anggaran', 'required');

        $check = $this->BudgetModel->check_budget_duplicate($data['nama_anggaran']);
        $get_old_name = $this->BudgetModel->get_old_name_budget($id);

        $nama_bidang = $this->BudgetModel->check_name_division($this->user_finance[0]->role_akun);

        $data['file_laporan_proposal'] = $data['file_laporan_proposal_old'];

        $file_old = explode('/', $data['file_laporan_proposal_old']);
        $file_name_old = $file_old[3];

        if ($check == TRUE && strtoupper(strtolower($data['nama_anggaran'])) != strtoupper(strtolower($get_old_name[0]->nama_anggaran))) {

            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nama Anggaran tersebut Telah Tersedia."));
            redirect('finance/budget/edit_proposal_fondation/' . paramEncrypt($id));
        } else {

            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
                redirect('finance/budget/edit_proposal_fondation/' . paramEncrypt($id));
            } else {
                $this->load->library('upload'); //load library upload file

                if (!empty($_FILES['file_laporan_proposal']['tmp_name'])) {

                    $this->delete_laporan_lama($file_name_old); //delete existing file

                    $path = 'uploads/laporan/files/';
                    //config upload file
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = 25048; //set without limit
                    $config['overwrite'] = FALSE; //if have same name, add number
                    $config['remove_spaces'] = TRUE; //change space into _
                    $config['encrypt_name'] = TRUE;
                    //initialize config upload
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file_laporan_proposal')) {//if success upload data
                        $result['upload'] = $this->upload->data();
                        $name = $result['upload']['file_name'];
                        $data['file_laporan_proposal'] = $path . $name;
                    } else {

                        $this->session->set_flashdata('flash_message', warn_msg($this->upload->display_errors()));
                        redirect('finance/budget/edit_proposal_fondation/' . paramEncrypt($id));
                    }
                }

                $input = $this->BudgetModel->update_budget_fondation($id, $data);

                if ($input == true) {

                    //$this->apply_proposal($data['nama_anggaran'], $nama_bidang[0]->nama_struktur);
                    $this->send_notification_prop('REVISI PROPOSAL', $data['nama_anggaran'], $nama_bidang[0]->nama_struktur, site_url("/finance/budget/detail_budget_fondation/" . paramEncrypt($id)));

                    $this->session->set_flashdata('flash_message', succ_msg("Berhasil Diupdate, Anggaran '$data[nama_anggaran]' Anda telah diupdate. Silahkan cek Pengajuan LPJ Anda di menu Daftar Anggaran Yayasan"));
                    redirect('finance/budget/edit_proposal_fondation/' . paramEncrypt($id));
                } else {

                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang.'));
                    redirect('finance/budget/edit_proposal_fondation/' . paramEncrypt($id));
                }
            }
        }
    }

    public function post_lpj_fondation() {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $id = paramDecrypt($data['id']);

        $this->form_validation->set_rules('nama_lpj', 'Nama LPJ', 'required');
        $this->form_validation->set_rules('nominal_dana_terpakai', 'Nominal Dana Terpakai ', 'required');
        $this->form_validation->set_rules('nominal_dana_eksternal', 'Nominal Dana Eksternal', 'required');

        $budget = $this->BudgetModel->get_budget_fondation_id($id); //?   

        $data['nominal_dana_sisa'] = (intval($budget[0]->nominal_dana_acc) + intval($data['nominal_dana_eksternal'])) - intval($data['nominal_dana_terpakai']);

        $nama_bidang = $this->BudgetModel->check_name_division($this->user_finance[0]->role_akun);

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/budget/budget/upload_lpj_fondation/' . paramEncrypt($id));
        } else {
            $this->load->library('upload'); //load library upload file

            if (!empty($_FILES['file_laporan_lpj']['tmp_name'])) {

                $path = 'uploads/laporan/files/';
                //config upload file
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 25048; //set without limit
                $config['overwrite'] = FALSE; //if have same name, add number
                $config['remove_spaces'] = TRUE; //change space into _
                $config['encrypt_name'] = TRUE;
                //initialize config upload
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file_laporan_lpj')) {//if success upload data
                    $result['upload'] = $this->upload->data();
                    $name = $result['upload']['file_name'];
                    $data['file_laporan_lpj'] = $path . $name;
                } else {

                    $this->session->set_flashdata('flash_message', warn_msg($this->upload->display_errors()));
                    redirect('finance/budget/budget/upload_lpj_fondation/' . paramEncrypt($id));
                }
            } else {

                $this->session->set_flashdata('flash_message', warn_msg('Mohon Maaf, Silahkan Upload File LPJ terlebih dahulu.'));
                redirect('finance/budget/budget/upload_lpj_fondation/' . paramEncrypt($id));
            }
            $input = $this->BudgetModel->update_lpj_fondation($id, $data);

            if ($input == true) {

                $this->apply_lpj($data['nama_lpj'], $nama_bidang[0]->nama_struktur);
                $this->send_notification_prop('PENGAJUAN LPJ', $data['nama_lpj'], $nama_bidang[0]->nama_struktur, site_url("/finance/budget/detail_budget_fondation/" . paramEncrypt($id)));

                $this->session->set_flashdata('flash_message', succ_msg("Berhasil Diupload, LPJ '$data[nama_lpj]' Anda telah diupload. Silahkan cek Pengajuan LPJ Anda di menu Daftar Anggaran Yayasan"));
                redirect('finance/budget/budget/upload_lpj_fondation/' . paramEncrypt($id));
            } else {

                $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang.'));
                redirect('finance/budget/budget/upload_lpj_fondation/' . paramEncrypt($id));
            }
        }
    }

    public function update_lpj_fondation() {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $id = paramDecrypt($data['id']);

        $this->form_validation->set_rules('nama_lpj', 'Nama LPJ', 'required');
        $this->form_validation->set_rules('nominal_dana_terpakai', 'Nominal Dana Terpakai ', 'required');
        $this->form_validation->set_rules('nominal_dana_eksternal', 'Nominal Dana Eksternal', 'required');

        $budget = $this->BudgetModel->get_budget_fondation_id($id); //?   
        $nama_bidang = $this->BudgetModel->check_name_division($this->user_finance[0]->role_akun);

        $data['nominal_dana_sisa'] = (intval($budget[0]->nominal_dana_acc) + intval($data['nominal_dana_eksternal'])) - intval($data['nominal_dana_terpakai']);

        $data['file_laporan_lpj'] = $data['file_laporan_lpj_old'];

        $file_old = explode('/', $data['file_laporan_lpj_old']);
        $file_name_old = $file_old[3];

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/budget/budget/upload_lpj_fondation/' . paramEncrypt($id));
        } else {
            $this->load->library('upload'); //load library upload file

            if (!empty($_FILES['file_laporan_lpj']['tmp_name'])) {

                $this->delete_laporan_lama($file_name_old); //delete existing file

                $path = 'uploads/laporan/files/';
                //config upload file
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 25048; //set without limit
                $config['overwrite'] = FALSE; //if have same name, add number
                $config['remove_spaces'] = TRUE; //change space into _
                $config['encrypt_name'] = TRUE;
                //initialize config upload
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file_laporan_lpj')) {//if success upload data
                    $result['upload'] = $this->upload->data();
                    $name = $result['upload']['file_name'];
                    $data['file_laporan_lpj'] = $path . $name;
                } else {
                    echo "2";
                }
            }

            $input = $this->BudgetModel->update_lpj_fondation($id, $data);
            if ($input == true) {

                //$this->apply_lpj($data['nama_lpj'], $nama_bidang[0]->nama_struktur);
                $this->send_notification_prop('REVISI LPJ', $data['nama_lpj'], $nama_bidang[0]->nama_struktur, site_url("/finance/budget/detail_budget_fondation/" . paramEncrypt($id)));

                echo "1";
            } else {
                echo "0";
            }
        }
    }

    public function apply_proposal_fondation($id = '') {
        $id = paramDecrypt($id);

        $data['nav_bud'] = 'menu-item-here';
        $data['budget'] = $this->BudgetModel->get_budget_fondation_id($id); //?   

        if ($data['budget'] == FALSE or empty($id)) {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        } else {
            if ($this->user_finance[0]->id_role_struktur == 2 && $data['budget'][0]->status_acc_proposal == 1) {
                $this->load->view('finance_ttd_prop_fondation', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function accept_proposal_acc() {
        $this->load->library('upload'); //load library upload file

        $file_name = $this->input->post('file_name');
        $id = $this->input->post('id');
        $id = paramDecrypt($id);

        $status = $this->BudgetModel->get_budget_fondation_id($id);

        if (!empty($_FILES['file_prop_acc']['tmp_name'])) {

            $path = 'uploads/laporan/files/';
            //config upload file

            if ($status[0]->file_laporan_proposal_acc != "" || $status[0]->file_laporan_proposal_acc != NULL) {
                $this->delete_laporan_lama($file_name);
                $config['file_name'] = $file_name;
            } else {
                $config['encrypt_name'] = TRUE;
            }
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 25048; //set without limit
            $config['overwrite'] = FALSE; //if have same name, add number
            $config['remove_spaces'] = TRUE; //change space into _
            //initialize config upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_prop_acc')) {//if success upload data
                $result['upload'] = $this->upload->data();
                $name = $result['upload']['file_name'];
                $path_file = $path . $name;

                $this->confirm_proposal($status[0]->nama_anggaran, 'PROPOSAL DITERIMA KETUA', $status[0]->email_akun, $status[0]->nama_struktur, 'DITERIMA', '#1BC5BD');
                $this->send_notification_prop('PROPOSAL DITERIMA KETUA', $status[0]->nama_anggaran, $status[0]->nama_struktur, site_url("/finance/budget/detail_budget_fondation/" . paramEncrypt($id)));

                $this->BudgetModel->update_status_proposal($id, 2, $path_file, $status[0]->nominal_dana_acc, '');

                echo '1';
            } else {
                echo '0';
            }
        }
    }

    public function reject_proposal_acc() {
        $id = $this->input->post('id');
        $id = paramDecrypt($id);
        $ket = $this->input->post('keterangan');

        $status = $this->BudgetModel->get_budget_fondation_id($id);

        if ($status[0]->status_acc_proposal == '0') {

            $this->confirm_proposal($status[0]->nama_anggaran, 'PROPOSAL DITOLAK KETUA', $status[0]->email_akun, $status[0]->nama_struktur, 'DITOLAK', '#EE2D41');
            $this->send_notification_prop('PROPOSAL DITOLAK KETUA', $status[0]->nama_anggaran, $status[0]->nama_struktur, site_url("/finance/budget/detail_budget_fondation/" . paramEncrypt($id)));

            $this->BudgetModel->update_status_proposal($id, 3, '', $status[0]->nominal_dana_acc, $ket);
            echo '1';
        } else {
            echo '0';
        }
    }

    public function upload_recipe_fondation($id = '') {
        $id = paramDecrypt($id);

        $data['nav_bud'] = 'menu-item-here';
        $data['budget'] = $this->BudgetModel->get_budget_fondation_id($id); //?   

        if ($data['budget'] == FALSE or empty($id)) {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        } else {
            if ($this->user_finance[0]->id_role_struktur == 5 && $data['budget'][0]->status_acc_proposal == 2) {
                $this->template->load('template_finance/template_finance', 'finance_upload_recipe_fondation', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function confirm_bendahara_budget_fondation($id = '') {
        $id = paramDecrypt($id);

        $data['nav_bud'] = 'menu-item-here';
        $data['budget'] = $this->BudgetModel->get_budget_fondation_id($id); //?  

        if ($data['budget'] == FALSE or empty($id)) {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        } else {
            if ($this->user_finance[0]->id_role_struktur == 5) {
                $this->template->load('template_finance/template_finance', 'finance_confirm_bendahara_budget_fondation', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function confirm_bendahara_lpj_fondation($id = '') {
        $id = paramDecrypt($id);

        $data['nav_bud'] = 'menu-item-here';
        $data['budget'] = $this->BudgetModel->get_budget_fondation_id($id); //?   

        $check_role = $this->BudgetModel->check_role($this->user_finance[0]->id_akun_keuangan);

        if ($data['budget'] == FALSE or empty($id)) {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        } else {
            if ($check_role[0]->id_role_struktur == 5) {
                $this->template->load('template_finance/template_finance', 'finance_confirm_bendahara_lpj_fondation', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function confirm_ketua_prop_fondation($id = '') {
        $id = paramDecrypt($id);

        $data['nav_bud'] = 'menu-item-here';
        $data['budget'] = $this->BudgetModel->get_budget_fondation_id($id); //?   

        $check_role = $this->BudgetModel->check_role($this->user_finance[0]->id_akun_keuangan);

        if ($data['budget'] == FALSE or empty($id)) {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        } else {
            if ($check_role[0]->id_role_struktur == 2) {
                $this->template->load('template_finance/template_finance', 'finance_confirm_ketua_prop_fondation', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function accept_bendahara_budget_fondation() {
        $this->load->library('upload'); //load library upload file

        $id = $this->input->post('id');
        $id = paramDecrypt($id);

        $nominal_acc = $this->input->post('nominal_dana_acc');
        $status = $this->BudgetModel->get_budget_fondation_id($id);
        $file_prop_acc = '';

        if (!empty($_FILES['file_prop_acc']['tmp_name'])) {

            $path = 'uploads/laporan/files/';
            //config upload file
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 25048; //set without limit
            $config['overwrite'] = FALSE; //if have same name, add number
            $config['remove_spaces'] = TRUE; //change space into _
            $config['encrypt_name'] = TRUE;
            //initialize config upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_prop_acc')) {//if success upload data
                $result['upload'] = $this->upload->data();
                $name = $result['upload']['file_name'];
                $file_prop_acc = $path . $name;
            }
        }

        if ($status[0]->status_acc_proposal == '0') {

            if ($status[0]->id_role_struktur == '9') {
                $this->confirm_proposal($id, $status[0]->nama_anggaran, 'PROPOSAL DITERIMA', $status[0]->email_akun, $status[0]->nama_struktur, 'DIRPOSES*', '#1BC5BD');
                $this->send_notification_prop('PROPOSAL DITERIMA', $status[0]->nama_anggaran, $status[0]->nama_struktur, site_url("/finance/budget/detail_budget_fondation/" . paramEncrypt($id)));

                $this->BudgetModel->update_status_proposal($id, 2, $file_prop_acc, $nominal_acc, '');
            } else {
                $this->confirm_proposal($id, $status[0]->nama_anggaran, 'PROPOSAL DIPROSES BENDAHARA', $status[0]->email_akun, $status[0]->nama_struktur, 'DIRPOSES*', '#1BC5BD');
                $this->send_notification_prop('PROPOSAL DIPROSES BENDAHARA', $status[0]->nama_anggaran, $status[0]->nama_struktur, site_url("/finance/budget/detail_budget_fondation/" . paramEncrypt($id)));

                $this->BudgetModel->update_status_proposal($id, 1, $file_prop_acc, $nominal_acc, '');
            }
            echo '1';
        } else {
            echo '0';
        }
    }

    public function update_bendahara_budget_fondation() {
        $this->load->library('upload'); //load library upload file

        $id = $this->input->post('id');
        $id = paramDecrypt($id);

        $nominal_acc = $this->input->post('nominal_dana_acc');
        $status = $this->BudgetModel->get_budget_fondation_id($id);

        $file_prop_acc = $this->input->post('file_prop_acc_old');

        if (!empty($_FILES['file_prop_acc']['tmp_name'])) {

            $file_old = explode('/', $file_prop_acc);
            $file_name_old = $file_old[3];

            $this->delete_laporan_lama($file_name_old);

            $path = 'uploads/laporan/files/';
            //config upload file
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 25048; //set without limit
            $config['overwrite'] = FALSE; //if have same name, add number
            $config['remove_spaces'] = TRUE; //change space into _
            $config['encrypt_name'] = TRUE;
            //initialize config upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_prop_acc')) {//if success upload data
                $result['upload'] = $this->upload->data();
                $name = $result['upload']['file_name'];
                $file_prop_acc = $path . $name;
            }
        }

        if ($status[0]->status_acc_proposal == '1') {
            $this->BudgetModel->update_status_proposal($id, 1, $file_prop_acc, $nominal_acc, '');
            echo '1';
        } else {
            echo '0';
        }
    }

    public function reject_bendahara_budget_fondation() {
        $id = $this->input->post('id');
        $id = paramDecrypt($id);
        $ket = $this->input->post('keterangan_prop');

        $status = $this->BudgetModel->get_budget_fondation_id($id);

        if ($status[0]->status_acc_proposal == '0') {
            $this->confirm_proposal($status[0]->nama_anggaran, 'PROPOSAL DITOLAK BENDAHARA', $status[0]->email_akun, $status[0]->nama_struktur, 'DITOLAK', '#EE2D41');
            $this->send_notification_prop('PROPOSAL DITOLAK BENDAHARA', $status[0]->nama_anggaran, $status[0]->nama_struktur, site_url("/finance/budget/detail_budget_fondation/" . paramEncrypt($id)));

            $this->BudgetModel->update_status_proposal($id, 3, '', 0, $ket);
            echo '1';
        } else {
            echo '0';
        }
    }

    public function accept_bendahara_lpj_fondation() {
        $this->load->library('upload'); //load library upload file

        $id = $this->input->post('id');
        $id = paramDecrypt($id);

        $status = $this->BudgetModel->get_budget_fondation_id($id);

        $file_lpj_acc = '';

        if (!empty($_FILES['file_lpj_acc']['tmp_name'])) {

            $path = 'uploads/laporan/files/';
            //config upload file
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 25048; //set without limit
            $config['overwrite'] = FALSE; //if have same name, add number
            $config['remove_spaces'] = TRUE; //change space into _
            $config['encrypt_name'] = TRUE;
            //initialize config upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_lpj_acc')) {//if success upload data
                $result['upload'] = $this->upload->data();
                $name = $result['upload']['file_name'];
                $file_lpj_acc = $path . $name;
            }
        }

        if ($status[0]->status_acc_lpj == '1') {
            $this->confirm_lpj($id, $status[0]->nama_anggaran, 'LPJ DITERIMA', $status[0]->email_akun, $status[0]->nama_struktur, 'DIRPOSES*', '#1BC5BD');
            $this->send_notification_prop('LPJ DITERIMA', $status[0]->nama_anggaran, $status[0]->nama_struktur, site_url("/finance/budget/detail_budget_fondation/" . paramEncrypt($id)));

            $this->BudgetModel->update_status_lpj($id, 2, $file_lpj_acc, '');
            echo '1';
        } else {
            echo '0';
        }
    }

    public function update_bendahara_lpj_fondation() {
        $this->load->library('upload'); //load library upload file

        $id = $this->input->post('id');
        $id = paramDecrypt($id);

        $status = $this->BudgetModel->get_budget_fondation_id($id);

        $file_lpj_acc = $this->input->post('file_lpj_acc_old');

        if (!empty($_FILES['file_lpj_acc']['tmp_name'])) {

            $file_old = explode('/', $file_lpj_acc);
            $file_name_old = $file_old[3];

            $this->delete_laporan_lama($file_name_old);

            $path = 'uploads/laporan/files/';
            //config upload file
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 25048; //set without limit
            $config['overwrite'] = FALSE; //if have same name, add number
            $config['remove_spaces'] = TRUE; //change space into _
            $config['encrypt_name'] = TRUE;
            //initialize config upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_lpj_acc')) {//if success upload data
                $result['upload'] = $this->upload->data();
                $name = $result['upload']['file_name'];
                $file_lpj_acc = $path . $name;
            }
        }

        if ($status[0]->status_acc_lpj == '2') {
            $this->BudgetModel->update_status_lpj($id, 2, $file_lpj_acc, '');
            echo '1';
        } else {
            echo '0';
        }
    }

    public function reject_bendahara_lpj_fondation() {
        $id = $this->input->post('id');
        $id = paramDecrypt($id);
        $ket = $this->input->post('keterangan_lpj');

        $status = $this->BudgetModel->get_budget_fondation_id($id);

        if ($status[0]->status_acc_lpj == '1') {
            $this->confirm_proposal($status[0]->nama_anggaran, 'LPJ DITOLAK', $status[0]->email_akun, $status[0]->nama_struktur, 'DITOLAK', '#EE2D41');
            $this->send_notification_prop('LPJ DITOLAK', $status[0]->nama_anggaran, $status[0]->nama_struktur, site_url("/finance/budget/detail_budget_fondation/" . paramEncrypt($id)));

            $this->BudgetModel->update_status_lpj($id, 3, '', $ket);
            echo '1';
        } else {
            echo '0';
        }
    }

    public function apply_proposal($nama = '', $pemohon = '') {

        $data['page'] = $this->BudgetModel->get_page();
        $data['contact'] = $this->BudgetModel->get_contact();
        $get_mail = $this->BudgetModel->get_core_mail();

        $data['nama_proposal'] = $nama;
        $data['pemohon'] = $pemohon;
        $data['status'] = 'PENGAJUAN';
        $data['color'] = '#1BC5BD';

        $data['subjek'] = "PENGAJUAN PROPOSAL";
        $content = $this->load->view('mailer_template/proposal', $data, true); // Ambil isi file content.php dan masukan ke variabel $content

        foreach ($get_mail as $mail) {
            $sendmail = array(
                'email_penerima' => $mail->email_akun,
                'subjek' => $data['subjek'],
                'content' => $content,
            );
            $this->mailer->send($sendmail); // Panggil fungsi send yang ada di librari Mailer
        }
        // Panggil fungsi send yang ada di librari Mailer
    }

    public function apply_lpj($nama = '', $pemohon = '') {

        $data['page'] = $this->BudgetModel->get_page();
        $data['contact'] = $this->BudgetModel->get_contact();
        $get_mail = $this->BudgetModel->get_bendahara_mail();

        $data['nama_lpj'] = $nama;
        $data['pemohon'] = $pemohon;
        $data['status'] = 'PENGAJUAN';
        $data['color'] = '#1BC5BD';

        $data['subjek'] = "PENGAJUAN LPJ";
        $content = $this->load->view('mailer_template/lpj', $data, true); // Ambil isi file content.php dan masukan ke variabel $content

        foreach ($get_mail as $mail) {
            $sendmail = array(
                'email_penerima' => $mail->email_akun,
                'subjek' => $data['subjek'],
                'content' => $content,
            );
            $this->mailer->send($sendmail); // Panggil fungsi send yang ada di librari Mailer
        }
        // Panggil fungsi send yang ada di librari Mailer
    }

    public function confirm_proposal($nama = '', $subjek = '', $email = '', $pemohon = '', $status = '', $color = '') {

        $data['page'] = $this->BudgetModel->get_page();
        $data['contact'] = $this->BudgetModel->get_contact();

        $data['nama_proposal'] = $nama;
        $data['pemohon'] = $pemohon;
        $data['status'] = $status;
        $data['color'] = $color;
        $data['subjek'] = $subjek;

        $content = $this->load->view('mailer_template/proposal', $data, true); // Ambil isi file content.php dan masukan ke variabel $content

        $sendmail = array(
            'email_penerima' => $email,
            'subjek' => $data['subjek'],
            'content' => $content,
        );

        if ($email) {
            $this->mailer->send($sendmail);
            echo '1';
        } else {
            echo '0';
        }
    }

    public function confirm_lpj($nama = '', $subjek = '', $email = '', $pemohon = '', $status = '', $color = '') {

        $data['page'] = $this->BudgetModel->get_page();
        $data['contact'] = $this->BudgetModel->get_contact();

        $data['nama_lpj'] = $nama;
        $data['pemohon'] = $pemohon;
        $data['status'] = $status;
        $data['color'] = $color;
        $data['subjek'] = $subjek;

        $content = $this->load->view('mailer_template/lpj', $data, true); // Ambil isi file content.php dan masukan ke variabel $content

        $sendmail = array(
            'email_penerima' => $email,
            'subjek' => $data['subjek'],
            'content' => $content,
        );

        if ($email) {
            $this->mailer->send($sendmail);
            echo '1';
        } else {
            echo '0';
        }
        // Panggil fungsi send yang ada di librari Mailer
    }

    public function delete_budget_fondation() {
        $id = $this->input->post('id');
        $id = paramDecrypt($id);

        $budget = $this->BudgetModel->get_budget_fondation_id($id);

        $file_pro = explode('/', $budget[0]->file_laporan_lpj);
        $file_name_pro = $file_pro[3];

        $file_lpj = explode('/', $budget[0]->file_laporan_lpj);
        $file_name_lpj = $file_lpj[3];

        $delete = $this->BudgetModel->delete_budget_fondation($id);

        if ($delete == true) {
            $this->delete_laporan_lama($file_name_pro);
            $this->delete_laporan_lama($file_name_lpj);
            $this->session->set_flashdata('flash_message', succ_msg("Berhasil, Anggaran Telah Terhapus.."));
            redirect('finance/budget/budget/list_budget_fondation');
        } else {

            $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan...'));
            redirect('finance/budget/budget/list_budget_fondation');
        }
    }

    //---------------------------DROPZONE-----------------------------------//

    public function upload() {

        $token = $this->input->post('token');

        $this->load->library('upload'); //load library upload file
        $this->load->library('image_lib'); //load library image

        $img_source = '';
        $img_thumb = '';

        if (!empty($_FILES['file'])) {

            $path = 'uploads/recipe/images/';
            $path_thumb = 'uploads/recipe/images/thumbs/';
            //config upload file
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 3048; //set without limit
            $config['overwrite'] = FALSE; //if have same name, add number
            $config['remove_spaces'] = TRUE; //change space into _
            $config['encrypt_name'] = TRUE;
            //initialize config upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload("file")) {
                $result['upload'] = $this->upload->data();
                $name = $result['upload']['file_name'];
                $img_source = $path . $name;

                $img['image_library'] = 'gd2';
                $img['source_image'] = $path . $name;
                $img['new_image'] = $path_thumb . $name;
                $img['maintain_ratio'] = true;
                $img['width'] = 600;
                $img['weight'] = 600;

                $this->image_lib->initialize($img);
                if ($this->image_lib->resize()) {//if success to resize (create thumbs)
                    $img_thumb = $path_thumb . $name;
                } else {
                    echo $this->image_lib->display_errors();
                }
                $this->db->insert('bukti', array('bukti_anggaran' => $img_source, 'bukti_anggaran_thumb' => $img_thumb, 'token' => $token));
            } else {
                echo "failed to upload file(s)";
            }
        }
    }

    public function remove() {
        $nama = $this->input->post("file");
        $img_thumb = 'uploads/recipe/images/thumbs/' . $nama;
        $bukti = $this->db->get_where('bukti', array('bukti_anggaran_thumb' => $img_thumb));
        if ($bukti->num_rows() > 0) {
            $hasil = $bukti->row();
            $nama_bukti = $hasil->bukti_anggaran;
            $nama_bukti_thumb = $hasil->bukti_anggaran_thumb;

            if (file_exists($nama_bukti)) {
                unlink($nama_bukti);
                unlink($nama_bukti_thumb);
            }
            $this->db->delete('bukti', array('bukti_anggaran_thumb' => $img_thumb));
        }
    }

    public function list_files($token = '') {

        $bukti = $this->db->get_where('bukti', array('token' => $token));
        // we need name and size for dropzone mockfile
        $value = array();
        foreach ($bukti->result() as $val) {
            $data_img = explode('/', $val->bukti_anggaran_thumb);
            $value[] = array(
                'name' => $data_img[4],
                'size' => filesize($val->bukti_anggaran_thumb)
            );
        }
        header("Content-type: text/json");
        header("Content-type: application/json");
        echo json_encode($value);
    }

    public function send_notification_prop($title = '', $proposal = '', $pemohon = '', $postlink = '') {

        $data = array(
            "app_id" => "affc3d22-cafb-4334-9814-91c150a08ea2",
            "included_segments" => array('Subscribed Users'),
            "headings" => array(
                "en" => "$title"
            ),
            "contents" => array(
                "en" => "PROPOSAL: $proposal - ($pemohon)"
            ),
            "url" => "$postlink"
        );

        // Print Output in JSON Format
        $data_string = json_encode($data);

        // API URL
        $url = "https://onesignal.com/api/v1/notifications";

        //Curl Headers
        $headers = array
            (
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

    public function delete_laporan_lama($name = '') {
        $path = 'uploads/laporan/files/';
        @unlink($path . $name);
    }

    //-----------------------------------------------------------------------//
//
}
