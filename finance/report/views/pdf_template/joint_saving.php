<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E-Tabungan Bersama Sekolah Utsman</title>

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
            <td><strong>Judul:</strong> Rekap Tabungan Bersama Utsman </td>
            <td><strong>Periode Tanggal:</strong> <?php echo $rentang_tanggal; ?> </td>
        </tr>

    </table>
    <br />
    <table width="100%">
        <thead style="background-color: #f2c195;">
            <tr>
                <th>#</th>
                <th>No Rek.</th>
                <th>Nama Tabungan</th>
                <th>Penanggung Jawab</th>
                <th>Nomor Handphone</th>
                <th>Tahun Ajaran</th>
                <th>Tingkat</th>
                <th>Kredit</th>
                <th>Debit</th>
                <th>Saldo</th>
				<th>Jenis Tabungan</th>
        </thead>
        <tbody>
            <?php

$total_debit = 0;
$total_kredit = 0;
$total_saldo = 0;

$tingkat = '';
$jenis_tabungan = '';

$number = 1;

if (!empty($saving)) {
    foreach ($saving as $key => $value) {

        $total_kredit = $total_kredit + $value->kredit_bersama;
        $total_debit = $total_debit + $value->debet_bersama;
        $total_saldo = $total_saldo + $value->saldo_bersama;

        if ($value->id_tingkat == '6') {
            $tingkat = 'DC';
        } else if ($value->id_tingkat == '1') {
            $tingkat = 'KB';
        } else if ($value->id_tingkat == '2') {
            $tingkat = 'TK';
        } else if ($value->id_tingkat == '3') {
            $tingkat = 'SD';
        } else if ($value->id_tingkat == '4') {
            $tingkat = 'SMP';
        }

        if ($value->jenis_tabungan == '1') {
            $jenis_tabungan = 'KOMITE';
        } else if ($value->jenis_tabungan == '2') {
            $jenis_tabungan = 'KELAS';
        }

        ?>
            <tr>
                <th scope="row"><?php echo $number; ?></th>
                <td align="left"><?php echo (($value->nomor_rekening_bersama)); ?></td>
                <td align="left"><?php echo (strtoupper($value->nama_tabungan_bersama)); ?></td>
                <td align="left"><?php echo strtoupper(strtoupper($value->nama_lengkap)) . " (" . $value->number . ")"; ?></td>
                <td align="left"><?php echo (($value->nomor_handphone)); ?></td>
                <td align="left"><?php echo (($value->tahun_ajaran)); ?></td>
                <td align="left"><?php echo (($tingkat)); ?></td>
                <td align="left"><?php echo number_format($value->kredit_bersama, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($value->debet_bersama, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($value->saldo_bersama, 0, ',', '.'); ?></td>
                <td align="left"><?php echo (($jenis_tabungan)); ?></td>
            </tr>
            <?php
$number++;
    } //ngatur nomor urut
}
?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"></td>
                <td align="left">TOTAL (Rp)</td>
                <td align="left" class="gray"><?php echo number_format($total_kredit, 0, ',', '.'); ?></td>
                <td align="left" class="gray"><?php echo number_format($total_debit, 0, ',', '.'); ?></td>
                <td align="left" class="gray"><?php echo number_format($total_saldo, 0, ',', '.'); ?></td>
            </tr>
        </tfoot>
    </table>
    <br>
</body>

</html>
