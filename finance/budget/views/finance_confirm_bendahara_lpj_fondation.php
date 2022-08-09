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
                            <a href="" class="text-muted">Konfimasi LPJ Anggaran</a>
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
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-warning font-weight-bolder">DANA EKSTERNAL</h3>
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50 text-center">
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
                            <h3 class="card-label text-primary font-weight-bolder">DANA TERPAKAI</h3>
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50 text-center">
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
                            <div class=" flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50 text-center">
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
                                        <span class="font-weight-bolder font-size-sm">NAMA ANGGARAN LPJ</span>
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
                                        <span class="font-weight-bolder font-size-sm">PEMOHON LPJ</span>
                                        <span class="font-weight-bolder font-size-h6 text-success">
                                            <?php echo ucwords(strtolower($budget[0]->nama_struktur)); ?>
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
                                        <?php if ($budget[0]->status_acc_lpj == 0) { ?>
                                            <span class="font-weight-bolder font-size-h6 text-default">
                                                MENUNGGU
                                            </span>
                                        <?php } else if ($budget[0]->status_acc_lpj == 1) { ?>
                                            <span class="font-weight-bolder font-size-h6 text-warning">
                                                DIPROSES
                                            </span>
                                        <?php } else if ($budget[0]->status_acc_lpj == 2) { ?>
                                            <span class="font-weight-bolder font-size-h6 text-success">
                                                DITERIMA
                                            </span>
                                        <?php } else if ($budget[0]->status_acc_lpj == 3) { ?>
                                            <span class="font-weight-bolder font-size-h6 text-danger">
                                                DITOLAK
                                            </span>
                                        <?php } ?>                                        
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
                                        <span class="font-weight-bolder font-size-sm">NAMA LPJ</span>
                                        <span class="font-weight-bolder font-size-h5 text-success">
                                            <?php echo ucwords(strtolower($budget[0]->nama_lpj)); ?>
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
                                <!--begin: Item-->
                                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                    <span class="mr-4">
                                        <i class="flaticon2-calendar icon-2x text-muted font-weight-bold"></i>
                                    </span>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder font-size-sm">TANGGAL PENGAJUAN LPJ</span>
                                        <span class="font-weight-bolder font-size-h5 text-success">
                                            <?php echo (($budget[0]->tanggal_pengajuan_lp)); ?>
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
                                            <?php if ($budget[0]->tanggal_persetujuan_lpj == NULL || $budget[0]->tanggal_persetujuan_lpj == "") { ?>
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

                <div class="col-lg-2">
                    <div class="card card-custom mb-8">
                        <div class="card-body align-items-center text-center">
                            <?php if ($budget[0]->status_acc_lpj == 1) { ?>
                                <button onclick="act_confirm_lpj('<?php echo paramEncrypt($budget[0]->id_anggaran); ?>', '<?php echo strtoupper($budget[0]->nama_anggaran); ?>')" class="btn btn-success btn-sm font-weight-bold px-8 py-5 my-3 mx-4 mt-3"><i class="fas fa-check-circle "></i>Terima</button>
                                <button onclick="act_reject_lpj('<?php echo paramEncrypt($budget[0]->id_anggaran); ?>', '<?php echo strtoupper($budget[0]->nama_anggaran); ?>')" class="btn btn-danger  btn-sm font-weight-bold px-10 py-5 my-3 mx-4 mt-3"><i class="fas fa-window-close"></i>Tolak</button>
                            <?php } else if ($budget[0]->status_acc_lpj == 3) { ?>
                                <a href = "https://web.whatsapp.com/send?phone=62<?php echo substr($budget[0]->nomor_handphone_akun, 1); ?>&text=*_Assalamualaikum Wr. Wb._*
                                <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>*--LPJ 'DITOLAK'--*
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_Mohon maaf, status LPJ Anda *REVISI*, Berikut merupakan informasi terkait LPJ Anda:_
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>- Nama LPJ: *<?php echo ucwords(strtolower($budget[0]->nama_lpj)); ?>*
                                   <?php echo urlencode("\n") ?>- Pemohon: *<?php echo ucwords(strtolower($budget[0]->nama_struktur)); ?>*                                
                                   <?php echo urlencode("\n") ?>                                                                   
                                   <?php echo urlencode("\n") ?>```Mohon segera melakukan``` *REVISI LPJ*```. Setelah melakukan revisi, harap```. *UPLOAD ULANG LPJ*``` Anda ```                                 
                                   <?php echo urlencode("\n") ?>```Atas perhatian Bapak/Ibu kami ucapkan terima kasih.```
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_*Bendahara Yayasan Sekolah Utsman*_" target="_blank"  class="btn btn-danger font-weight-bold px-6 py-4 my-3 mx-4 mt-5 mb-4"><i class="fab fa-whatsapp"></i> Kirim WA</a>
                                <button onclick="act_edit_lpj('<?php echo paramEncrypt($budget[0]->id_anggaran); ?>', '<?php echo strtoupper($budget[0]->nama_anggaran); ?>')" class="btn btn-warning btn-md font-weight-bold  py-4 mt-2 mb-2"><i class="fas fa-edit"></i>Ubah File Acc</button>
                            <?php } else if ($budget[0]->status_acc_lpj == 2) { ?>
                                <a href = "https://web.whatsapp.com/send?phone=62<?php echo substr($budget[0]->nomor_handphone_akun, 1); ?>&text=*_Assalamualaikum Wr. Wb._*
                                <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>*--LPJ 'DITERIMA'--*
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_Selamat, status LPJ Anda *DITERIMA*, Berikut merupakan informasi terkait LPJ Anda:_
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>- Nama LPJ: *<?php echo ucwords(strtolower($budget[0]->nama_lpj)); ?>*
                                   <?php echo urlencode("\n") ?>- Pemohon: *<?php echo ucwords(strtolower($budget[0]->nama_struktur)); ?>*                                
                                   <?php echo urlencode("\n") ?>                                                                                                          
                                   <?php echo urlencode("\n") ?>```Atas perhatian Bapak/Ibu kami ucapkan terima kasih.```
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_*Bendahara Yayasan Sekolah Utsman*_" target="_blank"  class="btn btn-success font-weight-bold px-6 py-4 my-3 mx-4 mt-5 mb-4"><i class="fab fa-whatsapp"></i> Kirim WA</a>
                                <button onclick="act_edit_lpj('<?php echo paramEncrypt($budget[0]->id_anggaran); ?>', '<?php echo strtoupper($budget[0]->nama_anggaran); ?>')" class="btn btn-warning btn-md font-weight-bold py-4 mt-2 mb-2"><i class="fas fa-edit"></i>Ubah File Acc</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark font-weight-boldest">FILE LPJ</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5" >
                                <?php if ($budget[0]->file_laporan_lpj != NULL || $budget[0]->file_laporan_lpj != "") { ?>
                                    <iframe src="<?php echo base_url() . $budget[0]->file_laporan_lpj; ?>#zoom=78" width="100%" height="500"></iframe>
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
                            <h3 class="card-label text-dark font-weight-boldest">FILE LPJ ACC</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <?php if ($budget[0]->file_laporan_lpj_acc != NULL || $budget[0]->file_laporan_lpj_acc != "") { ?>
                                    <iframe src="<?php echo base_url() . $budget[0]->file_laporan_lpj_acc; ?>#zoom=78" width="100%" height="500"></iframe>
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
    $("#iframe").contents().find("body").append('<div style="font-family: Poppins, Helvetica, sans-serif; text-align:center; color:#7E8299;"><b>BELUM UPLOAD</b></div>');
</script>
<script>

    function act_confirm_lpj(id, name) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            title: "Peringatan!",
            text: "Apakah anda yakin ingin MENYETUJUI LPJ Atas Nama " + name + "?",
            icon: "warning",
            html: `<div>Apakah anda yakin ingin MENYETUJUI LPJ Atas Nama "` + name + `"?</div>
                   <label class=" mt-5">Upload File LPJ Acc</label>            
                   <input type="file" id="file_acc" class="form-control form-control-lg-swal mb-5" placeholder="Inputkan LPJ Acc">`,
            showCancelButton: true,
            confirmButtonColor: "#1BC5BD",
            confirmButtonText: "Ya, Setuju!",
            cancelButtonText: "Tidak, batal!",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: false,
            preConfirm: () => {
                const file = Swal.getPopup().querySelector('#file_acc').files[0];
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
                        formData.append("file_lpj_acc", file);
                        formData.append([csrfName], csrfHash);
                        return $.ajax({
                            type: "post",
                            url: "<?php echo site_url("/finance/budget/accept_bendahara_lpj_fondation") ?>",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                Swal.fire("Disetujui!", "LPJ Atas Nama '" + name + "' telah disetujui.", "success");
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
                    formData.append([csrfName], csrfHash);
                    return $.ajax({
                        type: "post",
                        url: "<?php echo site_url("/finance/budget/accept_bendahara_lpj_fondation") ?>",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (result) {
                            Swal.fire("Disetujui!", "LPJ Atas Nama '" + name + "' telah disetujui.", "success");
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
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function (result) {
            if (!result.isConfirm) {
                Swal.fire("Dibatalkan!", "Persetujuan LPJ Anggaran " + name + " dibatalkan.", "error");
            }
        });
    }
</script>
<script>

    function act_reject_lpj(id, name) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            title: "Peringatan!",
            text: "Apakah anda yakin ingin MENOLAK LPJ Atas Nama " + name + "?",
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
                    url: "<?php echo site_url("/finance/budget/reject_bendahara_lpj_fondation") ?>",
                    data: {id: id, keterangan_lpj: text, [csrfName]: csrfHash},
                    dataType: 'html',
                    success: function (result) {
                        Swal.fire("Ditolak!", "LPJ Atas Nama '" + name + "' telah ditolak.", "success");
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
                Swal.fire("Dibatalkan!", "Penolakan LPJ Anggaran " + name + " dibatalkan.", "error");
            }
        });
    }
</script>
<script>

    function act_edit_lpj(id, name) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            title: "Peringatan!",
            text: "Apakah anda yakin ingin MENGUBAH LPJ Atas Nama " + name + "?",
            icon: "warning",
            html: `<div>Apakah anda yakin ingin MENGUBAH LPJ Atas Nama "` + name + `"?</div>
                   <label class=" mt-5">Upload File LPJ Acc</label>  
                   <input type="hidden" id="file_acc_old" value="<?php echo $budget[0]->file_laporan_lpj_acc ?>" style="display:none" />      
                   <input type="file" id="file_acc" class="form-control form-control-lg-swal mb-5" placeholder="Inputkan LPJ Acc">`,
            showCancelButton: true,
            confirmButtonColor: "#1BC5BD",
            confirmButtonText: "Ya, Setuju!",
            cancelButtonText: "Tidak, batal!",
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            closeOnCancel: false,
            preConfirm: () => {
                const file = Swal.getPopup().querySelector('#file_acc').files[0];
                const file_old = Swal.getPopup().querySelector('#file_acc_old').value;

                if (file) {

                    var val = file.name;
                    var file_type = val.substr(val.lastIndexOf('.')).toLowerCase();
                    var formData = new FormData();

                    if (file_type !== '.pdf') {
                        Swal.showValidationMessage(`File harus berformat pdf!`);
                    } else if (file.size >= 25097152) {
                        Swal.showValidationMessage(`File harus berukuran < 25Mb!`);
                    } else {
                        formData.append("id", id);
                        formData.append("file_lpj_acc", file);
                        formData.append("file_lpj_acc_old", file_old);
                        formData.append([csrfName], csrfHash);
                        return $.ajax({
                            type: "post",
                            url: "<?php echo site_url("/finance/budget/update_bendahara_lpj_fondation") ?>",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                Swal.fire("Berhasil!", "Perubahan LPJ Atas Nama '" + name + "' telah disimpan.", "success");
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
                    formData.append("file_lpj_acc_old", file_old);
                    formData.append([csrfName], csrfHash);
                    return $.ajax({
                        type: "post",
                        url: "<?php echo site_url("/finance/budget/update_bendahara_lpj_fondation") ?>",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (result) {
                            Swal.fire("Berhasil!", "Perubahan LPJ Atas Nama '" + name + "' telah disimpan.", "success");
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

            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function (result) {
            if (!result.isConfirm) {
                Swal.fire("Dibatalkan!", "Perubahan LPJ Anggaran " + name + " dibatalkan.", "error");
            }
        });
    }
</script>
