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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Anggaran</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Upload Bukti Anggaran</a>
                        </li>                       
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="top">
                <a onclick="window.history.back();" class="btn btn-light-danger btn-sm font-weight-bold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-backward"></i>Kembali</a>           
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
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-success font-weight-bolder">DANA ACC</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50">
                                    <?php if ($budget[0]->nominal_dana_acc == NULL || $budget[0]->nominal_dana_acc == "") { ?>
                                        Rp. 0
                                    <?php } else { ?>
                                        Rp. <?php echo number_format($budget[0]->nominal_dana_acc, 0, ',', '.'); ?>
                                    <?php } ?>
                                </p>
                            </div>    

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-primary font-weight-bolder">DANA EKSTERNAL</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50">
                                    <?php if ($budget[0]->nominal_dana_eksternal == NULL || $budget[0]->nominal_dana_eksternal == "") { ?>
                                        Rp. 0
                                    <?php } else { ?>
                                        Rp. <?php echo number_format($budget[0]->nominal_dana_eksternal, 0, ',', '.'); ?>
                                    <?php } ?>
                                </p>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-warning font-weight-bolder">DANA TERPAKAI</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50">
                                    <?php if ($budget[0]->nominal_dana_terpakai == NULL || $budget[0]->nominal_dana_terpakai == "") { ?>
                                        Rp. 0
                                    <?php } else { ?>
                                        Rp. <?php echo number_format($budget[0]->nominal_dana_terpakai, 0, ',', '.'); ?>
                                    <?php } ?>
                                </p>
                            </div>    

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-danger font-weight-bolder">DANA SISA</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50">
                                    <?php if ($budget[0]->nominal_dana_sisa == NULL || $budget[0]->nominal_dana_sisa == "") { ?>
                                        Rp. 0
                                    <?php } else { ?>
                                        Rp. <?php echo number_format($budget[0]->nominal_dana_sisa, 0, ',', '.'); ?>
                                    <?php } ?>
                                </p>    
                            </div>    

                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card card-custom">
                        <div class="card-body align-items-center ">
                            <div class="d-flex align-items-center flex-wrap">
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon-notepad icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">NAMA ANGGARAN PROPOSAL</span>
                                        <span class="font-weight-bolder font-size-h6 text-success">
                                            <?php echo ucwords(strtolower($budget[0]->nama_anggaran)); ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-avatar icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">PEMOHON ANGGARAN</span>
                                        <span class="font-weight-bolder font-size-h6 text-success">
                                            <?php echo ucwords(strtolower($budget[0]->nama_struktur)); ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon-price-tag icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">DANA DIAJUKAN</span>
                                        <span class="font-weight-bolder font-size-h6 text-success">
                                            <?php if ($budget[0]->nominal_dana_awal == NULL || $budget[0]->nominal_dana_awal == "") { ?>
                                                Rp. 0
                                            <?php } else { ?>
                                                Rp. <?php echo number_format($budget[0]->nominal_dana_awal, 0, ',', '.'); ?>
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-chronometer icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">WAKTU ANGGARAN</span>
                                        <span class="font-weight-bolder font-size-h5 text-success">
                                            <?php echo substr($budget[0]->waktu, 3); ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-calendar icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">TAHUN AJARAN</span>
                                        <span class="font-weight-bolder font-size-h5 text-success">
                                            <?php echo (($budget[0]->tahun_ajaran)); ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->

                            </div>
                            <!--begin::Separator-->
                            <div class="separator separator-solid my-7"></div>
                            <!--end::Separator-->
                            <div class="d-flex align-items-center flex-wrap">
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-bell icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">STATUS PROPOSAL</span>
                                        <span class="font-weight-bolder font-size-h5">
                                            <?php if ($budget[0]->status_acc_proposal == 0) { ?>
                                                <b class="text-warning"> DIPROSES </b>
                                            <?php } else if ($budget[0]->status_acc_proposal == 1) { ?>
                                                <b class="text-warning"> DIPROSES* </b>
                                            <?php } else if ($budget[0]->status_acc_proposal == 2) { ?>
                                                <b class="text-success"> DITERIMA </b>
                                            <?php } else if ($budget[0]->status_acc_proposal == 3) { ?>
                                                <b class="text-danger"> DITOLAK </b>
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-bell icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">STATUS LPJ</span>
                                        <span class="font-weight-bolder font-size-h5 text-success">
                                            <?php if ($budget[0]->status_acc_lpj == 0) { ?>
                                                <b class="text-dark-50"> MENUNGGU </b>
                                            <?php } else if ($budget[0]->status_acc_lpj == 1) { ?>
                                                <b class="text-warning"> DIPROSES </b>
                                            <?php } else if ($budget[0]->status_acc_lpj == 2) { ?>
                                                <b class="text-success"> DITERIMA </b>
                                            <?php } else if ($budget[0]->status_acc_lpj == 3) { ?>
                                                <b class="text-danger"> DITOLAK </b>
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-calendar icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">TANGGAL PENGAJUAN PROP</span>
                                        <span class="font-weight-bolder font-size-h5 text-success">
                                            <?php echo (($budget[0]->tanggal_pengajuan_prop)); ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-calendar icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">TANGGAL ACC PROPOSAL</span>
                                        <span class="font-weight-bolder font-size-h5 text-success">
                                            <?php if ($budget[0]->tanggal_persetujuan_prop == NULL || $budget[0]->tanggal_persetujuan_prop == "") { ?>
                                                <b class="text-dark-50"> MENUNGGU</b>
                                            <?php } else { ?>
                                                <?php echo $budget[0]->tanggal_persetujuan_prop; ?>
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-calendar icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">TANGGAL PENGAJUAN LPJ</span>
                                        <span class="font-weight-bolder font-size-h5 text-success">
                                            <?php if ($budget[0]->tanggal_pengajuan_lp == NULL || $budget[0]->tanggal_pengajuan_lp == "") { ?>
                                                <b class="text-dark-50"> MENUNGGU</b>
                                            <?php } else { ?>
                                                <?php echo $budget[0]->tanggal_persetujuan_prop; ?>
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-calendar icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">TANGGAL ACC LPJ</span>
                                        <span class="font-weight-bolder font-size-h5 text-success">
                                            <?php if ($budget[0]->tanggal_persetujuan_lp == NULL || $budget[0]->tanggal_persetujuan_lp == "") { ?>
                                                <b class="text-dark-50"> MENUNGGU</b>
                                            <?php } else { ?>
                                                <?php echo $budget[0]->tanggal_persetujuan_lp; ?>
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                                <!--end: Item-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-custom mb-5 mt-8">
                        <div class="card-body py-4 mt-4 text-center">
                            <h3 class="card-label text-dark font-weight-boldest d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap mt-1">Upload Bukti Anggaran</h3>
                            <div class="form-group">
                                <label class="control-label"></label>
                                <div class="form-group">
                                    <div class="dropzone dropzone-default dropzone-warning" id="my-dropzone">
                                        <div class="dropzone-msg dz-message needsclick">
                                            <h3 class="dropzone-msg-title">Letakan file disini atau Kilk untuk upload.</h3>
                                            <span class="dropzone-msg-desc">
                                                <b class="text-danger">*TIDAK WAJIB </b>diisi, "MAX upload 10 file berformat jpg, png, jpeg, dan berukuran dibawah 5Mb"
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="kt_login_signin_submit" class="btn btn-success font-weight-bold px-9 py-4 my-3 mx-4">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
</div>

<!--end::Content-->
<script>
    $("#iframe").contents().find("body").append('<div style="font-family: Poppins, Helvetica, sans-serif; text-align:center; color:#7E8299;"><b>MENUNGGU...</b></div>');
</script>

<script>
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#my-dropzone", {
        url: "<?php echo site_url("finance/budget/upload") ?>",
        acceptedFiles: "image/*",
        autoProcessQueue: false,
        maxFilesize: 3,
        maxFiles: 10,
        parallelUploads: 5,
        paramName: "file",
        addRemoveLinks: true,
        removedfile: function (file) {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Apakah anda yakin ingin mengahapus Gambar ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Tidak, batal!",
                closeOnConfirm: false,
                closeOnCancel: false,
                preConfirm: () => {
                    var name = file.name;
                    console.log(name);
                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url("finance/budget/remove") ?>",
                        data: {file: name},
                        dataType: 'html',
                        success: function (result) {
                            Swal.fire("Terhapus!", " Bukti telah terhapus.", "success");
                            // remove the thumbnail
                            var previewElement;
                            return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);

                        },
                        error: function (result) {
                            Swal.fire("Opsss!", "Tidak Ada Koneksi Internet.", "error");
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then(function (result) {
                if (!result.isConfirmed) {
                    Swal.fire("Dibatalkan!", "Hapus Bukti dibatalkan.", "error");
                }
            });
        },
        init: function () {
            var me = this;
            $.get("<?php echo site_url("finance/budget/list_files/" . $budget[0]->token) ?>", function (data) {
                // if any files already in server show all here
                if (data.length > 0) {
                    $.each(data, function (key, value) {
                        var mockFile = value;
                        me.emit("addedfile", mockFile);
                        me.emit("thumbnail", mockFile, "<?php echo base_url(); ?>uploads/recipe/images/thumbs/" + value.name);
                        me.emit("complete", mockFile);
                    });
                }
            });
        }
    });
    //Event ketika Memulai mengupload
    myDropzone.on("sending", function (a, b, c) {
        a.token = "<?php echo $budget[0]->token; ?>";
        c.append("token", a.token); //Menmpersiapkan token untuk masing masing foto
    });
    $('#kt_login_signin_submit').click(function () {
        myDropzone.processQueue();
    });

</script>