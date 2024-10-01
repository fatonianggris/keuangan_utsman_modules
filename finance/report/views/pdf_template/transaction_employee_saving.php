<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E-Tabungan <?php echo $jenis_tabungan; ?> Sekolah Utsman</title>

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
            <td><strong>Judul:</strong> Rekap Tabungan Pegawai <?php echo $jenis_tabungan; ?> Utsman </td>
            <td><strong>Periode Tanggal:</strong> <?php echo $rentang_tanggal; ?> </td>
        </tr>

    </table>
    <br />
    <table width="100%">
        <thead style="background-color: #f2c195;">
            <tr>
                <th>#</th>
                <th>Nomor Transaksi</th>
				<th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Jenis Transaksi</th>
                <th>Tanggal Tabungan</th>
                <th>Tahun Ajaran</th>
                <th>Waktu Transaksi</th>
				<th>Tingkat</th>
                <th>Kredit (Rp)</th>
                <th>Debit (Rp)</th>
                <th>Saldo (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php
$total_debit = 0;
$total_kredit = 0;
$total_saldo = 0;

$jenis_transaksi = '';
$nama_tingkat = '';
$debit = 0;
$kredit = 0;

$number = 1;

if (!empty($saving)) {
    foreach ($saving as $key => $value) {

        if ($value->status_kredit_debet == 1) {
            $jenis_transaksi = 'KREDIT';
            $debit = 0;
            $kredit = $value->nominal;
            $total_kredit = $total_kredit + $value->nominal;

        } else if ($value->status_kredit_debet == 2) {
            $jenis_transaksi = 'DEBIT';
            $debit = $value->nominal;
            $kredit = 0;
            $total_debit = $total_debit + $value->nominal;
        }

        if ($value->id_tingkat == 1) {
            $nama_tingkat = 'DC/KB/TK';
        } else if ($value->id_tingkat == 3) {
            $nama_tingkat = 'SD';
        } else if ($value->id_tingkat == 4) {
            $nama_tingkat = 'SMP';
        } else if ($value->id_tingkat == 6) {
            $nama_tingkat = 'UMUM';
        }

        $total_saldo = $total_saldo + $value->saldo;
        ?>
            <tr>
                <th scope="row"><?php echo $number; ?></th>
                <td align="left"><?php echo (strtoupper($value->nomor_transaksi)); ?></td>
				<td align="left"><?php echo (strtoupper($value->nip_pegawai)); ?></td>
                <td align="left"><?php echo ucwords(strtoupper($value->nama_lengkap)); ?></td>
                <td align="left"><?php echo $jenis_transaksi; ?></td>
                <td align="left"><?php echo $value->tanggal_transaksi; ?></td>
                <td align="left"><?php echo $value->tahun_ajaran; ?></td>
                <td align="left"><?php echo $value->waktu_transaksi; ?></td>
				<td align="left"><?php echo $nama_tingkat; ?></td>
                <td align="left"><?php echo number_format($kredit, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($debit, 0, ',', '.'); ?></td>
                <td align="left"><?php echo number_format($value->saldo, 0, ',', '.'); ?></td>
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
                <td align="left" class="gray"><?php echo number_format($total_kredit, 0, ',', '.'); ?></td>
                <td align="left" class="gray"><?php echo number_format($total_debit, 0, ',', '.'); ?></td>
            </tr>
        </tfoot>
    </table>
    <br>
</body>

</html>
