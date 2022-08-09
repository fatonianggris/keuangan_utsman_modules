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
                            <a href="" class="text-muted">Pengajuan Pengeluaran Sekolah</a>
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
                <div class="col-lg-12" id="kt_form" >
                    <!--begin::Card-->
                    <div class="card card-custom" >
                        <div class="card-header mt-2">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Formulir Pengajuan Pengeluaran
                                    <span class="text-muted pt-2 font-size-sm d-block">Silahakan isi formulir pengeluaran dana sekolah sesuai dengan inputan</span>
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" action="<?php echo site_url('finance/outcome/post_nota_outcome'); ?>" enctype="multipart/form-data" method="post" id="kt_add_outcome_form">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nama Pengeluaran</label>
                                            <input type="text" name="nama_pengeluaran" class="form-control form-control-lg"  placeholder="Isikan Nama Pengeluaran"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Nama Pengeluaran</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="jenis_pengeluaran" class="form-control form-control-lg" >
                                                <option value="">Pilih Kategori</option>
                                                <?php
                                                if (!empty($structure)) {
                                                    foreach ($structure as $key => $value) {
                                                        ?> 
                                                        <option value="<?php echo $value->id_struktur; ?>"><?php echo ucwords(strtolower($value->nama_struktur)); ?></option>
                                                        <?php
                                                    }  //ngatur nomor urut
                                                }
                                                ?>                                            
                                            </select>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH, </b>pilih Kategori Bidang</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nominal Pengeluaran</label>
                                            <input type="text" name="nominal_pengeluaran" class="form-control form-control-lg"  placeholder="Isikan Nominal"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Pengeluaran Diajukan</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Jenis Pembayaran</label>
                                            <select  name="status_pembayaran" class="form-control form-control-lg" id="pembayaran">
                                                <option value="">Pilih Pembayaran</option>
                                                <option value="1">Transfer</option>
                                                <option value="2">Tunai</option>                                           
                                            </select>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH, </b>pilih Jenis Pembayaran</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Tahun Ajaran</label>
                                            <select name="id_tahun_ajaran" class="form-control form-control-lg">
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
                                            </select>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Email Akun</span>               
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Upload File Nota Pengeluaran</label>
                                            <input type="file" class="dropify-outcome" name="file_nota" data-max-file-size="5M" data-height="225" data-allowed-file-extensions="png jpg jpeg" />
                                            <span class="form-text text-dark"><b class='text-danger'>*WAJIB DIISI, </b>File berformat png,jpg,jpeg dan berukuran dibawah 5Mb.</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label>Uraian Pengeluaran</label>
                                            <textarea class="form-control" id="kt-ckeditor-1" placeholder="Isikan Uraian Pengeluaran" name="uraian" rows="2"></textarea>
                                            <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>isikan Uraian Pengeluaran singkat</span>               
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="card-footer">
                                <button id="kt_login_signin_submit" class="btn btn-success font-weight-bold px-9 py-4 my-3 mx-4">Simpan</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-outcome.js"></script>

