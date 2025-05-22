<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Debts extends MX_Controller
{

    protected $allowed_roles = [5, 7, 10];

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('DebtsModel');
        $this->user_finance = $this->session->userdata("sias-finance");
        $this->db2          = $this->load->database('secondary_db', true);

        if ($this->session->userdata('sias-finance') == false) {
            redirect('finance/auth');
        }
        $this->load->library('form_validation');
        $this->load->library('pdfgenerator');
    }

    //
    //-------------------------------DASHBOARD------------------------------//
    //

    public function list_employee_debt()
    {
        $data['nav_save']   = 'menu-item-here';
        $data['structure']  = $this->DebtsModel->get_structure_account();
        $data['schoolyear'] = $this->DebtsModel->get_schoolyear();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            $this->template->load('template_finance/template_finance', 'finance_employee_debts_view_all', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function list_import_employee_saving()
    {
        $data['nav_save']   = 'menu-item-here';
        $data['structure']  = $this->DebtsModel->get_structure_account();
        $data['schoolyear'] = $this->DebtsModel->get_schoolyear();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            $this->template->load('template_finance/template_finance', 'finance_import_employee_savings', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function saving_general_transaction_employee()
    {
        $data['nav_save']   = 'menu-item-here';
        $data['structure']  = $this->DebtsModel->get_structure_account();
        $data['schoolyear'] = $this->DebtsModel->get_schoolyear();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            $this->template->load('template_finance/template_finance', 'finance_savings_general_transaction_employee', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }
    }

    public function check_number_employee_saving()
    {

        $param  = $this->input->post('input_nomor_rekening');
        $number = $this->security->xss_clean($param);

        $check = $this->DebtsModel->get_number_employee_saving($number);

        if ($check) {
            $isAvailable = false;
            echo json_encode([
                'valid' => $isAvailable,
            ]);
        } else {
            $isAvailable = true;
            echo json_encode([
                'valid' => $isAvailable,
            ]);
        }
    }

    public function check_number_import_employee_saving()
    {

        $nip    = $this->input->post('nip_pegawai');
        $number = $this->security->xss_clean($nip);

        $old_nip    = $this->input->post('old_nip');
        $number_old = $this->security->xss_clean($old_nip);

        $check = $this->DebtsModel->get_number_employee_saving($number);

        if ($check) {
            $isAvailable = false;
            echo json_encode([
                'valid'   => $isAvailable,
                'message' => "NIP Nasabah telah digunakan sebelumnya",
            ]);
        } else {
            $check_import = $this->DebtsModel->get_number_import_employee_saving($number);

            if ($check_import >= 2) {
                $isAvailable = false;
                echo json_encode([
                    'valid'   => $isAvailable,
                    'message' => "NIP <b>Duplikat</b> di File Excel",
                ]);
            } else if ($check_import == 1 && ($number_old != $nip)) {
                $isAvailable = false;
                echo json_encode([
                    'valid'   => $isAvailable,
                    'message' => "NIP <b>Duplikat</b> di file Excel",
                ]);
            } else {
                $isAvailable = true;
                echo json_encode([
                    'valid' => $isAvailable,
                ]);
            }
        }
    }

    public function check_name_import_employee_saving()
    {

        $nip    = $this->input->post('nip_pegawai');
        $number = $this->security->xss_clean($nip);

        $old_name = $this->input->post('old_nama');
        $old_name = $this->security->xss_clean($old_name);

        $name = $this->input->post('nama');
        $name = $this->security->xss_clean($name);

        $name  = preg_replace("/['\"-]/", "", $name);
        $check = $this->DebtsModel->check_employee_by_name_and_number($number, strtoupper($name));

        if ($check) {
            $isAvailable = false;
            echo json_encode([
                'valid'   => $isAvailable,
                'message' => "Nama Nasabah dengan NIP <b>" . $nip . "</b> telah Terpakai",
            ]);
        } else {
            $check_transition = $this->DebtsModel->get_number_name_import_employee_saving($number, strtoupper($name));

            if ($check_transition >= 2) {
                $isAvailable = false;
                echo json_encode([
                    'valid'   => $isAvailable,
                    'message' => "Nama Nasabah dengan NIP <b>" . $nip . "</b> duplikat di file Excel",
                ]);
            } else if (($check_transition == 1) && (strtoupper($name) != strtoupper($old_name))) {
                $isAvailable = false;
                echo json_encode([
                    'valid'   => $isAvailable,
                    'message' => "Nama Nasabah dengan NIP <b>" . $nip . "</b> duplikat di file Excel",
                ]);
            } else {
                $isAvailable = true;
                echo json_encode([
                    'valid' => $isAvailable,
                ]);
            }
        }

    }

    public function add_employee_debt()
    {
        $data['nav_save']   = 'menu-item-here';
        $data['structure']  = $this->DebtsModel->get_structure_account();
        $data['schoolyear'] = $this->DebtsModel->get_schoolyear();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            $this->template->load('template_finance/template_finance', 'finance_add_employee_savings', $data);
        } else {
            $datas['title'] = 'ERROR | PAGE NOT FOUND';
            $this->load->view('error_404', $datas);
        }

    }

    public function get_all_employee()
    {
        $data = $this->DebtsModel->get_employee();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            echo json_encode($data);
        } else {
            $output = ["status" => false,
                "messages"               => "Opps!, Data tidak ditemukan, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }
    }

    public function get_employee_by_nip($id = "")
    {
        $data['data_pegawai'] = $this->DebtsModel->get_employee_by_nip($id);

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            echo json_encode($data);
        } else {
            $output = ["status" => false,
                "messages"               => "Opps!, NIP Pegawai Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }
    }

    public function get_all_employee_customer_debt()
    {
        $param = $this->input->get();
        $get   = $this->security->xss_clean($param);

        $data = $this->DebtsModel->get_all_employee_customer_debt($get['start_date'], $get['end_date']);

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            echo json_encode($data);
        } else {
            $output = ["status" => false,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];
            echo json_encode($output);
        }
    }

    public function get_all_import_employee_customer()
    {
        $data = $this->DebtsModel->get_all_import_employee_customer();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            echo json_encode($data);
        } else {
            $output = ["status" => false,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];
            echo json_encode($output);
        }
    }

    public function get_all_transaction_employee()
    {
        $param = $this->input->get();
        $get   = $this->security->xss_clean($param);

        $data = $this->DebtsModel->get_all_general_transaction_savings_employee($get['start_date'], $get['end_date']);

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            echo json_encode($data);
        } else {
            $output = ["status" => false,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }
    }

    public function get_employee_recap_transaction($nip = '')
    {
        $param = $this->input->get();
        $get   = $this->security->xss_clean($param);

        $data = $this->DebtsModel->get_employee_transaction_recap_by_nip($nip, $get['start_date'], $get['end_date']); //?

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            echo json_encode($data);
        } else {
            $output = ["status" => false,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }
    }

    public function get_employee_info($nip = '')
    {
        $data['info_pegawai']  = $this->DebtsModel->get_employee_by_nip($nip);
        $data['info_tabungan'] = $this->DebtsModel->get_info_employee_transaction($nip);

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            echo json_encode($data);
        } else {
            $output = ["status" => false,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }
    }

    public function get_employee_info_recap($nip = '')
    {
        $data['info_pegawai']         = $this->DebtsModel->get_employee_by_nip($nip);
        $data['info_tabungan_umum']   = $this->DebtsModel->get_info_employee_transaction($nip);
        $data['info_tabungan_qurban'] = $this->DebtsModel->get_info_employee_transaction_qurban($nip);
        $data['info_tabungan_wisata'] = $this->DebtsModel->get_info_employee_transaction_tour($nip);

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            echo json_encode($data);
        } else {
            $output = ["status" => false,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }
    }

    public function get_employee_transaction_recap()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        if (empty($data['nip_pegawai']) or $data['nip_pegawai'] == "") {
            $this->load->view('error_404', $data);
        } else {
            if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
                redirect('finance/savings/recap_employee_transaction/' . $data['nip_pegawai']);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function recap_employee_transaction($nip = '')
    {

        $data['nav_save'] = 'menu-item-here';

        $data['schoolyear']     = $this->DebtsModel->get_schoolyear();
        $data['info_pegawai']   = $this->DebtsModel->get_employee_by_nip($nip);
        $data['info_transaksi'] = $this->DebtsModel->get_info_employee_transaction($nip);

        if ($nip == "" or empty($nip)) {
            $this->load->view('error_404', $data);
        } else {
            if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
                $this->template->load('template_finance/template_finance', 'finance_savings_recap_employee_balance', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function post_employee_savings()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $this->form_validation->set_rules('input_nomor_rekening', 'Nomor Rekening Nasabah/Pegawai', 'required');
        $this->form_validation->set_rules('input_nama_nasabah', 'Nama Nasabah/Pegawai', 'required');
        $this->form_validation->set_rules('input_tahun_ajaran', 'Tahun Ajaran', 'required');
        $this->form_validation->set_rules('input_tingkat', 'Tingkat Nasabah/Pegawai', 'required');
        $this->form_validation->set_rules('input_jenis_kelamin', 'Jenis Nasabah/Pegawai', 'required');
        $this->form_validation->set_rules('input_jabatan_pegawai', 'Jabatan Nasabah/Pegawai', 'required');
        $this->form_validation->set_rules('input_tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('input_status_pegawai', 'Status Nasabah/Pegawai', 'required');

        $random_number              = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['input_nama_nasabah'] = preg_replace("/['\"-]/", "", $data['input_nama_nasabah']);

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/savings/add_employee_saving');
        } else {

            $check_number = $this->DebtsModel->get_number_employee_saving($data['input_nomor_rekening']);

            if (empty($check_number)) {

                $input_bank_customer = $this->DebtsModel->insert_employee_saving($data);

                if ($input_bank_customer == true) {

                    $keterangan_umum = "";

                    $status_umum = "";

                    if ($data['input_saldo_tabungan_umum'] >= 1000) {

                        $data_umum = [
                            'nomor_transaksi_umum' => "TPU01" . $random_number . "/" . date('YmdHis'),
                            'id_tingkat'           => $data['input_tingkat'],
                            'nip'                  => $data['input_nomor_rekening'],
                            'nominal'              => $data['input_saldo_tabungan_umum'],
                            'jenis_tabungan'       => 1,
                            'saldo_akhir'          => $data['input_saldo_tabungan_umum'],
                            'catatan_kredit'       => $data['input_catatan_umum'],
                            'tanggal_transaksi'    => $data['input_tanggal_transaksi'],
                            'status_kredit_debet'  => "1",
                            'tahun_ajaran'         => $data['input_tahun_ajaran'],
                        ];

                        $input_umum = $this->DebtsModel->insert_credit_saving_employee($this->user_finance[0]->id_akun_keuangan, $data_umum);

                        if (! $input_umum['status']) {
                            $status_umum = "<b>Rp. $data[input_saldo_tabungan_umum], STATUS:</b> <b class='text-danger'>GAGAL</b>";
                        } else {
                            $status_umum = "<b>Rp. $data[input_saldo_tabungan_umum], STATUS:</b> <b class='text-success'>BERHASIL</b>";
                        }

                        $keterangan_umum = "<b>->TRANSAKSI DI TABUNGAN PEGAWAI UMUM SEBESAR </b>$status_umum<br>";

                    } else if ($data['input_saldo_tabungan_umum'] == "" or $data['input_saldo_tabungan_umum'] == null or $data['input_saldo_tabungan_umum'] == 0) {

                        $keterangan_umum = "";
                    } else {

                        $keterangan_umum = "<b>->TRANSAKSI DI TABUNGAN PEGAWAI UMUM SEBESAR Rp. $data[input_saldo_tabungan_umum], STATUS:</b> <b class='text-danger'>GAGAL</b> <b>(NOMINAL TIDAK BOLEH KURANG DARI 1000)</b><br>";
                    }

                    $transaction = [
                        [
                            "jenis_tabungan"  => "UMUM",
                            "nomor_transaksi" => @$input_umum['data']->nomor_transaksi_umum,
                            "waktu_transaksi" => @date('d/m/Y H:i:s', strtotime(@$input_umum['data']->waktu_transaksi)),
                            "saldo"           => @number_format((double) @$input_umum['data']->saldo, 0, ',', '.'),
                        ],
                    ];

                    $trans_msg = ["nama_nasabah" => $data['input_nama_nasabah'],
                        "nomor_rekening"                  => $data['input_nomor_rekening'],
                        "tingkat"                         => $data['input_tingkat'],
                        "waktu_transaksi"                 => date('d/m/Y H:i:s', strtotime($input_umum['data']->waktu_transaksi)),
                        "array_transaction"               => $transaction];

                    $trans_msg_json = json_encode($trans_msg);

                    $this->session->set_flashdata('print_transaction', $trans_msg_json);
                    $this->session->set_flashdata('flash_message', succ_msg("Data Nasabah/Pegawai <b>'ATAS NAMA: " . strtoupper($data['input_nama_nasabah']) . ", NIP/NOREK: $data[input_nomor_rekening]'</b> telah ditambahakan dengan Rincian Transaksi berikut: <br>$keterangan_umum <br> <b class='text-danger'>*Silahkan cek Data Nasabah di menu Daftar Nasabah Pegawai, Terima Kasih.</b>"));
                    redirect('finance/savings/add_employee_saving');
                } else {

                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan lakukan input ulang..'));
                    redirect('finance/savings/add_employee_saving');
                }
            } else {
                $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Nomor Rekening Telah Digunakan, Silahkan inputkan nomor rekening lain.'));
                redirect('finance/savings/add_employee_saving');
            }
        }
    }

    public function update_employee_saving()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {

            if ($data['id_pegawai'] == "" or empty($data['id_pegawai']) or $data['id_pegawai'] == null) {

                $output = ["status" => false,
                    "token"                  => $token,
                    "messages"               => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                ];

            } else {

                $update_employee = $this->DebtsModel->update_employee_saving($data['id_pegawai'], $data);
                if ($update_employee == true) {

                    $output = ["status" => true,
                        "token"                  => $token,
                        "messages"               => "Berhasil Diubah!, Perubahan Profil Nasabah Pegawai Atas Nama <b>" . $data['nama_lengkap'] . " (" . $data['nip'] . ")</b> telah diubah. Silahkan cek Profil Nasabah menu Daftar Nasabah Pegawai.",
                    ];

                } else {

                    $output = ["status" => false,
                        "token"                  => $token,
                        "messages"               => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    ];
                }

            }

            echo json_encode($output);

        } else {
            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }

    }

    public function post_credit_employee()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $random_number                = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['status_kredit_debet']  = "1";
        $data['nomor_transaksi_umum'] = "TPU01" . $random_number . "/" . date('YmdHis');
        $get_balance                  = $this->DebtsModel->get_employee_balance($data['nip']);

        $token = $this->security->get_csrf_hash();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {

            if ($data == false or empty($data['nip'])) {
                $output = ["status" => false,
                    "token"                  => $token,
                    "messages"               => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                ];

            } else {

                $check_pin = $this->DebtsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_kredit'], $check_pin[0]->pin_akun)) {

                    if ($get_balance[0]->saldo_tabungan_umum == 0) {

                        $data['saldo_akhir'] = $data['nominal'];

                    } else if ($data['nominal'] < 1000) {

                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        ];

                        echo json_encode($output);
                        exit();

                    } else {

                        $data['saldo_akhir'] = $data['nominal'] + $get_balance[0]->saldo_tabungan_umum;

                    }

                    $input_credit   = $this->DebtsModel->insert_credit_saving_employee($this->user_finance[0]->id_akun_keuangan, $data);
                    $update_balance = $this->DebtsModel->update_balance_saving_employee($data['nip'], $data['saldo_akhir']);

                    if ($input_credit['status'] == true && $update_balance == true) {

                        $output = ["status" => true,
                            "token"                  => $token,
                            "nomor_transaksi"        => $input_credit['data']->nomor_transaksi_umum,
                            "waktu_transaksi"        => date('d/m/Y H:i:s', strtotime($input_credit['data']->waktu_transaksi)),
                            "saldo_akhir"            => $input_credit['data']->saldo,
                            "messages"               => "Berhasil Disetor!, Setor Tabungan Umum Pegawai Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nip . ")</b> telah ditambahkan. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Umum Pegawai.",
                        ];

                    } else {

                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        ];
                    }
                } else {
                    $output = ["status" => false,
                        "token"                  => $token,
                        "messages"               => "Mohon Maaf., PIN Anda salah!",
                    ];

                }
            }

            echo json_encode($output);
        } else {
            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }

    }
    public function update_credit_employee()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $get_transaction = $this->DebtsModel->get_employee_transaction_last($data['id_transaksi']);
        $get_balance     = $this->DebtsModel->get_employee_balance($data['nip']);

        $token = $this->security->get_csrf_hash();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {

            if ($data == false or empty($data['nip']) or empty($data['id_transaksi'])) {

                $output = ["status" => false,
                    "token"                  => $token,
                    "messages"               => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                ];

            } else {

                $check_pin = $this->DebtsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_kredit_edit'], $check_pin[0]->pin_akun)) {

                    if (($get_balance[0]->saldo_tabungan_umum - $get_transaction[0]->nominal) == 0) {

                        $data['saldo_akhir'] = $data['nominal'];

                    } else if ($data['nominal'] < 1000) {

                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        ];

                        echo json_encode($output);
                        exit();

                    } else {

                        $data['saldo_akhir'] = $data['nominal'] + ($get_balance[0]->saldo_tabungan_umum - $get_transaction[0]->nominal);

                    }

                    $update_credit  = $this->DebtsModel->update_credit_saving_employee($data['id_transaksi'], $data);
                    $update_balance = $this->DebtsModel->update_balance_saving_employee($data['nip'], $data['saldo_akhir']);

                    if ($update_credit == true && $update_balance == true) {

                        $output = ["status" => true,
                            "token"                  => $token,
                            "nomor_transaksi"        => $get_transaction[0]->nomor_transaksi_umum,
                            "waktu_transaksi"        => date('d/m/Y H:i:s', strtotime($get_transaction[0]->waktu_transaksi)),
                            "saldo_akhir"            => $data['saldo_akhir'],
                            "messages"               => "Berhasil Diubah!, Perubahan Setor Tabungan Umum Pegawai Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nip . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Umum Pegawai.",
                        ];

                    } else {

                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        ];
                    }

                } else {
                    $output = ["status" => false,
                        "token"                  => $token,
                        "messages"               => "Mohon Maaf., PIN Anda salah!",
                    ];
                }

            }
            echo json_encode($output);
        } else {
            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }

    }

    public function post_debet_employee()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $random_number                = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);
        $data['jenis_tabungan']       = "1";
        $data['status_kredit_debet']  = "2";
        $data['nomor_transaksi_umum'] = "TPU02" . $random_number . "/" . date('YmdHis');
        $get_balance                  = $this->DebtsModel->get_employee_balance($data['nip']);

        $token = $this->security->get_csrf_hash();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {

            if ($data == false or empty($data['nip'])) {

                $output = ["status" => false,
                    "token"                  => $token,
                    "messages"               => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                ];

            } else {
                $check_pin = $this->DebtsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_debet'], $check_pin[0]->pin_akun)) {

                    if (($get_balance[0]->saldo_tabungan_umum > 0) && ($data['nominal'] <= $get_balance[0]->saldo_tabungan_umum)) {

                        $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_umum - $data['nominal'];

                        $input_debet    = $this->DebtsModel->insert_debet_saving_employee($this->user_finance[0]->id_akun_keuangan, $data);
                        $update_balance = $this->DebtsModel->update_balance_saving_employee($data['nip'], $data['saldo_akhir']);

                        if ($input_debet['status'] == true && $update_balance == true) {

                            $output = ["status" => true,
                                "token"                  => $token,
                                "nomor_transaksi"        => $input_debet['data']->nomor_transaksi_umum,
                                "waktu_transaksi"        => date('d/m/Y H:i:s', strtotime($input_debet['data']->waktu_transaksi)),
                                "saldo_akhir"            => $input_debet['data']->saldo,
                                "messages"               => "Berhasil Ditarik!, Penarikan Tabungan Umum Pegawai Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nip . ")</b> telah ditarik. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Umum Pegawai.",
                            ];

                        } else {

                            $output = ["status" => false,
                                "token"                  => $token,
                                "messages"               => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                            ];
                        }

                    } else if (($get_balance[0]->saldo_tabungan_umum <= 0)) {

                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Opps!, Pastikan Saldo Mencukupi, Tidak Boleh <= 0, Silahkan input ulang.",
                        ];
                    } else if (($data['nominal'] < 1000)) {
                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        ];

                    } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_umum)) {
                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                        ];

                    }
                } else {
                    $output = ["status" => false,
                        "token"                  => $token,
                        "messages"               => "Mohon Maaf., PIN Anda salah!",
                    ];
                }
            }
            echo json_encode($output);
        } else {
            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }

    }

    public function update_debet_employee()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $get_transaction = $this->DebtsModel->get_employee_transaction_last($data['id_transaksi']);
        $get_balance     = $this->DebtsModel->get_employee_balance($data['nip']);

        $token = $this->security->get_csrf_hash();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            if ($data == false or empty($data['nip']) or empty($data['id_transaksi'])) {

                $output = ["status" => false,
                    "token"                  => $token,
                    "messages"               => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                ];

            } else {
                $check_pin = $this->DebtsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['pin_verification_debet_edit'], $check_pin[0]->pin_akun)) {

                    if ((($get_transaction[0]->saldo + $get_transaction[0]->nominal) > 0) && ($data['nominal'] <= ($get_transaction[0]->saldo + $get_transaction[0]->nominal))) {

                        $data['saldo_akhir'] = ($get_transaction[0]->saldo + $get_transaction[0]->nominal) - $data['nominal'];

                        $update_debet   = $this->DebtsModel->update_debet_saving_employee($data['id_transaksi'], $data);
                        $update_balance = $this->DebtsModel->update_balance_saving_employee($data['nip'], $data['saldo_akhir']);

                        if ($update_debet == true && $update_balance == true) {

                            $output = ["status" => true,
                                "token"                  => $token,
                                "nomor_transaksi"        => $get_transaction[0]->nomor_transaksi_umum,
                                "waktu_transaksi"        => date('d/m/Y H:i:s', strtotime($get_transaction[0]->waktu_transaksi)),
                                "saldo_akhir"            => $data['saldo_akhir'],
                                "messages"               => "Berhasil Diubah!, Perubahan Penarikan Tabungan Umum Pegawai Atas Nama <b>" . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nip . ")</b> telah diubah. Silahkan cek Rekap/Histori Tabungan di Menu Daftar Tabungan Umum Pegawai.",
                            ];

                        } else {

                            $output = ["status" => false,
                                "token"                  => $token,
                                "messages"               => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                            ];
                        }

                    } else if (($get_transaction[0]->saldo + $get_transaction[0]->nominal) <= 0) {

                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Opps!, Pastikan Saldo Mencukupi, Tidak Boleh <= 0, Silahkan input ulang.",
                        ];
                    } else if (($data['nominal'] < 1000)) {
                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh < 1000, Silahkan input ulang.",
                        ];

                    } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan_umum)) {
                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Opps!, Inputan Penarikan Tidak Boleh Lebih dari Saldo Tabungan, Silahkan input ulang.",
                        ];

                    }
                } else {
                    $output = ["status" => false,
                        "token"                  => $token,
                        "messages"               => "Mohon Maaf., PIN Anda salah!",
                    ];
                }

            }
            echo json_encode($output);
        } else {
            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }

    }
    public function delete_credit_transaction_employee()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {

            if ($data['nip'] && $data['id_transaksi'] && $data['nomor_transaksi'] && $data['password']) {

                $check_pass = $this->DebtsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['password'], $check_pass[0]->password)) {

                    $get_transaction = $this->DebtsModel->get_employee_transaction_last($data['id_transaksi']);
                    $get_balance     = $this->DebtsModel->get_employee_balance($data['nip']);

                    if ($get_transaction == true && $get_balance == true) {

                        $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_umum - $get_transaction[0]->nominal;

                        $update_balance = $this->DebtsModel->update_balance_saving_employee($data['nip'], $data['saldo_akhir']);
                        $delete         = $this->DebtsModel->delete_transaction_employee($data['id_transaksi']);

                        if ($update_balance == true && $delete == true) {

                            $output = ["status" => true,
                                "token"                  => $token,
                                "messages"               => "Berhasil Dihapus!, Transaksi Kredit Tabungan Umum Pegawai <b>" . $data['nomor_transaksi'] . "</b> Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nip . ") telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Umum Pegawai.",
                            ];
                        } else {

                            $output = ["status" => false,
                                "token"                  => $token,
                                "messages"               => "Opps!, Transaksi Kredit Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                            ];

                        }
                    } else {

                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Opps!, ID transaksi/NIP tidak ditemukan didalam sistem, Silahkan coba lagi.",
                        ];
                    }
                } else {

                    $output = ["status" => false,
                        "token"                  => $token,
                        "messages"               => "Opps!, Password Anda Salah, Silahkan coba lagi.",
                    ];
                }

            } else {

                $output = ["status" => false,
                    "token"                  => $token,
                    "messages"               => "Opps!, ID transaksi/NIP belum diinputkan, Silahkan coba lagi.",
                ];

            }

            echo json_encode($output);
        } else {
            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }

    }
    public function delete_debet_transaction_employee()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {

            if ($data['nip'] && $data['id_transaksi'] && $data['nomor_transaksi'] && $data['password']) {

                $check_pass = $this->DebtsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($data['password'], $check_pass[0]->password)) {

                    $get_transaction = $this->DebtsModel->get_employee_transaction_last($data['id_transaksi']);
                    $get_balance     = $this->DebtsModel->get_employee_balance($data['nip']);

                    if ($get_transaction == true && $get_balance == true) {

                        $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan_umum + $get_transaction[0]->nominal;

                        $update_balance = $this->DebtsModel->update_balance_saving_employee($data['nip'], $data['saldo_akhir']);
                        $delete         = $this->DebtsModel->delete_transaction_employee($data['id_transaksi']);

                        if ($update_balance == true && $delete == true) {

                            $output = ["status" => true,
                                "token"                  => $token,
                                "messages"               => "Berhasil Dihapus!, Transaksi Debet Tabungan Umum Pegawai <b>" . $data['nomor_transaksi'] . "</b> Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nip . ") telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan Pegawai.",
                            ];
                        } else {

                            $output = ["status" => false,
                                "token"                  => $token,
                                "messages"               => "Opps!, Transaksi Debet Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                            ];

                        }
                    } else {

                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Opps!, ID transaksi/NIP tidak ditemukan didalam sistem, Silahkan coba lagi.",
                        ];
                    }

                } else {
                    $output = ["status" => false,
                        "token"                  => $token,
                        "messages"               => "Opps!, Password Anda Salah, Silahkan coba lagi.",
                    ];
                }

            } else {

                $output = ["status" => false,
                    "token"                  => $token,
                    "messages"               => "Opps!, ID transaksi/NIP belum diinputkan, Silahkan coba lagi.",
                ];

            }

            echo json_encode($output);
        } else {
            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }

    }

    //------------------------------- IMPORT DATA----------------------------------------//

    public function check_pin_number()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {

            if ($data['pin_number']) {

                $check_pass = $this->DebtsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);

                if (password_verify(($data['pin_number']), $check_pass[0]->pin_akun)) {

                    $output = ["status" => true,
                        "token"                  => $token,
                        "messages"               => "PIN Telah diverifikasi.",
                    ];

                } else {

                    $output = ["status" => false,
                        "token"                  => $token,
                        "messages"               => "PIN Anda salah, Silahkan coba lagi.",
                    ];
                }

            } else {

                $output = ["status" => false,
                    "token"                  => $token,
                    "messages"               => "Opps!, PIN belum diinputkan, Silahkan coba lagi.",
                ];

            }

            echo json_encode($output);
        } else {
            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }

    }

    public function update_import_employee_saving()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $data['nama_nasabah'] = preg_replace("/['\"-]/", "", $data['nama_nasabah']);

        $token = $this->security->get_csrf_hash();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {

            if ($data['id_nasabah'] == "" or empty($data['id_nasabah']) or $data['id_nasabah'] == null) {

                $output = ["status" => false,
                    "token"                  => $token,
                    "messages"               => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                ];

            } else {

                $check = $this->DebtsModel->get_number_employee_saving($data['nip']);
                if ($check) {
                    $data['status_nasabah'] = '1';
                } else {
                    $check_import = $this->DebtsModel->get_number_import_employee_saving($data['nip']);
                    if ($check_import >= 2) {
                        $data['status_nasabah'] = '3';
                    } else if ($check_import == 1 && ($data['nip'] != $data['old_nip'])) {
                        $data['status_nasabah'] = '3';
                    } else {
                        $data['status_nasabah'] = '2';
                    }
                }

                $check_transition = $this->DebtsModel->get_number_name_import_employee_saving($data['nip'], strtoupper($data['nama_nasabah']));
                if ($check_transition >= 2) {
                    $data['status_nama_nasabah'] = '3';
                } else if (($check_transition == 1) && (strtoupper($data['nama_nasabah']) != strtoupper($data['old_nama_nasabah']))) {
                    $data['status_nama_nasabah'] = '3';
                } else {
                    $result = $this->DebtsModel->check_match_name(trim($data['nama_nasabah']));

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

                $check_employee_name_and_number = $this->DebtsModel->check_employee_by_name_and_number(trim($data['nip']), trim($data['nama_nasabah']));
                if ($check_employee_name_and_number) {
                    $data['password']            = $check_employee_name_and_number[0]->password;
                    $data['status_nama_nasabah'] = '4';
                } else {
                    $data['password'] = password_hash(paramEncrypt(trim($data['nip'])), PASSWORD_DEFAULT, ['cost' => 12]);
                }

                $update_employee = $this->DebtsModel->update_import_employee_saving($data['id_nasabah'], $data);

                if ($update_employee == true) {

                    $output = ["status" => true,
                        "token"                  => $token,
                        "messages"               => "Berhasil Diubah!, Perubahan Data Import Atas Nama <b>" . $data['nama_nasabah'] . " (" . $data['nip'] . ")</b> telah diubah. Silahkan cek Hasil Data Import.",
                    ];

                } else {

                    $output = ["status" => false,
                        "token"                  => $token,
                        "messages"               => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                    ];
                }

            }

            echo json_encode($output);

        } else {
            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];

            echo json_encode($output);
        }

    }

    public function import_employee_saving()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $this->form_validation->set_rules('pin_verification', 'PIN Anda', 'required');
        $this->form_validation->set_rules('input_tanggal_transaksi', 'Tanggal Transaksi', 'required');
        $this->form_validation->set_rules('input_tahun_ajaran', 'Tahun Ajaran', 'required');

        $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
        $userIp            = $this->input->ip_address();

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('flash_message', warn_msg(validation_errors()));
            redirect('finance/savings/list_employee_saving');
        } else {
            $check_pass = $this->DebtsModel->check_pin_admin($this->user_finance[0]->id_akun_keuangan);

            $this->db->query('SET SESSION interactive_timeout = 28000');
            $this->db->query('SET SESSION wait_timeout = 28000');
            $this->db2->query('SET SESSION interactive_timeout = 28000');
            $this->db2->query('SET SESSION wait_timeout = 28000');
            // pass verify
            if (password_verify(($data['pin_verification']), $check_pass[0]->pin_akun)) {
                // gcaptha verify
                if ($this->googleCaptachStore($recaptchaResponse, $userIp) == 1) {

                    // If file uploaded
                    $file_mimes = [
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
                    ];

                    if (isset($_FILES['file_employee_saving']['name']) && in_array($_FILES['file_employee_saving']['type'], $file_mimes)) {
                        $this->DebtsModel->clear_import_data_employee_saving();

                        $arr_file  = explode('.', $_FILES['file_employee_saving']['name']);
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
                        $spreadsheet = $reader->load($_FILES['file_employee_saving']['tmp_name']);
                        $sheetData   = $spreadsheet->getActiveSheet()->toArray();

                        $status_nis     = '';
                        $tingkat        = '';
                        $jk             = '';
                        $status_pegawai = '';
                        $password       = '';
                        $status_nama    = "";

                        $data_array = [];
                        // Initialize arrays for tracking

                        $seenNIP      = [];
                        $duplicateNIP = [];

                        $seenName      = [];
                        $duplicateName = [];

                        for ($i = 1; $i < count($sheetData); $i++) {

                            $currentName = trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1']));
                            $currentNIP  = trim($sheetData[$i]['0']);

                            $employee = $this->DebtsModel->get_employee_nip($sheetData[$i]['0']);

                            if (! $employee) {

                                if (isset($seenName[$currentName])) {
                                    $duplicateName[$currentName] = true;
                                    $status_nama                 = 3;
                                } else {
                                    $seenName[$currentName] = true;
                                    $result                 = $this->DebtsModel->check_match_name(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1'])));
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

                                if (isset($seenNIP[$currentNIP])) {
                                    $duplicateNIP[$currentNIP] = true;
                                    $status_nis                = 3;
                                } else {
                                    $seenNIP[$currentNIP] = true;
                                    $status_nis           = 2;
                                }

                                $password = password_hash(paramEncrypt(trim($sheetData[$i]['0'])), PASSWORD_DEFAULT, ['cost' => 12]);
                            } else {

                                $status_nis = 1;
                                if (isset($seenName[$currentName])) {
                                    $duplicateName[$currentName] = true;
                                    $status_nama                 = 3;
                                } else {
                                    $seenName[$currentName] = true;
                                    $result                 = $this->DebtsModel->check_match_name(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1'])));
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

                                $check_employee_name_and_number = $this->DebtsModel->check_employee_by_name_and_number(trim($sheetData[$i]['0']), trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1'])));
                                if ($check_employee_name_and_number) {
                                    $password    = $employee[0]->password;
                                    $status_nama = 4;
                                } else {
                                    $password = password_hash(paramEncrypt(trim($sheetData[$i]['0'])), PASSWORD_DEFAULT, ['cost' => 12]);
                                }
                            }

                            if (strtoupper($sheetData[$i]['3']) == 'L') {
                                $jk = '1';
                            } else if (strtoupper($sheetData[$i]['3']) == 'P') {
                                $jk = '2';
                            }

                            if (strpos((strtoupper($sheetData[$i]['2'])), 'KB') !== false) {
                                $tingkat = "1";
                            } else if (strpos((strtoupper($sheetData[$i]['2'])), 'TK') !== false) {
                                $tingkat = "1";
                            } else if (strpos((strtoupper($sheetData[$i]['2'])), 'SD') !== false) {
                                $tingkat = "3";
                            } else if (strpos((strtoupper($sheetData[$i]['2'])), 'SMP') !== false) {
                                $tingkat = "4";
                            } else if (strpos((strtoupper($sheetData[$i]['2'])), 'DC') !== false) {
                                $tingkat = "1";
                            } else if (strpos((strtoupper($sheetData[$i]['2'])), 'UMUM') !== false) {
                                $tingkat = "6";
                            }

                            if (strtoupper($sheetData[$i]['6']) == 'TETAP') {
                                $status_pegawai = '1';
                            } else if (strtoupper($sheetData[$i]['6']) == 'TIDAK_TETAP' or strtoupper($sheetData[$i]['6']) == 'TIDAK TETAP') {
                                $status_pegawai = '2';
                            } else if (strtoupper($sheetData[$i]['6']) == 'HONORER') {
                                $status_pegawai = '3';
                            }

                            if ($sheetData[$i]['0']) {
                                $data_array[$i] = [
                                    'nip'                 => (filter_var(trim($sheetData[$i]['0']), FILTER_SANITIZE_STRING)),
                                    'password'            => (trim($password)),
                                    'nama_nasabah'        => (filter_var(trim(preg_replace("/['\"-]/", "", $sheetData[$i]['1'])), FILTER_SANITIZE_STRING)),
                                    'jenis_kelamin'       => (filter_var(trim($jk), FILTER_SANITIZE_STRING)),
                                    'tanggal_transaksi'   => (filter_var(trim($data['input_tanggal_transaksi']), FILTER_SANITIZE_STRING)),
                                    'tahun_ajaran'        => (filter_var(trim($data['input_tahun_ajaran']), FILTER_SANITIZE_STRING)),
                                    'tingkat'             => (filter_var(trim($tingkat), FILTER_SANITIZE_STRING)),
                                    'nomor_hp_pegawai'    => (filter_var(trim($sheetData[$i]['4']), FILTER_SANITIZE_STRING)),
                                    'email_nasabah'       => (filter_var(trim($sheetData[$i]['5']), FILTER_SANITIZE_STRING)),
                                    'status_pegawai'      => (filter_var(trim($status_pegawai), FILTER_SANITIZE_STRING)),
                                    'saldo_umum'          => (filter_var(trim($sheetData[$i]['7']), FILTER_SANITIZE_STRING)),
                                    'saldo_qurban'        => (filter_var(trim($sheetData[$i]['8']), FILTER_SANITIZE_STRING)),
                                    'saldo_wisata'        => (filter_var(trim($sheetData[$i]['9']), FILTER_SANITIZE_STRING)),
                                    'status_nasabah'      => (filter_var(trim($status_nis), FILTER_SANITIZE_STRING)),
                                    'status_nama_nasabah' => (filter_var(trim($status_nama), FILTER_SANITIZE_STRING)),
                                ];
                            }
                        }

                        $import_data = $this->db2->insert_batch('import_nasabah_pegawai', $data_array);

                        if ($import_data == true) {

                            $this->session->set_flashdata('flash_message', warn_msg("Peringatan!, File <b>" . $_FILES['file_employee_saving']['name'] . "</b> Telah diproses, Silahkan melakukan <b>PENGECEKAN & PERSETUJUAN</b> untuk mengimpor seluruh data file tersebut. Jika terjadi ketidaksamaan dengan Data Asli, dimohon untuk <b>MENGUBAH DATA</b>. Terima Kasih"));
                            redirect('finance/savings/list_import_employee_saving/' . paramEncrypt("sekolah_utsman"));
                        } else {

                            $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Terjadi kesalahan, Silahkan import ulang...'));
                            redirect('finance/savings/list_employee_saving');
                        }
                    } else {

                        $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Silahkan Import file berformat csv/xls/xlsx'));
                        redirect('finance/savings/list_employee_saving');
                    }
                } else {

                    $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf, Google Recaptcha terdapat kesalahan.'));
                    redirect('finance/savings/list_employee_saving');
                }
            } else {
                $this->session->set_flashdata('flash_message', err_msg('Mohon Maaf., PIN Anda salah!'));
                redirect('finance/savings/list_employee_saving');
            }
        }
    }

    public function accept_import_employee_saving()
    {
        $param = $this->input->post();
        $data  = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        $check_pass = $this->DebtsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);

        if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || ! $data['data_check'])) {

            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
            ];

        } else {
            // pass verify
            if (password_verify(($data['password']), $check_pass[0]->password)) {

                $this->db->query('SET SESSION interactive_timeout = 28000');
                $this->db->query('SET SESSION wait_timeout = 28000');
                $this->db2->query('SET SESSION interactive_timeout = 28000');
                $this->db2->query('SET SESSION wait_timeout = 28000');

                $check_used_number = $this->DebtsModel->check_used_number_import_data_employee_saving($data['data_check']);
                if ($check_used_number >= 1 && $data['status_similiar'] == 'false') {

                    $output = ["status" => false,
                        "confirm"                => false,
                        "token"                  => $token,
                        "messages"               => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-danger'>TERPAKAI</b>. Silahkan revisi data Import Anda.",
                    ];

                } else {
                    $check_duplicate = $this->DebtsModel->check_duplicate_import_data_employee_saving($data['data_check']);
                    if ($check_duplicate >= 1 && $data['status_similiar'] == 'false') {
                        $output = ["status" => false,
                            "confirm"                => false,
                            "token"                  => $token,
                            "messages"               => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-danger'>DUPLIKAT</b>. Silahkan revisi data Import Anda.",
                        ];

                    } else {
                        $check_similiar = $this->DebtsModel->check_similiar_import_data_employee_saving($data['data_check']);
                        if ($check_similiar >= 1 && $data['status_similiar'] == 'false') {
                            $output = ["status" => true,
                                "confirm"                => true,
                                "token"                  => $token,
                                "messages"               => "Mohon Maaf!, Data yang Anda pilih terdapat status <b class='text-warning'>MIRIP</b>. Revisi atau Lanjutkan ?.",
                            ];

                        } else if (($check_similiar >= 1 && $data['status_similiar'] == 'true') || ($check_similiar == 0 && $data['status_similiar'] == 'false')) {

                            $input = $this->DebtsModel->accept_import_data_employee_saving($data['data_check']);
                            if ($input == true) {

                                $transaksi_umum   = [];
                                $transaksi_qurban = [];
                                $transaksi_wisata = [];

                                $result_import = $this->DebtsModel->get_import_employee_saving($data['data_check'], 2);

                                for ($i = 0; $i < count($result_import); $i++) {

                                    $random_number = str_pad(rand(0, pow(10, 2) - 1), 2, '0', STR_PAD_LEFT);

                                    if ($result_import[$i]['saldo_umum'] != 0 && $result_import[$i]['saldo_umum'] != null && $result_import[$i]['saldo_umum'] != "" && ! empty($result_import[$i]['saldo_umum'])) {

                                        $transaksi_umum[$i] = [
                                            'nomor_transaksi_umum' => "TPU01" . $random_number . "/" . date('YmdHis'),
                                            'id_pegawai'           => $this->user_finance[0]->id_akun_keuangan,
                                            'id_tingkat'           => $result_import[$i]['tingkat'],
                                            'nip_pegawai'          => $result_import[$i]['nip'],
                                            'nominal'              => $result_import[$i]['saldo_umum'],
                                            'jenis_tabungan'       => 1,
                                            'saldo'                => $result_import[$i]['saldo_umum'],
                                            'catatan'              => "transaksi import awal",
                                            'tanggal_transaksi'    => $result_import[$i]['tanggal_transaksi'],
                                            'status_kredit_debet'  => "1",
                                            'th_ajaran'            => $result_import[$i]['tahun_ajaran'],
                                        ];
                                    }

                                    if ($result_import[$i]['saldo_qurban'] != 0 && $result_import[$i]['saldo_qurban'] != null && $result_import[$i]['saldo_qurban'] != "" && ! empty($result_import[$i]['saldo_qurban'])) {

                                        $transaksi_qurban[$i] = [
                                            'nomor_transaksi_qurban' => "TPQ01" . $random_number . "/" . date('YmdHis'),
                                            'id_pegawai'             => $this->user_finance[0]->id_akun_keuangan,
                                            'id_tingkat'             => $result_import[$i]['tingkat'],
                                            'nip_pegawai'            => $result_import[$i]['nip'],
                                            'nominal'                => $result_import[$i]['saldo_qurban'],
                                            'jenis_tabungan'         => 2,
                                            'saldo'                  => $result_import[$i]['saldo_qurban'],
                                            'catatan'                => "transaksi import awal",
                                            'tanggal_transaksi'      => $result_import[$i]['tanggal_transaksi'],
                                            'status_kredit_debet'    => "1",
                                            'th_ajaran'              => $result_import[$i]['tahun_ajaran'],
                                        ];
                                    }

                                    if ($result_import[$i]['saldo_wisata'] != 0 && $result_import[$i]['saldo_wisata'] != null && $result_import[$i]['saldo_wisata'] != "" && ! empty($result_import[$i]['saldo_wisata'])) {

                                        $transaksi_wisata[$i] = [
                                            'nomor_transaksi_wisata' => "TPW01" . $random_number . "/" . date('YmdHis'),
                                            'id_pegawai'             => $this->user_finance[0]->id_akun_keuangan,
                                            'id_tingkat'             => $result_import[$i]['tingkat'],
                                            'nip_pegawai'            => $result_import[$i]['nip'],
                                            'nominal'                => $result_import[$i]['saldo_wisata'],
                                            'jenis_tabungan'         => 3,
                                            'saldo'                  => $result_import[$i]['saldo_wisata'],
                                            'catatan'                => "transaksi import awal",
                                            'tanggal_transaksi'      => $result_import[$i]['tanggal_transaksi'],
                                            'status_kredit_debet'    => "1",
                                            'th_ajaran'              => $result_import[$i]['tahun_ajaran'],
                                        ];
                                    }

                                }

                                if ($transaksi_umum) {
                                    $this->db2->insert_batch('transaksi_tabungan_umum_pegawai', $transaksi_umum);
                                }

                                if ($transaksi_qurban) {
                                    $this->db2->insert_batch('transaksi_tabungan_qurban_pegawai', $transaksi_qurban);
                                }

                                if ($transaksi_wisata) {
                                    $this->db2->insert_batch('transaksi_tabungan_wisata_pegawai', $transaksi_wisata);
                                }

                                $this->DebtsModel->clear_import_data_employee_saving();

                                $output = ["status" => true,
                                    "token"                  => $token,
                                    "confirm"                => false,
                                    "messages"               => "Berhasil!, Seluruh Data Nasabah telah diimport ke database. Dimohon untuk melakukan <b>PENGECEKAN ULANG</b>. Terima Kasih.",
                                ];

                            } else {
                                $output = ["status" => false,
                                    "token"                  => $token,
                                    "confirm"                => false,
                                    "messages"               => "Mohon Maaf!, Terjadi Kesalahan, Silahkan import ulang..",
                                ];
                            }
                        }
                    }
                }

            } else {

                $output = ["status" => false,
                    "confirm"                => false,
                    "token"                  => $token,
                    "messages"               => "Opss!, Password Anda salah, Coba ulangi sekali lagi..",
                ];
            }

        }
        echo json_encode($output);
    }

    public function reject_import_employee_saving()
    {

        $token = $this->security->get_csrf_hash();
        $input = $this->DebtsModel->clear_import_data_employee_saving();

        if ($input == true) {

            $output = ["status" => true,
                "token"                  => $token,
                "messages"               => "Pemberitahuan!, Seluruh Data Nasabah Pegawai batal diimport ke database. Terima Kasih.",
            ];

        } else {
            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Mohon Maaf!, Terjadi Kesalahan, Silahkan import ulang..",
            ];
        }
        echo json_encode($output);
    }

    public function delete_import_employee_saving()
    {
        $id_nasabah   = $this->input->post('id_nasabah');
        $nip          = $this->input->post('nip');
        $nama_pegawai = $this->input->post('nama_pegawai');
        $password     = $this->input->post('password');

        $token = $this->security->get_csrf_hash();

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {

            if ($id_nasabah) {

                $check_pass = $this->DebtsModel->check_pass_admin($this->user_finance[0]->id_akun_keuangan);
                if (password_verify($password, $check_pass[0]->password)) {

                    $delete = $this->DebtsModel->delete_import_employee_saving_by_id($id_nasabah);

                    if ($delete == true) {
                        $output = ["status" => true,
                            "token"                  => $token,
                            "messages"               => "Berhasil, Data Import Tabungan Pegawai atas nama <b>" . strtoupper($nama_pegawai) . " (" . $nip . ")</b> Telah Terhapus..",
                        ];
                    } else {

                        $output = ["status" => false,
                            "token"                  => $token,
                            "messages"               => "Mohon Maaf!, Data Tabungan tidak dapat dihapus oleh sistem, Silahkan coba lagi.",
                        ];
                    }
                } else {

                    $output = ["status" => false,
                        "token"                  => $token,
                        "messages"               => "Opps!, Password Anda Salah, Silahkan coba lagi.",
                    ];
                }
            } else {

                $output = ["status" => false,
                    "token"                  => $token,
                    "messages"               => "Opps!, ID Nasabah belum diinputkan, Silahkan coba lagi.",
                ];
            }
        } else {
            $output = ["status" => false,
                "token"                  => $token,
                "messages"               => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            ];
        }
        echo json_encode($output);
    }

    public function googleCaptachStore($gpost = '', $ip_address = '')
    {

        $recaptchaResponse = $gpost;

        $userIp = $ip_address;
        $secret = $this->config->item('google_secret_key');
        $url    = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;

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

        if (! empty($this->user_finance) && in_array($this->user_finance[0]->id_role_struktur, $this->allowed_roles)) {
            $transaction = [];
            $result      = $this->DebtsModel->check_match_name(trim($name));

            if ($result) {
                foreach ($result as $index => $item) {
                    // Perform the text match and check if it's above the threshold
                    $score = $this->matching->single_text_match(strtoupper(trim(preg_replace("/'/", "", $item->nama_lengkap))), strtoupper(trim($name)));
                    if ($score >= 80 && $score <= 100) {
                        $transaction[] = [
                            'nis'                   => $item->nis,
                            'nama_lengkap'          => $item->nama_lengkap,
                            'level_tingkat'         => $item->level_tingkat,
                            'email'                 => $item->email,
                            'nomor_handphone'       => $item->nomor_handphone,
                            'tahun_ajaran'          => $item->tahun_ajaran,
                            'saldo_tabungan_umum'   => $item->saldo_tabungan_umum,
                            'saldo_tabungan_qurban' => $item->saldo_tabungan_qurban,
                            'saldo_tabungan_wisata' => $item->saldo_tabungan_wisata,
                            'score'                 => $score,
                        ];
                    }
                }
                if ($transaction) {
                    $output = [
                        "status"   => true,
                        "data"     => $transaction,
                        "messages" => "Opps!, Nama tersebut kemungkinan terdapat kesalahan penulisan atau telah dipakai dengan berbeda NIS karena terdapat kesamaan dengan Nama Lainnya, Silahkan cek kesamaan Nama dibawah ini!. *ABAIKAN JIKA MEMANG BERBEDA & REVISI JIKA SALAH*",
                    ];
                } else {
                    $output = [
                        "status"   => false,
                        "messages" => "Ok!, Nama dengan Nomor Bayar tersebut telah sesuai.",
                    ];
                }
            } else {
                $output = [
                    "status"   => false,
                    "messages" => "Ok!, Nama dengan Nomor Bayar tersebut telah sesuai.",
                ];
            }
        } else {
            $output = ["status" => false,
                "messages"               => "Ok!, Nama Tidak Terdaftar, Silahkan coba lagi.",
            ];
        }
        echo json_encode($output);
    }

    //---------------------------------------GET AJAX POSITION---------------------------------------//

    public function add_ajax_position($id_pos = '', $id_jab = '')
    {

        $query = $this->db2->get_where('jabatan', ['level_tingkat' => $id_pos]);
        $data  = "<option value=''>Pilih Jabatan Pegawai</option>";
        foreach ($query->result() as $value) {
            if ($id_jab != '' || $id_jab != null) {
                if ($id_jab == $value->id_jabatan) {
                    $data .= "<option selected value='" . $value->id_jabatan . "'>" . strtoupper($value->hasil_nama_jabatan) . "</option>";
                } else {
                    $data .= "<option value='" . $value->id_jabatan . "'>" . strtoupper($value->hasil_nama_jabatan) . "</option>";
                }
            } else {
                $data .= "<option value='" . $value->id_jabatan . "'>" . strtoupper($value->hasil_nama_jabatan) . "</option>";
            }
        }
        echo $data;
    }

    //-----------------------------------------------------------------------//
}
