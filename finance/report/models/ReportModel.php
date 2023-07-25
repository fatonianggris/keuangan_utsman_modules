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
								panel_utsman.tt.id_transaksi,
								panel_utsman.tt.nis_siswa,
								panel_utsman.s.nama_lengkap,
								keuangan_utsman_fix.ak.nama_akun,
								keuangan_utsman_fix.ak.email_akun,
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
									panel_utsman.view_max_id_transaction vmax
								WHERE
									panel_utsman.tt.id_transaksi = panel_utsman.vmax.id_max
							) THEN 1 ELSE 0
							END AS status_edit
							FROM
								panel_utsman.transaksi_tabungan tt
							LEFT JOIN panel_utsman.siswa s
							ON
								panel_utsman.s.nis = panel_utsman.tt.nis_siswa
							LEFT JOIN panel_utsman.tahun_ajaran ta
							ON
								panel_utsman.ta.id_tahun_ajaran = panel_utsman.tt.th_ajaran
							LEFT JOIN keuangan_utsman_fix.akun_keuangan ak
							ON
								keuangan_utsman_fix.ak.id_akun_keuangan = panel_utsman.tt.id_pegawai
							WHERE panel_utsman.tt.id_transaksi IN ($id)
							ORDER BY
								panel_utsman.tt.id_transaksi
							DESC");

        return $sql->result_array();
    }

    //
}
