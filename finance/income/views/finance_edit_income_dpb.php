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
                            <a href="" class="text-muted">Edit Pemasukan Sekolah</a>
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
                                    Edit Tagihan DPB "<?php echo strtoupper(strtolower($income_dpb[0]->nama)); ?>" -
                                    <?php echo $income_dpb[0]->nis; ?>
                                    <span class="pt-2 font-size-sm d-block text-warning">Berikut form edit Tagihan DPB
                                        Siswa sesuai Kode Invoice</span>
                                </h2>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate"
                            action="<?php echo site_url('finance/income/income/update_income_dpb/' . paramEncrypt($income_dpb[0]->id_tagihan_pembayaran_dpb)); ?>"
                            enctype="multipart/form-data" method="post" id="kt_edit_income_dpb_form">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" name="id_tagihan"
                                value="<?php echo paramEncrypt($income_dpb[0]->id_tagihan_pembayaran_dpb); ?>">
                            <div class="card-body text-center">
                                <div class="row border-bottom">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="font-weight-bolder">Nomor Invoice</label>
                                            <input type="text" name="nomor_invoice" id="nomor_invoice"
                                                value="<?php echo $income_dpb[0]->id_invoice; ?>"
                                                class="form-control form-control-lg" />
                                            <span class="form-text text-dark "><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Nomor Invoice</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="font-weight-bolder">Nomor Pembayaran</label>
                                            <input type="text" name="nomor_pembayaran" id="nomor_pembayaran"
                                                value="<?php echo $income_dpb[0]->nomor_siswa; ?>"
                                                class="form-control form-control-lg" />
                                            <input type="hidden" name="nomor_pembayaran_old"
                                                value="<?php echo $income_dpb[0]->nomor_siswa; ?>" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Nomor Pembayaran</span>

                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="font-weight-bolder">Total Nominal (Rp)</label>
                                            <input type="text" name="nominal_tagihan"
                                                value="<?php echo $income_dpb[0]->nominal_tagihan; ?>"
                                                class="form-control  form-control-lg" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Total Nominal</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="text-center">
                                            <label class="font-weight-bolder font-size-h6 ">Tahun Ajaran</label>
                                        </div>
                                        <p class="font-weight-boldest font-size-h1 text-info">
                                            <?php echo $income_dpb[0]->tahun_ajaran; ?></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="text-center">
                                            <label class="font-weight-bolder font-size-h6 ">Semester</label>
                                        </div>
                                        <p class="font-weight-boldest font-size-h1 text-info">
                                            <?php echo strtoupper($income_dpb[0]->semester); ?></p>
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
                                                    rows="2"><?php echo $income_dpb[0]->nama; ?></textarea>
                                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                    </b>isikan Nama Siswa</span>

                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label class="font-weight-bold">NIS</label>
                                                <input type="text" name="nis" readonly id="nis"
                                                    value="<?php echo $income_dpb[0]->nis; ?>"
                                                    class="input-reset form-control-solid  form-control form-control-lg" />
                                                <span class="form-text text-dark"><b class="text-dark">*OTOMATIS
                                                    </b></span>
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label class="font-weight-bold">Email</label>
                                                <input type="text" name="email"
                                                    value="<?php echo $income_dpb[0]->email; ?>"
                                                    class="input-reset  form-control form-control-lg" />
                                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                        DIISI
                                                    </b></span>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label class="font-weight-bold">Tingkat</label>
                                                <select name="level_tingkat" class="form-control form-control-lg">
                                                    <option value="<?php echo $income_dpb[0]->level_tingkat; ?>"
                                                        selected>
                                                        <?php
if ($income_dpb[0]->level_tingkat == '6') {
    echo 'DC';
} else if ($income_dpb[0]->level_tingkat == '1') {
    echo 'KB';
} else if ($income_dpb[0]->level_tingkat == '2') {
    echo 'TK';
} else if ($income_dpb[0]->level_tingkat == '3') {
    echo 'SD';
} else if ($income_dpb[0]->level_tingkat == '4') {
    echo 'SMP';
}
?>
                                                    </option>
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
                                                    value="<?php echo $income_dpb[0]->nama_kelas;?>"
                                                    class="input-reset  form-control form-control-lg" />
                                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                        DIISI
                                                    </b></span>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Nomor HP</label>
                                                <input type="text" name="nomor_hp"
                                                    value="<?php echo $income_dpb[0]->nomor_hp; ?>"
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
                                                <textarea class="form-control" name="rincian"
                                                    rows="2"><?php echo $income_dpb[0]->rincian; ?></textarea>
                                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                        DIISI, </b>isikan Rincian Tagihan (dilarang menghapus kata
                                                    atribut setelah ':', Contoh: Tagihan:, Buku:, dll)</span>

                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Tanggal Invoice</label>
                                                <input type="text" id="kt_datepicker_income" name="tanggal_invoice"
                                                    value="<?php echo $income_dpb[0]->tanggal_invoice; ?>"
                                                    class="form-control  form-control-lg" />
                                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                    </b>pilih Tanggal Invoice</span>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Nomor Jurnal Pembukuan</label>
                                                <input type="text" name="nama_wajib_pajak" readonly=""
                                                    value="<?php echo $income_dpb[0]->nomor_jurnal_pembukuan; ?>"
                                                    class="form-control form-control-solid form-control-lg" />
                                                <span class="form-text text-dark"><b class="text-dark">*OTOMATIS
                                                    </b></span>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Informasi</label>
                                                <textarea class="form-control" name="informasi"
                                                    rows="2"><?php echo $income_dpb[0]->informasi; ?></textarea>
                                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                        DIISI, </b>isikan Rincian Informasi (dilarang menghapus kata
                                                    atribut setelah ':', Contoh: Kelas:, Jalur:, dll)</span>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Catatan</label>
                                                <textarea class="form-control" name="catatan"
                                                    rows="2"><?php echo $income_dpb[0]->catatan; ?></textarea>
                                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                        DIISI, </b>isikan Catatan Tagihan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" mt-5 row border-bottom">
                                    <div class="col-lg-2 text-center">
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <div class="text-center">
                                            <label class="font-weight-bolder font-size-h6 ">Tipe Tagihan</label>
                                        </div>
                                        <?php if ($income_dpb[0]->tipe_tagihan == 2) {?>
                                        <p class="font-weight-boldest display-3 mb-1 text-warning text-center">DPB</p>
                                        <?php } elseif ($income_dpb[0]->tipe_tagihan == 1) {?>
                                        <p class="font-weight-boldest display-3 mb-1 text-success text-center">DU</p>
                                        <?php }?>
                                    </div>
                                    <div class="col-lg-3 text-center">
                                        <div class="text-center">
                                            <label class="font-weight-bolder font-size-h6 ">Chanel Pembayaran</label>
                                        </div>
                                        <p class="font-weight-boldest display-3 mb-1 text-warning text-center">
                                            <?php if ($income_dpb[0]->channel_pembayaran == "" || $income_dpb[0]->channel_pembayaran == null) {
    echo "-";
} else {
    echo strtoupper($income_dpb[0]->channel_pembayaran);
}?>
                                        </p>
                                    </div>
                                    <div class="col-lg-3 text-center">
                                        <div class="text-center">
                                            <label class="font-weight-bolder font-size-h6">Status Pembayaran</label>
                                        </div>
                                        <div class=" text-center ">
                                            <?php if ($income_dpb[0]->status_pembayaran == "MENUNGGU") {?>
                                            <p class="font-weight-boldest display-3 mb-1 text-warning text-center">
                                                MENUNGGU</p>
                                            <?php } else if ($income_dpb[0]->status_pembayaran == "SUKSES") {?>
                                            <p class="font-weight-boldest display-3 mb-1 text-success">SUKSES</p>
                                            <?php } else if ($income_dpb[0]->status_pembayaran == "GAGAL") {?>
                                            <p class="font-weight-boldest display-3 mb-1 text-danger">GAGAL</p>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                    </div>
                                </div>
                                <div class="mt-6 text-center" style="justify-content: center">
                                    <button class="btn btn-success btn-lg font-weight-bold mr-10"><i
                                            class="fas fa-check-circle "></i>KONFIRMASI PERUBAHAN</button>
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
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/edit-income-dpb.js"></script>
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

nomor_pembayaran.one('keyup', function() {
    Swal.fire({
        html: "<h3 class='text-danger font-weight-bolder'>MOHON DIPERHATIKAN!</h3><b>JIKA ANDA MENGUBAH BELAKANG NOMOR INVOICE MAKA SECARA OTOMATIS MENGUBAH NOMOR PEMBAYARAN DPB DAN NIS SISWA</b>",
        icon: "warning",
        buttonsStyling: false,
        confirmButtonText: "Oke!",
        customClass: {
            confirmButton: "btn font-weight-bold btn-danger"
        }
    }).then(function() {
        KTUtil.scrollTop();
    });
});
</script>
