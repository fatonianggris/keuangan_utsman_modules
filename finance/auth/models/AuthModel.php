<?php

class AuthModel extends CI_Model {

    private $table_account = 'akun_keuangan';
    private $table_general_page = 'general_page';
    private $table_contact = 'kontak';

    //
    //-------------------------------AUTH------------------------------//
    //
    public function get_page() {

        $this->db->select('*');
        $this->db->where('id_general_page', 1);
        $sql = $this->db->get($this->table_general_page);
        return $sql->result();
    }

    public function get_contact() {

        $this->db->select('*');
        $this->db->where('id_kontak', 1);
        $sql = $this->db->get($this->table_contact);
        return $sql->result();
    }

    public function reset_account_password($email = '', $password = '') {
        $this->db->trans_begin();

        $data = array(
            'password' => password_hash($password, PASSWORD_DEFAULT, array('cost' => 12)),
        );

        $this->db->where('email_akun', $email);
        $this->db->update($this->table_account, $data);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function check_user($value = '') {
        $this->db->where('email_akun', $value['email']);
        $sql = $this->db->get($this->table_account);
        return $sql->result();
    }

    public function data_user($value = '') {
        $this->db->select('a.id_akun_keuangan, a.nama_akun, a.email_akun, a.nomor_handphone_akun, a.role_akun, s.id_role_struktur, s.nama_struktur');
        $this->db->from('akun_keuangan a');
        $this->db->join('struktur_akun_keuangan s', 'a.role_akun=s.id_struktur', 'left');
        $this->db->where('a.email_akun', $value['email']);
        $sql = $this->db->get($this->table_account);
        return $sql->result();
    }

    public function check_email_account($email = '') {
        $this->db->where('email_akun', $email);
        $sql = $this->db->get($this->table_account);
        return $sql->result();
    }

    //----------------------------------------------------------------//
}

?>