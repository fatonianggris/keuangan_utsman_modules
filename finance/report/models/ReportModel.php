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
									panel_utsman.s.id_siswa,
									panel_utsman.s.nis,
									panel_utsman.s.level_tingkat,
									panel_utsman.s.nama_lengkap,
									panel_utsman.s.jenis_kelamin,
									panel_utsman.s.nomor_handphone,
									panel_utsman.s.email,
									panel_utsman.s.jalur,
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
										FROM
											panel_utsman.transaksi_tabungan_umum ttu
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
										panel_utsman.ttq.nis_siswa = panel_utsman.s.nis AND panel_utsman.ttq.status_kredit_debet = 1 AND(
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
											panel_utsman.ttq.nis_siswa = panel_utsman.s.nis AND panel_utsman.ttq.status_kredit_debet = 2 AND(
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
											COALESCE(SUM(panel_utsman.ttw.nominal),0)
										FROM
											panel_utsman.transaksi_tabungan_wisata ttw
										WHERE
											panel_utsman.ttw.nis_siswa = panel_utsman.s.nis AND panel_utsman.ttw.status_kredit_debet = 2 AND(
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
									) AS tahun_ajaran,
									panel_utsman.s.th_ajaran
								FROM
									panel_utsman.siswa s
								LEFT JOIN panel_utsman.tahun_ajaran ta
								ON
									panel_utsman.ta.id_tahun_ajaran = panel_utsman.s.th_ajaran
								WHERE panel_utsman.s.id_siswa IN ($id)
								ORDER BY
									panel_utsman.s.id_siswa
								DESC");

        return $sql->result_array();
    }

    public function get_data_employee_saving_excel_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										panel_utsman.p.id_pegawai,
										panel_utsman.p.id_jabatan,
										panel_utsman.p.nip,
										panel_utsman.p.level_tingkat,
										panel_utsman.p.nama_lengkap,
										panel_utsman.p.jenis_kelamin,
										panel_utsman.p.nomor_hp,
										panel_utsman.p.email,
										panel_utsman.p.jenis_pegawai,
										panel_utsman.p.th_ajaran,
										panel_utsman.jb.id_jabatan,
										panel_utsman.jb.hasil_nama_jabatan,
										(
										SELECT
											COALESCE(SUM(panel_utsman.ttu.nominal),
											0)
										FROM
											panel_utsman.transaksi_tabungan_umum_pegawai ttu
										WHERE
											panel_utsman.ttu.nip_pegawai = panel_utsman.p.nip AND panel_utsman.ttu.status_kredit_debet = 1 AND(
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
												panel_utsman.transaksi_tabungan_umum_pegawai ttu
											WHERE
												panel_utsman.ttu.nip_pegawai = panel_utsman.p.nip AND panel_utsman.ttu.status_kredit_debet = 2 AND(
													DATE_FORMAT(
                                                    panel_utsman.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_umum,
										(
											SELECT
												COALESCE(panel_utsman.ttu.saldo, 0)
											FROM panel_utsman.transaksi_tabungan_umum_pegawai ttu
											WHERE
												panel_utsman.ttu.nip_pegawai = panel_utsman.p.nip AND(
													DATE_FORMAT(
                                                    panel_utsman.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												panel_utsman.ttu.id_transaksi_umum_pegawai
											DESC LIMIT 1
										) AS saldo_umum,
										CONCAT(
                                        panel_utsman.ta.tahun_awal,
                                        '/',
                                        panel_utsman.ta.tahun_akhir
                                    	) AS tahun_ajaran
									FROM
										pegawai p
									LEFT JOIN panel_utsman.tahun_ajaran ta
                                	ON
                                    	panel_utsman.ta.id_tahun_ajaran = panel_utsman.p.th_ajaran
									LEFT JOIN panel_utsman.jabatan jb
                                	ON
                                    	panel_utsman.jb.id_jabatan = panel_utsman.p.id_jabatan
									WHERE p.level_tingkat != '0' AND panel_utsman.p.id_pegawai IN ($id)
									ORDER BY
										panel_utsman.p.id_pegawai
									DESC");

        return $sql->result_array();
    }

    public function get_data_joint_saving_excel_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										panel_utsman.tb.id_tabungan_bersama,
										panel_utsman.tb.id_penanggung_jawab,
										panel_utsman.tb.nomor_rekening_bersama,
										panel_utsman.tb.nama_tabungan_bersama,
										panel_utsman.tb.keterangan_tabungan_bersama,
										panel_utsman.tb.id_tingkat,
										panel_utsman.tb.id_th_ajaran,
										panel_utsman.tb.jenis_tabungan,
										COALESCE(NULLIF(panel_utsman.s.nis, ''), panel_utsman.p.nip) AS number,
										COALESCE(NULLIF(panel_utsman.s.nama_wali, ''), panel_utsman.p.nama_lengkap) AS nama_wali,
										COALESCE(NULLIF(panel_utsman.s.nama_lengkap, ''), panel_utsman.p.nama_lengkap) AS nama_lengkap,
										COALESCE(NULLIF(panel_utsman.s.nomor_handphone, ''), panel_utsman.p.nomor_hp) AS nomor_handphone,
										COALESCE(NULLIF(panel_utsman.s.email, ''), panel_utsman.p.email) AS email,
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
											COALESCE(panel_utsman.ttb.nominal, 0)
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
										panel_utsman.tabungan_bersama tb
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tb.id_penanggung_jawab
									LEFT JOIN
										panel_utsman.pegawai p
									ON
										panel_utsman.p.nip = panel_utsman.tb.id_penanggung_jawab
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tb.id_th_ajaran
									WHERE panel_utsman.tb.id_tabungan_bersama IN ($id)
									ORDER BY
										panel_utsman.tb.id_tabungan_bersama
									DESC");
        return $sql->result_array();
    }

    public function get_data_personal_saving_pdf_all($id = '', $start_date = '', $end_date = '')
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
										FROM
											panel_utsman.transaksi_tabungan_umum ttu
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
										panel_utsman.ttq.nis_siswa = panel_utsman.s.nis AND panel_utsman.ttq.status_kredit_debet = 1 AND(
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
											panel_utsman.ttq.nis_siswa = panel_utsman.s.nis AND panel_utsman.ttq.status_kredit_debet = 2 AND(
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
											COALESCE(SUM(panel_utsman.ttw.nominal),0)
										FROM
											panel_utsman.transaksi_tabungan_wisata ttw
										WHERE
											panel_utsman.ttw.nis_siswa = panel_utsman.s.nis AND panel_utsman.ttw.status_kredit_debet = 2 AND(
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
									) AS tahun_ajaran,
									panel_utsman.s.th_ajaran
								FROM
									panel_utsman.siswa s
								LEFT JOIN panel_utsman.tahun_ajaran ta
								ON
									panel_utsman.ta.id_tahun_ajaran = panel_utsman.s.th_ajaran
								WHERE panel_utsman.s.id_siswa IN ($id)
								ORDER BY
									panel_utsman.s.id_siswa
								DESC");

        return $sql->result();
    }

    public function get_data_employee_saving_pdf_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										panel_utsman.p.id_pegawai,
										panel_utsman.p.id_jabatan,
										panel_utsman.p.nip,
										panel_utsman.p.level_tingkat,
										panel_utsman.p.nama_lengkap,
										panel_utsman.p.jenis_kelamin,
										panel_utsman.p.nomor_hp,
										panel_utsman.p.email,
										panel_utsman.p.jenis_pegawai,
										panel_utsman.p.th_ajaran,
										panel_utsman.jb.id_jabatan,
										panel_utsman.jb.hasil_nama_jabatan,
										(
										SELECT
											COALESCE(SUM(panel_utsman.ttu.nominal),
											0)
										FROM
											panel_utsman.transaksi_tabungan_umum_pegawai ttu
										WHERE
											panel_utsman.ttu.nip_pegawai = panel_utsman.p.nip AND panel_utsman.ttu.status_kredit_debet = 1 AND(
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
												panel_utsman.transaksi_tabungan_umum_pegawai ttu
											WHERE
												panel_utsman.ttu.nip_pegawai = panel_utsman.p.nip AND panel_utsman.ttu.status_kredit_debet = 2 AND(
													DATE_FORMAT(
                                                    panel_utsman.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
										) AS debet_umum,
										(
											SELECT
												COALESCE(panel_utsman.ttu.saldo, 0)
											FROM panel_utsman.transaksi_tabungan_umum_pegawai ttu
											WHERE
												panel_utsman.ttu.nip_pegawai = panel_utsman.p.nip AND(
													DATE_FORMAT(
                                                    panel_utsman.ttu.waktu_transaksi,
                                                    '%Y-%m-%d'
                                                    ) BETWEEN '$start_date' AND '$end_date'
												)
											ORDER BY
												panel_utsman.ttu.id_transaksi_umum_pegawai
											DESC LIMIT 1
										) AS saldo_umum,
										CONCAT(
                                        panel_utsman.ta.tahun_awal,
                                        '/',
                                        panel_utsman.ta.tahun_akhir
                                    	) AS tahun_ajaran
									FROM
										pegawai p
									LEFT JOIN panel_utsman.tahun_ajaran ta
                                	ON
                                    	panel_utsman.ta.id_tahun_ajaran = panel_utsman.p.th_ajaran
									LEFT JOIN panel_utsman.jabatan jb
                                	ON
                                    	panel_utsman.jb.id_jabatan = panel_utsman.p.id_jabatan
									WHERE p.level_tingkat != '0' AND panel_utsman.p.id_pegawai IN ($id)
									ORDER BY
										panel_utsman.p.id_pegawai
									DESC");
        return $sql->result();
    }

    public function get_data_joint_saving_pdf_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										panel_utsman.tb.id_tabungan_bersama,
										panel_utsman.tb.id_penanggung_jawab,
										panel_utsman.tb.nomor_rekening_bersama,
										panel_utsman.tb.nama_tabungan_bersama,
										panel_utsman.tb.keterangan_tabungan_bersama,
										panel_utsman.tb.id_tingkat,
										panel_utsman.tb.id_th_ajaran,
										panel_utsman.tb.jenis_tabungan,
										panel_utsman.s.nama_wali,
										panel_utsman.s.nis,
										panel_utsman.s.nama_lengkap,
										panel_utsman.s.nomor_handphone,
										panel_utsman.s.email,
										COALESCE(NULLIF(panel_utsman.s.nis, ''), panel_utsman.p.nip) AS number,
										COALESCE(NULLIF(panel_utsman.s.nama_wali, ''), panel_utsman.p.nama_lengkap) AS nama_wali,
										COALESCE(NULLIF(panel_utsman.s.nama_lengkap, ''), panel_utsman.p.nama_lengkap) AS nama_lengkap,
										COALESCE(NULLIF(panel_utsman.s.nomor_handphone, ''), panel_utsman.p.nomor_hp) AS nomor_handphone,
										COALESCE(NULLIF(panel_utsman.s.email, ''), panel_utsman.p.email) AS email,
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
											COALESCE(panel_utsman.ttb.nominal, 0)
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
										panel_utsman.tabungan_bersama tb
									LEFT JOIN panel_utsman.siswa s
									ON
										panel_utsman.s.nis = panel_utsman.tb.id_penanggung_jawab
									LEFT JOIN
										panel_utsman.pegawai p
									ON
										panel_utsman.p.nip = panel_utsman.tb.id_penanggung_jawab
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tb.id_th_ajaran
									WHERE panel_utsman.tb.id_tabungan_bersama IN ($id)
									ORDER BY
										panel_utsman.tb.id_tabungan_bersama
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
									panel_utsman.s.id_siswa = panel_utsman.tb.id_penanggung_jawab
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

    public function get_data_saving_excel_transaction_general_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_umum_pegawai,
								panel_utsman.tt.nomor_transaksi_umum,
								panel_utsman.tt.nip_pegawai,
								panel_utsman.tt.id_tingkat,
								panel_utsman.p.nama_lengkap,
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
									panel_utsman.view_max_id_transaction_general_employee vmax
								WHERE
									panel_utsman.tt.id_transaksi_umum_pegawai = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_umum_pegawai tt
							LEFT JOIN panel_utsman.pegawai p
							ON
								panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_umum_pegawai IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_umum_pegawai
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

    public function get_data_saving_excel_transaction_qurban_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_qurban_pegawai,
								panel_utsman.tt.nomor_transaksi_qurban,
								panel_utsman.tt.nip_pegawai,
								panel_utsman.tt.id_tingkat,
								panel_utsman.p.nama_lengkap,
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
									panel_utsman.view_max_id_transaction_qurban_employee vmax
								WHERE
									panel_utsman.tt.id_transaksi_qurban_pegawai = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_qurban_pegawai tt
							LEFT JOIN panel_utsman.pegawai p
							ON
								panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_qurban_pegawai IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_qurban_pegawai
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

    public function get_data_saving_excel_transaction_tht_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_tht_pegawai,
								panel_utsman.tt.nomor_transaksi_tht,
								panel_utsman.tt.nip_pegawai,
								panel_utsman.tt.id_tingkat,
								panel_utsman.p.nama_lengkap,
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
									panel_utsman.view_max_id_transaction_tht_employee vmax
								WHERE
									panel_utsman.tt.id_transaksi_tht_pegawai = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_tht_pegawai tt
							LEFT JOIN panel_utsman.pegawai p
							ON
								panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_tht_pegawai IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_tht_pegawai
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
									panel_utsman.s.id_siswa = panel_utsman.tb.id_penanggung_jawab
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
											panel_utsman.tt.id_transaksi_umum_pegawai AS id_transaksi,
											panel_utsman.tt.nomor_transaksi_umum AS nomor_transaksi,
											panel_utsman.tt.nip_pegawai,
											panel_utsman.tt.id_tingkat,
											panel_utsman.p.nama_lengkap,
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
												panel_utsman.view_max_id_transaction_general_employee vmax
											WHERE
												panel_utsman.tt.id_transaksi_umum_pegawai = panel_utsman.vmax.id_max
										) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_umum_pegawai tt
									LEFT JOIN panel_utsman.pegawai p
									ON
										panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_umum IN ($id)
									UNION ALL
									SELECT
										panel_utsman.tt.id_transaksi_qurban_pegawai AS id_transaksi,
										panel_utsman.tt.nomor_transaksi_qurban AS nomor_transaksi,
										panel_utsman.tt.nip_pegawai,
										panel_utsman.tt.id_tingkat,
										panel_utsman.p.nama_lengkap,
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
											panel_utsman.view_max_id_transaction_qurban_employee vmax
										WHERE
											panel_utsman.tt.id_transaksi_qurban_pegawai = panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_qurban_pegawai tt
									LEFT JOIN panel_utsman.pegawai p
									ON
										panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_qurban IN ($id)
									UNION ALL
									SELECT
										panel_utsman.tt.id_transaksi_tht_pegawai AS id_transaksi,
										panel_utsman.tt.nomor_transaksi_tht AS nomor_transaksi,
										panel_utsman.tt.nip_pegawai,
										panel_utsman.tt.id_tingkat,
										panel_utsman.p.nama_lengkap,
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
											panel_utsman.view_max_id_transaction_tht_employee vmax
										WHERE
											panel_utsman.tt.id_transaksi_tht_pegawai = panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_tht_pegawai tt
									LEFT JOIN panel_utsman.pegawai p
									ON
										panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_tht IN ($id)
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
									panel_utsman.s.id_siswa = panel_utsman.tb.id_penanggung_jawab
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

    public function get_data_saving_pdf_general_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_umum_pegawai,
								panel_utsman.tt.nomor_transaksi_umum AS nomor_transaksi,
								panel_utsman.tt.nip_pegawai,
								panel_utsman.tt.id_tingkat,
								panel_utsman.p.nama_lengkap,
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
									panel_utsman.view_max_id_transaction_general_employee vmax
								WHERE
									panel_utsman.tt.id_transaksi_umum_pegawai = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_umum_pegawai tt
							LEFT JOIN panel_utsman.pegawai p
							ON
								panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_umum_pegawai IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_umum_pegawai
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

    public function get_data_saving_pdf_qurban_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_qurban_pegawai,
								panel_utsman.tt.nomor_transaksi_qurban AS nomor_transaksi,
								panel_utsman.tt.id_tingkat,
								panel_utsman.tt.nip_pegawai,
								panel_utsman.tt.id_tingkat,
								panel_utsman.p.nama_lengkap,
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
									panel_utsman.view_max_id_transaction_qurban_employee vmax
								WHERE
									panel_utsman.tt.id_transaksi_qurban_pegawai = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_qurban_pegawai tt
							LEFT JOIN panel_utsman.pegawai p
							ON
								panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_qurban_pegawai IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_qurban_pegawai
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

    public function get_data_saving_pdf_tht_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								panel_utsman.tt.id_transaksi_tht_pegawai,
								panel_utsman.tt.nomor_transaksi_tht AS nomor_transaksi,
								panel_utsman.tt.id_tingkat,
								panel_utsman.tt.nip_pegawai,
								panel_utsman.p.nama_lengkap,
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
									panel_utsman.view_max_id_transaction_tht_employee vmax
								WHERE
									panel_utsman.tt.id_transaksi_tht_pegawai = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan_tht_pegawai tt
							LEFT JOIN panel_utsman.pegawai p
							ON
								panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman.akun_keuangan ak
							ON
								keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi_tht_pegawai IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi_tht_pegawai
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
									panel_utsman.s.id_siswa = panel_utsman.tb.id_penanggung_jawab
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
											panel_utsman.tt.id_transaksi_umum_pegawai AS id_transaksi,
											panel_utsman.tt.nomor_transaksi_umum AS nomor_transaksi,
											panel_utsman.tt.nip_pegawai,
											panel_utsman.tt.id_tingkat,
											panel_utsman.p.nama_lengkap,
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
												panel_utsman.view_max_id_transaction_general_employee vmax
											WHERE
												panel_utsman.tt.id_transaksi_umum_pegawai = panel_utsman.vmax.id_max
										) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_umum_pegawai tt
									LEFT JOIN panel_utsman.pegawai p
									ON
										panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_umum IN ($id)
									UNION ALL
									SELECT
										panel_utsman.tt.id_transaksi_qurban_pegawai AS id_transaksi,
										panel_utsman.tt.nomor_transaksi_qurban AS nomor_transaksi,
										panel_utsman.tt.nip_pegawai,
										panel_utsman.tt.id_tingkat,
										panel_utsman.p.nama_lengkap,
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
											panel_utsman.view_max_id_transaction_qurban_employee vmax
										WHERE
											panel_utsman.tt.id_transaksi_qurban_pegawai = panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_qurban_pegawai tt
									LEFT JOIN panel_utsman.pegawai p
									ON
										panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_qurban IN ($id)
									UNION ALL
									SELECT
										panel_utsman.tt.id_transaksi_tht_pegawai AS id_transaksi,
										panel_utsman.tt.nomor_transaksi_tht AS nomor_transaksi,
										panel_utsman.tt.nip_pegawai,
										panel_utsman.tt.id_tingkat,
										panel_utsman.p.nama_lengkap,
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
											panel_utsman.view_max_id_transaction_tht_employee vmax
										WHERE
											panel_utsman.tt.id_transaksi_tht_pegawai = panel_utsman.vmax.id_max
									) THEN 1 ELSE 0
									END AS status_edit
									FROM
										panel_utsman.transaksi_tabungan_tht_pegawai tt
									LEFT JOIN panel_utsman.pegawai p
									ON
										panel_utsman.p.nip = panel_utsman.tt.nip_pegawai
									LEFT JOIN panel_utsman.tahun_ajaran ta
									ON
										panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
									LEFT JOIN keuangan_utsman.akun_keuangan ak
									ON
										keuangan_utsman.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
										WHERE panel_utsman.tt.nomor_transaksi_tht IN ($id)
									ORDER BY
										id_transaksi DESC
									) RECAP
									ORDER BY
										jenis_tabungan DESC");
        return $sql->result();
    }

    //
}
