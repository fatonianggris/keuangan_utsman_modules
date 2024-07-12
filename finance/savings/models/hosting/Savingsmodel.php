<?php

class SavingsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('secondary_db', true);
    }
    private $table_structure = 'struktur_akun_keuangan';
    private $table_general_page = 'general_page';
    private $table_outcome = 'pengeluaran';
    private $table_savings_transaction_general = 'transaksi_tabungan_umum';
    private $table_savings_transaction_qurban = 'transaksi_tabungan_qurban';
    private $table_savings_transaction_tour = 'transaksi_tabungan_wisata';
    private $table_joint_saving_transaction = 'transaksi_tabungan_bersama';
    private $table_student = 'siswa';
    private $table_joint_saving = 'tabungan_bersama';
    private $table_contact = 'kontak';
    private $table_vstudent = 'view_siswa';
    private $table_account = 'akun_keuangan';
    private $table_import_personal_saving = 'import_nasabah_personal';
    private $table_import_joint_saving = 'import_nasabah_joint';

    //
    //------------------------------COUNT--------------------------------//
    //

    public function get_number_personal_saving($number = '')
    {

        $this->db2->select('nis');
        $this->db2->where('nis', $number);

        $sql = $this->db2->get($this->table_student);

        return $sql->result();
    }

    public function get_number_import_personal_saving($number = '')
    {

        $this->db2->select('nis');
        $this->db2->where('nis', $number);

        $sql = $this->db2->get($this->table_import_personal_saving);

        return $sql->result();
    }

    public function get_import_personal_saving($id = '', $status = '')
    {
        $sql = $this->db2->query("SELECT
										*
									FROM
										import_nasabah_personal
									WHERE
										id_nasabah IN ($id) AND status_nasabah = $status");
        return $sql->result_array();
    }

    public function get_number_joint_saving($number = '')
    {

        $this->db2->select('nomor_rekening_bersama');
        $this->db2->where('nomor_rekening_bersama', $number);

        $sql = $this->db2->get($this->table_joint_saving);

        return $sql->result();
    }

    public function get_new_transaction()
    {
        $sql = $this->db->query("SELECT
										u8514965_panel_utsman.tt.id_transaksi_umum,
										u8514965_panel_utsman.tt.nis_siswa,
										u8514965_panel_utsman.s.nama_lengkap,
										u8514965_panel_utsman.s.jenis_kelamin,
										u8514965_keuangan_utsman.ak.nama_akun,
										u8514965_keuangan_utsman.ak.email_akun,
										u8514965_panel_utsman.tt.saldo,
										u8514965_panel_utsman.tt.catatan,
										u8514965_panel_utsman.tt.nominal,
										u8514965_panel_utsman.tt.status_kredit_debet,
										CONCAT(
											u8514965_panel_utsman.ta.tahun_awal,
											'/',
											u8514965_panel_utsman.ta.tahun_akhir
										) AS tahun_ajaran,
										u8514965_panel_utsman.tt.th_ajaran,
										u8514965_panel_utsman.tt.tanggal_transaksi,
										DATE_FORMAT(u8514965_panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											u8514965_panel_utsman.vmax.id_max
										FROM
											u8514965_panel_utsman.view_max_id_transaction_general vmax
										WHERE
											u8514965_panel_utsman.tt.id_transaksi_umum = u8514965_panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_umum tt
									LEFT JOIN u8514965_panel_utsman.siswa s
									ON
										u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tt.nis_siswa
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
									ORDER BY
										u8514965_panel_utsman.tt.id_transaksi_umum
									DESC LIMIT 5");
        return $sql->result();
    }

    public function get_transaction_credit_insight()
    {
        $sql = $this->db->query("SELECT
										th.*,
										(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.tt.nominal),0)
										FROM
											(
											SELECT
												u8514965_panel_utsman.tb.id_transaksi_umum,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 1 AND u8514965_panel_utsman.tdpb.informasi LIKE('%TK%') OR u8514965_panel_utsman.tdpb.informasi LIKE('%KB%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										u8514965_panel_utsman.tt.th_ajaran = u8514965_panel_utsman.th.id_tahun_ajaran
									) AS total_kredit_kbtk,
									(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.tt.nominal), 0)
										FROM
											(
											SELECT
												u8514965_panel_utsman.tb.id_transaksi_umum,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 1 AND u8514965_panel_utsman.tdpb.informasi LIKE('%SD%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										u8514965_panel_utsman.tt.th_ajaran = u8514965_panel_utsman.th.id_tahun_ajaran
									) AS total_kredit_sd,
									(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.tt.nominal), 0)
										FROM
											(
											SELECT
												u8514965_panel_utsman.tb.id_transaksi_umum,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 1 AND u8514965_panel_utsman.tdpb.informasi LIKE('%SMP%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										u8514965_panel_utsman.tt.th_ajaran = u8514965_panel_utsman.th.id_tahun_ajaran
									) AS total_kredit_smp,
									CONCAT(
										'TA. ',
										u8514965_panel_utsman.th.tahun_awal,
										'/',
										u8514965_panel_utsman.th.tahun_akhir
									) AS tahun
									FROM
										u8514965_panel_utsman.tahun_ajaran th
									WHERE
										(u8514965_panel_utsman.th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND u8514965_panel_utsman.th.semester = 'ganjil'
									ORDER BY
										u8514965_panel_utsman.th.tahun_awal ASC");
        return $sql->result();
    }

    public function get_transaction_debet_insight()
    {
        $sql = $this->db->query("SELECT
										th.*,
										(
										SELECT
											COALESCE(SUM(tt.nominal),0)
										FROM
											(
											SELECT
												u8514965_panel_utsman.tb.id_transaksi_umum,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 2 AND u8514965_panel_utsman.tdpb.informasi LIKE('%TK%') OR u8514965_panel_utsman.tdpb.informasi LIKE('%KB%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										u8514965_panel_utsman.tt.th_ajaran = u8514965_panel_utsman.th.id_tahun_ajaran
									) AS total_debet_kbtk,
									(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.tt.nominal), 0)
										FROM
											(
											SELECT
												u8514965_panel_utsman.tb.id_transaksi_umum,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 2 AND u8514965_panel_utsman.tdpb.informasi LIKE('%SD%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										u8514965_panel_utsman.tt.th_ajaran = u8514965_panel_utsman.th.id_tahun_ajaran
									) AS total_debet_sd,
									(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.tt.nominal), 0)
										FROM
											(
											SELECT
												u8514965_panel_utsman.tb.id_transaksi_umum,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 2 AND u8514965_panel_utsman.tdpb.informasi LIKE('%SMP%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										u8514965_panel_utsman.tt.th_ajaran = u8514965_panel_utsman.th.id_tahun_ajaran
									) AS total_debet_smp,
									CONCAT(
										'TA. ',
										u8514965_panel_utsman.th.tahun_awal,
										'/',
										u8514965_panel_utsman.th.tahun_akhir
									) AS tahun
									FROM
										u8514965_panel_utsman.tahun_ajaran th
									WHERE
										(u8514965_panel_utsman.th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND u8514965_panel_utsman.th.semester = 'ganjil'
									ORDER BY
										u8514965_panel_utsman.th.tahun_awal ASC");
        return $sql->result();
    }

    public function get_credit_debet_insight()
    {
        $sql = $this->db->query("SELECT
									th.*,
									(
									SELECT
										COALESCE(SUM(u8514965_panel_utsman.tt.nominal),0)
									FROM
										(
										SELECT
											u8514965_panel_utsman.tb.id_transaksi_umum,
											u8514965_panel_utsman.tb.nominal,
											u8514965_panel_utsman.tb.nis_siswa,
											u8514965_panel_utsman.tb.th_ajaran,
											u8514965_panel_utsman.tdpb.informasi
										FROM
											u8514965_panel_utsman.transaksi_tabungan_umum tb
										LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
											u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
										WHERE
											u8514965_panel_utsman.tb.status_kredit_debet = 1
										GROUP BY
											u8514965_panel_utsman.tb.id_transaksi_umum
									) tt
								WHERE
									u8514965_panel_utsman.tt.th_ajaran = u8514965_panel_utsman.th.id_tahun_ajaran
								) AS total_kredit,
								(
									SELECT
										COALESCE(SUM(tt.nominal), 0)
									FROM
										(
										SELECT
											u8514965_panel_utsman.tb.id_transaksi_umum,
											u8514965_panel_utsman.tb.nominal,
											u8514965_panel_utsman.tb.nis_siswa,
											u8514965_panel_utsman.tb.th_ajaran,
											u8514965_panel_utsman.tdpb.informasi
										FROM
											u8514965_panel_utsman.transaksi_tabungan_umum tb
										LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
											u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
										WHERE
											u8514965_panel_utsman.tb.status_kredit_debet = 2
										GROUP BY
											u8514965_panel_utsman.tb.id_transaksi_umum
									) tt
								WHERE
									u8514965_panel_utsman.tt.th_ajaran = u8514965_panel_utsman.th.id_tahun_ajaran
								) AS total_debet,
								CONCAT(
									'TA. ',
									u8514965_panel_utsman.th.tahun_awal,
									'/',
									u8514965_panel_utsman.th.tahun_akhir
								) AS tahun
								FROM
									u8514965_panel_utsman.tahun_ajaran th
								WHERE
									(u8514965_panel_utsman.th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND u8514965_panel_utsman.th.semester = 'ganjil'
								ORDER BY
									u8514965_panel_utsman.th.tahun_awal ASC");
        return $sql->result();
    }

    //
    //------------------------------GET Savings--------------------------------//
    //

    public function get_page()
    {

        $this->db->select('*');
        $this->db->where('id_general_page', 1);
        $sql = $this->db->get($this->table_general_page);
        return $sql->result();
    }

    public function check_pin_admin($id_keuangan = '')
    {
        $this->db->select('pin_akun');
        $this->db->where('id_akun_keuangan', $id_keuangan);
        $sql = $this->db->get($this->table_account);
        return $sql->result();
    }

    public function check_pass_admin($id_keuangan = '')
    {
        $this->db->where('id_akun_keuangan', $id_keuangan);
        $sql = $this->db->get($this->table_account);
        return $sql->result();
    }

    public function get_contact()
    {

        $this->db2->select('*');
        $this->db2->where('id_kontak', 1);
        $sql = $this->db2->get($this->table_contact);
        return $sql->result();
    }

    public function get_structure_account()
    {

        $this->db->select('*');
        $this->db->where_not_in('id_role_struktur', array(1, 2, 3, 7, 8));
        $sql = $this->db->get($this->table_structure);

        return $sql->result();
    }

    public function get_schoolyear()
    {

        $sql = $this->db->query("SELECT * FROM tahun_ajaran WHERE semester='ganjil'");

        return $sql->result();
    }

    public function get_schoolyear_sias()
    {
        $this->db2->select('*');
        $this->db2->where('semester', 'ganjil');
        $this->db2->order_by('tahun_awal', 'DESC');
        $sql = $this->db2->get($this->table_schoolyear);
        return $sql->result();
    }

    public function check_name_division($id = '')
    {
        $this->db->where('id_struktur', $id);

        $sql = $this->db->get($this->table_structure);
        return $sql->result();
    }

    public function get_student()
    {
        $this->db2->select('nama_lengkap, nis');
        $sql = $this->db2->get($this->table_vstudent);
        return $sql->result();
    }

    public function get_joint_saving()
    {
        $this->db2->select('id_tabungan_bersama, nomor_rekening_bersama, nama_tabungan_bersama');
        $sql = $this->db2->get($this->table_joint_saving);
        return $sql->result();
    }

    public function get_student_nis($nis_student = '')
    {
        $this->db2->select('s.nis');
        $this->db2->from('view_siswa s');
        $this->db2->where('s.nis', $nis_student);
        $this->db2->limit(1);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_student_by_nis($nis_student = '')
    {
        $this->db2->select('s.nis, s.level_tingkat as id_tingkat, s.nama_lengkap, s.saldo_tabungan_umum,  s.saldo_tabungan_qurban,  s.saldo_tabungan_wisata, s.nama_wali, s.email, s.nomor_handphone, tpd.informasi');
        $this->db2->from('view_siswa s');
        $this->db2->join('tagihan_pembayaran_dpb tpd', 's.nis = tpd.nomor_siswa', 'left');
        $this->db2->where('s.nis', $nis_student);
        $this->db2->order_by('tpd.id_tagihan_pembayaran_dpb', 'DESC');
        $this->db2->limit(1);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_joint_saving_by_acc_number($acc_number = '')
    {
        $this->db2->select('tb.nomor_rekening_bersama, tb.nama_tabungan_bersama, tb.saldo_tabungan_bersama, tb.id_tingkat, s.nis, s.nama_wali, s.email, s.nomor_handphone, s.nama_lengkap');
        $this->db2->from('tabungan_bersama tb');
        $this->db2->join('siswa s', 'tb.id_siswa_penanggung_jawab = s.nis', 'left');
        $this->db2->where('tb.nomor_rekening_bersama', $acc_number);
        $this->db2->limit(1);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_info_student_transaction($nis_student = '')
    {
        $this->db2->select("nis_siswa, catatan, nominal, saldo, th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_umum');
        $this->db2->where('nis_siswa', $nis_student);
        $this->db2->order_by('id_transaksi_umum', 'DESC');
        $this->db2->limit(1);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_info_joint_saving_transaction($number = '')
    {
        $this->db2->select("nomor_rekening_bersama, catatan, nominal, saldo, th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_bersama');
        $this->db2->where('nomor_rekening_bersama', $number);
        $this->db2->order_by('id_transaksi_bersama', 'DESC');
        $this->db2->limit(1);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_info_student_transaction_qurban($nis_student = '')
    {
        $this->db2->select("nis_siswa, catatan, nominal, saldo, th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_qurban');
        $this->db2->where('nis_siswa', $nis_student);
        $this->db2->order_by('id_transaksi_qurban', 'DESC');
        $this->db2->limit(1);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_info_student_transaction_tour($nis_student = '')
    {
        $this->db2->select("nis_siswa, catatan, nominal, saldo, th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_wisata');
        $this->db2->where('nis_siswa', $nis_student);
        $this->db2->order_by('id_transaksi_wisata', 'DESC');
        $this->db2->limit(1);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_student_transaction_recap_by_nis($nis = '', $start_date = '', $end_date = '')
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
											u8514965_panel_utsman.tt.id_transaksi_umum AS id_transaksi,
											u8514965_panel_utsman.tt.nomor_transaksi_umum AS nomor_transaksi,
											u8514965_panel_utsman.tt.nis_siswa,
											u8514965_panel_utsman.tt.id_tingkat,
											u8514965_panel_utsman.s.nama_lengkap,
											u8514965_keuangan_utsman.ak.nama_akun,
											u8514965_keuangan_utsman.ak.email_akun,
											u8514965_panel_utsman.tt.saldo,
											u8514965_panel_utsman.tt.jenis_tabungan,
											u8514965_panel_utsman.tt.catatan,
											u8514965_panel_utsman.tt.nominal,
											u8514965_panel_utsman.tt.status_kredit_debet,
											CONCAT(
												u8514965_panel_utsman.ta.tahun_awal,
												'/',
												u8514965_panel_utsman.ta.tahun_akhir
											) AS tahun_ajaran,
											u8514965_panel_utsman.tt.th_ajaran,
											u8514965_panel_utsman.tt.tanggal_transaksi,
											DATE_FORMAT(
												u8514965_panel_utsman.tt.waktu_transaksi,
												'%d/%m/%Y %H:%i:%s'
											) AS waktu_transaksi,
											CASE WHEN EXISTS(
											SELECT
												u8514965_panel_utsman.vmax.id_max
											FROM
												u8514965_panel_utsman.view_max_id_transaction_general vmax
											WHERE
												u8514965_panel_utsman.tt.id_transaksi_umum = u8514965_panel_utsman.vmax.id_max
										) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_umum tt
									LEFT JOIN u8514965_panel_utsman.siswa s
									ON
										u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tt.nis_siswa
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
										WHERE u8514965_panel_utsman.tt.nis_siswa = $nis AND
										(
											STR_TO_DATE(
												u8514965_panel_utsman.tt.tanggal_transaksi,
												'%d/%m/%Y'
											) BETWEEN '$start_date' AND '$end_date'
										)
									UNION ALL
									SELECT
										u8514965_panel_utsman.tt.id_transaksi_qurban AS id_transaksi,
										u8514965_panel_utsman.tt.nomor_transaksi_qurban AS nomor_transaksi,
										u8514965_panel_utsman.tt.nis_siswa,
										u8514965_panel_utsman.tt.id_tingkat,
										u8514965_panel_utsman.s.nama_lengkap,
										u8514965_keuangan_utsman.ak.nama_akun,
										u8514965_keuangan_utsman.ak.email_akun,
										u8514965_panel_utsman.tt.saldo,
										u8514965_panel_utsman.tt.jenis_tabungan,
										u8514965_panel_utsman.tt.catatan,
										u8514965_panel_utsman.tt.nominal,
										u8514965_panel_utsman.tt.status_kredit_debet,
										CONCAT(
											u8514965_panel_utsman.ta.tahun_awal,
											'/',
											u8514965_panel_utsman.ta.tahun_akhir
										) AS tahun_ajaran,
										u8514965_panel_utsman.tt.th_ajaran,
										u8514965_panel_utsman.tt.tanggal_transaksi,
										DATE_FORMAT(
											u8514965_panel_utsman.tt.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											u8514965_panel_utsman.vmax.id_max
										FROM
											u8514965_panel_utsman.view_max_id_transaction_qurban vmax
										WHERE
											u8514965_panel_utsman.tt.id_transaksi_qurban = u8514965_panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_qurban tt
									LEFT JOIN u8514965_panel_utsman.siswa s
									ON
										u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tt.nis_siswa
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
										WHERE u8514965_panel_utsman.tt.nis_siswa = $nis AND
										(
											STR_TO_DATE(
												u8514965_panel_utsman.tt.tanggal_transaksi,
												'%d/%m/%Y'
											) BETWEEN '$start_date' AND '$end_date'
										)
									UNION ALL
									SELECT
										u8514965_panel_utsman.tt.id_transaksi_wisata AS id_transaksi,
										u8514965_panel_utsman.tt.nomor_transaksi_wisata AS nomor_transaksi,
										u8514965_panel_utsman.tt.nis_siswa,
										u8514965_panel_utsman.tt.id_tingkat,
										u8514965_panel_utsman.s.nama_lengkap,
										u8514965_keuangan_utsman.ak.nama_akun,
										u8514965_keuangan_utsman.ak.email_akun,
										u8514965_panel_utsman.tt.saldo,
										u8514965_panel_utsman.tt.jenis_tabungan,
										u8514965_panel_utsman.tt.catatan,
										u8514965_panel_utsman.tt.nominal,
										u8514965_panel_utsman.tt.status_kredit_debet,
										CONCAT(
											u8514965_panel_utsman.ta.tahun_awal,
											'/',
											u8514965_panel_utsman.ta.tahun_akhir
										) AS tahun_ajaran,
										u8514965_panel_utsman.tt.th_ajaran,
										u8514965_panel_utsman.tt.tanggal_transaksi,
										DATE_FORMAT(
											u8514965_panel_utsman.tt.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											u8514965_panel_utsman.vmax.id_max
										FROM
											u8514965_panel_utsman.view_max_id_transaction_tour vmax
										WHERE
											u8514965_panel_utsman.tt.id_transaksi_wisata = u8514965_panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_wisata tt
									LEFT JOIN u8514965_panel_utsman.siswa s
									ON
										u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tt.nis_siswa
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
										WHERE u8514965_panel_utsman.tt.nis_siswa = $nis AND
										(
											STR_TO_DATE(
												u8514965_panel_utsman.tt.tanggal_transaksi,
												'%d/%m/%Y'
											) BETWEEN '$start_date' AND '$end_date'
										)
									ORDER BY
										id_transaksi DESC
									) RECAP
									ORDER BY
										jenis_tabungan DESC");
        return $sql->result();
    }

    public function get_joint_transaction_recap_by_acc_number($norek = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
										u8514965_panel_utsman.ttb.id_transaksi_bersama,
										u8514965_panel_utsman.ttb.id_tingkat,
										u8514965_panel_utsman.ttb.nomor_rekening_bersama,
										u8514965_panel_utsman.ttb.nomor_transaksi_bersama,
										u8514965_panel_utsman.tb.nama_tabungan_bersama,
										u8514965_panel_utsman.s.nama_lengkap,
										u8514965_panel_utsman.s.nama_wali,
										u8514965_keuangan_utsman.ak.nama_akun,
										u8514965_keuangan_utsman.ak.email_akun,
										u8514965_panel_utsman.ttb.saldo,
										u8514965_panel_utsman.ttb.catatan,
										u8514965_panel_utsman.ttb.nominal,
										u8514965_panel_utsman.ttb.status_kredit_debet,
										CONCAT(
											u8514965_panel_utsman.ta.tahun_awal,
											'/',
											u8514965_panel_utsman.ta.tahun_akhir
										) AS tahun_ajaran,
										u8514965_panel_utsman.ttb.th_ajaran,
										u8514965_panel_utsman.ttb.tanggal_transaksi,
										DATE_FORMAT(
											u8514965_panel_utsman.ttb.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											u8514965_panel_utsman.vmax.id_max
										FROM
											u8514965_panel_utsman.view_max_id_transaction_joint vmax
										WHERE
											u8514965_panel_utsman.ttb.id_transaksi_bersama = u8514965_panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_bersama ttb
									LEFT JOIN u8514965_panel_utsman.tabungan_bersama tb
									ON
										u8514965_panel_utsman.tb.nomor_rekening_bersama = u8514965_panel_utsman.ttb.nomor_rekening_bersama
									LEFT JOIN u8514965_panel_utsman.siswa s
									ON
										u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tb.id_siswa_penanggung_jawab
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.ttb.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.ttb.id_pegawai
									WHERE
									u8514965_panel_utsman.tb.nomor_rekening_bersama = $norek AND
										(
											STR_TO_DATE(
												u8514965_panel_utsman.ttb.tanggal_transaksi,
												'%d/%m/%Y'
											) BETWEEN '$start_date' AND '$end_date'
										)
									ORDER BY
										u8514965_panel_utsman.ttb.id_transaksi_bersama
									DESC
										");
        return $sql->result();
    }
    public function get_all_import_personal_customer()
    {
        $sql = $this->db2->query("SELECT
										u8514965_panel_utsman.n.id_nasabah,
										u8514965_panel_utsman.n.nis,
										u8514965_panel_utsman.n.nama_nasabah,
										u8514965_panel_utsman.n.tanggal_transaksi,
										u8514965_panel_utsman.n.tingkat,
										u8514965_panel_utsman.n.nama_wali,
										u8514965_panel_utsman.n.nomor_hp_wali,
										u8514965_panel_utsman.n.email_nasabah,
										u8514965_panel_utsman.n.saldo_umum,
										u8514965_panel_utsman.n.saldo_qurban,
										u8514965_panel_utsman.n.saldo_wisata,
										u8514965_panel_utsman.n.status_nasabah,
										u8514965_panel_utsman.n.tahun_ajaran,
										CONCAT(
                                        u8514965_panel_utsman.ta.tahun_awal,
                                        '/',
                                        u8514965_panel_utsman.ta.tahun_akhir
                                    	) AS nama_tahun_ajaran
									FROM
										u8514965_panel_utsman.import_nasabah_personal n
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
                                	ON
                                    	u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.n.tahun_ajaran
									ORDER BY
										u8514965_panel_utsman.n.id_nasabah
									DESC");
        return $sql->result();
    }

    public function get_all_personal_customer($start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										u8514965_panel_utsman.s.id_siswa,
										u8514965_panel_utsman.s.nis,
										u8514965_panel_utsman.s.level_tingkat,
										u8514965_panel_utsman.s.nama_lengkap,
										u8514965_panel_utsman.s.jenis_kelamin,
										u8514965_panel_utsman.s.nomor_handphone,
										u8514965_panel_utsman.s.email,
										u8514965_panel_utsman.s.jalur,
										u8514965_panel_utsman.s.th_ajaran,
										(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.ttu.nominal),
											0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_umum ttu
										WHERE
											u8514965_panel_utsman.ttu.nis_siswa = u8514965_panel_utsman.s.nis AND u8514965_panel_utsman.ttu.status_kredit_debet = 1 AND(
												STR_TO_DATE(
													u8514965_panel_utsman.ttu.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										) AS kredit_umum,
										(
											SELECT
												COALESCE(SUM(u8514965_panel_utsman.ttu.nominal),
												0)
											FROM
												u8514965_panel_utsman.transaksi_tabungan_umum ttu
											WHERE
												u8514965_panel_utsman.ttu.nis_siswa = u8514965_panel_utsman.s.nis AND u8514965_panel_utsman.ttu.status_kredit_debet = 2 AND(
													STR_TO_DATE(
														u8514965_panel_utsman.ttu.tanggal_transaksi,
														'%d/%m/%Y'
													) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_umum,
										(
											SELECT
												COALESCE(ttu.nominal, 0)
											FROM u8514965_panel_utsman.transaksi_tabungan_umum ttu
											WHERE
												u8514965_panel_utsman.ttu.nis_siswa = u8514965_panel_utsman.s.nis AND(
													STR_TO_DATE(
														u8514965_panel_utsman.ttu.tanggal_transaksi,
														'%d/%m/%Y'
													) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												u8514965_panel_utsman.ttu.id_transaksi_umum
											DESC LIMIT 1
										) AS saldo_umum,
										(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.ttq.nominal),
											0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_qurban ttq
										WHERE
											u8514965_panel_utsman.ttq.nis_siswa = u8514965_panel_utsman.s.nis AND ttq.status_kredit_debet = 1 AND(
												STR_TO_DATE(
													u8514965_panel_utsman.ttq.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										) AS kredit_qurban,
										(
											SELECT
												COALESCE(SUM(u8514965_panel_utsman.ttq.nominal),
												0)
											FROM
												u8514965_panel_utsman.transaksi_tabungan_qurban ttq
											WHERE
												u8514965_panel_utsman.ttq.nis_siswa = s.nis AND u8514965_panel_utsman.ttq.status_kredit_debet = 2 AND(
													STR_TO_DATE(
														u8514965_panel_utsman.ttq.tanggal_transaksi,
														'%d/%m/%Y'
													) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_qurban,
										(
											SELECT
												COALESCE(u8514965_panel_utsman.ttq.nominal, 0)
											FROM
												u8514965_panel_utsman.transaksi_tabungan_qurban ttq
											WHERE
												u8514965_panel_utsman.ttq.nis_siswa = u8514965_panel_utsman.s.nis AND(
													STR_TO_DATE(
														u8514965_panel_utsman.ttq.tanggal_transaksi,
														'%d/%m/%Y'
													) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												u8514965_panel_utsman.ttq.id_transaksi_qurban
											DESC LIMIT 1
										) AS saldo_qurban,
										(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.ttw.nominal),
											0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_wisata ttw
										WHERE
											u8514965_panel_utsman.ttw.nis_siswa = u8514965_panel_utsman.s.nis AND u8514965_panel_utsman.ttw.status_kredit_debet = 1 AND(
												STR_TO_DATE(
													ttw.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										) AS kredit_wisata,
										(
											SELECT
												COALESCE(SUM(u8514965_panel_utsman.ttw.nominal),
												0)
											FROM
												u8514965_panel_utsman.transaksi_tabungan_wisata ttw
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
												COALESCE(u8514965_panel_utsman.ttw.nominal, 0)
											FROM
												u8514965_panel_utsman.transaksi_tabungan_wisata ttw
											WHERE
												u8514965_panel_utsman.ttw.nis_siswa = u8514965_panel_utsman.s.nis AND(
													STR_TO_DATE(
														u8514965_panel_utsman.ttw.tanggal_transaksi,
														'%d/%m/%Y'
													) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												u8514965_panel_utsman.ttw.id_transaksi_wisata
											DESC LIMIT 1
										) AS saldo_wisata,
										u8514965_panel_utsman.s.nama_wali,
										CONCAT(
                                        u8514965_panel_utsman.ta.tahun_awal,
                                        '/',
                                        u8514965_panel_utsman.ta.tahun_akhir
                                    	) AS tahun_ajaran
									FROM
										siswa s
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
                                	ON
                                    	u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.s.th_ajaran
									ORDER BY
										u8514965_panel_utsman.s.id_siswa
									DESC");
        return $sql->result();
    }
    public function get_all_joint_customer($start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										u8514965_panel_utsman.tb.id_tabungan_bersama,
										u8514965_panel_utsman.tb.id_siswa_penanggung_jawab,
										u8514965_panel_utsman.tb.nomor_rekening_bersama,
										u8514965_panel_utsman.tb.nama_tabungan_bersama,
										u8514965_panel_utsman.tb.keterangan_tabungan_bersama,
										u8514965_panel_utsman.tb.id_tingkat,
										u8514965_panel_utsman.tb.id_th_ajaran,
										u8514965_panel_utsman.s.nama_wali,
										u8514965_panel_utsman.s.nis,
										u8514965_panel_utsman.s.nama_lengkap,
										u8514965_panel_utsman.s.nomor_handphone,
										u8514965_panel_utsman.s.email,
										(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.ttb.nominal),
											0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_bersama ttb
										WHERE
											u8514965_panel_utsman.ttb.nomor_rekening_bersama = u8514965_panel_utsman.tb.nomor_rekening_bersama AND u8514965_panel_utsman.ttb.status_kredit_debet = 1 AND(
												STR_TO_DATE(
													u8514965_panel_utsman.ttb.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS kredit_bersama,
									(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.ttb.nominal),
											0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_bersama ttb
										WHERE
											u8514965_panel_utsman.ttb.nomor_rekening_bersama = u8514965_panel_utsman.tb.nomor_rekening_bersama AND u8514965_panel_utsman.ttb.status_kredit_debet = 2 AND(
												STR_TO_DATE(
													u8514965_panel_utsman.ttb.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_bersama,
									(
										SELECT
											COALESCE(ttb.nominal, 0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_bersama ttb
										WHERE
											u8514965_panel_utsman.ttb.nomor_rekening_bersama = u8514965_panel_utsman.tb.nomor_rekening_bersama AND(
												STR_TO_DATE(
													u8514965_panel_utsman.ttb.tanggal_transaksi,
													'%d/%m/%Y'
												) BETWEEN '$start_date' AND '$end_date'
											)
										ORDER BY
											u8514965_panel_utsman.ttb.id_transaksi_bersama
										DESC
									LIMIT 1
									) AS saldo_bersama,
									CONCAT(
										u8514965_panel_utsman.ta.tahun_awal,
										'/',
										u8514965_panel_utsman.ta.tahun_akhir
									) AS tahun_ajaran
									FROM
										tabungan_bersama tb
									LEFT JOIN u8514965_panel_utsman.siswa s
									ON
										u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tb.id_siswa_penanggung_jawab
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tb.id_th_ajaran
									ORDER BY
										u8514965_panel_utsman.tb.id_tabungan_bersama
									DESC");
        return $sql->result();
    }
    public function get_all_general_transaction_savings($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
                                    u8514965_panel_utsman.tt.id_transaksi_umum,
									u8514965_panel_utsman.tt.nomor_transaksi_umum,
                                    u8514965_panel_utsman.tt.nis_siswa,
									u8514965_panel_utsman.tt.id_tingkat,
                                    u8514965_panel_utsman.s.nama_lengkap,
                                    u8514965_keuangan_utsman.ak.nama_akun,
                                    u8514965_keuangan_utsman.ak.email_akun,
                                    u8514965_panel_utsman.tt.saldo,
									u8514965_panel_utsman.tt.jenis_tabungan,
                                    u8514965_panel_utsman.tt.catatan,
                                    u8514965_panel_utsman.tt.nominal,
                                    u8514965_panel_utsman.tt.status_kredit_debet,
                                    CONCAT(
                                        u8514965_panel_utsman.ta.tahun_awal,
                                        '/',
                                        u8514965_panel_utsman.ta.tahun_akhir
                                    ) AS tahun_ajaran,
									u8514965_panel_utsman.tt.th_ajaran,
                                    u8514965_panel_utsman.tt.tanggal_transaksi,
                                    DATE_FORMAT(u8514965_panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
                                    CASE WHEN EXISTS(
                                    SELECT
                                        u8514965_panel_utsman.vmax.id_max
                                    FROM
                                        u8514965_panel_utsman.view_max_id_transaction_general vmax
                                    WHERE
                                        u8514965_panel_utsman.tt.id_transaksi_umum = u8514965_panel_utsman.vmax.id_max
                                ) THEN 1 ELSE 0
                                END AS status_edit
                                FROM
                                    u8514965_panel_utsman.transaksi_tabungan_umum tt
                                LEFT JOIN u8514965_panel_utsman.siswa s
                                ON
                                    u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tt.nis_siswa
                                LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
                                ON
                                    u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
                                LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
                                ON
                                    u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
									WHERE
									(
										STR_TO_DATE(
											u8514965_panel_utsman.tt.tanggal_transaksi,
											'%d/%m/%Y'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    u8514965_panel_utsman.tt.id_transaksi_umum
                                DESC");
        return $sql->result();
    }
    public function get_all_qurban_transaction_savings($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
                                    u8514965_panel_utsman.tt.id_transaksi_qurban,
									u8514965_panel_utsman.tt.nomor_transaksi_qurban,
                                    u8514965_panel_utsman.tt.nis_siswa,
									u8514965_panel_utsman.tt.id_tingkat,
                                    u8514965_panel_utsman.s.nama_lengkap,
                                    u8514965_keuangan_utsman.ak.nama_akun,
                                    u8514965_keuangan_utsman.ak.email_akun,
                                    u8514965_panel_utsman.tt.saldo,
									u8514965_panel_utsman.tt.jenis_tabungan,
                                    u8514965_panel_utsman.tt.catatan,
                                    u8514965_panel_utsman.tt.nominal,
                                    u8514965_panel_utsman.tt.status_kredit_debet,
                                    CONCAT(
                                        u8514965_panel_utsman.ta.tahun_awal,
                                        '/',
                                        u8514965_panel_utsman.ta.tahun_akhir
                                    ) AS tahun_ajaran,
									u8514965_panel_utsman.tt.th_ajaran,
                                    u8514965_panel_utsman.tt.tanggal_transaksi,
                                    DATE_FORMAT(u8514965_panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
                                    CASE WHEN EXISTS(
                                    SELECT
                                        u8514965_panel_utsman.vmax.id_max
                                    FROM
                                        u8514965_panel_utsman.view_max_id_transaction_qurban vmax
                                    WHERE
                                        u8514965_panel_utsman.tt.id_transaksi_qurban = u8514965_panel_utsman.vmax.id_max
                                ) THEN 1 ELSE 0
                                END AS status_edit
                                FROM
                                    u8514965_panel_utsman.transaksi_tabungan_qurban tt
                                LEFT JOIN u8514965_panel_utsman.siswa s
                                ON
                                    u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tt.nis_siswa
                                LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
                                ON
                                    u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
                                LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
                                ON
                                    u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
									WHERE
									(
										STR_TO_DATE(
											u8514965_panel_utsman.tt.tanggal_transaksi,
											'%d/%m/%Y'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    u8514965_panel_utsman.tt.id_transaksi_qurban
                                DESC");
        return $sql->result();
    }
    public function get_all_tour_transaction_savings($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
                                    u8514965_panel_utsman.tt.id_transaksi_wisata,
									u8514965_panel_utsman.tt.nomor_transaksi_wisata,
                                    u8514965_panel_utsman.tt.nis_siswa,
									u8514965_panel_utsman.tt.id_tingkat,
                                    u8514965_panel_utsman.s.nama_lengkap,
                                    u8514965_keuangan_utsman.ak.nama_akun,
                                    u8514965_keuangan_utsman.ak.email_akun,
                                    u8514965_panel_utsman.tt.saldo,
									u8514965_panel_utsman.tt.jenis_tabungan,
                                    u8514965_panel_utsman.tt.catatan,
                                    u8514965_panel_utsman.tt.nominal,
                                    u8514965_panel_utsman.tt.status_kredit_debet,
                                    CONCAT(
                                        u8514965_panel_utsman.ta.tahun_awal,
                                        '/',
                                        u8514965_panel_utsman.ta.tahun_akhir
                                    ) AS tahun_ajaran,
									u8514965_panel_utsman.tt.th_ajaran,
                                    u8514965_panel_utsman.tt.tanggal_transaksi,
                                    DATE_FORMAT(u8514965_panel_utsman.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
                                    CASE WHEN EXISTS(
                                    SELECT
                                        u8514965_panel_utsman.vmax.id_max
                                    FROM
                                        u8514965_panel_utsman.view_max_id_transaction_tour vmax
                                    WHERE
                                        u8514965_panel_utsman.tt.id_transaksi_wisata = u8514965_panel_utsman.vmax.id_max
                                ) THEN 1 ELSE 0
                                END AS status_edit
                                FROM
                                    u8514965_panel_utsman.transaksi_tabungan_wisata tt
                                LEFT JOIN u8514965_panel_utsman.siswa s
                                ON
                                    u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tt.nis_siswa
                                LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
                                ON
                                    u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
                                LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
                                ON
                                    u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
									WHERE
									(
										STR_TO_DATE(
											u8514965_panel_utsman.tt.tanggal_transaksi,
											'%d/%m/%Y'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    u8514965_panel_utsman.tt.id_transaksi_wisata
                                DESC");
        return $sql->result();
    }
    public function get_all_joint_transaction_savings($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
										u8514965_panel_utsman.ttb.id_transaksi_bersama,
										u8514965_panel_utsman.ttb.id_tingkat,
										u8514965_panel_utsman.ttb.nomor_rekening_bersama,
										u8514965_panel_utsman.ttb.nomor_transaksi_bersama,
										u8514965_panel_utsman.tb.nama_tabungan_bersama,
										u8514965_panel_utsman.s.nama_lengkap,
										u8514965_panel_utsman.s.nama_wali,
										u8514965_keuangan_utsman.ak.nama_akun,
										u8514965_keuangan_utsman.ak.email_akun,
										u8514965_panel_utsman.ttb.saldo,
										u8514965_panel_utsman.ttb.catatan,
										u8514965_panel_utsman.ttb.nominal,
										u8514965_panel_utsman.ttb.status_kredit_debet,
										CONCAT(
											u8514965_panel_utsman.ta.tahun_awal,
											'/',
											u8514965_panel_utsman.ta.tahun_akhir
										) AS tahun_ajaran,
										u8514965_panel_utsman.ttb.th_ajaran,
										u8514965_panel_utsman.ttb.tanggal_transaksi,
										DATE_FORMAT(
											u8514965_panel_utsman.ttb.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											u8514965_panel_utsman.vmax.id_max
										FROM
											u8514965_panel_utsman.view_max_id_transaction_joint vmax
										WHERE
											u8514965_panel_utsman.ttb.id_transaksi_bersama = u8514965_panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_bersama ttb
									LEFT JOIN u8514965_panel_utsman.tabungan_bersama tb
									ON
										u8514965_panel_utsman.tb.nomor_rekening_bersama = u8514965_panel_utsman.ttb.nomor_rekening_bersama
									LEFT JOIN u8514965_panel_utsman.siswa s
									ON
										u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tb.id_siswa_penanggung_jawab
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.ttb.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.ttb.id_pegawai
									WHERE
										(
											STR_TO_DATE(
												u8514965_panel_utsman.ttb.tanggal_transaksi,
												'%d/%m/%Y'
											) BETWEEN '$start_date' AND '$end_date'
										)
									ORDER BY
										u8514965_panel_utsman.ttb.id_transaksi_bersama
									DESC
										");
        return $sql->result();
    }

    public function get_student_balance($nis_student = '')
    {
        $this->db2->select('id_siswa, nis, nama_lengkap, saldo_tabungan_umum, saldo_tabungan_qurban, saldo_tabungan_wisata');
        $this->db2->where('nis', $nis_student);
        $sql = $this->db2->get($this->table_student);

        return $sql->result();
    }

    public function get_joint_saving_balance($nomor_rekening = '')
    {
        $this->db2->select('id_tabungan_bersama, nomor_rekening_bersama, nama_tabungan_bersama, saldo_tabungan_bersama');
        $this->db2->where('nomor_rekening_bersama', $nomor_rekening);
        $sql = $this->db2->get($this->table_joint_saving);
        return $sql->result();
    }

    public function get_student_transaction_last($id_transaction = '')
    {

        $this->db2->select("nis_siswa, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_umum');
        $this->db2->where('id_transaksi_umum', $id_transaction);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_student_transaction_qurban_last($id_transaction = '')
    {

        $this->db2->select("nis_siswa, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_qurban');
        $this->db2->where('id_transaksi_qurban', $id_transaction);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_student_transaction_tour_last($id_transaction = '')
    {

        $this->db2->select("nis_siswa, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_wisata');
        $this->db2->where('id_transaksi_wisata', $id_transaction);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_joint_transaction_last($id_transaction = '')
    {

        $this->db2->select("nomor_rekening_bersama, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_bersama');
        $this->db2->where('id_transaksi_bersama', $id_transaction);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function insert_joint_credit_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nomor_transaksi_bersama' => $value['input_nomor_transaksi_bersama'],
            'nomor_rekening_bersama' => $value['input_nomor_rekening_bersama'],
            'id_pegawai' => $id,
            'id_tingkat' => $value['input_tingkat'],
            'catatan' => @$value['input_catatan_saldo'],
            'nominal' => $value['input_nominal_saldo'],
            'saldo' => $value['saldo_akhir'],
            'status_kredit_debet' => $value['input_status_kredit_debet'],
            'th_ajaran' => $value['input_tahun_ajaran'],
            'tanggal_transaksi' => $value['input_tanggal_transaksi'],
        );

        $this->db2->insert($this->table_joint_saving_transaction, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }
    public function insert_credit_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'id_tingkat' => $value['id_tingkat'],
            'nomor_transaksi_umum' => $value['nomor_transaksi_umum'],
            'nis_siswa' => $value['nis'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_general, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_qurban_credit_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'id_tingkat' => $value['id_tingkat'],
            'nomor_transaksi_qurban' => $value['nomor_transaksi_qurban'],
            'nis_siswa' => $value['nis'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_qurban, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_tour_credit_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'id_tingkat' => $value['id_tingkat'],
            'nomor_transaksi_wisata' => $value['nomor_transaksi_wisata'],
            'nis_siswa' => $value['nis'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_tour, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_personal_saving($value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nama_lengkap' => strtoupper($value['input_nama_nasabah']),
            'nis' => $value['input_nomor_rekening'],
            'nomor_pembayaran_dpb' => $value['input_nomor_rekening'],
            'nomor_pembayaran_du' => "8" . substr($value['input_nomor_rekening'], 1),
            'password' => password_hash('12345', PASSWORD_DEFAULT, array('cost' => 12)),
            'nama_wali' => @$value['input_nama_wali'],
            'nomor_handphone' => @$value['input_nomor_hp_wali'],
            'email' => @$value['input_email_nasabah'],
            'level_tingkat' => $value['input_tingkat'],
            'saldo_tabungan_umum' => $value['input_saldo_tabungan_umum'],
            'saldo_tabungan_qurban' => $value['input_saldo_tabungan_qurban'],
            'saldo_tabungan_wisata' => $value['input_saldo_tabungan_wisata'],
            'th_ajaran' => $value['input_tahun_ajaran'],
        );

        $this->db2->insert($this->table_student, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_joint_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'id_siswa_penanggung_jawab' => $value['input_nama_siswa_penanggungjawab'],
            'id_tingkat' => $value['input_tingkat'],
            'id_th_ajaran' => $value['input_tahun_ajaran'],
            'nomor_rekening_bersama' => $value['input_nomor_rekening_bersama'],
            'nama_tabungan_bersama' => $value['input_nama_tabungan_bersama'],
            'saldo_tabungan_bersama' => $value['input_nominal_saldo_awal'],
            'keterangan_tabungan_bersama' => @$value['input_catatan_tabungan_bersama'],
        );

        $this->db2->insert($this->table_joint_saving, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_client($value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nama_lengkap' => strtoupper($value['nama_nasabah']),
            'nis' => $value['nis'],
            'nomor_pembayaran_dpb' => $value['nis'],
            'nomor_pembayaran_du' => "8" . substr($value['nis'], 1),
            'password' => password_hash('12345', PASSWORD_DEFAULT, array('cost' => 12)),
            'nama_wali' => @$value['nama_orangtua'],
            'nomor_handphone' => @$value['nomor_hp_aktif'],
            'email' => @$value['email_orangtua'],
            'level_tingkat' => $value['id_tingkat'],
            'th_ajaran' => $value['tahun_ajaran'],
            'saldo_tabungan_umum' => $value['saldo_akhir'],
        );

        $this->db2->insert($this->table_student, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_qurban_client($value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nama_lengkap' => strtoupper($value['nama_nasabah']),
            'nis' => $value['nis'],
            'nomor_pembayaran_dpb' => $value['nis'],
            'nomor_pembayaran_du' => "8" . substr($value['nis'], 1),
            'password' => password_hash('12345', PASSWORD_DEFAULT, array('cost' => 12)),
            'nama_wali' => @$value['nama_orangtua'],
            'nomor_handphone' => @$value['nomor_hp_aktif'],
            'email' => @$value['email_orangtua'],
            'level_tingkat' => $value['id_tingkat'],
            'saldo_tabungan_qurban' => $value['saldo_akhir'],
        );

        $this->db2->insert($this->table_student, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_tour_client($value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nama_lengkap' => strtoupper($value['nama_nasabah']),
            'nis' => $value['nis'],
            'nomor_pembayaran_dpb' => $value['nis'],
            'nomor_pembayaran_du' => "8" . substr($value['nis'], 1),
            'password' => password_hash('12345', PASSWORD_DEFAULT, array('cost' => 12)),
            'nama_wali' => @$value['nama_orangtua'],
            'nomor_handphone' => @$value['nomor_hp_aktif'],
            'email' => @$value['email_orangtua'],
            'level_tingkat' => $value['id_tingkat'],
            'saldo_tabungan_wisata' => $value['saldo_akhir'],
        );

        $this->db2->insert($this->table_student, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_debet_joint_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nomor_transaksi_bersama' => $value['input_nomor_transaksi_bersama'],
            'nomor_rekening_bersama' => $value['input_nomor_rekening_bersama'],
            'id_pegawai' => $id,
            'id_tingkat' => $value['input_tingkat'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => @$value['input_catatan_saldo'],
            'nominal' => $value['input_nominal_saldo'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['input_tahun_ajaran'],
            'tanggal_transaksi' => $value['input_tanggal_transaksi'],
        );

        $this->db2->insert($this->table_joint_saving_transaction, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_debet_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'nomor_transaksi_umum' => $value['nomor_transaksi_umum'],
            'nis_siswa' => $value['nis'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_general, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_qurban_debet_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'nomor_transaksi_qurban' => $value['nomor_transaksi_qurban'],
            'id_tingkat' => $value['id_tingkat'],
            'nis_siswa' => $value['nis'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_qurban, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_tour_debet_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'nomor_transaksi_wisata' => $value['nomor_transaksi_wisata'],
            'id_tingkat' => $value['id_tingkat'],
            'nis_siswa' => $value['nis'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_tour, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_personal_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nama_lengkap' => $value['nama_lengkap'],
            'th_ajaran' => $value['th_ajaran'],
            'level_tingkat' => $value['level_tingkat'],
            'nama_wali' => @$value['nama_wali'],
            'nomor_handphone' => @$value['nomor_handphone_wali'],
            'email' => @$value['email_wali'],
            'jenis_kelamin' => @$value['jenis_kelamin'],
        );

        $this->db2->where('id_siswa', $id);
        $this->db2->update($this->table_student, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_import_personal_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nis' => $value['nis'],
            'nama_nasabah' => $value['nama_nasabah'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'tahun_ajaran' => $value['tahun_ajaran'],
            'tingkat' => $value['tingkat'],
            'nama_wali' => @$value['nama_wali'],
            'nomor_hp_wali' => @$value['nomor_hp_wali'],
            'email_nasabah' => @$value['email_nasabah'],
            'saldo_umum' => @$value['saldo_umum'],
            'saldo_qurban' => @$value['saldo_qurban'],
            'saldo_wisata' => @$value['saldo_wisata'],
            'status_nasabah' => @$value['status_nasabah'],
        );

        $this->db2->where('id_nasabah', $id);
        $this->db2->update($this->table_import_personal_saving, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function accept_import_data_personal_saving($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->query("REPLACE INTO siswa(
											nis,
											nomor_pembayaran_dpb,
											nomor_pembayaran_du,
											level_tingkat,
											nama_lengkap,
											nomor_handphone,
											email,
											nama_wali,
											th_ajaran,
											saldo_tabungan_umum,
											saldo_tabungan_qurban,
											saldo_tabungan_wisata
										)
										SELECT
											u8514965_panel_utsman.inp.nis,
											u8514965_panel_utsman.inp.nis AS nomor_dpb,
											CONCAT(
												'8',
												SUBSTRING(u8514965_panel_utsman.inp.nis, 2)
											) AS nomor_du,
											u8514965_panel_utsman.inp.tingkat,
											u8514965_panel_utsman.inp.nama_nasabah,
											u8514965_panel_utsman.inp.nomor_hp_wali,
											u8514965_panel_utsman.inp.email_nasabah,
											u8514965_panel_utsman.inp.nama_wali,
											u8514965_panel_utsman.inp.tahun_ajaran,
											u8514965_panel_utsman.inp.saldo_umum,
											u8514965_panel_utsman.inp.saldo_qurban,
											u8514965_panel_utsman.inp.saldo_wisata
										FROM
											u8514965_panel_utsman.import_nasabah_personal inp
										WHERE
											u8514965_panel_utsman.inp.id_nasabah IN ($id)");

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_joint_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_siswa_penanggung_jawab' => $value['id_siswa_penanggung_jawab'],
            'id_tingkat' => $value['id_tingkat'],
            'id_th_ajaran' => $value['id_th_ajaran'],
            'nama_tabungan_bersama' => $value['nama_tabungan_bersama'],
            'keterangan_tabungan_bersama' => $value['keterangan_tabungan_bersama'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_tabungan_bersama', $id);
        $this->db2->update($this->table_joint_saving, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_name_hp_customer($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nama_wali' => @$value['nama_wali'],
            'nomor_handphone' => @$value['nomor_handphone'],
        );

        $this->db2->where('nis', $id);
        $this->db2->update($this->table_student, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_credit_joint_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nominal' => $value['input_nominal_saldo'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['input_catatan_saldo'],
            'id_tingkat' => $value['input_tingkat'],
            'tanggal_transaksi' => $value['input_tanggal_transaksi'],
            'th_ajaran' => $value['input_tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_bersama', $id);
        $this->db2->update($this->table_joint_saving_transaction, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_credit_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nis_siswa' => $value['nis'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_umum', $id);
        $this->db2->update($this->table_savings_transaction_general, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_qurban_credit_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nis_siswa' => $value['nis'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_qurban', $id);
        $this->db2->update($this->table_savings_transaction_qurban, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_tour_credit_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nis_siswa' => $value['nis'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_wisata', $id);
        $this->db2->update($this->table_savings_transaction_tour, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_debet_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nis_siswa' => $value['nis'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_umum', $id);
        $this->db2->update($this->table_savings_transaction_general, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_qurban_debet_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nis_siswa' => $value['nis'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_qurban', $id);
        $this->db2->update($this->table_savings_transaction_qurban, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_tour_debet_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nis_siswa' => $value['nis'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_wisata', $id);
        $this->db2->update($this->table_savings_transaction_tour, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_debet_joint_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nominal' => $value['input_nominal_saldo'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['input_catatan_saldo'],
            'id_tingkat' => $value['input_tingkat'],
            'tanggal_transaksi' => $value['input_tanggal_transaksi'],
            'th_ajaran' => $value['input_tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_bersama', $id);
        $this->db2->update($this->table_joint_saving_transaction, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_balance_saving($nis = '', $saldo = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'saldo_tabungan_umum' => $saldo,
        );

        $this->db2->where('nis', $nis);
        $this->db2->update($this->table_student, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_balance_joint_saving($nis = '', $saldo = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'saldo_tabungan_bersama' => $saldo,
        );

        $this->db2->where('nomor_rekening_bersama', $nis);
        $this->db2->update($this->table_joint_saving, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_qurban_balance_saving($nis = '', $saldo = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'saldo_tabungan_qurban' => $saldo,
        );

        $this->db2->where('nis', $nis);
        $this->db2->update($this->table_student, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_tour_balance_saving($nis = '', $saldo = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'saldo_tabungan_wisata' => $saldo,
        );

        $this->db2->where('nis', $nis);
        $this->db2->update($this->table_student, $data);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function delete_transaction($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->where('id_transaksi_umum', $id);
        $this->db2->delete($this->table_savings_transaction_general);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function delete_joint_transaction($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->where('id_transaksi_bersama', $id);
        $this->db2->delete($this->table_joint_saving_transaction);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function delete_qurban_transaction($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->where('id_transaksi_qurban', $id);
        $this->db2->delete($this->table_savings_transaction_qurban);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function delete_tour_transaction($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->where('id_transaksi_wisata', $id);
        $this->db2->delete($this->table_savings_transaction_tour);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    //-----------------------------------------------------------------------//

    public function clear_import_data_personal_saving()
    {
        $this->db2->trans_begin();

        $this->db2->truncate($this->table_import_personal_saving);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function clear_import_data_joint_saving()
    {
        $this->db2->trans_begin();

        $this->db2->truncate($this->table_import_joint_saving);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }
//
}
