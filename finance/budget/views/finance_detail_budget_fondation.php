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
                            <a href="" class="text-muted">Detail Proposal Anggaran</a>
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
                            <?php if ($budget[0]->status_acc_proposal == 3) { ?>
                                <!--begin::Separator-->
                                <div class="separator separator-solid my-7"></div>
                                <!--end::Separator-->
                                <div class="d-flex align-items-center flex-wrap">
                                    <!--begin: Item-->
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                        <span class="mr-4">
                                            <i class="flaticon-chat icon-2x text-muted font-weight-bold"></i>
                                        </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">KETERANGAN PROPOSAL DITOLAK</span>
                                            <span class="font-weight-bolder font-size-h6 text-danger">
                                                <?php echo ucwords(strtolower($budget[0]->keterangan_prop)); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                </div>
                            <?php } else if ($budget[0]->status_acc_lpj == 3) { ?>
                                <!--begin::Separator-->
                                <div class="separator separator-solid my-7"></div>
                                <!--end::Separator-->
                                <div class="d-flex align-items-center flex-wrap">
                                    <!--begin: Item-->
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                        <span class="mr-4">
                                            <i class="flaticon-chat icon-2x text-muted font-weight-bold"></i>
                                        </span>
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">KETERANGAN LPJ DITOLAK</span>
                                            <span class="font-weight-bolder font-size-h6 text-danger">
                                                <?php echo ucwords(strtolower($budget[0]->keterangan_lpj)); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-custom  mt-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark font-weight-boldest">BUKTI TRANSFER</h3>
                            <div class="separator separator-solid my-5"></div>
                            <div class="owl-carousel owl-theme">
                                <?php
                                if (!empty($foto_bukti)) {
                                    foreach ($foto_bukti as $key => $value) {
                                        ?> 
                                        <div class="item">
                                            <a href="<?php echo base_url() . $value->bukti_anggaran_thumb; ?>" class="image-popup-fit-width" >                         
                                                <img src="<?php echo base_url() . $value->bukti_anggaran_thumb; ?>" alt="Owl Image">
                                            </a>
                                        </div>
                                        <?php
                                    }  //ngatur nomor urut
                                } else {
                                    ?> 
                                    <div class="item">
                                        <a href="<?php echo base_url() . "uploads/data/no_image.jpg"; ?>" class="image-popup-fit-width">                         
                                            <img src="<?php echo base_url() . "uploads/data/no_image.jpg"; ?>" alt="Owl Image">
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="separator separator-solid my-5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8 mt-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark font-weight-boldest">FILE PROPOSAL</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center" >
                                <?php if ($budget[0]->file_laporan_proposal != NULL || $budget[0]->file_laporan_proposal != "") { ?>
                                    <iframe src="<?php echo base_url() . $budget[0]->file_laporan_proposal; ?>#toolbar=0&zoom=75" width="100%" height="500"></iframe>
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
                            <h3 class="card-label text-dark font-weight-boldest">FILE LPJ</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <?php if ($budget[0]->file_laporan_lpj != NULL || $budget[0]->file_laporan_lpj != "") { ?>
                                    <iframe src="<?php echo base_url() . $budget[0]->file_laporan_lpj; ?>#toolbar=0&zoom=75" width="100%" height="500"></iframe>
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
<!--end::Content-->
<script>
    $("#iframe").contents().find("body").append('<div style="font-family: Poppins, Helvetica, sans-serif; text-align:center; color:#7E8299;"><b>MENUNGGU...</b></div>');
</script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/owl.carousel/owl.custom.js"></script>