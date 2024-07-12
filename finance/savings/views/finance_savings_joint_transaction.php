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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Transaksi</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Daftar Transaksi Tabungan Bersama</a>
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
            <!--begin::Notice-->
            <?php echo $this->session->flashdata('flash_message'); ?>
            <!--end::Notice-->
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Entry-->
                    <div class="px-mobile">
                        <div class="alert alert-custom alert-light-warning alert-shadow fade show" role="alert">
                            <div class="alert-icon">
                                <span class="svg-icon svg-icon-dark svg-icon-4x">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Thunder-move.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z"
                                                fill="#000000" opacity="0.3" />
                                            <rect fill="#000000" x="11" y="9" width="2" height="7" rx="1" />
                                            <rect fill="#000000" x="11" y="17" width="2" height="2" rx="1" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <div class="alert-text text-dark font-weight-bold">MOHON UNTUK DIPERHATIKAN!!.<br> Silahkan
                                Melakukan Pengecekan Kembali Untuk Transaksi KREDIT/DEBET & Untuk Fitur Edit/Delete
                                Transaksi Hanya Berlaku Untuk Transaksi Terakhir, Terima Kasih !</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-layers-1 text-primary"></i>
                                </span>
                                <h3 class="card-label">Transaksi Tabungan Bersama</h3>
                            </div>
                            <div class="card-toolbar">
                                <div class="buttons">
                                    <button class="btn btn-success mr-2" data-toggle="modal" data-target="#modalKredit"
                                        id="btnKredit">
                                        <i class="fa fa-plus"></i> Setor Tunai
                                    </button>
                                    <button class="btn btn-danger mr-2" data-toggle="modal" data-target="#modalDebet"
                                        id="btnDebet">
                                        <i class="fa fa-minus"></i> Tarik Tunai
                                    </button>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalRekap"
                                        id="btnRekap">
                                        <i class="fa fa-suitcase"></i> Rekap
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="paper">
                            <div class="card-body">
                                <!--begin: Search Form-->

                                <div class="row mb-4">
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Nomor Transaksi:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nomor Transaksi" data-col-index="1" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Nomor Rekening:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nomor Rekening" data-col-index="2" />
                                    </div>
                                    <div class="col-lg-4 mb-lg-0 mb-6">
                                        <label>Nama Tabungan Bersama:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nama Tabungan Bersama" data-col-index="3" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Tahun Ajaran:</label>
                                        <select class="form-control datatable-input" data-col-index="5">
                                            <option value="">Pilih Tahun Ajaran</option>
                                            <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value) {
        ?>
                                            <option
                                                value="<?php echo $value->tahun_awal . "/" . $value->tahun_akhir; ?>">
                                                <?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?>
                                            </option>
                                            <?php
} //ngatur nomor urut
}
?>
                                            <option value="">SEMUA</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6 ">
                                        <label>Tingkat</label>
                                        <select name="input_tingkat" class="form-control datatable-input"
                                            data-col-index="6">
                                            <option value="">Pilih Tingkat</option>
                                            <option value="DC">DC</option>
                                            <option value="KB">KB</option>
                                            <option value="TK">TK</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="">SEMUA</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6 mt-6">
                                        <label>Jenis Transaksi:</label>
                                        <select class="form-control datatable-input" data-col-index="7">
                                            <option value="">Pilih Transaksi</option>
                                            <option value="DEBET">Debet</option>
                                            <option value="KREDIT">Kredit</option>
                                            <option value="">SEMUA</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6 mt-6">
                                        <label>Tanggal Transaksi:</label>
                                        <input type="text" class="form-control datatable-input"
                                            id="kt_datepicker_transaction" placeholder="Input Tanggal"
                                            data-col-index="8" />
                                    </div>
                                </div>
                                <div class="row mt-8">
                                    <div class="row col-lg-7">
                                        <div class="col-lg-12 mb-lg-0 mb-6">
                                            <button class="btn btn-primary btn-primary--icon" id="kt_search">
                                                <span>
                                                    <i class="la la-search"></i>
                                                    <span>Cari</span>
                                                </span>
                                            </button>&#160;&#160;
                                            <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                                                <span>
                                                    <i class="la la-close"></i>
                                                    <span>Reset</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row col-lg-5">
                                        <div class="col-lg-4 mb-lg-0 mb-6 text-right">
                                            <span class="font-weight-bolder">Tampilkan Dari Tanggal</span>
                                        </div>
                                        <div class="col-lg-6 mb-lg-0 mb-6">
                                            <div class="input-group" id="kt_daterangepicker_6">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="la la-calendar-check-o"></i></span>
                                                </div>
                                                <input type="text" class="form-control font-weight-bolder" readonly=""
                                                    placeholder="Select date range">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-lg-0 mb-6">
                                            <div class="btn-group">
                                                <button class="btn btn-warning font-weight-bold dropdown-toggle"
                                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="true">
                                                    <i class="flaticon2-download"></i>
                                                    Export
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button id="btn_excel" class="dropdown-item" role="button"
                                                        type="submit"><i class="flaticon2-checking"></i> Laporan
                                                        .csv</button>

                                                    <button id="btn_pdf" class="dropdown-item" role="button"
                                                        type="submit"><i class="flaticon-doc"></i> Laporan
                                                        .pdf</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--begin: Datatable-->
                            </div>
                            <div class="table-responsive">
                                <table class="table table-separate table-hover table-light-primary table-checkable"
                                    id="table_transcation">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>Nomor Transaksi</th>
                                            <th>Nomor Rekening</th>
                                            <th>Nama Tabungan Bersama</th>
                                            <th>Waktu Transaksi</th>
                                            <th>TA</th>
                                            <th>Tingkat</th>
                                            <th>Jenis Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Kredit (Rp)</th>
                                            <th>Debet (Rp)</th>
                                            <th>Saldo (Rp)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tb_transaksi">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="font-weight-bolder">TOTAL TRANSAKSI</th>
                                            <th class="font-weight-bolder text-success">-</th>
                                            <th class="font-weight-bolder text-danger">-</th>
                                            <th class="font-weight-bolder"></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
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
                <h5 class="modal-title font-weight-bolder"> Setor Tabungan Bersama </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_add_transaction_credit">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-5">
                            <label> Input Nomor Rekening Tabungan</label>
                            <select class="form-control select2 findTabunganKredit" name="inputCariTabunganKredit"
                                id="findTabunganKredit" required>
                            </select>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Inputkan
                                Nomor Rekening Tabungan Bersama</span>
                        </div>
                        <div class="form-group col-4">
                            <label> Nominal </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bolder">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg" name="inputNominalKredit"
                                    id="inputNominalKredit" placeholder="Input nominal" />
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
                                    <?php
} else {
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
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Kredit U/ tanggal</label>
                                <input type="text" name="inputTanggalKredit" value="<?php echo date('d/m/Y'); ?>"
                                    class="form-control form-control-lg kt_datepicker_kredit" id="inputTanggalKredit"
                                    placeholder="Inputkan Kredit Untuk Tanggal" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Tanggal u/
                                    Kredit</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="input_tingkat_kredit" class="form-control form-control-lg"
                                    id="inputTingkatKredit">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="6">DC</option>
                                    <option value="1">KB</option>
                                    <option value="2">TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Tingkat</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Catatan Kredit</label>
                                <textarea class="form-control" id="inputCatatanKredit"
                                    placeholder="Isikan Catatan Kredit" name="inputCatatanKredit" rows="2"></textarea>
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
                            Nama Tabungan : <label class="font-weight-bold" id="userNorekKredit">-</label><br>
                            PJ: <label class="font-weight-bold" id="userPenanggungJawabKredit">-</label><br>
                            Tingkat : <label class="font-weight-bold" id="userTingkatKredit">-</label><br>
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
                    <button type="submit" class="btn btn-success font-weight-bolder" id="btnInputKredit"
                        disabled="disabled">SETOR TUNAI
                        !</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Kredit  -->

<!-- Modal Edit Kredit  -->
<div class="modal fade" tabindex="" role="dialog" id="modalEditKreditTransaksi">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_credit_edit">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title font-weight-bolder">Edit Setoran Tabungan Bersama <b
                        id="nomorTransaksiKreditEdit"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_add_transaction_credit_edit">
                <div class="modal-body">
                    <input type="hidden" class="hidden" name="id_transaksi_kredit_edit">
                    <div class="row">
                        <div class="form-group col-5">
                            <label>Nomor & Nama Tabungan Bersama</label>
                            <select class="form-control select2 findTabunganKreditEdit"
                                name="nomor_rekening_kredit_edit" disabled>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label> Nominal </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bolder">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg" name="nominal_kredit_edit"
                                    placeholder="Input nominal" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> isikan
                                    nominal</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="th_ajaran_kredit_edit" class="form-control form-control-lg">
                                    <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value_sch) {
        ?>
                                    <option value="<?php echo $value_sch->id_tahun_ajaran; ?>">
                                        <?php echo $value_sch->tahun_awal; ?>/<?php echo $value_sch->tahun_akhir; ?>
                                    </option>
                                    <?php
}
}
?>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH</b></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Kredit U/ tanggal</label>
                                <input type="text" name="waktu_transaksi_kredit_edit" value=""
                                    class="form-control form-control-lg kt_datepicker_kredit_edit"
                                    placeholder="Inputkan Kredit Untuk Tanggal" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Tanggal u/
                                    Kredit</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="tingkat_kredit_edit" class="form-control form-control-lg"
                                    id="input_tingkat">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="6">DC</option>
                                    <option value="1">KB</option>
                                    <option value="2">TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Tingkat</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Catatan Kredit</label>
                                <textarea class="form-control" placeholder="Isikan Catatan Kredit"
                                    name="catatan_kredit_edit" value="" rows="2"></textarea>
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
                            No. Rekening : <label class="font-weight-bold" id="userNorekKreditEdit">-</label><br>
                            PJ: <label class="font-weight-bold" id="userPenanggungJawabKreditEdit">-</label><br>
                            Tingkat: <label class="font-weight-bold" id="userTingkatKreditEdit">-</label>
                        </div>
                        <div class="col-md-6 ">
                            Transaksi Terakhir : <label class="font-weight-bold"
                                id="infoTerakhirTransaksiKreditEdit">-</label><br>
                            Saldo Awal : <label class="font-weight-bold" id="userJumlahSaldoKreditEdit">-</label> ||
                            Saldo Sekarang : <label class="font-weight-bold" id="userJumlahSaldoKreditEditNow">-</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success font-weight-bolder" id="btnUpdateKredit"
                        disabled="disabled">Simpan
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
                <h5 class="modal-title font-weight-bolder"> Penarikan Tabungan Bersama</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_add_transaction_debet">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-5">
                            <label> Input Nomor Rekening Tabungan</label>
                            <select class="form-control select2 findTabunganDebet" name="inputCariTabunganDebet"
                                id="findTabunganDebet">
                            </select>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Inputkan
                                Nomor Rekening Tabungan Bersama</span>
                        </div>
                        <div class="form-group col-4">
                            <label> Nominal </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bolder">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg" name="inputNominalDebet"
                                    id="inputNominalDebet" placeholder="Input Nominal" />
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
                                    <?php
} else {
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
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Debet U/ tanggal</label>
                                <input type="text" name="inputTanggalKredit" value="<?php echo date('d/m/Y'); ?>"
                                    class="form-control form-control-lg kt_datepicker_kredit" id="inputTanggalDebet"
                                    placeholder="Inputkan Debet Untuk Tanggal" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Tanggal u/
                                    Debet</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="input_tingkat_debet" class="form-control form-control-lg"
                                    id="inputTingkatDebet">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="6">DC</option>
                                    <option value="1">KB</option>
                                    <option value="2">TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Tingkat</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
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
                            Nama Tabungan : <label class="font-weight-bold" id="userNorekDebet">-</label><br>
                            PJ: <label class="font-weight-bold" id="userPenanggungJawabDebet">-</label><br>
                            Tingkat : <label class="font-weight-bold" id="userTingkatDebet">-</label><br>
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
                    <button type="submit" class="btn btn-danger font-weight-bolder" id="btnInputDebet"
                        disabled="disabled">TARIK TUNAI
                        !</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Debet  -->

<!-- Modal Debet  -->
<div class="modal fade" tabindex="" role="dialog" id="modalEditDebetTransaksi">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_debet_edit">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title font-weight-bolder">Edit Penarikan Tabungan Bersama <b
                        id="nomorTransaksiDebetEdit"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_add_transaction_debet_edit">
                <div class="modal-body">
                    <input type="hidden" class="hidden" name="id_transaksi_debet_edit">
                    <div class="row">
                        <div class="form-group col-5">
                            <label>Nomor & Nama Tabungan Bersama</label>
                            <select class="form-control select2 findTabunganDebetEdit" name="nomor_rekening_debet_edit"
                                disabled>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label> Nominal </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bolder">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg" name="nominal_debet_edit"
                                    placeholder="Input Nominal" value="" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> isikan
                                    nominal, pastikan saldo mencukupi</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="th_ajaran_debet_edit" class="form-control form-control-lg">
                                    <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value_sch) {

        ?>
                                    <option value="<?php echo $value_sch->id_tahun_ajaran; ?>">
                                        <?php echo $value_sch->tahun_awal; ?>/<?php echo $value_sch->tahun_akhir; ?>
                                    </option>
                                    <?php
}
}
?>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH</b></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Debet U/ tanggal</label>
                                <input type="text" name="waktu_transaksi_debet_edit" value=""
                                    class="form-control form-control-lg kt_datepicker_debet_edit"
                                    placeholder="Inputkan Debet Untuk Tanggal" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Tanggal u/
                                    Debet</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="tingkat_debet_edit" class="form-control form-control-lg"
                                    id="inputTingkatDebet">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="6">DC</option>
                                    <option value="1">KB</option>
                                    <option value="2">TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Tingkat</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Catatan Debet</label>
                                <textarea class="form-control" placeholder="Isikan Catatan Debet"
                                    name="catatan_debet_edit" rows="2"></textarea>
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
                            No. Rekening : <label class="font-weight-bold" id="userNorekDebetEdit">-</label><br>
                            PJ: <label class="font-weight-bold" id="userPenanggungJawabDebetEdit">-</label><br>
                            Tingkat: <label class="font-weight-bold" id="userTingkatDebetEdit">-</label>
                        </div>
                        <div class="col-md-6 ">
                            Transaksi Terakhir : <label class="font-weight-bold"
                                id="infoTerakhirTransaksiDebetEdit">-</label><br>
                            Saldo Awal : <label class="font-weight-bold" id="userJumlahSaldoDebetEdit">-</label> ||
                            Saldo Sekarang : <label class="font-weight-bold" id="userJumlahSaldoDebetEditNow">-</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger font-weight-bolder" id="btnUpdateDebet"
                        disabled="disabled">Simpan
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
                action="<?php echo site_url('finance/savings/get_joint_transaction_recap'); ?>"
                enctype="multipart/form-data" method="post" id="kt_add_transaction_recap">
                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Inputkan Nomor Rekening Tabungan</label>
                            <select name="nomor_rekening_bersama" class="form-control select2 findTabunganRekap"
                                id="findTabunganRekap">
                            </select>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Inputkan
                                Nomor Rekening Tabungan</span>
                        </div>
                        <input type="hidden" name="inputNISRekap" id="inputNISRekap" class="form-control">
                        <div class="col-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>-- INFORMASI --</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            Nama Tabungan : <label class="font-weight-bold" id="userNorekRekap">-</label><br>
                            PJ: <label class="font-weight-bold" id="userPenanggungJawabRekap">-</label><br>
                            Tingkat : <label class="font-weight-bold" id="userTingkatRekap">-</label><br>
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
<script>
<?php if ($user[0]->id_role_struktur == 5) {?>
var id_role = 5;
<?php } else {?>
var id_role = 7;
<?php }?>
</script>

<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/transaction-joint.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-transaction-joint.js">
</script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/edit-transaction-joint.js">
</script>
