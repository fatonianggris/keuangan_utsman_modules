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
                            <a href="" class="text-muted">Upload LPJ Anggaran</a>
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
                            <h3 class="card-label text-primary font-weight-bolder">DANA ACC</h3>
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
                            <h3 class="card-label text-success font-weight-bolder">DANA EKSTERNAL</h3>
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
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8 mt-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark font-weight-boldest d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap mt-1">FILE PROPOSAL</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-7 text-center" >
                                <?php if ($budget[0]->file_laporan_proposal != NULL || $budget[0]->file_laporan_proposal != "") { ?>
                                    <iframe src="<?php echo base_url() . $budget[0]->file_laporan_proposal; ?>#zoom=75" width="100%" height="500"></iframe>
                                <?php } else { ?>
                                    <iframe id="iframe" width="100%" height="500" ></iframe>
                                <?php } ?>
                            </div>  
                            <?php if ($budget[0]->file_laporan_proposal_acc != NULL || $budget[0]->file_laporan_proposal_acc != "") { ?>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-md font-weight-bold mt-7" data-toggle="modal" data-target="#modal_rev_proposal"><i class="fa fa-signature"></i>Proposal Acc</button>
                                </div>
                            <?php } else { ?>
                                <div class="text-center">
                                    <button class="btn btn-bg-light btn-light-dark btn-md font-weight-bold mt-7" disabled=""><i class="fa fa-signature"></i>Di Proses</button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8 mt-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark font-weight-boldest d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">FILE LPJ 
                                <?php if ($budget[0]->status_acc_lpj == 0) { ?>
                                    <a onclick="act_upload_lpj('<?php echo paramEncrypt($budget[0]->id_anggaran); ?>', '<?php echo strtoupper($budget[0]->nama_anggaran); ?>')" class="btn btn-success font-weight-bolder btn-sm"><i class="fas fa-upload"></i>Upload LPJ</a>
                                <?php } else if ($budget[0]->status_acc_lpj == 1) { ?>
                                    <a onclick="act_edit_lpj('<?php echo paramEncrypt($budget[0]->id_anggaran); ?>', '<?php echo strtoupper($budget[0]->nama_anggaran); ?>')" class="btn btn-warning font-weight-bolder btn-sm"><i class="fas fa-edit"></i>Edit LPJ</a>
                                <?php } else if ($budget[0]->status_acc_lpj == 3) { ?>
                                    <a onclick="act_edit_lpj('<?php echo paramEncrypt($budget[0]->id_anggaran); ?>', '<?php echo strtoupper($budget[0]->nama_anggaran); ?>')" class="btn btn-warning font-weight-bolder btn-sm"><i class="fas fa-edit"></i>Revisi LPJ</a>
                                <?php } ?>
                            </h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <?php if ($budget[0]->file_laporan_lpj != NULL || $budget[0]->file_laporan_lpj != "") { ?>
                                    <iframe src="<?php echo base_url() . $budget[0]->file_laporan_lpj; ?>#zoom=75" width="100%" height="500"></iframe>
                                <?php } else { ?>
                                    <iframe id="iframe" width="100%" height="500" ></iframe>
                                <?php } ?>
                            </div>   
                            <?php if ($budget[0]->file_laporan_lpj_acc != NULL || $budget[0]->file_laporan_lpj_acc != "") { ?>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-md font-weight-bold mt-7" data-toggle="modal" data-target="#modal_rev_lpj"><i class="fa fa-signature"></i>LPJ Acc</button>
                                </div>
                            <?php } else { ?>
                                <div class="text-center">
                                    <button class="btn btn-bg-light btn-light-dark btn-md font-weight-bold mt-7" disabled=""><i class="fa fa-signature"></i>Di Proses</button>
                                </div>
                            <?php } ?>
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
<div class="modal fade" id="modal_rev_proposal" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proposal ACC "<?php echo strtoupper($budget[0]->nama_anggaran); ?>"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <?php if ($budget[0]->file_laporan_proposal_acc != NULL || $budget[0]->file_laporan_proposal_acc != "") { ?>
                    <iframe src="<?php echo base_url() . $budget[0]->file_laporan_proposal_acc; ?>#zoom=85" width="100%" height="500"></iframe>
                <?php } else { ?>
                    <iframe id="iframe" width="100%" height="500" ></iframe>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_rev_lpj" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">LPJ ACC "<?php echo strtoupper($budget[0]->nama_anggaran); ?>"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <?php if ($budget[0]->file_laporan_lpj_acc != NULL || $budget[0]->file_laporan_lpj_acc != "") { ?>
                    <iframe src="<?php echo base_url() . $budget[0]->file_laporan_lpj_acc; ?>#zoom=85" width="100%" height="500"></iframe>
                <?php } else { ?>
                    <iframe id="iframe" width="100%" height="500" ></iframe>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal-file fade" id="modal_proposal" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">File Proposal "<?php echo strtoupper($budget[0]->nama_anggaran); ?>"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <?php if ($budget[0]->file_laporan_proposal != NULL || $budget[0]->file_laporan_proposal != "") { ?>
                    <iframe src="<?php echo base_url() . $budget[0]->file_laporan_proposal; ?>#zoom=85" width="100%" height="500"></iframe>
                <?php } else { ?>
                    <iframe id="iframe" width="100%" height="500" ></iframe>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->
<script>
    $("#iframe").contents().find("body").append('<div style="font-family: Poppins, Helvetica, sans-serif; text-align:center; color:#7E8299;"><b>MENUNGGU...</b></div>');
</script>
<script>

    function act_upload_lpj(id, name) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            icon: "warning",
            html: `<div>Apakah anda yakin ingin MENGUPLOAD LPJ "` + name + `"?</div>
                   <label class=" mt-5">Nama LPJ (wajib)</label>
                   <textarea id="nama_lpj" class="form-control form-control-lg-swal" placeholder="Inputkan Nominal Dana Terpakai"> </textarea>
                   <label class=" mt-5">Nominal Dana Terpakai (wajib)</label>
                   <input type="number" id="nominal_terpakai" class="form-control form-control-lg-swal" placeholder="Inputkan Nominal Dana Terpakai">
                   <label class=" mt-5">Nominal Dana Eksternal (*jika ada wajib diisi)</label>
                   <input type="number" id="nominal_eks" value="0" class="form-control form-control-lg-swal" placeholder="Inputkan Nominal Dana Eksternal">                                    
                   <label class=" mt-5">Upload File LPJ (wajib)</label>            
                   <input type="file" id="file_lpj" class="form-control form-control-lg-swal mb-5 " placeholder="Inputkan File LPJ">`,
            showCancelButton: true,
            confirmButtonColor: "#1BC5BD",
            confirmButtonText: "Ya, Upload!",
            cancelButtonText: "Tidak, Batal!",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: false,
            preConfirm: () => {
                const nama_lpj = Swal.getPopup().querySelector('#nama_lpj').value;
                const nominal_terpakai = Swal.getPopup().querySelector('#nominal_terpakai').value;
                const nominal_eks = Swal.getPopup().querySelector('#nominal_eks').value;
                const file = Swal.getPopup().querySelector('#file_lpj').files[0];

                if (nominal_terpakai && nama_lpj) {
                    if (file) {

                        var val = file.name;
                        var file_type = val.substr(val.lastIndexOf('.')).toLowerCase();
                        var formData = new FormData();

                        if (file_type !== '.pdf') {
                            Swal.showValidationMessage(`File harus berformat pdf!`);
                        } else if (file.size >= 25097152) {
                            Swal.showValidationMessage(`File harus berukuran < 5Mb!`);
                        } else {
                            formData.append("id", id);
                            formData.append("nama_lpj", nama_lpj);
                            formData.append("nominal_dana_terpakai", nominal_terpakai.replace(/\D/g, ''));
                            formData.append("nominal_dana_eksternal", nominal_eks.replace(/\D/g, ''));
                            formData.append("file_laporan_lpj", file);
                            formData.append([csrfName], csrfHash);
                            return $.ajax({
                                type: "post",
                                url: "<?php echo site_url("/finance/budget/post_lpj_fondation") ?>",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (result) {
                                    Swal.fire("Berhasil!", "Upload LPJ Anggaran '" + name + "' telah disimpan.", "success");
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                },
                                error: function (result) {
                                    console.log(result);
                                    Swal.fire("Opsss!", "Koneksi Internet Bermasalah.", "error");
                                }
                            });
                        }
                    } else {
                        Swal.showValidationMessage(`File LPJ Wajib diisi!`);
                    }
                } else {
                    Swal.showValidationMessage(`Nama LPJ, Nominal Dana Terpakai Wajib diisi!`);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function (result) {
            if (!result.isConfirm) {
                Swal.fire("Dibatalkan!", "Upload LPJ Anggaran '" + name + "' dibatalkan.", "error");
            }
        });
    }
</script>
<script>
    function act_edit_lpj(id, name) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            icon: "warning",
            html: `<div>Apakah anda yakin ingin MENGUBAH LPJ "` + name + `"?</div>
                   <label class=" mt-5">Nama LPJ (wajib)</label>
                   <textarea id="nama_lpj" class="form-control form-control-lg-swal" placeholder="Inputkan Nominal Dana Terpakai"><?php echo $budget[0]->nama_lpj; ?></textarea>
                   <label class=" mt-5">Nominal Dana Terpakai (wajib)</label>
                   <input type="number" id="nominal_terpakai" value="<?php echo $budget[0]->nominal_dana_terpakai; ?>" class="form-control form-control-lg-swal" placeholder="Inputkan Nominal Dana Terpakai">
                   <label class=" mt-5">Nominal Dana Eksternal (*jika ada wajib diisi)</label>
                   <input type="number" id="nominal_eks" value="<?php echo $budget[0]->nominal_dana_eksternal; ?>" class="form-control form-control-lg-swal" placeholder="Inputkan Nominal Dana Eksternal">                                    
                   <label class=" mt-5">Upload File LPJ <a href="#" data-toggle="modal" data-target="#modal_proposal">*KLIK LIHAT FILE LAMA</a></label>            
                   <input type="file" id="file_lpj" class="form-control form-control-lg-swal mb-5" placeholder="Inputkan File LPJ">
                   <input type="hidden" id="file_lpj_old" value="<?php echo $budget[0]->file_laporan_lpj ?>" style="display:none" />`,
            showCancelButton: true,
            confirmButtonColor: "#1BC5BD",
            confirmButtonText: "Ya, Simpan!",
            cancelButtonText: "Tidak, Batal!",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: false,
            preConfirm: () => {
                const nama_lpj = Swal.getPopup().querySelector('#nama_lpj').value;
                const nominal_terpakai = Swal.getPopup().querySelector('#nominal_terpakai').value;
                const nominal_eks = Swal.getPopup().querySelector('#nominal_eks').value;
                const file_old = Swal.getPopup().querySelector('#file_lpj_old').value;
                const file = Swal.getPopup().querySelector('#file_lpj').files[0];

                if (nominal_terpakai && nama_lpj) {
                    if (file) {

                        var val = file.name;
                        var file_type = val.substr(val.lastIndexOf('.')).toLowerCase();
                        var formData = new FormData();

                        if (file_type !== '.pdf') {
                            Swal.showValidationMessage(`File harus berformat pdf!`);
                        } else if (file.size >= 25097152) {
                            Swal.showValidationMessage(`File harus berukuran < 5Mb!`);
                        } else {
                            formData.append("id", id);
                            formData.append("nama_lpj", nama_lpj);
                            formData.append("nominal_dana_terpakai", nominal_terpakai.replace(/\D/g, ''));
                            formData.append("nominal_dana_eksternal", nominal_eks.replace(/\D/g, ''));
                            formData.append("file_laporan_lpj", file);
                            formData.append("file_laporan_lpj_old", file_old);
                            formData.append([csrfName], csrfHash);
                            return $.ajax({
                                type: "post",
                                url: "<?php echo site_url("/finance/budget/update_lpj_fondation") ?>",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (result) {
                                    Swal.fire("Berhasil!", "Perubahan LPJ Anggaran '" + name + "' telah disimpan.", "success");
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                },
                                error: function (result) {
                                    console.log(result);
                                    Swal.fire("Opsss!", "Koneksi Internet Bermasalah.", "error");
                                }
                            });
                        }
                    } else {
                        var formData = new FormData();

                        formData.append("id", id);
                        formData.append("nama_lpj", nama_lpj);
                        formData.append("nominal_dana_terpakai", nominal_terpakai.replace(/\D/g, ''));
                        formData.append("nominal_dana_eksternal", nominal_eks.replace(/\D/g, ''));
                        formData.append("file_laporan_lpj_old", file_old);
                        formData.append([csrfName], csrfHash);
                        return $.ajax({
                            type: "post",
                            url: "<?php echo site_url("/finance/budget/update_lpj_fondation") ?>",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                Swal.fire("Berhasil!", "Perubahan LPJ Anggaran '" + name + "' telah disimpan.", "success");
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            },
                            error: function (result) {
                                console.log(result);
                                Swal.fire("Opsss!", "Koneksi Internet Bermasalah.", "error");
                            }
                        });
                    }
                } else {
                    Swal.showValidationMessage(`Nama LPJ, Nominal Dana Terpakai Wajib diisi!`);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function (result) {
            if (!result.isConfirm) {
                Swal.fire("Dibatalkan!", "Perubahan LPJ Anggaran '" + name + "' dibatalkan.", "error");
            }
        });
    }
</script>
