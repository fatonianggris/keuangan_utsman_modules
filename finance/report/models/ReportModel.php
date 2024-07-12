<?php

class ReportModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('secondary_db', true);

    }
    private $table_general_page = 'general_page';
    private $table_contact = 'kontak';

    //
    //------------------------------REPORT--------------------------------//

    public function get_page()
    {

        $this->db->select('*');
        $this->db->where('id_general_page', 1);
        $sql = $this->db->get($this->table_general_page);
        return $sql->result();
    }

    public function get_contact()
    {

        $this->db2->select('*');
        $this->db2->where('id_kontak', 1);
        $sql = $this->db2->get($this->table_contact);
        return $sql->result();
    }

    public function get_data_personal_saving_excel_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
									s.id_siswa,
									s.nis,
									s.level_tingkat,
									s.nama_lengkap,
									s.jenis_kelamin,
									s.nomor_handphone,
									s.email,
									s.jalur,
									(
									SELECT
										COALESCE(SUM(ttu.nominal),
										0)
									FROM
										transaksi_tabungan_umum ttu
									WHERE
										ttu.nis_siswa = s.nis AND ttu.status_kredit_debet = 1 AND(
											STR_TO_DATE(
												ttu.tanggal_transaksi,
												'%d/%m/%Y'
											) BETWEEN '$start_date' AND '$end_date'
										)
									) AS kredit_umum,
									(
										SELECT
											COALESCE(SUM(ttu.nominal),
											0)
										FROM
											transaksi_tabungan_umum ttu
										WHERE
											ttu.nis_siswa = s.nis AND ttu.status_kredit_debet = 2 AND(
												STR_TO_DATE(
													ttu.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_umum,
									(
										SELECT
											COALESCE(ttu.nominal, 0)
										FROM
											transaksi_tabungan_umum ttu
										WHERE
											ttu.nis_siswa = s.nis AND(
												STR_TO_DATE(
													ttu.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										ORDER BY
											ttu.id_transaksi_umum
										DESC LIMIT 1
									) AS saldo_umum,
									(
									SELECT
										COALESCE(SUM(ttq.nominal),
										0)
									FROM
										transaksi_tabungan_qurban ttq
									WHERE
										ttq.nis_siswa = s.nis AND ttq.status_kredit_debet = 1 AND(
											STR_TO_DATE(
												ttq.tanggal_transaksi,
												'%d/%m/%Y'
											) BETWEEN '$start_date' AND '$end_date'
										)
									) AS kredit_qurban,
									(
										SELECT
											COALESCE(SUM(ttq.nominal),
											0)
										FROM
											transaksi_tabungan_qurban ttq
										WHERE
											ttq.nis_siswa = s.nis AND ttq.status_kredit_debet = 2 AND(
												STR_TO_DATE(
													ttq.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_qurban,
									(
										SELECT
											COALESCE(ttq.nominal, 0)
										FROM
											transaksi_tabungan_qurban ttq
										WHERE
											ttq.nis_siswa = s.nis AND(
												STR_TO_DATE(
													ttq.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										ORDER BY
											ttq.id_transaksi_qurban
										DESC LIMIT 1
									) AS saldo_qurban,
									(
									SELECT
										COALESCE(SUM(ttw.nominal),
										0)
									FROM
										transaksi_tabungan_wisata ttw
									WHERE
										ttw.nis_siswa = s.nis AND ttw.status_kredit_debet = 1 AND(
											STR_TO_DATE(
												ttw.tanggal_transaksi,
												'%d/%m/%Y'
											) BETWEEN '$start_date' AND '$end_date'
										)
									) AS kredit_wisata,
									(
										SELECT
											COALESCE(SUM(ttw.nominal),0)
										FROM
											transaksi_tabungan_wisata ttw
										WHERE
											ttw.nis_siswa = s.nis AND ttw.status_kredit_debet = 2 AND(
												STR_TO_DATE(
													ttw.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_wisata,
									(
										SELECT
											COALESCE(ttw.nominal, 0)
										FROM
											transaksi_tabungan_wisata ttw
										WHERE
											ttw.nis_siswa = s.nis AND(
												STR_TO_DATE(
													ttw.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										ORDER BY
											ttw.id_transaksi_wisata
										DESC LIMIT 1
									) AS saldo_wisata,
									s.nama_wali,
									CONCAT(
									panel_utsman.ta.tahun_awal,
									'/',
									panel_utsman.ta.tahun_akhir
									) AS tahun_ajaran,
									s.th_ajaran
								FROM
									siswa s
								LEFT JOIN panel_utsman.tahun_ajaran ta
								ON
									panel_utsman.ta.id_tahun_ajaran = panel_utsman.s.th_ajaran
								WHERE panel_utsman.s.id_siswa IN ($id)
								ORDER BY
									s.id_siswa
								DESC");

        return $sql->result_array();
    }
	public function get_data_joint_saving_excel_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										tb.id_tabungan_bersama,
										tb.id_siswa_penanggung_jawab,
										tb.nomor_rekening_bersama,
										tb.nama_tabungan_bersama,
										tb.keterangan_tabungan_bersama,
										tb.id_tingkat,
										tb.id_th_ajaran,
										s.nama_wali,
										s.nis,
										s.nama_lengkap,
										s.nomor_handphone,
										s.email,
										(
										SELECT
											COALESCE(SUM(ttb.nominal),
											0)
										FROM
											transaksi_tabungan_bersama ttb
										WHERE
											ttb.nomor_rekening_bersama = tb.nomor_rekening_bersama AND ttb.status_kredit_debet = 1 AND(
												STR_TO_DATE(
													ttb.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS kredit_bersama,
									(
										SELECT
											COALESCE(SUM(ttb.nominal),
											0)
										FROM
											transaksi_tabungan_bersama ttb
										WHERE
											ttb.nomor_rekening_bersama = tb.nomor_rekening_bersama AND ttb.status_kredit_debet = 2 AND(
												STR_TO_DATE(
													ttb.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_bersama,
									(
										SELECT
											COALESCE(ttb.nominal, 0)
										FROM
											transaksi_tabungan_bersama ttb
										WHERE
											ttb.nomor_rekening_bersama = tb.nomor_rekening_bersama AND(
												STR_TO_DATE(
													ttb.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										ORDER BY
											ttb.id_transaksi_bersama
										DESC
									LIMIT 1
									) AS saldo_bersama, 
									CONCAT(
										panel_utsman.ta.tahun_awal,
										'/',
										panel_utsman.ta.tahun_akhir
									) AS tahun_ajaran
									FROM
										tabungan_bersama tb
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tb.id_siswa_penanggung_jawab
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tb.id_th_ajaran
									WHERE panel_utsman.tb.id_tabungan_bersama IN ($id)
									ORDER BY
										tb.id_tabungan_bersama
									DESC");
        return $sql->result_array();
    }
    public function get_data_personal_saving_pdf_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
									s.id_siswa,
									s.nis,
									s.level_tingkat,
									s.nama_lengkap,
									s.jenis_kelamin,
									s.nomor_handphone,
									s.email,
									s.jalur,
									(
									SELECT
										COALESCE(SUM(ttu.nominal),
										0)
									FROM
										transaksi_tabungan_umum ttu
									WHERE
										ttu.nis_siswa = s.nis AND ttu.status_kredit_debet = 1 AND(
											STR_TO_DATE(
												ttu.tanggal_transaksi,
												'%d/%m/%Y'
											) BETWEEN '$start_date' AND '$end_date'
										)
									) AS kredit_umum,
									(
										SELECT
											COALESCE(SUM(ttu.nominal),
											0)
										FROM
											transaksi_tabungan_umum ttu
										WHERE
											ttu.nis_siswa = s.nis AND ttu.status_kredit_debet = 2 AND(
												STR_TO_DATE(
													ttu.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_umum,
									(
										SELECT
											COALESCE(ttu.nominal, 0)
										FROM
											transaksi_tabungan_umum ttu
										WHERE
											ttu.nis_siswa = s.nis AND(
												STR_TO_DATE(
													ttu.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										ORDER BY
											ttu.id_transaksi_umum
										DESC LIMIT 1
									) AS saldo_umum,
									(
									SELECT
										COALESCE(SUM(ttq.nominal),
										0)
									FROM
										transaksi_tabungan_qurban ttq
									WHERE
										ttq.nis_siswa = s.nis AND ttq.status_kredit_debet = 1 AND(
											STR_TO_DATE(
												ttq.tanggal_transaksi,
												'%d/%m/%Y'
											) BETWEEN '$start_date' AND '$end_date'
										)
									) AS kredit_qurban,
									(
										SELECT
											COALESCE(SUM(ttq.nominal),
											0)
										FROM
											transaksi_tabungan_qurban ttq
										WHERE
											ttq.nis_siswa = s.nis AND ttq.status_kredit_debet = 2 AND(
												STR_TO_DATE(
													ttq.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_qurban,
									(
										SELECT
											COALESCE(ttq.nominal, 0)
										FROM
											transaksi_tabungan_qurban ttq
										WHERE
											ttq.nis_siswa = s.nis AND(
												STR_TO_DATE(
													ttq.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										ORDER BY
											ttq.id_transaksi_qurban
										DESC LIMIT 1
									) AS saldo_qurban,
									(
									SELECT
										COALESCE(SUM(ttw.nominal),
										0)
									FROM
										transaksi_tabungan_wisata ttw
									WHERE
										ttw.nis_siswa = s.nis AND ttw.status_kredit_debet = 1 AND(
											STR_TO_DATE(
												ttw.tanggal_transaksi,
												'%d/%m/%Y'
											) BETWEEN '$start_date' AND '$end_date'
										)
									) AS kredit_wisata,
									(
										SELECT
											COALESCE(SUM(ttw.nominal),0)
										FROM
											transaksi_tabungan_wisata ttw
										WHERE
											ttw.nis_siswa = s.nis AND ttw.status_kredit_debet = 2 AND(
												STR_TO_DATE(
													ttw.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_wisata,
									(
										SELECT
											COALESCE(ttw.nominal, 0)
										FROM
											transaksi_tabungan_wisata ttw
										WHERE
											ttw.nis_siswa = s.nis AND(
												STR_TO_DATE(
													ttw.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										ORDER BY
											ttw.id_transaksi_wisata
										DESC LIMIT 1
									) AS saldo_wisata,
									s.nama_wali,
									CONCAT(
									panel_utsman.ta.tahun_awal,
									'/',
									panel_utsman.ta.tahun_akhir
									) AS tahun_ajaran,
									s.th_ajaran
								FROM
									siswa s
								LEFT JOIN panel_utsman.tahun_ajaran ta
								ON
									panel_utsman.ta.id_tahun_ajaran = panel_utsman.s.th_ajaran
								WHERE panel_utsman.s.id_siswa IN ($id)
								ORDER BY
									s.id_siswa
								DESC");

        return $sql->result();
    }
	public function get_data_joint_saving_pdf_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										tb.id_tabungan_bersama,
										tb.id_siswa_penanggung_jawab,
										tb.nomor_rekening_bersama,
										tb.nama_tabungan_bersama,
										tb.keterangan_tabungan_bersama,
										tb.id_tingkat,
										tb.id_th_ajaran,
										s.nama_wali,
										s.nis,
										s.nama_lengkap,
										s.nomor_handphone,
										s.email,
										(
										SELECT
											COALESCE(SUM(ttb.nominal),
											0)
										FROM
											transaksi_tabungan_bersama ttb
										WHERE
											ttb.nomor_rekening_bersama = tb.nomor_rekening_bersama AND ttb.status_kredit_debet = 1 AND(
												STR_TO_DATE(
													ttb.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS kredit_bersama,
									(
										SELECT
											COALESCE(SUM(ttb.nominal),
											0)
										FROM
											transaksi_tabungan_bersama ttb
										WHERE
											ttb.nomor_rekening_bersama = tb.nomor_rekening_bersama AND ttb.status_kredit_debet = 2 AND(
												STR_TO_DATE(
													ttb.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_bersama,
									(
										SELECT
											COALESCE(ttb.nominal, 0)
										FROM
											transaksi_tabungan_bersama ttb
										WHERE
											ttb.nomor_rekening_bersama = tb.nomor_rekening_bersama AND(
												STR_TO_DATE(
													ttb.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										ORDER BY
											ttb.id_transaksi_bersama
										DESC
									LIMIT 1
									) AS saldo_bersama,
									CONCAT(
										panel_utsman.ta.tahun_awal,
										'/',
										panel_utsman.ta.tahun_akhir
									) AS tahun_ajaran
									FROM
										tabungan_bersama tb
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tb.id_siswa_penanggung_jawab
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tb.id_th_ajaran
									WHERE panel_utsman.tb.id_tabungan_bersama IN ($id)
									ORDER BY
										tb.id_tabungan_bersama
									DESC");
        return $sql->result();
    }

	public function get_data_saving_excel_transaction_joint_all($id = '')
    {
        $sql = $this->db->query("SELECT
									panel_utsman.tt.nomor_transaksi_bersama,
									panel_utsman.tt.nomor_rekening_bersama,
									panel_utsman.tb.nama_tabungan_bersama,
									panel_utsman.s.nama_lengkap,
									panel_utsman.s.nama_wali,
									keuangan_utsman.ak.nama_akun,
									keuangan_utsman.ak.email_akun,
									panel_utsman.tt.saldo,
									panel_utsman.tt.id_tingkat,
									panel_utsman.tt.catatan,
									panel_utsman.tt.nominal,
									panel_utsman.tt.status_kredit_debet,
									CONCAT(
										panel_utsman.ta.tahun_awal,
										'/',
										panel_utsman.ta.tahun_akhir
									) AS tahun_ajaran,
									panel_utsman.tt.th_ajaran,
									panel_utsman.tt.tanggal_transaksi,
									DATE_FORMAT(panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
									CASE WHEN EXISTS(
									SELECT
										panel_utsman.vmax.id_max
									FROM
										panel_utsman.view_max_id_transaction_general vmax
									WHERE
										panel_utsman.tt.id_transaksi_bersama = panel_utsman.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									panel_utsman.transaksi_tabungan_bersama tt
								LEFT JOIN panel_utsman.tabungan_bersama tb
								ON
									panel_utsman.tb.nomor_rekening_bersama = panel_utsman.tt.nomor_rekening_bersama
								LEFT JOIN panel_utsman.siswa s
								ON
									panel_utsman.s.id_siswa = panel_utsman.tb.id_siswa_penanggung_jawab
								LEFT JOIN panel_utsman.tahun_ajaran ta
								ON
									panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
								LEFT JOIN keuangan_utsman.akun_keuangan ak
								ON
									keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
								WHERE panel_utsman.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									panel_utsman.tt.id_transaksi_bersama
								DESC");

        return $sql->result_array();
    }
    public function get_data_saving_excel_transaction_general_all($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_umum,
								panel_utsman.tt.nomor_transaksi_umum,
								panel_utsman.tt.nis_siswa,
								panel_utsman.tt.id_tingkat,
								panel_utsman.s.nama_lengkap,
								keuangan_utsman.ak.nama_akun,
								keuangan_utsman.ak.email_akun,
								panel_utsman.tt.saldo,
								panel_utsman.tt.catatan,
								panel_utsman.tt.nominal,
								panel_utsman.tt.status_kredit_debet,
								CONCAT(
									panel_utsman.ta.tahun_awal,
									'/',
									panel_utsman.ta.tahun_akhir
								) AS tahun_ajaran,
								panel_utsman.tt.th_ajaran,
								panel_utsman.tt.tanggal_transaksi,
								DATE_FORMAT(panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
								CASE WHEN EXISTS(
								SELECT
									panel_utsman.vmax.id_max
								FROM
									panel_utsman.view_max_id_transaction_general vmax
								WHERE
									panel_utsman.tt.id_transaksi_umum = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_umum tt
							LEFT JOIN panel_utsman.siswa s
							ON
								panel_utsman.s.nis = panel_utsman.tt.nis_siswa
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_umum IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_umum
							DESC");

        return $sql->result_array();
    }
    public function get_data_saving_excel_transaction_qurban_all($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_qurban,
								panel_utsman.tt.nomor_transaksi_qurban,
								panel_utsman.tt.nis_siswa,
								panel_utsman.tt.id_tingkat,
								panel_utsman.s.nama_lengkap,
								keuangan_utsman.ak.nama_akun,
								keuangan_utsman.ak.email_akun,
								panel_utsman.tt.saldo,
								panel_utsman.tt.catatan,
								panel_utsman.tt.nominal,
								panel_utsman.tt.status_kredit_debet,
								CONCAT(
									panel_utsman.ta.tahun_awal,
									'/',
									panel_utsman.ta.tahun_akhir
								) AS tahun_ajaran,
								panel_utsman.tt.th_ajaran,
								panel_utsman.tt.tanggal_transaksi,
								DATE_FORMAT(panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
								CASE WHEN EXISTS(
								SELECT
									panel_utsman.vmax.id_max
								FROM
									panel_utsman.view_max_id_transaction_qurban vmax
								WHERE
									panel_utsman.tt.id_transaksi_qurban = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_qurban tt
							LEFT JOIN panel_utsman.siswa s
							ON
								panel_utsman.s.nis = panel_utsman.tt.nis_siswa
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_qurban IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_qurban
							DESC");

        return $sql->result_array();
    }
    public function get_data_saving_excel_transaction_tour_all($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_wisata,
								panel_utsman.tt.nomor_transaksi_wisata,
								panel_utsman.tt.nis_siswa,
								panel_utsman.tt.id_tingkat,
								panel_utsman.s.nama_lengkap,
								keuangan_utsman.ak.nama_akun,
								keuangan_utsman.ak.email_akun,
								panel_utsman.tt.saldo,
								panel_utsman.tt.catatan,
								panel_utsman.tt.nominal,
								panel_utsman.tt.status_kredit_debet,
								CONCAT(
									panel_utsman.ta.tahun_awal,
									'/',
									panel_utsman.ta.tahun_akhir
								) AS tahun_ajaran,
								panel_utsman.tt.th_ajaran,
								panel_utsman.tt.tanggal_transaksi,
								DATE_FORMAT(panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
								CASE WHEN EXISTS(
								SELECT
									panel_utsman.vmax.id_max
								FROM
									panel_utsman.view_max_id_transaction_tour vmax
								WHERE
									panel_utsman.tt.id_transaksi_wisata = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_wisata tt
							LEFT JOIN panel_utsman.siswa s
							ON
								panel_utsman.s.nis = panel_utsman.tt.nis_siswa
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_wisata IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_wisata
							DESC");

        return $sql->result_array();
    }


	public function get_data_saving_excel_transaction_joint_recap_all($id = '')
    {
        $sql = $this->db->query("SELECT
									panel_utsman.tt.nomor_transaksi_bersama,
									panel_utsman.tt.nomor_rekening_bersama,
									panel_utsman.tb.nama_tabungan_bersama,
									panel_utsman.s.nama_lengkap,
									panel_utsman.s.nama_wali,
									keuangan_utsman.ak.nama_akun,
									keuangan_utsman.ak.email_akun,
									panel_utsman.tt.saldo,
									panel_utsman.tt.id_tingkat,
									panel_utsman.tt.catatan,
									panel_utsman.tt.nominal,
									panel_utsman.tt.status_kredit_debet,
									CONCAT(
										panel_utsman.ta.tahun_awal,
										'/',
										panel_utsman.ta.tahun_akhir
									) AS tahun_ajaran,
									panel_utsman.tt.th_ajaran,
									panel_utsman.tt.tanggal_transaksi,
									DATE_FORMAT(panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
									CASE WHEN EXISTS(
									SELECT
										panel_utsman.vmax.id_max
									FROM
										panel_utsman.view_max_id_transaction_general vmax
									WHERE
										panel_utsman.tt.id_transaksi_bersama = panel_utsman.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									panel_utsman.transaksi_tabungan_bersama tt
								LEFT JOIN panel_utsman.tabungan_bersama tb
								ON
									panel_utsman.tb.nomor_rekening_bersama = panel_utsman.tt.nomor_rekening_bersama
								LEFT JOIN panel_utsman.siswa s
								ON
									panel_utsman.s.id_siswa = panel_utsman.tb.id_siswa_penanggung_jawab
								LEFT JOIN panel_utsman.tahun_ajaran ta
								ON
									panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
								LEFT JOIN keuangan_utsman.akun_keuangan ak
								ON
									keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
								WHERE panel_utsman.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									panel_utsman.tt.id_transaksi_bersama
								DESC");

        return $sql->result_array();
    }
	public function get_data_saving_excel_transaction_recap_all($id = '')
    {
        $sql = $this->db->query("SELECT
										id_transaksi,
										nomor_transaksi,
										nis_siswa,
										id_tingkat,
										nama_lengkap,
										nama_akun,
										email_akun,
										saldo,
										jenis_tabungan,
										catatan,
										nominal,
										status_kredit_debet,
										tahun_ajaran,
										th_ajaran,
										tanggal_transaksi,
										waktu_transaksi,
										status_edit
									FROM
										(
										SELECT
											panel_utsman.tt.id_transaksi_umum AS id_transaksi,
											panel_utsman.tt.nomor_transaksi_umum AS nomor_transaksi,
											panel_utsman.tt.nis_siswa,
											panel_utsman.tt.id_tingkat,
											panel_utsman.s.nama_lengkap,
											keuangan_utsman.ak.nama_akun,
											keuangan_utsman.ak.email_akun,
											panel_utsman.tt.saldo,
											panel_utsman.tt.jenis_tabungan,
											panel_utsman.tt.catatan,
											panel_utsman.tt.nominal,
											panel_utsman.tt.status_kredit_debet,
											CONCAT(
												panel_utsman.ta.tahun_awal,
												'/',
												panel_utsman.ta.tahun_akhir
											) AS tahun_ajaran,
											panel_utsman.tt.th_ajaran,
											panel_utsman.tt.tanggal_transaksi,
											DATE_FORMAT(
												panel_utsman.tt.waktu_transaksi,
												'%d/%m/%Y %H:%i:%s'
											) AS waktu_transaksi,
											CASE WHEN EXISTS(
											SELECT
												panel_utsman.vmax.id_max
											FROM
												panel_utsman.view_max_id_transaction_general vmax
											WHERE
												panel_utsman.tt.id_transaksi_umum = panel_utsman.vmax.id_max
										) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_umum tt
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tt.nis_siswa
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_umum IN ($id)
									UNION ALL
									SELECT
										panel_utsman.tt.id_transaksi_qurban AS id_transaksi,
										panel_utsman.tt.nomor_transaksi_qurban AS nomor_transaksi,
										panel_utsman.tt.nis_siswa,
										panel_utsman.tt.id_tingkat,
										panel_utsman.s.nama_lengkap,
										keuangan_utsman.ak.nama_akun,
										keuangan_utsman.ak.email_akun,
										panel_utsman.tt.saldo,
										panel_utsman.tt.jenis_tabungan,
										panel_utsman.tt.catatan,
										panel_utsman.tt.nominal,
										panel_utsman.tt.status_kredit_debet,
										CONCAT(
											panel_utsman.ta.tahun_awal,
											'/',
											panel_utsman.ta.tahun_akhir
										) AS tahun_ajaran,
										panel_utsman.tt.th_ajaran,
										panel_utsman.tt.tanggal_transaksi,
										DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											panel_utsman.vmax.id_max
										FROM
											panel_utsman.view_max_id_transaction_qurban vmax
										WHERE
											panel_utsman.tt.id_transaksi_qurban = panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_qurban tt
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tt.nis_siswa
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_qurban IN ($id)
									UNION ALL
									SELECT
										panel_utsman.tt.id_transaksi_wisata AS id_transaksi,
										panel_utsman.tt.nomor_transaksi_wisata AS nomor_transaksi,
										panel_utsman.tt.nis_siswa,
										panel_utsman.tt.id_tingkat,
										panel_utsman.s.nama_lengkap,
										keuangan_utsman.ak.nama_akun,
										keuangan_utsman.ak.email_akun,
										panel_utsman.tt.saldo,
										panel_utsman.tt.jenis_tabungan,
										panel_utsman.tt.catatan,
										panel_utsman.tt.nominal,
										panel_utsman.tt.status_kredit_debet,
										CONCAT(
											panel_utsman.ta.tahun_awal,
											'/',
											panel_utsman.ta.tahun_akhir
										) AS tahun_ajaran,
										panel_utsman.tt.th_ajaran,
										panel_utsman.tt.tanggal_transaksi,
										DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											panel_utsman.vmax.id_max
										FROM
											panel_utsman.view_max_id_transaction_tour vmax
										WHERE
											panel_utsman.tt.id_transaksi_wisata = panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_wisata tt
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tt.nis_siswa
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_wisata IN ($id)
									ORDER BY
										id_transaksi DESC
									) RECAP
									ORDER BY
										jenis_tabungan DESC");
        return $sql->result_array();
    }

	

	public function get_data_saving_pdf_joint_all($id = '')
    {
        $sql = $this->db->query("SELECT
									panel_utsman.tt.nomor_transaksi_bersama,
									panel_utsman.tt.nomor_rekening_bersama,
									panel_utsman.tb.nama_tabungan_bersama,
									panel_utsman.s.nama_lengkap,
									panel_utsman.s.nama_wali,
									keuangan_utsman.ak.nama_akun,
									keuangan_utsman.ak.email_akun,
									panel_utsman.tt.saldo,
									panel_utsman.tt.id_tingkat,
									panel_utsman.tt.catatan,
									panel_utsman.tt.nominal,
									panel_utsman.tt.status_kredit_debet,
									CONCAT(
										panel_utsman.ta.tahun_awal,
										'/',
										panel_utsman.ta.tahun_akhir
									) AS tahun_ajaran,
									panel_utsman.tt.th_ajaran,
									panel_utsman.tt.tanggal_transaksi,
									DATE_FORMAT(panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
									CASE WHEN EXISTS(
									SELECT
										panel_utsman.vmax.id_max
									FROM
										panel_utsman.view_max_id_transaction_general vmax
									WHERE
										panel_utsman.tt.id_transaksi_bersama = panel_utsman.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									panel_utsman.transaksi_tabungan_bersama tt
								LEFT JOIN panel_utsman.tabungan_bersama tb
								ON
									panel_utsman.tb.nomor_rekening_bersama = panel_utsman.tt.nomor_rekening_bersama
								LEFT JOIN panel_utsman.siswa s
								ON
									panel_utsman.s.id_siswa = panel_utsman.tb.id_siswa_penanggung_jawab
								LEFT JOIN panel_utsman.tahun_ajaran ta
								ON
									panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
								LEFT JOIN keuangan_utsman.akun_keuangan ak
								ON
									keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
								WHERE panel_utsman.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									panel_utsman.tt.id_transaksi_bersama
								DESC");

        return $sql->result();
    }
    public function get_data_saving_pdf_general_all($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_umum,
								panel_utsman.tt.nomor_transaksi_umum AS nomor_transaksi,
								panel_utsman.tt.nis_siswa,
								panel_utsman.tt.id_tingkat,
								panel_utsman.s.nama_lengkap,
								keuangan_utsman.ak.nama_akun,
								keuangan_utsman.ak.email_akun,
								panel_utsman.tt.saldo,
								panel_utsman.tt.catatan,
								panel_utsman.tt.nominal,
								panel_utsman.tt.status_kredit_debet,
								CONCAT(
									panel_utsman.ta.tahun_awal,
									'/',
									panel_utsman.ta.tahun_akhir
								) AS tahun_ajaran,
								panel_utsman.tt.th_ajaran,
								panel_utsman.tt.tanggal_transaksi,
								DATE_FORMAT(panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
								CASE WHEN EXISTS(
								SELECT
									panel_utsman.vmax.id_max
								FROM
									panel_utsman.view_max_id_transaction_general vmax
								WHERE
									panel_utsman.tt.id_transaksi_umum = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_umum tt
							LEFT JOIN panel_utsman.siswa s
							ON
								panel_utsman.s.nis = panel_utsman.tt.nis_siswa
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_umum IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_umum
							DESC");

        return $sql->result();
    }
    public function get_data_saving_pdf_qurban_all($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_qurban,
								panel_utsman.tt.nomor_transaksi_qurban AS nomor_transaksi,
								panel_utsman.tt.id_tingkat,
								panel_utsman.tt.nis_siswa,
								panel_utsman.tt.id_tingkat,
								panel_utsman.s.nama_lengkap,
								keuangan_utsman.ak.nama_akun,
								keuangan_utsman.ak.email_akun,
								panel_utsman.tt.saldo,
								panel_utsman.tt.catatan,
								panel_utsman.tt.nominal,
								panel_utsman.tt.status_kredit_debet,
								CONCAT(
									panel_utsman.ta.tahun_awal,
									'/',
									panel_utsman.ta.tahun_akhir
								) AS tahun_ajaran,
								panel_utsman.tt.th_ajaran,
								panel_utsman.tt.tanggal_transaksi,
								DATE_FORMAT(panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
								CASE WHEN EXISTS(
								SELECT
									panel_utsman.vmax.id_max
								FROM
									panel_utsman.view_max_id_transaction_qurban vmax
								WHERE
									panel_utsman.tt.id_transaksi_qurban = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_qurban tt
							LEFT JOIN panel_utsman.siswa s
							ON
								panel_utsman.s.nis = panel_utsman.tt.nis_siswa
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_qurban IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_qurban
							DESC");

        return $sql->result();
    }
    public function get_data_saving_pdf_tour_all($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_wisata,
								panel_utsman.tt.nomor_transaksi_wisata AS nomor_transaksi,
								panel_utsman.tt.id_tingkat,
								panel_utsman.tt.nis_siswa,
								panel_utsman.s.nama_lengkap,
								keuangan_utsman.ak.nama_akun,
								keuangan_utsman.ak.email_akun,
								panel_utsman.tt.saldo,
								panel_utsman.tt.catatan,
								panel_utsman.tt.nominal,
								panel_utsman.tt.status_kredit_debet,
								CONCAT(
									panel_utsman.ta.tahun_awal,
									'/',
									panel_utsman.ta.tahun_akhir
								) AS tahun_ajaran,
								panel_utsman.tt.th_ajaran,
								panel_utsman.tt.tanggal_transaksi,
								DATE_FORMAT(panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
								CASE WHEN EXISTS(
								SELECT
									panel_utsman.vmax.id_max
								FROM
									panel_utsman.view_max_id_transaction_tour vmax
								WHERE
									panel_utsman.tt.id_transaksi_wisata = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_wisata tt
							LEFT JOIN panel_utsman.siswa s
							ON
								panel_utsman.s.nis = panel_utsman.tt.nis_siswa
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_wisata IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_wisata
							DESC");

        return $sql->result();
    }


	public function get_data_saving_pdf_joint_recap_all($id = '')
    {
        $sql = $this->db->query("SELECT
									panel_utsman.tt.nomor_transaksi_bersama,
									panel_utsman.tt.nomor_rekening_bersama,
									panel_utsman.tb.nama_tabungan_bersama,
									panel_utsman.s.nama_lengkap,
									panel_utsman.s.nama_wali,
									keuangan_utsman.ak.nama_akun,
									keuangan_utsman.ak.email_akun,
									panel_utsman.tt.saldo,
									panel_utsman.tt.id_tingkat,
									panel_utsman.tt.catatan,
									panel_utsman.tt.nominal,
									panel_utsman.tt.status_kredit_debet,
									CONCAT(
										panel_utsman.ta.tahun_awal,
										'/',
										panel_utsman.ta.tahun_akhir
									) AS tahun_ajaran,
									panel_utsman.tt.th_ajaran,
									panel_utsman.tt.tanggal_transaksi,
									DATE_FORMAT(panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
									CASE WHEN EXISTS(
									SELECT
										panel_utsman.vmax.id_max
									FROM
										panel_utsman.view_max_id_transaction_general vmax
									WHERE
										panel_utsman.tt.id_transaksi_bersama = panel_utsman.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									panel_utsman.transaksi_tabungan_bersama tt
								LEFT JOIN panel_utsman.tabungan_bersama tb
								ON
									panel_utsman.tb.nomor_rekening_bersama = panel_utsman.tt.nomor_rekening_bersama
								LEFT JOIN panel_utsman.siswa s
								ON
									panel_utsman.s.id_siswa = panel_utsman.tb.id_siswa_penanggung_jawab
								LEFT JOIN panel_utsman.tahun_ajaran ta
								ON
									panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
								LEFT JOIN keuangan_utsman.akun_keuangan ak
								ON
									keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
								WHERE panel_utsman.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									panel_utsman.tt.id_transaksi_bersama
								DESC");

        return $sql->result();
    }
	public function get_data_saving_pdf_recap_all($id = '')
    {
        $sql = $this->db->query("SELECT
										id_transaksi,
										nomor_transaksi,
										nis_siswa,
										id_tingkat,
										nama_lengkap,
										nama_akun,
										email_akun,
										saldo,
										jenis_tabungan,
										catatan,
										nominal,
										status_kredit_debet,
										tahun_ajaran,
										th_ajaran,
										tanggal_transaksi,
										waktu_transaksi,
										status_edit
									FROM
										(
										SELECT
											panel_utsman.tt.id_transaksi_umum AS id_transaksi,
											panel_utsman.tt.nomor_transaksi_umum AS nomor_transaksi,
											panel_utsman.tt.nis_siswa,
											panel_utsman.tt.id_tingkat,
											panel_utsman.s.nama_lengkap,
											keuangan_utsman.ak.nama_akun,
											keuangan_utsman.ak.email_akun,
											panel_utsman.tt.saldo,
											panel_utsman.tt.jenis_tabungan,
											panel_utsman.tt.catatan,
											panel_utsman.tt.nominal,
											panel_utsman.tt.status_kredit_debet,
											CONCAT(
												panel_utsman.ta.tahun_awal,
												'/',
												panel_utsman.ta.tahun_akhir
											) AS tahun_ajaran,
											panel_utsman.tt.th_ajaran,
											panel_utsman.tt.tanggal_transaksi,
											DATE_FORMAT(
												panel_utsman.tt.waktu_transaksi,
												'%d/%m/%Y %H:%i:%s'
											) AS waktu_transaksi,
											CASE WHEN EXISTS(
											SELECT
												panel_utsman.vmax.id_max
											FROM
												panel_utsman.view_max_id_transaction_general vmax
											WHERE
												panel_utsman.tt.id_transaksi_umum = panel_utsman.vmax.id_max
										) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_umum tt
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tt.nis_siswa
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_umum IN ($id)
									UNION ALL
									SELECT
										panel_utsman.tt.id_transaksi_qurban AS id_transaksi,
										panel_utsman.tt.nomor_transaksi_qurban AS nomor_transaksi,
										panel_utsman.tt.nis_siswa,
										panel_utsman.tt.id_tingkat,
										panel_utsman.s.nama_lengkap,
										keuangan_utsman.ak.nama_akun,
										keuangan_utsman.ak.email_akun,
										panel_utsman.tt.saldo,
										panel_utsman.tt.jenis_tabungan,
										panel_utsman.tt.catatan,
										panel_utsman.tt.nominal,
										panel_utsman.tt.status_kredit_debet,
										CONCAT(
											panel_utsman.ta.tahun_awal,
											'/',
											panel_utsman.ta.tahun_akhir
										) AS tahun_ajaran,
										panel_utsman.tt.th_ajaran,
										panel_utsman.tt.tanggal_transaksi,
										DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											panel_utsman.vmax.id_max
										FROM
											panel_utsman.view_max_id_transaction_qurban vmax
										WHERE
											panel_utsman.tt.id_transaksi_qurban = panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_qurban tt
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tt.nis_siswa
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_qurban IN ($id)
									UNION ALL
									SELECT
										panel_utsman.tt.id_transaksi_wisata AS id_transaksi,
										panel_utsman.tt.nomor_transaksi_wisata AS nomor_transaksi,
										panel_utsman.tt.nis_siswa,
										panel_utsman.tt.id_tingkat,
										panel_utsman.s.nama_lengkap,
										keuangan_utsman.ak.nama_akun,
										keuangan_utsman.ak.email_akun,
										panel_utsman.tt.saldo,
										panel_utsman.tt.jenis_tabungan,
										panel_utsman.tt.catatan,
										panel_utsman.tt.nominal,
										panel_utsman.tt.status_kredit_debet,
										CONCAT(
											panel_utsman.ta.tahun_awal,
											'/',
											panel_utsman.ta.tahun_akhir
										) AS tahun_ajaran,
										panel_utsman.tt.th_ajaran,
										panel_utsman.tt.tanggal_transaksi,
										DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											panel_utsman.vmax.id_max
										FROM
											panel_utsman.view_max_id_transaction_tour vmax
										WHERE
											panel_utsman.tt.id_transaksi_wisata = panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_wisata tt
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tt.nis_siswa
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_wisata  IN ($id)
									ORDER BY
										id_transaksi DESC
									) RECAP
									ORDER BY
										jenis_tabungan DESC");
        return $sql->result();
    }

    //
}
