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
                            <a href="" class="text-muted">Detail DPB Siswa</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->

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
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header pt-4 pb-1" style="justify-content: center">
                            <div class="card-title">
                                <h2 class="card-label font-size-h1 text-center font-weight-bolder text-danger">
                                    KONFIRMASI IMPOR DATA TAGIHAN DPB SEKOLAH
                                    <span class="text-dark-75 pt-1 font-size-h6 font-weight-bold d-block">Berikut
                                        merupakan hasil impor tagihan DPB siswa Sekolah Utsman</span>
                                </h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-success text-center font-weight-bolder " role="alert">
                                Data Import Pembayaran DPB Yang Akan Terinput Ke Dalam Database Tanpa Duplikat
                            </div>
                            <!--begin: Datatable-->
                            <table class="table table-separate table-hover table-light-success table-checkable"
                                id="kt_datatable_income_dpb_invoice_success">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID Invoice</th>
                                        <th>No. Bayar</th>
                                        <th>Nama</th>
                                        <th>Tgl Invoice</th>
                                        <th>Tingkat</th>
                                        <th>Kelas</th>
                                        <th>Rincian</th>
                                        <th>Total Nominal</th>
                                        <th>Status Transaksi</th>
                                        <th>TA</th>
                                        <th>Bulan</th>
                                        <th>Status No Bayar</th>
                                        <th>Status Nama</th>
                                        <th>Status Invoice</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
										$nama_tingkat = '';
										if (!empty($income_dpb)) {
											foreach ($income_dpb as $key => $value) {

												if ($value->level_tingkat == '6') {
													$nama_tingkat = 'DC';
												} else if ($value->level_tingkat == '1') {
													$nama_tingkat = 'KB';
												} else if ($value->level_tingkat == '2') {
													$nama_tingkat = 'TK';
												} else if ($value->level_tingkat == '3') {
													$nama_tingkat = 'SD';
												} else if ($value->level_tingkat == '4') {
													$nama_tingkat = 'SMP';
												}
												?>
                                    <tr>
                                        <td>
                                            <?php echo $value->id_tagihan_pembayaran; ?>
                                        </td>
                                        <td class="font-weight-bolder">
                                            <?php echo $value->id_invoice; ?>
                                        </td>
                                        <td class="font-weight-bolder text-warning">
                                            <?php echo ($value->nomor_siswa); ?></td>
                                        <td class="font-weight-bolder">
                                            <?php echo strtoupper(strtolower($value->nama)); ?>
                                        </td>
                                        <td class="font-weight-bolder text-danger">
                                            <?php echo $value->tanggal_invoice; ?></td>
                                        <td class="font-weight-bolder"><?php echo (($nama_tingkat)); ?></td>
                                        <td class="font-weight-bolder">
                                            <?php $tingkat = explode(":", $value->informasi);
        									echo substr($tingkat[1], 0, -1);?>
                                        </td>
                                        <td class="font-weight-bold">
                                            <?php echo strtoupper(strtolower(substr($value->rincian, 0, -1))); ?></td>
                                        <td class="font-weight-bolder">
                                            <?php echo number_format($value->nominal_tagihan, 0, ',', '.'); ?></td>
                                        <td><?php echo $value->status_pembayaran; ?></td>
                                        <td class="font-weight-bolder"><?php echo $value->tahun_ajaran; ?></td>
                                        <td class="font-weight-bolder">
                                            <?php echo strtoupper(bulanindo($value->bulan_invoice)); ?></td>
                                        <td><?php echo $value->status_nomor_terdaftar; ?></td>
                                        <td><?php echo $value->status_nama_duplikat; ?></td>
                                        <td><?php echo $value->status_invoice_duplikat; ?></td>
                                        <td nowrap="nowrap">
                                            <div class="dropdown dropdown-inline">
                                                <a href="javascript:;"
                                                    class="btn btn-xs  btn-clean btn-icon btn-outline-primary"
                                                    data-toggle="dropdown">
                                                    <i class="la la-cog"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <ul class="nav nav-hover flex-column">
                                                        <li class="nav-item"><a class="nav-link"
                                                                href="<?php echo site_url("/finance/income/detail_income_dpb/" . paramEncrypt($value->id_tagihan_pembayaran)); ?>"><i
                                                                    class="nav-icon fas fa-eye"></i><span
                                                                    class="nav-text text-hover-primary font-weight-bold">Lihat
                                                                    Detail</span></a></li>
                                                    </ul>
                                                    <ul class="nav nav-hover flex-column">
                                                        <li class="nav-item"><a
                                                                data-id_tagihan="<?php echo paramEncrypt($value->id_tagihan_pembayaran); ?>"
                                                                data-id_invoice="<?php echo $value->id_invoice; ?>"
                                                                data-nomor_bayar="<?php echo $value->nomor_siswa; ?>"
                                                                data-nama="<?php echo $value->nama; ?>"
                                                                data-tanggal_invoice="<?php echo $value->tanggal_invoice; ?>"
                                                                data-level_tingkat="<?php echo $value->level_tingkat; ?>"
                                                                data-informasi="<?php echo $value->informasi; ?>"
                                                                data-rincian="<?php echo $value->rincian; ?>"
                                                                data-nominal_tagihan="<?php echo $value->nominal_tagihan; ?>"
                                                                data-id_tahun_ajaran="<?php echo $value->th_ajaran; ?>"
                                                                data-tahun_ajaran="<?php echo $value->tahun_ajaran; ?>"
                                                                data-nomor_hp="<?php echo $value->nomor_hp; ?>"
                                                                data-email="<?php echo $value->email; ?>"
                                                                data-status_nomor_terdaftar="<?php echo $value->status_nomor_terdaftar; ?>"
                                                                data-status_nama_duplikat="<?php echo $value->status_nama_duplikat; ?>"
                                                                data-status_invoice_duplikat="<?php echo $value->status_invoice_duplikat; ?>"
                                                                class="nav-link edit_income_transition_dpb text-warning"
                                                                href="javascript:void(0);"><i
                                                                    class="nav-icon fas fa-pen text-warning"></i><span
                                                                    class="nav-text text-hover-primary font-weight-bold text-warning">Edit
                                                                    Tagihan</span></a></li>
                                                    </ul>
                                                    <ul class="nav nav-hover flex-column">
                                                        <li class="nav-item"><a
                                                                data-id_tagihan="<?php echo paramEncrypt($value->id_tagihan_pembayaran); ?>"
                                                                data-id_invoice="<?php echo $value->id_invoice; ?>"
                                                                data-nomor_bayar="<?php echo $value->nomor_siswa; ?>"
                                                                data-nama="<?php echo $value->nama; ?>"
                                                                data-nominal_tagihan="<?php echo $value->nominal_tagihan; ?>"
                                                                class="nav-link delete_income_transition_dpb"
                                                                href="javascript:void(0);"><i
                                                                    class="nav-icon fas fa-trash text-danger"></i><span
                                                                    class="nav-text text-danger font-weight-bold text-hover-primary">Hapus
                                                                    Tagihan</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
} //ngatur nomor urut
}
?>
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
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!--end: Datatable-->
                            <div class="pb-1 text-center" style="justify-content: center">
                                <button onclick="act_confirm_data_payment()"
                                    class="btn btn-success btn-lg font-weight-bold mr-10"><i
                                        class="fas fa-check-circle "></i>KONFIRMASI DATA TAGIHAN</button>
                                <button onclick="act_reject_data_payment()"
                                    class="btn btn-danger btn-lg font-weight-bold ml-10"><i
                                        class="fas fa-window-close"></i>BATALKAN DATA TAGIHAN</button>
                            </div>
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
<!--end::Content-->
<!-- Modal Edit DPB  -->
<div class="modal fade" tabindex="" role="dialog" id="modalEditDPBTransition">
    <div class="modal-dialog modal-xl" role="document" id="kt_form_dpb_transition_edit">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title font-weight-bolder">Edit Data Tagihan DPB Siswa <b
                        id="nomorTransaksiKreditEdit"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <form class="form needs-validation" method="POST" enctype="multipart/form-data" novalidate="novalidate"
                id="kt_edit_income_dpb_transaction">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <input type="hidden" class="hidden" name="id_tagihan">
                    <div class="row">
                        <div class="form-group col-3">
                            <label> ID Invoice</label>
                            <input type="text" name="id_invoice" class="form-control form-control-lg"
                                placeholder="Inputkan ID Invoice" />
                            <input type="hidden" class="hidden" name="old_id_invoice">
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> isikan ID Invoice
                                Tagihan</span>
                        </div>
                        <div class="form-group col-3">
                            <label> Nomor Bayar</label>
                            <input type="text" name="nomor_bayar" class="form-control form-control-lg"
                                placeholder="Inputkan Nomor Bayar" />
                            <input type="hidden" class="hidden" name="old_nomor_bayar">
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> isikan Nomor
                                Bayar Tagihan</span>
                        </div>
                        <div class="form-group col-6">
                            <label> Nama Tertagih</label>
                            <input type="text" name="nama" class="form-control form-control-lg"
                                placeholder="Inputkan Nama Tertagih" />
                            <input type="hidden" class="hidden" name="old_nama">
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> isikan Nama
                                Tertagih</span>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tanggal Invoice</label>
                                <input type="text" name="tanggal_invoice"
                                    class="form-control form-control-lg kt_datepicker_kredit_edit"
                                    placeholder="Inputkan Tanggal Invoice" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Tanggal
                                    Invoice</span>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label> Total Nominal </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bolder">
                                        Rp
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-lg" name="nominal_tagihan"
                                    placeholder="Input Nominal" />
                            </div>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> isikan
                                nominal</span>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="tahun_ajaran" class="form-control form-control-lg">
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
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,</b> Pilih
                                    TA</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="level_tingkat" class="form-control form-control-lg">
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
                        <div class="col-lg-8 ">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label> Email </label>
                                    <input type="text" name="email" class="form-control form-control-lg"
                                        placeholder="Inputkan Email" />
                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b>
                                        isikan
                                        Email</span>
                                </div>
                                <div class="form-group col-6">
                                    <label> Nomor Handphone </label>
                                    <input type="text" name="nomor_hp" class="form-control form-control-lg"
                                        placeholder="Inputkan Nomor Handphone" />
                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b>
                                        isikan Nomor
                                        Handphone</span>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Informasi Tagihan</label>
                                        <textarea class="form-control" placeholder="Isikan Informasi Tagihan"
                                            name="informasi" rows="2"></textarea>
                                        <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,
                                            </b>Isikan
                                            Informasi Tagihan</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <textarea class="form-control" placeholder="Isikan Catatan" name="catatan"
                                            value="" rows="2"></textarea>
                                        <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,
                                            </b>Isikan
                                            Catatan Kredit singkat</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Rincian Tagihan</label>
                                <textarea class="form-control" placeholder="Isikan Informasi Tagihan" name="rincian"
                                    rows="8"></textarea>
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>Isikan
                                    Rincian Tagihan</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>-- INFORMASI --</b>
                            </div>
                            <div class="mt-5 row">
                                <div class="col-lg-4 text-center">
                                    <div class="text-center">
                                        <label class="font-weight-bolder font-size-h6 ">Status Nomor Bayar</label>
                                    </div>
                                    <div id="status_nomor_bayar">
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <div class="text-center">
                                        <label class="font-weight-bolder font-size-h6 ">Status Nama Tertagih</label>
                                    </div>
                                    <div id="status_nama">
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <div class="text-center">
                                        <label class="font-weight-bolder font-size-h6">Status Nomor Invoice</label>
                                    </div>
                                    <div id="status_nomor_invoice">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="modal_dpb">

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
<!-- End of Modal DPB  -->

<script
    src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/crud/datatables/search-options/budget-income-dpb-transition.js">
</script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/income-dpb-transition.js">
</script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/edit-income-dpb-transition.js">
</script>
<script>
function act_confirm_data_payment() {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val(); // CSRF hash
    var rows_selected = $("#kt_datatable_income_dpb_invoice_success").DataTable().column(0).checkboxes.selected();

    Swal.fire({
        title: "Peringatan!",
        html: "Apakah anda yakin ingin <b>MENYETUJUI</b> Impor Data Tagihan DPB ini?",
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
        confirmButtonColor: "#1BC5BD",
        confirmButtonText: "Ya, Setuju!",
        cancelButtonText: "Tidak, Nanti saja!",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true,
        preConfirm: (text) => {
            return $.ajax({
                type: "post",
                url: "<?php echo site_url("finance/income/income/accept_import_payment_dpb") ?>",
                data: {
                    data_check: rows_selected.join(","),
                    password: text,
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
                                window.location.replace(
                                    `${HOST_URL}/finance/income/income/list_income_dpb`
                                );
                            }, 1000);
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
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then(function(data) {
        if (!data.isConfirm) {
            Swal.fire("Dibatalkan!", "Persetujuan Impor Data Tagihan DPB telah dibatalkan.", "error");
        }
    });
}

function act_reject_data_payment(id, name) {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

    Swal.fire({
        title: "Peringatan!",
        html: "Apakah anda yakin ingin <b>MEMBATALKAN</b> Impor Data Tagihan DPB ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Batalkan!",
        cancelButtonText: "Tidak, Nanti saja!",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
        closeOnCancel: true,
        preConfirm: (text) => {
            return $.ajax({
                type: "post",
                url: "<?php echo site_url("finance/income/income/reject_import_payment_dpb") ?>",
                data: {
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
                                window.location.replace(
                                    `${HOST_URL}/finance/income/income/list_income_dpb`
                                );
                            }, 1000);
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
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then(function(data) {
        if (!result.isConfirm) {
            Swal.fire("Dibatalkan!", "Pembatalan Impor Data Tagihan DPB telah dibatalkan.", "error");
        }
    });
}
</script>
