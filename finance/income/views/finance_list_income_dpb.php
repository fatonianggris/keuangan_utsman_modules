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
                                    Rp.  <?php echo number_format($payment[0]->total_tagihan_menunggu, 0, ',', '.'); ?>
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
                                <a href="#" data-toggle="modal" data-target="#modal_search_payment" class="btn btn-warning btn-md" >
                                    <i class="flaticon2-search-1"></i>Cari Tagihan Siswa
                                </a>
                            </div>
                            <div class="card-title">
                                <h2 class="card-label font-size-h2 text-center font-weight-bolder">DAFTAR TAGIHAN SISWA DPB SEKOLAH
                                    <span class="text-warning pt-1 font-size-h6 font-weight-bold d-block">Berikut merupakan daftar tagihan/pemasukan DPB siswa Sekolah Utsman</span>
                                </h2>
                            </div>
                            <div class="card-toolbar">
                                <a href="#" data-toggle="modal" data-target="#modal_import_payment"  class="btn btn-primary btn-md" >
                                    <i class="flaticon-upload"></i>Import Tagihan DPB
                                </a>
                            </div>
                        </div>                        
                        <div class="card-body">
                            <div class="accordion accordion-light  accordion-svg-toggle" id="accordionExample4">
                                <div class="card">
                                    <div class="card-header bg-success-o-50 pl-4" id="headingOne4">
                                        <div class="card-title text-dark-75" data-toggle="collapse" data-target="#collapseOne4">
                                            <i class="fas fa-search text-dark-75 "></i>Filter Pencarian Tabel (<b class="text-danger">"klik"</b>)
                                        </div>
                                    </div>
                                    <div id="collapseOne4" class="collapse " data-parent="#accordionExample4">
                                        <!--begin: Search Form-->
                                        <form class="mb-6 mt-4">
                                            <div class="row mb-6">
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Invoice:</label>
                                                    <input type="text" class="form-control datatable-input" placeholder="Inputkan Invoice" data-col-index="1" />
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Tgl Invoice:</label>
                                                    <input type="text" id="kt_datepicker_invoice" required="" class="form-control datatable-input" placeholder="Inputkan Tgl Invoice" data-col-index="2" />
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Tgl Transaksi:</label>
                                                    <input type="text" id="kt_datepicker_transaksi" readonly="" class="form-control datatable-input" placeholder="Inputkan Tgl Transaksi" data-col-index="12" />
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Nama Siswa:</label>
                                                    <input type="text" class="form-control datatable-input" placeholder="Inputkan Nama Siswa" data-col-index="3" />
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>No. Pembayaran:</label>
                                                    <input type="number" class="form-control datatable-input" placeholder="Inputkan No Pembayaran" data-col-index="4" />
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Tingkat:</label>
                                                    <select class="form-control datatable-input" id="tingkat" data-col-index="5">      
                                                        <option value="">Pilih Tingkat</option>
                                                        <option value="KB">KB</option>   
                                                        <option value="TK">TK</option>   
                                                        <option value="SD">SD</option>
                                                        <option value="SMP">SMP</option>                                                             
                                                        <option value="">Semua</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-6">
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Kelas:</label>
                                                    <select class="form-control datatable-input" id="kelas" data-col-index="6">      
                                                        <option value="">Pilih Kelas</option>

                                                    </select>
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Nominal Tagihan:</label>
                                                    <input type="number" class="form-control datatable-input" placeholder="Inputkan Nominal" data-col-index="7" />
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Status Transfer:</label>
                                                    <select class="form-control datatable-input" data-col-index="8">
                                                        <option value="">Pilih Status</option>
                                                        <option value="MENUNGGU">Menunggu</option>
                                                        <option value="PROSES">Proses</option>      
                                                        <option value="SUKSES">Sukses</option>
                                                        <option value="GAGAL">Gagal</option>    
                                                        <option value="">Semua</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Tahun Ajaran:</label>
                                                    <select class="form-control datatable-input" data-col-index="9">
                                                        <option value="">Pilih Tahun Ajaran</option>
                                                        <?php
                                                        if (!empty($schoolyear)) {
                                                            foreach ($schoolyear as $key => $value) {
                                                                ?> 
                                                                <option value="<?php echo $value->id_tahun_ajaran; ?>"><?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?></option>
                                                                <?php
                                                            }  //ngatur nomor urut
                                                        }
                                                        ?>    
                                                        <option value="">Semua</option>
                                                    </select>
                                                </div>   
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Semester:</label>
                                                    <select class="form-control datatable-input" data-col-index="10">
                                                        <option value="">Pilih Semester</option>
                                                        <option value="ganjil">Ganjil</option>
                                                        <option value="genap">Genap</option>    
                                                        <option value="">Semua</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 mb-lg-0 mb-6">
                                                    <label>Bulan:</label>
                                                    <select class="form-control datatable-input" data-col-index="11">
                                                        <option value="">Pilih Bulan</option>
                                                        <option value="Januari">Januari</option>
                                                        <option value="Februari">Februari</option>
                                                        <option value="Maret">Maret</option>
                                                        <option value="April">April</option>
                                                        <option value="Mei">Mei</option>
                                                        <option value="Juni">Juni</option>
                                                        <option value="Juli">Juli</option>
                                                        <option value="Agustus">Agustus</option>
                                                        <option value="September">September</option>
                                                        <option value="Oktober">Oktober</option>
                                                        <option value="November">November</option>
                                                        <option value="Desember">Desember</option>
                                                        <option value="">Semua</option>
                                                    </select>
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
                                                        <button class="btn btn-warning font-weight-bold dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <i class="flaticon2-download"></i>
                                                            Export
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <form class="form" id="frm-excel" action="<?php echo site_url('ppdb/report/export_data_csv'); ?>" method="POST">  
                                                                <input type="text" id="id_check_excel" class="form-control" value="" name="data_check" style="display:none">                         
                                                                <button class="dropdown-item" role="button" type="submit"><i class="flaticon2-checking"></i> Laporan .csv</button>
                                                            </form>
                                                            <form class="form" id="frm-form" action="<?php echo site_url('ppdb/admission/export_student_formulir'); ?>" method="POST">  
                                                                <input type="text" id="id_check_form" class="form-control" value="" name="data_check" style="display:none">                         
                                                                <button class="dropdown-item" role="button" type="submit"><i class="flaticon-doc"></i> Laporan .pdf</button>
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
                            <!--begin: Datatable-->
                            <table class="table table-separate table-hover table-light-success table-checkable" id="kt_datatable_income_dpb">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Invoice</th>
                                        <th>Tgl Invoice</th>
                                        <th>Nama Siswa</th>
                                        <th>No. Pembayaran</th>
                                        <th>Tingkat</th>
                                        <th>Kelas</th>
                                        <th>Nominal Tagihan</th>
                                        <th>Status</th>                                                                       
                                        <th>TA</th>
                                        <th>Semester</th>                                       
                                        <th>Bulan</th>
                                        <th>Waktu Transaksi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($income)) {
                                        foreach ($income as $key => $value) {
                                            ?>
                                            <tr>
                                                <td ><?php echo $value->id_tagihan_pembayaran_dpb; ?></td>
                                                <td class="font-weight-bolder">
                                                    <?php echo $value->id_invoice; ?>
                                                </td>
                                                <td class="font-weight-bolder text-danger"><?php echo $value->tgl_invoice; ?></td>
                                                <td class="font-weight-bolder"><?php echo ucwords(strtolower($value->nama_lengkap)); ?></td>
                                                <td class="font-weight-bolder text-warning"><?php echo (($value->nomor_pembayaran_dpb)); ?></td>
                                                <td class="font-weight-bolder"><?php echo (($value->level_tingkat)); ?></td>
                                                <td class="font-weight-bolder"><?php echo (($value->nama_tingkat)); ?></td>
                                                <td class="font-weight-bolder"><?php echo number_format($value->nominal_tagihan, 0, ',', '.'); ?></td>
                                                <td><?php echo $value->status_pembayaran; ?></td>  
                                                <td><?php echo $value->tahun_ajaran; ?></td>                    
                                                <td class="font-weight-bolder"><?php echo $value->semester; ?></td>
                                                <td class="font-weight-bolder"><?php echo bulanindo($value->bulan_invoice); ?></td>
                                                <td class="font-weight-bolder text-success">
                                                    <?php if ($value->tgl_transaksi) { ?>
                                                        <?php echo $value->tgl_transaksi; ?>
                                                    <?php } else { ?>
                                                        00/00/0000
                                                    <?php } ?>
                                                </td>
                                                <td nowrap="nowrap">
                                                    <div class="dropdown dropdown-inline">
                                                        <a href="javascript:;" class="btn btn-xs  btn-clean btn-icon btn-outline-primary" data-toggle="dropdown">
                                                            <i class="la la-cog"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <ul class="nav nav-hover flex-column">    
                                                                <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/income/detail_income_dpb/" . paramEncrypt($value->id_tagihan_pembayaran_dpb)); ?>"><i class="nav-icon fas fa-eye"></i><span class="nav-text text-hover-primary font-weight-bold">Lihat Detail</span></a></li>
                                                            </ul>                                                           
                                                            <?php if ($value->status_pembayaran == "MENUNGGU") { ?>
                                                                <ul class="nav nav-hover flex-column">    
                                                                    <li class="nav-item"><a class="nav-link text-warning" href="<?php echo site_url("/finance/income/edit_income_dpb/" . paramEncrypt($value->id_tagihan_pembayaran_dpb)); ?>"><i class="nav-icon fas fa-pen text-warning"></i><span class="nav-text text-hover-primary font-weight-bold text-warning">Edit Tagihan</span></a></li>
                                                                </ul>   
                                                                <ul class="nav nav-hover flex-column">    
                                                                    <li class="nav-item"><a class="nav-link" href="javascript:act_delete_income('<?php echo paramEncrypt($value->id_tagihan_pembayaran_dpb); ?>', '<?php echo paramEncrypt($value->nis); ?>', '<?php echo strtoupper(preg_replace('/[^A-Za-z0-9\-]/', ' ', $value->nama_lengkap)); ?>', '<?php echo strtoupper($value->nis); ?>')"><i class="nav-icon fas fa-trash text-danger"></i><span class="nav-text text-danger font-weight-bold text-hover-primary">Hapus Tagihan</span></a></li>
                                                                </ul> 
                                                            <?php } ?> 
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }  //ngatur nomor urut
                                    }
                                    ?>         
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th colspan="2" class="font-weight-boldest text-danger"><b>TOTAL TAGIHAN</b></th>                                                                            
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="font-weight-boldest text-danger">Nominal Pemasukan</th>
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
    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
</div>
<div class="modal fade" id="modal_search_payment" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Daftar Tagihan DPB Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" method="POST" action="<?php echo site_url('finance/income/income/search_student_payment_dpb'); ?>" enctype="multipart/form-data"  id="kt_search_payment">
                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">                   
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label>Nomor Pembayaran DPB Siswa</label>
                                <input type="text" name="nomor_pembayaran_dpb" class="form-control form-control-solid form-control-lg " placeholder="Inputkan Nomor Pembayaran DPB Siswa" >
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>Inputkan Nomor Pembayaran DPB Siswa</span>
                            </div>
                        </div>                      
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success font-weight-bold mr-2">Cari</button>
                    <button type="reset" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_import_payment" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document" id="kt_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Tagihan Siswa DPB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form" method="POST" action="<?php echo site_url('finance/income/income/import_dpb_payment'); ?>" enctype="multipart/form-data"  id="kt_upload_payment_dpb">
                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">                   
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label>Upload File Excel Tagihan</label>
                                <input type="file" class="dropify_import form-control" name="file_tagihan_dpb" data-max-file-size="10M" data-height="200" data-allowed-file-extensions="xls xlsx" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>format xls, xlsx dan ukuran < 10Mb</span>
                            </div>
                        </div>                      
                        <!--begin::Action-->
                        <div class="col-xl-12">
                            <div class="form-group text-center">
                                <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_site_key') ?>"></div>  
                            </div>
                        </div>
                        <!--begin::Action-->
                        <div class="col-xl-2 text-center"></div>
                        <div class="col-xl-8 text-center">
                            <div class="form-group">
                                <label>Password Anda</label>
                                <input type="password" name="pass_verification" class="form-control form-control-solid form-control-lg " placeholder="Inputkan Password Anda" >
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>Inputkan Password Anda</span>
                            </div>
                        </div>          
                        <div class="col-xl-2 text-center"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="kt_login_signin_submit" class="btn btn-success font-weight-bold mr-2">Upload</button>
                    <button type="reset" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Content-->
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/crud/forms/validation/form-controls-search-payment_dpb.js">
</script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/crud/datatables/search-options/budget-income-dpb.js">
</script>
<script>
    $(document).ready(function () {
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

    $(document).ready(function () {
        var lvl_tingkat;
        var value;
        $("#tingkat").change(function () {
            lvl_tingkat = $(this).val();

            if (lvl_tingkat == "KB") {
                value = 1;
            } else if (lvl_tingkat == "TK") {
                value = 2;
            } else if (lvl_tingkat == "SD") {
                value = 3;
            } else if (lvl_tingkat == "SMP") {
                value = 4;
            }
            var url = "<?php echo site_url('finance/income/income/add_ajax_grade/'); ?>" + value;
            $('#kelas').load(url);
            return false;
        });

    });
</script>
<script>
    function act_delete_income(id, name, nis) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            title: "Peringatan!",
            text: "Apakah anda yakin ingin menghapus Tagihan atas Nama " + name + " (" + nis + ") ?",
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
                    url: "<?php echo site_url("/finance/income/income/delete_income_dpb") ?>",
                    data: {id: id, [csrfName]: csrfHash},
                    dataType: 'html',
                    success: function (result) {
                        Swal.fire("Terhapus!", "Tagihan atas Nama " + name + " (" + nis + ") telah terhapus.", "success");
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
                Swal.fire("Dibatalkan!", "Tagihan atas Nama " + name + " (" + nis + ") batal dihapus.", "error");
            }
        });
    }
</script>
