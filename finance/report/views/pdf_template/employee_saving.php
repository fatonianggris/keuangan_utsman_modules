<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E-Tabungan Pegawai Sekolah Utsman</title>

    <style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }

    table {
        font-size: x-small;
    }

    tfoot tr td {
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: #f2c195
    }
    </style>

</head>

<body
    style="background-image: url('<?php echo base_url() . $page[0]->logo_website ?>'); opacity: 0.2; background-repeat: no-repeat;background-attachment: fixed;background-position: center;">
    <table width="100%">
        <tr>
            <td valign="top"><img src="<?php echo base_url() . $page[0]->logo_website ?>" alt="" width="120" /></td>
            <td align="right">
                <h2 style="color:#f77d0e"><?php echo $page[0]->nama_website; ?></h2>

                <?php echo $contact[0]->alamat; ?><br>
                <?php echo $contact[0]->nomor_telephone; ?> / <?php echo $contact[0]->no_handphone; ?><br>
                <?php echo $contact[0]->email; ?><br>
                <?php echo $contact[0]->url_website; ?><br>
            </td>
        </tr>

    </table>

    <table width="100%">
        <tr>
			<td colspan="2"></td>
            <td><strong>Judul:</strong> Rekap Tabungan Per Siswa Utsman </td>
            <td><strong>Periode Tanggal:</strong> <?php echo $rentang_tanggal; ?> </td>
        </tr>

    </table>
    <br />
    <table width="100%">
        <thead style="background-color: #f2c195;">
            <tr>
                <th>#</th>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
				<th>JK</th>
                <th>Tingkat</th>
                <th>Nomor Handphone</th>
                <th>Email</th>
                <th>Status Pegawai</th>
                <th>Kredit Umum</th>
                <th>Debet Umum</th>
                <th>Saldo Umum</th>
            </tr>
        </thead>
        <tbody>
            <?php

$tingkat = "";
$jk = "";
$status_pegawai = "";

$total_debit_um = 0;
$total_kredit_um = 0;
$total_saldo_um = 0;

$number = 1;

if (!empty($saving)) {
    foreach ($saving as $key => $value) {

        if ($value->level_tingkat == '1') {
            $tingkat = 'DC/KB/TK';
        } else if ($value->level_tingkat == '3') {
            $tingkat = 'SD';
        } else if ($value->level_tingkat == '4') {
            $tingkat = 'SMP';
        } else if ($value->level_tingkat == '6') {
            $tingkat = 'UMUM';
        }

        if ($value->jenis_kelamin == '1') {
            $jk = 'L';
        } else if ($value->level_tingkat == '2') {
            $jk = 'P';
        }
        if ($value->jenis_pegawai == '1') {
            $status_pegawai = 'TETAP';
        } else if ($value->jenis_pegawai == '2') {
            $status_pegawai = 'TIDAK TETAP';
        } else if ($value->jenis_pegawai == '2') {
            $status_pegawai = 'HONORER';
        }

        $total_kredit_um = $total_kredit_um + $value->kredit_umum;
        $total_debit_um = $total_debit_um + $value->debet_umum;
        $total_saldo_um = $total_saldo_um + $value->saldo_umum;

        ?>
            <tr>
                <th scope="row"><?php echo $number; ?></th>
                <td align="left"><?php echo (strtoupper($value->nip)); ?></td>
                <td align="left"><?php echo ucwords(strtoupper($value->nama_lengkap)); ?></td>
                <td align="left"><?php echo (strtoupper($value->hasil_nama_jabatan)); ?></td>
                <td align="left"><?php echo $jk; ?></td>
                <td align="left"><?php echo $tingkat; ?></td>
                <td align="left"><?php echo $value->nomor_hp; ?></td>
                <td align="left"><?php echo $value->email; ?></td>
                <td align="left"><?php echo $status_pegawai; ?></td>
                <td align="left"><?php echo number_format($value->kredit_umum, 0, ',', '.'); ?></td>
				<td align="left"><?php echo number_format($value->debet_umum, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($value->saldo_umum, 0, ',', '.'); ?></td>
            </tr>
            <?php
$number++;
    } //ngatur nomor urut
}
?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8"></td>
                <td align="left">TOTAL (Rp)</td>
                <td align="left" class="gray"><?php echo number_format($total_kredit_um, 0, ',', '.'); ?></td>
                <td align="left" class="gray"><?php echo number_format($total_debit_um, 0, ',', '.'); ?></td>
				<td align="left" class="gray"><?php echo number_format($total_saldo_um, 0, ',', '.'); ?></td>
            </tr>
        </tfoot>
    </table>
    <br>
</body>

</html>
