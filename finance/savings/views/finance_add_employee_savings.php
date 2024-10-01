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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Tabungan Pegawai</h5>
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
                                    Formulir Pengajuan Nasabah Pegawai Baru
                                    <span class="text-muted pt-2 font-size-sm d-block">Silahakan isi formulir nasabah
                                        pegawai
                                        baru sesuai dengan inputan</span>
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate"
                            action="<?php echo site_url('finance/savings/post_employee_savings'); ?>"
                            enctype="multipart/form-data" method="post" id="kt_add_employee_saving">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nomor Rekening/NIP Nasabah</label>
                                            <input type="text" name="input_nomor_rekening" class="form-control form-control-lg"
                                                placeholder="Isikan Nomor Rekening" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Nomor Rekening/NIP Nasabah</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nama Nasabah/Pegawai</label>
                                            <input type="text" name="input_nama_nasabah"
                                                class="form-control form-control-lg"
                                                placeholder="Isikan Nama Nasabah/Pegawai" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Nama Nasabah/Pegawai</span>
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
                                            <label> Jenis Kelamin </label>
                                            <select name="input_jenis_kelamin"
                                                class="form-control form-control-lg jenis_kelamin">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="1">Laki-Laki</option>
                                                <option value="2">Perempuan</option>
                                            </select>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                                    DIPILIH, </b>pilih Jenis Kelamin</span>
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
                                            <select name="input_tingkat"  id="tingkat" class="form-control form-control-lg">
                                                <option value="">Pilih Tingkat</option>
                                                <option value="1">DC/KB/TK</option>
                                                <option value="3">SD</option>
                                                <option value="4">SMP</option>
                                                <option value="6">UMUM</option>
                                                <!-- <option value="5">SMA</option> -->
                                            </select>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,
                                                </b>pilih Tingkat</span>
                                        </div>
                                    </div>
									<div class="col-lg-3">
                                        <div class="form-group">
                                            <label> Jabatan Pegawai </label>
                                            <select name="input_jabatan_pegawai" id="jabatan" 
                                                class="form-control form-control-lg jabatan">
                                                <option value="">Pilih Jabatan Pegawai</option>
                                            </select>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                                    DIPILIH, </b>pilih Jabatan Pegawai</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label> Status Pegawai </label>
                                            <select name="input_status_pegawai"
                                                class="form-control form-control-lg status_pegawai">
                                                <option value="">Pilih Status Pegawai</option>
                                                <option value="1">Tetap</option>
                                                <option value="2">Tidak Tetap</option>
                                                <option value="3">Honorer</option>
                                            </select>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                                    DIPILIH, </b>pilih Status Pegawai</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label>Nominal Saldo Tabungan</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text font-weight-bolder">
                                                        Rp
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control form-control-lg"
                                                    name="input_saldo_tabungan_umum" id="input_saldo_tabungan_umum"
                                                    placeholder="Input Nominal Saldo" />
                                            </div>
                                            <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                    DIISI,</b>
                                                Isikkan Nominal Tabungan Saldo</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row ">
                                    <div class="col-lg-3">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Nomor HP Pegawai</label>
                                                    <input class="form-control form-control-lg"
                                                        name="nomor_handphone_pegawai"
                                                        placeholder='Inputkan Nomor HP Pegawai' />
                                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                            DIISI,</b> isikan nomor HP Pegawai</span>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Email Nasabah/Pegawai</label>
                                                    <input type="text" name="input_email_nasabah"
                                                        class="form-control form-control-lg"
                                                        placeholder="Isikan Email Nasabah/Pegawai" />
                                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                            DIISI,
                                                        </b>isikan Email Nasabah/Pegawai</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Keterangan Tabungan</label>
                                                    <textarea class="form-control" placeholder="Isikan Catatan Tabungan"
                                                        name="input_catatan_umum" rows="7"></textarea>
                                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                            DIISI,
                                                        </b>Isikan
                                                        Keterangan Tabungan</span>
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
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-employee-saving.js"></script>
<script>
    $(document).ready(function () {
        var id_pos;

        $("#tingkat").change(function () {
            id_pos = $(this).val();
            var url = "<?php echo site_url('finance/savings/add_ajax_position'); ?>/" + id_pos;
            $('#jabatan').load(url);
            return false;
        });
    });
</script>
