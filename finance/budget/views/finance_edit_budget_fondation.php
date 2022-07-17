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
                            <a href="" class="text-muted">Pengajuan Anggaran Yayasan</a>
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
                                    Edit Formulir Pengajuan Anggaran Yayasan
                                    <span class="text-muted pt-2 font-size-sm d-block">Silahakan edit formulir pengajuan dana anggaran sesuai dengan inputan</span>
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" action="<?php echo site_url('finance/budget/update_budget_fondation/' . paramEncrypt($budget[0]->id_anggaran)); ?>" enctype="multipart/form-data" method="post" id="kt_edit_budget_form">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Proposal Anggaran</label>                                           
                                            <input type="text" name="nama_anggaran" value="<?php echo strtoupper(strtolower($budget[0]->nama_anggaran)); ?>" class="form-control form-control-lg"  placeholder="Isikan Nama Proposal Anggaran"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Nama Proposal Anggaran</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nominal Dana Diajukan</label>
                                            <input type="text" name="nominal_dana_awal" value="<?php echo (($budget[0]->nominal_dana_awal)); ?>"  class="form-control  form-control-lg"  placeholder="Isikan Nominal Dana Diajukan"/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Nominal Dana Diajukan</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Waktu Penggunaan Dana</label>
                                            <input type="text" name="waktu" value="<?php echo substr($budget[0]->waktu, 3); ?>"  id="kt_datepicker_waktu" class="form-control  form-control-lg"  placeholder="Isikan Waktu Anggaran" readonly=""/>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>isikan Waktu Penggunaan Dana</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Tahun Ajaran</label>
                                            <select name="id_tahun_ajaran" class="form-control form-control-lg">
                                                <option value="<?php echo (($budget[0]->id_tahun_ajaran)); ?>"><?php echo (($budget[0]->tahun_ajaran)); ?></option>
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
                                            <label>Upload Proposal Anggaran <a href="#" class="font-weight-bolder" data-toggle="modal" data-target="#modal_proposal">*KLIK LIHAT FILE LAMA</a></label>
                                            <input type="file" class="dropify" name="file_laporan_proposal" data-default-file="<?php echo base_url() .$budget[0]->file_laporan_proposal; ?>" data-max-file-size="25M" data-height="225" data-allowed-file-extensions="pdf" />
                                            <input type="hidden" name="file_laporan_proposal_old" value="<?php echo  $budget[0]->file_laporan_proposal; ?>" style="display:none" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI, </b>File berformat pdf dan berukuran dibawah 5Mb.</span>               
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <label>Uraian Anggaran</label>
                                            <textarea class="form-control" id="kt-ckeditor-1" placeholder="Isikan Uraian Anggaran" name="uraian" rows="2"><?php echo (($budget[0]->nama_anggaran)); ?></textarea>
                                            <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI, </b>isikan Uraian Anggaran Singkat yang terdapat di proposal</span>               
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
<div class="modal-file fade" id="modal_proposal" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">File Proposal "<?php echo strtoupper($budget[0]->nama_anggaran); ?>"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <?php if ($budget[0]->file_laporan_proposal != NULL || $budget[0]->file_laporan_proposal != "") { ?>
                    <iframe src="<?php echo base_url() . $budget[0]->file_laporan_proposal; ?>#zoom=85" width="100%" height="500"></iframe>
                <?php } else { ?>
                    <iframe id="iframe" width="100%" height="500" ></iframe>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-light-danger font-weight-bold" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/edit-budget-fondation.js"></script>
