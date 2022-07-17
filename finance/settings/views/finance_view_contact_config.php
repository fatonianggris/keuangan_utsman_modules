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
                            <a href="" class="text-muted">Konfigurasi Kontak</a>
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
                <div class="col-lg-12">
                    <!--begin::Card-->
                    <div class="card card-custom" id="kt_form" >
                        <div class="card-header">
                            <h3 class="card-title">
                                Edit Konfigurasi Kontak Website
                            </h3>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" action="<?php echo site_url('finance/settings/settings/update_contact'); ?>" enctype="multipart/form-data" method="post" id="kt_add_contact_form">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="card-body">
                               
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Nomor Telepon Kantor</label>
                                            <input type="text" name="nomor_telephone" value="<?php echo $contact[0]->nomor_telephone ?>" class="form-control  form-control-lg"  placeholder="Isikan Nomor Telepon Kantor"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Nomor Telepone Kantor</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Nomor WA Kantor TU</label>
                                            <input type="text" name="no_handphone" value="<?php echo $contact[0]->no_handphone ?>" class="form-control  form-control-lg"  placeholder="Isikan Nomor Handphone Kantor TU"/>
                                            <span class="form-text text-dark"><b class="text-danger">*TIDAK WAJIB DIISI, </b>isikan Nomor Handphone Kantor TU</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Email Website</label>
                                            <input type="text" name="email" value="<?php echo $contact[0]->email ?>"  class="form-control  form-control-lg" placeholder="Isikan Email Website"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Email Website</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>URL Website</label>
                                            <input type="text" name="url_website" value="<?php echo $contact[0]->url_website ?>"  class="form-control  form-control-lg"  placeholder="Isikan URL Website"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan URL Website</span>               
                                        </div>
                                    </div>       
                                </div>
                                <div class="row">                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Alamat Kantor</label>
                                            <textarea class="form-control" placeholder="Isikan Alamat" name="alamat" rows="2"><?php echo $contact[0]->alamat; ?></textarea>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Alamat Kantor</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Jam Kerja Kantor</label>
                                            <textarea class="form-control" placeholder="Isikan Jam Kerja" name="jam_kerja" rows="2"><?php echo $contact[0]->jam_kerja; ?></textarea>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Jam Kerja Kantor</span>               
                                        </div>
                                    </div>
                                </div>
                                <div class="row">      
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Link Instagram Official</label>
                                            <input type="text" name="akun_instagram" value="<?php echo $contact[0]->akun_instagram; ?>" class="form-control  form-control-lg"  placeholder="Isikan Link Instagram Official"/>
                                            <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>isikan Link Instagram Official </span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Link Facebook Official</label>
                                            <input type="text" name="akun_facebook" value="<?php echo $contact[0]->akun_facebook; ?>" class="form-control  form-control-lg"  placeholder="Isikan Link Facebook Official"/>
                                            <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>isikan Link Facebook Official</span>               
                                        </div>
                                    </div>
                                </div>
                                <div class="row">      
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Link Twitter Official</label>
                                            <input type="text" name="akun_twitter" value="<?php echo $contact[0]->akun_twitter; ?>" class="form-control  form-control-lg"  placeholder="Isikan Link Twitter Official"/>
                                            <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>isikan Link Twitter Official </span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Link Youtube Official</label>
                                            <input type="text" name="akun_youtube" value="<?php echo $contact[0]->akun_youtube; ?>" class="form-control  form-control-lg"  placeholder="Isikan Link Youtube Official"/>
                                            <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>isikan Link Youtube Official</span>               
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
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-contact-finance.js"></script>