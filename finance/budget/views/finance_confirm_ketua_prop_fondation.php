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
                            <a href="" class="text-muted">Konfimasi Proposal Anggaran</a>
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
            <div class="row"d
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-primary font-weight-bolder">DANA DIAJUKAN</h3>
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50 text-center">
                                    <?php if ($budget[0]->nominal_dana_awal == NULL || $budget[0]->nominal_dana_awal == "") { ?>
                                        Rp. 0
                                    <?php } else { ?>
                                        Rp. <?php echo number_format($budget[0]->nominal_dana_awal, 0, ',', '.'); ?>
                                    <?php } ?>
                                </p>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-success font-weight-bolder">DANA ACC</h3>
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50 text-center">
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
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark-75 font-weight-bolder text-center">STATUS PROPOSAL</h3>
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <?php if ($budget[0]->status_acc_proposal == 0) { ?>
                                    <p class="font-weight-boldest display-4 mb-1 text-warning"> DIPROSES </p>
                                <?php } else if ($budget[0]->status_acc_proposal == 1) { ?>
                                    <p class="font-weight-boldest display-4 mb-1 text-warning"> DIPROSES* </p>
                                <?php } else if ($budget[0]->status_acc_proposal == 2) { ?>
                                    <p class="font-weight-boldest display-4 mb-1 text-success"> DITERIMA </p>
                                <?php } else if ($budget[0]->status_acc_proposal == 3) { ?>
                                    <p class="font-weight-boldest display-4 mb-1 text-danger"> DITOLAK </p>
                                <?php } ?>

                            </div>    

                        </div>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="card card-custom mb-8">
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

                            </div>
                            <!--begin::Separator-->
                            <div class="separator separator-solid my-7"></div>
                            <!--end::Separator-->
                            <div class="d-flex align-items-center flex-wrap">
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
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-calendar icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">TANGGAL PENGAJUAN PROPOSAL</span>
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

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card card-custom mb-8">
                        <div class="card-body align-items-center text-center">
                            <?php if ($budget[0]->status_acc_proposal == 1) { ?>
                                <a href="<?php echo site_url("/finance/budget/apply_proposal_fondation/" . paramEncrypt($budget[0]->id_anggaran)); ?>" class="btn btn-success btn-sm font-weight-bold px-5 py-5 my-3 mx-4 mt-3"><i class="fas fa-check-circle "></i>Terima & TTD</a>
                                <button onclick="act_reject_budget('<?php echo paramEncrypt($budget[0]->id_anggaran); ?>', '<?php echo strtoupper($budget[0]->nama_anggaran); ?>')" class="btn btn-danger  btn-sm font-weight-bold px-11 py-5 my-3 mx-4 mt-3"><i class="fas fa-window-close"></i> Tolak</button>
                            <?php } else if ($budget[0]->status_acc_proposal == 3) { ?>
                                <a href = "https://web.whatsapp.com/send?phone=62<?php echo substr($budget[0]->nomor_handphone_akun, 1); ?>&text=*_Assalamualaikum Wr. Wb._*
                                <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>*--PROPOSAL 'DITOLAK' KETUA--*
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_Mohon maaf, status Proposal Anda *REVISI* Oleh Ketua, Berikut merupakan informasi terkait proposal Anda:_
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>- Nama Proposal: *<?php echo ucwords(strtolower($budget[0]->nama_anggaran)); ?>*
                                   <?php echo urlencode("\n") ?>- Pemohon: *<?php echo ucwords(strtolower($budget[0]->nama_struktur)); ?>*                                
                                   <?php echo urlencode("\n") ?>                                                                   
                                   <?php echo urlencode("\n") ?>```Mohon segera melakukan``` *REVISI PROPOSAL*```. Setelah melakukan revisi, harap```. *UPLOAD ULANG PROPOSAL*``` Anda ```                                 
                                   <?php echo urlencode("\n") ?>```Atas perhatian Bapak/Ibu kami ucapkan terima kasih.```
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_*Ketua Yayasan Sekolah Utsman*_" target="_blank"  class="btn btn-danger font-weight-bold px-6 py-4 my-3 mx-4 mt-15 mb-14"><i class="fab fa-whatsapp"></i> Kirim WA</a>
                               <?php } else if ($budget[0]->status_acc_proposal == 2) { ?>
                                <a href = "https://web.whatsapp.com/send?phone=62<?php echo substr($budget[0]->nomor_handphone_akun, 1); ?>&text=*_Assalamualaikum Wr. Wb._*
                                <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>*--PROPOSAL 'DITERIMA' KETUA--*
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_Selamat, status Proposal Anda *DITERIMA* Oleh Ketua, Berikut merupakan informasi terkait proposal Anda:_
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>- Nama Proposal: *<?php echo ucwords(strtolower($budget[0]->nama_anggaran)); ?>*
                                   <?php echo urlencode("\n") ?>- Pemohon: *<?php echo ucwords(strtolower($budget[0]->nama_struktur)); ?>*                                
                                   <?php echo urlencode("\n") ?>                                                                   
                                   <?php echo urlencode("\n") ?>```Mohon untuk menunggu pencairan dana``` *PROPOSAL*``` oleh BENDAHARA.```                                        
                                   <?php echo urlencode("\n") ?>```Atas perhatian Bapak/Ibu kami ucapkan terima kasih.```
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_*Ketua Yayasan Sekolah Utsman*_" target="_blank"  class="btn btn-success font-weight-bold px-6 py-4 my-3 mx-4 mt-15 mb-14"><i class="fab fa-whatsapp"></i> Kirim WA</a>
                               <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 ">
                            <h3 class="card-label text-dark font-weight-boldest d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">FILE PROPOSAL ASLI
                            </h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5" >
                                <?php if ($budget[0]->file_laporan_proposal != NULL || $budget[0]->file_laporan_proposal != "") { ?>
                                    <iframe type="application/pdf"  src="<?php echo base_url() . $budget[0]->file_laporan_proposal; ?>#zoom=75" width="100%" height="500"></iframe>
                                <?php } else { ?>
                                    <iframe id="iframe" width="100%" height="500" ></iframe>
                                <?php } ?>
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark font-weight-boldest d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">FILE PROPOSAL ACC BENDAHARA & KETUA

                            </h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <?php if ($budget[0]->file_laporan_proposal_acc != NULL || $budget[0]->file_laporan_proposal_acc != "") { ?>
                                    <iframe src="<?php echo base_url() . $budget[0]->file_laporan_proposal_acc; ?>#zoom=75" width="100%" height="500"></iframe>
                                <?php } else { ?>
                                    <iframe id="iframe" width="100%" height="500" ></iframe>
                                <?php } ?>
                            </div>    
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
    $("#iframe").contents().find("body").append('<div style="font-family: Poppins, Helvetica, sans-serif; text-align:center; color:#7E8299;"><b>MENUNGGGU</b></div>');
</script>
<script>
    function act_reject_proposal(id, name) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            title: "Peringatan!",
            text: "Apakah anda yakin ingin MENOLAK Proposal Atas Nama " + name + "?",
            icon: "warning",
            input: 'textarea',
            inputLabel: 'Keterangan',
            inputPlaceholder: 'Masukkan alasan ditolak',
            inputAttributes: {
                'aria-label': 'Masukkan alasan ditolak'
            },
            inputValidator: (value) => {
                if (!value) {
                    return 'Keterangan diperlukan!'
                }
            },
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Tolak!",
            cancelButtonText: "Tidak, batal!",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: true,
            preConfirm: (text) => {
                return $.ajax({
                    type: "post",
                    url: "<?php echo site_url("/finance/budget/reject_proposal_acc") ?>",
                    data: {id: id, keterangan: text, [csrfName]: csrfHash},
                    dataType: 'html',
                    success: function (result) {
                        Swal.fire("Ditolak!", "Proposal Atas Nama '" + name + "' telah ditolak.", "success");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    },
                    error: function (result) {
                        console.log(result);
                        Swal.fire("Opsss!", "Koneksi Internet Bermasalah.", "error");
                    }
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function (result) {
            if (!result.isConfirm) {
                Swal.fire("Dibatalkan!", "Penolakan Propsal Anggaran " + name + " dibatalkan.", "error");
            }
        });
    }
</script>
