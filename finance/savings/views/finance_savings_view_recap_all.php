<!--begin::Content-->
<?php $user = $this->session->userdata('sias-finance');?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">

                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Detail Dashboard Admin</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="top">
                <a onclick="window.history.back();" class="btn btn-light-danger btn-sm font-weight-bold"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="fa fa-backward"></i>Kembali</a>
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <?php if ($user[0]->id_role_struktur == 7) {?>
                <?php } else {?>
                <div class="col-lg-6 col-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header h-auto">
                            <!--begin::Title-->
                            <div class="card-title py-5">
                                <h3 class="card-label">Grafik Kredit Tabungan per 3 Tahun Ajaran</h3>
                            </div>
                            <!--end::Title-->
                            <div class="card-toolbar">
                                <?php if ($user[0]->id_role_struktur == 7 || $user[0]->id_role_struktur == 5) {?>
                                <button class="btn btn-success mr-2" data-toggle="modal" data-target="#modalKredit"
                                    id="btnKredit">
                                    <i class="fa fa-plus"></i> Setor Tabungan
                                </button>
                                <?php }?>
                            </div>
                        </div>
                        <!--end::Header-->
                        <div class="card-body">
                            <!--begin::Chart-->
                            <div id="chart_kredit"></div>
                            <!--end::Chart-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-lg-6 col-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header h-auto">
                            <!--begin::Title-->
                            <div class="card-title py-5">
                                <h3 class="card-label">Grafik Debit Tabungan per 3 Tahun Ajaran</h3>
                            </div>
                            <!--end::Title-->
                            <div class="card-toolbar">
                                <?php if ($user[0]->id_role_struktur == 7 || $user[0]->id_role_struktur == 5) {?>
                                <button class="btn btn-danger mr-2" data-toggle="modal" data-target="#modalDebet"
                                    id="btnDebet">
                                    <i class="fa fa-minus"></i> Tarik Tabungan
                                </button>
                                <?php }?>
                            </div>
                        </div>
                        <!--end::Header-->
                        <div class="card-body">
                            <!--begin::Chart-->
                            <div id="chart_debet"></div>
                            <!--end::Chart-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>

                <?php }?>
                <div class="col-lg-7 col-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Histori Setor & Tarik
                                    Tabungan</span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new
                                    members</span>
                            </h3>
                            <div class="card-toolbar">
                                <?php if ($user[0]->id_role_struktur == 7 || $user[0]->id_role_struktur == 5) {?>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalRekap"
                                    id="btnRekap">
                                    <i class="fa fa-suitcase"></i> Rekap Tabungan
                                </button>
                                <?php }?>
                            </div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-0 pb-3">
                            <div class="tab-content">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <table
                                        class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                                        <thead>
                                            <tr class="text-left text-uppercase">
                                                <th style="min-width: 250px" class="pl-7"><span
                                                        class="text-dark-75">NAMA & NIS</span></th>
                                                <th style="min-width: 100px">NOMINAL</th>
                                                <th style="min-width: 100px">TRANSAKSI</th>
                                                <th style="min-width: 130px">WAKTU TRANSAKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
												if (!empty($transaksi)) {
													foreach ($transaksi as $key => $value) {
														$status_transaction = "";
														$status_label = "";
														if ($value->status_kredit_debet == 1) {
															$status_transaction = "KREDIT";
															$status_label = "success";
														} else {
															$status_transaction = "DEBET";
															$status_label = "danger";
														}

														$image = "";
														if ($value->jenis_kelamin == 1) {
															$image = "/assets/finance/dist/assets/media/svg/avatars/001-boy.svg";
														} else {
															$image = "/assets/finance/dist/assets/media/svg/avatars/018-girl-9.svg";
														}
														?>
																							<tr>
																								<td class="pl-0 py-2">
																									<div class="d-flex align-items-center">
																										<div class="symbol symbol-50 symbol-light mr-4">
																											<span class="symbol-label">
																												<img src="<?php echo base_url() . $image; ?>"
																													class="h-75 align-self-end" alt="">
																											</span>
																										</div>
																										<div>
																											<a href="#"
																												class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
																												<?php echo strtoupper(strtolower($value->nama_lengkap)); ?>
																											</a>
																											<span class="text-muted font-weight-bold d-block">
																												NIS:
																												<?php echo strtoupper(strtolower($value->nis_siswa)); ?>
																											</span>
																										</div>
																									</div>
																								</td>
																								<td>
																									<span class="text-dark-75 font-weight-bolder d-block font-size-lg">
																										Rp.<?php echo number_format($value->nominal, 0, ',', '.'); ?>
																									</span>
																								</td>
																								<td>
																									<span
																										class="label label-lg label-inline label-light-<?php echo $status_label; ?> font-weight-bolder">
																										<?php echo $status_transaction; ?>
																									</span>
																								</td>
																								<td>
																									<span class="text-dark-75 font-weight-bolder d-block font-size-lg">
																										<?php echo $value->waktu_transaksi; ?>
																									</span>
																									<span class="text-muted font-weight-bold">
																										TA. <?php echo $value->tahun_ajaran; ?>
																									</span>
																								</td>
																							</tr>
																							<?php
												} //ngatur nomor urut
												}
												?>
                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-lg-5 col-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header h-auto">
                            <!--begin::Title-->
                            <div class="card-title py-5">
                                <h3 class="card-label">Total Setor & Tarik Tabungan per 3 Tahun Ajaran</h3>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <div class="card-body">
                            <!--begin::Chart-->
                            <div id="chart_kredit_debet"></div>
                            <!--end::Chart-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
        value="<?php echo $this->security->get_csrf_hash(); ?>">
</div>
<!--end::Content-->
<!-- Modal Kredit  -->
<div class="modal fade" tabindex="" role="dialog" id="modalKredit">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_credit">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title font-weight-bolder"> Setor Tabungan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_add_transaction_credit">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-5">
                            <label> Cari Siswa</label>
                            <select class="form-control select2 findNasabahKredit" name="inputCariSiswaKredit"
                                id="findNasabahKredit" required>
                            </select>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> inputkan
                                nama siswa</span>
                        </div>
                        <div class="form-group col-4">
                            <label> Nominal </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bolder">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg kt_money_input_kredit"
                                    name="inputNominalKreditName" id="inputNominalKredit" placeholder="Input nominal" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> isikan
                                    nominal</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="inputTahunAjaranKredit" class="form-control form-control-lg"
                                    id="inputTahunAjaranKredit">
                                    <option value="">Pilih TA</option>
                                    <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value_sch) {
        if ($value_sch->tahun_awal == (date("Y"))) {
            ?>
                                    <option value="<?php echo $value_sch->id_tahun_ajaran; ?>" selected>
                                        <?php echo $value_sch->tahun_awal; ?>/<?php echo $value_sch->tahun_akhir; ?>
                                    </option>
                                    <?php } else {
            ?>
                                    <option value="<?php echo $value_sch->id_tahun_ajaran; ?>">
                                        <?php echo $value_sch->tahun_awal; ?>/<?php echo $value_sch->tahun_akhir; ?>
                                    </option>
                                    <?php
}
    }
}
?>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH</b></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Kredit U/ tanggal</label>
                                <input type="text" name="inputTanggalKredit" value="<?php echo date('d/m/Y'); ?>"
                                    class="form-control form-control-lg kt_datepicker_kredit" id="inputTanggalKredit"
                                    placeholder="Inputkan Kredit Untuk Tanggal" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Tanggal u/
                                    Kredit</span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Catatan Kredit</label>
                                <textarea class="form-control" id="inputCatatanKredit"
                                    placeholder="Isikan Catatan Kredit" name="uraian" rows="2"></textarea>
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>Isikan
                                    Catatan Kredit singkat</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>-- INFORMASI --</b>
                            </div>
                        </div>

                        <div class="col-md-6">
                            NIS : <label class="font-weight-bold" id="userNisKredit">-</label><br>
                            Nama : <label class="font-weight-bold" id="userNamaKredit">-</label><br>
                            Kelas : <label class="font-weight-bold" id="userKelasKredit">-</label><br>
                        </div>
                        <div class="col-md-6 ">
                            Catatan : <label class="font-weight-bold" id="userCatatanKredit">-</label><br>
                            Transaksi Terakhir : <label class="font-weight-bold timeago"
                                id="infoTerakhirTransaksiKredit">-</label><br>
                            Saldo : <label class="font-weight-bold" id="userJumlahSaldoKredit">-</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success font-weight-bolder" id="btnInputKredit">SETOR TUNAI
                        !</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Kredit  -->

<!-- Modal Debet  -->
<div class="modal fade" tabindex="" role="dialog" id="modalDebet">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_debet">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title font-weight-bolder"> Penarikan Tabungan </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_add_transaction_debet">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-5">
                            <label> Cari Siswa</label>
                            <select class="form-control select2 findNasabahDebet" name="inputCariSiswaDebet"
                                id="findNasabahDebet">
                            </select>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> inputkan
                                nama siswa</span>
                        </div>
                        <div class="form-group col-4">
                            <label> Nominal </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bolder">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg kt_money_input_debet"
                                    name="inputNominalDebetName" id="inputNominalDebet" placeholder="Input Nominal" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> isikan
                                    nominal, pastikan saldo mencukupi</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="inputTahunAjaranDebet" id="inputTahunAjaranDebet"
                                    class="form-control form-control-lg">
                                    <option value="">Pilih TA</option>
                                    <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value_sch) {
        if ($value_sch->tahun_awal == (date("Y"))) {
            ?>
                                    <option value="<?php echo $value_sch->id_tahun_ajaran; ?>" selected>
                                        <?php echo $value_sch->tahun_awal; ?>/<?php echo $value_sch->tahun_akhir; ?>
                                    </option>
                                    <?php } else {
            ?>
                                    <option value="<?php echo $value_sch->id_tahun_ajaran; ?>">
                                        <?php echo $value_sch->tahun_awal; ?>/<?php echo $value_sch->tahun_akhir; ?>
                                    </option>
                                    <?php
}
    }
}
?>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH</b></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Debet U/ tanggal</label>
                                <input type="text" name="inputTanggalKredit" value="<?php echo date('d/m/Y'); ?>"
                                    class="form-control form-control-lg kt_datepicker_kredit" id="inputTanggalDebet"
                                    placeholder="Inputkan Debet Untuk Tanggal" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Tanggal u/
                                    Debet</span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Catatan Debet</label>
                                <textarea class="form-control" id="inputCatatanDebet" placeholder="Isikan Catatan Debet"
                                    name="catatan_debet" rows="2"></textarea>
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>Isikan
                                    Catatan Debet singkat</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>-- INFORMASI --</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            NIS : <label class="font-weight-bold" id="userNisDebet">-</label><br>
                            Nama : <label class="font-weight-bold" id="userNamaDebet">-</label><br>
                            Kelas : <label class="font-weight-bold" id="userKelasDebet">-</label><br>
                        </div>
                        <div class="col-md-6 ">
                            Catatan : <label class="font-weight-bold" id="userCatatanDebet">-</label><br>
                            Transaksi Terakhir : <label class="font-weight-bold timeago"
                                id="infoTerakhirTransaksiDebet">-</label><br>
                            Saldo : <label class="font-weight-bold" id="userJumlahSaldoDebet">-</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-danger font-weight-bolder" id="btnInputDebet">TARIK TUNAI
                        !</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Debet  -->

<!-- Modal Rekap -->
<div class="modal fade" tabindex="" role="dialog" id="modalRekap">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_recap">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title font-weight-bolder"> Lihat Rekap Tabungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" novalidate="novalidate"
                action="<?php echo site_url('finance/savings/get_student_transaction_recap'); ?>"
                enctype="multipart/form-data" method="post" id="kt_add_transaction_recap">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Cari Siswa</label>
                            <select name="nis_siswa" class="form-control select2 findRekapNasabah"
                                id="findRekapNasabah">
                            </select>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> inputkan
                                nama siswa</span>
                        </div>
                        <input type="hidden" name="inputNISRekap" id="inputNISRekap" class="form-control">
                        <div class="col-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>-- INFORMASI --</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            NIS : <label class="font-weight-bold" id="userNisRekap">-</label><br>
                            Nama : <label class="font-weight-bold" id="userNamaRekap">-</label><br>
                            Kelas : <label class="font-weight-bold" id="userKelasRekap">-</label><br>
                        </div>
                        <div class="col-md-6 ">
                            Catatan : <label class="font-weight-bold" id="userCatatanRekap">-</label><br>
                            Transaksi Terakhir : <label class="font-weight-bold timeago"
                                id="infoTerakhirTransaksiRekap">-</label><br>
                            Saldo : <label class="font-weight-bold" id="userJumlahSaldoRekap">-</label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary font-weight-bolder" id="kt_login_signin_submit"> LIHAT DATA
                        !</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Rekap -->
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-transaction.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/transaction_dash.js"></script>

<?php

$arr_kbtk_kre = [];
$arr_sd_kre = [];
$arr_smp_kre = [];
$arr_th_kre = [];

if (!empty($kredit)) {
    foreach ($kredit as $key => $values) {
        $arr_kbtk_kre[] = $values->total_kredit_kbtk;
        $arr_sd_kre[] = $values->total_kredit_sd;
        $arr_smp_kre[] = $values->total_kredit_smp;
        $arr_th_kre[] = $values->tahun;
    }
}
?>
<?php

$arr_kbtk_deb = [];
$arr_sd_deb = [];
$arr_smp_deb = [];
$arr_th_deb = [];

if (!empty($debet)) {
    foreach ($debet as $key => $values) {
        $arr_kbtk_deb[] = $values->total_debet_kbtk;
        $arr_sd_deb[] = $values->total_debet_sd;
        $arr_smp_deb[] = $values->total_debet_smp;
        $arr_th_deb[] = $values->tahun;
    }
}
?>
<?php
$arr_kredit = [];
$arr_debet = [];
$arr_th_deb_kre = [];

if (!empty($kredit_debet)) {
    foreach ($kredit_debet as $key => $values) {
        $arr_kredit[] = $values->total_kredit;
        $arr_debet[] = $values->total_debet;
        $arr_th_deb_kre[] = $values->tahun;
    }
}
?>

<script>
var kbtk_kre = [<?php echo implode(',', $arr_kbtk_kre) ?>];
var sd_kre = [<?php echo implode(',', $arr_sd_kre) ?>];
var smp_kre = [<?php echo implode(',', $arr_smp_kre) ?>];
var th_kre = [<?php echo '"' . implode('","', $arr_th_kre) . '"' ?>];

var kbtk_deb = [<?php echo implode(',', $arr_kbtk_deb) ?>];
var sd_deb = [<?php echo implode(',', $arr_sd_deb) ?>];
var smp_deb = [<?php echo implode(',', $arr_smp_deb) ?>];
var th_deb = [<?php echo '"' . implode('","', $arr_th_deb) . '"' ?>];


var kredit = [<?php echo implode(',', $arr_kredit) ?>];
var debet = [<?php echo implode(',', $arr_debet) ?>];
var th_deb_kre = [<?php echo '"' . implode('","', $arr_th_deb_kre) . '"' ?>];

"use strict";
// Shared Colors Definition
const success = '#1BC5BD';
const info = '#8950FC';
const warning = '#FFA800';
const dark = '#000000';
const danger = '#F64E60';

var KTApexChartsDemo = function() {
    // Private functions

    var _demo1 = function() {
        const apexChart = "#chart_kredit";
        var options = {
            series: [{
                name: 'KBTK',
                data: kbtk_kre
            }, {
                name: 'SD',
                data: sd_kre
            }, {
                name: 'SMP',
                data: smp_kre
            }],
            chart: {
                type: 'bar',
                height: 320
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '70%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: th_kre,
            },
            yaxis: {
                title: {
                    text: 'Total (Rp)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "" + val.toLocaleString("id-ID") + " Rupiah"
                    }
                }
            },
            colors: [success, info, danger]
        };

        var chart = new ApexCharts(document.querySelector(apexChart), options);
        chart.render();
    };

    var _demo2 = function() {
        const apexChart = "#chart_debet";
        var options = {
            series: [{
                name: 'KBTK',
                data: kbtk_deb
            }, {
                name: 'SD',
                data: sd_deb
            }, {
                name: 'SMP',
                data: smp_deb
            }],
            chart: {
                type: 'bar',
                height: 320
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '70%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: th_deb,
            },
            yaxis: {
                title: {
                    text: 'Total (Rp)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "" + val.toLocaleString("id-ID") + " Rupiah"
                    }
                }
            },
            colors: [success, info, danger]
        };

        var chart = new ApexCharts(document.querySelector(apexChart), options);
        chart.render();
    };

    var _demo3 = function() {
        const apexChart = "#chart_kredit_debet";
        var options = {
            series: [{
                name: 'KREDIT',
                data: kredit
            }, {
                name: 'DEBET',
                data: debet
            }],
            chart: {
                type: 'bar',
                height: 334
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '70%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: th_deb_kre,
            },
            yaxis: {
                title: {
                    text: 'Total (Rp)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "" + val.toLocaleString("id-ID") + " Rupiah"
                    }
                }
            },
            colors: [dark, warning]
        };

        var chart = new ApexCharts(document.querySelector(apexChart), options);
        chart.render();
    };

    return {
        // public functions
        init: function() {

            _demo1();
            _demo2();
            _demo3();
        }
    };
}();

jQuery(document).ready(function() {
    KTApexChartsDemo.init();
});
</script>
