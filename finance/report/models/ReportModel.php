<?php

class ReportModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('secondary_db', true);
    }

    //
    //------------------------------REPORT--------------------------------//

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

        return $sql->result_array();
    }

    //
}
