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

        if ($this->session->userdata('sias-finance') == false) {
            redirect('finance/auth');
        }
        $this->load->library('form_validation');
        $this->load->library('pdfgenerator');
    }

    //
    //-------------------------------DASHBOARD------------------------------//
    //

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

    public function saving_transaction()
    {
        $data['nav_save'] = 'menu-item-here';
        $data['structure'] = $this->SavingsModel->get_structure_account();
        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            $this->template->load('template_finance/template_finance', 'finance_savings_transaction', $data);
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
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_all_transaction()
    {
        $param = $this->input->get();
        $get = $this->security->xss_clean($param);

        $data = $this->SavingsModel->get_all_transaction_savings($get['start_date'], $get['end_date']);

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
            echo json_encode($data);
        } else {
            $output = array("status" => false,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

            echo json_encode($output);
        }
    }

    public function get_student_transaction($nis = '')
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

    public function recap_transaction($nis = '')
    {

        $data['nav_save'] = 'menu-item-here';

        $data['schoolyear'] = $this->SavingsModel->get_schoolyear();

        $data['info_siswa'] = $this->SavingsModel->get_student_by_nis($nis);
        $data['info_tabungan'] = $this->SavingsModel->get_info_student_transaction($nis);

        if ($nis == "" or empty($nis)) {
            $this->load->view('error_404', $data);
        } else {
            if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {
                $this->template->load('template_finance/template_finance', 'finance_savings_balance', $data);
            } else {
                $datas['title'] = 'ERROR | PAGE NOT FOUND';
                $this->load->view('error_404', $datas);
            }
        }
    }

    public function post_credit()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $data['status_kredit_debet'] = "1";
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {
                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if ($get_balance[0]->saldo_tabungan == 0) {

                    $data['saldo_akhir'] = $data['nominal'];

                } else if ($data['nominal'] <= 0) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh <= 0, Silahkan input ulang.",
                    );

                    echo json_encode($output);
                    exit();

                } else {

                    $data['saldo_akhir'] = $data['nominal'] + $get_balance[0]->saldo_tabungan;

                }

                $input_credit = $this->SavingsModel->insert_credit_saving($this->user_finance[0]->id_akun_keuangan, $data);
                $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);

                if ($input_credit == true && $update_balance == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Disetor!, Setor Tabungan Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah ditambahkan. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan.",
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

                if (($get_balance[0]->saldo_tabungan - $get_transaction[0]->nominal) == 0) {

                    $data['saldo_akhir'] = $data['nominal'];

                } else if ($data['nominal'] <= 0) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh <= 0, Silahkan input ulang.",
                    );

                    echo json_encode($output);
                    exit();

                } else {

                    $data['saldo_akhir'] = $data['nominal'] + ($get_balance[0]->saldo_tabungan - $get_transaction[0]->nominal);

                }

                $input_credit = $this->SavingsModel->update_credit_saving($data['id_transaksi'], $data);
                $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);

                if ($input_credit == true && $update_balance == true) {

                    $output = array("status" => true,
                        "token" => $token,
                        "messages" => "Berhasil Diubah!,Perubahan Setor Tabungan Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah diubah. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan.",
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

    public function post_debet()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $data['status_kredit_debet'] = "2";
        $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data == false or empty($data['nis'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar, Silahkan input ulang.",
                );

            } else {

                if (($get_balance[0]->saldo_tabungan > 0) && ($data['nominal'] <= $get_balance[0]->saldo_tabungan)) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan - $data['nominal'];

                    $input_debet = $this->SavingsModel->insert_debet_saving($this->user_finance[0]->id_akun_keuangan, $data);
                    $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);

                    if ($input_debet == true && $update_balance == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Ditarik!, Penarikan Tabungan Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah ditarik. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan.",
                        );

                    } else {

                        $output = array("status" => false,
                            "token" => $token,
                            "messages" => "Mohon Maaf!, Terjadi kesalahan, Silahkan input ulang.",
                        );
                    }

                } else if (($get_balance[0]->saldo_tabungan <= 0)) {

                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Saldo Mencukupi, Tidak Boleh <= 0, Silahkan input ulang.",
                    );
                } else if (($data['nominal'] <= 0)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh <= 0, Silahkan input ulang.",
                    );

                } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan)) {
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
                            "messages" => "Berhasil Diubah!, Perubahan Penarikan Tabungan Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah diubah. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan.",
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
                } else if (($data['nominal'] <= 0)) {
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Opps!, Pastikan Inputan Terisi dengan Benar & Tidak Boleh <= 0, Silahkan input ulang.",
                    );

                } else if (($data['nominal'] > $get_balance[0]->saldo_tabungan)) {
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

    public function delete_credit_transaction()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['nis'] && $data['id_transaksi']) {

                $get_transaction = $this->SavingsModel->get_student_transaction_last($data['id_transaksi']);
                $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

                if ($get_transaction == true && $get_balance == true) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan - $get_transaction[0]->nominal;

                    $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);
                    $delete = $this->SavingsModel->delete_transaction($data['id_transaksi']);

                    if ($update_balance == true && $delete == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Dihapus!, Kredit Tabungan Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan.",
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

    public function delete_debet_transaction()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            if ($data['nis'] && $data['id_transaksi']) {

                $get_transaction = $this->SavingsModel->get_student_transaction_last($data['id_transaksi']);
                $get_balance = $this->SavingsModel->get_student_balance($data['nis']);

                if ($get_transaction == true && $get_balance == true) {

                    $data['saldo_akhir'] = $get_balance[0]->saldo_tabungan + $get_transaction[0]->nominal;

                    $update_balance = $this->SavingsModel->update_balance_saving($data['nis'], $data['saldo_akhir']);
                    $delete = $this->SavingsModel->delete_transaction($data['id_transaksi']);

                    if ($update_balance == true && $delete == true) {

                        $output = array("status" => true,
                            "token" => $token,
                            "messages" => "Berhasil Dihapus!, Debet Tabungan Atas Nama " . $get_balance[0]->nama_lengkap . " (" . $get_balance[0]->nis . ") telah dihapus. Silahkan cek Rekap/Histori Tabungan menu Daftar Tabungan.",
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

    public function print_saving_pdf()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            $fileName = 'Laporan_Tabungan_Siswa_' . $data['date_range'];

            if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
                );
            } else {

                $get['saving'] = $this->SavingsModel->get_data_saving_export_all($data['data_check']);
                $get['page'] = $this->SavingsModel->get_page();
                $get['contact'] = $this->SavingsModel->get_contact();
                $get['rentang_tanggal'] = $data['date_range'];

                if ($get['saving'] == null or $get['saving'] == false) {
                    //add new data
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf, Data Anda tidak ditemukan. Silahkan cek ulang.",
                    );
                } else {

                    $html = $this->load->view('pdf_template/saving', $get, true);
                    $this->pdfgenerator->generate($html, $fileName, 0, './uploads/pendaftaran/files/', true);

                }
            }
        } else {
            $output = array("status" => false,
                "token" => $token,
                "messages" => "Opps!, ID User Tidak Terdaftar, Silahkan coba lagi.",
            );

        }

        echo json_encode($output);
    }
    //-----------------------------------------------------------------------//
//
}
