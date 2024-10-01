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
                            <a href="" class="text-muted">Daftar Pemasukan DPB</a>
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
			<?php if ($this->session->flashdata('data_result')): echo $this->session->flashdata('data_result');endif;?>
            <!--end::Notice-->
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-primary font-weight-boldest">TOTAL SELURUH TAGIHAN</h3>
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest font-size-h1 mb-0 text-dark-75">
                                    Rp. <?php echo number_format($payment[0]->total_tagihan, 0, ',', '.'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-success font-weight-boldest">TOTAL TAGIHAN SUKSES</h3>
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest font-size-h1 mb-0 text-dark-75">
                                    Rp. <?php echo number_format($payment[0]->total_tagihan_sukses, 0, ',', '.'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-danger font-weight-boldest">TOTAL TAGIHAN MENUNGGU</h3>
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest font-size-h1 mb-0 text-dark-75 text-center">
                                    Rp. <?php echo number_format($payment[0]->total_tagihan_menunggu, 0, ',', '.'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Entry-->
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header pt-4 pb-1" style="justify-content: space-between">
                            <div class="card-toolbar">
                                <a href="#" data-toggle="modal" data-target="#modal_search_payment"
                                    class="btn btn-warning btn-md">
                                    <i class="flaticon2-search-1"></i>Cari Tagihan Siswa
                                </a>
                            </div>
                            <div class="card-title">
                                <h2 class="card-label font-size-h2 text-center font-weight-bolder">DAFTAR TAGIHAN SISWA
                                    DPB SEKOLAH
                                    <span class="text-warning pt-1 font-size-lg font-weight-bolder d-block">Berikut
                                        merupakan daftar tagihan/pemasukan DPB siswa Sekolah Utsman</span>
                                </h2>
                            </div>
                            <div class="card-toolbar">
                                <a href="<?php echo site_url('finance/income/add_income_dpb'); ?>"
                                    class="btn btn-success btn-md mr-5">
                                    <i class="flaticon-add"></i>Tambah Tagihan DPB
                                </a>
                                <a href="#" data-toggle="modal" data-target="#modal_import_payment"
                                    class="btn btn-primary btn-md">
                                    <i class="flaticon-upload"></i>Import Tagihan DPB
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-light  accordion-svg-toggle" id="accordionExample4">
                                <div class="card">
                                    <div class="card-header bg-success-o-50 pl-4" id="headingOne4">
                                        <div class="card-title text-dark-75" data-toggle="collapse"
                                            data-target="#collapseOne4">
                                            <i class="fas fa-search text-dark-75 "></i>Filter Pencarian Tabel (<b
                                                class="text-danger">"klik"</b>)
                                        </div>
                                    </div>
                                    <div id="collapseOne4" class="collapse " data-parent="#accordionExample4">
                                        <!--begin: Search Form-->
                                        <form class="mb-6 mt-4">
                                            <div class="row mb-6">
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Invoice:</label>
                                                    <input type="text" class="form-control datatable-input"
                                                        placeholder="Inputkan Invoice" data-col-index="1" />
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Tgl Invoice:</label>
                                                    <input type="text" id="kt_datepicker_invoice"
                                                        class="form-control datatable-input"
                                                        placeholder="Inputkan Tgl Invoice" data-col-index="2" />
                                                </div>
                                                <div class="col-lg-4 mb-lg-0 mb-6">
                                                    <label>Nama Siswa:</label>
                                                    <input type="text" class="form-control datatable-input"
                                                        placeholder="Inputkan Nama Siswa" data-col-index="3" />
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>No. Pembayaran:</label>
                                                    <input type="number" class="form-control datatable-input"
                                                        placeholder="Inputkan No Pembayaran" data-col-index="4" />
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Tingkat:</label>
                                                    <select class="form-control datatable-input" id="tingkat"
                                                        data-col-index="5">
                                                        <option value="">Pilih Tingkat</option>
                                                        <option value="6">DC</option>
                                                        <option value="1">KB</option>
                                                        <option value="2">TK</option>
                                                        <option value="3">SD</option>
                                                        <option value="4">SMP</option>
                                                        <option value="">Semua</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Status Transfer:</label>
                                                    <select class="form-control datatable-input" data-col-index="7">
                                                        <option value="">Pilih Status</option>
                                                        <option value="MENUNGGU">MENUNGGU</option>
                                                        <option value="PROSES">PROSES</option>
                                                        <option value="SUKSES">SUKSES</option>
                                                        <option value="GAGAL">GAGAL</option>
                                                        <option value="">Semua</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Tahun Ajaran:</label>
                                                    <select class="form-control datatable-input" data-col-index="8">
                                                        <option value="">Pilih Tahun Ajaran</option>
                                                        <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value) {
        if ($value->status_tahun_ajaran == 1) {
            ?>
                                                        <option value="<?php echo $value->id_tahun_ajaran; ?>" selected>
                                                            <?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?>
                                                        </option>
                                                        <?php
} else {
            ?>
                                                        <option value="<?php echo $value->id_tahun_ajaran; ?>">
                                                            <?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?>
                                                        </option>
                                                        <?php
}
    }
}
?>
                                                        <option value="">Semua</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Bulan:</label>
                                                    <select class="form-control datatable-input" data-col-index="10">
                                                        <option value="">Pilih Bulan</option>
                                                        <option value="1">Januari</option>
                                                        <option value="2">Februari</option>
                                                        <option value="3">Maret</option>
                                                        <option value="4">April</option>
                                                        <option value="5">Mei</option>
                                                        <option value="6">Juni</option>
                                                        <option value="7">Juli</option>
                                                        <option value="8">Agustus</option>
                                                        <option value="9">September</option>
                                                        <option value="10">Oktober</option>
                                                        <option value="11">November</option>
                                                        <option value="12">Desember</option>
                                                        <option value="">Semua</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Waktu Transaksi:</label>
                                                    <input type="text" id="kt_datepicker_transaksi" readonly=""
                                                        class="form-control datatable-input"
                                                        placeholder="Inputkan Tgl Transaksi" data-col-index="11" />
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Nominal Tagihan:</label>
                                                    <input type="text" class="form-control datatable-input"
                                                        placeholder="Inputkan Nominal" data-col-index="12" />
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
                                                        <button class="btn btn-warning font-weight-bold dropdown-toggle"
                                                            type="button" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="true">
                                                            <i class="flaticon2-download"></i>
                                                            Export
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <form class="form" id="frm-excel"
                                                                action="<?php echo site_url('//'); ?>" method="POST">
                                                                <input type="text" id="id_check_excel"
                                                                    class="form-control" value="" name="data_check"
                                                                    style="display:none">
                                                                <button class="dropdown-item" role="button"
                                                                    type="submit"><i class="flaticon2-checking"></i>
                                                                    Laporan .csv</button>
                                                            </form>
                                                            <form class="form" id="frm-form"
                                                                action="<?php echo site_url('//'); ?>" method="POST">
                                                                <input type="text" id="id_check_form"
                                                                    class="form-control" value="" name="data_check"
                                                                    style="display:none">
                                                                <button class="dropdown-item" role="button"
                                                                    type="submit"><i class="flaticon-doc"></i> Laporan
                                                                    .pdf</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--begin: Datatable-->
                            <table class="table table-separate table-hover table-light-primary table-checkable"
                                id="kt_datatable_income_dpb">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Invoice</th>
                                        <th>Tgl Invoice</th>
                                        <th>Nama Siswa</th>
                                        <th>No. Pembayaran</th>
                                        <th>Tingkat</th>
                                        <th>Kelas</th>
                                        <th>Status</th>
                                        <th>TA</th>
                                        <th>Rincian Tagihan</th>
                                        <th>Bulan</th>
                                        <th>Waktu Transaksi</th>
                                        <th>Nominal Tagihan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
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
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="font-weight-boldest text-dark"><b>TOTAL TAGIHAN</b></th>
                                        <th class="font-weight-boldest text-danger">Rp. 0</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!--end: Datatable-->
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
<div class="modal fade" id="modal_search_payment" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true"
    role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Daftar Tagihan DPB Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" method="POST"
                action="<?php echo site_url('finance/income/income/search_student_payment_dpb'); ?>"
                enctype="multipart/form-data" id="kt_search_payment">
                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label>Nomor Pembayaran DPB Siswa</label>
                                <input type="text" name="nomor_pembayaran_dpb"
                                    class="form-control form-control-solid form-control-lg "
                                    placeholder="Inputkan Nomor Pembayaran DPB Siswa">
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>Inputkan
                                    Nomor Pembayaran DPB Siswa</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success font-weight-bold mr-2">Cari</button>
                    <button type="reset" class="btn btn-light-danger font-weight-bold"
                        data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_import_payment" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true"
    role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document" id="kt_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Tagihan Siswa DPB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" method="POST"
                action="<?php echo site_url('finance/income/income/import_dpb_payment'); ?>"
                enctype="multipart/form-data" id="kt_upload_payment_dpb">
                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label>Upload File Excel Tagihan</label>
                                <input type="file" class="dropify_import form-control" name="file_tagihan_dpb"
                                    data-max-file-size="10M" data-height="200"
                                    data-allowed-file-extensions="xls xlsx" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>format xls,
                                    xlsx dan ukuran < 10Mb</span>
                            </div>
                        </div>
                        <!--begin::Action-->
                        <div class="col-xl-12">
                            <div class="form-group text-center">
                                <div class="g-recaptcha"
                                    data-sitekey="<?php echo $this->config->item('google_site_key') ?>"></div>
                            </div>
                        </div>
                        <!--begin::Action-->
                        <div class="col-xl-2 text-center"></div>
                        <div class="col-xl-8 text-center">
                            <div class="form-group">
                                <label>Password Anda</label>
                                <input type="password" name="pass_verification"
                                    class="form-control form-control-solid form-control-lg "
                                    placeholder="Inputkan Password Anda">
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>Inputkan
                                    Password Anda</span>
                            </div>
                        </div>
                        <div class="col-xl-2 text-center"></div>
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
<!--end::Content-->
<script
    src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/crud/forms/validation/form-controls-search-payment_dpb.js">
</script>
<script
    src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/crud/datatables/search-options/budget-income-dpb-server.js">
</script>
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
<script>
function act_delete_income(id, name, nis) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

    Swal.fire({
        title: "Peringatan!",
        html: "Apakah anda yakin ingin <b>MENGHAPUS</b> Tagihan DPB atas Nama <b>" + name.toUpperCase() + " (" +
            nis + ")</b> ?",
        icon: "warning",
        input: 'password',
        inputLabel: 'Password Anda',
        inputPlaceholder: 'Masukkan password Anda',
        inputAttributes: {
            'aria-label': 'Masukkan password Anda'
        },
        inputValidator: (value) => {
            if (!value) {
                return 'Password Anda diperlukan!'
            }
        },
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Tidak, batal!",
        closeOnConfirm: false,
        closeOnCancel: true
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                type: "post",
                url: "<?php echo site_url("/finance/income/income/delete_income_dpb") ?>",
                data: {
                    id: id,
                    password: result.value,
                    [csrfName]: csrfHash
                },
                dataType: 'json',
                success: function(data) {
                    $('.txt_csrfname').val(data.token);

                    if (data.status) {
                        Swal.fire({
                            html: data.messages,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Oke!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-success"
                            }
                        }).then(function() {
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        });
                    } else {
                        Swal.fire({
                            html: data.messages,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Oke!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-danger"
                            }
                        }).then(function() {
                            KTUtil.scrollTop();
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                    Swal.fire("Opsss!", "Koneksi Internet Bermasalah.", "error");
                }
            });

        } else {
            Swal.fire("Dibatalkan!", "Tagihan DPB atas Nama <b>" + name.toUpperCase() + " (" + nis +
                ")</b> batal dihapus.", "error");
        }
    });
}
</script>
