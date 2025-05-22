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
                            <a href="" class="text-muted">Daftar Transaksi Tabungan THT</a>
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
                        <div class="alert alert-custom alert-light-primary shadow-sm alert-shadow fade show"
                            role="alert">
                            <div class="alert-text font-weight-bolder text-center text-dark">
                                <h1 class="font-weight-boldest text-danger">
                                    <li class="fas fa-exclamation-triangle"></li> TABUNGAN THT PEGAWAI <li
                                        class="fas fa-exclamation-triangle">
                                </h1>
                                MOHON UNTUK DIPERHATIKAN!!.<br> Silahkan
                                Melakukan Pengecekan Kembali Untuk Transaksi KREDIT/DEBET & Untuk Fitur Edit/Delete
                                Transaksi Hanya Berlaku Untuk Transaksi Terakhir, Terima Kasih !
                            </div>
                        </div>
                    </div>
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-layers-1 text-primary"></i>
                                </span>
                                <h3 class="card-label">Transaksi Tabungan THT</h3>
                            </div>
                            <div class="card-toolbar">
                                <div class=" text-right mt-5 mr-5 font-weight-bolder">
                                    Status Printer: <p class="text-right" id="error_print_connection">
                                    </p>
                                </div>
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
                                <div class="row mb-6">
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Nomor Transaksi:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nomor Transaksi" data-col-index="1" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>NIP Pegawai:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan NIP Pegawai" data-col-index="2" />
                                    </div>
                                    <div class="col-lg-4 mb-lg-0 mb-6">
                                        <label>Nama Pegawai:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nama Pegawai" data-col-index="3" />
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
                                                value="<?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?>">
                                                <?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?>
                                            </option>
                                            <?php
} //ngatur nomor urut
}
?>
                                            <option value="">SEMUA</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
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
                                            <!-- <option value="5">SMA</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Jenis Transaksi:</label>
                                        <select class="form-control datatable-input" data-col-index="7">
                                            <option value="">Pilih Transaksi</option>
                                            <option value="DEBET">Debet</option>
                                            <option value="KREDIT">Kredit</option>
                                            <option value="">SEMUA</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-2 mb-lg-0 mb-6">
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
                                            <span class="font-weight-bolder">Tampilkan Dari Waktu Transaksi</span>
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
                                            <th>No. Transaksi</th>
                                            <th>NIP</th>
                                            <th>Nama Pegawai</th>
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
                                            <th></th>
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
<div class="modal fade" tabindex="" role="dialog" id="modalKredit">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_credit">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title font-weight-bolder"> Setor Tabungan THT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_add_transaction_credit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Input NIP Pegawai</label>
                                <select class="form-control select2 findNasabahKredit" name="inputCariPegawaiKredit"
                                    id="findNasabahKredit" required>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> inputkan
                                    NIP Pegawai</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Nominal </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-weight-bolder">
                                            Rp
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg"
                                        name="inputNominalKreditName" id="inputNominalKredit"
                                        placeholder="Input nominal" />
                                </div>
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
                                <label>Jenis Tabungan </label>
                                <select name="inputJenisTabungan" class="form-control form-control-lg"
                                    id="inputJenisTabungan" disabled>
                                    <option value="3" selected>THT</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Jenis Tabungan</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="inputTingkatKredit" class="form-control form-control-lg"
                                    id="inputTingkatKredit">
                                    <option value="">Pilih Tingkat</option>
									<option value="1">DC/KB/TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                    <option value="6">UMUM</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Tingkat</span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Catatan Kredit</label>
                                <textarea class="form-control" id="inputCatatanKredit"
                                    placeholder="Isikan Catatan Kredit" name="uraian" rows="2"></textarea>
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>Isikan
                                    Catatan Kredit singkat</span>
                            </div>
                        </div>
                        <div class="col-xl-3"></div>
                        <div class="col-xl-6 text-center">
                            <div class="form-group">
                                <label>PIN Anda</label>
                                <input type="hidden" class="hidden" name="pin_verification_kredit">
                                <div class="row col-12 d-flex justify-content-center" id="otp_kredit">
                                    <input
                                        class="col-2 ml-8 mr-2 text-center form-control form-control-lg form-control-solid font-weight-bolder"
                                        name="input_one" type="text" id="first" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_two" type="text" id="second" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg  form-control-solid font-weight-bolder"
                                        name="input_three" type="text" id="third" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_four" type="text" id="fourth" maxlength="1" />
                                    <input
                                        class="col-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_five" type="text" id="fifth" maxlength="1" />
                                </div>
                                <span class="form-text text-dark mt-2"><b class="text-danger">*WAJIB DIISI, </b>Inputkan
                                    PIN Anda</span>
                            </div>
                        </div>
                        <div class="col-xl-3"></div>
                        <div id="add_new_nasabah" style="display:none;">
                            <div class="col-12 ">
                                <div class="alert alert-success text-center" role="alert">
                                    <b>-- ISI DATA NASABAH BARU --</b>
                                </div>
                            </div>

                            <div class="col-12 mt-5">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label> Nama Lengkap Nasabah Pegawai</label>
                                        <input type="text" name="nama_nasabah" id="nama_nasabah"
                                            class="form-control form-control-lg"
                                            placeholder="Inputkan Nama Nasabah/Pegawai" />
                                        <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b>
                                            Masukan
                                            nama
                                            lengkap Nasabah/Pegawai
                                        </span>

                                    </div>
                                    <div class="form-group col-3">
                                            <label> Status Pegawai </label>
                                              <select name="status_pegawai" id="status_pegawai"
                                                class="form-control form-control-lg status_pegawai">
                                                <option value="">Pilih Status</option>
                                                <option value="1">Tetap</option>
                                                <option value="2">Tidak Tetap</option>
                                                <option value="3">Honorer</option>
												<option value="4">Keluar</option>
                                            </select>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                                    DIPILIH, </b>pilih Status Pegawai</span>
                                    </div>
									<div class="form-group col-3">
                                        <label> Jenis Kelamin </label>
                                        <select name="jenis_kelamin" id="jenis_kelamin"
                                            class="form-control form-control-lg">
                                            <option value="">Pilih JK</option>
                                            <option value="1">Laki-laki</option>
                                            <option value="2">Perempuan</option>
                                        </select>
                                        <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                                DIPILIH, </b>pilih Status Pegawai</span>
                                    </div>
                                    <div class="form-group col-4">
                                        <label> Jabatan Pegawai </label>
                                        <select name="jabatan" id="jabatan"
                                            class="form-control form-control-lg jabatan">
                                            <option value="">Pilih Jabatan Pegawai</option>
                                        </select>
                                        <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                                DIPILIH, </b>pilih Jabatan Pegawai</span>
                                    </div>
                                    <div class="form-group col-4">
                                        <label> Nomor HP Aktif </label>
                                        <input type="number" class="form-control form-control-lg" name="nomor_hp_aktif"
                                            id="nomor_hp_aktif" placeholder="Input Nomor HP Aktif" />
                                        <span class="form-text text-dark"><b class="">*TIDAK WAJIB DIISI,</b>
                                            isikan
                                            Nomor Handphone</span>
                                    </div>
                                    <div class="form-group col-4">
                                        <label> Email Pegawai </label>
                                        <input type="text" class="form-control form-control-lg" name="email_pegawai"  id="email_pegawai"
                                            name="email_pegawai" placeholder="Input Email Pegawai" />
                                        <span class="form-text text-dark"><b class="">*TIDAK WAJIB DIISI,</b> Email
                                           Pegawai
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="info_nasabah" class="col-12" style="display:none;">

                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-secondary text-center" role="alert">
                                        <b>-- INFORMASI --</b>
                                    </div>
                                </div>
                                <div class=" col-md-6">
                                    NIP : <label class="font-weight-bold" id="userNipKredit">-</label><br>
                                    Nama : <label class="font-weight-bold" id="userNamaKredit">-</label><br>
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
                <h5 class="modal-title font-weight-bolder">Edit Setor Tabungan THT <b
                        id="nomorTransaksiKreditEdit"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_add_transaction_credit_edit">
                <div class="modal-body">
                    <input type="hidden" class="hidden" name="id_transaksi_kredit">
                    <div class="row">
                        <div class="form-group col-6">
                            <label> Nama & NIP Pegawai</label>
                            <select class="form-control select2 findNasabahKreditEdit" name="nip_kredit" disabled>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label> Nominal </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bolder">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg" name="nominal_kredit"
                                    placeholder="Input nominal" />
                            </div>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> isikan
                                nominal</span>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="th_ajaran_kredit" class="form-control form-control-lg">
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
                                <input type="text" name="waktu_transaksi_kredit" value=""
                                    class="form-control form-control-lg kt_datepicker_kredit_edit"
                                    placeholder="Inputkan Kredit Untuk Tanggal" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Tanggal u/
                                    Kredit</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Jenis Tabungan </label>
                                <select name="jenis_tabungan_kredit" class="form-control form-control-lg" disabled>
                                    <option value="3" selected>THT</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Jenis Tabungan</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="tingkat_kredit" class="form-control form-control-lg">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="1">DC/KB/TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                    <option value="6">UMUM</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Tingkat</span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Catatan Kredit</label>
                                <textarea class="form-control" placeholder="Isikan Catatan Kredit" name="catatan_kredit"
                                    value="" rows="2"></textarea>
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>Isikan
                                    Catatan Kredit singkat</span>
                            </div>
                        </div>
                        <div class="col-xl-3"></div>
                        <div class="col-xl-6 text-center">
                            <div class="form-group">
                                <label>PIN Anda</label>
                                <input type="hidden" class="hidden" name="pin_verification_kredit_edit">
                                <div class="row col-12 d-flex justify-content-center" id="otp_kredit_edit">
                                    <input
                                        class="col-2 ml-8 mr-2 text-center form-control form-control-lg form-control-solid font-weight-bolder"
                                        name="input_one" type="text" id="first" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_two" type="text" id="second" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg  form-control-solid font-weight-bolder"
                                        name="input_three" type="text" id="third" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_four" type="text" id="fourth" maxlength="1" />
                                    <input
                                        class="col-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_five" type="text" id="fifth" maxlength="1" />
                                </div>
                                <span class="form-text text-dark mt-2"><b class="text-danger">*WAJIB DIISI, </b>Inputkan
                                    PIN Anda</span>
                            </div>
                        </div>
                        <div class="col-xl-3"></div>
                        <div class="col-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>-- INFORMASI --</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            NIP : <label class="font-weight-bold" id="userNipKreditEdit">-</label><br>
                            Nama : <label class="font-weight-bold" id="userNamaKreditEdit">-</label><br>
                            Tingkat : <label class="font-weight-bold" id="userTingkatKreditEdit">-</label><br>
                        </div>
                        <div class="col-md-6 ">
                            Transaksi Terakhir : <label class="font-weight-bold timeago"
                                id="infoTerakhirTransaksKreditEdit">-</label><br>
                            Saldo Awal : <label class="font-weight-bold" id="userJumlahSaldoKreditEdit">-</label> ||
                            Saldo Sekarang : <label class="font-weight-bold" id="userJumlahSaldoKreditEditNow">-</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success font-weight-bolder" id="btnUpdateKredit">Simpan
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
                <h5 class="modal-title font-weight-bolder"> Penarikan Tabungan THT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_add_transaction_debet">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label> Input NIP Pegawai</label>
                            <select class="form-control select2 findNasabahDebet" name="inputCariPegawaiDebet"
                                id="findNasabahDebet">
                            </select>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> inputkan
                                NIP Pegawai</span>
                        </div>
                        <div class="form-group col-6">
                            <label> Nominal </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bolder">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg" name="inputNominalDebetName"
                                    id="inputNominalDebet" placeholder="Input Nominal" />
                            </div>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> isikan
                                nominal, pastikan saldo mencukupi</span>
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
                                <label>Jenis Tabungan </label>
                                <select name="inputJenisTabungan" class="form-control form-control-lg"
                                    id="inputJenisTabungan" disabled>
                                    <option value="3" selected>THT</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Jenis Tabungan</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="inputTingkatDebet" class="form-control form-control-lg"
                                    id="inputTingkatDebet">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="1">DC/KB/TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                    <option value="6">UMUM</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Tingkat</span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Catatan Debet</label>
                                <textarea class="form-control" id="inputCatatanDebet" placeholder="Isikan Catatan Debet"
                                    name="catatan_debet" rows="2"></textarea>
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>Isikan
                                    Catatan Debet singkat</span>
                            </div>
                        </div>
                        <div class="col-xl-3"></div>
                        <div class="col-xl-6 text-center">
                            <div class="form-group">
                                <label>PIN Anda</label>
                                <input type="hidden" class="hidden" name="pin_verification_debet">
                                <div class="row col-12 d-flex justify-content-center" id="otp_debet">
                                    <input
                                        class="col-2 ml-8 mr-2 text-center form-control form-control-lg form-control-solid font-weight-bolder"
                                        name="input_one" type="text" id="first" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_two" type="text" id="second" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg  form-control-solid font-weight-bolder"
                                        name="input_three" type="text" id="third" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_four" type="text" id="fourth" maxlength="1" />
                                    <input
                                        class="col-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_five" type="text" id="fifth" maxlength="1" />
                                </div>
                                <span class="form-text text-dark mt-2"><b class="text-danger">*WAJIB DIISI, </b>Inputkan
                                    PIN Anda</span>
                            </div>
                        </div>
                        <div class="col-xl-3"></div>
                        <div class="col-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>-- INFORMASI --</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            NIP : <label class="font-weight-bold" id="userNipDebet">-</label><br>
                            Nama : <label class="font-weight-bold" id="userNamaDebet">-</label><br>
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
                <h5 class="modal-title font-weight-bolder">Edit Penarikan Tabungan THT <b
                        id="nomorTransaksiDebetEdit"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_add_transaction_debet_edit">
                <div class="modal-body">
                    <input type="hidden" class="hidden" name="id_transaksi_debet">
                    <div class="row">
                        <div class="form-group col-6">
                            <label> Nama & NIP Pegawai</label>
                            <select class="form-control select2 findNasabahDebetEdit" name="nip_debet" disabled>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label> Nominal </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bolder">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg" name="nominal_debet"
                                    placeholder="Input Nominal" value="" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> isikan
                                    nominal, pastikan saldo mencukupi</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="th_ajaran_debet" class="form-control form-control-lg">
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
                                <input type="text" name="waktu_transaksi_debet" value=""
                                    class="form-control form-control-lg kt_datepicker_debet_edit"
                                    placeholder="Inputkan Debet Untuk Tanggal" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Tanggal u/
                                    Debet</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Jenis Tabungan </label>
                                <select name="jenis_tabungan_debet" class="form-control form-control-lg" disabled>
                                    <option value="3" selected>THT</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Jenis Tabungan</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="tingkat_debet" class="form-control form-control-lg">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="1">DC/KB/TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                    <option value="6">UMUM</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH,</b> Pilih Tingkat</span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Catatan Debet</label>
                                <textarea class="form-control" placeholder="Isikan Catatan Debet" name="catatan_debet"
                                    rows="2"></textarea>
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>Isikan
                                    Catatan Debet singkat</span>
                            </div>
                        </div>
                        <div class="col-xl-3"></div>
                        <div class="col-xl-6 text-center">
                            <div class="form-group">
                                <label>PIN Anda</label>
                                <input type="hidden" class="hidden" name="pin_verification_debet_edit">
                                <div class="row col-12 d-flex justify-content-center" id="otp_debet_edit">
                                    <input
                                        class="col-2 ml-8 mr-2 text-center form-control form-control-lg form-control-solid font-weight-bolder"
                                        name="input_one" type="text" id="first" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_two" type="text" id="second" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg  form-control-solid font-weight-bolder"
                                        name="input_three" type="text" id="third" maxlength="1" />
                                    <input
                                        class="col-2 mr-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_four" type="text" id="fourth" maxlength="1" />
                                    <input
                                        class="col-2 text-center form-control  form-control-lg form-control-solid font-weight-bolder"
                                        name="input_five" type="text" id="fifth" maxlength="1" />
                                </div>
                                <span class="form-text text-dark mt-2"><b class="text-danger">*WAJIB DIISI, </b>Inputkan
                                    PIN Anda</span>
                            </div>
                        </div>
                        <div class="col-xl-3"></div>
                        <div class="col-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>-- INFORMASI --</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            NIP : <label class="font-weight-bold" id="userNipDebetEdit">-</label><br>
                            Nama : <label class="font-weight-bold" id="userNamaDebetEdit">-</label><br>
                            Tingkat : <label class="font-weight-bold" id="userTingkatDebetEdit">-</label><br>
                        </div>
                        <div class="col-md-6 ">
                            Transaksi Terakhir : <label class="font-weight-bold timeago"
                                id="infoTerakhirTransaksiDebetEdit">-</label><br>
                            Saldo Awal : <label class="font-weight-bold" id="userJumlahSaldoDebetEdit">-</label> ||
                            Saldo Sekarang : <label class="font-weight-bold" id="userJumlahSaldoDebetEditNow">-</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger font-weight-bolder" id="btnUpdateDebet">Simpan
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
                action="<?php echo site_url('finance/savings/get_employee_transaction_recap'); ?>"
                enctype="multipart/form-data" method="post" id="kt_add_transaction_recap">
				<input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
				value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Input NIP Pegawai</label>
                            <select name="nip_pegawai" class="form-control select2 findRekapNasabah"
                                id="findRekapNasabah">
                            </select>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> inputkan
                                NIP Pegawai</span>
                        </div>
                        <input type="hidden" name="inputNIPRekap" id="inputNIPRekap" class="form-control">
                        <div class="col-4">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>INFO TABUNGAN UMUM</b>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>INFO TABUNGAN QURBAN</b>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>INFO TABUNGAN THT</b>
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            Catatan: <label class="font-weight-bold" id="userCatatanRekap">-</label><br>
                            Transaksi Terakhir: <label class="font-weight-bold timeago"
                                id="infoTerakhirTransaksiRekap">-</label><br>
                            Saldo: <label class="font-weight-bold" id="userJumlahSaldoRekap">-</label>
                        </div>

                        <div class="col-md-4 ">
                            Catatan: <label class="font-weight-bold" id="userCatatanRekapQurban">-</label><br>
                            Transaksi Terakhir: <label class="font-weight-bold timeago"
                                id="infoTerakhirTransaksiRekapQurban">-</label><br>
                            Saldo: <label class="font-weight-bold" id="userJumlahSaldoRekapQurban">-</label>
                        </div>

                        <div class="col-md-4 ">
                            Catatan: <label class="font-weight-bold" id="userCatatanRekapTHT">-</label><br>
                            Terakhir Terakhir: <label class="font-weight-bold timeago"
                                id="infoTerakhirTransaksiRekapTHT">-</label><br>
                            Saldo: <label class="font-weight-bold" id="userJumlahSaldoRekapTHT">-</label>
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
var stat_close = true;

<?php if ($user[0]->id_role_struktur == 5 || $user[0]->id_role_struktur == 10) {?>
var id_role = 5;
<?php } else {?>
var id_role = 7;
<?php }?>
</script>

<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/config.pin.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/transaction-tht-employee.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-transaction-employee.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/edit-transaction-employee.js"></script>
<script>
    $(document).ready(function () {
        var id_pos;
        $("#inputTingkatKredit").change(function () {
            id_pos = $(this).val();
            var url = "<?php echo site_url('finance/savings/add_ajax_position'); ?>/" + id_pos;
            $('#jabatan').load(url);
            return false;
        });
    });
</script>
