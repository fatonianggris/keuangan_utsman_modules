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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Tabungan Personal</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Hasil Import Tabungan Personal</a>
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
                                    <li class="fas fa-exclamation-triangle"></li> HASIL IMPORT NASABAH TABUNGAN PERSONAL
                                    <li class="fas fa-exclamation-triangle"></li>
                                </h1>
                                MOHON UNTUK DIPERHATIKAN!!.<br> Silahkan
                                Melakukan Pengecekan Kembali dengan data Asli, Terima Kasih!
                            </div>
                        </div>
                    </div>
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-layers-1 text-primary"></i>
                                </span>
                                <h3 class="card-label">Hasil Import Nasabah Tabungan Personal</h3>

                            </div>

                            <div class="card-toolbar">
                                <div class="buttons">

                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="paper">

                            <!--begin: Search Form-->
                            <div class="row mb-4">
                                <div class="col-lg-2 mb-lg-0 mb-6">
                                    <label>Nomor Rekening/NIS:</label>
                                    <input type="text" class="form-control datatable-input"
                                        placeholder="Inputkan Nomor Rekening" data-col-index="1" />
                                </div>
                                <div class="col-lg-4 mb-lg-0 mb-6">
                                    <label>Nama Siswa:</label>
                                    <input type="text" class="form-control datatable-input"
                                        placeholder="Inputkan Nama Siswa" data-col-index="2" />
                                </div>
                                <div class="col-lg-2 mb-lg-0 mb-6">
                                    <label>Tahun Ajaran:</label>
                                    <select class="form-control datatable-input" data-col-index="4">
                                        <option value="">Pilih Tahun Ajaran</option>
                                        <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value) {
        ?>
                                        <option value="<?php echo $value->tahun_awal . "/" . $value->tahun_akhir; ?>">
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
                                        data-col-index="5">
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
                                <div class="col-lg-2 mb-lg-0 mb-6">
                                    <label>Status Rekening</label>
                                    <select class="form-control datatable-input" data-col-index="12">
                                        <option value="">Pilih Status</option>
                                        <option value="TIDAK TERDAFTAR">TIDAK TERDAFTAR</option>
                                        <option value="TERPAKAI">TERPAKAI</option>
                                        <option value="DUPLIKAT">DUPLIKAT</option>
                                        <option value="">SEMUA</option>
                                        <!-- <option value="5">SMA</option> -->
                                    </select>
                                </div>
                                <div class="col-lg-2 mb-lg-0 mb-6 mt-5">
                                    <label>Status Nama</label>
                                    <select class="form-control datatable-input" data-col-index="13">
                                        <option value="">Pilih Status</option>
                                        <option value="MIRIP">MIRIP</option>
                                        <option value="TIDAK TERDAFTAR">TIDAK TERDAFTAR</option>
                                        <option value="TERPAKAI">TERPAKAI</option>
                                        <option value="DUPLIKAT">DUPLIKAT</option>
                                        <option value="">SEMUA</option>
                                        <!-- <option value="5">SMA</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-8">
                                <div class="col-lg-10">
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
                                <div class="col-lg-2 text-right">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-danger font-weight-bold blink_print "
                                            data-toggle="modal" data-target="#modalKeteranganStatus"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="flaticon-eye"></i>
                                            Lihat Keterangan Status
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!--begin: Datatable-->
                            <div class="table-responsive">
                                <table class="table table-separate table-hover table-light-default table-checkable"
                                    id="table_transcation">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>NIS</th>
                                            <th>Nama Nasabah/Siswa</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Tingkat</th>
                                            <th>Nama Wali</th>
                                            <th>Nomor HP Wali</th>
                                            <th>Email</th>
                                            <th>Saldo Umum</th>
                                            <th>Saldo Qurban</th>
                                            <th>Saldo Wisata</th>
                                            <th>Status NIS/Rekening</th>
                                            <th>Status Nama</th>
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
                                            <th class="font-weight-bolder">TOTAL PER SALDO</th>
                                            <th class="font-weight-bolder text-dark">-</th>
                                            <th class="font-weight-bolder text-dark">-</th>
                                            <th class="font-weight-bolder text-dark">-</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="pb-1 text-center" style="justify-content: center">
                                <button id="btn_accept_import" class="btn btn-success btn-lg font-weight-bold mr-7"><i
                                        class="fas fa-check-circle "></i>KONFIRMASI IMPOR DATA NASABAH</button>
                                <button id="btn_reject_import" class="btn btn-danger btn-lg font-weight-bold ml-7"><i
                                        class="fas fa-window-close"></i>BATALKAN IMPOR DATA NASABAH</button>
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

<!-- Modal Debet  -->
<div class="modal fade" tabindex="" role="dialog" id="modalEditImportNasabah">
    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
        value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_edit_import_personal">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="modal-title font-weight-bolder">Edit Profil Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_form_edit_personal">
                <div class="modal-body">
                    <input type="hidden" class="hidden" name="id_nasabah">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> NIS Nasabah</label>
                                <input type="text" class="form-control form-control-lg nis_siswa" name="nis_siswa">
                                <input type="hidden" name="old_nis">
                                </input>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Isikan NIS
                                    Siswa</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Nama Siswa/Nasabah</label>
                                <input type="text" name="nama_siswa" class="form-control form-control-lg nama_siswa"
                                    placeholder="Inputkan Nama Lengkap Siswa" />
                                <input type="hidden" name="old_nama_siswa">
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Isikan Nama
                                    Siswa/Nasabah</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="th_ajaran" class="form-control form-control-lg th_ajaran" disabled>
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
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="level_tingkat" class="form-control form-control-lg level_tingkat">
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
                                <label> Tanggal Transaksi</label>
                                <input type="text" name="tanggal_transaksi"
                                    class="form-control form-control-lg tanggal_transaksi kt_datepicker_kredit"
                                    placeholder="Inputkan Tanggal Transaksi"/>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label> Nama Wali </label>
                                <input type="text" name="nama_wali" class="form-control form-control-lg nama_wali"
                                    placeholder="Inputkan Nama Wali Siswa" />
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b> Isikan
                                    Nama
                                    Wali</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Nomor Handphone Wali </label>
                                <input type="text" name="nomor_handphone_wali"
                                    class="form-control form-control-lg nomor_handphone_wali"
                                    placeholder="Inputkan Nomor Handphone Wali" />
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b> Isikan
                                    Nomor Handphone
                                    Wali/Nasabah</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Email Nasabah/Wali </label>
                                <input type="text" name="email_wali" class="form-control form-control-lg email_wali"
                                    placeholder="Inputkan Email Wali" />
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b> Isikan
                                    Email
                                    Wali/Nasabah</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label> Saldo Umum</label>
                                <input type="text" name="saldo_umum" class="form-control form-control-lg saldo_umum"
                                    placeholder="Inputkan Saldo Umum" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Isikan
                                    Nominal Saldo Umum</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label> Saldo Qurban</label>
                                <input type="text" name="saldo_qurban" class="form-control form-control-lg saldo_qurban"
                                    placeholder="Inputkan Saldo Qurban" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Isikan
                                    Nominal Saldo Qurban</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label> Saldo Wisata</label>
                                <input type="text" name="saldo_wisata" class="form-control form-control-lg saldo_wisata"
                                    placeholder="Inputkan Saldo Wisata" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Isikan
                                    Nominal Saldo Wisata</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>-- INFORMASI --</b>
                            </div>
                            <div class="mt-5 row">
                                <div class="col-lg-6 text-center">
                                    <div class="text-center">
                                        <label class="font-weight-bolder font-size-h6 ">Status NIS Nasabah</label>
                                    </div>
                                    <div id="status_nis">
                                    </div>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <div class="text-center">
                                        <label class="font-weight-bolder font-size-h6 ">Status Nama Nasabah</label>
                                    </div>
                                    <div id="status_nama">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="modal_ps">

                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success font-weight-bolder" id="btnUpdateNasabah"
                        disabled="disabled">Simpan
                        !</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Debet  -->
<!-- Modal KETERANGAN import  -->
<div class="modal fade" tabindex="" role="dialog" id="modalKeteranganStatus">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title font-weight-bolder">Keterangan Status Data Tabungan Umum/Qurban/Wisata
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-danger blink_print text-center font-weight-bolder font-size-h5">*PASTIKAN ANDA MEMILIH
                    DATA YANG KEDUANYA BERSTATUS LABEL HIJAU*</p>
                <div class="row">
                    <table class="table table-separate table-hover table-light-danger table-checkable text-center">
                        <thead>
                            <tr>
                                <th style="width: 60%">Keterangan</th>
                                <th>Status NIS/Rekening</th>
                                <th>Status Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">Semua atribut/inputan telah sesuai dan tidak ada kesalahan
                                    penulisan.</td>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-success label-inline">TIDAK
                                        TERDAFTAR</span>
                                </td>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-success label-inline">TIDAK
                                        TERDAFTAR</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Terdapat kesalahan input pada kolom "NIS/Rekening"
                                    (Kemungkinan NIS/Rekening tersebut terpakai dengan NIS/Rekening sebemlunya)
                                    <b class="text-danger">*Jika NIS/Rekening berstatus <span
                                            class="label label-over font-weight-bolder label-light-danger label-inline">TERPAKAI
                                        </span>. Anda diwajibkan
                                        menginputkan saldo secara manual di Menu Setor & Tarik Tabungan, karena Nasabah
                                        telah terdaftar sebelumnya.</b>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-danger label-inline">TERPAKAI
                                    </span>
                                </td>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-success label-inline">TIDAK
                                        TERDAFTAR</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Terdapat kesalahan input pada kolom "NIS/Rekening"
                                    (Kolom NIS/Rekening terdapat kesamaan didalam file Excel yang di import *silahkan
                                    cek
                                    NIS/Rekening di file Excel)</td>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-danger label-inline">DUPLIKAT</span>
                                </td>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-success label-inline">TIDAK
                                        TERDAFTAR</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Terdapat peringatan untuk inputan "Nama Siswa"
                                    (Kemungkinan ada kesalahan inputan karena Nama Siswa terdapat kemiripan dengan data
                                    yang terdaftar sebelumnya *Contoh = 'AHMAD IBRAHIM' salah
                                    menjadi 'AHMAD IBRAHUM')</td>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-success label-inline">TIDAK
                                        TERDAFTAR</span>
                                </td>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-warning label-inline">MIRIP
                                    </span></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Terdapat kesalahan input pada kolom "Nama Siswa"
                                    (Kolom Nama Siswa terdapat kesamaan didalam file Excel yang di import *silahkan
                                    cek Nama Siswa di file Excel)</td>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-success label-inline">TIDAK
                                        TERDAFTAR</span>
                                </td>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-danger label-inline">DUPLIKAT</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Terdapat kesalahan input pada kolom "Nama Siswa"
                                    (Kemungkinan Nama Siswa tersebut telah terdaftar sebelumnya)</td>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-success label-inline">TIDAK
                                        TERDAFTAR</span>
                                </td>
                                <td><span
                                        class="label label-over font-weight-bolder label-light-danger label-inline">TERPAKAI</span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of  KETERANGAN import   -->
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/blur.pin.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/list-import-personal-saving.js">
</script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/edit-import-personal.js">
</script>
