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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Pinjaman Piutang</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Daftar Pinjaman Nasabah</a>
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
                        <div class="alert alert-custom alert-light-default shadow-sm alert-shadow fade show"
                            role="alert">
                            <div class="alert-text font-weight-bolder text-center text-dark">
                                <h1 class="font-weight-boldest text-danger">
                                    <li class="fas fa-exclamation-triangle"></li> DAFTAR AKUMULASI PINJAMAN PER PEGAWAI <li
                                        class="fas fa-exclamation-triangle"></li>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-layers-1 text-primary"></i>
                                </span>
                                <h3 class="card-label">Daftar Pinjaman Pegawai</h3>
                                <a href="#" data-toggle="modal" data-target="#modal_import_nasabah"
                                    class="btn btn-warning btn-md">
                                    <i class="flaticon-upload"></i>Import Pinjaman Pegawai
                                </a>
                            </div>

                            <div class="card-toolbar">
                                <div class="buttons">
                                    <a href="<?php echo site_url("/finance/savings/add_personal_saving") ?>"
                                        class="btn btn-success mr-2">
                                        <i class="fa fa-plus"></i> Tambah Debitur Baru
                                    </a>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalRekap"
                                        id="btnRekap">
                                        <i class="fa fa-suitcase"></i> Lihat Rekap Debitur
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="paper">
                            <div class="card-body">
                                <!--begin: Search Form-->
                                <div class="row mb-4">
                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>NIP:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan NIP" data-col-index="1" />
                                    </div>
                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>Nama Pegawai:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nama Pegawai" data-col-index="2" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Jenis Kelamin</label>
                                        <select type="text" class="form-control datatable-input" data-col-index="4">
                                            <option value="">Pilih JK</option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                            <option value="">SEMUA</option>
                                            <!-- <option value="5">SMA</option> -->
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Tingkat</label>
                                        <select class="form-control datatable-input" data-col-index="5">
                                            <option value="">Pilih Tingkat</option>
                                            <option value="DC/KB/TK">DC/KB/TK</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="UMUM">UMUM</option>
                                            <option value="">SEMUA</option>
                                            <!-- <option value="5">SMA</option> -->
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Tahun Ajaran:</label>
                                        <select class="form-control datatable-input" data-col-index="6">
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
                                            <option value="">Semua</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6 mt-6">
                                        <label>Status Pegawai</label>
                                        <select type="text" class="form-control datatable-input" data-col-index="8">
                                            <option value="">Pilih Status</option>
                                            <option value="TETAP">TETAP</option>
                                            <option value="TIDAK TETAP">TIDAK TETAP</option>
                                            <option value="HONORER">HONORER</option>
                                            <option value="">SEMUA</option>
                                            <!-- <option value="5">SMA</option> -->
                                        </select>
                                    </div>
                                    <div class="col-lg-3 mb-lg-0 mb-6 mt-6">
                                        <label class="font-weight-bolder">Tampilkan Perhitungan Dari Tanggal:</label>
                                        <div class="input-group" id="kt_daterangepicker_6">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i
                                                        class="la la-calendar-check-o"></i></span>
                                            </div>
                                            <input type="text" class="form-control font-weight-bolder" readonly=""
                                                placeholder="Select date range">
                                        </div>
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

                                        </div>
                                        <div class="col-lg-6 mb-lg-0 mb-6">

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
                                <table class="table table-separate table-hover table-light-default table-checkable"
                                    id="table_transcation">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>NIP</th>
                                            <th>Nama Pegawai</th>
                                            <th>Jabatan</th>
                                            <th>JK</th>
                                            <th>Tingkat</th>
                                            <th>TA</th>
                                            <th>Nomor HP</th>
                                            <th>Status Pegawai</th>
                                            <th>Total Pinjaman</th>
                                            <th>Total Terbayar</th>
                                            <th>Sisa Pinjaman</th>
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
                                            <th class="font-weight-bolder text-success">-</th>
                                            <th class="font-weight-bolder text-dark">-</th>
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
</div>
<!--end::Content-->

<!-- Modal Debet  -->
<div class="modal fade" tabindex="" role="dialog" id="modalEditNasabah">
    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
        value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_edit_employee">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="modal-title font-weight-bolder">Edit Profil Debitur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_form_edit_employee">
                <div class="modal-body">
                    <input type="hidden" class="hidden" name="id_pegawai">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> NIP Pegawai</label>
                                <input class="form-control form-control-lg nip_pegawai" name="nip_pegawai" disabled>
                                </input>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Nama Pegawai/Debitur</label>
                                <input type="text" name="nama_pegawai" class="form-control form-control-lg nama_pegawai"
                                    placeholder="Inputkan Nama Lengkap Debitur" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Isikan Nama
                                    Pegawai/Debitur</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Jenis Kelamin </label>
                                <select name="jenis_kelamin" class="form-control form-control-lg jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="1">Laki-Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH</b></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="level_tingkat" id="tingkat" class="form-control form-control-lg level_tingkat">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="1">DC/KB/TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                    <option value="6">UMUM</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Pilih
                                    Tingkat</span>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label> Jabatan Pegawai </label>
                                <select name="jabatan_pegawai" id="jabatan"
                                    class="form-control form-control-lg jabatan_pegawai">
                                    <option value="">Pilih Jabatan Pegawai</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH, </b>pilih Jabatan Pegawai</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label> Email Nasabah </label>
                                <input type="text" name="email_nasabah"
                                    class="form-control form-control-lg email_nasabah"
                                    placeholder="Inputkan Email Nasabah" />
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b> Isikan
                                    Email Nasabah</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label> Nomor Handphone </label>
                                <input type="text" name="nomor_handphone_pegawai"
                                    class="form-control form-control-lg nomor_handphone_pegawai"
                                    placeholder="Inputkan Nomor HP" />
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b> Isikan
                                    Nomor HP Nasabah</span>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label> Status Pegawai </label>
                                <select name="status_pegawai" class="form-control form-control-lg status_pegawai">
                                    <option value="">Pilih Status Pegawai</option>
                                    <option value="1">Tetap</option>
                                    <option value="2">Tidak Tetap</option>
                                    <option value="3">Honorer</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> pilih
                                    Status Pegawai</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="th_ajaran" class="form-control form-control-lg th_ajaran">
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
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> pilih Tahun
                                    Ajaran</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success font-weight-bolder" id="btnUpdateNasabah">Simpan
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
                <h5 class="modal-title font-weight-bolder"> Lihat Rekap Pinjaman Pegawai/Debitur</h5>
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
                        <div class="col-md-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>INFO TABUNGAN PEGAWAI/DEBITUR</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            Nama Pegawai: <label class="font-weight-bold" id="infoNamaPegawaiRekap">-</label><br>
                            Jabatan Pegawai: <label class="font-weight-bold timeago"
                                id="userJabatanRekap">-</label><br>
                            Status Pegawai: <label class="font-weight-bold" id="userStatusPegawaiRekap">-</label>
                        </div>
                        <div class="col-md-6">
                            Catatan: <label class="font-weight-bold" id="infoCatatanRekap">-</label><br>
                            Transaksi Terakhir: <label class="font-weight-bold timeago"
                                id="infoTerakhirTransaksiRekap">-</label><br>
                            Pinjaman: <label class="font-weight-bold" id="infoSaldoRekap">-</label>
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

<div class="modal fade" id="modal_import_nasabah" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true"
    role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" id="kt_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Pegawai/Debitur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" method="POST" action="<?php echo site_url('finance/savings/import_employee_saving'); ?>"
                enctype="multipart/form-data" id="kt_upload_nasabah_employee">
                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <h5 class="modal-title text-center font-weight-bolder">SEBELUM MENGUPLOAD DIHARAPKAN
                                MENGEDIT FILE SESUAI CONTOH
                                FORMAT HEADER & ISI FILE DIBAWAH INI!</h5>
                            <img class="mb-2 mt-5" src="<?php echo base_url() . "/uploads/data/format_excel_emp.png"; ?>"
                                alt="format" height="" width="100%">
                            <span class="form-text text-dark mb-5 text-center"><b class="text-danger"><a
                                        href="<?php echo base_url() . "uploads/data/contoh_format_excel_emp.xlsx"; ?>">*KLIK
                                        DISINI</a>, </b>untuk mendownload
                                file contoh format excel.</span>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label>Upload File Excel Debitur</label>
                                <input type="file" class="dropify_import form-control" name="file_employee_saving"
                                    data-max-file-size="10M" data-height="170"
                                    data-allowed-file-extensions="xls xlsx" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>format xls,
                                    xlsx dan ukuran < 10Mb</span>
                            </div>
                            <input type="hidden" class="hidden" name="pin_verification">
                        </div>
                        <div class="col-xl-4">
                            <div class="col-lg-12">
							<div class="form-group">
								<label>Tanggal Transaksi</label>
                                    <input type="text" name="input_tanggal_transaksi"
                                        value="<?php echo date('d/m/Y'); ?>"
                                        class="form-control form-control-lg kt_datepicker_kredit"
                                        id="input_tanggal_transaksi" placeholder="Inputkan Tanggal Transaksi" />
                                    <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                            DIPILIH,</b> Pilih Tanggal Transaksi
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Tahun Ajaran</label>
                                    <select name="input_tahun_ajaran" class="form-control form-control-lg">
                                        <option value="">Pilih Tahun Ajaran</option>
                                        <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value) {
        ?>
                                        <option value="<?php echo $value->id_tahun_ajaran; ?>">
                                            <?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?>
                                        </option>
                                        <?php
} //ngatur nomor urut
}
?>
                                    </select>
                                    <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,
                                        </b>isikan Tahun Ajaran</span>
                                </div>
                            </div>
                        </div>
                        <!--begin::Action-->
                        <div class="col-xl-6 text-center">
                            <div class="form-group">
                                <label>PIN Anda</label>
                                <div class="row col-12 d-flex justify-content-center" id="otp">
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
                                <span class="form-text text-dark mt-4"><b class="text-danger">*WAJIB DIISI, </b>Inputkan
                                    PIN Anda</span>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group text-center">
                                <div class="g-recaptcha"
                                    data-sitekey="<?php echo $this->config->item('google_site_key') ?>"></div>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DICENTANG, </b>Silahkan
                                    Centang untuk Menyetujui</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button id="kt_login_signin_submit" class="btn btn-success font-weight-bold mr-2">Upload</button>
                    <button type="reset" class="btn btn-light-danger font-weight-bold"
                        data-dismiss="modal">Batal</button>
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

<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/list-employee-debt.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/edit-employee.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/blur.pin.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/import-employee.js"></script>
<script>
$(document).ready(function() {
    $('.dropify_import').dropify({
        messages: {
            'default': 'Klik atau Geser file Anda disini',
            'replace': 'Klik atau Geser file Anda untuk mengganti',
            'remove': 'Hapus',
            'error': 'Ooops, terjadi kesalahan.'
        }
    });
});
</script>
