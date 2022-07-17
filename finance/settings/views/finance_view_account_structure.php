<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Mobile Toggle-->
                <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                    <span></span>
                </button>
                <!--end::Mobile Toggle-->
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Pengaturan</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Daftar Struktur Akun</a>
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
                <div class="col-lg-12 mb-10" id="kt_form" >
                    <!--begin::Card-->
                    <div class="card card-custom" >
                        <div class="card-header">
                            <h3 class="card-title">
                                Tambah Role Struktur Akun
                            </h3>                            
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" action="<?php echo site_url('finance/settings/post_structure'); ?>" enctype="multipart/form-data" method="post" id="kt_add_structure_form">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Role Struktur</label>
                                            <select name="id_role_struktur" id="jenis_biaya" class="form-control form-control-lg">
                                                <option value="">Pilih Role Struktur</option>
                                                <option value="1">Pembina</option>
                                                <option value="2">Ketua</option>
                                                <option value="3">Pengawas</option>        
                                                <option value="4">Sekertaris</option>        
                                                <option value="5">Bendahara</option> 
                                                <option value="6">Unit Bidang</option>  
                                                <option value="7">Pegawai</option> 
                                                <option value="8">Komite</option> 
                                                <option value="9">DU</option> 
                                            </select> 
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>pilih Role Struktur</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <label>Nama Struktur</label>
                                            <input type="text" name="nama_struktur" class="form-control form-control-lg"  placeholder="Isikan Nama Struktur Akun"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Nama Struktur Akun</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mt-4">
                                        <label></label>
                                        <button id="kt_login_signin_submit" class="btn btn-success font-weight-bold px-4 py-4 my-3 mx-4">Tambah</button>
                                    </div> 
                                </div>
                            </div>                           
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-lg-12">                   
                    <!--begin::Entry-->
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-body">
                            <!--begin: Search Form-->
                            <!--begin::Search Form-->
                            <div class="mb-7">
                                <div class="row align-items-center">
                                    <div class="col-lg-9 col-xl-8">
                                        <div class="row align-items-center">
                                            <div class="col-md-6 my-2 my-md-0">
                                                <div class="input-icon">
                                                    <input type="text" class="form-control" placeholder="Cari..." id="kt_datatable_search_query" />
                                                    <span>
                                                        <i class="flaticon2-search-1 text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 my-2 my-md-0">
                                                <div class="d-flex align-items-center">                                                   
                                                    <select class="form-control" id="kt_datatable_search_role">
                                                        <option value="">Pilih Role Struktur</option>
                                                        <option value="1">Pembina</option>
                                                        <option value="2">Ketua</option>
                                                        <option value="3">Pengawas</option>        
                                                        <option value="4">Sekertaris</option>        
                                                        <option value="5">Bendahara</option> 
                                                        <option value="6">Unit Bidang</option>  
                                                        <option value="7">Pegawai</option> 
                                                        <option value="8">Komite</option> 
                                                        <option value="9">DU</option> 
                                                        <option value="">Semua</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-4 text-right">

                                    </div>
                                </div>
                            </div>
                            <!--end::Search Form-->
                            <!--end: Search Form-->
                            <!--begin: Datatable-->
                            <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable_structure">
                                <thead>
                                    <tr>
                                        <th title="No">No</th>
                                        <th title="Role">Role</th>      
                                        <th title="Nama Struktur">Nama Struktur</th>                                                                                                       
                                        <th title="Tanggal">Tanggal</th>
                                        <th title="Aksi">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (!empty($structure)) {
                                        foreach ($structure as $key => $value) {
                                            ?> 
                                            <tr>
                                                <td><b><?php echo $no; ?></b></td>
                                                <td><?php echo $value->id_role_struktur; ?></td>
                                                <td><b><?php echo strtoupper($value->nama_struktur); ?></b></td>                                              
                                                <td><?php echo $value->tanggal_masuk; ?></td>                                               
                                                <td>
                                                    <div class="dropdown dropdown-inline">
                                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">
                                                            <span class="svg-icon svg-icon-md">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"/>
                                                                <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>
                                                                </g>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <ul class="navi flex-column navi-hover py-2">
                                                                <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">
                                                                    Pilih Aksi:
                                                                </li>
                                                                <li  class="navi-item">
                                                                    <a role="button" class="navi-link" data-toggle="modal" data-target="#modal_edit_struktur<?php echo $value->id_struktur; ?>">
                                                                        <span class="navi-icon"><i class="la la-edit text-success"></i></span>
                                                                        <span class="navi-text">Edit</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="javascript:act_delete_structure('<?php echo paramEncrypt($value->id_struktur); ?>', '<?php echo strtoupper($value->nama_struktur); ?>')"  class="navi-link">
                                                                        <span class="navi-icon"><i class="la la-close text-danger"></i></span>
                                                                        <span class="navi-text">Hapus</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>                                                
                                            <?php
                                            $no++;
                                        }  //ngatur nomor urut
                                    }
                                    ?>          
                                </tbody>
                            </table>
                            <!--end: Datatable-->
                        </div>
                    </div>
                    <!--end::Card-->
                    <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
</div>
<?php
if (!empty($structure)) {
    foreach ($structure as $key => $value) {
        ?> 
        <div class="modal fade" id="modal_edit_struktur<?php echo $value->id_struktur; ?>" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Edit Struktur Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <form class="form" method="POST" action="<?php echo site_url('/finance/settings/update_structure/' . paramEncrypt($value->id_struktur)); ?>" >
                        <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="modal-body">                           
                            <div class="row">

                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label>Role Struktur</label>
                                        <select name="id_role_struktur" class="form-control form-control-lg" required="">
                                            <?php if ($value->id_role_struktur == 1) { ?>
                                                <option value="1" selected="">Pembina</option>
                                            <?php } else if ($value->id_role_struktur == 2) { ?>
                                                <option value="2" selected="">Ketua</option>
                                            <?php } else if ($value->id_role_struktur == 3) { ?>
                                                <option value="3" selected="">Pengawas</option>
                                            <?php } else if ($value->id_role_struktur == 4) { ?>
                                                <option value="4" selected="">Sekertaris</option>
                                            <?php } else if ($value->id_role_struktur == 5) { ?>
                                                <option value="5" selected="">Bendahara</option>
                                            <?php } else if ($value->id_role_struktur == 6) { ?>
                                                <option value="6" selected="">Unit Bidang</option>
                                            <?php } else if ($value->id_role_struktur == 7) { ?>
                                                <option value="7" selected="">Pegawai</option>
                                            <?php } else if ($value->id_role_struktur == 8) { ?>
                                                <option value="8" selected="">Komite</option>
                                            <?php } else if ($value->id_role_struktur == 9) { ?>
                                                <option value="9" selected="">DU</option>

                                            <?php } ?>
                                            <option value="1">Pembina</option>
                                            <option value="2">Ketua</option>
                                            <option value="3">Pengawas</option>        
                                            <option value="4">Sekertaris</option>        
                                            <option value="5">Bendahara</option> 
                                            <option value="6">Unit Bidang</option>  
                                            <option value="7">Pegawai</option> 
                                            <option value="8">Komite</option> 
                                            <option value="9">DU</option> 
                                        </select>
                                        <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH, </b>pilih Jenjang/Tingkat</span>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Nama Struktur</label>
                                        <input type="text" name="nama_struktur" value="<?php echo $value->nama_struktur; ?>" class="form-control form-control-lg"  placeholder="Isikan Nama Struktur Akun"  required=""/>
                                        <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Nama Struktur Akun</span>               
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success font-weight-bold mr-2">Simpan</button>
                            <button type="reset" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }  //ngatur nomor urut
}
?>          
<!--end::Content-->
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/crud/ktdatatable/base/html-table-structure.js">
</script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-cost-structure.js">
</script>
<script>
    function act_delete_structure(id, name) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            title: "Peringatan!",
            text: "Apakah anda yakin ingin menghapus Struktur atas nama " + name + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Tidak, batal!",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url("/finance/settings/delete_structure") ?>",
                    data: {id: id, [csrfName]: csrfHash},
                    dataType: 'html',
                    success: function (result) {
                        Swal.fire("Terhapus!", "Struktur atas nama '" + name + "' telah terhapus.", "success");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    },
                    error: function (result) {
                        console.log(result);
                        Swal.fire("Opsss!", "Koneksi Internet Bermasalah.", "error");
                    }
                });

            } else {
                Swal.fire("Dibatalkan!", "Struktur atas nama " + name + " batal dihapus.", "error");
            }
        });
    }
</script>