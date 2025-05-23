<?php

class SavingsModel extends MY_Model
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
    private $table_savings_transaction_general_emp = 'transaksi_tabungan_umum_pegawai';
    private $table_savings_transaction_qurban_emp = 'transaksi_tabungan_qurban_pegawai';
    private $table_savings_transaction_tht_emp = 'transaksi_tabungan_tht_pegawai';
    private $table_student = 'siswa';
    private $table_employee = 'pegawai';
    private $table_joint_saving = 'tabungan_bersama';
    private $table_contact = 'kontak';
    private $table_vstudent = 'view_siswa';
    private $table_vemployee = 'view_pegawai';
    private $table_account = 'akun_keuangan';
    private $table_import_personal_saving = 'import_nasabah_personal';
    private $table_import_joint_saving = 'import_nasabah_bersama';
    private $table_import_employee_saving = 'import_nasabah_pegawai';

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

    public function get_number_employee_saving($number = '')
    {

        $this->db2->select('nip');
        $this->db2->where('nip', $number);

        $sql = $this->db2->get($this->table_employee);

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

    public function get_number_import_employee_saving($number = '')
    {

        $this->db2->select('nip');
        $this->db2->where('nip', $number);

        $sql = $this->db2->get($this->table_import_employee_saving);

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

    public function get_number_name_import_employee_saving($number = '', $name = '')
    {

        $this->db2->select('nip, nama_nasabah');
        $this->db2->where('nama_nasabah', $name);
        $this->db2->where('nip', $number);

        $sql = $this->db2->get($this->table_import_employee_saving);

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

    public function check_employee_by_name_and_number($number = '', $name = '')
    {
        $this->db2->select('nip, nama_lengkap, password');
        $this->db2->where('nip', $number);
        $this->db2->where('nama_lengkap', $name);

        $sql = $this->db2->get($this->table_employee);
        return $sql->result();
    }

    public function check_duplicate_import_data_personal_saving($id = '')
    {
        $sql = $this->db->query("SELECT
									{$this->secondary_db}.inp.nis, {$this->secondary_db}.inp.status_nasabah, {$this->secondary_db}.inp.status_nama_nasabah
									FROM
										{$this->secondary_db}.import_nasabah_personal inp
									WHERE
										{$this->secondary_db}.inp.id_nasabah IN ($id)
									AND(
										({$this->secondary_db}.inp.status_nasabah = 3) +
										({$this->secondary_db}.inp.status_nama_nasabah = 3) >= 1
									)");

        return $sql->num_rows();
    }

    public function check_used_number_import_data_personal_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.inp.nis, {$this->secondary_db}.inp.status_nasabah, {$this->secondary_db}.inp.status_nama_nasabah
							FROM
								{$this->secondary_db}.import_nasabah_personal inp
							WHERE
								{$this->secondary_db}.inp.id_nasabah IN ($id)
							AND(
								({$this->secondary_db}.inp.status_nasabah = 1) +
								({$this->secondary_db}.inp.status_nama_nasabah = 4) >= 1
							)");

        return $sql->num_rows();
    }

    public function check_similiar_import_data_personal_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.inp.nis, {$this->secondary_db}.inp.status_nasabah, {$this->secondary_db}.inp.status_nama_nasabah
							FROM
								{$this->secondary_db}.import_nasabah_personal inp
							WHERE
								{$this->secondary_db}.inp.id_nasabah IN ($id)
							AND {$this->secondary_db}.inp.status_nama_nasabah = 1");

        return $sql->num_rows();
    }

    public function check_duplicate_import_data_employee_saving($id = '')
    {
        $sql = $this->db->query("SELECT
									{$this->secondary_db}.inp.nip, {$this->secondary_db}.inp.status_nasabah, {$this->secondary_db}.inp.status_nama_nasabah
									FROM
										{$this->secondary_db}.import_nasabah_pegawai inp
									WHERE
										{$this->secondary_db}.inp.id_nasabah IN ($id)
									AND(
										({$this->secondary_db}.inp.status_nasabah = 3) +
										({$this->secondary_db}.inp.status_nama_nasabah = 3) >= 1
									)");

        return $sql->num_rows();
    }

    public function check_used_number_import_data_employee_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.inp.nip, {$this->secondary_db}.inp.status_nasabah, {$this->secondary_db}.inp.status_nama_nasabah
							FROM
								{$this->secondary_db}.import_nasabah_pegawai inp
							WHERE
								{$this->secondary_db}.inp.id_nasabah IN ($id)
							AND(
								({$this->secondary_db}.inp.status_nasabah = 1) +
								({$this->secondary_db}.inp.status_nama_nasabah = 4) >= 1
							)");

        return $sql->num_rows();
    }

    public function check_similiar_import_data_employee_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.inp.nip, {$this->secondary_db}.inp.status_nasabah, {$this->secondary_db}.inp.status_nama_nasabah
							FROM
								{$this->secondary_db}.import_nasabah_pegawai inp
							WHERE
								{$this->secondary_db}.inp.id_nasabah IN ($id)
							AND {$this->secondary_db}.inp.status_nama_nasabah = 1");

        return $sql->num_rows();
    }

    public function check_duplicate_import_data_joint_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.inb.nomor_rekening_bersama, {$this->secondary_db}.inb.nama_tabungan_bersama, {$this->secondary_db}.inb.status_nasabah_bersama
							FROM
								{$this->secondary_db}.import_nasabah_bersama inb
							WHERE
								{$this->secondary_db}.inb.id_nasabah_bersama IN ($id)
							AND {$this->secondary_db}.inb.status_nasabah_bersama = 3");

        return $sql->num_rows();
    }

    public function check_used_number_import_data_joint_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.inb.nomor_rekening_bersama, {$this->secondary_db}.inb.nama_tabungan_bersama, {$this->secondary_db}.inb.status_nasabah_bersama
							FROM
								{$this->secondary_db}.import_nasabah_bersama inb
							WHERE
								{$this->secondary_db}.inb.id_nasabah_bersama IN ($id)
							AND {$this->secondary_db}.inb.status_nasabah_bersama = 1");

        return $sql->num_rows();
    }

    public function check_responsible_person_import_data_joint_saving($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.inb.nomor_rekening_bersama, {$this->secondary_db}.inb.nama_tabungan_bersama, {$this->secondary_db}.inb.status_penanggung_jawab
							FROM
								{$this->secondary_db}.import_nasabah_bersama inb
							WHERE
								{$this->secondary_db}.inb.id_nasabah_bersama IN ($id)
							AND {$this->secondary_db}.inb.status_penanggung_jawab = 2");

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

    public function get_import_employee_saving($id = '', $status = '')
    {
        $sql = $this->db2->query("SELECT
										*
									FROM
										import_nasabah_pegawai
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
										{$this->secondary_db}.tt.id_transaksi_umum,
										{$this->secondary_db}.tt.nis_siswa,
										{$this->secondary_db}.s.nama_lengkap,
										{$this->secondary_db}.s.jenis_kelamin,
										{$this->default_db}.ak.nama_akun,
										{$this->default_db}.ak.email_akun,
										{$this->secondary_db}.tt.saldo,
										{$this->secondary_db}.tt.catatan,
										{$this->secondary_db}.tt.nominal,
										{$this->secondary_db}.tt.status_kredit_debet,
										CONCAT(
											{$this->secondary_db}.ta.tahun_awal,
											'/',
											{$this->secondary_db}.ta.tahun_akhir
										) AS tahun_ajaran,
										{$this->secondary_db}.tt.th_ajaran,
										{$this->secondary_db}.tt.tanggal_transaksi,
										DATE_FORMAT({$this->secondary_db}.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											{$this->secondary_db}.vmax.id_max
										FROM
											{$this->secondary_db}.view_max_id_transaction_general vmax
										WHERE
											{$this->secondary_db}.tt.id_transaksi_umum = {$this->secondary_db}.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										{$this->secondary_db}.transaksi_tabungan_umum tt
									LEFT JOIN {$this->secondary_db}.siswa s
									ON
										{$this->secondary_db}.s.nis = {$this->secondary_db}.tt.nis_siswa
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
									ON
										{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
									LEFT JOIN {$this->default_db}.akun_keuangan ak
									ON
										{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
									ORDER BY
										{$this->secondary_db}.tt.id_transaksi_umum
									DESC LIMIT 5");
        return $sql->result();
    }

    public function get_transaction_credit_insight()
    {
        $sql = $this->db->query("SELECT
										th.*,
										(
										SELECT
											COALESCE(SUM({$this->secondary_db}.tt.nominal),0)
										FROM
											(
											SELECT
												{$this->secondary_db}.tb.id_transaksi_umum,
												{$this->secondary_db}.tb.nominal,
												{$this->secondary_db}.tb.nis_siswa,
												{$this->secondary_db}.tb.th_ajaran,
												{$this->secondary_db}.tdpb.informasi
											FROM
												{$this->secondary_db}.transaksi_tabungan_umum tb
											LEFT JOIN {$this->secondary_db}.tagihan_pembayaran_dpb tdpb ON
												{$this->secondary_db}.tb.nis_siswa = {$this->secondary_db}.tdpb.nomor_siswa
											WHERE
												{$this->secondary_db}.tb.status_kredit_debet = 1 AND {$this->secondary_db}.tdpb.informasi LIKE('%TK%') OR {$this->secondary_db}.tdpb.informasi LIKE('%KB%')
											GROUP BY
												{$this->secondary_db}.tb.id_transaksi_umum
										) tt
									WHERE
										{$this->secondary_db}.tt.th_ajaran = {$this->secondary_db}.th.id_tahun_ajaran
									) AS total_kredit_kbtk,
									(
										SELECT
											COALESCE(SUM({$this->secondary_db}.tt.nominal), 0)
										FROM
											(
											SELECT
												{$this->secondary_db}.tb.id_transaksi_umum,
												{$this->secondary_db}.tb.nominal,
												{$this->secondary_db}.tb.nis_siswa,
												{$this->secondary_db}.tb.th_ajaran,
												{$this->secondary_db}.tdpb.informasi
											FROM
												{$this->secondary_db}.transaksi_tabungan_umum tb
											LEFT JOIN {$this->secondary_db}.tagihan_pembayaran_dpb tdpb ON
												{$this->secondary_db}.tb.nis_siswa = {$this->secondary_db}.tdpb.nomor_siswa
											WHERE
												{$this->secondary_db}.tb.status_kredit_debet = 1 AND {$this->secondary_db}.tdpb.informasi LIKE('%SD%')
											GROUP BY
												{$this->secondary_db}.tb.id_transaksi_umum
										) tt
									WHERE
										{$this->secondary_db}.tt.th_ajaran = {$this->secondary_db}.th.id_tahun_ajaran
									) AS total_kredit_sd,
									(
										SELECT
											COALESCE(SUM({$this->secondary_db}.tt.nominal), 0)
										FROM
											(
											SELECT
												{$this->secondary_db}.tb.id_transaksi_umum,
												{$this->secondary_db}.tb.nominal,
												{$this->secondary_db}.tb.nis_siswa,
												{$this->secondary_db}.tb.th_ajaran,
												{$this->secondary_db}.tdpb.informasi
											FROM
												{$this->secondary_db}.transaksi_tabungan_umum tb
											LEFT JOIN {$this->secondary_db}.tagihan_pembayaran_dpb tdpb ON
												{$this->secondary_db}.tb.nis_siswa = {$this->secondary_db}.tdpb.nomor_siswa
											WHERE
												{$this->secondary_db}.tb.status_kredit_debet = 1 AND {$this->secondary_db}.tdpb.informasi LIKE('%SMP%')
											GROUP BY
												{$this->secondary_db}.tb.id_transaksi_umum
										) tt
									WHERE
										{$this->secondary_db}.tt.th_ajaran = {$this->secondary_db}.th.id_tahun_ajaran
									) AS total_kredit_smp,
									CONCAT(
										'TA. ',
										{$this->secondary_db}.th.tahun_awal,
										'/',
										{$this->secondary_db}.th.tahun_akhir
									) AS tahun
									FROM
										{$this->secondary_db}.tahun_ajaran th
									WHERE
										({$this->secondary_db}.th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND {$this->secondary_db}.th.semester = 'ganjil'
									ORDER BY
										{$this->secondary_db}.th.tahun_awal ASC");
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
												{$this->secondary_db}.tb.id_transaksi_umum,
												{$this->secondary_db}.tb.nominal,
												{$this->secondary_db}.tb.nis_siswa,
												{$this->secondary_db}.tb.th_ajaran,
												{$this->secondary_db}.tdpb.informasi
											FROM
												{$this->secondary_db}.transaksi_tabungan_umum tb
											LEFT JOIN {$this->secondary_db}.tagihan_pembayaran_dpb tdpb ON
												{$this->secondary_db}.tb.nis_siswa = {$this->secondary_db}.tdpb.nomor_siswa
											WHERE
												{$this->secondary_db}.tb.status_kredit_debet = 2 AND {$this->secondary_db}.tdpb.informasi LIKE('%TK%') OR {$this->secondary_db}.tdpb.informasi LIKE('%KB%')
											GROUP BY
												{$this->secondary_db}.tb.id_transaksi_umum
										) tt
									WHERE
										{$this->secondary_db}.tt.th_ajaran = {$this->secondary_db}.th.id_tahun_ajaran
									) AS total_debet_kbtk,
									(
										SELECT
											COALESCE(SUM({$this->secondary_db}.tt.nominal), 0)
										FROM
											(
											SELECT
												{$this->secondary_db}.tb.id_transaksi_umum,
												{$this->secondary_db}.tb.nominal,
												{$this->secondary_db}.tb.nis_siswa,
												{$this->secondary_db}.tb.th_ajaran,
												{$this->secondary_db}.tdpb.informasi
											FROM
												{$this->secondary_db}.transaksi_tabungan_umum tb
											LEFT JOIN {$this->secondary_db}.tagihan_pembayaran_dpb tdpb ON
												{$this->secondary_db}.tb.nis_siswa = {$this->secondary_db}.tdpb.nomor_siswa
											WHERE
												{$this->secondary_db}.tb.status_kredit_debet = 2 AND {$this->secondary_db}.tdpb.informasi LIKE('%SD%')
											GROUP BY
												{$this->secondary_db}.tb.id_transaksi_umum
										) tt
									WHERE
										{$this->secondary_db}.tt.th_ajaran = {$this->secondary_db}.th.id_tahun_ajaran
									) AS total_debet_sd,
									(
										SELECT
											COALESCE(SUM({$this->secondary_db}.tt.nominal), 0)
										FROM
											(
											SELECT
												{$this->secondary_db}.tb.id_transaksi_umum,
												{$this->secondary_db}.tb.nominal,
												{$this->secondary_db}.tb.nis_siswa,
												{$this->secondary_db}.tb.th_ajaran,
												{$this->secondary_db}.tdpb.informasi
											FROM
												{$this->secondary_db}.transaksi_tabungan_umum tb
											LEFT JOIN {$this->secondary_db}.tagihan_pembayaran_dpb tdpb ON
												{$this->secondary_db}.tb.nis_siswa = {$this->secondary_db}.tdpb.nomor_siswa
											WHERE
												{$this->secondary_db}.tb.status_kredit_debet = 2 AND {$this->secondary_db}.tdpb.informasi LIKE('%SMP%')
											GROUP BY
												{$this->secondary_db}.tb.id_transaksi_umum
										) tt
									WHERE
										{$this->secondary_db}.tt.th_ajaran = {$this->secondary_db}.th.id_tahun_ajaran
									) AS total_debet_smp,
									CONCAT(
										'TA. ',
										{$this->secondary_db}.th.tahun_awal,
										'/',
										{$this->secondary_db}.th.tahun_akhir
									) AS tahun
									FROM
										{$this->secondary_db}.tahun_ajaran th
									WHERE
										({$this->secondary_db}.th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND {$this->secondary_db}.th.semester = 'ganjil'
									ORDER BY
										{$this->secondary_db}.th.tahun_awal ASC");
        return $sql->result();
    }

    public function get_credit_debet_insight()
    {
        $sql = $this->db->query("SELECT
									th.*,
									(
									SELECT
										COALESCE(SUM({$this->secondary_db}.tt.nominal),0)
									FROM
										(
										SELECT
											{$this->secondary_db}.tb.id_transaksi_umum,
											{$this->secondary_db}.tb.nominal,
											{$this->secondary_db}.tb.nis_siswa,
											{$this->secondary_db}.tb.th_ajaran,
											{$this->secondary_db}.tdpb.informasi
										FROM
											{$this->secondary_db}.transaksi_tabungan_umum tb
										LEFT JOIN {$this->secondary_db}.tagihan_pembayaran_dpb tdpb ON
											{$this->secondary_db}.tb.nis_siswa = {$this->secondary_db}.tdpb.nomor_siswa
										WHERE
											{$this->secondary_db}.tb.status_kredit_debet = 1
										GROUP BY
											{$this->secondary_db}.tb.id_transaksi_umum
									) tt
								WHERE
									{$this->secondary_db}.tt.th_ajaran = {$this->secondary_db}.th.id_tahun_ajaran
								) AS total_kredit,
								(
									SELECT
										COALESCE(SUM(tt.nominal), 0)
									FROM
										(
										SELECT
											{$this->secondary_db}.tb.id_transaksi_umum,
											{$this->secondary_db}.tb.nominal,
											{$this->secondary_db}.tb.nis_siswa,
											{$this->secondary_db}.tb.th_ajaran,
											{$this->secondary_db}.tdpb.informasi
										FROM
											{$this->secondary_db}.transaksi_tabungan_umum tb
										LEFT JOIN {$this->secondary_db}.tagihan_pembayaran_dpb tdpb ON
											{$this->secondary_db}.tb.nis_siswa = {$this->secondary_db}.tdpb.nomor_siswa
										WHERE
											{$this->secondary_db}.tb.status_kredit_debet = 2
										GROUP BY
											{$this->secondary_db}.tb.id_transaksi_umum
									) tt
								WHERE
									{$this->secondary_db}.tt.th_ajaran = {$this->secondary_db}.th.id_tahun_ajaran
								) AS total_debet,
								CONCAT(
									'TA. ',
									{$this->secondary_db}.th.tahun_awal,
									'/',
									{$this->secondary_db}.th.tahun_akhir
								) AS tahun
								FROM
									{$this->secondary_db}.tahun_ajaran th
								WHERE
									({$this->secondary_db}.th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND {$this->secondary_db}.th.semester = 'ganjil'
								ORDER BY
									{$this->secondary_db}.th.tahun_awal ASC");
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
        $this->db2->select('nama_lengkap, nis, nis AS number');
        $sql = $this->db2->get($this->table_vstudent);
        return $sql->result();
    }

    public function get_employee()
    {
        $this->db2->select('nama_lengkap, nip, nip AS number');
        $this->db2->where('level_tingkat !=', '0');
        $sql = $this->db2->get($this->table_vemployee);
        return $sql->result();
    }

	public function get_permanent_employee()
    {
        $this->db2->select('nama_lengkap, nip, nip AS number');
        $this->db2->where('level_tingkat !=', '0');
		$this->db2->where('jenis_pegawai', '1');
        $sql = $this->db2->get($this->table_vemployee);
        return $sql->result();
    }

    // public function get_student_and_employee()
    // {
    //     $this->db2->select('s.nis AS number, s.nama_lengkap');
    //     $this->db2->from('view_siswa s');
    //     // Simpan query siswa
    //     $query1 = $this->db2->get_compiled_select();

    //     // Query kedua dari tabel pegawai
    //     $this->db2->select('p.nip AS number, p.nama_lengkap'); // Rename nip to nis for compatibility
    //     $this->db2->from('view_pegawai p');
    //     $this->db2->where('p.level_tingkat !=', '0');
    //     // Simpan query pegawai
    //     $query2 = $this->db2->get_compiled_select();

    //     // Gabungkan kedua query menggunakan UNION ALL
    //     $query = $this->db2->query($query1 . ' UNION ALL ' . $query2);

    //     return $query->result();
    // }

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

    public function get_student_and_employee_number($number = '')
    {
        // Query pertama dari tabel siswa dengan LIMIT 1
        $this->db2->select('s.nis, s.nama_lengkap');
        $this->db2->from('siswa s');
        $this->db2->where('s.nis', $number);

        $query1 = $this->db2->get_compiled_select();

        $this->db2->select('p.nip as nis, p.nama_lengkap'); // Nip sebagai alias nis untuk konsistensi kolom
        $this->db2->from('pegawai p');
        $this->db2->where('p.nip', $number);

        $query2 = $this->db2->get_compiled_select();

        $query = $this->db2->query($query1 . ' UNION ALL ' . $query2 . ' LIMIT 1');

        return $query->result();
    }

    public function get_employee_nip($nip_employee = '')
    {
        $this->db2->select('p.nip, p.nama_lengkap, p.password');
        $this->db2->from('pegawai p');
        $this->db2->where('p.nip', $nip_employee);
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

    public function get_employee_by_nip($nip_pegawai = '')
    {
        $this->db2->select('p.nip, p.id_jabatan, j.hasil_nama_jabatan, p.level_tingkat as id_tingkat, p.nama_lengkap, p.saldo_tabungan_umum, p.saldo_tabungan_qurban, p.saldo_tabungan_tht, p.email, p.jenis_kelamin, p.nomor_hp, p.jenis_pegawai');
        $this->db2->from('view_pegawai p');
        $this->db2->join('jabatan j', 'p.id_jabatan = j.id_jabatan', 'left');
        $this->db2->where('p.nip', $nip_pegawai);
        $this->db2->order_by('p.id_pegawai', 'DESC');
        $this->db2->limit(1);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_joint_saving_by_acc_number($acc_number = '')
    {
        $this->db2->select("tb.nomor_rekening_bersama, tb.nama_tabungan_bersama, tb.saldo_tabungan_bersama, tb.id_tingkat, tb.jenis_tabungan,
								COALESCE(NULLIF({$this->secondary_db}.s.nis, ''), {$this->secondary_db}.p.nip) AS number,
								COALESCE(NULLIF({$this->secondary_db}.s.nama_wali, ''), {$this->secondary_db}.p.nama_lengkap) AS nama_wali,
								COALESCE(NULLIF({$this->secondary_db}.s.nama_lengkap, ''), {$this->secondary_db}.p.nama_lengkap) AS nama_lengkap,
								COALESCE(NULLIF({$this->secondary_db}.s.nomor_handphone, ''), {$this->secondary_db}.p.nomor_hp) AS nomor_handphone,
								COALESCE(NULLIF({$this->secondary_db}.s.email, ''), {$this->secondary_db}.p.email) AS email");
        $this->db2->from('tabungan_bersama tb');
        $this->db2->join('siswa s', 'tb.id_penanggung_jawab = s.nis', 'left');
        $this->db2->join('pegawai p', 'tb.id_penanggung_jawab = p.nip', 'left');
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
    public function get_info_employee_transaction($nip_employee = '')
    {
        $this->db2->select("nip_pegawai, catatan, nominal, saldo, th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_umum_pegawai');
        $this->db2->where('nip_pegawai', $nip_employee);
        $this->db2->order_by('id_transaksi_umum_pegawai', 'DESC');
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

    public function get_info_employee_transaction_qurban($nip_employee = '')
    {
        $this->db2->select("nip_pegawai, catatan, nominal, saldo, th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_qurban_pegawai');
        $this->db2->where('nip_pegawai', $nip_employee);
        $this->db2->order_by('id_transaksi_qurban_pegawai', 'DESC');
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

    public function get_info_employee_transaction_tht($nip_employee = '')
    {
        $this->db2->select("nip_pegawai, catatan, nominal, saldo, th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_tht_pegawai');
        $this->db2->where('nip_pegawai', $nip_employee);
        $this->db2->order_by('id_transaksi_tht_pegawai', 'DESC');
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

	public function check_match_name_emp($name = '')
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
										s.saldo_tabungan_tht,
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
											{$this->secondary_db}.tt.id_transaksi_umum AS id_transaksi,
											{$this->secondary_db}.tt.nomor_transaksi_umum AS nomor_transaksi,
											{$this->secondary_db}.tt.nis_siswa,
											{$this->secondary_db}.tt.id_tingkat,
											{$this->secondary_db}.s.nama_lengkap,
											{$this->default_db}.ak.nama_akun,
											{$this->default_db}.ak.email_akun,
											{$this->secondary_db}.tt.saldo,
											{$this->secondary_db}.tt.jenis_tabungan,
											{$this->secondary_db}.tt.catatan,
											{$this->secondary_db}.tt.nominal,
											{$this->secondary_db}.tt.status_kredit_debet,
											CONCAT(
												{$this->secondary_db}.ta.tahun_awal,
												'/',
												{$this->secondary_db}.ta.tahun_akhir
											) AS tahun_ajaran,
											{$this->secondary_db}.tt.th_ajaran,
											{$this->secondary_db}.tt.tanggal_transaksi,
											DATE_FORMAT(
												{$this->secondary_db}.tt.waktu_transaksi,
												'%d/%m/%Y %H:%i:%s'
											) AS waktu_transaksi,
											CASE WHEN EXISTS(
											SELECT
												{$this->secondary_db}.vmax.id_max
											FROM
												{$this->secondary_db}.view_max_id_transaction_general vmax
											WHERE
												{$this->secondary_db}.tt.id_transaksi_umum = {$this->secondary_db}.vmax.id_max
										) THEN 1 ELSE 0
									END AS status_edit
									FROM
										{$this->secondary_db}.transaksi_tabungan_umum tt
									LEFT JOIN {$this->secondary_db}.siswa s
									ON
										{$this->secondary_db}.s.nis = {$this->secondary_db}.tt.nis_siswa
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
									ON
										{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
									LEFT JOIN {$this->default_db}.akun_keuangan ak
									ON
										{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
										WHERE {$this->secondary_db}.tt.nis_siswa = $nis AND
										(
											DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%Y-%m-%d'
											) BETWEEN '$start_date' AND '$end_date'
										)
									UNION ALL
									SELECT
										{$this->secondary_db}.tt.id_transaksi_qurban AS id_transaksi,
										{$this->secondary_db}.tt.nomor_transaksi_qurban AS nomor_transaksi,
										{$this->secondary_db}.tt.nis_siswa,
										{$this->secondary_db}.tt.id_tingkat,
										{$this->secondary_db}.s.nama_lengkap,
										{$this->default_db}.ak.nama_akun,
										{$this->default_db}.ak.email_akun,
										{$this->secondary_db}.tt.saldo,
										{$this->secondary_db}.tt.jenis_tabungan,
										{$this->secondary_db}.tt.catatan,
										{$this->secondary_db}.tt.nominal,
										{$this->secondary_db}.tt.status_kredit_debet,
										CONCAT(
											{$this->secondary_db}.ta.tahun_awal,
											'/',
											{$this->secondary_db}.ta.tahun_akhir
										) AS tahun_ajaran,
										{$this->secondary_db}.tt.th_ajaran,
										{$this->secondary_db}.tt.tanggal_transaksi,
										DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											{$this->secondary_db}.vmax.id_max
										FROM
											{$this->secondary_db}.view_max_id_transaction_qurban vmax
										WHERE
											{$this->secondary_db}.tt.id_transaksi_qurban = {$this->secondary_db}.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										{$this->secondary_db}.transaksi_tabungan_qurban tt
									LEFT JOIN {$this->secondary_db}.siswa s
									ON
										{$this->secondary_db}.s.nis = {$this->secondary_db}.tt.nis_siswa
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
									ON
										{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
									LEFT JOIN {$this->default_db}.akun_keuangan ak
									ON
										{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
										WHERE {$this->secondary_db}.tt.nis_siswa = $nis AND
										(
											DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
										)
									UNION ALL
									SELECT
										{$this->secondary_db}.tt.id_transaksi_wisata AS id_transaksi,
										{$this->secondary_db}.tt.nomor_transaksi_wisata AS nomor_transaksi,
										{$this->secondary_db}.tt.nis_siswa,
										{$this->secondary_db}.tt.id_tingkat,
										{$this->secondary_db}.s.nama_lengkap,
										{$this->default_db}.ak.nama_akun,
										{$this->default_db}.ak.email_akun,
										{$this->secondary_db}.tt.saldo,
										{$this->secondary_db}.tt.jenis_tabungan,
										{$this->secondary_db}.tt.catatan,
										{$this->secondary_db}.tt.nominal,
										{$this->secondary_db}.tt.status_kredit_debet,
										CONCAT(
											{$this->secondary_db}.ta.tahun_awal,
											'/',
											{$this->secondary_db}.ta.tahun_akhir
										) AS tahun_ajaran,
										{$this->secondary_db}.tt.th_ajaran,
										{$this->secondary_db}.tt.tanggal_transaksi,
										DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											{$this->secondary_db}.vmax.id_max
										FROM
											{$this->secondary_db}.view_max_id_transaction_tour vmax
										WHERE
											{$this->secondary_db}.tt.id_transaksi_wisata = {$this->secondary_db}.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										{$this->secondary_db}.transaksi_tabungan_wisata tt
									LEFT JOIN {$this->secondary_db}.siswa s
									ON
										{$this->secondary_db}.s.nis = {$this->secondary_db}.tt.nis_siswa
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
									ON
										{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
									LEFT JOIN {$this->default_db}.akun_keuangan ak
									ON
										{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
										WHERE {$this->secondary_db}.tt.nis_siswa = $nis AND
										(
											DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
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

    public function get_employee_transaction_recap_by_nip($nip = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
										id_transaksi,
										nomor_transaksi,
										nip_pegawai,
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
											{$this->secondary_db}.tt.id_transaksi_umum_pegawai AS id_transaksi,
											{$this->secondary_db}.tt.nomor_transaksi_umum AS nomor_transaksi,
											{$this->secondary_db}.tt.nip_pegawai,
											{$this->secondary_db}.tt.id_tingkat,
											{$this->secondary_db}.p.nama_lengkap,
											{$this->default_db}.ak.nama_akun,
											{$this->default_db}.ak.email_akun,
											{$this->secondary_db}.tt.saldo,
											{$this->secondary_db}.tt.jenis_tabungan,
											{$this->secondary_db}.tt.catatan,
											{$this->secondary_db}.tt.nominal,
											{$this->secondary_db}.tt.status_kredit_debet,
											CONCAT(
												{$this->secondary_db}.ta.tahun_awal,
												'/',
												{$this->secondary_db}.ta.tahun_akhir
											) AS tahun_ajaran,
											{$this->secondary_db}.tt.th_ajaran,
											{$this->secondary_db}.tt.tanggal_transaksi,
											DATE_FORMAT(
												{$this->secondary_db}.tt.waktu_transaksi,
												'%d/%m/%Y %H:%i:%s'
											) AS waktu_transaksi,
											CASE WHEN EXISTS(
											SELECT
												{$this->secondary_db}.vmax.id_max
											FROM
												{$this->secondary_db}.view_max_id_transaction_general_employee vmax
											WHERE
												{$this->secondary_db}.tt.id_transaksi_umum_pegawai = {$this->secondary_db}.vmax.id_max
										) THEN 1 ELSE 0
									END AS status_edit
									FROM
										{$this->secondary_db}.transaksi_tabungan_umum_pegawai tt
									LEFT JOIN {$this->secondary_db}.pegawai p
									ON
										{$this->secondary_db}.p.nip = {$this->secondary_db}.tt.nip_pegawai
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
									ON
										{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
									LEFT JOIN {$this->default_db}.akun_keuangan ak
									ON
										{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
										WHERE {$this->secondary_db}.tt.nip_pegawai = $nip AND
										(
											DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%Y-%m-%d'
											) BETWEEN '$start_date' AND '$end_date'
										)
									UNION ALL
									SELECT
										{$this->secondary_db}.tt.id_transaksi_qurban_pegawai AS id_transaksi,
										{$this->secondary_db}.tt.nomor_transaksi_qurban AS nomor_transaksi,
										{$this->secondary_db}.tt.nip_pegawai,
										{$this->secondary_db}.tt.id_tingkat,
										{$this->secondary_db}.p.nama_lengkap,
										{$this->default_db}.ak.nama_akun,
										{$this->default_db}.ak.email_akun,
										{$this->secondary_db}.tt.saldo,
										{$this->secondary_db}.tt.jenis_tabungan,
										{$this->secondary_db}.tt.catatan,
										{$this->secondary_db}.tt.nominal,
										{$this->secondary_db}.tt.status_kredit_debet,
										CONCAT(
											{$this->secondary_db}.ta.tahun_awal,
											'/',
											{$this->secondary_db}.ta.tahun_akhir
										) AS tahun_ajaran,
										{$this->secondary_db}.tt.th_ajaran,
										{$this->secondary_db}.tt.tanggal_transaksi,
										DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											{$this->secondary_db}.vmax.id_max
										FROM
											{$this->secondary_db}.view_max_id_transaction_qurban_employee vmax
										WHERE
											{$this->secondary_db}.tt.id_transaksi_qurban_pegawai = {$this->secondary_db}.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										{$this->secondary_db}.transaksi_tabungan_qurban_pegawai tt
									LEFT JOIN {$this->secondary_db}.pegawai p
									ON
										{$this->secondary_db}.p.nip = {$this->secondary_db}.tt.nip_pegawai
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
									ON
										{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
									LEFT JOIN {$this->default_db}.akun_keuangan ak
									ON
										{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
										WHERE {$this->secondary_db}.tt.nip_pegawai = $nip AND
										(
											DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
										)
									UNION ALL
									SELECT
										{$this->secondary_db}.tt.id_transaksi_tht_pegawai AS id_transaksi,
										{$this->secondary_db}.tt.nomor_transaksi_tht AS nomor_transaksi,
										{$this->secondary_db}.tt.nip_pegawai,
										{$this->secondary_db}.tt.id_tingkat,
										{$this->secondary_db}.p.nama_lengkap,
										{$this->default_db}.ak.nama_akun,
										{$this->default_db}.ak.email_akun,
										{$this->secondary_db}.tt.saldo,
										{$this->secondary_db}.tt.jenis_tabungan,
										{$this->secondary_db}.tt.catatan,
										{$this->secondary_db}.tt.nominal,
										{$this->secondary_db}.tt.status_kredit_debet,
										CONCAT(
											{$this->secondary_db}.ta.tahun_awal,
											'/',
											{$this->secondary_db}.ta.tahun_akhir
										) AS tahun_ajaran,
										{$this->secondary_db}.tt.th_ajaran,
										{$this->secondary_db}.tt.tanggal_transaksi,
										DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											{$this->secondary_db}.vmax.id_max
										FROM
											{$this->secondary_db}.view_max_id_transaction_tht_employee vmax
										WHERE
											{$this->secondary_db}.tt.id_transaksi_tht_pegawai = {$this->secondary_db}.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										{$this->secondary_db}.transaksi_tabungan_tht_pegawai tt
									LEFT JOIN {$this->secondary_db}.pegawai p
									ON
										{$this->secondary_db}.p.nip = {$this->secondary_db}.tt.nip_pegawai
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
									ON
										{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
									LEFT JOIN {$this->default_db}.akun_keuangan ak
									ON
										{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
										WHERE {$this->secondary_db}.tt.nip_pegawai = $nip AND
										(
											DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
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
										{$this->secondary_db}.ttb.id_transaksi_bersama,
										{$this->secondary_db}.ttb.id_tingkat,
										{$this->secondary_db}.ttb.nomor_rekening_bersama,
										{$this->secondary_db}.ttb.nomor_transaksi_bersama,
										{$this->secondary_db}.tb.nama_tabungan_bersama,
										{$this->secondary_db}.tb.jenis_tabungan,
										COALESCE(NULLIF({$this->secondary_db}.s.nama_wali, ''), {$this->secondary_db}.p.nama_lengkap) AS nama_wali,
										COALESCE(NULLIF({$this->secondary_db}.s.nama_lengkap, ''), {$this->secondary_db}.p.nama_lengkap) AS nama_lengkap,
										COALESCE(NULLIF({$this->secondary_db}.s.nomor_handphone, ''), {$this->secondary_db}.p.nomor_hp) AS nomor_handphone,
										COALESCE(NULLIF({$this->secondary_db}.s.email, ''), {$this->secondary_db}.p.email) AS email,
										{$this->default_db}.ak.nama_akun,
										{$this->default_db}.ak.email_akun,
										{$this->secondary_db}.ttb.saldo,
										{$this->secondary_db}.ttb.catatan,
										{$this->secondary_db}.ttb.nominal,
										{$this->secondary_db}.ttb.status_kredit_debet,
										CONCAT(
											{$this->secondary_db}.ta.tahun_awal,
											'/',
											{$this->secondary_db}.ta.tahun_akhir
										) AS tahun_ajaran,
										{$this->secondary_db}.ttb.th_ajaran,
										{$this->secondary_db}.ttb.tanggal_transaksi,
										DATE_FORMAT(
											{$this->secondary_db}.ttb.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											{$this->secondary_db}.vmax.id_max
										FROM
											{$this->secondary_db}.view_max_id_transaction_joint vmax
										WHERE
											{$this->secondary_db}.ttb.id_transaksi_bersama = {$this->secondary_db}.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										{$this->secondary_db}.transaksi_tabungan_bersama ttb
									LEFT JOIN {$this->secondary_db}.tabungan_bersama tb
									ON
										{$this->secondary_db}.tb.nomor_rekening_bersama = {$this->secondary_db}.ttb.nomor_rekening_bersama
									LEFT JOIN {$this->secondary_db}.siswa s
									ON
										{$this->secondary_db}.s.nis = {$this->secondary_db}.tb.id_penanggung_jawab
									LEFT JOIN
										{$this->secondary_db}.pegawai p
									ON
										{$this->secondary_db}.p.nip = {$this->secondary_db}.tb.id_penanggung_jawab
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
									ON
										{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.ttb.th_ajaran
									LEFT JOIN {$this->default_db}.akun_keuangan ak
									ON
										{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.ttb.id_pegawai
									WHERE
									{$this->secondary_db}.tb.nomor_rekening_bersama = $norek AND
										(
											DATE_FORMAT(
											{$this->secondary_db}.ttb.waktu_transaksi,
											'%Y-%m-%d'
											) BETWEEN '$start_date' AND '$end_date'
										)
									ORDER BY
										{$this->secondary_db}.ttb.id_transaksi_bersama
									DESC
										");
        return $sql->result();
    }

    public function get_all_import_personal_customer()
    {
        $sql = $this->db2->query("SELECT
										{$this->secondary_db}.n.id_nasabah,
										{$this->secondary_db}.n.nis,
										{$this->secondary_db}.n.nama_nasabah,
										{$this->secondary_db}.n.tanggal_transaksi,
										{$this->secondary_db}.n.tingkat,
										{$this->secondary_db}.n.nama_wali,
										{$this->secondary_db}.n.nomor_hp_wali,
										{$this->secondary_db}.n.email_nasabah,
										{$this->secondary_db}.n.saldo_umum,
										{$this->secondary_db}.n.saldo_qurban,
										{$this->secondary_db}.n.saldo_wisata,
										{$this->secondary_db}.n.status_nasabah,
										{$this->secondary_db}.n.status_nama_nasabah,
										{$this->secondary_db}.n.tahun_ajaran,
										{$this->secondary_db}.n.status_siswa,
										CONCAT(
                                        {$this->secondary_db}.ta.tahun_awal,
                                        '/',
                                        {$this->secondary_db}.ta.tahun_akhir
                                    	) AS nama_tahun_ajaran
									FROM
										{$this->secondary_db}.import_nasabah_personal n
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
                                	ON
                                    	{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.n.tahun_ajaran
									ORDER BY
										{$this->secondary_db}.n.id_nasabah
									ASC");
        return $sql->result();
    }

    public function get_all_import_employee_customer()
    {
        $sql = $this->db2->query("SELECT
										{$this->secondary_db}.n.id_nasabah,
										{$this->secondary_db}.n.nip,
										{$this->secondary_db}.n.nama_nasabah,
										{$this->secondary_db}.n.tanggal_transaksi,
										{$this->secondary_db}.n.tingkat,
										{$this->secondary_db}.n.jenis_kelamin,
										{$this->secondary_db}.n.nomor_hp_pegawai,
										{$this->secondary_db}.n.email_nasabah,
										{$this->secondary_db}.n.saldo_umum,
										{$this->secondary_db}.n.saldo_qurban,
										{$this->secondary_db}.n.saldo_tht,
										{$this->secondary_db}.n.status_pegawai,
										{$this->secondary_db}.n.status_nasabah,
										{$this->secondary_db}.n.status_nama_nasabah,
										{$this->secondary_db}.n.tahun_ajaran,
										CONCAT(
                                        {$this->secondary_db}.ta.tahun_awal,
                                        '/',
                                        {$this->secondary_db}.ta.tahun_akhir
                                    	) AS nama_tahun_ajaran
									FROM
										{$this->secondary_db}.import_nasabah_pegawai n
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
                                	ON
                                    	{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.n.tahun_ajaran
									ORDER BY
										{$this->secondary_db}.n.id_nasabah
									ASC");
        return $sql->result();
    }

    public function get_all_personal_customer($start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										{$this->secondary_db}.s.id_siswa,
										{$this->secondary_db}.s.nis,
										{$this->secondary_db}.s.level_tingkat,
										{$this->secondary_db}.s.nama_lengkap,
										{$this->secondary_db}.s.jenis_kelamin,
										{$this->secondary_db}.s.nomor_handphone,
										{$this->secondary_db}.s.email,
										{$this->secondary_db}.s.jalur,
										{$this->secondary_db}.s.th_ajaran,
										{$this->secondary_db}.s.status_siswa,
										(
										SELECT
											COALESCE(SUM({$this->secondary_db}.ttu.nominal),
											0)
										FROM
											{$this->secondary_db}.transaksi_tabungan_umum ttu
										WHERE
											{$this->secondary_db}.ttu.nis_siswa = {$this->secondary_db}.s.nis AND {$this->secondary_db}.ttu.status_kredit_debet = 1 AND(
											DATE_FORMAT(
											{$this->secondary_db}.ttu.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
                                            )
										) AS kredit_umum,
										(
											SELECT
												COALESCE(SUM({$this->secondary_db}.ttu.nominal),
												0)
											FROM
												{$this->secondary_db}.transaksi_tabungan_umum ttu
											WHERE
												{$this->secondary_db}.ttu.nis_siswa = {$this->secondary_db}.s.nis AND {$this->secondary_db}.ttu.status_kredit_debet = 2 AND(
													DATE_FORMAT(
                                                    {$this->secondary_db}.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_umum,
										(
											SELECT
												COALESCE({$this->secondary_db}.ttu.saldo, 0)
											FROM {$this->secondary_db}.transaksi_tabungan_umum ttu
											WHERE
												{$this->secondary_db}.ttu.nis_siswa = {$this->secondary_db}.s.nis AND(
													DATE_FORMAT(
                                                    {$this->secondary_db}.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												{$this->secondary_db}.ttu.id_transaksi_umum
											DESC LIMIT 1
										) AS saldo_umum,
										(
										SELECT
											COALESCE(SUM({$this->secondary_db}.ttq.nominal),
											0)
										FROM
											{$this->secondary_db}.transaksi_tabungan_qurban ttq
										WHERE
											{$this->secondary_db}.ttq.nis_siswa = {$this->secondary_db}.s.nis AND ttq.status_kredit_debet = 1 AND(
												DATE_FORMAT(
                                                {$this->secondary_db}.ttq.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
											)
										) AS kredit_qurban,
										(
											SELECT
												COALESCE(SUM({$this->secondary_db}.ttq.nominal),
												0)
											FROM
												{$this->secondary_db}.transaksi_tabungan_qurban ttq
											WHERE
												{$this->secondary_db}.ttq.nis_siswa = s.nis AND {$this->secondary_db}.ttq.status_kredit_debet = 2 AND(
												DATE_FORMAT(
											    {$this->secondary_db}.ttq.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
											)
										) AS debet_qurban,
										(
											SELECT
												COALESCE({$this->secondary_db}.ttq.saldo, 0)
											FROM
												{$this->secondary_db}.transaksi_tabungan_qurban ttq
											WHERE
												{$this->secondary_db}.ttq.nis_siswa = {$this->secondary_db}.s.nis AND(
													DATE_FORMAT(
                                                    {$this->secondary_db}.ttq.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												{$this->secondary_db}.ttq.id_transaksi_qurban
											DESC LIMIT 1
										) AS saldo_qurban,
										(
										SELECT
											COALESCE(SUM({$this->secondary_db}.ttw.nominal),
											0)
										FROM
											{$this->secondary_db}.transaksi_tabungan_wisata ttw
										WHERE
											{$this->secondary_db}.ttw.nis_siswa = {$this->secondary_db}.s.nis AND {$this->secondary_db}.ttw.status_kredit_debet = 1 AND(
												DATE_FORMAT(
                                                {$this->secondary_db}.ttw.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
											)
										) AS kredit_wisata,
										(
											SELECT
												COALESCE(SUM({$this->secondary_db}.ttw.nominal),
												0)
											FROM
												{$this->secondary_db}.transaksi_tabungan_wisata ttw
											WHERE
												ttw.nis_siswa = s.nis AND ttw.status_kredit_debet = 2 AND(
													DATE_FORMAT(
                                                    {$this->secondary_db}.ttw.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_wisata,
										(
											SELECT
												COALESCE({$this->secondary_db}.ttw.saldo, 0)
											FROM
												{$this->secondary_db}.transaksi_tabungan_wisata ttw
											WHERE
												{$this->secondary_db}.ttw.nis_siswa = {$this->secondary_db}.s.nis AND(
													DATE_FORMAT(
                                                    {$this->secondary_db}.ttw.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												{$this->secondary_db}.ttw.id_transaksi_wisata
											DESC LIMIT 1
										) AS saldo_wisata,
										{$this->secondary_db}.s.nama_wali,
										CONCAT(
                                        {$this->secondary_db}.ta.tahun_awal,
                                        '/',
                                        {$this->secondary_db}.ta.tahun_akhir
                                    	) AS tahun_ajaran
									FROM
										siswa s
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
                                	ON
                                    	{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.s.th_ajaran
									ORDER BY
										{$this->secondary_db}.s.id_siswa
									DESC");
        return $sql->result();
    }

    public function get_all_employee_customer($start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										{$this->secondary_db}.p.id_pegawai,
										{$this->secondary_db}.p.id_jabatan,
										{$this->secondary_db}.p.nip,
										{$this->secondary_db}.p.level_tingkat,
										{$this->secondary_db}.p.nama_lengkap,
										{$this->secondary_db}.p.jenis_kelamin,
										{$this->secondary_db}.p.nomor_hp,
										{$this->secondary_db}.p.email,
										{$this->secondary_db}.p.jenis_pegawai,
										{$this->secondary_db}.p.th_ajaran,
										{$this->secondary_db}.jb.id_jabatan,
										{$this->secondary_db}.jb.hasil_nama_jabatan,
										(
										SELECT
											COALESCE(SUM({$this->secondary_db}.ttu.nominal),
											0)
										FROM
											{$this->secondary_db}.transaksi_tabungan_umum_pegawai ttu
										WHERE
											{$this->secondary_db}.ttu.nip_pegawai = {$this->secondary_db}.p.nip AND {$this->secondary_db}.ttu.status_kredit_debet = 1 AND(
											DATE_FORMAT(
											{$this->secondary_db}.ttu.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
                                            )
										) AS kredit_umum,
										(
											SELECT
												COALESCE(SUM({$this->secondary_db}.ttu.nominal),
												0)
											FROM
												{$this->secondary_db}.transaksi_tabungan_umum_pegawai ttu
											WHERE
												{$this->secondary_db}.ttu.nip_pegawai = {$this->secondary_db}.p.nip AND {$this->secondary_db}.ttu.status_kredit_debet = 2 AND(
													DATE_FORMAT(
                                                    {$this->secondary_db}.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_umum,
										(
											SELECT
												COALESCE({$this->secondary_db}.ttu.saldo, 0)
											FROM {$this->secondary_db}.transaksi_tabungan_umum_pegawai ttu
											WHERE
												{$this->secondary_db}.ttu.nip_pegawai = {$this->secondary_db}.p.nip AND(
													DATE_FORMAT(
                                                    {$this->secondary_db}.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												{$this->secondary_db}.ttu.id_transaksi_umum_pegawai
											DESC LIMIT 1
										) AS saldo_umum,

										(
										SELECT
											COALESCE(SUM({$this->secondary_db}.ttt.nominal),
											0)
										FROM
											{$this->secondary_db}.transaksi_tabungan_tht_pegawai ttt
										WHERE
											{$this->secondary_db}.ttt.nip_pegawai = {$this->secondary_db}.p.nip AND {$this->secondary_db}.ttt.status_kredit_debet = 1 AND(
											DATE_FORMAT(
											{$this->secondary_db}.ttt.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
                                            )
										) AS kredit_tht,
										(
											SELECT
												COALESCE(SUM({$this->secondary_db}.ttt.nominal),
												0)
											FROM
												{$this->secondary_db}.transaksi_tabungan_tht_pegawai ttt
											WHERE
												{$this->secondary_db}.ttt.nip_pegawai = {$this->secondary_db}.p.nip AND {$this->secondary_db}.ttt.status_kredit_debet = 2 AND(
													DATE_FORMAT(
                                                    {$this->secondary_db}.ttt.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_umum,
										(
											SELECT
												COALESCE({$this->secondary_db}.ttt.saldo, 0)
											FROM {$this->secondary_db}.transaksi_tabungan_tht_pegawai ttt
											WHERE
												{$this->secondary_db}.ttt.nip_pegawai = {$this->secondary_db}.p.nip AND(
													DATE_FORMAT(
                                                    {$this->secondary_db}.ttt.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												{$this->secondary_db}.ttt.id_transaksi_tht_pegawai
											DESC LIMIT 1
										) AS saldo_tht,
										CONCAT(
                                        {$this->secondary_db}.ta.tahun_awal,
                                        '/',
                                        {$this->secondary_db}.ta.tahun_akhir
                                    	) AS tahun_ajaran
									FROM
										pegawai p
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
                                	ON
                                    	{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.p.th_ajaran
									LEFT JOIN {$this->secondary_db}.jabatan jb
                                	ON
                                    	{$this->secondary_db}.jb.id_jabatan = {$this->secondary_db}.p.id_jabatan
									WHERE p.level_tingkat != '0'
									ORDER BY
										{$this->secondary_db}.p.id_pegawai
									DESC");
        return $sql->result();
    }

    public function get_all_import_joint_customer()
    {
        $sql = $this->db2->query("SELECT
										{$this->secondary_db}.tb.id_nasabah_bersama,
										{$this->secondary_db}.tb.id_penanggung_jawab,
										{$this->secondary_db}.tb.nomor_rekening_bersama,
										{$this->secondary_db}.tb.nama_tabungan_bersama,
										{$this->secondary_db}.tb.tingkat,
										{$this->secondary_db}.tb.tahun_ajaran,
										{$this->secondary_db}.tb.nama_wali,
										{$this->secondary_db}.tb.jenis_tabungan,
										{$this->secondary_db}.tb.nama_tabungan_bersama,
										{$this->secondary_db}.tb.saldo_bersama,
										{$this->secondary_db}.tb.nomor_hp_wali,
										{$this->secondary_db}.tb.tanggal_transaksi,
										{$this->secondary_db}.tb.status_nasabah_bersama,
										{$this->secondary_db}.tb.status_penanggung_jawab,
										COALESCE(NULLIF({$this->secondary_db}.s.nama_lengkap, ''), {$this->secondary_db}.p.nama_lengkap) AS nama_lengkap,  -- Use COALESCE and NULLIF to get the right name
										CONCAT(
											{$this->secondary_db}.ta.tahun_awal,
											'/',
											{$this->secondary_db}.ta.tahun_akhir
										) AS nama_tahun_ajaran
									FROM
										{$this->secondary_db}.import_nasabah_bersama tb
									LEFT JOIN
										{$this->secondary_db}.siswa s ON {$this->secondary_db}.s.nis = {$this->secondary_db}.tb.id_penanggung_jawab
									LEFT JOIN
										{$this->secondary_db}.tahun_ajaran ta ON {$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tb.tahun_ajaran
									LEFT JOIN
										{$this->secondary_db}.pegawai p ON {$this->secondary_db}.p.nip = {$this->secondary_db}.tb.id_penanggung_jawab  -- Joining pegawai to get employee name
									ORDER BY
										{$this->secondary_db}.tb.id_nasabah_bersama ASC");
        return $sql->result();
    }

    public function get_all_joint_customer($start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										{$this->secondary_db}.tb.id_tabungan_bersama,
										{$this->secondary_db}.tb.id_penanggung_jawab,
										{$this->secondary_db}.tb.nomor_rekening_bersama,
										{$this->secondary_db}.tb.nama_tabungan_bersama,
										{$this->secondary_db}.tb.keterangan_tabungan_bersama,
										{$this->secondary_db}.tb.id_tingkat,
										{$this->secondary_db}.tb.jenis_tabungan,
										{$this->secondary_db}.tb.id_th_ajaran,
										COALESCE(NULLIF({$this->secondary_db}.s.nama_wali, ''), {$this->secondary_db}.p.nama_lengkap) AS nama_wali,
										COALESCE(NULLIF({$this->secondary_db}.s.nama_lengkap, ''), {$this->secondary_db}.p.nama_lengkap) AS nama_lengkap,
										COALESCE(NULLIF({$this->secondary_db}.s.nomor_handphone, ''), {$this->secondary_db}.p.nomor_hp) AS nomor_handphone,
										COALESCE(NULLIF({$this->secondary_db}.s.email, ''), {$this->secondary_db}.p.email) AS email,
										(
										SELECT
											COALESCE(SUM({$this->secondary_db}.ttb.nominal),
											0)
										FROM
											{$this->secondary_db}.transaksi_tabungan_bersama ttb
										WHERE
											{$this->secondary_db}.ttb.nomor_rekening_bersama = {$this->secondary_db}.tb.nomor_rekening_bersama AND {$this->secondary_db}.ttb.status_kredit_debet = 1 AND(
												DATE_FORMAT(
                                                {$this->secondary_db}.ttb.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
											)
									) AS kredit_bersama,
									(
										SELECT
											COALESCE(SUM({$this->secondary_db}.ttb.nominal),
											0)
										FROM
											{$this->secondary_db}.transaksi_tabungan_bersama ttb
										WHERE
											{$this->secondary_db}.ttb.nomor_rekening_bersama = {$this->secondary_db}.tb.nomor_rekening_bersama AND {$this->secondary_db}.ttb.status_kredit_debet = 2 AND(
												DATE_FORMAT(
                                                {$this->secondary_db}.ttb.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_bersama,
									(
										SELECT
											COALESCE(ttb.nominal, 0)
										FROM
											{$this->secondary_db}.transaksi_tabungan_bersama ttb
										WHERE
											{$this->secondary_db}.ttb.nomor_rekening_bersama = {$this->secondary_db}.tb.nomor_rekening_bersama AND(
												DATE_FORMAT(
													{$this->secondary_db}.ttb.waktu_transaksi,
													'%Y-%m-%d'
												) BETWEEN '$start_date' AND '$end_date'
											)
										ORDER BY
											{$this->secondary_db}.ttb.id_transaksi_bersama
										DESC
									LIMIT 1
									) AS saldo_bersama,
									CONCAT(
										{$this->secondary_db}.ta.tahun_awal,
										'/',
										{$this->secondary_db}.ta.tahun_akhir
									) AS tahun_ajaran
									FROM
										tabungan_bersama tb
									LEFT JOIN {$this->secondary_db}.siswa s
									ON
										{$this->secondary_db}.s.nis = {$this->secondary_db}.tb.id_penanggung_jawab
									LEFT JOIN
										{$this->secondary_db}.pegawai p
									ON
										{$this->secondary_db}.p.nip = {$this->secondary_db}.tb.id_penanggung_jawab
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
									ON
										{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tb.id_th_ajaran
									ORDER BY
										{$this->secondary_db}.tb.id_tabungan_bersama
									DESC");
        return $sql->result();
    }

    public function get_all_general_transaction_savings($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
                                    {$this->secondary_db}.tt.id_transaksi_umum,
									{$this->secondary_db}.tt.nomor_transaksi_umum,
                                    {$this->secondary_db}.tt.nis_siswa,
									{$this->secondary_db}.tt.id_tingkat,
                                    {$this->secondary_db}.s.nama_lengkap,
                                    {$this->default_db}.ak.nama_akun,
                                    {$this->default_db}.ak.email_akun,
                                    {$this->secondary_db}.tt.saldo,
									{$this->secondary_db}.tt.jenis_tabungan,
                                    {$this->secondary_db}.tt.catatan,
                                    {$this->secondary_db}.tt.nominal,
                                    {$this->secondary_db}.tt.status_kredit_debet,
                                    CONCAT(
                                        {$this->secondary_db}.ta.tahun_awal,
                                        '/',
                                        {$this->secondary_db}.ta.tahun_akhir
                                    ) AS tahun_ajaran,
									{$this->secondary_db}.tt.th_ajaran,
                                    {$this->secondary_db}.tt.tanggal_transaksi,
                                    DATE_FORMAT({$this->secondary_db}.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
                                    CASE WHEN EXISTS(
                                    SELECT
                                        {$this->secondary_db}.vmax.id_max
                                    FROM
                                        {$this->secondary_db}.view_max_id_transaction_general vmax
                                    WHERE
                                        {$this->secondary_db}.tt.id_transaksi_umum = {$this->secondary_db}.vmax.id_max
                                ) THEN 1 ELSE 0
                                END AS status_edit
                                FROM
                                    {$this->secondary_db}.transaksi_tabungan_umum tt
                                LEFT JOIN {$this->secondary_db}.siswa s
                                ON
                                    {$this->secondary_db}.s.nis = {$this->secondary_db}.tt.nis_siswa
                                LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
                                ON
                                    {$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
                                LEFT JOIN {$this->default_db}.akun_keuangan ak
                                ON
                                    {$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
									WHERE
									(
										DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    {$this->secondary_db}.tt.id_transaksi_umum
                                DESC");
        return $sql->result();
    }

    public function get_all_general_transaction_savings_employee($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
                                    {$this->secondary_db}.tt.id_transaksi_umum_pegawai,
									{$this->secondary_db}.tt.nomor_transaksi_umum,
                                    {$this->secondary_db}.tt.nip_pegawai,
									{$this->secondary_db}.tt.id_tingkat,
                                    {$this->secondary_db}.p.nama_lengkap,
                                    {$this->default_db}.ak.nama_akun,
                                    {$this->default_db}.ak.email_akun,
                                    {$this->secondary_db}.tt.saldo,
									{$this->secondary_db}.tt.jenis_tabungan,
                                    {$this->secondary_db}.tt.catatan,
                                    {$this->secondary_db}.tt.nominal,
                                    {$this->secondary_db}.tt.status_kredit_debet,
                                    CONCAT(
                                        {$this->secondary_db}.ta.tahun_awal,
                                        '/',
                                        {$this->secondary_db}.ta.tahun_akhir
                                    ) AS tahun_ajaran,
									{$this->secondary_db}.tt.th_ajaran,
                                    {$this->secondary_db}.tt.tanggal_transaksi,
                                    DATE_FORMAT({$this->secondary_db}.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
                                    CASE WHEN EXISTS(
                                    SELECT
                                        {$this->secondary_db}.vmax.id_max
                                    FROM
                                        {$this->secondary_db}.view_max_id_transaction_general_employee vmax
                                    WHERE
                                        {$this->secondary_db}.tt.id_transaksi_umum_pegawai = {$this->secondary_db}.vmax.id_max
                                ) THEN 1 ELSE 0
                                END AS status_edit
                                FROM
                                    {$this->secondary_db}.transaksi_tabungan_umum_pegawai tt
                                LEFT JOIN {$this->secondary_db}.pegawai p
                                ON
                                    {$this->secondary_db}.p.nip = {$this->secondary_db}.tt.nip_pegawai
                                LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
                                ON
                                    {$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
                                LEFT JOIN {$this->default_db}.akun_keuangan ak
                                ON
                                    {$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
									WHERE
									(
										DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    {$this->secondary_db}.tt.id_transaksi_umum_pegawai
                                DESC");
        return $sql->result();
    }

    public function get_all_qurban_transaction_savings($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
                                    {$this->secondary_db}.tt.id_transaksi_qurban,
									{$this->secondary_db}.tt.nomor_transaksi_qurban,
                                    {$this->secondary_db}.tt.nis_siswa,
									{$this->secondary_db}.tt.id_tingkat,
                                    {$this->secondary_db}.s.nama_lengkap,
                                    {$this->default_db}.ak.nama_akun,
                                    {$this->default_db}.ak.email_akun,
                                    {$this->secondary_db}.tt.saldo,
									{$this->secondary_db}.tt.jenis_tabungan,
                                    {$this->secondary_db}.tt.catatan,
                                    {$this->secondary_db}.tt.nominal,
                                    {$this->secondary_db}.tt.status_kredit_debet,
                                    CONCAT(
                                        {$this->secondary_db}.ta.tahun_awal,
                                        '/',
                                        {$this->secondary_db}.ta.tahun_akhir
                                    ) AS tahun_ajaran,
									{$this->secondary_db}.tt.th_ajaran,
                                    {$this->secondary_db}.tt.tanggal_transaksi,
                                    DATE_FORMAT({$this->secondary_db}.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
                                    CASE WHEN EXISTS(
                                    SELECT
                                        {$this->secondary_db}.vmax.id_max
                                    FROM
                                        {$this->secondary_db}.view_max_id_transaction_qurban vmax
                                    WHERE
                                        {$this->secondary_db}.tt.id_transaksi_qurban = {$this->secondary_db}.vmax.id_max
                                ) THEN 1 ELSE 0
                                END AS status_edit
                                FROM
                                    {$this->secondary_db}.transaksi_tabungan_qurban tt
                                LEFT JOIN {$this->secondary_db}.siswa s
                                ON
                                    {$this->secondary_db}.s.nis = {$this->secondary_db}.tt.nis_siswa
                                LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
                                ON
                                    {$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
                                LEFT JOIN {$this->default_db}.akun_keuangan ak
                                ON
                                    {$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
									WHERE
									(
										DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    {$this->secondary_db}.tt.id_transaksi_qurban
                                DESC");
        return $sql->result();
    }

    public function get_all_qurban_transaction_savings_employee($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
                                    {$this->secondary_db}.tt.id_transaksi_qurban_pegawai,
									{$this->secondary_db}.tt.nomor_transaksi_qurban,
                                    {$this->secondary_db}.tt.nip_pegawai,
									{$this->secondary_db}.tt.id_tingkat,
                                    {$this->secondary_db}.p.nama_lengkap,
                                    {$this->default_db}.ak.nama_akun,
                                    {$this->default_db}.ak.email_akun,
                                    {$this->secondary_db}.tt.saldo,
									{$this->secondary_db}.tt.jenis_tabungan,
                                    {$this->secondary_db}.tt.catatan,
                                    {$this->secondary_db}.tt.nominal,
                                    {$this->secondary_db}.tt.status_kredit_debet,
                                    CONCAT(
                                        {$this->secondary_db}.ta.tahun_awal,
                                        '/',
                                        {$this->secondary_db}.ta.tahun_akhir
                                    ) AS tahun_ajaran,
									{$this->secondary_db}.tt.th_ajaran,
                                    {$this->secondary_db}.tt.tanggal_transaksi,
                                    DATE_FORMAT({$this->secondary_db}.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
                                    CASE WHEN EXISTS(
                                    SELECT
                                        {$this->secondary_db}.vmax.id_max
                                    FROM
                                        {$this->secondary_db}.view_max_id_transaction_qurban_employee vmax
                                    WHERE
                                        {$this->secondary_db}.tt.id_transaksi_qurban_pegawai = {$this->secondary_db}.vmax.id_max
                                ) THEN 1 ELSE 0
                                END AS status_edit
                                FROM
                                    {$this->secondary_db}.transaksi_tabungan_qurban_pegawai tt
                                LEFT JOIN {$this->secondary_db}.pegawai p
                                ON
                                    {$this->secondary_db}.p.nip = {$this->secondary_db}.tt.nip_pegawai
                                LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
                                ON
                                    {$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
                                LEFT JOIN {$this->default_db}.akun_keuangan ak
                                ON
                                    {$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
									WHERE
									(
										DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    {$this->secondary_db}.tt.id_transaksi_qurban_pegawai
                                DESC");
        return $sql->result();
    }

    public function get_all_tour_transaction_savings($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
                                    {$this->secondary_db}.tt.id_transaksi_wisata,
									{$this->secondary_db}.tt.nomor_transaksi_wisata,
                                    {$this->secondary_db}.tt.nis_siswa,
									{$this->secondary_db}.tt.id_tingkat,
                                    {$this->secondary_db}.s.nama_lengkap,
                                    {$this->default_db}.ak.nama_akun,
                                    {$this->default_db}.ak.email_akun,
                                    {$this->secondary_db}.tt.saldo,
									{$this->secondary_db}.tt.jenis_tabungan,
                                    {$this->secondary_db}.tt.catatan,
                                    {$this->secondary_db}.tt.nominal,
                                    {$this->secondary_db}.tt.status_kredit_debet,
                                    CONCAT(
                                        {$this->secondary_db}.ta.tahun_awal,
                                        '/',
                                        {$this->secondary_db}.ta.tahun_akhir
                                    ) AS tahun_ajaran,
									{$this->secondary_db}.tt.th_ajaran,
                                    {$this->secondary_db}.tt.tanggal_transaksi,
                                    DATE_FORMAT({$this->secondary_db}.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
                                    CASE WHEN EXISTS(
                                    SELECT
                                        {$this->secondary_db}.vmax.id_max
                                    FROM
                                        {$this->secondary_db}.view_max_id_transaction_tour vmax
                                    WHERE
                                        {$this->secondary_db}.tt.id_transaksi_wisata = {$this->secondary_db}.vmax.id_max
                                ) THEN 1 ELSE 0
                                END AS status_edit
                                FROM
                                    {$this->secondary_db}.transaksi_tabungan_wisata tt
                                LEFT JOIN {$this->secondary_db}.siswa s
                                ON
                                    {$this->secondary_db}.s.nis = {$this->secondary_db}.tt.nis_siswa
                                LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
                                ON
                                    {$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
                                LEFT JOIN {$this->default_db}.akun_keuangan ak
                                ON
                                    {$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
									WHERE
									(
										DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    {$this->secondary_db}.tt.id_transaksi_wisata
                                DESC");
        return $sql->result();
    }

    public function get_all_tht_transaction_savings_employee($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
                                    {$this->secondary_db}.tt.id_transaksi_tht_pegawai,
									{$this->secondary_db}.tt.nomor_transaksi_tht,
                                    {$this->secondary_db}.tt.nip_pegawai,
									{$this->secondary_db}.tt.id_tingkat,
                                    {$this->secondary_db}.p.nama_lengkap,
                                    {$this->default_db}.ak.nama_akun,
                                    {$this->default_db}.ak.email_akun,
                                    {$this->secondary_db}.tt.saldo,
									{$this->secondary_db}.tt.jenis_tabungan,
                                    {$this->secondary_db}.tt.catatan,
                                    {$this->secondary_db}.tt.nominal,
                                    {$this->secondary_db}.tt.status_kredit_debet,
                                    CONCAT(
                                        {$this->secondary_db}.ta.tahun_awal,
                                        '/',
                                        {$this->secondary_db}.ta.tahun_akhir
                                    ) AS tahun_ajaran,
									{$this->secondary_db}.tt.th_ajaran,
                                    {$this->secondary_db}.tt.tanggal_transaksi,
                                    DATE_FORMAT({$this->secondary_db}.tt.waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi,
                                    CASE WHEN EXISTS(
                                    SELECT
                                        {$this->secondary_db}.vmax.id_max
                                    FROM
                                        {$this->secondary_db}.view_max_id_transaction_tht_employee vmax
                                    WHERE
                                        {$this->secondary_db}.tt.id_transaksi_tht_pegawai = {$this->secondary_db}.vmax.id_max
                                ) THEN 1 ELSE 0
                                END AS status_edit
                                FROM
                                    {$this->secondary_db}.transaksi_tabungan_tht_pegawai tt
                                LEFT JOIN {$this->secondary_db}.pegawai p
                                ON
                                    {$this->secondary_db}.p.nip = {$this->secondary_db}.tt.nip_pegawai
                                LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
                                ON
                                    {$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
                                LEFT JOIN {$this->default_db}.akun_keuangan ak
                                ON
                                    {$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
									WHERE
									(
										DATE_FORMAT(
											{$this->secondary_db}.tt.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
									)
                                ORDER BY
                                    {$this->secondary_db}.tt.id_transaksi_tht_pegawai
                                DESC");
        return $sql->result();
    }
    public function get_all_joint_transaction_savings($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
										{$this->secondary_db}.ttb.id_transaksi_bersama,
										{$this->secondary_db}.ttb.id_tingkat,
										{$this->secondary_db}.ttb.nomor_rekening_bersama,
										{$this->secondary_db}.ttb.nomor_transaksi_bersama,
										{$this->secondary_db}.tb.nama_tabungan_bersama,
										{$this->secondary_db}.tb.jenis_tabungan,
										COALESCE(NULLIF({$this->secondary_db}.s.nama_lengkap, ''), {$this->secondary_db}.p.nama_lengkap) AS nama_lengkap,
										COALESCE(NULLIF({$this->secondary_db}.s.nama_wali, ''), {$this->secondary_db}.p.nama_lengkap) AS nama_wali,
										{$this->default_db}.ak.nama_akun,
										{$this->default_db}.ak.email_akun,
										{$this->secondary_db}.ttb.saldo,
										{$this->secondary_db}.ttb.catatan,
										{$this->secondary_db}.ttb.nominal,
										{$this->secondary_db}.ttb.status_kredit_debet,
										CONCAT(
											{$this->secondary_db}.ta.tahun_awal,
											'/',
											{$this->secondary_db}.ta.tahun_akhir
										) AS tahun_ajaran,
										{$this->secondary_db}.ttb.th_ajaran,
										{$this->secondary_db}.ttb.tanggal_transaksi,
										DATE_FORMAT(
											{$this->secondary_db}.ttb.waktu_transaksi,
											'%d/%m/%Y %H:%i:%s'
										) AS waktu_transaksi,
										CASE WHEN EXISTS(
										SELECT
											{$this->secondary_db}.vmax.id_max
										FROM
											{$this->secondary_db}.view_max_id_transaction_joint vmax
										WHERE
											{$this->secondary_db}.ttb.id_transaksi_bersama = {$this->secondary_db}.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										{$this->secondary_db}.transaksi_tabungan_bersama ttb
									LEFT JOIN {$this->secondary_db}.tabungan_bersama tb
									ON
										{$this->secondary_db}.tb.nomor_rekening_bersama = {$this->secondary_db}.ttb.nomor_rekening_bersama
									LEFT JOIN {$this->secondary_db}.siswa s
									ON
										{$this->secondary_db}.s.nis = {$this->secondary_db}.tb.id_penanggung_jawab
									LEFT JOIN
										{$this->secondary_db}.pegawai p
									ON
										{$this->secondary_db}.p.nip = {$this->secondary_db}.tb.id_penanggung_jawab
									LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
									ON
										{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.ttb.th_ajaran
									LEFT JOIN {$this->default_db}.akun_keuangan ak
									ON
										{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.ttb.id_pegawai
									WHERE
									(
										DATE_FORMAT(
											{$this->secondary_db}.ttb.waktu_transaksi,
											'%Y-%m-%d'
										) BETWEEN '$start_date' AND '$end_date'
									)
									ORDER BY
										{$this->secondary_db}.ttb.id_transaksi_bersama
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

    public function get_employee_balance($nip_employee = '')
    {
        $this->db2->select('id_pegawai, nip, nama_lengkap, saldo_tabungan_umum, saldo_tabungan_qurban, saldo_tabungan_tht');
        $this->db2->where('nip', $nip_employee);
        $sql = $this->db2->get($this->table_employee);

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

    public function get_employee_transaction_last($id_transaction = '')
    {

        $this->db2->select("nip_pegawai, nomor_transaksi_umum, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_umum_pegawai');
        $this->db2->where('id_transaksi_umum_pegawai', $id_transaction);

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

    public function get_employee_transaction_qurban_last($id_transaction = '')
    {

        $this->db2->select("nip_pegawai, nomor_transaksi_qurban, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_qurban_pegawai');
        $this->db2->where('id_transaksi_qurban_pegawai', $id_transaction);

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
    public function get_employee_transaction_tht_last($id_transaction = '')
    {

        $this->db2->select("nip_pegawai, nomor_transaksi_tht, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan_tht_pegawai');
        $this->db2->where('id_transaksi_tht_pegawai', $id_transaction);

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

    public function insert_credit_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'id_tingkat' => $value['id_tingkat'],
            'nomor_transaksi_umum' => $value['nomor_transaksi_umum'],
            'nip_pegawai' => $value['nip'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_general_emp, $data);

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_general_emp, array('id_transaksi_umum_pegawai' => $id));

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

    public function insert_qurban_credit_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'id_tingkat' => $value['id_tingkat'],
            'nomor_transaksi_qurban' => $value['nomor_transaksi_qurban'],
            'nip_pegawai' => $value['nip'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_qurban_emp, $data);

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_qurban_emp, array('id_transaksi_qurban_pegawai' => $id));

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

    public function insert_tht_credit_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'id_tingkat' => $value['id_tingkat'],
            'nomor_transaksi_tht' => $value['nomor_transaksi_tht'],
            'nip_pegawai' => $value['nip'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_tht_emp, $data);

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_tht_emp, array('id_transaksi_tht_pegawai' => $id));

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

    public function insert_employee_saving($value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_jabatan' => $value['input_jabatan_pegawai'],
            'level_tingkat' => $value['input_tingkat'],
            'nip' => $value['input_nomor_rekening'],
            'password' => password_hash(paramEncrypt($value['input_nomor_rekening']), PASSWORD_DEFAULT, array('cost' => 12)),
            'nama_lengkap' => strtoupper($value['input_nama_nasabah']),
            'jenis_kelamin' => $value['input_jenis_kelamin'],
            'jenis_pegawai' => $value['input_status_pegawai'],
            'email' => @$value['input_email_nasabah'],
            'nomor_hp' => @$value['input_nomor_hp_pegawai'],
            'saldo_tabungan_umum' => $value['input_saldo_tabungan_umum'],
            'th_ajaran' => $value['input_tahun_ajaran'],
        );

        $this->db2->insert($this->table_employee, $data);

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
            'id_penanggung_jawab' => $value['input_nama_penanggungjawab'],
            'id_tingkat' => $value['input_tingkat'],
            'id_th_ajaran' => $value['input_tahun_ajaran'],
            'jenis_tabungan' => $value['input_jenis_tabungan'],
            'nomor_rekening_bersama' => $value['input_nomor_rekening_bersama'],
            'nama_tabungan_bersama' => $value['input_nama_tabungan_bersama'],
            'saldo_tabungan_bersama' => $value['input_nominal_saldo'],
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

    public function insert_client_employee($value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nama_lengkap' => strtoupper($value['nama_nasabah']),
            'nip' => $value['nip'],
            'password' => password_hash(paramEncrypt($value['nip']), PASSWORD_DEFAULT, array('cost' => 12)),
            'jenis_pegawai' => $value['jenis_pegawai'],
            'nomor_hp' => @$value['nomor_hp_aktif'],
            'email' => @$value['email_pegawai'],
            'jenis_kelamin' => $value['jenis_kelamin'],
            'id_jabatan' => $value['jabatan'],
            'level_tingkat' => $value['id_tingkat'],
            'th_ajaran' => $value['tahun_ajaran'],
            'saldo_tabungan_umum' => $value['saldo_akhir'],
        );

        $this->db2->insert($this->table_employee, $data);

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

    public function insert_qurban_client_employee($value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nama_lengkap' => strtoupper($value['nama_nasabah']),
            'nip' => $value['nip'],
            'password' => password_hash(paramEncrypt($value['nip']), PASSWORD_DEFAULT, array('cost' => 12)),
            'jenis_pegawai' => $value['jenis_pegawai'],
            'nomor_hp' => @$value['nomor_hp_aktif'],
            'email' => @$value['email_pegawai'],
            'jenis_kelamin' => $value['jenis_kelamin'],
            'id_jabatan' => $value['jabatan'],
            'level_tingkat' => $value['id_tingkat'],
            'saldo_tabungan_qurban' => $value['saldo_akhir'],
        );

        $this->db2->insert($this->table_employee, $data);

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

    public function insert_tht_client_employee($value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nama_lengkap' => strtoupper($value['nama_nasabah']),
            'nip' => $value['nip'],
            'password' => password_hash(paramEncrypt($value['nip']), PASSWORD_DEFAULT, array('cost' => 12)),
            'jenis_pegawai' => $value['jenis_pegawai'],
            'nomor_hp' => @$value['nomor_hp_aktif'],
            'email' => @$value['email_pegawai'],
            'jenis_kelamin' => $value['jenis_kelamin'],
            'id_jabatan' => $value['jabatan'],
            'level_tingkat' => $value['id_tingkat'],
            'saldo_tabungan_tht' => $value['saldo_akhir'],
        );

        $this->db2->insert($this->table_employee, $data);

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

    public function insert_debet_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'nomor_transaksi_umum' => $value['nomor_transaksi_umum'],
            'nip_pegawai' => $value['nip'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_general_emp, $data);

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_general_emp, array('id_transaksi_umum_pegawai' => $id));

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

    public function insert_qurban_debet_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'nomor_transaksi_qurban' => $value['nomor_transaksi_qurban'],
            'id_tingkat' => $value['id_tingkat'],
            'nip_pegawai' => $value['nip'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_qurban_emp, $data);

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_qurban_emp, array('id_transaksi_qurban_pegawai' => $id));

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

    public function insert_tht_debet_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'nomor_transaksi_tht' => $value['nomor_transaksi_tht'],
            'id_tingkat' => $value['id_tingkat'],
            'nip_pegawai' => $value['nip'],
            'nominal' => $value['nominal'],
            'jenis_tabungan' => $value['jenis_tabungan'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings_transaction_tht_emp, $data);

        $id = $this->db2->insert_id();
        $query = $this->db2->get_where($this->table_savings_transaction_tht_emp, array('id_transaksi_tht_pegawai' => $id));

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return array('status' => false);
        } else {
            $this->db2->trans_commit();
            return array('status' => true, 'data' => $query->row());
        }
    }

    public function update_name_and_hp_parent($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nama_wali' => @$value['input_nama_wali'],
            'nomor_handphone' => @$value['input_nomor_hp_wali'],
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

    public function update_hp_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nomor_hp' => @$value['input_nomor_hp_wali'],
        );

        $this->db2->where('nip', $id);
        $this->db2->update($this->table_employee, $data);

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
            'status_siswa' => $value['status_siswa'],
            'nama_wali' => @$value['nama_wali'],
            'nomor_handphone' => @$value['nomor_handphone_wali'],
            'email' => @$value['email_wali'],
            'jenis_kelamin' => @$value['jenis_kelamin'],
            'updated_at' => date("Y-m-d H:i:s"),
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

    public function update_employee_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'level_tingkat' => $value['level_tingkat'],
            'id_jabatan' => $value['id_jabatan'],
            'nama_lengkap' => $value['nama_lengkap'],
            'nomor_hp' => @$value['nomor_handphone_pegawai'],
            'email' => @$value['email'],
            'jenis_kelamin' => $value['jenis_kelamin'],
            'jenis_pegawai' => $value['jenis_pegawai'],
            'th_ajaran' => $value['th_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_pegawai', $id);
        $this->db2->update($this->table_employee, $data);

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
            'status_siswa' => $value['status_siswa'],
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

    public function update_import_employee_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nip' => $value['nip'],
            'password' => $value['password'],
            'nama_nasabah' => $value['nama_nasabah'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'tahun_ajaran' => $value['tahun_ajaran'],
            'tingkat' => $value['tingkat'],
            'jenis_kelamin' => $value['jenis_kelamin'],
            'status_pegawai' => $value['status_pegawai'],
            'nomor_hp_pegawai' => @$value['nomor_hp_pegawai'],
            'email_nasabah' => @$value['email_nasabah'],
            'saldo_umum' => @$value['saldo_umum'],
            'saldo_qurban' => @$value['saldo_qurban'],
            'saldo_tht' => @$value['saldo_tht'],
            'status_nasabah' => $value['status_nasabah'],
            'status_nama_nasabah' => $value['status_nama_nasabah'],
        );

        $this->db2->where('id_nasabah', $id);
        $this->db2->update($this->table_import_employee_saving, $data);

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
            'id_penanggung_jawab' => $value['id_penanggung_jawab'],
            'id_tingkat' => $value['id_tingkat'],
            'id_th_ajaran' => $value['id_th_ajaran'],
            'nama_tabungan_bersama' => $value['nama_tabungan_bersama'],
            'keterangan_tabungan_bersama' => $value['keterangan_tabungan_bersama'],
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

    public function update_import_joint_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nomor_rekening_bersama' => $value['nomor_rekening_bersama'],
            'id_penanggung_jawab' => $value['id_penanggung_jawab'],
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
											saldo_tabungan_wisata,
											status_siswa
										)
										SELECT
											{$this->secondary_db}.inp.nis,
											{$this->secondary_db}.inp.nis AS nomor_dpb,
											CONCAT(
												'8',
												SUBSTRING({$this->secondary_db}.inp.nis, 2)
											) AS nomor_du,
											{$this->secondary_db}.inp.password,
											{$this->secondary_db}.inp.tingkat,
											{$this->secondary_db}.inp.nama_nasabah,
											{$this->secondary_db}.inp.nomor_hp_wali,
											{$this->secondary_db}.inp.email_nasabah,
											{$this->secondary_db}.inp.nama_wali,
											{$this->secondary_db}.inp.tahun_ajaran,
											{$this->secondary_db}.inp.saldo_umum,
											{$this->secondary_db}.inp.saldo_qurban,
											{$this->secondary_db}.inp.saldo_wisata,
											{$this->secondary_db}.inp.status_siswa
										FROM
											{$this->secondary_db}.import_nasabah_personal inp
										WHERE
											{$this->secondary_db}.inp.id_nasabah IN ($id)
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
											saldo_tabungan_wisata = VALUES(saldo_tabungan_wisata),
											status_siswa = VALUES(status_siswa)");

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function accept_import_data_employee_saving($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->query("INSERT INTO pegawai(
											nip,
											password,
											level_tingkat,
											nama_lengkap,
											jenis_kelamin,
											nomor_hp,
											email,
											jenis_pegawai,
											th_ajaran,
											saldo_tabungan_umum,
											saldo_tabungan_qurban,
											saldo_tabungan_tht
										)
										SELECT
											{$this->secondary_db}.inp.nip,
											{$this->secondary_db}.inp.password,
											{$this->secondary_db}.inp.tingkat,
											{$this->secondary_db}.inp.nama_nasabah,
											{$this->secondary_db}.inp.jenis_kelamin,
											{$this->secondary_db}.inp.nomor_hp_pegawai,
											{$this->secondary_db}.inp.email_nasabah,
											{$this->secondary_db}.inp.status_pegawai,
											{$this->secondary_db}.inp.tahun_ajaran,
											{$this->secondary_db}.inp.saldo_umum,
											{$this->secondary_db}.inp.saldo_qurban,
											{$this->secondary_db}.inp.saldo_tht
										FROM
											{$this->secondary_db}.import_nasabah_pegawai inp
										WHERE
											{$this->secondary_db}.inp.id_nasabah IN ($id)
										ON DUPLICATE KEY UPDATE
											password = VALUES(password),
											level_tingkat = VALUES(level_tingkat),
											nama_lengkap = VALUES(nama_lengkap),
											jenis_kelamin = VALUES(jenis_kelamin),
											nomor_hp = VALUES(nomor_hp),
											email = VALUES(email),
											jenis_pegawai = VALUES(jenis_pegawai),
											th_ajaran = VALUES(th_ajaran),
											saldo_tabungan_umum = VALUES(saldo_tabungan_umum),
											saldo_tabungan_qurban = VALUES(saldo_tabungan_qurban),
											saldo_tabungan_tht = VALUES(saldo_tabungan_tht)");

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
											id_penanggung_jawab,
											id_pegawai,
											id_tingkat,
											id_th_ajaran,
											nomor_rekening_bersama,
											nama_tabungan_bersama,
											saldo_tabungan_bersama,
											keterangan_tabungan_bersama,
											jenis_tabungan
										)
										SELECT
											{$this->secondary_db}.inb.id_penanggung_jawab,
											{$this->secondary_db}.inb.id_pegawai,
											{$this->secondary_db}.inb.tingkat,
											{$this->secondary_db}.inb.tahun_ajaran,
											{$this->secondary_db}.inb.nomor_rekening_bersama,
											{$this->secondary_db}.inb.nama_tabungan_bersama,
											{$this->secondary_db}.inb.saldo_bersama AS saldo_tabungan_bersama,
											{$this->secondary_db}.inb.keterangan_bersama AS keterangan_tabungan_bersama,
											{$this->secondary_db}.inb.jenis_tabungan
										FROM
											{$this->secondary_db}.import_nasabah_bersama inb
										WHERE
											{$this->secondary_db}.inb.id_nasabah_bersama IN ($id)
										ON DUPLICATE KEY UPDATE
											id_penanggung_jawab = VALUES(id_penanggung_jawab),
											id_pegawai = VALUES(id_pegawai),
											id_tingkat = VALUES(id_tingkat),
											id_th_ajaran = VALUES(id_th_ajaran),
											nomor_rekening_bersama = VALUES(nomor_rekening_bersama),
											nama_tabungan_bersama = VALUES(nama_tabungan_bersama),
											saldo_tabungan_bersama = VALUES(saldo_tabungan_bersama),
											keterangan_tabungan_bersama = VALUES(keterangan_tabungan_bersama),
											jenis_tabungan = VALUES(jenis_tabungan)");

        $this->db2->query("UPDATE
								{$this->secondary_db}.siswa AS s,
								{$this->secondary_db}.import_nasabah_bersama AS inb
							SET
								{$this->secondary_db}.s.nama_wali = {$this->secondary_db}.inb.nama_wali,
								{$this->secondary_db}.s.nomor_handphone = {$this->secondary_db}.inb.nomor_hp_wali
							WHERE
								{$this->secondary_db}.s.nis = {$this->secondary_db}.inb.id_penanggung_jawab
								AND
								{$this->secondary_db}.inb.id_nasabah_bersama IN ($id)");

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

    public function update_credit_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nip_pegawai' => $value['nip'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_umum_pegawai', $id);
        $this->db2->update($this->table_savings_transaction_general_emp, $data);

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

    public function update_qurban_credit_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nip_pegawai' => $value['nip'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_qurban_pegawai', $id);
        $this->db2->update($this->table_savings_transaction_qurban_emp, $data);

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

    public function update_tht_credit_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nip_pegawai' => $value['nip'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_tht_pegawai', $id);
        $this->db2->update($this->table_savings_transaction_tht_emp, $data);

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

    public function update_debet_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nip_pegawai' => $value['nip'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_umum_pegawai', $id);
        $this->db2->update($this->table_savings_transaction_general_emp, $data);

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

    public function update_qurban_debet_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nip_pegawai' => $value['nip'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_qurban_pegawai', $id);
        $this->db2->update($this->table_savings_transaction_qurban_emp, $data);

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

    public function update_tht_debet_saving_employee($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'nip_pegawai' => $value['nip'],
            'id_tingkat' => $value['id_tingkat'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_transaksi_tht_pegawai', $id);
        $this->db2->update($this->table_savings_transaction_tht_emp, $data);

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

    public function update_balance_saving_employee($nip = '', $saldo = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'saldo_tabungan_umum' => $saldo,
        );

        $this->db2->where('nip', $nip);
        $this->db2->update($this->table_employee, $data);

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

    public function update_qurban_balance_saving_employee($nip = '', $saldo = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'saldo_tabungan_qurban' => $saldo,
        );

        $this->db2->where('nip', $nip);
        $this->db2->update($this->table_employee, $data);

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

    public function update_tht_balance_saving_employee($nip = '', $saldo = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'saldo_tabungan_tht' => $saldo,
        );

        $this->db2->where('nip', $nip);
        $this->db2->update($this->table_employee, $data);

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

    public function delete_transaction_employee($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->where('id_transaksi_umum_pegawai', $id);
        $this->db2->delete($this->table_savings_transaction_general_emp);

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

    public function delete_qurban_transaction_employee($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->where('id_transaksi_qurban_pegawai', $id);
        $this->db2->delete($this->table_savings_transaction_qurban_emp);

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

        $this->db2->where('id_transaksi_tht', $id);
        $this->db2->delete($this->table_savings_transaction_tour);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function delete_tht_transaction_employee($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->where('id_transaksi_tht_pegawai', $id);
        $this->db2->delete($this->table_savings_transaction_tht_emp);

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

    public function delete_import_employee_saving_by_id($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->where('id_nasabah', $id);
        $this->db2->delete($this->table_import_employee_saving);

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

    public function clear_import_data_employee_saving()
    {
        $this->db2->trans_begin();

        $this->db2->truncate($this->table_import_employee_saving);

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
