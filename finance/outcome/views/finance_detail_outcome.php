<!--begin::Content-->
<?php $user = $this->session->userdata('sias-finance'); ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">

                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Pengeluaran</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Detail Pengeluaran Sekolah</a>
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
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark-75 font-weight-boldest">NOMINAL PENGELUARAN</h3>
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50 text-center">
                                    <?php if ($outcome[0]->nominal_pengeluaran == NULL || $outcome[0]->nominal_pengeluaran == "") { ?>
                                        Rp. 0
                                    <?php } else { ?>
                                        Rp. <?php echo number_format($outcome[0]->nominal_pengeluaran, 0, ',', '.'); ?>
                                    <?php } ?>
                                </p>
                            </div>    

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark-75 font-weight-boldest">JENIS PEMBAYARAN</h3>
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50">
                                    <?php if ($outcome[0]->status_pembayaran == 1) { ?>
                                        <b class="font-weight-boldest text-success">TRANSFER</b>
                                    <?php } else if ($outcome[0]->status_pembayaran == 2) { ?>
                                        <b class="font-weight-boldest text-default">TUNAI</b>
                                    <?php } ?>
                                </p>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark-75 font-weight-boldest">STATUS ACC</h3>
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50">
                                    <?php if ($outcome[0]->status_pengeluaran == 0) { ?>
                                        <b class="font-weight-boldest text-warning"> DIPROSES </b>
                                    <?php } else if ($outcome[0]->status_pengeluaran == 1) { ?>
                                        <b class="font-weight-boldest text-success"> DITERIMA </b>
                                    <?php } else if ($outcome[0]->status_pengeluaran == 2) { ?>
                                        <b class="font-weight-boldest text-danger"> DITOLAK </b> 
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
                                        <span class="font-weight-bolder font-size-sm">NAMA PENGELUARAN</span>
                                        <span class="font-weight-bolder font-size-h6 text-success">
                                            <?php echo ucwords(strtolower($outcome[0]->nama_pengeluaran)); ?>
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
                                        <span class="font-weight-bolder font-size-sm">KATEGORI</span>
                                        <span class="font-weight-bolder font-size-h6 text-success">
                                            <?php echo ucwords(strtolower($outcome[0]->kategori_bidang)); ?>
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
                                        <span class="font-weight-bolder font-size-sm">TANGGAL PENGAJUAN</span>
                                        <span class="font-weight-bolder font-size-h5 text-success">
                                            <?php echo (($outcome[0]->tanggal_pengajuan)); ?>
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
                                            <?php echo (($outcome[0]->tahun_ajaran)); ?>
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
                                        <span class="font-weight-bolder font-size-sm">TANGGAL ACC</span>
                                        <span class="font-weight-bolder font-size-h5 text-success">
                                            <?php if ($outcome[0]->tanggal_acc_pengeluaran == NULL || $outcome[0]->tanggal_acc_pengeluaran == "") { ?>
                                                <b class="text-dark-50">MENUNGGU</b>
                                            <?php } else { ?>
                                                <?php echo $outcome[0]->tanggal_acc_pengeluaran; ?>
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
                            <h3 class="card-label text-dark font-weight-boldest">BUKTI NOTA</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center border" style="height: 400px" >
                                <?php if ($outcome[0]->file_nota != NULL || $outcome[0]->file_nota != "") { ?>                                   
                                    <div id="panzoom-nota"> 
                                        <img src="<?php echo base_url() . $outcome[0]->file_nota; ?>"> 
                                    </div>
                                <?php } else { ?>
                                    <div class="align-content-center font-weight-boldest text-danger"> 
                                        BELUM ADA BUKTI
                                    </div> 
                                <?php } ?>
                            </div>  
                            <?php if ($user[0]->id_role_struktur == 7 || $user[0]->id_role_struktur == 5) { ?>
                                <?php if ($outcome[0]->file_nota != NULL || $outcome[0]->file_nota != "") { ?>
                                    <div class="text-center">
                                        <a href="<?php echo base_url() . $outcome[0]->file_nota ?>" class="btn btn-success btn-sm py-3 px-4 mt-3" download><i class="fas fa-download"></i> Download</a>         
                                    </div>
                                <?php } else { ?>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-bg-light btn-light-dark btn-sm py-3 px-4 mt-3 disabled" ><i class="fas fa-download"></i> Download</a>         
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8 mt-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark font-weight-boldest">BUKTI TRANSFER</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center border" style="height: 400px">
                                <?php if ($outcome[0]->file_transfer != NULL || $outcome[0]->file_transfer != "") { ?>
                                    <div id="panzoom-transfer"> 
                                        <img src="<?php echo base_url() . $outcome[0]->file_transfer; ?>"> 
                                    </div>  
                                <?php } else { ?>
                                    <div class="align-content-center font-weight-boldest text-danger"> 
                                        BELUM ADA BUKTI
                                    </div> 
                                <?php } ?>
                            </div>   
                            <?php if ($user[0]->id_role_struktur == 7 || $user[0]->id_role_struktur == 5) { ?>
                                <?php if ($outcome[0]->file_transfer != NULL || $outcome[0]->file_transfer != "") { ?>
                                    <div class="text-center">
                                        <button class="btn btn-primary btn-md font-weight-bold mt-7" data-toggle="modal" data-target="#modal_rev_lpj"><i class="fa fa-signature"></i>LPJ Acc</button>
                                    </div>
                                <?php } else { ?>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-bg-light btn-light-dark btn-sm py-3 px-4 mt-3 disabled" ><i class="fas fa-download"></i> Download</a>         
                                    </div>
                                <?php } ?>
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
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/panzoom/dist/panzoom.min.js">
</script>
<script>
    const elem = document.getElementById('panzoom-nota')
    const panzoom = Panzoom(elem, {
        maxScale: 2
    })
    panzoom.pan(10, 10)
    panzoom.zoom(1, {animate: true})

// Panning and pinch zooming are bound automatically (unless disablePan is true).
// There are several available methods for zooming
// that can be bound on button clicks or mousewheel.
    //button.addEventListener('click', panzoom.zoomIn)
    elem.parentElement.addEventListener('wheel', panzoom.zoomWithWheel)
</script>