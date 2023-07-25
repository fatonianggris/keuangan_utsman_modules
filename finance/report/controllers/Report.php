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
        $this->load->model('ReportModel');
        $this->load->library('form_validation');
    }

    //---------------------------EKSPORT DATA MAHASISWA---------------------------------//

    public function export_data_csv_all()
    {
        $this->load->helper('download');

        $param = $this->input->post();
        $data = $this->security->xss_clean($param);

        $extension = 'csv';

        $fileName = 'Laporan_Tabungan_Siswa_' . $data['date_range'];

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

            $empInfo = $this->ReportModel->get_data_saving_export_all($data['data_check']);
            //            var_dump($empInfo);
            //            exit;
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Judul: ');
            $sheet->setCellValue('B1', 'Rekap Tabungan Siswa Utsman');
            $sheet->setCellValue('D1', 'Periode Tanggal: ');
            $sheet->setCellValue('E1', $data['date_range']);

            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->getStyle('D1')->getFont()->setBold(true);

            $sheet->setCellValue('A2', 'NIS');
            $sheet->setCellValue('B2', 'Nama Siswa');
            $sheet->setCellValue('C2', 'Jenis Transaksi');
            $sheet->setCellValue('D2', 'Tanggal Tabungan');
            $sheet->setCellValue('E2', 'Tahun Ajaran');
            $sheet->setCellValue('F2', 'Waktu Transaksi');
            $sheet->setCellValue('G2', 'Kredit (Rp)');
            $sheet->setCellValue('H2', 'Debit (Rp)');
            $sheet->setCellValue('I2', 'Saldo (Rp)');
            $sheet->setCellValue('J2', 'Catatan');

            $rowCount = 3;
            $total_debit = 0;
            $total_kredit = 0;
            $total_saldo = 0;

            $jenis_transaksi = '';
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

                $total_saldo = $total_saldo + $element['saldo'];

                $sheet->setCellValue('A' . $rowCount, $element['nis_siswa']);
                $sheet->setCellValue('B' . $rowCount, strtoupper($element['nama_lengkap']));
                $sheet->setCellValue('C' . $rowCount, $jenis_transaksi);
                $sheet->setCellValue('D' . $rowCount, $element['tanggal_transaksi']);
                $sheet->setCellValue('E' . $rowCount, $element['tahun_ajaran']);
                $sheet->setCellValue('F' . $rowCount, $element['waktu_transaksi']);
                $sheet->setCellValue('G' . $rowCount, $kredit);
                $sheet->setCellValue('H' . $rowCount, $debit);
                $sheet->setCellValue('I' . $rowCount, $element['saldo']);
                $sheet->setCellValue('J' . $rowCount, ucwords(strtolower($element['catatan'])));

                $rowCount++;
            }

            $sheet->setCellValue('F' . $rowCount, 'TOTAL');
            $sheet->setCellValue('G' . $rowCount, ($total_kredit));
            $sheet->setCellValue('H' . $rowCount, ($total_debit));
            $sheet->setCellValue('I' . $rowCount, ($total_saldo));

            $sheet->getStyle('F' . $rowCount . ':I' . $rowCount)->getFont()->setBold(true);

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

    //-----------------------------------------------------------------------//
    //
}
