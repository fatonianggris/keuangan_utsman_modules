<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Outcome extends MX_Controller
{

    protected $allowed_roles = [5, 7];

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('OutcomeModel');
        $this->user_finance = $this->session->userdata("sias-finance");

        if ($this->session->userdata('sias-finance') == false) {
            redirect('finance/auth');
        }
        $this->load->library('form_validation');
    }

    //
    //-------------------------------DASHBOARD------------------------------//
    //

    public function list_outcome()
    {
        $data['nav_out']    = 'menu-item-here';
        $data['outcome']    = $this->OutcomeModel->get_outcome();
        $data['structure']  = $this->OutcomeModel->get_structure_account();
        $data['schoolyear'] = $this->OutcomeModel->get_schoolyear();

        $this->template->load('template_finance/template_finance', 'finance_list_outcome', $data);
    }

    public function detail_outcome($id = '')
    {
        $id = paramDecrypt($id);

        $data['nav_out'] = 'menu-item-here';
        $data['outcome'] = $this->OutcomeModel->get_outcome_id($id); //?

        if ($data['outcome'] == false or empty($id)) {
            $this->load->view('error_404', $data);
        } else {
            $this->template->load('template_finance/template_finance', 'finance_detail_outcome', $data);
        }
    }

    public function add_nota_outcome()
    {
        $data['nav_out'] = 'menu-item-here';

        $data['structure']  = $this->OutcomeModel->get_structure_account();
        $data['schoolyear'] = $this->OutcomeModel->get_schoolyear();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            $this->template->load('template_finance/template_finance', 'finance_add_nota_outcome', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function acc_outcome($id = '')
    {
        $id = paramDecrypt($id);

        $data['nav_out'] = 'menu-item-here';
        $data['outcome'] = $this->OutcomeModel->get_outcome_id($id); //?

        if ($data['outcome'] == false or empty($id)) {
            $this->load->view('error_404', $data);
        } else {
            if ($this->user_finance[0]->id_role_struktur == 5) {
                $this->template->load('template_finance/template_finance', 'finance_acc_outcome', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function edit_nota_outcome($id = '')
    {
        $id = paramDecrypt($id);

        $data['nav_out']    = 'menu-item-here';
        $data['outcome']    = $this->OutcomeModel->get_outcome_id($id);
        $data['structure']  = $this->OutcomeModel->get_structure_account();
        $data['schoolyear'] = $this->OutcomeModel->get_schoolyear();

        if ($data['outcome'] == false or empty($id)) {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        } else {
            if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
                $this->template->load('template_finance/template_finance', 'finance_edit_nota_outcome', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function post_nota_outcome()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $this->form_validation->set_rules('nama_pengeluaran', 'Nama Pengeluaran', 'required');
        $this->form_validation->set_rules('nominal_pengeluaran', 'Nominal Pengeluaran ', 'required');
        $this->form_validation->set_rules('jenis_pengeluaran', 'Jenis Pengeluaran ', 'required');
        $this->form_validation->set_rules('jenjang_pengeluaran', 'Jenjang Pengeluaran ', 'required');
        $this->form_validation->set_rules('status_pembayaran', 'Status Pembayaran', 'required');
        $this->form_validation->set_rules('id_tahun_ajaran', 'Tahun Ajaran', 'required');

        if ($data['status_pembayaran'] == 1) {
            $data['status_pengeluaran'] = 0;
        } else {
            $data['status_pengeluaran'] = 1;
            $data['tanggal_acc']        = date("Y-m-d H:i:s");
        }

        $name_division = $this->OutcomeModel->check_name_division($data['jenis_pengeluaran']);

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/outcome/add_nota_outcome');
        } else {
            $this->load->library('upload'); //load library upload file

            if (! empty($_FILES['file_nota']['tmp_name'])) {

                $path = 'uploads/pengeluaran/images/';
                //config upload file
                $config['upload_path']   = $path;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 5048;  //set without limit
                $config['overwrite']     = false; //if have same name, add number
                $config['remove_spaces'] = true;  //change space into _
                $config['encrypt_name']  = true;
                //initialize config upload
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file_nota')) { //if success upload data
                    $result['upload']  = $this->upload->data();
                    $name              = $result['upload']['file_name'];
                    $data['file_nota'] = $path . $name;
                } else {

                    $this->session->set_flashdata('flash_message', warn_msg($this->upload->display_errors()));
                    redirect('finance/outcome/add_nota_outcome');
                }
            } else {

                $this->session->set_flashdata('flash_message', warn_msg('Mohon Maaf, Silahkan Upload Bukti Nota Pengeluaran terlebih dahulu...'));
                redirect('finance/outcome/add_nota_outcome');
            }

            $input = $this->OutcomeModel->insert_nota_outcome($this->user_finance[0]->id_akun_keuangan, $data);

            if ($input == true) {

                $this->send_notification('PENGAJUAN NOTA PENGELUARAN', $data['nama_pengeluaran'], $name_division[0]->nama_struktur, site_url("/finance/outcome/list_outcome"));
                $this->send_notification_peg('PENGAJUAN NOTA PENGELUARAN', $data['nama_pengeluaran'], $name_division[0]->nama_struktur, site_url("/finance/outcome/list_outcome"));

                $this->session->set_flashdata('flash_message', succ_msg("Berhasil Diajukan, Pengeluaran '$data[nama_pengeluaran]' Anda telah diajukan. Silahkan cek Pengajuan Pengeluaran Anda di menu Daftar Pengeluaran"));
                redirect('finance/outcome/add_nota_outcome');
            } else {

                $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang...'));
                redirect('finance/outcome/add_nota_outcome');
            }
        }
    }

    public function update_nota_outcome($id = '')
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $id = paramDecrypt($id);

        $outcome = $this->OutcomeModel->get_outcome_id($id);

        $this->form_validation->set_rules('nama_pengeluaran', 'Nama Pengeluaran', 'required');
        $this->form_validation->set_rules('nominal_pengeluaran', 'Nominal Pengeluaran ', 'required');
        $this->form_validation->set_rules('jenis_pengeluaran', 'Jenis Pengeluaran ', 'required');
        $this->form_validation->set_rules('jenjang_pengeluaran', 'Jenjang Pengeluaran ', 'required');
        $this->form_validation->set_rules('status_pembayaran', 'Status Pembayaran', 'required');
        $this->form_validation->set_rules('id_tahun_ajaran', 'Tahun Ajaran', 'required');

        if ($data['status_pembayaran'] == 1) {
            $data['status_pengeluaran'] = 0;
        } else {
            $data['status_pengeluaran'] = 1;
        }

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/outcome/edit_nota_outcome/' . paramEncrypt($id));
        } else {
            $this->load->library('upload'); //load library upload file

            $data['file_nota'] = $data['file_nota_old'];

            $file_old      = explode('/', $data['file_nota_old']);
            $file_name_old = $file_old[3];

            if (! empty($_FILES['file_nota']['tmp_name'])) {

                $this->delete_file_lama($file_name_old);

                $path = 'uploads/pengeluaran/images/';
                //config upload file
                $config['upload_path']   = $path;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 5048;  //set without limit
                $config['overwrite']     = false; //if have same name, add number
                $config['remove_spaces'] = true;  //change space into _
                $config['encrypt_name']  = true;
                //initialize config upload
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file_nota')) { //if success upload data
                    $result['upload']  = $this->upload->data();
                    $name              = $result['upload']['file_name'];
                    $data['file_nota'] = $path . $name;
                } else {

                    $this->session->set_flashdata('flash_message', warn_msg($this->upload->display_errors()));
                    redirect('finance/outcome/edit_nota_outcome/' . paramEncrypt($id));
                }
            }

            $input = $this->OutcomeModel->update_nota_outcome($id, $data);

            if ($input == true) {

                $this->send_notification('REVISI NOTA PENGELUARAN', $data['nama_pengeluaran'], $outcome[0]->nama_struktur, site_url("/finance/outcome/detail_outcome/" . paramEncrypt($id)));
                $this->send_notification_peg('REVISI NOTA PENGELUARAN', $data['nama_pengeluaran'], $outcome[0]->nama_struktur, site_url("/finance/outcome/detail_outcome/" . paramEncrypt($id)));

                $this->session->set_flashdata('flash_message', succ_msg("Berhasil Diupdate, Pengeluaran '$data[nama_pengeluaran]' Anda telah diupdate. Silahkan cek status Pengajuan Pengeluaran di menu Daftar Pengeluaran"));
                redirect('finance/outcome/edit_nota_outcome/' . paramEncrypt($id));
            } else {

                $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan input ulang...'));
                redirect('finance/outcome/edit_nota_outcome/' . paramEncrypt($id));
            }
        }
    }

    public function accept_recipe_outcome()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $id = paramDecrypt($data['id']);

        $outcome = $this->OutcomeModel->get_outcome_id($id);

        $data['status_pengeluaran'] = 1;

        $this->load->library('upload'); //load library upload file

        if (! empty($_FILES['file_transfer']['tmp_name'])) {

            $path = 'uploads/pengeluaran/images/';
            //config upload file
            $config['upload_path']   = $path;
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size']      = 5048;  //set without limit
            $config['overwrite']     = false; //if have same name, add number
            $config['remove_spaces'] = true;  //change space into _
            $config['encrypt_name']  = true;
            //initialize config upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_transfer')) { //if success upload data
                $result['upload']      = $this->upload->data();
                $name                  = $result['upload']['file_name'];
                $data['file_transfer'] = $path . $name;
            } else {

                echo '2';
            }
        } else {

            echo '3';
        }

        $input = $this->OutcomeModel->update_recipe_outcome($id, $data);
        if ($input == true) {

            $this->send_notification('PENGAJUAN PENGELUARAN DISETUJUI', $outcome[0]->nama_pengeluaran, $outcome[0]->nama_struktur, site_url("/finance/outcome/detail_outcome/" . paramEncrypt($id)));
            $this->send_notification_peg('PENGAJUAN PENGELUARAN DISETUJUI', $outcome[0]->nama_pengeluaran, $outcome[0]->nama_struktur, site_url("/finance/outcome/detail_outcome/" . paramEncrypt($id)));

            echo '1';
        } else {

            echo '0';
        }
    }

    public function reject_recipe_outcome()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $id = paramDecrypt($data['id']);

        $outcome = $this->OutcomeModel->get_outcome_id($id);

        $data['status_pengeluaran'] = 2;

        $this->load->library('upload'); //load library upload file

        if (! empty($_FILES['file_transfer']['tmp_name'])) {

            $path = 'uploads/pengeluaran/images/';
            //config upload file
            $config['upload_path']   = $path;
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size']      = 5048;  //set without limit
            $config['overwrite']     = false; //if have same name, add number
            $config['remove_spaces'] = true;  //change space into _
            $config['encrypt_name']  = true;
            //initialize config upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_transfer')) { //if success upload data
                $result['upload']      = $this->upload->data();
                $name                  = $result['upload']['file_name'];
                $data['file_transfer'] = $path . $name;
            } else {
                echo '2';
            }
        } else {
            echo '3';
        }

        $input = $this->OutcomeModel->update_recipe_outcome($id, $data);

        if ($input == true) {

            $this->send_notification('PENGAJUAN PENGELUARAN DITOLAK', $outcome[0]->nama_pengeluaran, $outcome[0]->nama_struktur, site_url("/finance/outcome/detail_outcome/" . paramEncrypt($id)));
            $this->send_notification_peg('PENGAJUAN PENGELUARAN DITOLAK', $outcome[0]->nama_pengeluaran, $outcome[0]->nama_struktur, site_url("/finance/outcome/detail_outcome/" . paramEncrypt($id)));

            echo '1';
        } else {
            echo '0';
        }
    }

    public function update_recipe_outcome()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $id = paramDecrypt($data['id']);

        $outcome = $this->OutcomeModel->get_outcome_id($id);

        $data['status_pengeluaran'] = 1;
        $data['file_transfer']      = $data['file_transfer_old'];

        $file_old      = explode('/', $data['file_transfer_old']);
        $file_name_old = $file_old[3];

        $this->load->library('upload'); //load library upload file

        if (! empty($_FILES['file_transfer']['tmp_name'])) {

            $this->delete_file_lama($file_name_old);

            $path = 'uploads/pengeluaran/images/';
            //config upload file
            $config['upload_path']   = $path;
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size']      = 5048;  //set without limit
            $config['overwrite']     = false; //if have same name, add number
            $config['remove_spaces'] = true;  //change space into _
            $config['encrypt_name']  = true;
            //initialize config upload
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_transfer')) { //if success upload data
                $result['upload']      = $this->upload->data();
                $name                  = $result['upload']['file_name'];
                $data['file_transfer'] = $path . $name;
            } else {

                echo '2';
            }
        } else {

            echo '3';
        }

        $input = $this->OutcomeModel->update_recipe_outcome($id, $data);
        if ($input == true) {

            $this->send_notification('BERKAS PENGELUARAN DIREVISI', $outcome[0]->nama_pengeluaran, $outcome[0]->nama_struktur, site_url("/finance/outcome/detail_outcome/" . paramEncrypt($id)));
            $this->send_notification_peg('BERKAS PENGELUARAN DIREVISI', $outcome[0]->nama_pengeluaran, $outcome[0]->nama_struktur, site_url("/finance/outcome/detail_outcome/" . paramEncrypt($id)));

            echo '1';
        } else {

            echo '0';
        }
    }

    public function delete_outcome()
    {
        $id = $this->input->post('id');
        $id = paramDecrypt($id);

        $outcome = $this->OutcomeModel->get_outcome_id($id);

        $file_nota      = explode('/', $outcome[0]->file_nota);
        $file_name_nota = $file_nota[3];

        $file_tf      = explode('/', $outcome[0]->file_transfer);
        $file_name_tf = $file_tf[3];

        $delete = $this->OutcomeModel->delete_outcome($id);

        if ($delete == true) {
            $this->delete_file_lama($file_name_nota);
            $this->delete_file_lama($file_name_tf);
            $this->session->set_flashdata('flash_message', succ_msg("Berhasil, Pengeluaran Telah Terhapus.."));
            redirect('finance/outcome/list_outcome');
        } else {

            $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan...'));
            redirect('finance/outcome/list_outcome');
        }
    }

    public function send_notification($title = '', $proposal = '', $pemohon = '', $postlink = '')
    {

        $data = [
            "app_id"            => "affc3d22-cafb-4334-9814-91c150a08ea2",
            "included_segments" => ['Subscribed Users'],
            "headings"          => [
                "en" => "$title",
            ],
            "contents"          => [
                "en" => "PENGELUARAN: $proposal - ($pemohon)",
            ],
            "url"               => "$postlink",
        ];

        // Print Output in JSON Format
        $data_string = json_encode($data);

        // API URL
        $url = "https://onesignal.com/api/v1/notifications";

        //Curl Headers
        $headers =
            [
            'Authorization: Basic NmIwYjFjOGMtMjkxMC00ZTM2LWE1NDctYWQxZjZmN2U4OWJj',
            'Content-Type: application/json; charset = utf-8',
        ];

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

    public function send_notification_peg($title = '', $proposal = '', $pemohon = '', $postlink = '')
    {

        $data = [
            "app_id"            => "246685aa-0505-4c25-8fe1-be7e51500fd4",
            "included_segments" => ['Subscribed Users'],
            "headings"          => [
                "en" => "$title",
            ],
            "contents"          => [
                "en" => "PENGELUARAN: $proposal - ($pemohon)",
            ],
            "url"               => "$postlink",
        ];

        // Print Output in JSON Format
        $data_string = json_encode($data);

        // API URL
        $url = "https://onesignal.com/api/v1/notifications";

        //Curl Headers
        $headers =
            [
            'Authorization: Basic YTQ5MmEyMTEtYzE2MC00Y2EzLTk4YWEtMzYwZTBhNzM3MDU0',
            'Content-Type: application/json; charset = utf-8',
        ];

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
        } else {
            echo '0';
        }
    }

    public function delete_file_lama($name = '')
    {
        $path = 'uploads/pengeluaran/images/';
        @unlink($path . $name);
    }

    //-----------------------------------------------------------------------//
//
}
