<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">

                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Tabungan</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Pengajuan Tambah Nasabah</a>
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
                <div class="col-lg-12" id="kt_form">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header mt-2">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Formulir Pengajuan Nasabah Baru
                                    <span class="text-muted pt-2 font-size-sm d-block">Silahakan isi formulir nasabah
                                        baru sesuai dengan inputan</span>
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate"
                            action="<?php echo site_url('finance/savings/post_personal_savings'); ?>"
                            enctype="multipart/form-data" method="post" id="kt_add_personal_saving">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nomor Rekening/NIS Nasabah</label>
                                            <input type="text" name="input_nomor_rekening" class="form-control
                                                class=" form-control form-control-lg"
                                                placeholder="Isikan Nomor Rekening" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Nomor Rekening/NIS Nasabah</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nama Nasabah/Siswa</label>
                                            <input type="text" name="input_nama_nasabah"
                                                class="form-control form-control-lg"
                                                placeholder="Isikan Nama Nasabah/Siswa" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Nama Nasabah/Siswa</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
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
                                    <div class="col-lg-2">
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
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Tingkat</label>
                                            <select name="input_tingkat" class="form-control form-control-lg">
                                                <option value="">Pilih Tingkat</option>
												<option value="6">DC</option>
                                                <option value="1">KB</option>
                                                <option value="2">TK</option>
                                                <option value="3">SD</option>
                                                <option value="4">SMP</option>
                                                <!-- <option value="5">SMA</option> -->
                                            </select>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,
                                                </b>pilih Tingkat</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-lg-3">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Nama Wali/Orang Tua Penanggung Jawab</label>
                                                    <input class="form-control form-control-lg" name="input_nama_wali"
                                                        placeholder='Inputkan Nama Wali Penanggung Jawab' />
                                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                            DIISI,</b>
                                                        isikan
                                                        nama Penanggung Jawab</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Nomor HP Wali/Orang Tua Penanggung Jawab</label>
                                                    <input class="form-control form-control-lg"
                                                        name="input_nomor_hp_wali"
                                                        placeholder='Inputkan Nomor HP Wali Penanggung Jawab' />
                                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                            DIISI,</b>
                                                        isikan
                                                        nomor HP Penanggung Jawab</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Email Nasabah/Siswa/Orangtua</label>
                                                    <input type="text" name="input_email_nasabah"
                                                        class="form-control form-control-lg"
                                                        placeholder="Isikan Email Nasabah/Siswa/Orangtua" />
                                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                            DIISI,
                                                        </b>isikan Email Nasabah/Siswa/Orangtua</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Nominal Saldo Tabungan Umum</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text font-weight-bolder">
                                                                Rp
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control form-control-lg"
                                                            name="input_saldo_tabungan_umum"
                                                            id="input_saldo_tabungan_umum"
                                                            placeholder="Input Nominal Saldo Umum" />
                                                    </div>
                                                    <span class="form-text text-dark"><b class="text-danger">*WAJIB ISI SALAH SATU
                                                            ,</b>
                                                        Isikkan Nominal Tabungan Saldo Umum</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Nominal Saldo Tabungan Qurban</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text font-weight-bolder">
                                                                Rp
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control form-control-lg"
                                                            name="input_saldo_tabungan_qurban"
                                                            id="input_saldo_tabungan_qurban"
                                                            placeholder="Input Nominal Saldo Qurban" />
                                                    </div>
                                                    <span class="form-text text-dark"><b class="text-danger">*WAJIB ISI SALAH SATU
                                                            ,</b>
                                                        Isikkan Nominal Tabungan Saldo Qurban</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Nominal Saldo Tabungan Wisata</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text font-weight-bolder">
                                                                Rp
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control form-control-lg"
                                                            name="input_saldo_tabungan_wisata"
                                                            id="input_saldo_tabungan_wisata"
                                                            placeholder="Input Nominal Saldo Wisata" />
                                                    </div>
                                                    <span class="form-text text-dark"><b class="text-danger">*WAJIB ISI SALAH SATU
                                                            ,</b>
                                                        Isikkan Nominal Tabungan Saldo Wisata</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Keterangan Tabungan Umum</label>
                                                    <textarea class="form-control" placeholder="Isikan Catatan Umum"
                                                        name="input_catatan_umum" rows="6"></textarea>
                                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK
                                                            WAJIB
                                                            DIISI,
                                                        </b>Isikan
                                                        Keterangan Tabungan Umum</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Keterangan Tabungan Qurban</label>
                                                    <textarea class="form-control" placeholder="Isikan Catatan Qurban"
                                                        name="input_catatan_qurban" rows="6"></textarea>
                                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK
                                                            WAJIB
                                                            DIISI,
                                                        </b>Isikan
                                                        Keterangan Tabungan Qurban</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Keterangan Tabungan Wisata</label>
                                                    <textarea class="form-control" placeholder="Isikan Catatan Wisata"
                                                        name="input_catatan_wisata" rows="6"></textarea>
                                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK
                                                            WAJIB
                                                            DIISI,
                                                        </b>Isikan
                                                        Keterangan Tabungan Wisata</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button id="kt_login_signin_submit"
                                    class="btn btn-success font-weight-bold px-9 py-4 my-3 mx-4">Simpan</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-personal-saving.js"></script>
