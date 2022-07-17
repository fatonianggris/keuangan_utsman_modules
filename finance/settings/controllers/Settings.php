<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        if ($this->session->userdata('sias-finance') == FALSE) {
            redirect('finance/auth');
        }
        $this->user_student = $this->session->userdata("sias-finance");

        if ($this->user_student[0]->role_akun != 1) {
            redirect('finance/dashboard');
        }
        $this->load->model('SettingsModel');
        $this->load->library('form_validation');
    }

    //
    //-------------------------------SETTING------------------------------//
    //
    
    public function email_configuration() {

        $data['title'] = 'Control Panel | Pengaturan Login Admin ';
        $data['nav_set'] = 'menu-item-here';

        $data['mailer'] = $this->SettingsModel->get_mail_config(); //?    
        $this->template->load('template_finance/template_finance', 'finance_view_email_config', $data);
    }

    public function contact_configuration() {

        $data['title'] = 'Control Panel | Pengaturan Login Admin ';
        $data['nav_set'] = 'menu-item-here';

        $data['contact'] = $this->SettingsModel->get_contact_config(); //?    
        $this->template->load('template_finance/template_finance', 'finance_view_contact_config', $data);
    }

    public function general_page_configuration() {

        $data['title'] = 'Control Panel | Pengaturan Login Admin ';
        $data['nav_set'] = 'menu-item-here';

        $data['page'] = $this->SettingsModel->get_page_config(); //?    
        $this->template->load('template_finance/template_finance', 'finance_view_page_config', $data);
    }

    public function account_structure_configuration() {

        $data['title'] = 'Control Panel | Pengaturan Login Admin ';
        $data['nav_set'] = 'menu-item-here';

        $data['structure'] = $this->SettingsModel->get_structure_account_config(); //?    
        $this->template->load('template_finance/template_finance', 'finance_view_account_structure', $data);
    }

    public function post_structure() {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $this->form_validation->set_rules('id_role_struktur', 'Role Struktur', 'required');
        $this->form_validation->set_rules('nama_struktur', 'Nama Struktur ', 'required');

        $check = $this->SettingsModel->check_structure_duplicate($data['nama_struktur']);

        if ($check == TRUE) {

            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nama Struktur tersebut Telah Tersedia..."));
            redirect('finance/settings/account_structure_configuration');
        } else {
            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
                redirect('finance/settings/account_structure_configuration');
            } else {

                $input = $this->SettingsModel->insert_structure($data);
                if ($input == true) {

                    $this->session->set_flashdata('flash_message', succ_msg("Berhasil, Nama Struktur '$data[nama_struktur]' telah disimpan.."));
                    redirect('finance/settings/account_structure_configuration');
                } else {

                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang...'));
                    redirect('finance/settings/account_structure_configuration');
                }
            }
        }
    }

    public function update_structure($id = '') {
        $id = paramDecrypt($id);

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $this->form_validation->set_rules('id_role_struktur', 'Role Struktur', 'required');
        $this->form_validation->set_rules('nama_struktur', 'Nama Struktur ', 'required');

        $get_name = $this->SettingsModel->get_structure_id($id);
        $check = $this->SettingsModel->check_structure_duplicate($data['nama_struktur']);

        if ($check == TRUE && $data['nama_struktur'] != $get_name[0]->nama_struktur) {

            $this->session->set_flashdata('flash_message', warn_msg("Mohon Maaf, Nama Struktur tersebut Telah Tersedia..."));
            redirect('finance/settings/account_structure_configuration');
        } else {

            if ($this->form_validation->run() == FALSE) {
                //
                $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
                redirect('finance/settings/account_structure_configuration');
            } else {

                // print_r($data);exit;    
                $edit = $this->SettingsModel->update_structure($id, $data);
                if ($edit == true) {

                    $this->session->set_flashdata('flash_message', succ_msg("Berhasil, Edit Struktur Telah Terupdate.."));
                    redirect('finance/settings/account_structure_configuration');
                } else {

                    $this->session->set_flashdata('flash_message', err_msg('Maaf, Terjadi kesalahan...'));
                    redirect('finance/settings/account_structure_configuration');
                }
            }
        }
    }

    public function update_mailer() {

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $this->form_validation->set_rules('nama_pengirim', 'Nama Pengirim', 'required');
        $this->form_validation->set_rules('host', 'Host', 'required');
        $this->form_validation->set_rules('email_induk', 'Email Utama', 'required');
        $this->form_validation->set_rules('password', 'Password Email', 'required');
        $this->form_validation->set_rules('port', 'Port', 'required');
        $this->form_validation->set_rules('smtp_auth', 'SMTP AUTH', 'required');
        $this->form_validation->set_rules('smtp_secure', 'SMTP SECURE', 'required');

        if ($this->form_validation->run() == FALSE) {
            //
            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/settings/email_configuration');
        } else {

            // print_r($data);exit;    
            $edit = $this->SettingsModel->update_mailer(1, $data);
            if ($edit == true) {

                $this->session->set_flashdata('flash_message', succ_msg("Berhasil, Konfigurasi Email Telah Terupdate.."));
                redirect('finance/settings/email_configuration');
            } else {

                $this->session->set_flashdata('flash_message', err_msg('Maaf, Terjadi kesalahan...'));
                redirect('finance/settings/email_configuration');
            }
        }
    }

    public function update_contact() {

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $this->form_validation->set_rules('alamat', 'Alamat Kantor', 'required');
        $this->form_validation->set_rules('nomor_telephone', 'Nomor Telephone Kantor', 'required');
        $this->form_validation->set_rules('no_handphone', 'Nomor Handphone Kantor', 'required');
        $this->form_validation->set_rules('email', 'Email Website', 'required');
        $this->form_validation->set_rules('jam_kerja', 'Jam Kerja', 'required');

        if ($this->form_validation->run() == FALSE) {
            //
            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/settings/contact_configuration');
        } else {

            // print_r($data);exit;    
            $edit = $this->SettingsModel->update_contact(1, $data);
            if ($edit == true) {

                $this->session->set_flashdata('flash_message', succ_msg("Berhasil, Konfigurasi Kontak Website Telah Terupdate.."));
                redirect('finance/settings/contact_configuration');
            } else {

                $this->session->set_flashdata('flash_message', err_msg('Maaf, Terjadi kesalahan...'));
                redirect('finance/settings/contact_configuration');
            }
        }
    }

    public function update_general_page() {

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $data['logo_website'] = $data['logo_temp'];
        $data['logo_website_thumb'] = $data['logo_temp_thumb'];

        $get_logo_temp = explode('/', $data['logo_temp']);
        $path_logo_temp = $get_logo_temp[3];

        $this->form_validation->set_rules('nama_website', 'Nama Website', 'required');
        $this->form_validation->set_rules('about_website', 'Tentang Website', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/settings/general_page_configuration');
        } else {
            $this->load->library('upload'); //load library upload file
            $this->load->library('image_lib'); //load library image

            if (!empty($_FILES['logo_website']['tmp_name'])) {

                $this->delete_general_file($path_logo_temp); //delete existing file

                $path = 'uploads/general/images/';
                $path_thumb = 'uploads/general/images/thumbs/';
                //config upload file
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = 2048; //set without limit
                $config['overwrite'] = FALSE; //if have same name, add number
                $config['remove_spaces'] = TRUE; //change space into _
                $config['encrypt_name'] = TRUE;
                //initialize config upload
                $this->upload->initialize($config);

                if ($this->upload->do_upload('logo_website')) {//if success upload data
                    $result['upload'] = $this->upload->data();
                    $name = $result['upload']['file_name'];
                    $data['logo_website'] = $path . $name;

                    $img['image_library'] = 'gd2';
                    $img['source_image'] = $path . $name;
                    $img['new_image'] = $path_thumb . $name;
                    $img['maintain_ratio'] = true;
                    $img['width'] = 600;
                    $img['height'] = 600;

                    $this->image_lib->initialize($img);
                    if ($this->image_lib->resize()) {//if success to resize (create thumbs)
                        $data['logo_website_thumb'] = $path_thumb . $name;
                    } else {
                        $this->session->set_flashdata('flash_message', err_msg($this->image_lib->display_errors()));
                        redirect('finance/settings/general_page_configuration');
                    }
                } else {
                    $this->session->set_flashdata('flash_message', warn_msg($this->upload->display_errors()));
                    redirect('finance/settings/general_page_configuration');
                }
            }
            // print_r($data);exit;    
            $edit = $this->SettingsModel->update_general_page(1, $data);
            if ($edit == true) {
                $this->session->set_flashdata('flash_message', succ_msg("Berhasil, Konfigurasi Halaman Website Telah Terupdate..."));
                redirect('finance/settings/general_page_configuration');
            } else {
                $this->session->set_flashdata('flash_message', err_msg('Maaf, Terjadi kesalahan...'));
                redirect('finance/settings/general_page_configuration');
            }
        }
    }

    public function delete_structure() {
        $id = $this->input->post('id');
        $id = paramDecrypt($id);

        $delete = $this->SettingsModel->delete_structure($id);

        if ($delete == true) {

            $this->session->set_flashdata('flash_message', succ_msg("Berhasil, Struktur Telah Terhapus.."));
            redirect('finance/settings/contact_configuration');
        } else {

            $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan...'));
            redirect('finance/settings/contact_configuration');
        }
    }

    public function delete_general_file($name = '') {
        $path = './uploads/general/images/';
        $path_thumb = './uploads/general/images/thumbs/';
        @unlink($path . $name);
        @unlink($path_thumb . $name);
    }

    //----------------------------------------------------------------//
}
