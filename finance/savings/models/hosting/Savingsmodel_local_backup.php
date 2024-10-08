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
    private $table_import_joint_saving = 'import_nasabah_bersama';

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

    public function get_number_joint_saving($number = '')
    {

        $this->db2->select('nomor_rekening_bersama');
        $this->db2->where('nomor_rekening_bersama', $number);

        $sql = $this->db2->get($this->table_joint_saving);

        return $sql->result();
    }

    public function get_number_import_personal_saving($number = '')
    {

        $this->db2->select('nis');
        $this->db2->where('nis', $number);

        $sql = $this->db2->get($this->table_import_personal_saving);

        return $sql->num_rows();
    }

    public function get_number_import_joint_saving($number = '')
    {

        $this->db2->select('nomor_rekening_bersama');
        $this->db2->where('nomor_rekening_bersama', $number);

        $sql = $this->db2->get($this->table_import_joint_saving);

        return $sql->num_rows();
    }

    public function get_number_name_import_personal_saving($number = '', $name = '')
    {

        $this->db2->select('nis, nama_nasabah');
        $this->db2->where('nama_nasabah', $name);
        $this->db2->where('nis', $number);

        $sql = $this->db2->get($this->table_import_personal_saving);

        return $sql->num_rows();
    }

    public function check_student_by_name_and_number($number = '', $name = '')
    {
        $this->db2->select('nis, nama_lengkap, password');
        $this->db2->where('nis', $number);
        $this->db2->where('nama_lengkap', $name);

        $sql = $this->db2->get($this->table_student);
        return $sql->result();
    }

    public function check_duplicate_import_data_personal_saving($id = '')
    {
        $sql = $this->db->query("SELECT
									panel_utsman.inp.nis, panel_utsman.inp.status_nasabah, panel_utsman.inp.status_nama_nasabah
									FROM
										panel_utsman.import_nasabah_personal inp
									WHERE
										panel_utsman.inp.id_nasabah IN ($id)
									AND(
										(panel_utsman.inp.status_nasabah = 3) +
										(panel_utsman.inp.status_nama_nasabah = 3) >= 1
									)");

        return $sql->num_rows();
    }

    public function check_used_number_import_data_personal_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.inp.nis, panel_utsman.inp.status_nasabah, panel_utsman.inp.status_nama_nasabah
							FROM
								panel_utsman.import_nasabah_personal inp
							WHERE
								panel_utsman.inp.id_nasabah IN ($id)
							AND(
								(panel_utsman.inp.status_nasabah = 1) +
								(panel_utsman.inp.status_nama_nasabah = 4) >= 1
							)");

        return $sql->num_rows();
    }

    public function check_similiar_import_data_personal_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.inp.nis, panel_utsman.inp.status_nasabah, panel_utsman.inp.status_nama_nasabah
							FROM
								panel_utsman.import_nasabah_personal inp
							WHERE
								panel_utsman.inp.id_nasabah IN ($id)
							AND panel_utsman.inp.status_nama_nasabah = 1");

        return $sql->num_rows();
    }

    public function check_duplicate_import_data_joint_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.inb.nomor_rekening_bersama, panel_utsman.inb.nama_tabungan_bersama, panel_utsman.inb.status_nasabah_bersama
							FROM
								panel_utsman.import_nasabah_bersama inb
							WHERE
								panel_utsman.inb.id_nasabah_bersama IN ($id)
							AND panel_utsman.inb.status_nasabah_bersama = 3");

        return $sql->num_rows();
    }

    public function check_used_number_import_data_joint_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.inb.nomor_rekening_bersama, panel_utsman.inb.nama_tabungan_bersama, panel_utsman.inb.status_nasabah_bersama
							FROM
								panel_utsman.import_nasabah_bersama inb
							WHERE
								panel_utsman.inb.id_nasabah_bersama IN ($id)
							AND panel_utsman.inb.status_nasabah_bersama = 1");

        return $sql->num_rows();
    }

    public function check_responsible_person_import_data_joint_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.inb.nomor_rekening_bersama, panel_utsman.inb.nama_tabungan_bersama, panel_utsman.inb.status_penanggung_jawab
							FROM
								panel_utsman.import_nasabah_bersama inb
							WHERE
								panel_utsman.inb.id_nasabah_bersama IN ($id)
							AND panel_utsman.inb.status_penanggung_jawab = 2");

        return $sql->num_rows();
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

    public function get_import_joint_saving($id = '', $status = '')
    {
        $sql = $this->db2->query("SELECT
										*
									FROM
										import_nasabah_bersama
									WHERE
										id_nasabah_bersama IN ($id) AND status_nasabah_bersama = $status");
        return $sql->result_array();
    }

    public function get_new_transaction()
    {
        $sql = $this->db->query("SELECT
										panel_utsman.tt.id_transaksi_umum,
										panel_utsman.tt.nis_siswa,
										panel_utsman.s.nama_lengkap,
										panel_utsman.s.jenis_kelamin,
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
									ORDER BY
										panel_utsman.tt.id_transaksi_umum
									DESC LIMIT 5");
        return $sql->result();
    }

    public function get_transaction_credit_insight()
    {
        $sql = $this->db->query("SELECT
										th.*,
										(
										SELECT
											COALESCE(SUM(panel_utsman.tt.nominal),0)
										FROM
											(
											SELECT
												panel_utsman.tb.id_transaksi_umum,
												panel_utsman.tb.nominal,
												panel_utsman.tb.nis_siswa,
												panel_utsman.tb.th_ajaran,
												panel_utsman.tdpb.informasi
											FROM
												panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN panel_utsman.tagihan_pembayaran_dpb tdpb ON
												panel_utsman.tb.nis_siswa = panel_utsman.tdpb.nomor_siswa
											WHERE
												panel_utsman.tb.status_kredit_debet = 1 AND panel_utsman.tdpb.informasi LIKE('%TK%') OR panel_utsman.tdpb.informasi LIKE('%KB%')
											GROUP BY
												panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										panel_utsman.tt.th_ajaran = panel_utsman.th.id_tahun_ajaran
									) AS total_kredit_kbtk,
									(
										SELECT
											COALESCE(SUM(panel_utsman.tt.nominal), 0)
										FROM
											(
											SELECT
												panel_utsman.tb.id_transaksi_umum,
												panel_utsman.tb.nominal,
												panel_utsman.tb.nis_siswa,
												panel_utsman.tb.th_ajaran,
												panel_utsman.tdpb.informasi
											FROM
												panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN panel_utsman.tagihan_pembayaran_dpb tdpb ON
												panel_utsman.tb.nis_siswa = panel_utsman.tdpb.nomor_siswa
											WHERE
												panel_utsman.tb.status_kredit_debet = 1 AND panel_utsman.tdpb.informasi LIKE('%SD%')
											GROUP BY
												panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										panel_utsman.tt.th_ajaran = panel_utsman.th.id_tahun_ajaran
									) AS total_kredit_sd,
									(
										SELECT
											COALESCE(SUM(panel_utsman.tt.nominal), 0)
										FROM
											(
											SELECT
												panel_utsman.tb.id_transaksi_umum,
												panel_utsman.tb.nominal,
												panel_utsman.tb.nis_siswa,
												panel_utsman.tb.th_ajaran,
												panel_utsman.tdpb.informasi
											FROM
												panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN panel_utsman.tagihan_pembayaran_dpb tdpb ON
												panel_utsman.tb.nis_siswa = panel_utsman.tdpb.nomor_siswa
											WHERE
												panel_utsman.tb.status_kredit_debet = 1 AND panel_utsman.tdpb.informasi LIKE('%SMP%')
											GROUP BY
												panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										panel_utsman.tt.th_ajaran = panel_utsman.th.id_tahun_ajaran
									) AS total_kredit_smp,
									CONCAT(
										'TA. ',
										panel_utsman.th.tahun_awal,
										'/',
										panel_utsman.th.tahun_akhir
									) AS tahun
									FROM
										panel_utsman.tahun_ajaran th
									WHERE
										(panel_utsman.th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND panel_utsman.th.semester = 'ganjil'
									ORDER BY
										panel_utsman.th.tahun_awal ASC");
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
												panel_utsman.tb.id_transaksi_umum,
												panel_utsman.tb.nominal,
												panel_utsman.tb.nis_siswa,
												panel_utsman.tb.th_ajaran,
												panel_utsman.tdpb.informasi
											FROM
												panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN panel_utsman.tagihan_pembayaran_dpb tdpb ON
												panel_utsman.tb.nis_siswa = panel_utsman.tdpb.nomor_siswa
											WHERE
												panel_utsman.tb.status_kredit_debet = 2 AND panel_utsman.tdpb.informasi LIKE('%TK%') OR panel_utsman.tdpb.informasi LIKE('%KB%')
											GROUP BY
												panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										panel_utsman.tt.th_ajaran = panel_utsman.th.id_tahun_ajaran
									) AS total_debet_kbtk,
									(
										SELECT
											COALESCE(SUM(panel_utsman.tt.nominal), 0)
										FROM
											(
											SELECT
												panel_utsman.tb.id_transaksi_umum,
												panel_utsman.tb.nominal,
												panel_utsman.tb.nis_siswa,
												panel_utsman.tb.th_ajaran,
												panel_utsman.tdpb.informasi
											FROM
												panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN panel_utsman.tagihan_pembayaran_dpb tdpb ON
												panel_utsman.tb.nis_siswa = panel_utsman.tdpb.nomor_siswa
											WHERE
												panel_utsman.tb.status_kredit_debet = 2 AND panel_utsman.tdpb.informasi LIKE('%SD%')
											GROUP BY
												panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										panel_utsman.tt.th_ajaran = panel_utsman.th.id_tahun_ajaran
									) AS total_debet_sd,
									(
										SELECT
											COALESCE(SUM(panel_utsman.tt.nominal), 0)
										FROM
											(
											SELECT
												panel_utsman.tb.id_transaksi_umum,
												panel_utsman.tb.nominal,
												panel_utsman.tb.nis_siswa,
												panel_utsman.tb.th_ajaran,
												panel_utsman.tdpb.informasi
											FROM
												panel_utsman.transaksi_tabungan_umum tb
											LEFT JOIN panel_utsman.tagihan_pembayaran_dpb tdpb ON
												panel_utsman.tb.nis_siswa = panel_utsman.tdpb.nomor_siswa
											WHERE
												panel_utsman.tb.status_kredit_debet = 2 AND panel_utsman.tdpb.informasi LIKE('%SMP%')
											GROUP BY
												panel_utsman.tb.id_transaksi_umum
										) tt
									WHERE
										panel_utsman.tt.th_ajaran = panel_utsman.th.id_tahun_ajaran
									) AS total_debet_smp,
									CONCAT(
										'TA. ',
										panel_utsman.th.tahun_awal,
										'/',
										panel_utsman.th.tahun_akhir
									) AS tahun
									FROM
										panel_utsman.tahun_ajaran th
									WHERE
										(panel_utsman.th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND panel_utsman.th.semester = 'ganjil'
									ORDER BY
										panel_utsman.th.tahun_awal ASC");
        return $sql->result();
    }

    public function get_credit_debet_insight()
    {
        $sql = $this->db->query("SELECT
									th.*,
									(
									SELECT
										COALESCE(SUM(panel_utsman.tt.nominal),0)
									FROM
										(
										SELECT
											panel_utsman.tb.id_transaksi_umum,
											panel_utsman.tb.nominal,
											panel_utsman.tb.nis_siswa,
											panel_utsman.tb.th_ajaran,
											panel_utsman.tdpb.informasi
										FROM
											panel_utsman.transaksi_tabungan_umum tb
										LEFT JOIN panel_utsman.tagihan_pembayaran_dpb tdpb ON
											panel_utsman.tb.nis_siswa = panel_utsman.tdpb.nomor_siswa
										WHERE
											panel_utsman.tb.status_kredit_debet = 1
										GROUP BY
											panel_utsman.tb.id_transaksi_umum
									) tt
								WHERE
									panel_utsman.tt.th_ajaran = panel_utsman.th.id_tahun_ajaran
								) AS total_kredit,
								(
									SELECT
										COALESCE(SUM(tt.nominal), 0)
									FROM
										(
										SELECT
											panel_utsman.tb.id_transaksi_umum,
											panel_utsman.tb.nominal,
											panel_utsman.tb.nis_siswa,
											panel_utsman.tb.th_ajaran,
											panel_utsman.tdpb.informasi
										FROM
											panel_utsman.transaksi_tabungan_umum tb
										LEFT JOIN panel_utsman.tagihan_pembayaran_dpb tdpb ON
											panel_utsman.tb.nis_siswa = panel_utsman.tdpb.nomor_siswa
										WHERE
											panel_utsman.tb.status_kredit_debet = 2
										GROUP BY
											panel_utsman.tb.id_transaksi_umum
									) tt
								WHERE
									panel_utsman.tt.th_ajaran = panel_utsman.th.id_tahun_ajaran
								) AS total_debet,
								CONCAT(
									'TA. ',
									panel_utsman.th.tahun_awal,
									'/',
									panel_utsman.th.tahun_akhir
								) AS tahun
								FROM
									panel_utsman.tahun_ajaran th
								WHERE
									(panel_utsman.th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND panel_utsman.th.semester = 'ganjil'
								ORDER BY
									panel_utsman.th.tahun_awal ASC");
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
        $this->db2->select('s.nis, s.nama_lengkap, s.password');
        $this->db2->from('siswa s');
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

    public function check_match_name($name = '')
    {
        $searchWords = explode(' ', $name);
        $soundexConditions = [];

        foreach ($searchWords as $index => $word) {
            // Generate dynamic SOUNDEX condition for each word in the name
            $soundexConditions[] = "SOUNDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(ss.nama_lengkap, ' ', " . ($index + 1) . "), ' ', -1)) = SOUNDEX('$word')";
        }

        $soundexQueryPart = implode(' OR ', $soundexConditions);

        $sql = $this->db2->query("SELECT
										s.nis,
										s.nomor_pembayaran_du,
										s.nomor_pembayaran_dpb,
										s.nama_lengkap,
										s.level_tingkat,
										s.email,
										s.nomor_handphone,
										s.saldo_tabungan_umum,
										s.saldo_tabungan_qurban,
										s.saldo_tabungan_wisata,
										CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran
									FROM
										siswa s
									LEFT JOIN tahun_ajaran ta ON s.th_ajaran = ta.id_tahun_ajaran
									WHERE
										MATCH(s.nama_lengkap) AGAINST(
											'$name' IN NATURAL LANGUAGE MODE
										)
										AND s.nama_lengkap IN (
													SELECT
														ss.nama_lengkap
													FROM
														siswa ss
													WHERE
														$soundexQueryPart
														OR SOUNDEX(REPLACE(ss.nama_lengkap,' ','')) = SOUNDEX('$name')
										)");

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
										WHERE panel_utsman.tt.nis_siswa = $nis AND
										(
											DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%Y-%m-%d'
											) BETWEEN '$start_date' AND '$end_date'
										)
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
										WHERE panel_utsman.tt.nis_siswa = $nis AND
										(
											DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
										)
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
										WHERE panel_utsman.tt.nis_siswa = $nis AND
										(
											DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%Y-%m-%d'
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
										panel_utsman.ttb.id_transaksi_bersama,
										panel_utsman.ttb.id_tingkat,
										panel_utsman.ttb.nomor_rekening_bersama,
										panel_utsman.ttb.nomor_transaksi_bersama,
										panel_utsman.tb.nama_tabungan_bersama,
										panel_utsman.s.nama_lengkap,
										panel_utsman.s.nama_wali,
										keuangan_utsman.ak.nama_akun,
										keuangan_utsman.ak.email_akun,
										panel_utsman.ttb.saldo,
										panel_utsman.ttb.catatan,
										panel_utsman.ttb.nominal,
										panel_utsman.ttb.status_kredit_debet,
										CONCAT(
											panel_utsman.ta.tahun_awal,
											'/',
											panel_utsman.ta.tahun_akhir
										) AS tahun_ajaran,
										panel_utsman.ttb.th_ajaran,
										panel_utsman.ttb.tanggal_transaksi,
										DATE_FORMAT(
											panel_utsman.ttb.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											panel_utsman.vmax.id_max
										FROM
											panel_utsman.view_max_id_transaction_joint vmax
										WHERE
											panel_utsman.ttb.id_transaksi_bersama = panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_bersama ttb
									LEFT JOIN panel_utsman.tabungan_bersama tb
									ON
										panel_utsman.tb.nomor_rekening_bersama = panel_utsman.ttb.nomor_rekening_bersama
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tb.id_siswa_penanggung_jawab
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.ttb.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.ttb.id_pegawai
									WHERE
									panel_utsman.tb.nomor_rekening_bersama = $norek AND
										(
											DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%Y-%m-%d'
											) BETWEEN '$start_date' AND '$end_date'
										)
									ORDER BY
										panel_utsman.ttb.id_transaksi_bersama
									DESC
										");
        return $sql->result();
    }

    public function get_all_import_personal_customer()
    {
        $sql = $this->db2->query("SELECT
										panel_utsman.n.id_nasabah,
										panel_utsman.n.nis,
										panel_utsman.n.nama_nasabah,
										panel_utsman.n.tanggal_transaksi,
										panel_utsman.n.tingkat,
										panel_utsman.n.nama_wali,
										panel_utsman.n.nomor_hp_wali,
										panel_utsman.n.email_nasabah,
										panel_utsman.n.saldo_umum,
										panel_utsman.n.saldo_qurban,
										panel_utsman.n.saldo_wisata,
										panel_utsman.n.status_nasabah,
										panel_utsman.n.status_nama_nasabah,
										panel_utsman.n.tahun_ajaran,
										CONCAT(
                                        panel_utsman.ta.tahun_awal,
                                        '/',
                                        panel_utsman.ta.tahun_akhir
                                    	) AS nama_tahun_ajaran
									FROM
										panel_utsman.import_nasabah_personal n
									LEFT JOIN panel_utsman.tahun_ajaran ta
                                	ON
                                    	panel_utsman.ta.id_tahun_ajaran = panel_utsman.n.tahun_ajaran
									ORDER BY
										panel_utsman.n.id_nasabah
									ASC");
        return $sql->result();
    }

    public function get_all_personal_customer($start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										panel_utsman.s.id_siswa,
										panel_utsman.s.nis,
										panel_utsman.s.level_tingkat,
										panel_utsman.s.nama_lengkap,
										panel_utsman.s.jenis_kelamin,
										panel_utsman.s.nomor_handphone,
										panel_utsman.s.email,
										panel_utsman.s.jalur,
										panel_utsman.s.th_ajaran,
										(
										SELECT
											COALESCE(SUM(panel_utsman.ttu.nominal),
											0)
										FROM
											panel_utsman.transaksi_tabungan_umum ttu
										WHERE
											panel_utsman.ttu.nis_siswa = panel_utsman.s.nis AND panel_utsman.ttu.status_kredit_debet = 1 AND(
											DATE_FORMAT(
											panel_utsman.ttu.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
                                            )
										) AS kredit_umum,
										(
											SELECT
												COALESCE(SUM(panel_utsman.ttu.nominal),
												0)
											FROM
												panel_utsman.transaksi_tabungan_umum ttu
											WHERE
												panel_utsman.ttu.nis_siswa = panel_utsman.s.nis AND panel_utsman.ttu.status_kredit_debet = 2 AND(
													DATE_FORMAT(
                                                    panel_utsman.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_umum,
										(
											SELECT
												COALESCE(panel_utsman.ttu.saldo, 0)
											FROM panel_utsman.transaksi_tabungan_umum ttu
											WHERE
												panel_utsman.ttu.nis_siswa = panel_utsman.s.nis AND(
													DATE_FORMAT(
                                                    panel_utsman.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												panel_utsman.ttu.id_transaksi_umum
											DESC LIMIT 1
										) AS saldo_umum,
										(
										SELECT
											COALESCE(SUM(panel_utsman.ttq.nominal),
											0)
										FROM
											panel_utsman.transaksi_tabungan_qurban ttq
										WHERE
											panel_utsman.ttq.nis_siswa = panel_utsman.s.nis AND ttq.status_kredit_debet = 1 AND(
												DATE_FORMAT(
                                                panel_utsman.ttq.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
											)
										) AS kredit_qurban,
										(
											SELECT
												COALESCE(SUM(panel_utsman.ttq.nominal),
												0)
											FROM
												panel_utsman.transaksi_tabungan_qurban ttq
											WHERE
												panel_utsman.ttq.nis_siswa = s.nis AND panel_utsman.ttq.status_kredit_debet = 2 AND(
												DATE_FORMAT(
											    panel_utsman.ttq.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
											)
										) AS debet_qurban,
										(
											SELECT
												COALESCE(panel_utsman.ttq.saldo, 0)
											FROM
												panel_utsman.transaksi_tabungan_qurban ttq
											WHERE
												panel_utsman.ttq.nis_siswa = panel_utsman.s.nis AND(
													DATE_FORMAT(
                                                    panel_utsman.ttq.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												panel_utsman.ttq.id_transaksi_qurban
											DESC LIMIT 1
										) AS saldo_qurban,
										(
										SELECT
											COALESCE(SUM(panel_utsman.ttw.nominal),
											0)
										FROM
											panel_utsman.transaksi_tabungan_wisata ttw
										WHERE
											panel_utsman.ttw.nis_siswa = panel_utsman.s.nis AND panel_utsman.ttw.status_kredit_debet = 1 AND(
												DATE_FORMAT(
                                                panel_utsman.ttw.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
											)
										) AS kredit_wisata,
										(
											SELECT
												COALESCE(SUM(panel_utsman.ttw.nominal),
												0)
											FROM
												panel_utsman.transaksi_tabungan_wisata ttw
											WHERE
												ttw.nis_siswa = s.nis AND ttw.status_kredit_debet = 2 AND(
													DATE_FORMAT(
                                                    panel_utsman.ttw.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_wisata,
										(
											SELECT
												COALESCE(panel_utsman.ttw.saldo, 0)
											FROM
												panel_utsman.transaksi_tabungan_wisata ttw
											WHERE
												panel_utsman.ttw.nis_siswa = panel_utsman.s.nis AND(
													DATE_FORMAT(
                                                    panel_utsman.ttw.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												panel_utsman.ttw.id_transaksi_wisata
											DESC LIMIT 1
										) AS saldo_wisata,
										panel_utsman.s.nama_wali,
										CONCAT(
                                        panel_utsman.ta.tahun_awal,
                                        '/',
                                        panel_utsman.ta.tahun_akhir
                                    	) AS tahun_ajaran
									FROM
										siswa s
									LEFT JOIN panel_utsman.tahun_ajaran ta
                                	ON
                                    	panel_utsman.ta.id_tahun_ajaran = panel_utsman.s.th_ajaran
									ORDER BY
										panel_utsman.s.id_siswa
									DESC");
        return $sql->result();
    }

    public function get_all_import_joint_customer()
    {
        $sql = $this->db2->query("SELECT
										panel_utsman.tb.id_nasabah_bersama,
										panel_utsman.tb.id_siswa_penanggung_jawab,
										panel_utsman.tb.nomor_rekening_bersama,
										panel_utsman.tb.nama_tabungan_bersama,
										panel_utsman.tb.tingkat,
										panel_utsman.tb.tahun_ajaran,
										panel_utsman.tb.nama_wali,
										panel_utsman.tb.nama_tabungan_bersama,
										panel_utsman.tb.saldo_bersama,
										panel_utsman.tb.nomor_hp_wali,
										panel_utsman.tb.tanggal_transaksi,
										panel_utsman.tb.status_nasabah_bersama,
										panel_utsman.tb.status_penanggung_jawab,
										panel_utsman.s.nama_lengkap,
										CONCAT(
                                        panel_utsman.ta.tahun_awal,
                                        '/',
                                        panel_utsman.ta.tahun_akhir
                                    	) AS nama_tahun_ajaran
									FROM
										panel_utsman.import_nasabah_bersama tb
									LEFT JOIN panel_utsman.siswa s
                                	ON
                                   		 panel_utsman.s.nis = panel_utsman.tb.id_siswa_penanggung_jawab
									LEFT JOIN panel_utsman.tahun_ajaran ta
                                	ON
                                    	panel_utsman.ta.id_tahun_ajaran = panel_utsman.tb.tahun_ajaran
									ORDER BY
										panel_utsman.tb.id_nasabah_bersama
									ASC");
        return $sql->result();
    }

    public function get_all_joint_customer($start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										panel_utsman.tb.id_tabungan_bersama,
										panel_utsman.tb.id_siswa_penanggung_jawab,
										panel_utsman.tb.nomor_rekening_bersama,
										panel_utsman.tb.nama_tabungan_bersama,
										panel_utsman.tb.keterangan_tabungan_bersama,
										panel_utsman.tb.id_tingkat,
										panel_utsman.tb.id_th_ajaran,
										panel_utsman.s.nama_wali,
										panel_utsman.s.nis,
										panel_utsman.s.nama_lengkap,
										panel_utsman.s.nomor_handphone,
										panel_utsman.s.email,
										(
										SELECT
											COALESCE(SUM(panel_utsman.ttb.nominal),
											0)
										FROM
											panel_utsman.transaksi_tabungan_bersama ttb
										WHERE
											panel_utsman.ttb.nomor_rekening_bersama = panel_utsman.tb.nomor_rekening_bersama AND panel_utsman.ttb.status_kredit_debet = 1 AND(
												DATE_FORMAT(
                                                panel_utsman.ttb.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
											)
									) AS kredit_bersama,
									(
										SELECT
											COALESCE(SUM(panel_utsman.ttb.nominal),
											0)
										FROM
											panel_utsman.transaksi_tabungan_bersama ttb
										WHERE
											panel_utsman.ttb.nomor_rekening_bersama = panel_utsman.tb.nomor_rekening_bersama AND panel_utsman.ttb.status_kredit_debet = 2 AND(
												DATE_FORMAT(
                                                panel_utsman.ttb.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_bersama,
									(
										SELECT
											COALESCE(ttb.nominal, 0)
										FROM
											panel_utsman.transaksi_tabungan_bersama ttb
										WHERE
											panel_utsman.ttb.nomor_rekening_bersama = panel_utsman.tb.nomor_rekening_bersama AND(
												DATE_FORMAT(
													panel_utsman.ttb.waktu_transaksi,
													'%Y-%m-%d'
												) BETWEEN '$start_date' AND '$end_date'
											)
										ORDER BY
											panel_utsman.ttb.id_transaksi_bersama
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
									ORDER BY
										panel_utsman.tb.id_tabungan_bersama
									DESC");
        return $sql->result();
    }
    public function get_all_general_transaction_savings($start_date = '', $end_date = '')
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
									WHERE
									(
										DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    panel_utsman.tt.id_transaksi_umum
                                DESC");
        return $sql->result();
    }
    public function get_all_qurban_transaction_savings($start_date = '', $end_date = '')
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
									WHERE
									(
										DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    panel_utsman.tt.id_transaksi_qurban
                                DESC");
        return $sql->result();
    }
    public function get_all_tour_transaction_savings($start_date = '', $end_date = '')
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
									WHERE
									(
										DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    panel_utsman.tt.id_transaksi_wisata
                                DESC");
        return $sql->result();
    }
    public function get_all_joint_transaction_savings($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
										panel_utsman.ttb.id_transaksi_bersama,
										panel_utsman.ttb.id_tingkat,
										panel_utsman.ttb.nomor_rekening_bersama,
										panel_utsman.ttb.nomor_transaksi_bersama,
										panel_utsman.tb.nama_tabungan_bersama,
										panel_utsman.s.nama_lengkap,
										panel_utsman.s.nama_wali,
										keuangan_utsman.ak.nama_akun,
										keuangan_utsman.ak.email_akun,
										panel_utsman.ttb.saldo,
										panel_utsman.ttb.catatan,
										panel_utsman.ttb.nominal,
										panel_utsman.ttb.status_kredit_debet,
										CONCAT(
											panel_utsman.ta.tahun_awal,
											'/',
											panel_utsman.ta.tahun_akhir
										) AS tahun_ajaran,
										panel_utsman.ttb.th_ajaran,
										panel_utsman.ttb.tanggal_transaksi,
										DATE_FORMAT(
											panel_utsman.ttb.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											panel_utsman.vmax.id_max
										FROM
											panel_utsman.view_max_id_transaction_joint vmax
										WHERE
											panel_utsman.ttb.id_transaksi_bersama = panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_bersama ttb
									LEFT JOIN panel_utsman.tabungan_bersama tb
									ON
										panel_utsman.tb.nomor_rekening_bersama = panel_utsman.ttb.nomor_rekening_bersama
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tb.id_siswa_penanggung_jawab
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.ttb.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.ttb.id_pegawai
									WHERE
									(
										DATE_FORMAT(
											panel_utsman.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
									)
									ORDER BY
										panel_utsman.ttb.id_transaksi_bersama
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

        $this->db2->select("nis_siswa, nomor_transaksi_umum, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_umum');
        $this->db2->where('id_transaksi_umum', $id_transaction);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_student_transaction_qurban_last($id_transaction = '')
    {

        $this->db2->select("nis_siswa, nomor_transaksi_qurban, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_qurban');
        $this->db2->where('id_transaksi_qurban', $id_transaction);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_student_transaction_tour_last($id_transaction = '')
    {

        $this->db2->select("nis_siswa, nomor_transaksi_wisata, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_wisata');
        $this->db2->where('id_transaksi_wisata', $id_transaction);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_joint_transaction_last($id_transaction = '')
    {

        $this->db2->select("nomor_rekening_bersama, nomor_transaksi_bersama, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
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

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_joint_saving_transaction, array('id_transaksi_bersama' => $id));

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return array('status' => false);
        } else {
            $this->db2->trans_commit();
            return array('status' => true, 'data' => $query->row());
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

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_general, array('id_transaksi_umum' => $id));

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return array('status' => false);
        } else {
            $this->db2->trans_commit();
            return array('status' => true, 'data' => $query->row());
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

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_qurban, array('id_transaksi_qurban' => $id));

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return array('status' => false);
        } else {
            $this->db2->trans_commit();
            return array('status' => true, 'data' => $query->row());
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

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_tour, array('id_transaksi_wisata' => $id));

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return array('status' => false);
        } else {
            $this->db2->trans_commit();
            return array('status' => true, 'data' => $query->row());
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
            'password' => password_hash(paramEncrypt($value['input_nomor_rekening']), PASSWORD_DEFAULT, array('cost' => 12)),
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
            'password' => password_hash(paramEncrypt($value['nis']), PASSWORD_DEFAULT, array('cost' => 12)),
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
            'password' => password_hash(paramEncrypt($value['nis']), PASSWORD_DEFAULT, array('cost' => 12)),
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
            'password' => password_hash(paramEncrypt($value['nis']), PASSWORD_DEFAULT, array('cost' => 12)),
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

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_joint_saving_transaction, array('id_transaksi_bersama' => $id));

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return array('status' => false);
        } else {
            $this->db2->trans_commit();
            return array('status' => true, 'data' => $query->row());
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

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_general, array('id_transaksi_umum' => $id));

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return array('status' => false);
        } else {
            $this->db2->trans_commit();
            return array('status' => true, 'data' => $query->row());
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

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_qurban, array('id_transaksi_qurban' => $id));

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return array('status' => false);
        } else {
            $this->db2->trans_commit();
            return array('status' => true, 'data' => $query->row());
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

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_tour, array('id_transaksi_wisata' => $id));

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return array('status' => false);
        } else {
            $this->db2->trans_commit();
            return array('status' => true, 'data' => $query->row());
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
            'password' => $value['password'],
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
            'status_nasabah' => $value['status_nasabah'],
            'status_nama_nasabah' => $value['status_nama_nasabah'],
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

    public function update_import_joint_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nomor_rekening_bersama' => $value['nomor_rekening_bersama'],
            'id_siswa_penanggung_jawab' => $value['id_siswa_penanggung_jawab'],
            'nama_tabungan_bersama' => $value['nama_tabungan_bersama'],
            'tingkat' => $value['id_tingkat'],
            'tahun_ajaran' => $value['id_th_ajaran'],
            'saldo_bersama' => $value['saldo_bersama'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'nama_wali' => @$value['nama_wali'],
            'nomor_hp_wali' => @$value['nomor_handphone'],
            'status_nasabah_bersama' => $value['status_nasabah'],
            'status_penanggung_jawab' => $value['status_pj'],
        );

        $this->db2->where('id_nasabah_bersama', $id);
        $this->db2->update($this->table_import_joint_saving, $data);

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

        $this->db2->query("INSERT INTO siswa(
											nis,
											nomor_pembayaran_dpb,
											nomor_pembayaran_du,
											password,
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
											panel_utsman.inp.nis,
											panel_utsman.inp.nis AS nomor_dpb,
											CONCAT(
												'8',
												SUBSTRING(panel_utsman.inp.nis, 2)
											) AS nomor_du,
											panel_utsman.inp.password,
											panel_utsman.inp.tingkat,
											panel_utsman.inp.nama_nasabah,
											panel_utsman.inp.nomor_hp_wali,
											panel_utsman.inp.email_nasabah,
											panel_utsman.inp.nama_wali,
											panel_utsman.inp.tahun_ajaran,
											panel_utsman.inp.saldo_umum,
											panel_utsman.inp.saldo_qurban,
											panel_utsman.inp.saldo_wisata
										FROM
											panel_utsman.import_nasabah_personal inp
										WHERE
											panel_utsman.inp.id_nasabah IN ($id)
										ON DUPLICATE KEY UPDATE
											password = VALUES(password),
											level_tingkat = VALUES(level_tingkat),
											nama_lengkap = VALUES(nama_lengkap),
											nomor_handphone = VALUES(nomor_handphone),
											email = VALUES(email),
											nama_wali = VALUES(nama_wali),
											th_ajaran = VALUES(th_ajaran),
											saldo_tabungan_umum = VALUES(saldo_tabungan_umum),
											saldo_tabungan_qurban = VALUES(saldo_tabungan_qurban),
											saldo_tabungan_wisata = VALUES(saldo_tabungan_wisata)");

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function accept_import_data_joint_saving($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->query("INSERT INTO tabungan_bersama (
											id_siswa_penanggung_jawab,
											id_pegawai,
											id_tingkat,
											id_th_ajaran,
											nomor_rekening_bersama,
											nama_tabungan_bersama,
											saldo_tabungan_bersama,
											keterangan_tabungan_bersama
										)
										SELECT
											panel_utsman.inb.id_siswa_penanggung_jawab,
											panel_utsman.inb.id_pegawai,
											panel_utsman.inb.tingkat,
											panel_utsman.inb.tahun_ajaran,
											panel_utsman.inb.nomor_rekening_bersama,
											panel_utsman.inb.nama_tabungan_bersama,
											panel_utsman.inb.saldo_bersama,
											panel_utsman.inb.keterangan_bersama
										FROM
											panel_utsman.import_nasabah_bersama inb
										WHERE
											panel_utsman.inb.id_nasabah_bersama IN ($id)
										ON DUPLICATE KEY UPDATE
											id_siswa_penanggung_jawab = VALUES(id_siswa_penanggung_jawab),
											id_pegawai = VALUES(id_pegawai),
											id_tingkat = VALUES(id_tingkat),
											id_th_ajaran = VALUES(id_th_ajaran),
											nama_tabungan_bersama = VALUES(nama_tabungan_bersama),
											saldo_tabungan_bersama = VALUES(saldo_tabungan_bersama),
											keterangan_tabungan_bersama = VALUES(keterangan_tabungan_bersama)");

        $this->db2->query("UPDATE
								panel_utsman.siswa AS s,
								panel_utsman.import_nasabah_bersama AS inb
							SET
								panel_utsman.s.nama_wali = panel_utsman.inb.nama_wali,
								panel_utsman.s.nomor_handphone = panel_utsman.inb.nomor_hp_wali
							WHERE
								panel_utsman.s.nis = panel_utsman.inb.id_siswa_penanggung_jawab
								AND
								panel_utsman.inb.id_nasabah_bersama IN ($id)");

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

    public function delete_import_personal_saving_by_id($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->where('id_nasabah', $id);
        $this->db2->delete($this->table_import_personal_saving);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function delete_import_joint_saving_by_id($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->where('id_nasabah_bersama', $id);
        $this->db2->delete($this->table_import_joint_saving);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

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
