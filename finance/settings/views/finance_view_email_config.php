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
                            <a href="" class="text-muted">Konfigurasi Email</a>
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
                                Edit Konfigurasi Email
                            </h3>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" action="<?php echo site_url('finance/settings/settings/update_mailer'); ?>" enctype="multipart/form-data" method="post" id="kt_add_mailer_form">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Nama Email Pengirim</label>
                                            <input type="text" name="nama_pengirim" value="<?php echo $mailer[0]->nama_pengirim ?>" class="form-control  form-control-lg"  placeholder="Isikan Nama Email Pengirim"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Nama Email Pengirim, Contoh : "Sekolah Utsman"</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Host Email</label>
                                            <input type="text" name="host" value="<?php echo $mailer[0]->host ?>"  class="form-control  form-control-lg"  placeholder="Isikan Host Email"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Host Email, Contoh : "smtp.gmail.com"</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Email Induk</label>
                                            <input type="text" name="email_induk" value="<?php echo $mailer[0]->email_induk ?>"  class="form-control  form-control-lg"  placeholder="Isikan Email Induk"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Email Induk</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Password Email Induk</label>
                                            <input type="password" name="password" value="<?php echo $mailer[0]->password ?>"  class="form-control  form-control-lg"  placeholder="Isikan Passoword Email Induk"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Passoword Email Induk</span>               
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Port Email</label>
                                            <input type="text" name="port" value="<?php echo $mailer[0]->port ?>"  class="form-control  form-control-lg"  placeholder="Isikan Port Email"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Port Email, Contoh : "465"</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>SMTP Auth</label>
                                            <select name="smtp_auth" class="form-control form-control-lg">
                                                <option value="<?php echo $mailer[0]->smtp_auth; ?>" selected="">
                                                    <?php
                                                    if ($mailer[0]->smtp_auth == 'true') {
                                                        echo 'TRUE';
                                                    } else if ($mailer[0]->smtp_auth == 'false') {
                                                        echo 'FALSE';
                                                    }
                                                    ?>
                                                </option>
                                                <option value="true">TRUE</option>
                                                <option value="false">FALSE</option>                                                
                                            </select> 
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>pilih SMTP Auth </span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>SMTP Secure</label>
                                            <input type="text" name="smtp_secure" value="<?php echo $mailer[0]->smtp_secure ?>" class="form-control  form-control-lg"  placeholder="Isikan SMTP Secure"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan SMTP Secure, Contoh : "SSL" </span>               
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
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-mailer-finance.js"></script>