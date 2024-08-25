<?php

class IncomeModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('secondary_db', true);
    }

    private $table_structure = 'struktur_akun_keuangan';
    private $table_general_page = 'general_page';
    private $table_schoolyear = 'tahun_ajaran';
    private $table_income_dpb = 'tagihan_pembayaran_dpb';
    private $table_income_du = 'tagihan_pembayaran_du';
    private $table_payment_transition = 'transisi_tagihan_pembayaran';
    private $table_account = 'akun_keuangan';
    private $table_vstudent = 'view_siswa';
    private $table_student = 'siswa';

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

    public function check_student_by_name_and_number_du($number = '', $name = '')
    {
        $this->db2->select('nomor_pembayaran_du, nama_lengkap');
        $this->db2->where('nomor_pembayaran_du', $number);
        $this->db2->where('nama_lengkap', $name);

        $sql = $this->db2->get($this->table_vstudent);
        return $sql->result();
    }

    public function check_student_by_name_and_number_dpb($number = '', $name = '')
    {
        $this->db2->select('nomor_pembayaran_dpb, nama_lengkap');
        $this->db2->where('nomor_pembayaran_dpb', $number);
        $this->db2->where('nama_lengkap', $name);

        $sql = $this->db2->get($this->table_vstudent);
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

    public function check_duplicate_import_data_payment($id = '')
    {
        $sql = $this->db->query("SELECT
										panel_utsman.ttp.id_tagihan_pembayaran,
										panel_utsman.ttp.nomor_siswa,
										panel_utsman.ttp.status_nomor_terdaftar,
										panel_utsman.ttp.status_nama_duplikat,
										panel_utsman.ttp.status_invoice_duplikat
									FROM
										panel_utsman.transisi_tagihan_pembayaran ttp
									WHERE
										panel_utsman.ttp.id_tagihan_pembayaran IN($id)
									AND(
										(panel_utsman.ttp.status_nomor_terdaftar = 3) +
										(panel_utsman.ttp.status_nama_duplikat = 3) +
										(panel_utsman.ttp.status_invoice_duplikat = 3) >= 1
									)");

        return $sql->num_rows();
    }

    public function check_used_number_import_data_payment($id = '')
    {
        $sql = $this->db->query("SELECT
										panel_utsman.ttp.nomor_siswa, panel_utsman.ttp.status_nomor_terdaftar, panel_utsman.ttp.status_nama_duplikat, panel_utsman.ttp.status_invoice_duplikat
									FROM
										panel_utsman.transisi_tagihan_pembayaran ttp
									WHERE
										panel_utsman.ttp.id_tagihan_pembayaran IN ($id)
									AND panel_utsman.ttp.status_invoice_duplikat = 2");

        return $sql->num_rows();
    }

    public function check_similiar_not_registered_import_data_payment($id = '')
    {
        $sql = $this->db->query("SELECT
										panel_utsman.ttp.id_tagihan_pembayaran,
										panel_utsman.ttp.nomor_siswa,
										panel_utsman.ttp.status_nomor_terdaftar,
										panel_utsman.ttp.status_nama_duplikat,
										panel_utsman.ttp.status_invoice_duplikat
									FROM
										panel_utsman.transisi_tagihan_pembayaran ttp
									WHERE
										panel_utsman.ttp.id_tagihan_pembayaran IN($id)
									AND(
										(panel_utsman.ttp.status_nomor_terdaftar = 2) +
										(panel_utsman.ttp.status_nama_duplikat = 2) +
										(panel_utsman.ttp.status_nama_duplikat = 4) >= 1
									)");

        return $sql->num_rows();
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
        $this->db2->select('*');
        $this->db2->where('status_tahun_ajaran', 1);
        $sql = $this->db2->get($this->table_schoolyear);
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
        $sql = $this->db2->get($this->table_student);
        return $sql->result();
    }

    public function check_student_by_nomor_pembayaran_du($nomor_pembayaran = '')
    {
        $this->db2->select('*');
        $this->db2->where('nomor_pembayaran_du', $nomor_pembayaran);
        $sql = $this->db2->get($this->table_student);
        return $sql->result();
    }

    public function check_student_by_nomor_pembayaran_dpb($nomor_pembayaran = '')
    {
        $this->db2->select('*');
        $this->db2->where('nomor_pembayaran_dpb', $nomor_pembayaran);
        $sql = $this->db2->get($this->table_student);
        return $sql->result();
    }

    public function check_name_division($id = '')
    {
        $this->db->where('id_struktur', $id);

        $sql = $this->db->get($this->table_structure);
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

    public function get_income_du_by_id($id = '')
    {
        $this->db2->select("p.*,
                                s.nama_lengkap,
                                s.nis,
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
								DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('tagihan_pembayaran_du p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_du = p.nomor_siswa', 'left');

        $this->db2->where('p.id_tagihan_pembayaran_du', $id);

        $sql = $this->db2->get();
        return $sql->result();
    }
    public function get_income_dpb_by_id($id = '')
    {
        $this->db2->select("p.*,
                                s.nama_lengkap,
                                s.nis,
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
								DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('tagihan_pembayaran_dpb p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_dpb = p.nomor_siswa', 'left');

        $this->db2->where('p.id_tagihan_pembayaran_dpb', $id);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_transition_income_du_by_id($id = '')
    {
        $this->db2->select("tp.id_tagihan_pembayaran, tp.id_invoice");
        $this->db2->from('transisi_tagihan_pembayaran tp');
        $this->db2->where('tp.id_invoice', $id);

        $sql = $this->db2->get();
        return $sql->num_rows();
    }

    public function get_transition_income_dpb_by_id($id = '')
    {
        $this->db2->select("tp.id_tagihan_pembayaran, tp.id_invoice");
        $this->db2->from('transisi_tagihan_pembayaran tp');
        $this->db2->where('tp.id_invoice', $id);

        $sql = $this->db2->get();
        return $sql->num_rows();
    }

    public function get_transition_income_du_by_number($number = '')
    {
        $this->db2->select("tp.id_tagihan_pembayaran, tp.id_invoice, tp.nomor_siswa");
        $this->db2->from('transisi_tagihan_pembayaran tp');
        $this->db2->where('tp.nomor_siswa', $number);

        $sql = $this->db2->get();
        return $sql->num_rows();
    }

    public function get_transition_income_dpb_by_number($number = '')
    {
        $this->db2->select("tp.id_tagihan_pembayaran, tp.id_invoice, tp.nomor_siswa");
        $this->db2->from('transisi_tagihan_pembayaran tp');
        $this->db2->where('tp.nomor_siswa', $number);

        $sql = $this->db2->get();
        return $sql->num_rows();
    }

    public function get_transition_income_du_by_name($name = '')
    {
        $this->db2->select("tp.id_tagihan_pembayaran, tp.id_invoice, tp.nomor_siswa");
        $this->db2->from('transisi_tagihan_pembayaran tp');
        $this->db2->where('tp.nama', $name);

        $sql = $this->db2->get();
        return $sql->num_rows();
    }

    public function get_transition_income_dpb_by_name($name = '')
    {
        $this->db2->select("tp.id_tagihan_pembayaran, tp.id_invoice, tp.nomor_siswa");
        $this->db2->from('transisi_tagihan_pembayaran tp');
        $this->db2->where('tp.nama', $name);

        $sql = $this->db2->get();
        return $sql->num_rows();
    }

    public function get_transition_income_du_by_number_name($number = "", $name = '')
    {
        $this->db2->select("tp.id_tagihan_pembayaran, tp.id_invoice, tp.nomor_siswa");
        $this->db2->from('transisi_tagihan_pembayaran tp');
        $this->db2->where('tp.nama', $name);
        $this->db2->where('tp.nomor_siswa', $number);

        $sql = $this->db2->get();
        return $sql->num_rows();
    }

    public function get_transition_income_dpb_by_number_name($number = "", $name = '')
    {
        $this->db2->select("tp.id_tagihan_pembayaran, tp.id_invoice, tp.nomor_siswa");
        $this->db2->from('transisi_tagihan_pembayaran tp');
        $this->db2->where('tp.nama', $name);
        $this->db2->where('tp.nomor_siswa', $number);

        $sql = $this->db2->get();
        return $sql->num_rows();
    }

    public function get_income_du_by_nomor_pembayaran($nomor_pembayaran = '')
    {
        $this->db2->select("p.*,
                                s.nama_lengkap,
                                s.nis,
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('tagihan_pembayaran_du p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_du = p.nomor_siswa', 'left');

        $this->db2->where('s.nomor_pembayaran_du', $nomor_pembayaran);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_income_dpb_by_nomor_pembayaran($nomor_pembayaran = '')
    {
        $this->db2->select("p.*,
                                s.nama_lengkap,
                                s.nis,
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('tagihan_pembayaran_dpb p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_dpb = p.nomor_siswa', 'left');

        $this->db2->where('s.nomor_pembayaran_dpb', $nomor_pembayaran);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_all_income_du()
    {
        $this->db2->select("p.*,
                                s.nama_lengkap,
                                s.nis,
                                s.level_tingkat,
                                s.nomor_pembayaran_du,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_du,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('tagihan_pembayaran_du p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_du = p.nomor_siswa', 'left');
        $this->db2->order_by('p.id_tagihan_pembayaran_du', 'DESC');

        $sql = $this->db2->get();
        return $sql->result_array();
    }

    public function get_all_income_dpb()
    {
        $this->db2->select("p.*,
                                s.nama_lengkap,
                                s.nis,
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_dpb,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('tagihan_pembayaran_dpb p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_dpb = p.nomor_siswa', 'left');

        $this->db2->order_by('p.id_tagihan_pembayaran_dpb', 'DESC');

        $sql = $this->db2->get();
        return $sql->result_array();
    }

    public function get_all_transition_income_dpb()
    {
        $this->db2->select("p.*,
                                s.nama_lengkap,
                                s.nis,
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.nominal_tagihan_dpb,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('transisi_tagihan_pembayaran p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_dpb = p.nomor_siswa', 'left');
        $this->db2->order_by('p.inserted_at', 'DESC');

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_all_transition_income_dpb_update()
    {
        $this->db2->select("p.*,
                                s.nama_lengkap,
                                s.nis,
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.nominal_tagihan_dpb,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('transisi_tagihan_pembayaran p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_dpb = p.nomor_siswa', 'left');

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
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.nominal_tagihan_dpb,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('transisi_tagihan_pembayaran p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_dpb = p.nomor_siswa', 'left');

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
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_dpb,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('tagihan_pembayaran_dpb p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_dpb = p.nomor_siswa', 'left');

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
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.email,
                                s.nominal_tagihan_dpb,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('tagihan_pembayaran_dpb p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_dpb = p.nomor_siswa', 'left');

        $this->db2->where('p.status_pembayaran', "SUKSES");
        $this->db2->where('p.id_invoice IN (SELECT tp.id_invoice FROM transisi_tagihan_pembayaran tp)');
        $this->db2->order_by('p.inserted_at', 'DESC');

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_all_transition_income_du()
    {
        $this->db2->select("p.*,
                                s.nama_lengkap,
                                s.nis,
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.nominal_tagihan_du,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('transisi_tagihan_pembayaran p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_du = p.nomor_siswa', 'left');
        $this->db2->order_by('p.id_tagihan_pembayaran', 'ASC');

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_all_transition_income_du_update()
    {
        $this->db2->select("p.*,
                                s.nama_lengkap,
                                s.nis,
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.nominal_tagihan_du,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('transisi_tagihan_pembayaran p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_du = p.nomor_siswa', 'left');

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
                                s.nomor_pembayaran_du,
                                s.nomor_pembayaran_dpb,
                                s.nomor_handphone,
                                s.nominal_tagihan_du,
                                ta.semester,
                                CONCAT(ta.tahun_awal,'/',ta.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.waktu_transaksi, '%d/%m/%Y') AS tanggal_transaksi,
                                TIME(p.waktu_transaksi) AS waktu_transaksi,
                                DATE_FORMAT(p.tanggal_invoice, '%d/%m/%Y') AS tanggal_invoice,
                                MONTH(p.inserted_at) AS bulan_invoice,
                                TIME(p.inserted_at) AS waktu_invoice
                         ");
        $this->db2->from('transisi_tagihan_pembayaran p');
        $this->db2->join('tahun_ajaran ta', 'p.th_ajaran = ta.id_tahun_ajaran', 'left');
        $this->db2->join('siswa s', 's.nomor_pembayaran_du = p.nomor_siswa', 'left');

        $this->db2->where('p.id_invoice IN (SELECT tp.id_invoice FROM tagihan_pembayaran_du tp WHERE tp.status_pembayaran = "SUKSES")');
        $this->db2->order_by('p.inserted_at', 'DESC');

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function accept_import_data_siswa_du($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->query("REPLACE INTO siswa(
											nis,
											nomor_pembayaran_dpb,
											nomor_pembayaran_du,
											password,
											level_tingkat,
											nama_lengkap,
											nomor_handphone,
											email,
											th_ajaran
										)
										SELECT
											panel_utsman.ttp.nomor_siswa,
											CONCAT(
												'9',
												SUBSTRING(panel_utsman.ttp.nomor_siswa, 2)
											) AS nomor_pembayaran_dpb,
											panel_utsman.ttp.nomor_siswa,
											panel_utsman.ttp.password,
											panel_utsman.ttp.level_tingkat,
											panel_utsman.ttp.nama,
											panel_utsman.ttp.nomor_hp,
											panel_utsman.ttp.email,
											panel_utsman.ttp.th_ajaran
										FROM
											panel_utsman.transisi_tagihan_pembayaran ttp
										WHERE
											panel_utsman.ttp.id_tagihan_pembayaran IN ($id)");

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function accept_import_data_siswa_dpb($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->query("REPLACE INTO siswa(
											nis,
											nomor_pembayaran_dpb,
											nomor_pembayaran_du,
											password,
											level_tingkat,
											nama_lengkap,
											nomor_handphone,
											email,
											th_ajaran
										)
										SELECT
											panel_utsman.ttp.nomor_siswa,
											panel_utsman.ttp.nomor_siswa,
											CONCAT(
												'8',
												SUBSTRING(panel_utsman.ttp.nomor_siswa, 2)
											) AS nomor_pembayaran_du,
											panel_utsman.ttp.password,
											panel_utsman.ttp.level_tingkat,
											panel_utsman.ttp.nama,
											panel_utsman.ttp.nomor_hp,
											panel_utsman.ttp.email,
											panel_utsman.ttp.th_ajaran
										FROM
											panel_utsman.transisi_tagihan_pembayaran ttp
										WHERE
											panel_utsman.ttp.id_tagihan_pembayaran IN ($id)");

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function accept_import_data_payment_du($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->query("REPLACE INTO tagihan_pembayaran_du(
                                        id_invoice,
                                        level_tingkat,
                                        tipe_tagihan,
                                        tanggal_invoice,
                                        nomor_siswa,
                                        nama,
                                        nominal_tagihan,
                                        informasi,
										nama_kelas,
                                        rincian,
                                        catatan,
										email,
										nomor_hp,
                                        th_ajaran,
                                        status_pembayaran
                                    )
                                    SELECT
                                       	panel_utsman.ttp.id_invoice,
                                        panel_utsman.ttp.level_tingkat,
                                        panel_utsman.ttp.tipe_tagihan,
                                        panel_utsman.ttp.tanggal_invoice,
                                        panel_utsman.ttp.nomor_siswa,
                                        panel_utsman.ttp.nama,
                                        panel_utsman.ttp.nominal_tagihan,
                                        panel_utsman.ttp.informasi,
										panel_utsman.ttp.nama_kelas,
                                        panel_utsman.ttp.rincian,
                                        panel_utsman.ttp.catatan,
										panel_utsman.ttp.email,
                                        panel_utsman.ttp.nomor_hp,
                                        panel_utsman.ttp.th_ajaran,
                                        panel_utsman.ttp.status_pembayaran
                                    FROM
                                        panel_utsman.transisi_tagihan_pembayaran ttp
                                    WHERE
                                        panel_utsman.ttp.id_tagihan_pembayaran IN ($id)");

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function accept_import_data_payment_dpb($id = '')
    {
        $this->db2->trans_begin();

        $this->db2->query("REPLACE INTO tagihan_pembayaran_dpb(
                                        id_invoice,
                                        level_tingkat,
                                        tipe_tagihan,
                                        tanggal_invoice,
                                        nomor_siswa,
                                        nama,
                                        nominal_tagihan,
                                        informasi,
										nama_kelas,
                                        rincian,
                                        catatan,
										email,
										nomor_hp,
                                        th_ajaran,
                                        status_pembayaran
                                    )
                                    SELECT
                                       	panel_utsman.ttp.id_invoice,
                                        panel_utsman.ttp.level_tingkat,
                                        panel_utsman.ttp.tipe_tagihan,
                                        panel_utsman.ttp.tanggal_invoice,
                                        panel_utsman.ttp.nomor_siswa,
                                        panel_utsman.ttp.nama,
                                        panel_utsman.ttp.nominal_tagihan,
                                        panel_utsman.ttp.informasi,
										panel_utsman.ttp.nama_kelas,
                                        panel_utsman.ttp.rincian,
                                        panel_utsman.ttp.catatan,
										panel_utsman.ttp.email,
                                        panel_utsman.ttp.nomor_hp,
                                        panel_utsman.ttp.th_ajaran,
                                        panel_utsman.ttp.status_pembayaran
                                    FROM
                                        panel_utsman.transisi_tagihan_pembayaran ttp
                                    WHERE
                                        panel_utsman.ttp.id_tagihan_pembayaran IN ($id)");

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_income_dpb_and_student($value = '')
    {
        $this->db2->trans_begin();

        $data_invoice = array(
            'id_invoice' => $value['nomor_invoice'],
            'tipe_tagihan' => 2,
            'nomor_siswa' => $value['nomor_pembayaran'],
            'nominal_tagihan' => $value['nominal_tagihan'],
            'nama' => $value['nama_siswa'],
            'level_tingkat' => $value['level_tingkat'],
            'tanggal_invoice' => $value['tanggal_invoice'],
            'th_ajaran' => $value['tahun_ajaran'],
            'nama_kelas' => @$value['nama_kelas'],
            'email' => @$value['email'],
            'nomor_hp' => @$value['nomor_hp'],
            'rincian' => @$value['rincian'],
            'informasi' => @$value['informasi'],
            'catatan' => @$value['catatan'],
            'status_pembayaran' => "MENUNGGU",
        );

        $data_profile = array(
            'nis' => $value['nomor_pembayaran'],
            'nomor_pembayaran_du' => "8" . substr($value['nomor_pembayaran'], 1),
            'nomor_pembayaran_dpb' => $value['nomor_pembayaran'],
            'password' => $value['password'],
            'nama_lengkap' => $value['nama_siswa'],
            'level_tingkat' => $value['level_tingkat'],
            'th_ajaran' => $value['th_ajaran'],
            'email' => @$value['email'],
            'nomor_handphone' => @$value['nomor_hp'],
        );

        $this->db2->insert($this->table_income_dpb, $data_invoice);

        $this->db2->where('nomor_pembayaran_dpb', $value['nomor_pembayaran']);
        $this->db2->replace($this->table_student, $data_profile);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function insert_income_du_and_student($value = '')
    {
        $this->db2->trans_begin();

        $data_invoice = array(
            'id_invoice' => $value['nomor_invoice'],
            'tipe_tagihan' => 1,
            'nomor_siswa' => $value['nomor_pembayaran'],
            'nominal_tagihan' => $value['nominal_tagihan'],
            'nama' => $value['nama_siswa'],
            'level_tingkat' => $value['level_tingkat'],
            'tanggal_invoice' => $value['tanggal_invoice'],
            'th_ajaran' => $value['tahun_ajaran'],
            'nama_kelas' => @$value['nama_kelas'],
            'email' => @$value['email'],
            'nomor_hp' => @$value['nomor_hp'],
            'rincian' => @$value['rincian'],
            'informasi' => @$value['informasi'],
            'catatan' => @$value['catatan'],
            'status_pembayaran' => "MENUNGGU",
        );

        $data_profile = array(
            'nis' => $value['nis'],
            'nomor_pembayaran_du' => $value['nomor_pembayaran'],
            'nomor_pembayaran_dpb' => "9" . substr($value['nomor_pembayaran'], 1),
            'nama_lengkap' => $value['nama_siswa'],
            'password' => $value['password'],
            'level_tingkat' => $value['level_tingkat'],
            'th_ajaran' => $value['th_ajaran'],
            'email' => @$value['email'],
            'nomor_handphone' => @$value['nomor_hp'],
        );

        $this->db2->insert($this->table_income_du, $data_invoice);

        $this->db2->where('nomor_pembayaran_du', $value['nomor_pembayaran']);
        $this->db2->replace($this->table_student, $data_profile);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_income_dpb_and_student($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data_invoice = array(
            'id_invoice' => $value['nomor_invoice'],
            'tipe_tagihan' => 2,
            'nomor_siswa' => $value['nomor_pembayaran'],
            'nominal_tagihan' => $value['nominal_tagihan'],
            'nama' => $value['nama_siswa'],
            'level_tingkat' => $value['level_tingkat'],
            'tanggal_invoice' => $value['tanggal_invoice'],
            'nama_kelas' => @$value['nama_kelas'],
            'email' => @$value['email'],
            'nomor_hp' => @$value['nomor_hp'],
            'rincian' => @$value['rincian'],
            'informasi' => @$value['informasi'],
            'catatan' => @$value['catatan'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $data_profile = array(
            'nis' => $value['nomor_pembayaran'],
            'nomor_pembayaran_du' => "8" . substr($value['nomor_pembayaran'], 1),
            'nomor_pembayaran_dpb' => $value['nomor_pembayaran'],
            'password' => $value['password'],
            'nama_lengkap' => $value['nama_siswa'],
            'level_tingkat' => $value['level_tingkat'],
            'email' => @$value['email'],
            'nomor_handphone' => @$value['nomor_hp'],
            'th_ajaran' => $value['th_ajaran'],
        );

        $this->db2->where('id_tagihan_pembayaran_dpb', $id);
        $this->db2->update($this->table_income_dpb, $data_invoice);

        $this->db2->where('nomor_pembayaran_dpb', $value['nomor_pembayaran']);
        $this->db2->replace($this->table_student, $data_profile);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_income_du_and_student($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data_invoice = array(
            'id_invoice' => $value['nomor_invoice'],
            'nomor_siswa' => $value['nomor_pembayaran'],
            'nominal_tagihan' => $value['nominal_tagihan'],
            'nama' => $value['nama_siswa'],
            'level_tingkat' => $value['level_tingkat'],
            'tanggal_invoice' => $value['tanggal_invoice'],
            'nama_kelas' => @$value['nama_kelas'],
            'email' => @$value['email'],
            'nomor_hp' => @$value['nomor_hp'],
            'rincian' => @$value['rincian'],
            'informasi' => @$value['informasi'],
            'catatan' => @$value['catatan'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $data_profile = array(
            'nis' => $value['nis'],
            'nomor_pembayaran_du' => $value['nomor_pembayaran'],
            'nomor_pembayaran_dpb' => "9" . substr($value['nomor_pembayaran'], 1),
            'nama_lengkap' => $value['nama_siswa'],
            'password' => $value['password'],
            'level_tingkat' => $value['level_tingkat'],
            'email' => @$value['email'],
            'nomor_handphone' => @$value['nomor_hp'],
            'th_ajaran' => $value['th_ajaran'],
        );

        $this->db2->where('id_tagihan_pembayaran_du', $id);
        $this->db2->update($this->table_income_du, $data_invoice);

        $this->db2->where('nomor_pembayaran_du', $value['nomor_pembayaran']);
        $this->db2->replace($this->table_student, $data_profile);

        if ($this->db2->trans_status() === false) {
            $this->db2->trans_rollback();
            return false;
        } else {
            $this->db2->trans_commit();
            return true;
        }
    }

    public function update_income_payment_transition($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_invoice' => $value['id_invoice'],
            'nomor_siswa' => $value['nomor_bayar'],
            'nama' => $value['nama'],
            'password' => $value['password'],
            'tanggal_invoice' => $value['tanggal_invoice'],
            'nominal_tagihan' => $value['nominal_tagihan'],
            'th_ajaran' => $value['tahun_ajaran'],
            'level_tingkat' => $value['level_tingkat'],
            'email' => @$value['email'],
            'nomor_hp' => @$value['nomor_hp'],
            'informasi' => @$value['informasi'],
            'catatan' => @$value['catatan'],
            'rincian' => @$value['rincian'],
            'status_invoice_duplikat' => $value['status_invoice_duplikat'],
            'status_nomor_terdaftar' => $value['status_nomor_terdaftar'],
            'status_nama_duplikat' => $value['status_nama_duplikat'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db2->where('id_tagihan_pembayaran', $id);
        $this->db2->update($this->table_payment_transition, $data);

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

    public function delete_income_transition_by_id($value)
    {
        $this->db2->trans_begin();

        $this->db2->where('id_tagihan_pembayaran', $value);
        $this->db2->delete($this->table_payment_transition);

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
