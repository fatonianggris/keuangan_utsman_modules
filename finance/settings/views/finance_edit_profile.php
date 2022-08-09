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
                            <a href="" class="text-muted">Edit Profile</a>
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
                        <div class="card-header">
                            <h3 class="card-title">
                                Edit Akun Profile
                            </h3>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" action="<?php echo site_url('finance/settings/account/update_account_profile/' . paramEncrypt($account[0]->id_akun_keuangan)); ?>" enctype="multipart/form-data" method="post" id="kt_add_account_form">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label>Nama Lengkap Anda</label>
                                            <input type="text" name="nama_akun" value="<?php echo $account[0]->nama_akun; ?>" class="form-control form-control-lg"  placeholder="Isikan Nama Akun"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Nama akun</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Email Akun</label>
                                            <input type="text" name="email_akun" value="<?php echo $account[0]->email_akun; ?>" class="form-control  form-control-lg"  placeholder="Isikan Email Akun"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Email Akun</span>               
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Nomor Handphone</label>
                                            <input type="text" name="nomor_handphone_akun" value="<?php echo $account[0]->nomor_handphone_akun; ?>" class="form-control  form-control-lg"  placeholder="Isikan Nomor Handphone"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Nomor Handphone</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-2 mb-3" >
                                        <label>Ubah password?</label>
                                        <div class="input-group">
                                            <input data-switch="true" class="ubahpass" data-size="large" type="checkbox" data-on-text="Ya"  data-off-text="Tidak" />
                                        </div>
                                        <span class="form-text text-dark"><b class="text-danger"></b>*Aktifkan jika ingin mengubah password</span>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Password Baru</label>
                                            <input type="password" name="password" class="form-control  form-control-lg"  placeholder="Isikan Password Baru" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Password Baru</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Konfirmasi Password Baru</label>
                                            <input type="password" name="cf_password" class="form-control  form-control-lg"  placeholder="Isikan Password Baru" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Password Baru</span>               
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
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-account-finance-edit.js"></script>


<script>

    $(document).ready(function () {
        var id_cost;

        $("#id_jenis_voucher").change(function () {
            id_cost = $(this).val();
            var url = "<?php echo site_url('/finance/settings/voucher/add_ajax_cost_option_add'); ?>/" + id_cost;
            $('#id_nama_biaya').load(url);
            return false;
        });

    });
</script>