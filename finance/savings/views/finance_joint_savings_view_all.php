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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Tabungan Bersama</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Daftar Tabungan Bersama</a>
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
                        <div class="alert alert-custom alert-light-dark shadow-sm alert-shadow fade show" role="alert">
                            <div class="alert-text font-weight-bolder text-center text-dark">
                                <h1 class="font-weight-boldest text-danger">
                                    <li class="fas fa-exclamation-triangle"></li> DAFTAR TABUNGAN BERSAMA <li
                                        class="fas fa-exclamation-triangle">
                                </h1>
                                MOHON UNTUK DIPERHATIKAN!!.<br> Silahkan
                                Melakukan Pengecekan Kembali Untuk Transaksi KREDIT/DEBET Terima Kasih!
                            </div>
                        </div>
                    </div>
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-layers-1 text-primary"></i>
                                </span>
                                <h3 class="card-label">Daftar Nasabah Tabungan Bersama</h3>
                                <a href="#" data-toggle="modal" data-target="#modal_import_joint"
                                    class="btn btn-warning btn-md">
                                    <i class="flaticon-upload"></i>Import Nasabah Bersama
                                </a>
                            </div>
                            <div class="card-toolbar">
                                <div class="buttons">
                                    <a href="<?php echo site_url("/finance/savings/add_joint_saving") ?>"
                                        class="btn btn-success mr-2">
                                        <i class="fa fa-plus"></i> Tambah Tabungan Baru
                                    </a>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalRekap"
                                        id="btnRekap">
                                        <i class="fa fa-suitcase"></i> Lihat Rekap
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="paper">
                            <div class="card-body">
                                <!--begin: Search Form-->

                                <div class="row mb-4">
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Nomor Rekening Bersama:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nomor Rekening" data-col-index="1" />
                                    </div>
                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>Nama Tabungan:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nama Tabungan" data-col-index="2" />
                                    </div>
                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>Penanggung Jawab:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nama Penanggung Jawab" data-col-index="3" />
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
                                        <select class="form-control datatable-input" data-col-index="7">
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
									<div class="col-lg-2 mb-lg-0 mb-6 mt-5">
                                        <label>Jenis Tabungan</label>
                                        <select class="form-control datatable-input" data-col-index="11">
                                            <option value="">Pilih Jenis</option>
                                            <option value="KOMITE">KOMITE</option>
                                            <option value="KELAS">KELAS</option>
                                            <option value="">SEMUA</option>
                                            <!-- <option value="5">SMA</option> -->
                                        </select>
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
                                            <span class="font-weight-bolder">Tampilkan Perhitungan Dari Waktu Transaksi</span>
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
                                <table class="table table-separate table-hover table-light-dark table-checkable"
                                    id="table_transcation">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>No. Rekening</th>
                                            <th>Nama Tabungan</th>
                                            <th>Penanggung Jawab</th>
                                            <th>No. Handphone</th>
                                            <th>Email</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Tingkat</th>
                                            <th>Kredit (Rp)</th>
                                            <th>Debet (Rp)</th>
                                            <th>Saldo (Rp)</th>
											<th>Jenis Tabungan</th>
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
                                            <th class="font-weight-bolder">TOTAL TRANSAKSI</th>
                                            <th class="font-weight-bolder text-success">-</th>
                                            <th class="font-weight-bolder text-danger">-</th>
                                            <th class="font-weight-bolder text-dark">-</th>
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
</div>
<!--end::Content-->

<!-- Modal Debet  -->
<div class="modal fade" tabindex="" role="dialog" id="modalEditJoint">
    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
        value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_edit_joint">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="modal-title font-weight-bolder">Edit Tabungan Bersama</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_form_edit_joint">
                <div class="modal-body">
                    <input type="hidden" class="hidden" name="id_tabungan_bersama">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Nomor Rekening Bersama</label>
                                <input class="form-control form-control-lg nomor_rekening_bersama form-control-solid"
                                    name="nomor_rekening_bersama" readonly>
                                </input>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label> Nama Tabungan Bersama</label>
                                <input type="text" name="nama_tabungan_bersama"
                                    class="form-control form-control-lg nama_tabungan_bersama"
                                    placeholder="Inputkan Nama Tabungan Bersama" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Isikan Nama
                                    Tabungan Bersama</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="id_tingkat" class="form-control form-control-lg id_tingkat">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="6">DC</option>
                                    <option value="1">KB</option>
                                    <option value="2">TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH</b></span>
                            </div>
                        </div>
						<div class="col-lg-3">
                            <div class="form-group">
                                <label> Jenis Tabungan </label>
                                <select name="jenis_tabungan" class="form-control form-control-lg jenis_tabungan" id="jenis_tabungan">
                                    <option value="">Pilih Jenis Tabungan</option>
                                    <option value="1">KOMITE</option>
                                    <option value="2">KELAS</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Pilih Jenis Tabungan</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Penanggung Jawab</label>
                                <select name="id_penanggung_jawab" id="id_penanggung_jawab"
                                    class="form-control form-control-lg select2 id_penanggung_jawab">
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIISI,
                                    </b>isikan Siswa Penanggung Jawab, Perwakilan salah satu
                                    satu</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="id_th_ajaran" class="form-control form-control-lg id_th_ajaran">
                                    <option value="">Pilih TA</option>
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

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Nama Wali Penanggung Jawab</label>
                                <input type="text" name="nama_wali" class="form-control form-control-lg"
                                    placeholder="Inputkan Nama Wali" />
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b> Isikan
                                    Nama
                                    Wali/Nasabah</span>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Nomor HP Wali Penanggung Jawab</label>
                                <input type="text" name="nomor_handphone_wali" class="form-control form-control-lg"
                                    placeholder="Inputkan Nomor Handphone Wali" />
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b> Isikan
                                    Nomor Handphone
                                    Wali/Nasabah</span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Keterangan Tabungan Bersama</label>
                                <textarea class="form-control" name="keterangan_tabungan_bersama"
                                    placeholder="Isikan Keterangan Tabungan Bersama" rows="4"></textarea>
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                        DIISI,
                                    </b>Isikan
                                    Keterangan Tabungan Bersama</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success font-weight-bolder" id="btnUpdateTabungan">Simpan
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
                <h5 class="modal-title font-weight-bolder"> Lihat Rekap Tabungan Bersama</h5>
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
                            <label> Input Nomor Rekeming Bersama</label>
                            <select name="nomor_rekening_bersama" class="form-control select2 findRekapTabungan"
                                id="findRekapTabungan">
                            </select>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Inpukan
                                Nomor Rekening Bersama</span>
                        </div>
                        <div class="col-md-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>INFO TABUNGAN BERSAMA</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            Nama Tabungan: <label class="font-weight-bold" id="infoNamaTabunganRekap">-</label><br>
                            PJ: <label class="font-weight-bold timeago" id="infoPenanggungJawabRekap">-</label><br>
                            Tingkat: <label class="font-weight-bold" id="infoTingkatRekap">-</label>
                        </div>
                        <div class="col-md-6">
                            Catatan: <label class="font-weight-bold" id="infoCatatanRekap">-</label><br>
                            Transaksi Terakhir: <label class="font-weight-bold timeago"
                                id="infoTerakhirTransaksiRekap">-</label><br>
                            Saldo: <label class="font-weight-bold" id="infoSaldoRekap">-</label>
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
<div class="modal fade" id="modal_import_joint" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true"
    role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" id="kt_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Nasabah Bersama</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" method="POST" action="<?php echo site_url('finance/savings/import_joint_saving'); ?>"
                enctype="multipart/form-data" id="kt_upload_nasabah_joint">
                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <h5 class="modal-title text-center font-weight-bolder">SEBELUM MENGUPLOAD DIHARAPKAN
                                MENGEDIT FILE SESUAI CONTOH
                                FORMAT HEADER & ISI FILE DIBAWAH INI!</h5>
                            <img class="mb-2 mt-5"
                                src="<?php echo base_url() . "/uploads/data/format_excel_joint.png"; ?>" alt="format"
                                height="" width="100%">
                            <span class="form-text text-dark mb-5 text-center"><b class="text-danger"><a
                                        href="<?php echo base_url() . "uploads/data/contoh_format_excel_joint.xlsx"; ?>">*KLIK
                                        DISINI</a>, </b>untuk mendownload
                                file contoh format excel.</span>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group">
                                <label>Upload File Excel Nasabah</label>
                                <input type="file" class="dropify_import form-control" name="file_joint_saving"
                                    data-max-file-size="10M" data-height="170"
                                    data-allowed-file-extensions="xls xlsx" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>format xls,
                                    xlsx dan ukuran < 10Mb</span>
                            </div>
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
                                <input type="hidden" class="hidden" name="pin_verification">
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

<script>
<?php if ($user[0]->id_role_struktur == 5) {?>
var id_role = 5;
<?php } else {?>
var id_role = 7;
<?php }?>
</script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/list-joint-saving.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/edit-joint-saving.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/blur.pin.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/import-joint.js"></script>
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

<?php
if ($this->session->flashdata('print_transaction')) {
    $resutl = $this->session->flashdata('print_transaction');

    $nama_tingkat = "";
    if ($resutl['tingkat'] == 1) {
        $nama_tingkat = "KB";
    } else if ($resutl['tingkat'] = 2) {
        $nama_tingkat = "TK";
    } else if ($resutl['tingkat'] = 3) {
        $nama_tingkat = "SD";
    } else if ($resutl['tingkat'] = 4) {
        $nama_tingkat = "SMP";
    } else if ($resutl['tingkat'] = 6) {
        $nama_tingkat = "DC";
    }

    echo "<script>" .
    "window.bundle.getPrint('RUMAH AMANAH - SEKOLAH UTSMAN', HOST_URL + 'uploads/data/rumah_amanah.png','Jln. Lakarsantri Selatan 31-35',
		 'Surabaya, Jawa Timur', '031-99424800','" . $resutl['nomor_rekening'] . "','" . $resutl['nomor_transaksi'] . "', 'BERSAMA', 'KREDIT',
		  '" . $resutl['waktu_transaksi'] . "', '" . number_format((double) $resutl['saldo'], 0, ',', '.') . "','0','" . number_format((double) $resutl['saldo'], 0, ',', '.') . "', 'SIMPAN STRUK INI', 'UNTUK BUKTI TRANSAKSI',
		  '" . $resutl['nama_tabungan'] . "', '" . $nama_tingkat . "', 'www.sekolahutsman.sch.id')"
        . "</script>";
}
?>
