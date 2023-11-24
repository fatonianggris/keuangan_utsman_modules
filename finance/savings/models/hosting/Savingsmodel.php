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
    private $table_savings = 'transaksi_tabungan';
    private $table_student = 'siswa';
    private $table_contact = 'kontak';

    private $table_vstudent = 'view_siswa';

    //
    //------------------------------COUNT--------------------------------//
    //
    public function get_new_transaction()
    {
        $sql = $this->db->query("SELECT
										u8514965_panel_utsman.tt.id_transaksi,
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
											u8514965_panel_utsman.view_max_id_transaction vmax
										WHERE
											u8514965_panel_utsman.tt.id_transaksi = u8514965_panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan tt
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
										u8514965_panel_utsman.tt.id_transaksi
									DESC LIMIT 5");
        return $sql->result();
    }

    public function get_transaction_credit_insight()
    {
        $sql = $this->db->query("SELECT
										th.*,
										(
										SELECT
											COALESCE(SUM(tt.nominal),0)
										FROM
											(
											SELECT
												u8514965_panel_utsman.tb.id_transaksi,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 1 AND u8514965_panel_utsman.tdpb.informasi LIKE('%TK%') OR u8514965_panel_utsman.tdpb.informasi LIKE('%KB%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi
										) tt
									WHERE
										tt.th_ajaran = th.id_tahun_ajaran
									) AS total_kredit_kbtk,
									(
										SELECT
											COALESCE(SUM(tt.nominal), 0)
										FROM
											(
											SELECT
												u8514965_panel_utsman.tb.id_transaksi,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 1 AND u8514965_panel_utsman.tdpb.informasi LIKE('%SD%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi
										) tt
									WHERE
										tt.th_ajaran = th.id_tahun_ajaran
									) AS total_kredit_sd,
									(
										SELECT
											COALESCE(SUM(tt.nominal), 0)
										FROM
											(
											SELECT
												u8514965_panel_utsman.tb.id_transaksi,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 1 AND u8514965_panel_utsman.tdpb.informasi LIKE('%SMP%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi
										) tt
									WHERE
										tt.th_ajaran = th.id_tahun_ajaran
									) AS total_kredit_smp,
									CONCAT(
										'TA. ',
										th.tahun_awal,
										'/',
										th.tahun_akhir
									) AS tahun
									FROM
										tahun_ajaran th
									WHERE
										(th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND th.semester = 'ganjil'
									ORDER BY
										th.tahun_awal ASC");
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
												u8514965_panel_utsman.tb.id_transaksi,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 2 AND u8514965_panel_utsman.tdpb.informasi LIKE('%TK%') OR u8514965_panel_utsman.tdpb.informasi LIKE('%KB%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi
										) tt
									WHERE
										tt.th_ajaran = th.id_tahun_ajaran
									) AS total_debet_kbtk,
									(
										SELECT
											COALESCE(SUM(tt.nominal), 0)
										FROM
											(
											SELECT
												u8514965_panel_utsman.tb.id_transaksi,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 2 AND u8514965_panel_utsman.tdpb.informasi LIKE('%SD%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi
										) tt
									WHERE
										tt.th_ajaran = th.id_tahun_ajaran
									) AS total_debet_sd,
									(
										SELECT
											COALESCE(SUM(tt.nominal), 0)
										FROM
											(
											SELECT
												u8514965_panel_utsman.tb.id_transaksi,
												u8514965_panel_utsman.tb.nominal,
												u8514965_panel_utsman.tb.nis_siswa,
												u8514965_panel_utsman.tb.th_ajaran,
												u8514965_panel_utsman.tdpb.informasi
											FROM
												u8514965_panel_utsman.transaksi_tabungan tb
											LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
												u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
											WHERE
												u8514965_panel_utsman.tb.status_kredit_debet = 2 AND u8514965_panel_utsman.tdpb.informasi LIKE('%SMP%')
											GROUP BY
												u8514965_panel_utsman.tb.id_transaksi
										) tt
									WHERE
										tt.th_ajaran = th.id_tahun_ajaran
									) AS total_debet_smp,
									CONCAT(
										'TA. ',
										th.tahun_awal,
										'/',
										th.tahun_akhir
									) AS tahun
									FROM
										tahun_ajaran th
									WHERE
										(th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND th.semester = 'ganjil'
									ORDER BY
										th.tahun_awal ASC");
        return $sql->result();
    }

    public function get_credit_debet_insight()
    {
        $sql = $this->db->query("SELECT
									th.*,
									(
									SELECT
										COALESCE(SUM(tt.nominal),0)
									FROM
										(
										SELECT
											u8514965_panel_utsman.tb.id_transaksi,
											u8514965_panel_utsman.tb.nominal,
											u8514965_panel_utsman.tb.nis_siswa,
											u8514965_panel_utsman.tb.th_ajaran,
											u8514965_panel_utsman.tdpb.informasi
										FROM
											u8514965_panel_utsman.transaksi_tabungan tb
										LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
											u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
										WHERE
											u8514965_panel_utsman.tb.status_kredit_debet = 1
										GROUP BY
											u8514965_panel_utsman.tb.id_transaksi
									) tt
								WHERE
									tt.th_ajaran = th.id_tahun_ajaran
								) AS total_kredit,
								(
									SELECT
										COALESCE(SUM(tt.nominal), 0)
									FROM
										(
										SELECT
											u8514965_panel_utsman.tb.id_transaksi,
											u8514965_panel_utsman.tb.nominal,
											u8514965_panel_utsman.tb.nis_siswa,
											u8514965_panel_utsman.tb.th_ajaran,
											u8514965_panel_utsman.tdpb.informasi
										FROM
											u8514965_panel_utsman.transaksi_tabungan tb
										LEFT JOIN u8514965_panel_utsman.tagihan_pembayaran_dpb tdpb ON
											u8514965_panel_utsman.tb.nis_siswa = u8514965_panel_utsman.tdpb.nomor_siswa
										WHERE
											u8514965_panel_utsman.tb.status_kredit_debet = 2
										GROUP BY
											u8514965_panel_utsman.tb.id_transaksi
									) tt
								WHERE
									tt.th_ajaran = th.id_tahun_ajaran
								) AS total_debet,
								CONCAT(
									'TA. ',
									th.tahun_awal,
									'/',
									th.tahun_akhir
								) AS tahun
								FROM
									tahun_ajaran th
								WHERE
									(th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND th.semester = 'ganjil'
								ORDER BY
									th.tahun_awal ASC");
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

    public function get_student_by_nis($nis_student = '')
    {
        $this->db2->select('s.nis, s.nama_lengkap, s.saldo_tabungan, s.nama_wali, s.email, tpd.informasi');
        $this->db2->from('view_siswa s');
        $this->db2->join('tagihan_pembayaran_dpb tpd', 's.nis = tpd.nomor_siswa', 'left');
        $this->db2->where('s.nis', $nis_student);
        $this->db2->order_by('tpd.id_tagihan_pembayaran_dpb', 'DESC');
        $this->db2->limit(1);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_info_student_transaction($nis_student = '')
    {
        $this->db2->select("nis_siswa, catatan, nominal, saldo, th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan');
        $this->db2->where('nis_siswa', $nis_student);
        $this->db2->order_by('waktu_transaksi', 'DESC');
        $this->db2->limit(1);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function get_data_saving_export_all($id = '')
    {
        $sql = $this->db->query("SELECT
								u8514965_panel_utsman.tt.id_transaksi,
								u8514965_panel_utsman.tt.nis_siswa,
								u8514965_panel_utsman.s.nama_lengkap,
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
									u8514965_panel_utsman.view_max_id_transaction vmax
								WHERE
									u8514965_panel_utsman.tt.id_transaksi = u8514965_panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								u8514965_panel_utsman.transaksi_tabungan tt
							LEFT JOIN u8514965_panel_utsman.siswa s
							ON
								u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tt.nis_siswa
							LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
							ON
								u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
							LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
							ON
								u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
							WHERE u8514965_panel_utsman.tt.id_transaksi IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi
							DESC");

        return $sql->result();
    }

    public function get_student_transaction_recap_by_nis($nis = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
                                    u8514965_panel_utsman.tt.id_transaksi,
                                    u8514965_panel_utsman.tt.nis_siswa,
                                    u8514965_panel_utsman.s.nama_lengkap,
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
                                        u8514965_panel_utsman.view_max_id_transaction vmax
                                    WHERE
                                        u8514965_panel_utsman.tt.id_transaksi = u8514965_panel_utsman.vmax.id_max
                                ) THEN 1 ELSE 0
                                END AS status_edit
                                FROM
                                    u8514965_panel_utsman.transaksi_tabungan tt
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
                                    u8514965_panel_utsman.tt.id_transaksi
                                DESC");
        return $sql->result();
    }
    public function get_all_transaction_savings($start_date = '', $end_date = '')
    {
        $sql = $this->db->query("SELECT
                                    u8514965_panel_utsman.tt.id_transaksi,
                                    u8514965_panel_utsman.tt.nis_siswa,
                                    u8514965_panel_utsman.s.nama_lengkap,
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
                                        u8514965_panel_utsman.view_max_id_transaction vmax
                                    WHERE
                                        u8514965_panel_utsman.tt.id_transaksi = u8514965_panel_utsman.vmax.id_max
                                ) THEN 1 ELSE 0
                                END AS status_edit
                                FROM
                                    u8514965_panel_utsman.transaksi_tabungan tt
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
                                    u8514965_panel_utsman.tt.id_transaksi
                                DESC");
        return $sql->result();
    }

    public function get_student_balance($nis_student = '')
    {

        $this->db2->select('id_siswa, nis, nama_lengkap, saldo_tabungan');
        $this->db2->where('nis', $nis_student);
        $sql = $this->db2->get($this->table_student);
        return $sql->result();
    }

    public function get_student_transaction_last($id_transaction = '')
    {

        $this->db2->select("nis_siswa, catatan, saldo, nominal ,th_ajaran, status_kredit_debet, DATE_FORMAT(waktu_transaksi, '%d/%m/%Y %H:%i:%s') AS waktu_transaksi, tanggal_transaksi");
        $this->db2->from('transaksi_tabungan');
        $this->db2->where('id_transaksi', $id_transaction);

        $sql = $this->db2->get();
        return $sql->result();
    }

    public function insert_credit_saving($id = '', $value = '')
    {
        $this->db2->trans_begin();

        $data = array(
            'id_pegawai' => $id,
            'nis_siswa' => $value['nis'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings, $data);

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
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_kredit'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->where('id_transaksi', $id);
        $this->db2->update($this->table_savings, $data);

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
            'nis_siswa' => $value['nis'],
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'status_kredit_debet' => $value['status_kredit_debet'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->insert($this->table_savings, $data);

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
            'nominal' => $value['nominal'],
            'saldo' => $value['saldo_akhir'],
            'catatan' => $value['catatan_debet'],
            'tanggal_transaksi' => $value['tanggal_transaksi'],
            'th_ajaran' => $value['tahun_ajaran'],
        );

        $this->db2->where('id_transaksi', $id);
        $this->db2->update($this->table_savings, $data);

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
            'saldo_tabungan' => $saldo,
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

        $this->db2->where('id_transaksi', $id);
        $this->db2->delete($this->table_savings);

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
