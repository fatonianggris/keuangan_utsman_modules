<?php

class DashboardModel extends CI_Model {

    private $site_log = 'track_visitor';

    //
    //------------------------------COUNT--------------------------------//
    //
    
    public function get_budget_insight() {
        $sql = $this->db->query("SELECT
                                (
                                SELECT
                                    COALESCE(SUM(a.nominal_dana_terpakai),0)
                                FROM
                                    anggaran a
                            ) AS dana_terpakai,
                            (
                                SELECT
                                    COALESCE(SUM(a.nominal_dana_eksternal),0)
                                FROM
                                    anggaran a
                            ) AS dana_eksternal,
                            (
                                SELECT
                                    COALESCE(SUM(a.nominal_dana_acc),0)
                                FROM
                                    anggaran a
                            ) AS dana_acc,
                            (
                                SELECT
                                    COALESCE(SUM(a.nominal_dana_sisa),0)
                                FROM
                                    anggaran a
                            ) AS dana_sisa");
        return $sql->result();
    }

    public function get_outcome_persen_insight() {
        $sql = $this->db->query("SELECT                                   
                                    (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),
                                        0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        ak.role_akun = 4
                                ) AS sekertaris,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),
                                        0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        ak.role_akun = 5
                                ) AS bendahara,
                                (
                                   SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),
                                        0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        ak.role_akun = 6
                                ) AS b_pendidikan,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),
                                        0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        ak.role_akun = 7
                                ) AS b_keagamaan,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),
                                        0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        ak.role_akun = 8
                                ) AS b_sosial,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),
                                        0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        ak.role_akun = 9
                                ) AS b_sarpras,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),
                                        0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        ak.role_akun = 10
                                ) AS b_dana_usaha,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),
                                        0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        ak.role_akun = 13
                                ) AS b_binus");
        return $sql->result();
    }

    public function get_budget_terpakai_insight() {
        $sql = $this->db->query("SELECT
                                        th.*,
                                        (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_terpakai),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 4
                                    ) AS sekertaris,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_terpakai),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 5
                                    ) AS bendahara,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_terpakai),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 6
                                    ) AS b_pendidikan,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_terpakai),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 7
                                    ) AS b_keagamaan,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_terpakai),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 8
                                    ) AS b_sosial,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_terpakai),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 9
                                    ) AS b_sarpras,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_terpakai),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                            a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 10
                                    ) AS b_dana_usaha,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_terpakai),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                            a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 13
                                    ) AS b_binus,
                                    CONCAT(
                                        'TA. ',
                                        th.tahun_awal,
                                        '/',
                                        th.tahun_akhir
                                    ) AS tahun_ajaran
                                    FROM
                                        tahun_ajaran th
                                    WHERE
                                        (
                                            th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND th.semester = 'ganjil'
                                        ORDER BY
                                            th.tahun_awal ASC");
        return $sql->result();
    }

    public function get_budget_eksternal_insight() {
        $sql = $this->db->query("SELECT
                                        th.*,
                                        (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_eksternal),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 4
                                    ) AS sekertaris,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_eksternal),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 5
                                    ) AS bendahara,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_eksternal),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 6
                                    ) AS b_pendidikan,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_eksternal),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 7
                                    ) AS b_keagamaan,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_eksternal),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 8
                                    ) AS b_sosial,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_eksternal),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 9
                                    ) AS b_sarpras,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_eksternal),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                            a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 10
                                    ) AS b_dana_usaha,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_eksternal),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                            a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 13
                                    ) AS b_binus,
                                    CONCAT(
                                        'TA. ',
                                        th.tahun_awal,
                                        '/',
                                        th.tahun_akhir
                                    ) AS tahun_ajaran
                                    FROM
                                        tahun_ajaran th
                                    WHERE
                                        (
                                            th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND th.semester = 'ganjil'
                                        ORDER BY
                                            th.tahun_awal ASC");
        return $sql->result();
    }

    public function get_budget_acc_insight() {
        $sql = $this->db->query("SELECT
                                        th.*,
                                        (
                                        SELECT
                                             COALESCE(SUM(a.nominal_dana_acc),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 4
                                    ) AS sekertaris,
                                    (
                                        SELECT
                                             COALESCE(SUM(a.nominal_dana_acc),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 5
                                    ) AS bendahara,
                                    (
                                        SELECT
                                             COALESCE(SUM(a.nominal_dana_acc),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 6
                                    ) AS b_pendidikan,
                                    (
                                        SELECT
                                             COALESCE(SUM(a.nominal_dana_acc),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 7
                                    ) AS b_keagamaan,
                                    (
                                        SELECT
                                             COALESCE(SUM(a.nominal_dana_acc),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 8
                                    ) AS b_sosial,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_acc),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 9
                                    ) AS b_sarpras,
                                    (
                                        SELECT
                                             COALESCE(SUM(a.nominal_dana_acc),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                            a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 10
                                    ) AS b_dana_usaha,
                                    (
                                        SELECT
                                             COALESCE(SUM(a.nominal_dana_acc),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                            a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 13
                                    ) AS b_binus,
                                    CONCAT(
                                        'TA. ',
                                        th.tahun_awal,
                                        '/',
                                        th.tahun_akhir
                                    ) AS tahun_ajaran
                                    FROM
                                        tahun_ajaran th
                                    WHERE
                                        (
                                            th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND th.semester = 'ganjil'
                                        ORDER BY
                                            th.tahun_awal ASC");
        return $sql->result();
    }

    public function get_budget_sisa_insight() {
        $sql = $this->db->query("SELECT
                                        th.*,
                                        (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_sisa),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 4
                                    ) AS sekertaris,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_sisa),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 5
                                    ) AS bendahara,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_sisa),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 6
                                    ) AS b_pendidikan,
                                    (
                                        SELECT
                                           COALESCE(SUM(a.nominal_dana_sisa),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 7
                                    ) AS b_keagamaan,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_sisa),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 8
                                    ) AS b_sosial,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_sisa),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                           a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 9
                                    ) AS b_sarpras,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_sisa),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                            a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 10
                                    ) AS b_dana_usaha,
                                    (
                                        SELECT
                                            COALESCE(SUM(a.nominal_dana_sisa),0)
                                        FROM
                                            anggaran a
                                        LEFT JOIN akun_keuangan ak ON
                                            a.id_akun_keuangan = ak.id_akun_keuangan
                                        WHERE
                                            a.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 13
                                    ) AS b_binus,
                                    CONCAT(
                                        'TA. ',
                                        th.tahun_awal,
                                        '/',
                                        th.tahun_akhir
                                    ) AS tahun_ajaran
                                    FROM
                                        tahun_ajaran th
                                    WHERE
                                        (
                                            th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND th.semester = 'ganjil'
                                        ORDER BY
                                            th.tahun_awal ASC");
        return $sql->result();
    }

    public function get_outcome_insight() {
        $sql = $this->db->query("SELECT
                                    th.*,
                                    (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        p.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 4
                                ) AS sekertaris,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        p.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 5
                                ) AS bendahara,
                                (
                                   SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        p.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 6
                                ) AS b_pendidikan,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        p.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 7
                                ) AS b_keagamaan,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        p.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 8
                                ) AS b_sosial,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        p.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 9
                                ) AS b_sarpras,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        p.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 10
                                ) AS b_dana_usaha,
                                (
                                    SELECT
                                        COALESCE(SUM(p.nominal_pengeluaran),0)
                                    FROM
                                        pengeluaran p
                                    LEFT JOIN akun_keuangan ak ON
                                        p.jenis_pengeluaran = ak.role_akun
                                    WHERE
                                        p.id_tahun_ajaran = th.id_tahun_ajaran AND ak.role_akun = 13
                                ) AS b_binus,
                                CONCAT(
                                    'TA. ',
                                    th.tahun_awal,
                                    '/',
                                    th.tahun_akhir
                                ) AS tahun_ajaran
                                FROM
                                    tahun_ajaran th
                                WHERE
                                    (
                                        th.tahun_awal BETWEEN(YEAR(CURDATE()) -1) AND(YEAR(CURDATE()) +1)) AND th.semester = 'ganjil'
                                    ORDER BY
                                        th.tahun_awal ASC");
        return $sql->result();
    }

    //-----------------------------------------------------------------------//
//
}

?>