<?php

class ReportModel extends MY_Model
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
									{$this->secondary_db}.s.id_siswa,
									{$this->secondary_db}.s.nis,
									{$this->secondary_db}.s.level_tingkat,
									{$this->secondary_db}.s.nama_lengkap,
									{$this->secondary_db}.s.jenis_kelamin,
									{$this->secondary_db}.s.nomor_handphone,
									{$this->secondary_db}.s.email,
									{$this->secondary_db}.s.jalur,
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
										FROM
											{$this->secondary_db}.transaksi_tabungan_umum ttu
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
										{$this->secondary_db}.ttq.nis_siswa = {$this->secondary_db}.s.nis AND {$this->secondary_db}.ttq.status_kredit_debet = 1 AND(
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
											{$this->secondary_db}.ttq.nis_siswa = {$this->secondary_db}.s.nis AND {$this->secondary_db}.ttq.status_kredit_debet = 2 AND(
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
											COALESCE(SUM({$this->secondary_db}.ttw.nominal),0)
										FROM
											{$this->secondary_db}.transaksi_tabungan_wisata ttw
										WHERE
											{$this->secondary_db}.ttw.nis_siswa = {$this->secondary_db}.s.nis AND {$this->secondary_db}.ttw.status_kredit_debet = 2 AND(
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
									) AS tahun_ajaran,
									{$this->secondary_db}.s.th_ajaran
								FROM
									{$this->secondary_db}.siswa s
								LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
								ON
									{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.s.th_ajaran
								WHERE {$this->secondary_db}.s.id_siswa IN ($id)
								ORDER BY
									{$this->secondary_db}.s.id_siswa
								DESC");

        return $sql->result_array();
    }

    public function get_data_employee_saving_excel_all($id = '', $start_date = '', $end_date = '')
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
									WHERE p.level_tingkat != '0' AND {$this->secondary_db}.p.id_pegawai IN ($id)
									ORDER BY
										{$this->secondary_db}.p.id_pegawai
									DESC");

        return $sql->result_array();
    }

    public function get_data_joint_saving_excel_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										{$this->secondary_db}.tb.id_tabungan_bersama,
										{$this->secondary_db}.tb.id_penanggung_jawab,
										{$this->secondary_db}.tb.nomor_rekening_bersama,
										{$this->secondary_db}.tb.nama_tabungan_bersama,
										{$this->secondary_db}.tb.keterangan_tabungan_bersama,
										{$this->secondary_db}.tb.id_tingkat,
										{$this->secondary_db}.tb.id_th_ajaran,
										{$this->secondary_db}.tb.jenis_tabungan,
										COALESCE(NULLIF({$this->secondary_db}.s.nis, ''), {$this->secondary_db}.p.nip) AS number,
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
											COALESCE({$this->secondary_db}.ttb.nominal, 0)
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
										{$this->secondary_db}.tabungan_bersama tb
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
									WHERE {$this->secondary_db}.tb.id_tabungan_bersama IN ($id)
									ORDER BY
										{$this->secondary_db}.tb.id_tabungan_bersama
									DESC");
        return $sql->result_array();
    }

    public function get_data_personal_saving_pdf_all($id = '', $start_date = '', $end_date = '')
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
										FROM
											{$this->secondary_db}.transaksi_tabungan_umum ttu
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
										{$this->secondary_db}.ttq.nis_siswa = {$this->secondary_db}.s.nis AND {$this->secondary_db}.ttq.status_kredit_debet = 1 AND(
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
											{$this->secondary_db}.ttq.nis_siswa = {$this->secondary_db}.s.nis AND {$this->secondary_db}.ttq.status_kredit_debet = 2 AND(
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
											COALESCE(SUM({$this->secondary_db}.ttw.nominal),0)
										FROM
											{$this->secondary_db}.transaksi_tabungan_wisata ttw
										WHERE
											{$this->secondary_db}.ttw.nis_siswa = {$this->secondary_db}.s.nis AND {$this->secondary_db}.ttw.status_kredit_debet = 2 AND(
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
									) AS tahun_ajaran,
									{$this->secondary_db}.s.th_ajaran
								FROM
									{$this->secondary_db}.siswa s
								LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
								ON
									{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.s.th_ajaran
								WHERE {$this->secondary_db}.s.id_siswa IN ($id)
								ORDER BY
									{$this->secondary_db}.s.id_siswa
								DESC");

        return $sql->result();
    }

    public function get_data_employee_saving_pdf_all($id = '', $start_date = '', $end_date = '')
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
									WHERE p.level_tingkat != '0' AND {$this->secondary_db}.p.id_pegawai IN ($id)
									ORDER BY
										{$this->secondary_db}.p.id_pegawai
									DESC");
        return $sql->result();
    }

    public function get_data_joint_saving_pdf_all($id = '', $start_date = '', $end_date = '')
    {
        $sql = $this->db2->query("SELECT
										{$this->secondary_db}.tb.id_tabungan_bersama,
										{$this->secondary_db}.tb.id_penanggung_jawab,
										{$this->secondary_db}.tb.nomor_rekening_bersama,
										{$this->secondary_db}.tb.nama_tabungan_bersama,
										{$this->secondary_db}.tb.keterangan_tabungan_bersama,
										{$this->secondary_db}.tb.id_tingkat,
										{$this->secondary_db}.tb.id_th_ajaran,
										{$this->secondary_db}.tb.jenis_tabungan,
										{$this->secondary_db}.s.nama_wali,
										{$this->secondary_db}.s.nis,
										{$this->secondary_db}.s.nama_lengkap,
										{$this->secondary_db}.s.nomor_handphone,
										{$this->secondary_db}.s.email,
										COALESCE(NULLIF({$this->secondary_db}.s.nis, ''), {$this->secondary_db}.p.nip) AS number,
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
											COALESCE({$this->secondary_db}.ttb.nominal, 0)
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
										{$this->secondary_db}.tabungan_bersama tb
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
									WHERE {$this->secondary_db}.tb.id_tabungan_bersama IN ($id)
									ORDER BY
										{$this->secondary_db}.tb.id_tabungan_bersama
									DESC");
        return $sql->result();
    }

    public function get_data_saving_excel_transaction_joint_all($id = '')
    {
        $sql = $this->db->query("SELECT
									{$this->secondary_db}.tt.nomor_transaksi_bersama,
									{$this->secondary_db}.tt.nomor_rekening_bersama,
									{$this->secondary_db}.tb.nama_tabungan_bersama,
									{$this->secondary_db}.s.nama_lengkap,
									{$this->secondary_db}.s.nama_wali,
									{$this->default_db}.ak.nama_akun,
									{$this->default_db}.ak.email_akun,
									{$this->secondary_db}.tt.saldo,
									{$this->secondary_db}.tt.id_tingkat,
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
										{$this->secondary_db}.tt.id_transaksi_bersama = {$this->secondary_db}.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									{$this->secondary_db}.transaksi_tabungan_bersama tt
								LEFT JOIN {$this->secondary_db}.tabungan_bersama tb
								ON
									{$this->secondary_db}.tb.nomor_rekening_bersama = {$this->secondary_db}.tt.nomor_rekening_bersama
								LEFT JOIN {$this->secondary_db}.siswa s
								ON
									{$this->secondary_db}.s.id_siswa = {$this->secondary_db}.tb.id_penanggung_jawab
								LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
								ON
									{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
								LEFT JOIN {$this->default_db}.akun_keuangan ak
								ON
									{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
								WHERE {$this->secondary_db}.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									{$this->secondary_db}.tt.id_transaksi_bersama
								DESC");

        return $sql->result_array();
    }
    public function get_data_saving_excel_transaction_general_all($id = '')
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
							WHERE {$this->secondary_db}.tt.id_transaksi_umum IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_umum
							DESC");

        return $sql->result_array();
    }

    public function get_data_saving_excel_transaction_general_all_employee($id = '')
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
							WHERE {$this->secondary_db}.tt.id_transaksi_umum_pegawai IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_umum_pegawai
							DESC");

        return $sql->result_array();
    }
    public function get_data_saving_excel_transaction_qurban_all($id = '')
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
							WHERE {$this->secondary_db}.tt.id_transaksi_qurban IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_qurban
							DESC");

        return $sql->result_array();
    }

    public function get_data_saving_excel_transaction_qurban_all_employee($id = '')
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
							WHERE {$this->secondary_db}.tt.id_transaksi_qurban_pegawai IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_qurban_pegawai
							DESC");

        return $sql->result_array();
    }

    public function get_data_saving_excel_transaction_tour_all($id = '')
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
							WHERE {$this->secondary_db}.tt.id_transaksi_wisata IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_wisata
							DESC");

        return $sql->result_array();
    }

    public function get_data_saving_excel_transaction_tht_all_employee($id = '')
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
							WHERE {$this->secondary_db}.tt.id_transaksi_tht_pegawai IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_tht_pegawai
							DESC");

        return $sql->result_array();
    }

    public function get_data_saving_excel_transaction_joint_recap_all($id = '')
    {
        $sql = $this->db->query("SELECT
									{$this->secondary_db}.tt.nomor_transaksi_bersama,
									{$this->secondary_db}.tt.nomor_rekening_bersama,
									{$this->secondary_db}.tb.nama_tabungan_bersama,
									{$this->secondary_db}.s.nama_lengkap,
									{$this->secondary_db}.s.nama_wali,
									{$this->default_db}.ak.nama_akun,
									{$this->default_db}.ak.email_akun,
									{$this->secondary_db}.tt.saldo,
									{$this->secondary_db}.tt.id_tingkat,
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
										{$this->secondary_db}.tt.id_transaksi_bersama = {$this->secondary_db}.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									{$this->secondary_db}.transaksi_tabungan_bersama tt
								LEFT JOIN {$this->secondary_db}.tabungan_bersama tb
								ON
									{$this->secondary_db}.tb.nomor_rekening_bersama = {$this->secondary_db}.tt.nomor_rekening_bersama
								LEFT JOIN {$this->secondary_db}.siswa s
								ON
									{$this->secondary_db}.s.id_siswa = {$this->secondary_db}.tb.id_penanggung_jawab
								LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
								ON
									{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
								LEFT JOIN {$this->default_db}.akun_keuangan ak
								ON
									{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
								WHERE {$this->secondary_db}.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									{$this->secondary_db}.tt.id_transaksi_bersama
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_umum IN ($id)
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_qurban IN ($id)
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_wisata IN ($id)
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_umum IN ($id)
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_qurban IN ($id)
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_tht IN ($id)
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
									{$this->secondary_db}.tt.nomor_transaksi_bersama,
									{$this->secondary_db}.tt.nomor_rekening_bersama,
									{$this->secondary_db}.tb.nama_tabungan_bersama,
									{$this->secondary_db}.s.nama_lengkap,
									{$this->secondary_db}.s.nama_wali,
									{$this->default_db}.ak.nama_akun,
									{$this->default_db}.ak.email_akun,
									{$this->secondary_db}.tt.saldo,
									{$this->secondary_db}.tt.id_tingkat,
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
										{$this->secondary_db}.tt.id_transaksi_bersama = {$this->secondary_db}.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									{$this->secondary_db}.transaksi_tabungan_bersama tt
								LEFT JOIN {$this->secondary_db}.tabungan_bersama tb
								ON
									{$this->secondary_db}.tb.nomor_rekening_bersama = {$this->secondary_db}.tt.nomor_rekening_bersama
								LEFT JOIN {$this->secondary_db}.siswa s
								ON
									{$this->secondary_db}.s.id_siswa = {$this->secondary_db}.tb.id_penanggung_jawab
								LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
								ON
									{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
								LEFT JOIN {$this->default_db}.akun_keuangan ak
								ON
									{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
								WHERE {$this->secondary_db}.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									{$this->secondary_db}.tt.id_transaksi_bersama
								DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_general_all($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.tt.id_transaksi_umum,
								{$this->secondary_db}.tt.nomor_transaksi_umum AS nomor_transaksi,
								{$this->secondary_db}.tt.nis_siswa,
								{$this->secondary_db}.tt.id_tingkat,
								{$this->secondary_db}.s.nama_lengkap,
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
							WHERE {$this->secondary_db}.tt.id_transaksi_umum IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_umum
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_general_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.tt.id_transaksi_umum_pegawai,
								{$this->secondary_db}.tt.nomor_transaksi_umum AS nomor_transaksi,
								{$this->secondary_db}.tt.nip_pegawai,
								{$this->secondary_db}.tt.id_tingkat,
								{$this->secondary_db}.p.nama_lengkap,
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
							WHERE {$this->secondary_db}.tt.id_transaksi_umum_pegawai IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_umum_pegawai
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_qurban_all($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.tt.id_transaksi_qurban,
								{$this->secondary_db}.tt.nomor_transaksi_qurban AS nomor_transaksi,
								{$this->secondary_db}.tt.id_tingkat,
								{$this->secondary_db}.tt.nis_siswa,
								{$this->secondary_db}.tt.id_tingkat,
								{$this->secondary_db}.s.nama_lengkap,
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
							WHERE {$this->secondary_db}.tt.id_transaksi_qurban IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_qurban
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_qurban_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.tt.id_transaksi_qurban_pegawai,
								{$this->secondary_db}.tt.nomor_transaksi_qurban AS nomor_transaksi,
								{$this->secondary_db}.tt.id_tingkat,
								{$this->secondary_db}.tt.nip_pegawai,
								{$this->secondary_db}.tt.id_tingkat,
								{$this->secondary_db}.p.nama_lengkap,
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
							WHERE {$this->secondary_db}.tt.id_transaksi_qurban_pegawai IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_qurban_pegawai
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_tour_all($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.tt.id_transaksi_wisata,
								{$this->secondary_db}.tt.nomor_transaksi_wisata AS nomor_transaksi,
								{$this->secondary_db}.tt.id_tingkat,
								{$this->secondary_db}.tt.nis_siswa,
								{$this->secondary_db}.s.nama_lengkap,
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
							WHERE {$this->secondary_db}.tt.id_transaksi_wisata IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_wisata
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_tht_all_employee($id = '')
    {
        $sql = $this->db->query("SELECT
								{$this->secondary_db}.tt.id_transaksi_tht_pegawai,
								{$this->secondary_db}.tt.nomor_transaksi_tht AS nomor_transaksi,
								{$this->secondary_db}.tt.id_tingkat,
								{$this->secondary_db}.tt.nip_pegawai,
								{$this->secondary_db}.p.nama_lengkap,
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
							WHERE {$this->secondary_db}.tt.id_transaksi_tht_pegawai IN ($id)
							ORDER BY
								{$this->secondary_db}.tt.id_transaksi_tht_pegawai
							DESC");

        return $sql->result();
    }

    public function get_data_saving_pdf_joint_recap_all($id = '')
    {
        $sql = $this->db->query("SELECT
									{$this->secondary_db}.tt.nomor_transaksi_bersama,
									{$this->secondary_db}.tt.nomor_rekening_bersama,
									{$this->secondary_db}.tb.nama_tabungan_bersama,
									{$this->secondary_db}.s.nama_lengkap,
									{$this->secondary_db}.s.nama_wali,
									{$this->default_db}.ak.nama_akun,
									{$this->default_db}.ak.email_akun,
									{$this->secondary_db}.tt.saldo,
									{$this->secondary_db}.tt.id_tingkat,
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
										{$this->secondary_db}.tt.id_transaksi_bersama = {$this->secondary_db}.vmax.id_max
								) THEN 1 ELSE 0
								END AS status_edit
								FROM
									{$this->secondary_db}.transaksi_tabungan_bersama tt
								LEFT JOIN {$this->secondary_db}.tabungan_bersama tb
								ON
									{$this->secondary_db}.tb.nomor_rekening_bersama = {$this->secondary_db}.tt.nomor_rekening_bersama
								LEFT JOIN {$this->secondary_db}.siswa s
								ON
									{$this->secondary_db}.s.id_siswa = {$this->secondary_db}.tb.id_penanggung_jawab
								LEFT JOIN {$this->secondary_db}.tahun_ajaran ta
								ON
									{$this->secondary_db}.ta.id_tahun_ajaran = {$this->secondary_db}.tt.th_ajaran
								LEFT JOIN {$this->default_db}.akun_keuangan ak
								ON
									{$this->default_db}.ak.id_akun_keuangan = {$this->secondary_db}.tt.id_pegawai
								WHERE {$this->secondary_db}.tt.id_transaksi_bersama IN ($id)
								ORDER BY
									{$this->secondary_db}.tt.id_transaksi_bersama
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_umum IN ($id)
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_qurban IN ($id)
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_wisata  IN ($id)
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_umum IN ($id)
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_qurban IN ($id)
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
										WHERE {$this->secondary_db}.tt.nomor_transaksi_tht IN ($id)
									ORDER BY
										id_transaksi DESC
									) RECAP
									ORDER BY
										jenis_tabungan DESC");
        return $sql->result();
    }

    //
}
