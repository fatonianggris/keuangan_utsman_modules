<?php

class IncomeModel extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('secondary_db', TRUE);
	}

	private $table_structure = 'struktur_akun_keuangan';
	private $table_general_page = 'general_page';
	private $table_schoolyear = 'tahun_ajaran';
	private $table_income_dpb = 'tagihan_pembayaran_dpb';
	private $table_income_du = 'tagihan_pembayaran_du';
	private $table_account = 'akun_keuangan';
	private $table_vstudent = 'view_siswa';

	//
	//------------------------------GET VISITOR--------------------------------//
	//  


	public function get_dpb_total_all()
	{
		$sql = $this->db2->query("SELECT
                                (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_dpb a                             
                            ) AS total_tagihan,
                            (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_dpb a
                                WHERE 
                                   a.status_pembayaran = 'SUKSES'
                            ) AS total_tagihan_sukses,
                            (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_dpb a
                                WHERE 
                                    a.status_pembayaran = 'MENUNGGU'
                            ) AS total_tagihan_menunggu");
		return $sql->result();
	}

	public function get_dpb_total_by_nomor_pembayaran($nomor_siswa = '')
	{
		$sql = $this->db2->query("SELECT
                                (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_dpb a
                                WHERE 
                                    a.nomor_siswa='$nomor_siswa'
                            ) AS total_tagihan,
                            (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_dpb a
                                WHERE 
                                    a.status_pembayaran = 'SUKSES' AND a.nomor_siswa='$nomor_siswa'
                            ) AS total_tagihan_sukses,
                            (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_dpb a
                                WHERE 
                                    a.status_pembayaran = 'MENUNGGU' AND a.nomor_siswa='$nomor_siswa'
                            ) AS total_tagihan_menunggu");
		return $sql->result();
	}

	public function get_du_total_all()
	{
		$sql = $this->db2->query("SELECT
                                (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_du a                               
                            ) AS total_tagihan,
                            (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_du a
                                WHERE 
                                   a.status_pembayaran = 'SUKSES'
                            ) AS total_tagihan_sukses,
                            (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_du a
                                WHERE 
                                   a.status_pembayaran = 'MENUNGGU'
                            ) AS total_tagihan_menunggu");
		return $sql->result();
	}

	public function get_du_total_by_nomor_pembayaran($nomor_siswa = '')
	{
		$sql = $this->db2->query("SELECT
                                (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_du a
                                WHERE 
                                   a.nomor_siswa='$nomor_siswa'
                            ) AS total_tagihan,
                            (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_du a
                                WHERE 
                                    a.status_pembayaran = 'SUKSES' AND a.nomor_siswa='$nomor_siswa'
                            ) AS total_tagihan_sukses,
                            (
                                SELECT
                                    COALESCE(SUM(a.nominal_tagihan),0)
                                FROM
                                    tagihan_pembayaran_du a
                                WHERE 
                                    a.status_pembayaran = 'MENUNGGU' AND a.nomor_siswa='$nomor_siswa'
                            ) AS total_tagihan_menunggu");
		return $sql->result();
	}

	public function get_page()
	{

		$this->db->select('*');
		$this->db->where('id_general_page', 1);
		$sql = $this->db->get($this->table_general_page);
		return $sql->result();
	}

	public function check_pass_admin($id_keuangan = '')
	{
		$this->db->where('id_akun_keuangan', $id_keuangan);
		$sql = $this->db->get($this->table_account);
		return $sql->result();
	}

	public function check_invoice_dpb_duplicate($kode = '')
	{
		$this->db2->select('*');
		$this->db2->where('id_invoice', $kode);

		$sql = $this->db2->get($this->table_income_dpb);
		return $sql->result();
	}

	public function check_invoice_du_duplicate($kode = '')
	{
		$this->db2->select('*');
		$this->db2->where('id_invoice', $kode);

		$sql = $this->db2->get($this->table_income_du);
		return $sql->result();
	}

	public function check_payment_dpb_duplicate($pay = '')
	{
		$this->db2->select('DISTINCT (nomor_siswa)');
		$this->db2->where('nomor_siswa', $pay);

		$sql = $this->db2->get($this->table_income_dpb);
		return $sql->result();
	}

	public function check_payment_du_duplicate($pay = '')
	{
		$this->db2->select('DISTINCT (nomor_siswa)');
		$this->db2->where('nomor_siswa', $pay);

		$sql = $this->db2->get($this->table_income_du);
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

	public function get_schoolyear_now()
	{
		$this->db->select('*');
		$this->db->where('status_tahun_ajaran', 1);
		$sql = $this->db->get($this->table_schoolyear);
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

	public function get_student_du_invoice_by_id($id = '')
	{
		$this->db2->select('*');
		$this->db2->where('id_tagihan_pembayaran_du', $id);
		$sql = $this->db2->get($this->table_income_du);
		return $sql->result();
	}

	public function get_student_dpb_invoice_by_id($id = '')
	{
		$this->db2->select('*');
		$this->db2->where('id_tagihan_pembayaran_dpb', $id);
		$sql = $this->db2->get($this->table_income_dpb);
		return $sql->result();
	}

	public function get_student_by_id($nis_student = '')
	{
		$this->db2->select('*');
		$this->db2->where('nis', $nis_student);
		$sql = $this->db2->get($this->table_vstudent);
		return $sql->result();
	}

	public function get_student_by_nomor_pembayaran_du($nomor_pembayaran = '')
	{
		$this->db2->select('*');
		$this->db2->where('nomor_pembayaran_du', $nomor_pembayaran);
		$sql = $this->db2->get($this->table_vstudent);
		return $sql->result();
	}

	public function get_student_by_nomor_pembayaran_dpb($nomor_pembayaran = '')
	{
		$this->db2->select('*');
		$this->db2->where('nomor_pembayaran_dpb', $nomor_pembayaran);
		$sql = $this->db2->get($this->table_vstudent);
		return $sql->result();
	}

	public function check_name_division($id = '')
	{
		$this->db->where('id_struktur', $id);

		$sql = $this->db->get($this->table_structure);
		return $sql->result();
	}

	public function get_income_du_by_id($id = '')
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn, 
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,   
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,                                                         
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('tagihan_pembayaran_du p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');

		$this->db2->where('p.id_tagihan_pembayaran_du', $id);

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function get_income_dpb_by_id($id = '')
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn,   
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,   
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('tagihan_pembayaran_dpb p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');

		$this->db2->where('p.id_tagihan_pembayaran_dpb', $id);

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function get_income_du_by_nomor_pembayaran($nomor_pembayaran = '')
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,
                                s.nisn, 
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('tagihan_pembayaran_du p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');

		$this->db2->where('s.nomor_pembayaran_du', $nomor_pembayaran);

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function get_income_dpb_by_nomor_pembayaran($nomor_pembayaran = '')
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn,  
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,   
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('tagihan_pembayaran_dpb p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');

		$this->db2->where('s.nomor_pembayaran_dpb', $nomor_pembayaran);

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function get_all_income_du()
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn,  
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,                                                         
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");

		$this->db2->from('tagihan_pembayaran_du p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');
		$this->db2->order_by('p.id_tagihan_pembayaran_du', 'DESC');

		$sql = $this->db2->get();
		return $sql->result_array();
	}

	public function get_all_income_dpb()
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn,   
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('tagihan_pembayaran_dpb p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');
		$this->db2->order_by('p.id_tagihan_pembayaran_dpb', 'DESC');

		$sql = $this->db2->get();
		return $sql->result_array();
	}

	public function get_all_transition_income_dpb_insert()
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn, 
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('transisi_tagihan_pembayaran p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');

		$this->db2->where('p.id_invoice NOT IN (SELECT tp.id_invoice FROM tagihan_pembayaran_dpb tp)');
		$this->db2->order_by('p.inserted_at', 'DESC');

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function get_all_transition_income_dpb_update()
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn, 
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('transisi_tagihan_pembayaran p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');

		$this->db2->where('p.id_invoice IN (SELECT tp.id_invoice FROM tagihan_pembayaran_dpb tp WHERE tp.status_pembayaran = "MENUNGGU")');
		$this->db2->order_by('p.inserted_at', 'DESC');

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function get_all_transition_income_dpb_delete()
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn, 
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,                                                         
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('transisi_tagihan_pembayaran p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');

		$this->db2->where('p.id_invoice IN (SELECT tp.id_invoice FROM tagihan_pembayaran_dpb tp WHERE tp.status_pembayaran = "SUKSES")');
		$this->db2->order_by('p.inserted_at', 'DESC');

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function get_all_income_dpb_update_duplicate()
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn, 
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,                                                         
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('tagihan_pembayaran_dpb p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');
		$this->db2->where('p.status_pembayaran', "MENUNGGU");

		$this->db2->where('p.id_invoice IN (SELECT tp.id_invoice FROM transisi_tagihan_pembayaran tp)');
		$this->db2->order_by('p.inserted_at', 'DESC');

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function get_all_income_dpb_delete_duplicate()
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn, 
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,                                                         
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('tagihan_pembayaran_dpb p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');
		$this->db2->where('p.status_pembayaran', "SUKSES");

		$this->db2->where('p.id_invoice IN (SELECT tp.id_invoice FROM transisi_tagihan_pembayaran tp)');
		$this->db2->order_by('p.inserted_at', 'DESC');

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function get_all_transition_income_du_insert()
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn,   
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,                                                         
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('transisi_tagihan_pembayaran p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');

		$this->db2->where('p.id_invoice NOT IN (SELECT tp.id_invoice FROM tagihan_pembayaran_du tp)');
		$this->db2->order_by('p.inserted_at', 'DESC');

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function get_all_transition_income_du_update()
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn,
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,                                                         
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('transisi_tagihan_pembayaran p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');

		$this->db2->where('p.id_invoice IN (SELECT tp.id_invoice FROM tagihan_pembayaran_du tp WHERE tp.status_pembayaran = "MENUNGGU")');
		$this->db2->order_by('p.inserted_at', 'DESC');

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function get_all_transition_income_du_delete()
	{
		$this->db2->select("p.*, 
                                s.nama_lengkap,
                                s.nis,   
                                s.nisn,  
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                k.nama_kelas,
                                t.nama_tingkat,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,                                                         
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
		$this->db2->from('transisi_tagihan_pembayaran p');
		$this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
		$this->db2->join('siswa s', 's.id_siswa = p.id_siswa', 'left');
		$this->db2->join('kelas k', 'k.id_kelas = s.id_kelas', 'left');
		$this->db2->join('tingkat t', 't.id_tingkat = s.id_tingkat', 'left');

		$this->db2->where('p.id_invoice IN (SELECT tp.id_invoice FROM tagihan_pembayaran_du tp WHERE tp.status_pembayaran = "SUKSES")');
		$this->db2->order_by('p.inserted_at', 'DESC');

		$sql = $this->db2->get();
		return $sql->result();
	}

	public function accept_import_data_payment_dpb()
	{
		$this->db2->trans_begin();

		$this->db2->query("INSERT INTO tagihan_pembayaran_dpb(
                                        id_invoice,
                                        id_siswa,
                                        id_kelas,
                                        id_tingkat,
                                        level_tingkat,
                                        tipe_tagihan,
                                        tanggal_invoice,
                                        nomor_siswa,
                                        nama,
                                        nominal_tagihan,
                                        informasi,
                                        rincian,
                                        catatan,
                                        th_ajaran,
                                        status_pembayaran
                                    )
                                    SELECT
                                        ttp.id_invoice,
                                        ttp.id_siswa,
                                        ttp.id_kelas,
                                        ttp.id_tingkat,
                                        ttp.level_tingkat,
                                        ttp.tipe_tagihan,
                                        ttp.tanggal_invoice,
                                        ttp.nomor_siswa,
                                        ttp.nama,
                                        ttp.nominal_tagihan,
                                        ttp.informasi,
                                        ttp.rincian,
                                        ttp.catatan,
                                        ttp.th_ajaran,
                                        ttp.status_pembayaran
                                    FROM
                                        transisi_tagihan_pembayaran ttp
                                    WHERE
                                        ttp.id_invoice NOT IN(
                                        SELECT
                                            tp.id_invoice
                                        FROM
                                            tagihan_pembayaran_dpb tp
                                    ) OR ttp.id_invoice IN(
                                        SELECT
                                            tp.id_invoice
                                        FROM
                                            tagihan_pembayaran_dpb tp
                                        WHERE
                                            tp.status_pembayaran = 'MENUNGGU'
                                    )
                                    ON DUPLICATE KEY
                                    UPDATE
                                        id_invoice = ttp.id_invoice,
                                        id_siswa = ttp.id_siswa,
                                        id_kelas = ttp.id_kelas,
                                        id_tingkat = ttp.id_tingkat,
                                        level_tingkat = ttp.level_tingkat,
                                        tipe_tagihan = ttp.tipe_tagihan,
                                        tanggal_invoice = ttp.tanggal_invoice,
                                        nomor_siswa = ttp.nomor_siswa,
                                        nama = ttp.nama,
                                        nominal_tagihan = ttp.nominal_tagihan,
                                        rincian = ttp.rincian,
                                        catatan = ttp.catatan,
                                        th_ajaran = ttp.th_ajaran,
                                        status_pembayaran = ttp.status_pembayaran
                                    ");

		if ($this->db2->trans_status() === false) {
			$this->db2->trans_rollback();
			return false;
		} else {
			$this->db2->trans_commit();
			return true;
		}
	}

	public function accept_import_data_payment_du()
	{
		$this->db2->trans_begin();

		$this->db2->query("INSERT INTO tagihan_pembayaran_du(
                                        id_invoice,
                                        id_siswa,
                                        id_kelas,
                                        id_tingkat,
                                        level_tingkat,
                                        tipe_tagihan,
                                        tanggal_invoice,
                                        nomor_siswa,
                                        nama,
                                        nominal_tagihan,
                                        informasi,
                                        rincian,
                                        catatan,
                                        th_ajaran,
                                        status_pembayaran
                                    )
                                    SELECT
                                        ttp.id_invoice,
                                        ttp.id_siswa,
                                        ttp.id_kelas,
                                        ttp.id_tingkat,
                                        ttp.level_tingkat,
                                        ttp.tipe_tagihan,
                                        ttp.tanggal_invoice,
                                        ttp.nomor_siswa,
                                        ttp.nama,
                                        ttp.nominal_tagihan,
                                        ttp.informasi,
                                        ttp.rincian,
                                        ttp.catatan,
                                        ttp.th_ajaran,
                                        ttp.status_pembayaran
                                    FROM
                                        transisi_tagihan_pembayaran ttp
                                    WHERE
                                        ttp.id_invoice NOT IN(
                                        SELECT
                                            tp.id_invoice
                                        FROM
                                            tagihan_pembayaran_du tp
                                    ) OR ttp.id_invoice IN(
                                        SELECT
                                            tp.id_invoice
                                        FROM
                                            tagihan_pembayaran_du tp
                                        WHERE
                                            tp.status_pembayaran = 'MENUNGGU'
                                    )
                                    ON DUPLICATE KEY
                                    UPDATE
                                        id_invoice = ttp.id_invoice,
                                        id_siswa = ttp.id_siswa,
                                        id_kelas = ttp.id_kelas,
                                        id_tingkat = ttp.id_tingkat,
                                        level_tingkat = ttp.level_tingkat,
                                        tipe_tagihan = ttp.tipe_tagihan,
                                        tanggal_invoice = ttp.tanggal_invoice,
                                        nomor_siswa = ttp.nomor_siswa,
                                        nama = ttp.nama,
                                        nominal_tagihan = ttp.nominal_tagihan,
                                        rincian = ttp.rincian,
                                        catatan = ttp.catatan,
                                        th_ajaran = ttp.th_ajaran,
                                        status_pembayaran = ttp.status_pembayaran");

		if ($this->db2->trans_status() === false) {
			$this->db2->trans_rollback();
			return false;
		} else {
			$this->db2->trans_commit();
			return true;
		}
	}

	public function update_income_dpb($id = '', $value = '')
	{
		$this->db2->trans_begin();

		$data = array(
			'id_invoice' => $value['nomor_invoice'],
			'nomor_siswa' => $value['nomor_pembayaran'],
			'nominal_tagihan' => $value['nominal_tagihan'],
			'nama' => $value['nama_siswa'],
			'rincian' => @$value['rincian'],
			'tanggal_invoice' => $value['tanggal_invoice'],
			'informasi' => @$value['informasi'],
			'catatan' => @$value['catatan'],
			'updated_at' => date("Y-m-d H:i:s"),
		);

		$this->db2->where('id_tagihan_pembayaran_dpb', $id);
		$this->db2->update($this->table_income_dpb, $data);

		if ($this->db2->trans_status() === false) {
			$this->db2->trans_rollback();
			return false;
		} else {
			$this->db2->trans_commit();
			return true;
		}
	}

	public function update_income_du($id = '', $value = '')
	{
		$this->db2->trans_begin();

		$data = array(
			'id_invoice' => $value['nomor_invoice'],
			'nomor_siswa' => $value['nomor_pembayaran'],
			'nominal_tagihan' => $value['nominal_tagihan'],
			'nama' => $value['nama_siswa'],
			'rincian' => @$value['rincian'],
			'tanggal_invoice' => $value['tanggal_invoice'],
			'informasi' => @$value['informasi'],
			'catatan' => @$value['catatan'],
			'updated_at' => date("Y-m-d H:i:s"),
		);

		$this->db2->where('id_tagihan_pembayaran_du', $id);
		$this->db2->update($this->table_income_du, $data);

		if ($this->db2->trans_status() === false) {
			$this->db2->trans_rollback();
			return false;
		} else {
			$this->db2->trans_commit();
			return true;
		}
	}

	public function clear_import_data_payment()
	{
		$this->db2->trans_begin();

		$this->db2->query("TRUNCATE TABLE transisi_tagihan_pembayaran");

		if ($this->db2->trans_status() === false) {
			$this->db2->trans_rollback();
			return false;
		} else {
			$this->db2->trans_commit();
			return true;
		}
	}

	public function delete_income_dpb_by_id($value)
	{
		$this->db2->trans_begin();

		$this->db2->where('id_tagihan_pembayaran_dpb', $value);
		$this->db2->delete($this->table_income_dpb);

		if ($this->db2->trans_status() === false) {
			$this->db2->trans_rollback();
			return false;
		} else {
			$this->db2->trans_commit();
			return true;
		}
	}

	public function delete_income_du_by_id($value)
	{
		$this->db2->trans_begin();

		$this->db2->where('id_tagihan_pembayaran_du', $value);
		$this->db2->delete($this->table_income_du);

		if ($this->db2->trans_status() === false) {
			$this->db2->trans_rollback();
			return false;
		} else {
			$this->db2->trans_commit();
			return true;
		}
	}

	//-----------------------------------------------------------------------//
	//
}
