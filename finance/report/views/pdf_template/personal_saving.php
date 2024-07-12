<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E-Tabungan Siswa Sekolah Utsman</title>

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
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Tingkat</th>
				<th>Kredit Umum</th>
                <th>Debit Umum</th>
                <th>Saldo Umum</th>
                <th>Kredit Qurban</th>
                <th>Debit Qurban</th>
                <th>Saldo Qurban</th>
                <th>Kredit Wisata</th>
                <th>Debit Wisata</th>
                <th>Saldo Wisata</th>
            </tr>
        </thead>
        <tbody>
            <?php

$tingkat = "";

$total_debit_um = 0;
$total_kredit_um = 0;
$total_saldo_um = 0;

$total_debit_qr = 0;
$total_kredit_qr = 0;
$total_saldo_qr = 0;

$total_debit_ws = 0;
$total_kredit_ws = 0;
$total_saldo_ws = 0;

$number = 1;

if (!empty($saving)) {
    foreach ($saving as $key => $value) {

		if ($value->level_tingkat == '6') {
			$tingkat = 'DC';
		} else if ($value->level_tingkat == '1') {
			$tingkat = 'KB';
		} else if ($value->level_tingkat == '2') {
			$tingkat = 'TK';
		} else if ($value->level_tingkat == '3') {
			$tingkat = 'SD';
		} else if ($value->level_tingkat == '4') {
			$tingkat = 'SMP';
		}

        $total_kredit_um = $total_kredit_um + $value->kredit_umum;
        $total_debit_um = $total_debit_um + $value->debet_umum;
        $total_saldo_um = $total_saldo_um + $value->saldo_umum;

        $total_kredit_qr = $total_kredit_qr + $value->kredit_qurban;
        $total_debit_qr = $total_debit_qr + $value->debet_qurban;
        $total_saldo_qr = $total_saldo_qr + $value->saldo_qurban;

        $total_kredit_ws = $total_kredit_ws + $value->kredit_wisata;
        $total_debit_ws = $total_debit_ws + $value->debet_wisata;
        $total_saldo_ws = $total_saldo_ws + $value->saldo_wisata;

        ?>
            <tr>
                <th scope="row"><?php echo $number; ?></th>
                <td align="left"><?php echo (strtoupper($value->nis)); ?></td>
                <td align="left"><?php echo ucwords(strtoupper($value->nama_lengkap)); ?></td>
                <td align="left"><?php echo $tingkat; ?></td>
                <td align="left"><?php echo number_format($value->kredit_umum, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($value->debet_umum, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($value->saldo_umum, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($value->kredit_qurban, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($value->debet_qurban, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($value->saldo_qurban, 0, ',', '.'); ?></td>
				<td align="left"><?php echo number_format($value->kredit_wisata, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($value->debet_wisata, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($value->saldo_wisata, 0, ',', '.'); ?></td>
            </tr>
            <?php
$number++;
    } //ngatur nomor urut
}
?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td align="left">TOTAL (Rp)</td>
                <td align="left" class="gray"><?php echo number_format($total_kredit_um, 0, ',', '.'); ?></td>
                <td align="left" class="gray"><?php echo number_format($total_debit_um, 0, ',', '.'); ?></td>
				<td align="left" class="gray"><?php echo number_format($total_saldo_um, 0, ',', '.'); ?></td>
				<td align="left" class="gray"><?php echo number_format($total_kredit_qr, 0, ',', '.'); ?></td>
                <td align="left" class="gray"><?php echo number_format($total_debit_qr, 0, ',', '.'); ?></td>
				<td align="left" class="gray"><?php echo number_format($total_saldo_qr, 0, ',', '.'); ?></td>
				<td align="left" class="gray"><?php echo number_format($total_kredit_ws, 0, ',', '.'); ?></td>
                <td align="left" class="gray"><?php echo number_format($total_debit_ws, 0, ',', '.'); ?></td>
				<td align="left" class="gray"><?php echo number_format($total_saldo_ws, 0, ',', '.'); ?></td>
            </tr>
        </tfoot>
    </table>
    <br>
</body>

</html>
