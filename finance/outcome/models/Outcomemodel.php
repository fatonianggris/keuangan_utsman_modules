<?php

class OutcomeModel extends CI_Model {

    private $table_structure = 'struktur_akun_keuangan';
    private $table_general_page = 'general_page';
    private $table_outcome = 'pengeluaran';

    //
    //------------------------------COUNT--------------------------------//
    //
   
    //
    //------------------------------GET VISITOR--------------------------------//
    //  

    public function get_page() {

        $this->db->select('*');
        $this->db->where('id_general_page', 1);
        $sql = $this->db->get($this->table_general_page);
        return $sql->result();
    }

    public function get_structure_account() {

        $this->db->select('*');
        $this->db->where_not_in('id_role_struktur', array(1, 2, 3, 7, 8));
        $sql = $this->db->get($this->table_structure);

        return $sql->result();
    }

    public function get_schoolyear() {

        $sql = $this->db->query("SELECT * FROM tahun_ajaran WHERE semester='ganjil'");

        return $sql->result();
    }

    public function check_name_division($id = '') {
        $this->db->where('id_struktur', $id);

        $sql = $this->db->get($this->table_structure);
        return $sql->result();
    }

    public function get_outcome_id($id = '') {
        $this->db->select("p.*, 
                                ak.nama_akun,
                                ak.nomor_handphone_akun,
                                ak.email_akun,
                                sak.id_struktur,
                                (SELECT
                                        sakg.nama_struktur
                                    FROM
                                        struktur_akun_keuangan sakg
                                    WHERE
                                        sakg.id_struktur = p.jenis_pengeluaran
                                ) AS kategori_bidang,
                                sak.nama_struktur,
                                CONCAT(t.tahun_awal,'/',t.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.tanggal_acc, '%d/%m/%Y') AS tanggal_acc_pengeluaran,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_pengajuan,
                                MONTH(p.inserted_at) AS bulan
                         ");
        $this->db->from('pengeluaran p');
        $this->db->join('tahun_ajaran t', 'p.id_tahun_ajaran = t.id_tahun_ajaran', 'left');
        $this->db->join('akun_keuangan ak', 'p.id_akun_keuangan = ak.id_akun_keuangan', 'left');
        $this->db->join('struktur_akun_keuangan sak', 'ak.role_akun = sak.id_struktur', 'left');
        $this->db->where('p.id_pengeluaran', $id);

        $sql = $this->db->get();
        return $sql->result();
    }

    public function get_outcome() {
        $this->db->select("p.*, 
                                ak.nama_akun,
                                ak.nomor_handphone_akun,
                                ak.email_akun,
                                sak.nama_struktur,
                                (SELECT
                                        sakg.nama_struktur
                                    FROM
                                        struktur_akun_keuangan sakg
                                    WHERE
                                        sakg.id_struktur = p.jenis_pengeluaran
                                ) AS kategori_bidang,
                                CONCAT(t.tahun_awal,'/',t.tahun_akhir) AS tahun_ajaran,
                                DATE_FORMAT(p.tanggal_acc, '%d/%m/%Y') AS tanggal_acc_pengeluaran,
                                DATE_FORMAT(p.inserted_at, '%d/%m/%Y') AS tanggal_pengajuan,
                                MONTH(p.inserted_at) AS bulan
                         ");
        $this->db->from('pengeluaran p');
        $this->db->join('tahun_ajaran t', 'p.id_tahun_ajaran = t.id_tahun_ajaran', 'left');
        $this->db->join('akun_keuangan ak', 'p.id_akun_keuangan = ak.id_akun_keuangan', 'left');
        $this->db->join('struktur_akun_keuangan sak', 'ak.role_akun = sak.id_struktur', 'left');
        $this->db->order_by('p.inserted_at', 'DESC');

        $sql = $this->db->get();
        return $sql->result();
    }

    public function insert_nota_outcome($id = '', $value = '') {
        $this->db->trans_begin();

        $data = array(
            'id_akun_keuangan' => $id,
            'id_tahun_ajaran' => $value['id_tahun_ajaran'],
            'nama_pengeluaran' => $value['nama_pengeluaran'],
            'nominal_pengeluaran' => $value['nominal_pengeluaran'],
            'uraian' => $value['uraian'],
            'jenis_pengeluaran' => $value['jenis_pengeluaran'],
            'jenjang_pengeluaran' => $value['jenjang_pengeluaran'],
            'status_pembayaran' => $value['status_pembayaran'],
            'status_pengeluaran' => $value['status_pengeluaran'],
            'tanggal_acc' => @$value['tanggal_acc'],
            'file_nota' => @$value['file_nota'],
        );

        $this->db->insert($this->table_outcome, $data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function update_nota_outcome($id = '', $value = '') {
        $this->db->trans_begin();

        $data = array(
            'id_tahun_ajaran' => $value['id_tahun_ajaran'],
            'nama_pengeluaran' => $value['nama_pengeluaran'],
            'nominal_pengeluaran' => $value['nominal_pengeluaran'],
            'uraian' => $value['uraian'],
            'jenis_pengeluaran' => $value['jenis_pengeluaran'],
            'jenjang_pengeluaran' => $value['jenjang_pengeluaran'],
            'status_pembayaran' => $value['status_pembayaran'],
            'status_pengeluaran' => $value['status_pengeluaran'],
            'file_nota' => @$value['file_nota'],
            'updated_at' => date("Y-m-d H:i:s"),
        );

        $this->db->where('id_pengeluaran', $id);
        $this->db->update($this->table_outcome, $data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function update_recipe_outcome($id = '', $value = '') {
        $this->db->trans_begin();

        $data = array(
            'status_pengeluaran' => $value['status_pengeluaran'],
            'file_transfer' => @$value['file_transfer'],
            'keterangan' => @$value['keterangan'],
            'tanggal_acc' => date("Y-m-d H:i:s"),
        );

        $this->db->where('id_pengeluaran', $id);
        $this->db->update($this->table_outcome, $data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function delete_outcome($value) {
        $this->db->trans_begin();

        $this->db->where('id_pengeluaran', $value);
        $this->db->delete($this->table_outcome);

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