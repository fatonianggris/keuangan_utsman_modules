<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Report extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if ($this->session->userdata('sias-finance') == false) {
            redirect('finance/auth');
        }
        $this->user_finance = $this->session->userdata("sias-finance");

        $this->load->model('ReportModel');

        $this->load->library('form_validation');
        $this->load->library('pdfgenerator');
    }

    //---------------------------EKSPORT DATA---------------------------------//

    public function export_data_personal_csv_all()
    {
        $this->load->helper('download');

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $extension = 'csv';

        $fileName = 'Laporan_Tabungan_Per_Siswa_' . $data['date_range'];

        $token = $this->security->get_csrf_hash();
        //var_dump($data['data_check']);exit;

        if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

            $output_ajax = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
            );

        } else {

            if (!empty($extension)) {
                $extension = $extension;
            } elseif ($extension == 'xlsx') {
                $extension = 'xlsx';
            } else {
                $extension = 'xls';
            }

            $empInfo = $this->ReportModel->get_data_personal_saving_excel_all($data['data_check'], $data['start_date'], $data['end_date']);
            //            var_dump($empInfo);
            //            exit;
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Judul: ');
            $sheet->setCellValue('B1', 'Rekap Tabungan Per Siswa Utsman');
            $sheet->setCellValue('D1', 'Periode Tanggal: ');
            $sheet->setCellValue('E1', $data['date_range']);

            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('D1')->getFont()->setBold(true);

            $sheet->setCellValue('A2', 'NIS');
            $sheet->setCellValue('B2', 'Nama Siswa');
            $sheet->setCellValue('C2', 'Tingkat');
            $sheet->setCellValue('D2', 'Kredit Umum');
            $sheet->setCellValue('E2', 'Debit Umum');
            $sheet->setCellValue('F2', 'Saldo Umum');
            $sheet->setCellValue('G2', 'Kredit Qurban');
            $sheet->setCellValue('H2', 'Debit Qurban');
            $sheet->setCellValue('I2', 'Saldo Qurban');
            $sheet->setCellValue('J2', 'Kredit Wisata');
            $sheet->setCellValue('K2', 'Debit Wisata');
            $sheet->setCellValue('L2', 'Saldo Wisata');

            $rowCount = 3;
            $tingkat = "";

            $total_debit_um = 0;
            $total_kredit_um = 0;
            $total_saldo_um = 0;

            $total_debit_qr = 0;
            $total_kredit_qr = 0;
            $total_saldo_qr = 0;

            $total_debit_ws = 0;
            $total_kredit_ws = 0;
            $total_saldo_ws = 0;

            foreach ($empInfo as $element) {

                if ($element['saldo_umum'] == '' or $element['saldo_umum'] == null) {
                    $element['saldo_umum'] = 0;
                }

                if ($element['saldo_qurban'] == '' or $element['saldo_qurban'] == null) {
                    $element['saldo_qurban'] = 0;
                }

                if ($element['saldo_wisata'] == '' or $element['saldo_wisata'] == null) {
                    $element['saldo_wisata'] = 0;
                }

                if ($element['level_tingkat'] == '6') {
                    $tingkat = 'DC';
                } else if ($element['level_tingkat'] == '1') {
                    $tingkat = 'KB';
                } else if ($element['level_tingkat'] == '2') {
                    $tingkat = 'TK';
                } else if ($element['level_tingkat'] == '3') {
                    $tingkat = 'SD';
                } else if ($element['level_tingkat'] == '4') {
                    $tingkat = 'SMP';
                }

                $total_kredit_um = $total_kredit_um + $element['kredit_umum'];
                $total_debit_um = $total_debit_um + $element['debet_umum'];
                $total_saldo_um = $total_saldo_um + $element['saldo_umum'];

                $total_kredit_qr = $total_kredit_qr + $element['kredit_qurban'];
                $total_debit_qr = $total_debit_qr + $element['debet_qurban'];
                $total_saldo_qr = $total_saldo_qr + $element['saldo_qurban'];

                $total_kredit_ws = $total_kredit_ws + $element['kredit_wisata'];
                $total_debit_ws = $total_debit_ws + $element['debet_wisata'];
                $total_saldo_ws = $total_saldo_ws + $element['saldo_wisata'];

                $sheet->setCellValue('A' . $rowCount, $element['nis']);
                $sheet->setCellValue('B' . $rowCount, strtoupper($element['nama_lengkap']));
                $sheet->setCellValue('C' . $rowCount, $tingkat);
                $sheet->setCellValue('D' . $rowCount, $element['kredit_umum']);
                $sheet->setCellValue('E' . $rowCount, $element['debet_umum']);
                $sheet->setCellValue('F' . $rowCount, $element['saldo_umum']);
                $sheet->setCellValue('G' . $rowCount, $element['kredit_qurban']);
                $sheet->setCellValue('H' . $rowCount, $element['debet_qurban']);
                $sheet->setCellValue('I' . $rowCount, $element['saldo_qurban']);
                $sheet->setCellValue('J' . $rowCount, $element['kredit_wisata']);
                $sheet->setCellValue('K' . $rowCount, $element['debet_wisata']);
                $sheet->setCellValue('L' . $rowCount, $element['saldo_wisata']);

                $rowCount++;
            }

            $sheet->setCellValue('C' . $rowCount, 'TOTAL');
            $sheet->setCellValue('D' . $rowCount, ($total_kredit_um));
            $sheet->setCellValue('E' . $rowCount, ($total_debit_um));
            $sheet->setCellValue('F' . $rowCount, ($total_saldo_um));
            $sheet->setCellValue('G' . $rowCount, ($total_kredit_qr));
            $sheet->setCellValue('H' . $rowCount, ($total_debit_qr));
            $sheet->setCellValue('I' . $rowCount, ($total_saldo_qr));
            $sheet->setCellValue('J' . $rowCount, ($total_kredit_ws));
            $sheet->setCellValue('K' . $rowCount, ($total_debit_ws));
            $sheet->setCellValue('L' . $rowCount, ($total_saldo_ws));

            $sheet->getStyle('C' . $rowCount . ':M' . $rowCount)->getFont()->setBold(true);

            ob_start();
            if ($extension == 'csv') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
                $fileName = $fileName . '.csv';
            } elseif ($extension == 'xlsx') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $fileName = $fileName . '.xlsx';
            } else {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
                $fileName = $fileName . '.xls';
            }
            $writer->save('php://output');
            $xlsData = ob_get_contents();
            ob_end_clean();

            $output_ajax = array("status" => true,
                "token" => $token,
                'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData),
                'filename' => $fileName,
                "messages" => "Berhasil!, Ekspor Laporan Excel berhasil dicetak. Silahkan cek ulang.",
            );
        }
        die(json_encode($output_ajax));
    }
	
    public function export_data_joint_saving_csv_all()
    {
        $this->load->helper('download');

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $extension = 'csv';

        $fileName = 'Laporan_Tabungan_Per_Tabungan_' . $data['date_range'];

        $token = $this->security->get_csrf_hash();
        //var_dump($data['data_check']);exit;

        if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

            $output_ajax = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
            );

        } else {

            if (!empty($extension)) {
                $extension = $extension;
            } elseif ($extension == 'xlsx') {
                $extension = 'xlsx';
            } else {
                $extension = 'xls';
            }

            $empInfo = $this->ReportModel->get_data_joint_saving_excel_all($data['data_check'], $data['start_date'], $data['end_date']);
            //            var_dump($empInfo);
            //            exit;
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Judul: ');
            $sheet->setCellValue('B1', 'Rekap Tabungan Per Tabungan Bersama Utsman');
            $sheet->setCellValue('D1', 'Periode Tanggal: ');
            $sheet->setCellValue('E1', $data['date_range']);

            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('D1')->getFont()->setBold(true);

            $sheet->setCellValue('A2', 'No Rek');
            $sheet->setCellValue('B2', 'Nama Tabungan');
            $sheet->setCellValue('C2', 'Penanggung Jawab');
            $sheet->setCellValue('D2', 'Nomor Handphone');
            $sheet->setCellValue('E2', 'Tahun Ajaran');
            $sheet->setCellValue('F2', 'Tingkat');
            $sheet->setCellValue('G2', 'Kredit');
            $sheet->setCellValue('H2', 'Debit');
            $sheet->setCellValue('I2', 'Saldo');

            $rowCount = 3;
            $total_debit = 0;
            $total_kredit = 0;
            $total_saldo = 0;

            $tingkat = '';

            foreach ($empInfo as $element) {

                if ($element['saldo_bersama'] == '' or $element['saldo_bersama'] == null) {
                    $element['saldo_bersama'] = 0;
                }

                if ($element['id_tingkat'] == '6') {
                    $tingkat = 'DC';
                } else if ($element['id_tingkat'] == '1') {
                    $tingkat = 'KB';
                } else if ($element['id_tingkat'] == '2') {
                    $tingkat = 'TK';
                } else if ($element['id_tingkat'] == '3') {
                    $tingkat = 'SD';
                } else if ($element['id_tingkat'] == '4') {
                    $tingkat = 'SMP';
                }

                $total_kredit = $total_kredit + $element['kredit_bersama'];
                $total_debit = $total_debit + $element['debet_bersama'];
                $total_saldo = $total_saldo + $element['saldo_bersama'];

                $sheet->setCellValue('A' . $rowCount, $element['nomor_rekening_bersama']);
                $sheet->setCellValue('B' . $rowCount, strtoupper($element['nama_tabungan_bersama']));
                $sheet->setCellValue('C' . $rowCount, ucwords(strtolower($element['nama_lengkap'])));
                $sheet->setCellValue('D' . $rowCount, $element['nomor_handphone']);
                $sheet->setCellValue('E' . $rowCount, $element['tahun_ajaran']);
                $sheet->setCellValue('F' . $rowCount, $tingkat);
                $sheet->setCellValue('G' . $rowCount, $element['kredit_bersama']);
                $sheet->setCellValue('H' . $rowCount, $element['debet_bersama']);
                $sheet->setCellValue('I' . $rowCount, $element['saldo_bersama']);

                $rowCount++;
            }

            $sheet->setCellValue('F' . $rowCount, ('TOTAL'));
            $sheet->setCellValue('G' . $rowCount, ($total_kredit));
            $sheet->setCellValue('H' . $rowCount, ($total_debit));
            $sheet->setCellValue('I' . $rowCount, ($total_saldo));

            $sheet->getStyle('C' . $rowCount . ':M' . $rowCount)->getFont()->setBold(true);

            ob_start();
            if ($extension == 'csv') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
                $fileName = $fileName . '.csv';
            } elseif ($extension == 'xlsx') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $fileName = $fileName . '.xlsx';
            } else {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
                $fileName = $fileName . '.xls';
            }
            $writer->save('php://output');
            $xlsData = ob_get_contents();
            ob_end_clean();

            $output_ajax = array("status" => true,
                "token" => $token,
                'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData),
                'filename' => $fileName,
                "messages" => "Berhasil!, Ekspor Laporan Excel berhasil dicetak. Silahkan cek ulang.",
            );
        }
        die(json_encode($output_ajax));
    }
    public function print_data_personal_saving_pdf_all()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            $fileName = 'Laporan_Tabungan_Per_Siswa_' . $data['date_range'];

            if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
                );
            } else {

                $output = array("status" => true,
                    "token" => $token,
                    "messages" => "Berhasil!, Laporan berhasil dicetak, Silahkan cek ulang.",
                );

                $get['saving'] = $this->ReportModel->get_data_personal_saving_pdf_all($data['data_check'], $data['start_date'], $data['end_date']);
                $get['page'] = $this->ReportModel->get_page();
                $get['contact'] = $this->ReportModel->get_contact();
                $get['rentang_tanggal'] = $data['date_range'];

                if ($get['saving'] == null or $get['saving'] == false) {
                    //add new data
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf, Data Anda tidak ditemukan. Silahkan cek ulang.",
                    );
                } else {
                    $html = $this->load->view('pdf_template/personal_saving', $get, true);
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
    public function print_data_joint_saving_pdf_all()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            $fileName = 'Laporan_Tabungan_Per_Tabungan_' . $data['date_range'];

            if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
                );
            } else {

                $output = array("status" => true,
                    "token" => $token,
                    "messages" => "Berhasil!, Laporan berhasil dicetak, Silahkan cek ulang.",
                );

                $get['saving'] = $this->ReportModel->get_data_joint_saving_pdf_all($data['data_check'], $data['start_date'], $data['end_date']);
                $get['page'] = $this->ReportModel->get_page();
                $get['contact'] = $this->ReportModel->get_contact();
                $get['rentang_tanggal'] = $data['date_range'];

                if ($get['saving'] == null or $get['saving'] == false) {
                    //add new data
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf, Data Anda tidak ditemukan. Silahkan cek ulang.",
                    );
                } else {
                    $html = $this->load->view('pdf_template/joint_saving', $get, true);
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

    public function export_data_csv_transaction_joint_all()
    {
        $this->load->helper('download');

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $extension = 'csv';

        $fileName = 'Laporan_Transaksi_Tabungan_Bersama_' . $data['date_range'];

        $token = $this->security->get_csrf_hash();
        //var_dump($data['data_check']);exit;

        if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

            $output_ajax = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
            );

        } else {

            if (!empty($extension)) {
                $extension = $extension;
            } elseif ($extension == 'xlsx') {
                $extension = 'xlsx';
            } else {
                $extension = 'xls';
            }

            $empInfo = $this->ReportModel->get_data_saving_excel_transaction_joint_all($data['data_check']);
            //            var_dump($empInfo);
            //            exit;
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Judul: ');
            $sheet->setCellValue('B1', 'Rekap Tabungan Bersama Utsman');
            $sheet->setCellValue('D1', 'Periode Tanggal: ');
            $sheet->setCellValue('E1', $data['date_range']);

            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('D1')->getFont()->setBold(true);

            $sheet->setCellValue('A2', 'No. Transaksi');
            $sheet->setCellValue('B2', 'No. Rekening');
            $sheet->setCellValue('C2', 'Nama Tabungan');
            $sheet->setCellValue('D2', 'Jenis Transaksi');
            $sheet->setCellValue('E2', 'Tanggal Tabungan');
            $sheet->setCellValue('F2', 'Tahun Ajaran');
            $sheet->setCellValue('G2', 'Waktu Transaksi');
            $sheet->setCellValue('H2', 'Tingkat');
            $sheet->setCellValue('I2', 'Kredit');
            $sheet->setCellValue('J2', 'Debit');
            $sheet->setCellValue('K2', 'Saldo');

            $rowCount = 3;
            $total_debit = 0;
            $total_kredit = 0;
            $total_saldo = 0;

            $jenis_transaksi = '';
            $nama_tingkat = '';
            $debit = 0;
            $kredit = 0;

            foreach ($empInfo as $element) {

                if ($element['status_kredit_debet'] == 1) {
                    $jenis_transaksi = 'KREDIT';
                    $debit = 0;
                    $kredit = $element['nominal'];
                    $total_kredit = $total_kredit + $element['nominal'];

                } else if ($element['status_kredit_debet'] == 2) {
                    $jenis_transaksi = 'DEBIT';
                    $debit = $element['nominal'];
                    $kredit = 0;
                    $total_debit = $total_debit + $element['nominal'];
                }

                if ($element['id_tingkat'] == 1) {
                    $nama_tingkat = 'KB';
                } else if ($element['id_tingkat'] == 2) {
                    $nama_tingkat = 'TK';
                } else if ($element['id_tingkat'] == 3) {
                    $nama_tingkat = 'SD';
                } else if ($element['id_tingkat'] == 4) {
                    $nama_tingkat = 'SMP';
                } else if ($element['id_tingkat'] == 6) {
                    $nama_tingkat = 'DC';
                }

                $total_saldo = $total_saldo + $element['saldo'];

                $sheet->setCellValue('A' . $rowCount, $element['nomor_transaksi_bersama']);
                $sheet->setCellValue('B' . $rowCount, $element['nomor_rekening_bersama']);
                $sheet->setCellValue('C' . $rowCount, strtoupper($element['nama_tabungan_bersama']));
                $sheet->setCellValue('D' . $rowCount, $jenis_transaksi);
                $sheet->setCellValue('E' . $rowCount, $element['tanggal_transaksi']);
                $sheet->setCellValue('F' . $rowCount, $element['tahun_ajaran']);
                $sheet->setCellValue('G' . $rowCount, $element['waktu_transaksi']);
                $sheet->setCellValue('H' . $rowCount, $nama_tingkat);
                $sheet->setCellValue('I' . $rowCount, $kredit);
                $sheet->setCellValue('J' . $rowCount, $debit);
                $sheet->setCellValue('K' . $rowCount, $element['saldo']);

                $rowCount++;
            }

            $sheet->setCellValue('H' . $rowCount, 'TOTAL');
            $sheet->setCellValue('I' . $rowCount, ($total_kredit));
            $sheet->setCellValue('J' . $rowCount, ($total_debit));

            $sheet->getStyle('I' . $rowCount . ':J' . $rowCount)->getFont()->setBold(true);

            ob_start();
            if ($extension == 'csv') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
                $fileName = $fileName . '.csv';
            } elseif ($extension == 'xlsx') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $fileName = $fileName . '.xlsx';
            } else {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
                $fileName = $fileName . '.xls';
            }
            $writer->save('php://output');
            $xlsData = ob_get_contents();
            ob_end_clean();

            $output_ajax = array("status" => true,
                "token" => $token,
                'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData),
                'filename' => $fileName,
                "messages" => "Berhasil!, Ekspor Laporan Excel berhasil dicetak. Silahkan cek ulang.",
            );
        }
        die(json_encode($output_ajax));
    }
    public function export_data_csv_transaction_general_all()
    {
        $this->load->helper('download');

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $extension = 'csv';

        $fileName = 'Laporan_Transaksi_Tabungan_Umum_Siswa_' . $data['date_range'];

        $token = $this->security->get_csrf_hash();
        //var_dump($data['data_check']);exit;

        if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

            $output_ajax = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
            );

        } else {

            if (!empty($extension)) {
                $extension = $extension;
            } elseif ($extension == 'xlsx') {
                $extension = 'xlsx';
            } else {
                $extension = 'xls';
            }

            $empInfo = $this->ReportModel->get_data_saving_excel_transaction_general_all($data['data_check']);
            //            var_dump($empInfo);
            //            exit;
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Judul: ');
            $sheet->setCellValue('B1', 'Rekap Tabungan Umum Siswa Utsman');
            $sheet->setCellValue('D1', 'Periode Tanggal: ');
            $sheet->setCellValue('E1', $data['date_range']);

            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('D1')->getFont()->setBold(true);

            $sheet->setCellValue('A2', 'Nomor Transaksi');
            $sheet->setCellValue('B2', 'NIS');
            $sheet->setCellValue('C2', 'Nama Siswa');
            $sheet->setCellValue('D2', 'Jenis Transaksi');
            $sheet->setCellValue('E2', 'Tanggal Tabungan');
            $sheet->setCellValue('F2', 'Tahun Ajaran');
            $sheet->setCellValue('G2', 'Waktu Transaksi');
            $sheet->setCellValue('H2', 'Tingkat');
            $sheet->setCellValue('I2', 'Kredit (Rp)');
            $sheet->setCellValue('J2', 'Debit (Rp)');
            $sheet->setCellValue('K2', 'Saldo (Rp)');

            $rowCount = 3;
            $total_debit = 0;
            $total_kredit = 0;
            $total_saldo = 0;

            $jenis_transaksi = '';
            $nama_tingkat = '';
            $debit = 0;
            $kredit = 0;

            foreach ($empInfo as $element) {

                if ($element['status_kredit_debet'] == 1) {
                    $jenis_transaksi = 'KREDIT';
                    $debit = 0;
                    $kredit = $element['nominal'];
                    $total_kredit = $total_kredit + $element['nominal'];

                } else if ($element['status_kredit_debet'] == 2) {
                    $jenis_transaksi = 'DEBIT';
                    $debit = $element['nominal'];
                    $kredit = 0;
                    $total_debit = $total_debit + $element['nominal'];
                }

                if ($element['id_tingkat'] == 1) {
                    $nama_tingkat = 'KB';
                } else if ($element['id_tingkat'] == 2) {
                    $nama_tingkat = 'TK';
                } else if ($element['id_tingkat'] == 3) {
                    $nama_tingkat = 'SD';
                } else if ($element['id_tingkat'] == 4) {
                    $nama_tingkat = 'SMP';
                } else if ($element['id_tingkat'] == 6) {
                    $nama_tingkat = 'DC';
                }

                $total_saldo = $total_saldo + $element['saldo'];

                $sheet->setCellValue('A' . $rowCount, $element['nomor_transaksi_umum']);
                $sheet->setCellValue('B' . $rowCount, $element['nis_siswa']);
                $sheet->setCellValue('C' . $rowCount, strtoupper($element['nama_lengkap']));
                $sheet->setCellValue('D' . $rowCount, $jenis_transaksi);
                $sheet->setCellValue('E' . $rowCount, $element['tanggal_transaksi']);
                $sheet->setCellValue('F' . $rowCount, $element['tahun_ajaran']);
                $sheet->setCellValue('G' . $rowCount, $element['waktu_transaksi']);
                $sheet->setCellValue('H' . $rowCount, $nama_tingkat);
                $sheet->setCellValue('I' . $rowCount, $kredit);
                $sheet->setCellValue('J' . $rowCount, $debit);
                $sheet->setCellValue('K' . $rowCount, $element['saldo']);

                $rowCount++;
            }

            $sheet->setCellValue('H' . $rowCount, 'TOTAL');
            $sheet->setCellValue('I' . $rowCount, ($total_kredit));
            $sheet->setCellValue('J' . $rowCount, ($total_debit));

            $sheet->getStyle('H' . $rowCount . ':J' . $rowCount)->getFont()->setBold(true);

            ob_start();
            if ($extension == 'csv') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
                $fileName = $fileName . '.csv';
            } elseif ($extension == 'xlsx') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $fileName = $fileName . '.xlsx';
            } else {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
                $fileName = $fileName . '.xls';
            }
            $writer->save('php://output');
            $xlsData = ob_get_contents();
            ob_end_clean();

            $output_ajax = array("status" => true,
                "token" => $token,
                'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData),
                'filename' => $fileName,
                "messages" => "Berhasil!, Ekspor Laporan Excel berhasil dicetak. Silahkan cek ulang.",
            );
        }
        die(json_encode($output_ajax));
    }
    public function export_data_csv_transaction_qurban_all()
    {
        $this->load->helper('download');

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $extension = 'csv';

        $fileName = 'Laporan_Transaksi_Tabungan_Qurban_Siswa_' . $data['date_range'];

        $token = $this->security->get_csrf_hash();
        //var_dump($data['data_check']);exit;

        if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

            $output_ajax = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
            );

        } else {

            if (!empty($extension)) {
                $extension = $extension;
            } elseif ($extension == 'xlsx') {
                $extension = 'xlsx';
            } else {
                $extension = 'xls';
            }

            $empInfo = $this->ReportModel->get_data_saving_excel_transaction_qurban_all($data['data_check']);
            //            var_dump($empInfo);
            //            exit;
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Judul: ');
            $sheet->setCellValue('B1', 'Rekap Tabungan Qurban Siswa Utsman');
            $sheet->setCellValue('D1', 'Periode Tanggal: ');
            $sheet->setCellValue('E1', $data['date_range']);

            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('D1')->getFont()->setBold(true);

            $sheet->setCellValue('A2', 'Nomor Transaksi');
            $sheet->setCellValue('B2', 'NIS');
            $sheet->setCellValue('C2', 'Nama Siswa');
            $sheet->setCellValue('D2', 'Jenis Transaksi');
            $sheet->setCellValue('E2', 'Tanggal Tabungan');
            $sheet->setCellValue('F2', 'Tahun Ajaran');
            $sheet->setCellValue('G2', 'Waktu Transaksi');
            $sheet->setCellValue('H2', 'Tingkat');
            $sheet->setCellValue('I2', 'Kredit (Rp)');
            $sheet->setCellValue('J2', 'Debit (Rp)');
            $sheet->setCellValue('K2', 'Saldo (Rp)');

            $rowCount = 3;
            $total_debit = 0;
            $total_kredit = 0;
            $total_saldo = 0;

            $jenis_transaksi = '';
            $nama_tingkat = '';
            $debit = 0;
            $kredit = 0;

            foreach ($empInfo as $element) {

                if ($element['status_kredit_debet'] == 1) {
                    $jenis_transaksi = 'KREDIT';
                    $debit = 0;
                    $kredit = $element['nominal'];
                    $total_kredit = $total_kredit + $element['nominal'];

                } else if ($element['status_kredit_debet'] == 2) {
                    $jenis_transaksi = 'DEBIT';
                    $debit = $element['nominal'];
                    $kredit = 0;
                    $total_debit = $total_debit + $element['nominal'];
                }

                if ($element['id_tingkat'] == 1) {
                    $nama_tingkat = 'KB';
                } else if ($element['id_tingkat'] == 2) {
                    $nama_tingkat = 'TK';
                } else if ($element['id_tingkat'] == 3) {
                    $nama_tingkat = 'SD';
                } else if ($element['id_tingkat'] == 4) {
                    $nama_tingkat = 'SMP';
                } else if ($element['id_tingkat'] == 6) {
                    $nama_tingkat = 'DC';
                }

                $total_saldo = $total_saldo + $element['saldo'];

                $sheet->setCellValue('A' . $rowCount, $element['nomor_transaksi_qurban']);
                $sheet->setCellValue('B' . $rowCount, $element['nis_siswa']);
                $sheet->setCellValue('C' . $rowCount, strtoupper($element['nama_lengkap']));
                $sheet->setCellValue('D' . $rowCount, $jenis_transaksi);
                $sheet->setCellValue('E' . $rowCount, $element['tanggal_transaksi']);
                $sheet->setCellValue('F' . $rowCount, $element['tahun_ajaran']);
                $sheet->setCellValue('G' . $rowCount, $element['waktu_transaksi']);
                $sheet->setCellValue('H' . $rowCount, $nama_tingkat);
                $sheet->setCellValue('I' . $rowCount, $kredit);
                $sheet->setCellValue('J' . $rowCount, $debit);
                $sheet->setCellValue('K' . $rowCount, $element['saldo']);

                $rowCount++;
            }

            $sheet->setCellValue('H' . $rowCount, 'TOTAL');
            $sheet->setCellValue('I' . $rowCount, ($total_kredit));
            $sheet->setCellValue('J' . $rowCount, ($total_debit));

            $sheet->getStyle('H' . $rowCount . ':J' . $rowCount)->getFont()->setBold(true);

            ob_start();
            if ($extension == 'csv') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
                $fileName = $fileName . '.csv';
            } elseif ($extension == 'xlsx') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $fileName = $fileName . '.xlsx';
            } else {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
                $fileName = $fileName . '.xls';
            }
            $writer->save('php://output');
            $xlsData = ob_get_contents();
            ob_end_clean();

            $output_ajax = array("status" => true,
                "token" => $token,
                'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData),
                'filename' => $fileName,
                "messages" => "Berhasil!, Ekspor Laporan Excel berhasil dicetak. Silahkan cek ulang.",
            );
        }
        die(json_encode($output_ajax));
    }
    public function export_data_csv_transaction_tour_all()
    {
        $this->load->helper('download');

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $extension = 'csv';

        $fileName = 'Laporan_Tabungan_Wisata_Siswa_' . $data['date_range'];

        $token = $this->security->get_csrf_hash();
        //var_dump($data['data_check']);exit;

        if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

            $output_ajax = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
            );

        } else {

            if (!empty($extension)) {
                $extension = $extension;
            } elseif ($extension == 'xlsx') {
                $extension = 'xlsx';
            } else {
                $extension = 'xls';
            }

            $empInfo = $this->ReportModel->get_data_saving_excel_transaction_tour_all($data['data_check']);
            //            var_dump($empInfo);
            //            exit;
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Judul: ');
            $sheet->setCellValue('B1', 'Rekap Tabungan Wisata Siswa Utsman');
            $sheet->setCellValue('D1', 'Periode Tanggal: ');
            $sheet->setCellValue('E1', $data['date_range']);

            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('D1')->getFont()->setBold(true);

            $sheet->setCellValue('A2', 'Nomor Transaksi');
            $sheet->setCellValue('B2', 'NIS');
            $sheet->setCellValue('C2', 'Nama Siswa');
            $sheet->setCellValue('D2', 'Jenis Transaksi');
            $sheet->setCellValue('E2', 'Tanggal Tabungan');
            $sheet->setCellValue('F2', 'Tahun Ajaran');
            $sheet->setCellValue('G2', 'Waktu Transaksi');
            $sheet->setCellValue('H2', 'Tingkat');
            $sheet->setCellValue('I2', 'Kredit (Rp)');
            $sheet->setCellValue('J2', 'Debit (Rp)');
            $sheet->setCellValue('K2', 'Saldo (Rp)');

            $rowCount = 3;
            $total_debit = 0;
            $total_kredit = 0;
            $total_saldo = 0;

            $jenis_transaksi = '';
            $nama_transaksi = '';
            $debit = 0;
            $kredit = 0;

            foreach ($empInfo as $element) {

                if ($element['status_kredit_debet'] == 1) {
                    $jenis_transaksi = 'KREDIT';
                    $debit = 0;
                    $kredit = $element['nominal'];
                    $total_kredit = $total_kredit + $element['nominal'];

                } else if ($element['status_kredit_debet'] == 2) {
                    $jenis_transaksi = 'DEBIT';
                    $debit = $element['nominal'];
                    $kredit = 0;
                    $total_debit = $total_debit + $element['nominal'];
                }

                if ($element['id_tingkat'] == 1) {
                    $nama_tingkat = 'KB';
                } else if ($element['id_tingkat'] == 2) {
                    $nama_tingkat = 'TK';
                } else if ($element['id_tingkat'] == 3) {
                    $nama_tingkat = 'SD';
                } else if ($element['id_tingkat'] == 4) {
                    $nama_tingkat = 'SMP';
                } else if ($element['id_tingkat'] == 6) {
                    $nama_tingkat = 'DC';
                }

                $total_saldo = $total_saldo + $element['saldo'];

                $sheet->setCellValue('A' . $rowCount, $element['nomor_transaksi_wisata']);
                $sheet->setCellValue('B' . $rowCount, $element['nis_siswa']);
                $sheet->setCellValue('C' . $rowCount, strtoupper($element['nama_lengkap']));
                $sheet->setCellValue('D' . $rowCount, $jenis_transaksi);
                $sheet->setCellValue('E' . $rowCount, $element['tanggal_transaksi']);
                $sheet->setCellValue('F' . $rowCount, $element['tahun_ajaran']);
                $sheet->setCellValue('G' . $rowCount, $element['waktu_transaksi']);
                $sheet->setCellValue('H' . $rowCount, $nama_tingkat);
                $sheet->setCellValue('I' . $rowCount, $kredit);
                $sheet->setCellValue('J' . $rowCount, $debit);
                $sheet->setCellValue('K' . $rowCount, $element['saldo']);

                $rowCount++;
            }

            $sheet->setCellValue('H' . $rowCount, 'TOTAL');
            $sheet->setCellValue('I' . $rowCount, ($total_kredit));
            $sheet->setCellValue('J' . $rowCount, ($total_debit));

            $sheet->getStyle('H' . $rowCount . ':J' . $rowCount)->getFont()->setBold(true);

            ob_start();
            if ($extension == 'csv') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
                $fileName = $fileName . '.csv';
            } elseif ($extension == 'xlsx') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $fileName = $fileName . '.xlsx';
            } else {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
                $fileName = $fileName . '.xls';
            }
            $writer->save('php://output');
            $xlsData = ob_get_contents();
            ob_end_clean();

            $output_ajax = array("status" => true,
                "token" => $token,
                'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData),
                'filename' => $fileName,
                "messages" => "Berhasil!, Ekspor Laporan Excel berhasil dicetak. Silahkan cek ulang.",
            );
        }
        die(json_encode($output_ajax));
    }
    public function export_data_csv_transaction_joint_recap_all()
    {
        $this->load->helper('download');

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $extension = 'csv';

        $fileName = 'Laporan_Transaksi_Tabungan_' . trim(strtoupper($data['nama_tabungan_bersama'])) . '_' . $data['date_range'];

        $token = $this->security->get_csrf_hash();
        //var_dump($data['data_check']);exit;

        if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

            $output_ajax = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
            );

        } else {

            if (!empty($extension)) {
                $extension = $extension;
            } elseif ($extension == 'xlsx') {
                $extension = 'xlsx';
            } else {
                $extension = 'xls';
            }

            $empInfo = $this->ReportModel->get_data_saving_excel_transaction_joint_recap_all($data['data_check']);
            //            var_dump($empInfo);
            //            exit;
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Judul: ');
            $sheet->setCellValue('B1', 'Rekap Tabungan Bersama ' . trim(strtoupper($data['nama_tabungan_bersama'])));
            $sheet->setCellValue('D1', 'Periode Tanggal: ');
            $sheet->setCellValue('E1', $data['date_range']);

            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('D1')->getFont()->setBold(true);

            $sheet->setCellValue('A2', 'No. Transaksi');
            $sheet->setCellValue('B2', 'No. Rekening');
            $sheet->setCellValue('C2', 'Nama Tabungan');
            $sheet->setCellValue('D2', 'Jenis Transaksi');
            $sheet->setCellValue('E2', 'Tanggal Tabungan');
            $sheet->setCellValue('F2', 'Tahun Ajaran');
            $sheet->setCellValue('G2', 'Waktu Transaksi');
            $sheet->setCellValue('H2', 'Tingkat');
            $sheet->setCellValue('I2', 'Kredit');
            $sheet->setCellValue('J2', 'Debit');
            $sheet->setCellValue('K2', 'Saldo');

            $rowCount = 3;
            $total_debit = 0;
            $total_kredit = 0;
            $total_saldo = 0;

            $jenis_transaksi = '';
            $nama_tingkat = '';
            $debit = 0;
            $kredit = 0;

            foreach ($empInfo as $element) {

                if ($element['status_kredit_debet'] == 1) {
                    $jenis_transaksi = 'KREDIT';
                    $debit = 0;
                    $kredit = $element['nominal'];
                    $total_kredit = $total_kredit + $element['nominal'];

                } else if ($element['status_kredit_debet'] == 2) {
                    $jenis_transaksi = 'DEBIT';
                    $debit = $element['nominal'];
                    $kredit = 0;
                    $total_debit = $total_debit + $element['nominal'];
                }

                if ($element['id_tingkat'] == 1) {
                    $nama_tingkat = 'KB';
                } else if ($element['id_tingkat'] == 2) {
                    $nama_tingkat = 'TK';
                } else if ($element['id_tingkat'] == 3) {
                    $nama_tingkat = 'SD';
                } else if ($element['id_tingkat'] == 4) {
                    $nama_tingkat = 'SMP';
                } else if ($element['id_tingkat'] == 6) {
                    $nama_tingkat = 'DC';
                }

                $total_saldo = $total_saldo + $element['saldo'];

                $sheet->setCellValue('A' . $rowCount, $element['nomor_transaksi_bersama']);
                $sheet->setCellValue('B' . $rowCount, $element['nomor_rekening_bersama']);
                $sheet->setCellValue('C' . $rowCount, strtoupper($element['nama_tabungan_bersama']));
                $sheet->setCellValue('D' . $rowCount, $jenis_transaksi);
                $sheet->setCellValue('E' . $rowCount, $element['tanggal_transaksi']);
                $sheet->setCellValue('F' . $rowCount, $element['tahun_ajaran']);
                $sheet->setCellValue('G' . $rowCount, $element['waktu_transaksi']);
                $sheet->setCellValue('H' . $rowCount, $nama_tingkat);
                $sheet->setCellValue('I' . $rowCount, $kredit);
                $sheet->setCellValue('J' . $rowCount, $debit);
                $sheet->setCellValue('K' . $rowCount, $element['saldo']);

                $rowCount++;
            }

            $sheet->setCellValue('H' . $rowCount, 'TOTAL');
            $sheet->setCellValue('I' . $rowCount, ($total_kredit));
            $sheet->setCellValue('J' . $rowCount, ($total_debit));

            $sheet->getStyle('H' . $rowCount . ':J' . $rowCount)->getFont()->setBold(true);

            ob_start();
            if ($extension == 'csv') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
                $fileName = $fileName . '.csv';
            } elseif ($extension == 'xlsx') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $fileName = $fileName . '.xlsx';
            } else {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
                $fileName = $fileName . '.xls';
            }
            $writer->save('php://output');
            $xlsData = ob_get_contents();
            ob_end_clean();

            $output_ajax = array("status" => true,
                "token" => $token,
                'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData),
                'filename' => trim($fileName),
                "messages" => "Berhasil!, Ekspor Laporan Excel berhasil dicetak. Silahkan cek ulang.",
            );
        }
        die(json_encode($output_ajax));
    }
    public function export_data_csv_transaction_recap_all()
    {
        $this->load->helper('download');

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $extension = 'csv';

        $fileName = 'Laporan_Tabungan_Siswa_' . trim(strtoupper($data['nama_siswa'])) . '_' . $data['date_range'];

        $token = $this->security->get_csrf_hash();
        //var_dump($data['data_check']);exit;

        if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

            $output_ajax = array("status" => false,
                "token" => $token,
                "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
            );

        } else {

            if (!empty($extension)) {
                $extension = $extension;
            } elseif ($extension == 'xlsx') {
                $extension = 'xlsx';
            } else {
                $extension = 'xls';
            }

            $split = explode(",", $data['data_check']);
            $data_check = "'" . implode("', '", $split) . "'";
            $empInfo = $this->ReportModel->get_data_saving_excel_transaction_recap_all($data_check);
            //            var_dump($empInfo);
            //            exit;
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Judul: ');
            $sheet->setCellValue('B1', 'Rekap Tabungan Siswa ' . trim(strtoupper($data['nama_siswa'])));
            $sheet->setCellValue('D1', 'Periode Tanggal: ');
            $sheet->setCellValue('E1', $data['date_range']);

            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('D1')->getFont()->setBold(true);

            $sheet->setCellValue('A2', 'Nomor Transaksi');
            $sheet->setCellValue('B2', 'NIS');
            $sheet->setCellValue('C2', 'Jenis Tabungan');
            $sheet->setCellValue('D2', 'Jenis Transaksi');
            $sheet->setCellValue('E2', 'Tanggal Tabungan');
            $sheet->setCellValue('F2', 'Tahun Ajaran');
            $sheet->setCellValue('G2', 'Waktu Transaksi');
            $sheet->setCellValue('H2', 'Tingkat');
            $sheet->setCellValue('I2', 'Kredit (Rp)');
            $sheet->setCellValue('J2', 'Debit (Rp)');
            $sheet->setCellValue('K2', 'Saldo (Rp)');

            $rowCount = 3;
            $total_debit = 0;
            $total_kredit = 0;
            $total_saldo = 0;

            $jenis_transaksi = '';
            $nama_tingkat = '';
            $nama_tabungan = '';
            $debit = 0;
            $kredit = 0;

            foreach ($empInfo as $element) {

                if ($element['status_kredit_debet'] == 1) {
                    $jenis_transaksi = 'KREDIT';
                    $debit = 0;
                    $kredit = $element['nominal'];
                    $total_kredit = $total_kredit + $element['nominal'];

                } else if ($element['status_kredit_debet'] == 2) {
                    $jenis_transaksi = 'DEBIT';
                    $debit = $element['nominal'];
                    $kredit = 0;
                    $total_debit = $total_debit + $element['nominal'];
                }

                if ($element['jenis_tabungan'] == 1) {
                    $nama_tabungan = 'UMUM';
                } else if ($element['jenis_tabungan'] == 2) {
                    $nama_tabungan = 'QURBAN';
                } else if ($element['jenis_tabungan'] == 3) {
                    $nama_tabungan = 'WISATA';
                }

                if ($element['id_tingkat'] == 1) {
                    $nama_tingkat = 'KB';
                } else if ($element['id_tingkat'] == 2) {
                    $nama_tingkat = 'TK';
                } else if ($element['id_tingkat'] == 3) {
                    $nama_tingkat = 'SD';
                } else if ($element['id_tingkat'] == 4) {
                    $nama_tingkat = 'SMP';
                } else if ($element['id_tingkat'] == 6) {
                    $nama_tingkat = 'DC';
                }

                $total_saldo = $total_saldo + $element['saldo'];

                $sheet->setCellValue('A' . $rowCount, $element['nomor_transaksi']);
                $sheet->setCellValue('B' . $rowCount, $element['nis_siswa']);
                $sheet->setCellValue('C' . $rowCount, $nama_tabungan);
                $sheet->setCellValue('D' . $rowCount, $jenis_transaksi);
                $sheet->setCellValue('E' . $rowCount, $element['tanggal_transaksi']);
                $sheet->setCellValue('F' . $rowCount, $element['tahun_ajaran']);
                $sheet->setCellValue('G' . $rowCount, $element['waktu_transaksi']);
                $sheet->setCellValue('H' . $rowCount, $nama_tingkat);
                $sheet->setCellValue('I' . $rowCount, $kredit);
                $sheet->setCellValue('J' . $rowCount, $debit);
                $sheet->setCellValue('K' . $rowCount, $element['saldo']);

                $rowCount++;
            }

            $sheet->setCellValue('H' . $rowCount, 'TOTAL');
            $sheet->setCellValue('I' . $rowCount, ($total_kredit));
            $sheet->setCellValue('J' . $rowCount, ($total_debit));

            $sheet->getStyle('H' . $rowCount . ':J' . $rowCount)->getFont()->setBold(true);

            ob_start();
            if ($extension == 'csv') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
                $fileName = $fileName . '.csv';
            } elseif ($extension == 'xlsx') {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $fileName = $fileName . '.xlsx';
            } else {
                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
                $fileName = $fileName . '.xls';
            }
            $writer->save('php://output');
            $xlsData = ob_get_contents();
            ob_end_clean();

            $output_ajax = array("status" => true,
                "token" => $token,
                'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData),
                'filename' => $fileName,
                "messages" => "Berhasil!, Ekspor Laporan Excel berhasil dicetak. Silahkan cek ulang.",
            );
        }
        die(json_encode($output_ajax));
    }
    public function print_data_pdf_transaction_joint_all()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            $fileName = 'Laporan_Tabungan_Bersama_' . $data['date_range'];

            if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
                );
            } else {

                $output = array("status" => true,
                    "token" => $token,
                    "messages" => "Berhasil!, Laporan berhasil dicetak, Silahkan cek ulang.",
                );

                $get['saving'] = $this->ReportModel->get_data_saving_pdf_joint_all($data['data_check']);
                $get['page'] = $this->ReportModel->get_page();
                $get['contact'] = $this->ReportModel->get_contact();
                $get['rentang_tanggal'] = $data['date_range'];
                $get['nama_tabungan'] = "";

                if ($get['saving'] == null or $get['saving'] == false) {
                    //add new data
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf, Data Anda tidak ditemukan. Silahkan cek ulang.",
                    );
                } else {
                    $html = $this->load->view('pdf_template/transaction_joint_saving', $get, true);
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
    public function print_data_pdf_transaction_general_all()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            $fileName = 'Laporan_Tabungan_Umum_Siswa_' . $data['date_range'];

            if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
                );
            } else {

                $output = array("status" => true,
                    "token" => $token,
                    "messages" => "Berhasil!, Laporan berhasil dicetak, Silahkan cek ulang.",
                );

                $get['saving'] = $this->ReportModel->get_data_saving_pdf_general_all($data['data_check']);
                $get['page'] = $this->ReportModel->get_page();
                $get['contact'] = $this->ReportModel->get_contact();
                $get['rentang_tanggal'] = $data['date_range'];
                $get['jenis_tabungan'] = "Umum";

                if ($get['saving'] == null or $get['saving'] == false) {
                    //add new data
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf, Data Anda tidak ditemukan. Silahkan cek ulang.",
                    );
                } else {
                    $html = $this->load->view('pdf_template/transaction_saving', $get, true);
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
    public function print_data_pdf_transaction_qurban_all()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            $fileName = 'Laporan_Tabungan_Qurban_Siswa_' . $data['date_range'];

            if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
                );
            } else {

                $output = array("status" => true,
                    "token" => $token,
                    "messages" => "Berhasil!, Laporan berhasil dicetak, Silahkan cek ulang.",
                );

                $get['saving'] = $this->ReportModel->get_data_saving_pdf_qurban_all($data['data_check']);
                $get['page'] = $this->ReportModel->get_page();
                $get['contact'] = $this->ReportModel->get_contact();
                $get['rentang_tanggal'] = $data['date_range'];
                $get['jenis_tabungan'] = "Qurban";

                if ($get['saving'] == null or $get['saving'] == false) {
                    //add new data
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf, Data Anda tidak ditemukan. Silahkan cek ulang.",
                    );
                } else {
                    $html = $this->load->view('pdf_template/transaction_saving', $get, true);
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
    public function print_data_pdf_transaction_tour_all()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            $fileName = 'Laporan_Tabungan_Wisata_Siswa_' . $data['date_range'];

            if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
                );
            } else {

                $output = array("status" => true,
                    "token" => $token,
                    "messages" => "Berhasil!, Laporan berhasil dicetak, Silahkan cek ulang.",
                );

                $get['saving'] = $this->ReportModel->get_data_saving_pdf_tour_all($data['data_check']);
                $get['page'] = $this->ReportModel->get_page();
                $get['contact'] = $this->ReportModel->get_contact();
                $get['rentang_tanggal'] = $data['date_range'];
                $get['jenis_tabungan'] = "Wisata";

                if ($get['saving'] == null or $get['saving'] == false) {
                    //add new data
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf, Data Anda tidak ditemukan. Silahkan cek ulang.",
                    );
                } else {
                    $html = $this->load->view('pdf_template/transaction_saving', $get, true);
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

    public function print_data_pdf_transaction_joint_recap_all()
    {
        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $token = $this->security->get_csrf_hash();

        if ($this->user_finance[0]->id_role_struktur == 7 || $this->user_finance[0]->id_role_struktur == 5) {

            $fileName = 'Laporan_Tabungan_Bersama_' . trim(strtoupper($data['nama_tabungan_bersama'])) . '_' . $data['date_range'];

            if ($data['data_check'] == '' or $data['data_check'] == null || empty($data['data_check'] || !$data['data_check'])) {

                $output = array("status" => false,
                    "token" => $token,
                    "messages" => "Mohon Maaf, Pilih/Centang data terlebih dahulu. Silahkan cek ulang.",
                );
            } else {

                $output = array("status" => true,
                    "token" => $token,
                    "messages" => "Berhasil!, Laporan berhasil dicetak, Silahkan cek ulang.",
                );

                $get['saving'] = $this->ReportModel->get_data_saving_pdf_joint_recap_all($data['data_check']);
                $get['page'] = $this->ReportModel->get_page();
                $get['contact'] = $this->ReportModel->get_contact();
                $get['rentang_tanggal'] = $data['date_range'];
                $get['nama_tabungan'] = trim(strtoupper($data['nama_tabungan_bersama']));

                if ($get['saving'] == null or $get['saving'] == false) {
                    //add new data
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf, Data Anda tidak ditemukan. Silahkan cek ulang.",
                    );
                } else {
                    $html = $this->load->view('pdf_template/transaction_joint_saving', $get, true);
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
    public function print_data_pdf_transaction_recap_all()
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

                $output = array("status" => true,
                    "token" => $token,
                    "messages" => "Berhasil!, Laporan berhasil dicetak, Silahkan cek ulang.",
                );

                $split = explode(",", $data['data_check']);
                $data_check = "'" . implode("', '", $split) . "'";

                $get['saving'] = $this->ReportModel->get_data_saving_pdf_recap_all($data_check);
                $get['page'] = $this->ReportModel->get_page();
                $get['contact'] = $this->ReportModel->get_contact();
                $get['rentang_tanggal'] = $data['date_range'];
                $get['jenis_tabungan'] = "Keseluruhan";
                $get['nama_siswa'] = $data['nama_siswa'];

                if ($get['saving'] == null or $get['saving'] == false) {
                    //add new data
                    $output = array("status" => false,
                        "token" => $token,
                        "messages" => "Mohon Maaf, Data Anda tidak ditemukan. Silahkan cek ulang.",
                    );
                } else {
                    $html = $this->load->view('pdf_template/transaction_saving_recap', $get, true);
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


}
