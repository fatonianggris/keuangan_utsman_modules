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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Pemasukan</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Tambah Pemasukan Sekolah</a>
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
                        <div class="card-header mt-2" style="justify-content: center">
                            <div class="card-title text-center">
                                <h2 class="card-label font-size-h1 font-weight-bolder">
                                    Formulir Tambah Tagihan DPB Siswa
                                    <span class="pt-2 font-size-sm d-block text-warning">Berikut Formulir Tambah Tagihan
                                        DPB
                                        Siswa</span>
                                </h2>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate"
                            action="<?php echo site_url('finance/income/income/post_income_dpb'); ?>"
                            enctype="multipart/form-data" method="post" id="kt_add_income_dpb_form">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="card-body text-center">
                                <div class="row border-bottom">
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="font-weight-bolder">Nomor Invoice</label>
                                            <input type="text" name="nomor_invoice" id="nomor_invoice"
                                                class="form-control form-control-lg" />
                                            <span class="form-text text-dark "><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Nomor Invoice</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="font-weight-bolder">Nomor Pembayaran</label>
                                            <input type="text" name="nomor_pembayaran" id="nomor_pembayaran"
                                                class="form-control form-control-lg" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Nomor Pembayaran</span>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="font-weight-bolder">Total Nominal (Rp)</label>
                                            <input type="text" name="nominal_tagihan"
                                                class="form-control  form-control-lg" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Total Nominal</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Tahun Ajaran</label>
                                            <select name="tahun_ajaran" class="form-control form-control-lg">
											<option value="">Pilih Tahun Ajaran</option>
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
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b>
                                                Pilih
                                                TA</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 text-center">
                                        <div class="text-center">
                                            <label class="font-weight-bolder ">Tipe Tagihan</label>
                                        </div>
                                        <p class="font-weight-boldest display-3 text-warning text-center">DPB</p>
                                    </div>
                                    <div class="col-lg-1">
                                    </div>
                                </div>
                                <div class="row border-bottom">
                                    <div class="col-lg-6 border-right border-left">
                                        <div class="row mt-2">
                                            <div class="col-lg-12">
                                                <h6
                                                    class="text-center font-weight-bolder mb-5 mt-5 font-size-h4 text-warning">
                                                    Identitas Siswa
                                                </h6>
                                            </div>
                                            <div class="form-group col-lg-12 col-12">
                                                <label class="font-weight-bold">Nama Siswa</label>
                                                <textarea type="text" class="form-control" name="nama_siswa"
                                                    rows="2"></textarea>
                                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                    </b>isikan Nama Siswa</span>

                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label class="font-weight-bold">NIS</label>
                                                <input type="text" name="nis" readonly id="nis"
                                                    class="input-reset form-control-solid  form-control form-control-lg" />
                                                <span class="form-text text-dark"><b class="text-dark">*OTOMATIS
                                                    </b></span>
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label class="font-weight-bold">Email</label>
                                                <input type="text" name="email"
                                                    class="input-reset  form-control form-control-lg" />
                                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                        DIISI
                                                    </b></span>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label class="font-weight-bold">Tingkat</label>
                                                <select name="level_tingkat" class="form-control form-control-lg">
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
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Nama Kelas</label>
                                                <input type="text" name="nama_kelas"
                                                    class="input-reset  form-control form-control-lg" />
                                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                        DIISI
                                                    </b></span>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Nomor HP</label>
                                                <input type="text" name="nomor_hp"
                                                    class="input-reset  form-control form-control-lg" />
                                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                        DIISI
                                                    </b></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 border-right border-left">
                                        <div class="row mt-2">
                                            <div class="col-lg-12">
                                                <h6
                                                    class="text-center font-weight-bolder mb-5 mt-5 font-size-h4 text-warning">
                                                    Identitas Transfer Tagihan
                                                </h6>
                                            </div>
                                            <div class="form-group col-lg-12 col-12">
                                                <label class="font-weight-bold">Rincian</label>
                                                <textarea class="form-control" name="rincian" rows="2"></textarea>
                                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                        DIISI, </b>isikan Rincian Tagihan (dilarang menghapus kata
                                                    atribut setelah ':', Contoh: Tagihan:, Buku:, dll)</span>

                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Tanggal Invoice</label>
                                                <input type="text" id="kt_datepicker_income" name="tanggal_invoice"
                                                    class="form-control  form-control-lg" />
                                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                    </b>pilih Tanggal Invoice</span>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Nomor Jurnal Pembukuan</label>
                                                <input type="text" name="nama_wajib_pajak" readonly=""
                                                    class="form-control form-control-solid form-control-lg" />
                                                <span class="form-text text-dark"><b class="text-dark">*OTOMATIS
                                                    </b></span>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Informasi</label>
                                                <textarea class="form-control" name="informasi" rows="2"></textarea>
                                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                        DIISI, </b>isikan Rincian Informasi (dilarang menghapus kata
                                                    atribut setelah ':', Contoh: Kelas:, Jalur:, dll)</span>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Catatan</label>
                                                <textarea class="form-control" name="catatan" rows="2"></textarea>
                                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                        DIISI, </b>isikan Catatan Tagihan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 text-center" style="justify-content: center">
                                    <button class="btn btn-success btn-lg font-weight-bold"><i
                                            class="fas fa-check-circle "></i>SIMPAN TAGIHAN</button>
                                </div>
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
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-income-dpb.js"></script>
<script>
// Selectors for the input fields
var nomor_invoice = $('#nomor_invoice');
var nomor_pembayaran = $('#nomor_pembayaran');
var nis = $('#nis');

// Function to handle keyup event for Nomor Invoice
nomor_invoice.on('keyup', function() {
    var prefix = "";
    var value = $(this).val().split('-');

    // Get the last element from the resulting array
    var lastValue = value[value.length - 1];

    // Update other inputs with the prefixed value
    nomor_pembayaran.val(lastValue);
    nis.val(lastValue);
});

// Function to handle keyup event for Nomor Pembayaran
nomor_pembayaran.on('keyup', function() {
    var value = $(this).val();
    var inv_value = nomor_invoice.val();

    var parts = inv_value.split('-');

    // Get all elements before the last element in the array
    var allBeforeLastValue = parts.slice(0, -1).join('-');

    // Update other inputs with the current value
    nomor_invoice.val(allBeforeLastValue + "-" + value);
    nis.val(value);
});
</script>
