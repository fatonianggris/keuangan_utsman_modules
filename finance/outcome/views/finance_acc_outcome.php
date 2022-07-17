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
                <div class="col-lg-4 col-md-3 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark-75 font-weight-boldest mt-2">NOMINAL PENGELUARAN</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
                                <p class="font-weight-boldest display-4 mb-1 text-dark-50">
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
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark-75 font-weight-boldest  mt-2">JENIS PEMBAYARAN</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
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
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="card card-custom mb-8">
                        <div class="card-body py-4 mt-4 mb-3 text-center">
                            <h3 class="card-label text-dark-75 font-weight-boldest mt-2">STATUS ACC</h3>
                            <div class="d-flex flex-lg-grow-1 justify-content-lg-center mt-5 text-center">
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
                <div class="col-lg-2">
                    <div class="card card-custom mb-8">
                        <div class="card-body align-items-center text-center">
                            <?php if ($outcome[0]->status_pengeluaran == 0) { ?>
                                <button onclick="act_confirm_outcome('<?php echo paramEncrypt($outcome[0]->id_pengeluaran); ?>', '<?php echo strtoupper($outcome[0]->nama_pengeluaran); ?>')" class="btn btn-success btn-md font-weight-bold "><i class="fas fa-check-circle "></i>Terima</button>
                                <button onclick="act_reject_outcome('<?php echo paramEncrypt($outcome[0]->id_pengeluaran); ?>', '<?php echo strtoupper($outcome[0]->nama_pengeluaran); ?>')" class="btn btn-danger btn-md font-weight-bold px-6 mt-3"><i class="fas fa-window-close"></i>Tolak</button>
                            <?php } else if ($outcome[0]->status_pengeluaran == 2) { ?>
                                <a href = "https://web.whatsapp.com/send?phone=62<?php echo substr($outcome[0]->nomor_handphone_akun, 1); ?>&text=*_Assalamualaikum Wr. Wb._*
                                <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>*--PENGELUARAN 'DITOLAK' BENDAHARA--*
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_Mohon maaf, status Proposal Anda *DITOLAK* Oleh Bendahara, Berikut merupakan informasi terkait proposal Anda:_
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>- Nama Pengeluaran: *<?php echo ucwords(strtolower($outcome[0]->nama_pengeluaran)); ?>*
                                   <?php echo urlencode("\n") ?>- Kategori Bidang: *<?php echo ucwords(strtolower($outcome[0]->kategori_bidang)); ?>*                                
                                   <?php echo urlencode("\n") ?>     
                                   <?php echo urlencode("\n") ?>```Mohon segera melakukan``` *REVISI PENGELUARAN*```. Setelah melakukan revisi, harap```. *UPLOAD ULANG BUKTI PENGELUARAN*``` Anda ```                                 
                                   <?php echo urlencode("\n") ?>```Atas perhatian Bapak/Ibu kami ucapkan terima kasih.```
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_*Bendahara Yayasan Sekolah Utsman*_" target="_blank"  class="btn btn-danger font-weight-bold mt-7 mb-7"><i class="fab fa-whatsapp"></i> Kirim WA</a>
                               <?php } else if ($outcome[0]->status_pengeluaran == 1) { ?>
                                <a href = "https://web.whatsapp.com/send?phone=62<?php echo substr($outcome[0]->nomor_handphone_akun, 1); ?>&text=*_Assalamualaikum Wr. Wb._*
                                <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>*--PENGELUARAN 'DITERIMA' BENDAHARA--*
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_Selamat, status Proposal Anda *DITERIMA* Oleh Bendahara, Berikut merupakan informasi terkait proposal Anda:_
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>- Nama Proposal: *<?php echo ucwords(strtolower($outcome[0]->nama_pengeluaran)); ?>*
                                   <?php echo urlencode("\n") ?>- Kategori Bidang: *<?php echo ucwords(strtolower($outcome[0]->kategori_bidang)); ?>*                                
                                   <?php echo urlencode("\n") ?>                                                                   
                                   <?php echo urlencode("\n") ?>```Atas perhatian Bapak/Ibu kami ucapkan terima kasih.```
                                   <?php echo urlencode("\n") ?>
                                   <?php echo urlencode("\n") ?>_*Bendahara Yayasan Sekolah Utsman*_" target="_blank"  class="btn btn-success font-weight-bold"><i class="fab fa-whatsapp"></i> Kirim WA</a>
                                <button onclick="act_edit_outcome('<?php echo paramEncrypt($outcome[0]->id_pengeluaran); ?>', '<?php echo strtoupper($outcome[0]->nama_pengeluaran); ?>')" class="btn btn-warning btn-md font-weight-bold mt-3"><i class="fas fa-edit"></i>Edit Bukti</button>
                            <?php } ?>
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
                                        <span class="font-weight-bolder font-size-sm">KATEGORI BIDANG</span>
                                        <span class="font-weight-bolder font-size-h6 text-success">
                                            <?php echo ucwords(strtolower($outcome[0]->nama_struktur)); ?>
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
                            <?php if ($outcome[0]->file_nota != NULL || $outcome[0]->file_nota != "") { ?>
                                <div class="text-center">
                                    <a href="<?php echo base_url() . $outcome[0]->file_nota ?>" class="btn btn-success btn-sm py-3 px-4 mt-3" download><i class="fas fa-download"></i> Download</a>         
                                </div>
                            <?php } else { ?>
                                <div class="text-center">
                                    <a href="#" class="btn btn-bg-light btn-light-dark btn-sm py-3 px-4 mt-3 disabled" ><i class="fas fa-download"></i> Download</a>         
                                </div>
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
                            <?php if ($outcome[0]->file_transfer != NULL || $outcome[0]->file_transfer != "") { ?>
                                <div class="text-center">
                                    <a href="<?php echo base_url() . $outcome[0]->file_nota ?>" class="btn btn-success btn-sm py-3 px-4 mt-3" download><i class="fas fa-download"></i> Download</a>         
                                </div>
                            <?php } else { ?>
                                <div class="text-center">
                                    <a href="#" class="btn btn-bg-light btn-light-dark btn-sm py-3 px-4 mt-3 disabled" ><i class="fas fa-download"></i> Download</a>         
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
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/panzoom/dist/panzoom.min.js">
</script>
<script>
    const elem_nt = document.getElementById('panzoom-nota')
    const panzoom_nt = Panzoom(elem_nt, {
        maxScale: 2
    })
    panzoom_nt.pan(10, 10)
    panzoom_nt.zoom(1, {animate: true})

// Panning and pinch zooming are bound automatically (unless disablePan is true).
// There are several available methods for zooming
// that can be bound on button clicks or mousewheel.
    //button.addEventListener('click', panzoom.zoomIn)
    elem_nt.parentElement.addEventListener('wheel', panzoom_nt.zoomWithWheel)
</script>
<script>
    const elem_tr = document.getElementById('panzoom-transfer')
    const panzoom_tr = Panzoom(elem_tr, {
        maxScale: 2
    })
    panzoom_tr.pan(10, 10)
    panzoom_tr.zoom(1, {animate: true})

// Panning and pinch zooming are bound automatically (unless disablePan is true).
// There are several available methods for zooming
// that can be bound on button clicks or mousewheel.
    //button.addEventListener('click', panzoom.zoomIn)
    elem_tr.parentElement.addEventListener('wheel', panzoom_tr.zoomWithWheel)
</script>
<script>

    function act_confirm_outcome(id, name) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            title: "Peringatan!",
            text: "Apakah anda yakin ingin MENYETUJUI Pengeluaran '" + name + "'?",
            icon: "warning",
            html: `<div>Apakah anda yakin ingin MENYETUJUI Pengeluaran "` + name + `"?</div>
                   <label class=" mt-5">Upload Bukti Transfer</label>            
                   <input type="file" id="file_acc" class="form-control form-control-lg-swal mb-5" placeholder="Upload Bukti Transfer">`,
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

                    var val = file.name.toLowerCase();
                    var file_type = val.substr(val.lastIndexOf('.')).toLowerCase();
                    var formData = new FormData();

                    if (file_type === '.jpg' || file_type === '.png' || file_type === '.jpeg') {

                        formData.append("id", id);
                        formData.append("file_transfer", file);
                        formData.append([csrfName], csrfHash);
                        return $.ajax({
                            type: "post",
                            url: "<?php echo site_url("/finance/outcome/accept_recipe_outcome") ?>",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                Swal.fire("Disetujui!", "Pengeluaran '" + name + "' telah disetujui.", "success");
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            },
                            error: function (result) {
                                console.log(result);
                                Swal.fire("Opsss!", "Koneksi Internet Bermasalah.", "error");
                            }
                        });
                    } else if (file.size >= 5097152) {
                        Swal.showValidationMessage(`File harus berukuran < 5Mb!`);
                    } else {
                        Swal.showValidationMessage(`File harus berformat jpg, jpeg, png!`);
                    }
                } else {
                    Swal.showValidationMessage(`Bukti Transfer wajib diupload!`);
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function (result) {
            if (!result.isConfirm) {
                Swal.fire("Dibatalkan!", "Persetujuan Pengeluaran '" + name + "' dibatalkan.", "error");
            }
        });
    }
</script>
<script>

    function act_reject_outcome(id, name) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            title: "Peringatan!",
            text: "Apakah anda yakin ingin MENOLAK Pengeluaran '" + name + "'?",
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
                    url: "<?php echo site_url("/finance/outcome/reject_recipe_outcome") ?>",
                    data: {id: id, keterangan: text, [csrfName]: csrfHash},
                    dataType: 'html',
                    success: function (result) {
                        Swal.fire("Ditolak!", "Pengeluaran '" + name + "' telah ditolak.", "success");
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
                Swal.fire("Dibatalkan!", "Penolakan Pengeluaran '" + name + "' dibatalkan.", "error");
            }
        });
    }
</script>

<script>

    function act_edit_outcome(id, name) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            title: "Peringatan!",
            text: "Apakah anda yakin ingin MENGUBAH Pengeluaran '" + name + "'?",
            icon: "warning",
            html: `<div>Apakah anda yakin ingin MENGUBAH Pengeluaran "` + name + `"?</div>
                   <label class=" mt-5">Upload Bukti Transfer</label>  
                   <input type="hidden" id="file_acc_old" value="<?php echo $outcome[0]->file_transfer ?>" style="display:none" />    
                   <input type="file" id="file_acc" class="form-control form-control-lg-swal mb-5" placeholder="Upload Bukti Transfer">`,
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

                    var val = file.name.toLowerCase();
                    var file_type = val.substr(val.lastIndexOf('.')).toLowerCase();
                    var formData = new FormData();

                    if (file_type === '.jpg' || file_type === '.png' || file_type === '.jpeg') {

                        formData.append("id", id);
                        formData.append("file_transfer", file);
                        formData.append("file_transfer_old", file_old);
                        formData.append([csrfName], csrfHash);
                        return $.ajax({
                            type: "post",
                            url: "<?php echo site_url("/finance/outcome/update_recipe_outcome") ?>",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                Swal.fire("Direvisi!", "Pengeluaran '" + name + "' telah direvisi.", "success");
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            },
                            error: function (result) {
                                console.log(result);
                                Swal.fire("Opsss!", "Koneksi Internet Bermasalah.", "error");
                            }
                        });
                    } else if (file.size >= 5097152) {
                        Swal.showValidationMessage(`File harus berukuran < 5Mb!`);
                    } else {
                        Swal.showValidationMessage(`File harus berformat jpg, jpeg, png!`);
                    }
                } else {
                    var formData = new FormData();

                    formData.append("id", id);
                    formData.append("file_transfer_old", file_old);
                    formData.append([csrfName], csrfHash);
                    return $.ajax({
                        type: "post",
                        url: "<?php echo site_url("/finance/budget/update_recipe_outcome") ?>",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (result) {
                            Swal.fire("Direvisi!", "Pengeluaran '" + name + "' telah direvisi.", "success");
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
                Swal.fire("Dibatalkan!", "Revisi Pengeluaran '" + name + "' dibatalkan.", "error");
            }
        });
    }
</script>
