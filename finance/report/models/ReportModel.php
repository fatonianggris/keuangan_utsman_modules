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
									u8514965_panel_utsman.s.id_siswa,
									u8514965_panel_utsman.s.nis,
									u8514965_panel_utsman.s.level_tingkat,
									u8514965_panel_utsman.s.nama_lengkap,
									u8514965_panel_utsman.s.jenis_kelamin,
									u8514965_panel_utsman.s.nomor_handphone,
									u8514965_panel_utsman.s.email,
									u8514965_panel_utsman.s.jalur,
									(
									SELECT
										COALESCE(SUM(u8514965_panel_utsman.ttu.nominal),
										0)
									FROM
										u8514965_panel_utsman.transaksi_tabungan_umum ttu
									WHERE
										u8514965_panel_utsman.ttu.nis_siswa = u8514965_panel_utsman.s.nis AND u8514965_panel_utsman.ttu.status_kredit_debet = 1 AND(
											DATE_FORMAT(
											u8514965_panel_utsman.ttu.waktu_transaksi,
											'%Y-%m-%d'
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
												DATE_FORMAT(
												u8514965_panel_utsman.ttu.waktu_transaksi,
												'%Y-%m-%d'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_umum,
									(
										SELECT
											COALESCE(u8514965_panel_utsman.ttu.saldo, 0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_umum ttu
										WHERE
											u8514965_panel_utsman.ttu.nis_siswa = u8514965_panel_utsman.s.nis AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttu.waktu_transaksi,
												'%Y-%m-%d'
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
										u8514965_panel_utsman.ttq.nis_siswa = u8514965_panel_utsman.s.nis AND u8514965_panel_utsman.ttq.status_kredit_debet = 1 AND(
											DATE_FORMAT(
											u8514965_panel_utsman.ttq.waktu_transaksi,
											'%Y-%m-%d'
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
											u8514965_panel_utsman.ttq.nis_siswa = u8514965_panel_utsman.s.nis AND u8514965_panel_utsman.ttq.status_kredit_debet = 2 AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttq.waktu_transaksi,
												'%Y-%m-%d'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_qurban,
									(
										SELECT
											COALESCE(u8514965_panel_utsman.ttq.saldo, 0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_qurban ttq
										WHERE
											u8514965_panel_utsman.ttq.nis_siswa = u8514965_panel_utsman.s.nis AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttq.waktu_transaksi,
												'%Y-%m-%d'
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
											DATE_FORMAT(
											u8514965_panel_utsman.ttw.waktu_transaksi,
											'%Y-%m-%d'
											) BETWEEN '$start_date' AND '$end_date'
										)
									) AS kredit_wisata,
									(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.ttw.nominal),0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_wisata ttw
										WHERE
											u8514965_panel_utsman.ttw.nis_siswa = u8514965_panel_utsman.s.nis AND u8514965_panel_utsman.ttw.status_kredit_debet = 2 AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttw.waktu_transaksi,
												'%Y-%m-%d'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_wisata,
									(
										SELECT
											COALESCE(u8514965_panel_utsman.ttw.saldo, 0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_wisata ttw
										WHERE
											u8514965_panel_utsman.ttw.nis_siswa = u8514965_panel_utsman.s.nis AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttw.waktu_transaksi,
												'%Y-%m-%d'
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
									) AS tahun_ajaran,
									u8514965_panel_utsman.s.th_ajaran
								FROM
									u8514965_panel_utsman.siswa s
								LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
								ON
									u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.s.th_ajaran
								WHERE u8514965_panel_utsman.s.id_siswa IN ($id)
								ORDER BY
									u8514965_panel_utsman.s.id_siswa
								DESC");

        return $sql->result_array();
    }

    public function get_data_employee_saving_excel_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										u8514965_panel_utsman.p.id_pegawai,
										u8514965_panel_utsman.p.id_jabatan,
										u8514965_panel_utsman.p.nip,
										u8514965_panel_utsman.p.level_tingkat,
										u8514965_panel_utsman.p.nama_lengkap,
										u8514965_panel_utsman.p.jenis_kelamin,
										u8514965_panel_utsman.p.nomor_hp,
										u8514965_panel_utsman.p.email,
										u8514965_panel_utsman.p.jenis_pegawai,
										u8514965_panel_utsman.p.th_ajaran,
										u8514965_panel_utsman.jb.id_jabatan,
										u8514965_panel_utsman.jb.hasil_nama_jabatan,
										(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.ttu.nominal),
											0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_umum_pegawai ttu
										WHERE
											u8514965_panel_utsman.ttu.nip_pegawai = u8514965_panel_utsman.p.nip AND u8514965_panel_utsman.ttu.status_kredit_debet = 1 AND(
											DATE_FORMAT(
											u8514965_panel_utsman.ttu.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
                                            )
										) AS kredit_umum,
										(
											SELECT
												COALESCE(SUM(u8514965_panel_utsman.ttu.nominal),
												0)
											FROM
												u8514965_panel_utsman.transaksi_tabungan_umum_pegawai ttu
											WHERE
												u8514965_panel_utsman.ttu.nip_pegawai = u8514965_panel_utsman.p.nip AND u8514965_panel_utsman.ttu.status_kredit_debet = 2 AND(
													DATE_FORMAT(
                                                    u8514965_panel_utsman.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_umum,
										(
											SELECT
												COALESCE(u8514965_panel_utsman.ttu.saldo, 0)
											FROM u8514965_panel_utsman.transaksi_tabungan_umum_pegawai ttu
											WHERE
												u8514965_panel_utsman.ttu.nip_pegawai = u8514965_panel_utsman.p.nip AND(
													DATE_FORMAT(
                                                    u8514965_panel_utsman.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												u8514965_panel_utsman.ttu.id_transaksi_umum_pegawai
											DESC LIMIT 1
										) AS saldo_umum,
										CONCAT(
                                        u8514965_panel_utsman.ta.tahun_awal,
                                        '/',
                                        u8514965_panel_utsman.ta.tahun_akhir
                                    	) AS tahun_ajaran
									FROM
										pegawai p
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
                                	ON
                                    	u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.p.th_ajaran
									LEFT JOIN u8514965_panel_utsman.jabatan jb
                                	ON
                                    	u8514965_panel_utsman.jb.id_jabatan = u8514965_panel_utsman.p.id_jabatan
									WHERE p.level_tingkat != '0' AND u8514965_panel_utsman.p.id_pegawai IN ($id)
									ORDER BY
										u8514965_panel_utsman.p.id_pegawai
									DESC");

        return $sql->result_array();
    }

    public function get_data_joint_saving_excel_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										u8514965_panel_utsman.tb.id_tabungan_bersama,
										u8514965_panel_utsman.tb.id_penanggung_jawab,
										u8514965_panel_utsman.tb.nomor_rekening_bersama,
										u8514965_panel_utsman.tb.nama_tabungan_bersama,
										u8514965_panel_utsman.tb.keterangan_tabungan_bersama,
										u8514965_panel_utsman.tb.id_tingkat,
										u8514965_panel_utsman.tb.id_th_ajaran,
										u8514965_panel_utsman.tb.jenis_tabungan,
										COALESCE(NULLIF(u8514965_panel_utsman.s.nis, ''), u8514965_panel_utsman.p.nip) AS number,
										COALESCE(NULLIF(u8514965_panel_utsman.s.nama_wali, ''), u8514965_panel_utsman.p.nama_lengkap) AS nama_wali,
										COALESCE(NULLIF(u8514965_panel_utsman.s.nama_lengkap, ''), u8514965_panel_utsman.p.nama_lengkap) AS nama_lengkap,
										COALESCE(NULLIF(u8514965_panel_utsman.s.nomor_handphone, ''), u8514965_panel_utsman.p.nomor_hp) AS nomor_handphone,
										COALESCE(NULLIF(u8514965_panel_utsman.s.email, ''), u8514965_panel_utsman.p.email) AS email,
										(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.ttb.nominal),
											0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_bersama ttb
										WHERE
											u8514965_panel_utsman.ttb.nomor_rekening_bersama = u8514965_panel_utsman.tb.nomor_rekening_bersama AND u8514965_panel_utsman.ttb.status_kredit_debet = 1 AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttb.waktu_transaksi,
												'%Y-%m-%d'
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
												DATE_FORMAT(
												u8514965_panel_utsman.ttb.waktu_transaksi,
												'%Y-%m-%d'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_bersama,
									(
										SELECT
											COALESCE(u8514965_panel_utsman.ttb.nominal, 0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_bersama ttb
										WHERE
											u8514965_panel_utsman.ttb.nomor_rekening_bersama = u8514965_panel_utsman.tb.nomor_rekening_bersama AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttb.waktu_transaksi,
												'%Y-%m-%d'
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
										u8514965_panel_utsman.tabungan_bersama tb
									LEFT JOIN u8514965_panel_utsman.siswa s
									ON
										u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tb.id_penanggung_jawab
									LEFT JOIN
										u8514965_panel_utsman.pegawai p
									ON
										u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tb.id_penanggung_jawab
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tb.id_th_ajaran
									WHERE u8514965_panel_utsman.tb.id_tabungan_bersama IN ($id)
									ORDER BY
										u8514965_panel_utsman.tb.id_tabungan_bersama
									DESC");
        return $sql->result_array();
    }

    public function get_data_personal_saving_pdf_all($id = '', $start_date = '', $end_date = '')
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
									(
									SELECT
										COALESCE(SUM(u8514965_panel_utsman.ttu.nominal),
										0)
									FROM
										u8514965_panel_utsman.transaksi_tabungan_umum ttu
									WHERE
										u8514965_panel_utsman.ttu.nis_siswa = u8514965_panel_utsman.s.nis AND u8514965_panel_utsman.ttu.status_kredit_debet = 1 AND(
											DATE_FORMAT(
											u8514965_panel_utsman.ttu.waktu_transaksi,
											'%Y-%m-%d'
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
												DATE_FORMAT(
												u8514965_panel_utsman.ttu.waktu_transaksi,
												'%Y-%m-%d'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_umum,
									(
										SELECT
											COALESCE(u8514965_panel_utsman.ttu.saldo, 0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_umum ttu
										WHERE
											u8514965_panel_utsman.ttu.nis_siswa = u8514965_panel_utsman.s.nis AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttu.waktu_transaksi,
												'%Y-%m-%d'
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
										u8514965_panel_utsman.ttq.nis_siswa = u8514965_panel_utsman.s.nis AND u8514965_panel_utsman.ttq.status_kredit_debet = 1 AND(
											DATE_FORMAT(
											u8514965_panel_utsman.ttq.waktu_transaksi,
											'%Y-%m-%d'
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
											u8514965_panel_utsman.ttq.nis_siswa = u8514965_panel_utsman.s.nis AND u8514965_panel_utsman.ttq.status_kredit_debet = 2 AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttq.waktu_transaksi,
												'%Y-%m-%d'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_qurban,
									(
										SELECT
											COALESCE(u8514965_panel_utsman.ttq.saldo, 0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_qurban ttq
										WHERE
											u8514965_panel_utsman.ttq.nis_siswa = u8514965_panel_utsman.s.nis AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttq.waktu_transaksi,
												'%Y-%m-%d'
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
											DATE_FORMAT(
											u8514965_panel_utsman.ttw.waktu_transaksi,
											'%Y-%m-%d'
											) BETWEEN '$start_date' AND '$end_date'
										)
									) AS kredit_wisata,
									(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.ttw.nominal),0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_wisata ttw
										WHERE
											u8514965_panel_utsman.ttw.nis_siswa = u8514965_panel_utsman.s.nis AND u8514965_panel_utsman.ttw.status_kredit_debet = 2 AND(
											DATE_FORMAT(
											u8514965_panel_utsman.ttw.waktu_transaksi,
											'%Y-%m-%d'
											) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_wisata,
									(
										SELECT
											COALESCE(u8514965_panel_utsman.ttw.saldo, 0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_wisata ttw
										WHERE
											u8514965_panel_utsman.ttw.nis_siswa = u8514965_panel_utsman.s.nis AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttw.waktu_transaksi,
												'%Y-%m-%d'
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
									) AS tahun_ajaran,
									u8514965_panel_utsman.s.th_ajaran
								FROM
									u8514965_panel_utsman.siswa s
								LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
								ON
									u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.s.th_ajaran
								WHERE u8514965_panel_utsman.s.id_siswa IN ($id)
								ORDER BY
									u8514965_panel_utsman.s.id_siswa
								DESC");

        return $sql->result();
    }

    public function get_data_employee_saving_pdf_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										u8514965_panel_utsman.p.id_pegawai,
										u8514965_panel_utsman.p.id_jabatan,
										u8514965_panel_utsman.p.nip,
										u8514965_panel_utsman.p.level_tingkat,
										u8514965_panel_utsman.p.nama_lengkap,
										u8514965_panel_utsman.p.jenis_kelamin,
										u8514965_panel_utsman.p.nomor_hp,
										u8514965_panel_utsman.p.email,
										u8514965_panel_utsman.p.jenis_pegawai,
										u8514965_panel_utsman.p.th_ajaran,
										u8514965_panel_utsman.jb.id_jabatan,
										u8514965_panel_utsman.jb.hasil_nama_jabatan,
										(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.ttu.nominal),
											0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_umum_pegawai ttu
										WHERE
											u8514965_panel_utsman.ttu.nip_pegawai = u8514965_panel_utsman.p.nip AND u8514965_panel_utsman.ttu.status_kredit_debet = 1 AND(
											DATE_FORMAT(
											u8514965_panel_utsman.ttu.waktu_transaksi,
                                                '%Y-%m-%d'
                                                ) BETWEEN '$start_date' AND '$end_date'
                                            )
										) AS kredit_umum,
										(
											SELECT
												COALESCE(SUM(u8514965_panel_utsman.ttu.nominal),
												0)
											FROM
												u8514965_panel_utsman.transaksi_tabungan_umum_pegawai ttu
											WHERE
												u8514965_panel_utsman.ttu.nip_pegawai = u8514965_panel_utsman.p.nip AND u8514965_panel_utsman.ttu.status_kredit_debet = 2 AND(
													DATE_FORMAT(
                                                    u8514965_panel_utsman.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_umum,
										(
											SELECT
												COALESCE(u8514965_panel_utsman.ttu.saldo, 0)
											FROM u8514965_panel_utsman.transaksi_tabungan_umum_pegawai ttu
											WHERE
												u8514965_panel_utsman.ttu.nip_pegawai = u8514965_panel_utsman.p.nip AND(
													DATE_FORMAT(
                                                    u8514965_panel_utsman.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												u8514965_panel_utsman.ttu.id_transaksi_umum_pegawai
											DESC LIMIT 1
										) AS saldo_umum,
										CONCAT(
                                        u8514965_panel_utsman.ta.tahun_awal,
                                        '/',
                                        u8514965_panel_utsman.ta.tahun_akhir
                                    	) AS tahun_ajaran
									FROM
										pegawai p
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
                                	ON
                                    	u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.p.th_ajaran
									LEFT JOIN u8514965_panel_utsman.jabatan jb
                                	ON
                                    	u8514965_panel_utsman.jb.id_jabatan = u8514965_panel_utsman.p.id_jabatan
									WHERE p.level_tingkat != '0' AND u8514965_panel_utsman.p.id_pegawai IN ($id)
									ORDER BY
										u8514965_panel_utsman.p.id_pegawai
									DESC");
        return $sql->result();
    }

    public function get_data_joint_saving_pdf_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										u8514965_panel_utsman.tb.id_tabungan_bersama,
										u8514965_panel_utsman.tb.id_penanggung_jawab,
										u8514965_panel_utsman.tb.nomor_rekening_bersama,
										u8514965_panel_utsman.tb.nama_tabungan_bersama,
										u8514965_panel_utsman.tb.keterangan_tabungan_bersama,
										u8514965_panel_utsman.tb.id_tingkat,
										u8514965_panel_utsman.tb.id_th_ajaran,
										u8514965_panel_utsman.tb.jenis_tabungan,
										u8514965_panel_utsman.s.nama_wali,
										u8514965_panel_utsman.s.nis,
										u8514965_panel_utsman.s.nama_lengkap,
										u8514965_panel_utsman.s.nomor_handphone,
										u8514965_panel_utsman.s.email,
										COALESCE(NULLIF(u8514965_panel_utsman.s.nis, ''), u8514965_panel_utsman.p.nip) AS number,
										COALESCE(NULLIF(u8514965_panel_utsman.s.nama_wali, ''), u8514965_panel_utsman.p.nama_lengkap) AS nama_wali,
										COALESCE(NULLIF(u8514965_panel_utsman.s.nama_lengkap, ''), u8514965_panel_utsman.p.nama_lengkap) AS nama_lengkap,
										COALESCE(NULLIF(u8514965_panel_utsman.s.nomor_handphone, ''), u8514965_panel_utsman.p.nomor_hp) AS nomor_handphone,
										COALESCE(NULLIF(u8514965_panel_utsman.s.email, ''), u8514965_panel_utsman.p.email) AS email,
										(
										SELECT
											COALESCE(SUM(u8514965_panel_utsman.ttb.nominal),
											0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_bersama ttb
										WHERE
											u8514965_panel_utsman.ttb.nomor_rekening_bersama = u8514965_panel_utsman.tb.nomor_rekening_bersama AND u8514965_panel_utsman.ttb.status_kredit_debet = 1 AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttb.waktu_transaksi,
												'%Y-%m-%d'
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
												DATE_FORMAT(
												u8514965_panel_utsman.ttb.waktu_transaksi,
												'%Y-%m-%d'
												) BETWEEN '$start_date' AND '$end_date'
											)
									) AS debet_bersama,
									(
										SELECT
											COALESCE(u8514965_panel_utsman.ttb.nominal, 0)
										FROM
											u8514965_panel_utsman.transaksi_tabungan_bersama ttb
										WHERE
											u8514965_panel_utsman.ttb.nomor_rekening_bersama = u8514965_panel_utsman.tb.nomor_rekening_bersama AND(
												DATE_FORMAT(
												u8514965_panel_utsman.ttb.waktu_transaksi,
												'%Y-%m-%d'
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
										u8514965_panel_utsman.tabungan_bersama tb
									LEFT JOIN u8514965_panel_utsman.siswa s
									ON
										u8514965_panel_utsman.s.nis = u8514965_panel_utsman.tb.id_penanggung_jawab
									LEFT JOIN
										u8514965_panel_utsman.pegawai p
									ON
										u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tb.id_penanggung_jawab
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tb.id_th_ajaran
									WHERE u8514965_panel_utsman.tb.id_tabungan_bersama IN ($id)
									ORDER BY
										u8514965_panel_utsman.tb.id_tabungan_bersama
									DESC");
        return $sql->result();
    }

    public function get_data_saving_excel_transaction_joint_all($id = '')
    {
        $sql = $this->db->query("SELECT
									u8514965_panel_utsman.tt.nomor_transaksi_bersama,
									u8514965_panel_utsman.tt.nomor_rekening_bersama,
									u8514965_panel_utsman.tb.nama_tabungan_bersama,
									u8514965_panel_utsman.s.nama_lengkap,
									u8514965_panel_utsman.s.nama_wali,
									u8514965_keuangan_utsman.ak.nama_akun,
									u8514965_keuangan_utsman.ak.email_akun,
									u8514965_panel_utsman.tt.saldo,
									u8514965_panel_utsman.tt.id_tingkat,
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
										u8514965_panel_utsman.tt.id_transaksi_bersama = u8514965_panel_utsman.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									u8514965_panel_utsman.transaksi_tabungan_bersama tt
								LEFT JOIN u8514965_panel_utsman.tabungan_bersama tb
								ON
									u8514965_panel_utsman.tb.nomor_rekening_bersama = u8514965_panel_utsman.tt.nomor_rekening_bersama
								LEFT JOIN u8514965_panel_utsman.siswa s
								ON
									u8514965_panel_utsman.s.id_siswa = u8514965_panel_utsman.tb.id_penanggung_jawab
								LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
								ON
									u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
								LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
								ON
									u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
								WHERE u8514965_panel_utsman.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									u8514965_panel_utsman.tt.id_transaksi_bersama
								DESC");

        return $sql->result_array();
    }
    public function get_data_saving_excel_transaction_general_all($id = '')
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
							WHERE u8514965_panel_utsman.tt.id_transaksi_umum IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_umum
							DESC");

        return $sql->result_array();
    }

    public function get_data_saving_excel_transaction_general_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								u8514965_panel_utsman.tt.id_transaksi_umum_pegawai,
								u8514965_panel_utsman.tt.nomor_transaksi_umum,
								u8514965_panel_utsman.tt.nip_pegawai,
								u8514965_panel_utsman.tt.id_tingkat,
								u8514965_panel_utsman.p.nama_lengkap,
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
									u8514965_panel_utsman.view_max_id_transaction_general_employee vmax
								WHERE
									u8514965_panel_utsman.tt.id_transaksi_umum_pegawai = u8514965_panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								u8514965_panel_utsman.transaksi_tabungan_umum_pegawai tt
							LEFT JOIN u8514965_panel_utsman.pegawai p
							ON
								u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
							LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
							ON
								u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
							LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
							ON
								u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
							WHERE u8514965_panel_utsman.tt.id_transaksi_umum_pegawai IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_umum_pegawai
							DESC");

        return $sql->result_array();
    }
    public function get_data_saving_excel_transaction_qurban_all($id = '')
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
							WHERE u8514965_panel_utsman.tt.id_transaksi_qurban IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_qurban
							DESC");

        return $sql->result_array();
    }

    public function get_data_saving_excel_transaction_qurban_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai,
								u8514965_panel_utsman.tt.nomor_transaksi_qurban,
								u8514965_panel_utsman.tt.nip_pegawai,
								u8514965_panel_utsman.tt.id_tingkat,
								u8514965_panel_utsman.p.nama_lengkap,
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
									u8514965_panel_utsman.view_max_id_transaction_qurban_employee vmax
								WHERE
									u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai = u8514965_panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								u8514965_panel_utsman.transaksi_tabungan_qurban_pegawai tt
							LEFT JOIN u8514965_panel_utsman.pegawai p
							ON
								u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
							LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
							ON
								u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
							LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
							ON
								u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
							WHERE u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai
							DESC");

        return $sql->result_array();
    }

    public function get_data_saving_excel_transaction_tour_all($id = '')
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
							WHERE u8514965_panel_utsman.tt.id_transaksi_wisata IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_wisata
							DESC");

        return $sql->result_array();
    }

    public function get_data_saving_excel_transaction_tour_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai,
								u8514965_panel_utsman.tt.nomor_transaksi_wisata,
								u8514965_panel_utsman.tt.nip_pegawai,
								u8514965_panel_utsman.tt.id_tingkat,
								u8514965_panel_utsman.p.nama_lengkap,
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
									u8514965_panel_utsman.view_max_id_transaction_tour_employee vmax
								WHERE
									u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai = u8514965_panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								u8514965_panel_utsman.transaksi_tabungan_wisata_pegawai tt
							LEFT JOIN u8514965_panel_utsman.pegawai p
							ON
								u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
							LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
							ON
								u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
							LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
							ON
								u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
							WHERE u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai
							DESC");

        return $sql->result_array();
    }

    public function get_data_saving_excel_transaction_joint_recap_all($id = '')
    {
        $sql = $this->db->query("SELECT
									u8514965_panel_utsman.tt.nomor_transaksi_bersama,
									u8514965_panel_utsman.tt.nomor_rekening_bersama,
									u8514965_panel_utsman.tb.nama_tabungan_bersama,
									u8514965_panel_utsman.s.nama_lengkap,
									u8514965_panel_utsman.s.nama_wali,
									u8514965_keuangan_utsman.ak.nama_akun,
									u8514965_keuangan_utsman.ak.email_akun,
									u8514965_panel_utsman.tt.saldo,
									u8514965_panel_utsman.tt.id_tingkat,
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
										u8514965_panel_utsman.tt.id_transaksi_bersama = u8514965_panel_utsman.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									u8514965_panel_utsman.transaksi_tabungan_bersama tt
								LEFT JOIN u8514965_panel_utsman.tabungan_bersama tb
								ON
									u8514965_panel_utsman.tb.nomor_rekening_bersama = u8514965_panel_utsman.tt.nomor_rekening_bersama
								LEFT JOIN u8514965_panel_utsman.siswa s
								ON
									u8514965_panel_utsman.s.id_siswa = u8514965_panel_utsman.tb.id_penanggung_jawab
								LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
								ON
									u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
								LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
								ON
									u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
								WHERE u8514965_panel_utsman.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									u8514965_panel_utsman.tt.id_transaksi_bersama
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
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_umum IN ($id)
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
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_qurban IN ($id)
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
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_wisata IN ($id)
									ORDER BY
										id_transaksi DESC
									) RECAP
									ORDER BY
										jenis_tabungan DESC");
        return $sql->result_array();
    }
    public function get_data_saving_excel_transaction_employee_recap_all($id = '')
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
											u8514965_panel_utsman.tt.id_transaksi_umum_pegawai AS id_transaksi,
											u8514965_panel_utsman.tt.nomor_transaksi_umum AS nomor_transaksi,
											u8514965_panel_utsman.tt.nip_pegawai,
											u8514965_panel_utsman.tt.id_tingkat,
											u8514965_panel_utsman.p.nama_lengkap,
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
												u8514965_panel_utsman.view_max_id_transaction_general_employee vmax
											WHERE
												u8514965_panel_utsman.tt.id_transaksi_umum_pegawai = u8514965_panel_utsman.vmax.id_max
										) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_umum_pegawai tt
									LEFT JOIN u8514965_panel_utsman.pegawai p
									ON
										u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_umum IN ($id)
									UNION ALL
									SELECT
										u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai AS id_transaksi,
										u8514965_panel_utsman.tt.nomor_transaksi_qurban AS nomor_transaksi,
										u8514965_panel_utsman.tt.nip_pegawai,
										u8514965_panel_utsman.tt.id_tingkat,
										u8514965_panel_utsman.p.nama_lengkap,
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
											u8514965_panel_utsman.view_max_id_transaction_qurban_employee vmax
										WHERE
											u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai = u8514965_panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_qurban_pegawai tt
									LEFT JOIN u8514965_panel_utsman.pegawai p
									ON
										u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_qurban IN ($id)
									UNION ALL
									SELECT
										u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai AS id_transaksi,
										u8514965_panel_utsman.tt.nomor_transaksi_wisata AS nomor_transaksi,
										u8514965_panel_utsman.tt.nip_pegawai,
										u8514965_panel_utsman.tt.id_tingkat,
										u8514965_panel_utsman.p.nama_lengkap,
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
											u8514965_panel_utsman.view_max_id_transaction_tour_employee vmax
										WHERE
											u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai = u8514965_panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_wisata_pegawai tt
									LEFT JOIN u8514965_panel_utsman.pegawai p
									ON
										u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_wisata IN ($id)
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
									u8514965_panel_utsman.tt.nomor_transaksi_bersama,
									u8514965_panel_utsman.tt.nomor_rekening_bersama,
									u8514965_panel_utsman.tb.nama_tabungan_bersama,
									u8514965_panel_utsman.s.nama_lengkap,
									u8514965_panel_utsman.s.nama_wali,
									u8514965_keuangan_utsman.ak.nama_akun,
									u8514965_keuangan_utsman.ak.email_akun,
									u8514965_panel_utsman.tt.saldo,
									u8514965_panel_utsman.tt.id_tingkat,
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
										u8514965_panel_utsman.tt.id_transaksi_bersama = u8514965_panel_utsman.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									u8514965_panel_utsman.transaksi_tabungan_bersama tt
								LEFT JOIN u8514965_panel_utsman.tabungan_bersama tb
								ON
									u8514965_panel_utsman.tb.nomor_rekening_bersama = u8514965_panel_utsman.tt.nomor_rekening_bersama
								LEFT JOIN u8514965_panel_utsman.siswa s
								ON
									u8514965_panel_utsman.s.id_siswa = u8514965_panel_utsman.tb.id_penanggung_jawab
								LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
								ON
									u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
								LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
								ON
									u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
								WHERE u8514965_panel_utsman.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									u8514965_panel_utsman.tt.id_transaksi_bersama
								DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_general_all($id = '')
    {
        $sql = $this->db->query("SELECT
								u8514965_panel_utsman.tt.id_transaksi_umum,
								u8514965_panel_utsman.tt.nomor_transaksi_umum AS nomor_transaksi,
								u8514965_panel_utsman.tt.nis_siswa,
								u8514965_panel_utsman.tt.id_tingkat,
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
							WHERE u8514965_panel_utsman.tt.id_transaksi_umum IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_umum
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_general_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								u8514965_panel_utsman.tt.id_transaksi_umum_pegawai,
								u8514965_panel_utsman.tt.nomor_transaksi_umum AS nomor_transaksi,
								u8514965_panel_utsman.tt.nip_pegawai,
								u8514965_panel_utsman.tt.id_tingkat,
								u8514965_panel_utsman.p.nama_lengkap,
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
									u8514965_panel_utsman.view_max_id_transaction_general_employee vmax
								WHERE
									u8514965_panel_utsman.tt.id_transaksi_umum_pegawai = u8514965_panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								u8514965_panel_utsman.transaksi_tabungan_umum_pegawai tt
							LEFT JOIN u8514965_panel_utsman.pegawai p
							ON
								u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
							LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
							ON
								u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
							LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
							ON
								u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
							WHERE u8514965_panel_utsman.tt.id_transaksi_umum_pegawai IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_umum_pegawai
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_qurban_all($id = '')
    {
        $sql = $this->db->query("SELECT
								u8514965_panel_utsman.tt.id_transaksi_qurban,
								u8514965_panel_utsman.tt.nomor_transaksi_qurban AS nomor_transaksi,
								u8514965_panel_utsman.tt.id_tingkat,
								u8514965_panel_utsman.tt.nis_siswa,
								u8514965_panel_utsman.tt.id_tingkat,
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
							WHERE u8514965_panel_utsman.tt.id_transaksi_qurban IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_qurban
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_qurban_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai,
								u8514965_panel_utsman.tt.nomor_transaksi_qurban AS nomor_transaksi,
								u8514965_panel_utsman.tt.id_tingkat,
								u8514965_panel_utsman.tt.nip_pegawai,
								u8514965_panel_utsman.tt.id_tingkat,
								u8514965_panel_utsman.p.nama_lengkap,
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
									u8514965_panel_utsman.view_max_id_transaction_qurban_employee vmax
								WHERE
									u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai = u8514965_panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								u8514965_panel_utsman.transaksi_tabungan_qurban_pegawai tt
							LEFT JOIN u8514965_panel_utsman.pegawai p
							ON
								u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
							LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
							ON
								u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
							LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
							ON
								u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
							WHERE u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_tour_all($id = '')
    {
        $sql = $this->db->query("SELECT
								u8514965_panel_utsman.tt.id_transaksi_wisata,
								u8514965_panel_utsman.tt.nomor_transaksi_wisata AS nomor_transaksi,
								u8514965_panel_utsman.tt.id_tingkat,
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
							WHERE u8514965_panel_utsman.tt.id_transaksi_wisata IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_wisata
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_tour_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai,
								u8514965_panel_utsman.tt.nomor_transaksi_wisata AS nomor_transaksi,
								u8514965_panel_utsman.tt.id_tingkat,
								u8514965_panel_utsman.tt.nip_pegawai,
								u8514965_panel_utsman.p.nama_lengkap,
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
									u8514965_panel_utsman.view_max_id_transaction_tour_employee vmax
								WHERE
									u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai = u8514965_panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								u8514965_panel_utsman.transaksi_tabungan_wisata_pegawai tt
							LEFT JOIN u8514965_panel_utsman.pegawai p
							ON
								u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
							LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
							ON
								u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
							LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
							ON
								u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
							WHERE u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai IN ($id)
							ORDER BY
								u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_joint_recap_all($id = '')
    {
        $sql = $this->db->query("SELECT
									u8514965_panel_utsman.tt.nomor_transaksi_bersama,
									u8514965_panel_utsman.tt.nomor_rekening_bersama,
									u8514965_panel_utsman.tb.nama_tabungan_bersama,
									u8514965_panel_utsman.s.nama_lengkap,
									u8514965_panel_utsman.s.nama_wali,
									u8514965_keuangan_utsman.ak.nama_akun,
									u8514965_keuangan_utsman.ak.email_akun,
									u8514965_panel_utsman.tt.saldo,
									u8514965_panel_utsman.tt.id_tingkat,
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
										u8514965_panel_utsman.tt.id_transaksi_bersama = u8514965_panel_utsman.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									u8514965_panel_utsman.transaksi_tabungan_bersama tt
								LEFT JOIN u8514965_panel_utsman.tabungan_bersama tb
								ON
									u8514965_panel_utsman.tb.nomor_rekening_bersama = u8514965_panel_utsman.tt.nomor_rekening_bersama
								LEFT JOIN u8514965_panel_utsman.siswa s
								ON
									u8514965_panel_utsman.s.id_siswa = u8514965_panel_utsman.tb.id_penanggung_jawab
								LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
								ON
									u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
								LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
								ON
									u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
								WHERE u8514965_panel_utsman.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									u8514965_panel_utsman.tt.id_transaksi_bersama
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
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_umum IN ($id)
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
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_qurban IN ($id)
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
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_wisata  IN ($id)
									ORDER BY
										id_transaksi DESC
									) RECAP
									ORDER BY
										jenis_tabungan DESC");
        return $sql->result();
    }

    public function get_data_saving_pdf_employee_recap_all($id = '')
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
											u8514965_panel_utsman.tt.id_transaksi_umum_pegawai AS id_transaksi,
											u8514965_panel_utsman.tt.nomor_transaksi_umum AS nomor_transaksi,
											u8514965_panel_utsman.tt.nip_pegawai,
											u8514965_panel_utsman.tt.id_tingkat,
											u8514965_panel_utsman.p.nama_lengkap,
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
												u8514965_panel_utsman.view_max_id_transaction_general_employee vmax
											WHERE
												u8514965_panel_utsman.tt.id_transaksi_umum_pegawai = u8514965_panel_utsman.vmax.id_max
										) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_umum_pegawai tt
									LEFT JOIN u8514965_panel_utsman.pegawai p
									ON
										u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_umum IN ($id)
									UNION ALL
									SELECT
										u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai AS id_transaksi,
										u8514965_panel_utsman.tt.nomor_transaksi_qurban AS nomor_transaksi,
										u8514965_panel_utsman.tt.nip_pegawai,
										u8514965_panel_utsman.tt.id_tingkat,
										u8514965_panel_utsman.p.nama_lengkap,
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
											u8514965_panel_utsman.view_max_id_transaction_qurban_employee vmax
										WHERE
											u8514965_panel_utsman.tt.id_transaksi_qurban_pegawai = u8514965_panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_qurban_pegawai tt
									LEFT JOIN u8514965_panel_utsman.pegawai p
									ON
										u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_qurban IN ($id)
									UNION ALL
									SELECT
										u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai AS id_transaksi,
										u8514965_panel_utsman.tt.nomor_transaksi_wisata AS nomor_transaksi,
										u8514965_panel_utsman.tt.nip_pegawai,
										u8514965_panel_utsman.tt.id_tingkat,
										u8514965_panel_utsman.p.nama_lengkap,
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
											u8514965_panel_utsman.view_max_id_transaction_tour_employee vmax
										WHERE
											u8514965_panel_utsman.tt.id_transaksi_wisata_pegawai = u8514965_panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										u8514965_panel_utsman.transaksi_tabungan_wisata_pegawai tt
									LEFT JOIN u8514965_panel_utsman.pegawai p
									ON
										u8514965_panel_utsman.p.nip = u8514965_panel_utsman.tt.nip_pegawai
									LEFT JOIN u8514965_panel_utsman.tahun_ajaran ta
									ON
										u8514965_panel_utsman.ta.id_tahun_ajaran = u8514965_panel_utsman.tt.th_ajaran
									LEFT JOIN u8514965_keuangan_utsman.akun_keuangan ak
									ON
										u8514965_keuangan_utsman.ak.id_akun_keuangan = u8514965_panel_utsman.tt.id_pegawai
										WHERE u8514965_panel_utsman.tt.nomor_transaksi_wisata IN ($id)
									ORDER BY
										id_transaksi DESC
									) RECAP
									ORDER BY
										jenis_tabungan DESC");
        return $sql->result();
    }

    //
}
