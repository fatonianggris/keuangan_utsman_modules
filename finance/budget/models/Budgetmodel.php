<?php

class BudgetModel extends CI_Model {

    private $table_structure = 'struktur_akun_keuangan';
    private $table_account = 'akun_keuangan';
    private $table_budget = 'anggaran';
    private $table_recipe = 'bukti';
    private $table_general_page = 'general_page';
    private $table_contact = 'kontak';

    //
    //------------------------------BUDGET--------------------------------//
    //  

    public function get_page() {

        $this->db->select('*');
        $this->db->where('id_general_page', 1);
        $sql = $this->db->get($this->table_general_page);
        return $sql->result();
    }

    public function check_role($id = '') {
        $this->db->select("ak.nama_akun,
                           ak.nomor_handphone_akun,
                           ak.email_akun,
                           sak.nama_struktur,
                           sak.id_struktur,
                           sak.id_role_struktur
                         ");
        $this->db->from('akun_keuangan ak');
        $this->db->join('struktur_akun_keuangan sak', 'ak.role_akun = sak.id_struktur', 'left');
        $this->db->where('id_akun_keuangan', $id);

        $sql = $this->db->get();
        return $sql->result();
    }

    public function get_budget_fondation_id($id = '') {
        $this->db->select("a.*, 
                                ak.nama_akun,
                                ak.nomor_handphone_akun,
                                ak.email_akun,
                                sak.nama_struktur,
                                sak.id_role_struktur,
                                CONCAT(t.tahun_awal,'/',t.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(a.tanggal_pengajuan_proposal, '%d/%m/%Y') AS tanggal_pengajuan_prop,
                                DATE_FORMAT(a.tanggal_pengajuan_lpj, '%d/%m/%Y') AS tanggal_pengajuan_lp,
                                DATE_FORMAT(a.tanggal_persetujuan_proposal, '%d/%m/%Y') AS tanggal_persetujuan_prop,
                                DATE_FORMAT(a.tanggal_persetujuan_lpj, '%d/%m/%Y') AS tanggal_persetujuan_lp,
                                MONTH(a.inserted_at) AS bulan
                         ");
        $this->db->from('anggaran a');
        $this->db->join('tahun_ajaran t', 'a.id_tahun_ajaran = t.id_tahun_ajaran', 'left');
        $this->db->join('akun_keuangan ak', 'a.id_akun_keuangan = ak.id_akun_keuangan', 'left');
        $this->db->join('struktur_akun_keuangan sak', 'ak.role_akun = sak.id_struktur', 'left');
        $this->db->where('id_anggaran', $id);

        $sql = $this->db->get();
        return $sql->result();
    }

    public function get_contact() {

        $this->db->select('*');
        $this->db->where('id_kontak', 1);
        $sql = $this->db->get($this->table_contact);
        return $sql->result();
    }

    public function get_old_name_budget($id = '') {
        $this->db->where('id_anggaran', $id);

        $sql = $this->db->get($this->table_budget);
        return $sql->result();
    }

    public function get_img_recipe($token) {
        $this->db->select('bukti_anggaran, bukti_anggaran_thumb');
        $this->db->where('token', $token);
        $sql = $this->db->get($this->table_recipe);
        return $sql->result();
    }

    public function check_budget_duplicate($nama = '') {
        $this->db->where('nama_anggaran', $nama);

        $sql = $this->db->get($this->table_budget);
        return $sql->result();
    }

    public function check_name_division($id = '') {
        $this->db->where('id_struktur', $id);

        $sql = $this->db->get($this->table_structure);
        return $sql->result();
    }

    public function get_core_mail() {

        $this->db->select('ak.email_akun');

        $this->db->from('akun_keuangan ak');
        $this->db->join('struktur_akun_keuangan sak', 'ak.role_akun = sak.id_struktur', 'left');
        $this->db->where_in('sak.id_role_struktur', array(2, 5));

        $sql = $this->db->get();
        return $sql->result();
    }

    public function get_bendahara_mail() {

        $this->db->select('ak.email_akun');

        $this->db->from('akun_keuangan ak');
        $this->db->join('struktur_akun_keuangan sak', 'ak.role_akun = sak.id_struktur', 'left');
        $this->db->where_in('sak.id_role_struktur', array(5));

        $sql = $this->db->get();
        return $sql->result();
    }

    public function get_structure_account() {

        $this->db->select('*');
        $this->db->where_not_in('id_role_struktur', array(1, 2, 3, 7, 8));
        $sql = $this->db->get($this->table_structure);
        return $sql->result();
    }

	public function get_all_account() {

        $this->db->select('id_akun_keuangan, nama_akun,role_akun');
		$this->db->where_not_in('role_akun', array(1, 3));
        $sql = $this->db->get($this->table_account);
        return $sql->result();
    }
    
    public function get_core_account() {

        $this->db->select('id_akun_keuangan, nama_akun,role_akun');
        $this->db->where_not_in('role_akun', array(1, 2, 3, 7, 8));
        $sql = $this->db->get($this->table_account);
        return $sql->result();
    }

    public function get_schoolyear() {

        $sql = $this->db->query("SELECT * FROM tahun_ajaran WHERE semester='ganjil'");
        return $sql->result();
    }

    public function get_budget_fondation() {
        $this->db->select("a.*, 
                                ak.nama_akun,
                                ak.nomor_handphone_akun,
                                ak.email_akun,
                                sak.nama_struktur,
                                sak.id_role_struktur,
                                CONCAT(t.tahun_awal,'/',t.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(a.tanggal_pengajuan_proposal, '%d/%m/%Y') AS tanggal_pengajuan_prop,
                                DATE_FORMAT(a.tanggal_pengajuan_lpj, '%d/%m/%Y') AS tanggal_pengajuan_lp,
                                DATE_FORMAT(a.tanggal_persetujuan_proposal, '%d/%m/%Y') AS tanggal_persetujuan_prop,
                                DATE_FORMAT(a.tanggal_persetujuan_lpj, '%d/%m/%Y') AS tanggal_persetujuan_lp,
                                MONTH(a.inserted_at) AS bulan
                         ");
        $this->db->from('anggaran a');
        $this->db->join('tahun_ajaran t', 'a.id_tahun_ajaran = t.id_tahun_ajaran', 'left');
        $this->db->join('akun_keuangan ak', 'a.id_akun_keuangan = ak.id_akun_keuangan', 'left');
        $this->db->join('struktur_akun_keuangan sak', 'ak.role_akun = sak.id_struktur', 'left');
        $this->db->order_by('a.inserted_at', 'DESC');

        $sql = $this->db->get();
        return $sql->result();
    }

    public function get_budget_division($id = '') {
        $this->db->select("a.*, 
                                ak.nama_akun,
                                ak.nomor_handphone_akun,
                                ak.email_akun,
                                sak.nama_struktur,
                                sak.id_role_struktur,
                                CONCAT(t.tahun_awal,'/',t.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(a.tanggal_pengajuan_proposal, '%d/%m/%Y') AS tanggal_pengajuan_prop,
                                DATE_FORMAT(a.tanggal_pengajuan_lpj, '%d/%m/%Y') AS tanggal_pengajuan_lp,
                                DATE_FORMAT(a.tanggal_persetujuan_proposal, '%d/%m/%Y') AS tanggal_persetujuan_prop,
                                DATE_FORMAT(a.tanggal_persetujuan_lpj, '%d/%m/%Y') AS tanggal_persetujuan_lp,
                                MONTH(a.inserted_at) AS bulan
                         ");
        $this->db->from('anggaran a');
        $this->db->join('tahun_ajaran t', 'a.id_tahun_ajaran = t.id_tahun_ajaran', 'left');
        $this->db->join('akun_keuangan ak', 'a.id_akun_keuangan = ak.id_akun_keuangan', 'left');
        $this->db->join('struktur_akun_keuangan sak', 'ak.role_akun = sak.id_struktur', 'left');
        $this->db->where('sak.id_struktur', $id);
        $this->db->order_by('a.inserted_at', 'DESC');

        $sql = $this->db->get();
        return $sql->result();
    }

    public function insert_budget_fondation($id = '', $value = '') {
        $this->db->trans_begin();

        $data = array(
            'id_akun_keuangan' => $id,
            'id_tahun_ajaran' => $value['id_tahun_ajaran'],
            'nama_anggaran' => $value['nama_anggaran'],
            'nominal_dana_awal' => $value['nominal_dana_awal'],
            'waktu' => '01/' . $value['waktu'],
            'uraian' => @$value['uraian'],
            'token' => $value['token'],
            'file_laporan_proposal' => $value['file_laporan_proposal'],
        );

        $this->db->insert($this->table_budget, $data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function update_budget_fondation($id = '', $value = '') {
        $this->db->trans_begin();

        $data = array(
            'id_tahun_ajaran' => $value['id_tahun_ajaran'],
            'nama_anggaran' => $value['nama_anggaran'],
            'nominal_dana_awal' => $value['nominal_dana_awal'],
            'waktu' => '01/' . $value['waktu'],
            'uraian' => @$value['uraian'],
            'status_acc_proposal' => 0,
            'file_laporan_proposal' => $value['file_laporan_proposal'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db->where('id_anggaran', $id);
        $this->db->update($this->table_budget, $data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function update_lpj_fondation($id = '', $value = '') {
        $this->db->trans_begin();

        $data = array(
            'nama_lpj' => $value['nama_lpj'],
            'nominal_dana_terpakai' => $value['nominal_dana_terpakai'],
            'nominal_dana_eksternal' => $value['nominal_dana_eksternal'],
            'nominal_dana_sisa' => $value['nominal_dana_sisa'],
            'file_laporan_lpj' => $value['file_laporan_lpj'],
            'status_acc_lpj' => 1,
            'tanggal_pengajuan_lpj' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db->where('id_anggaran', $id);
        $this->db->update($this->table_budget, $data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function update_status_proposal($id = '', $value = '', $path = '', $nominal = '', $ket = '') {
        $this->db->trans_begin();

        $data = array(
            'status_acc_proposal' => $value,
            'nominal_dana_acc' => @$nominal,
            'file_laporan_proposal_acc' => @$path,
            'keterangan_prop' => @$ket,
            'tanggal_persetujuan_proposal' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db->where('id_anggaran', $id);
        $this->db->update($this->table_budget, $data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function update_status_lpj($id = '', $value = '', $path = '', $ket = '') {
        $this->db->trans_begin();

        $data = array(
            'status_acc_lpj' => $value,
            'file_laporan_lpj_acc' => @$path,
            'keterangan_lpj' => @$ket,
            'tanggal_persetujuan_lpj' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db->where('id_anggaran', $id);
        $this->db->update($this->table_budget, $data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function delete_budget_fondation($value) {
        $this->db->trans_begin();

        $this->db->where('id_anggaran', $value);
        $this->db->delete($this->table_budget);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    //-----------------------------------------------------------------------//
//
}

?>
