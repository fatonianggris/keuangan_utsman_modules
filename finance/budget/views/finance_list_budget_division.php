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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Anggaran</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Daftar Anggaran Bidang</a>
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
                    <!--begin::Entry-->
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-layers-1 text-primary"></i>
                                </span>
                                <h3 class="card-label">Daftar Histori Anggaran "<?php echo ucwords(strtolower($user[0]->nama_struktur)); ?>"</h3>
                            </div>
                            <div class="card-toolbar">
                                <?php if ($user[0]->id_role_struktur == 4 || $user[0]->id_role_struktur == 5 || $user[0]->id_role_struktur == 6 || $user[0]->id_role_struktur == 9) { ?>
                                    <a href="<?php echo site_url("/finance/budget/add_budget_fondation") ?>" class="btn btn-primary btn-md" >
                                        <i class="flaticon2-add"></i>Ajukan Proposal
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Search Form-->
                            <form class="mb-6">
                                <div class="row mb-6">
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Nama Anggaran:</label>
                                        <input type="text" class="form-control datatable-input" placeholder="Inputkan Nama Anggaran" data-col-index="1" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Pemohon:</label>
                                        <select class="form-control datatable-input" data-col-index="2">        
                                            <option value="">Pilih Pemohon</option>
                                            <?php
                                            if (!empty($account)) {
                                                foreach ($account as $key => $value) {
                                                    if ($value->role_akun == $user[0]->role_akun) {
                                                        ?> 
                                                        <option value="<?php echo strtoupper($value->nama_akun); ?>"><?php echo strtoupper(strtolower($value->nama_akun)); ?></option>
                                                        <?php
                                                    }
                                                }  //ngatur nomor urut
                                            }
                                            ?>       
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Dana Diajukan:</label>
                                        <input type="text" class="form-control datatable-input" placeholder="Inputkan Dana Diajukan" data-col-index="3" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Status Proposal:</label>
                                        <select class="form-control datatable-input" data-col-index="4">
                                            <option value="">Pilih Status Proposal</option>
                                            <option value="Diproses">Diproses</option>
                                            <option value="Diproses*">Diproses*</option>
                                            <option value="Diterima">Diterima</option>
                                            <option value="Ditolak">Ditolak</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Dana Acc:</label>
                                        <input type="text" class="form-control datatable-input" placeholder="Inputkan Dana Acc" data-col-index="6" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Dana Eksternal:</label>
                                        <input type="text" class="form-control datatable-input" placeholder="Inputkan Dana Eksternal" data-col-index="7" />
                                    </div>

                                </div>
                                <div class="row mb-8">
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Dana Terpakai:</label>
                                        <input type="text" class="form-control datatable-input" placeholder="Inputkan Dana Terpakai" data-col-index="7" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Dana Sisa:</label>
                                        <input type="text" class="form-control datatable-input" placeholder="Inputkan Dana Sisa" data-col-index="8" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Status LPJ:</label>
                                        <select class="form-control datatable-input" data-col-index="9">
                                            <option value="">Pilih Status LPJ</option>
                                            <option value="Diproses">Diproses</option>
                                            <option value="Diterima">Diterima</option>
                                            <option value="Ditolak">Ditolak</option>
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

                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Status Tahun Ajaran:</label>
                                        <select class="form-control datatable-input" data-col-index="10">
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
                            <!--begin: Datatable-->
                            <!--begin: Datatable-->
                            <table class="table table-separate table-hover table-light-warning table-checkable" id="kt_datatable">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Nama Anggaran</th>
                                        <th>Pemohon</th>
                                        <th>Dana Diajukan</th>
                                        <th>Proposal</th>
                                        <th>Dana Eksternal</th>
                                        <th>Dana Acc</th>
                                        <th>Dana Terpakai</th>
                                        <th>Dana Sisa</th>
                                        <th>LPJ</th>                                        
                                        <th>TA</th>
                                        <th>Bulan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($budget)) {
                                        foreach ($budget as $key => $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $value->id_anggaran; ?></td>
                                                <td class="font-weight-bolder"><?php echo ucwords(strtolower($value->nama_anggaran)); ?></td>
                                                <td class="font-weight-bolder text-warning"><?php echo strtoupper($value->nama_akun); ?></td>
                                                <td class="font-weight-bolder"><?php echo number_format($value->nominal_dana_awal, 0, ',', '.'); ?></td>
                                                <td><?php echo $value->status_acc_proposal; ?></td>                                               
                                                <td class="font-weight-bolder">
                                                    <?php if ($value->nominal_dana_eksternal == NULL || $value->nominal_dana_eksternal == "") { ?>
                                                        0
                                                    <?php } else { ?>
                                                        <?php echo number_format($value->nominal_dana_eksternal, 0, ',', '.'); ?>
                                                    <?php } ?>
                                                </td>
                                                <td class="font-weight-bolder">
                                                    <?php if ($value->nominal_dana_acc == NULL || $value->nominal_dana_acc == "") { ?>
                                                        0
                                                    <?php } else { ?>
                                                        <?php echo number_format($value->nominal_dana_acc, 0, ',', '.'); ?>
                                                    <?php } ?>
                                                </td>
                                                <td class="font-weight-bolder">
                                                    <?php if ($value->nominal_dana_terpakai == NULL || $value->nominal_dana_terpakai == "") { ?>
                                                        0
                                                    <?php } else { ?>
                                                        <?php echo number_format($value->nominal_dana_terpakai, 0, ',', '.'); ?>
                                                    <?php } ?>
                                                </td>
                                                <td class="font-weight-bolder">
                                                    <?php if ($value->nominal_dana_sisa == NULL || $value->nominal_dana_sisa == "") { ?>
                                                        0
                                                    <?php } else { ?>
                                                        <?php echo number_format($value->nominal_dana_sisa, 0, ',', '.'); ?>
                                                    <?php } ?>
                                                </td>                                              
                                                <td><?php echo $value->status_acc_lpj; ?></td>
                                                <td class="font-weight-bolder"><?php echo $value->tahun_ajaran; ?></td>
                                                <td><?php echo bulanindo($value->bulan); ?></td>
                                                <td nowrap="nowrap">
                                                    <div class="dropdown dropdown-inline">
                                                        <a href="javascript:;" class="btn btn-xs  btn-clean btn-icon btn-outline-primary" data-toggle="dropdown">
                                                            <i class="la la-cog"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <ul class="nav nav-hover flex-column">
                                                                <?php if ($user[0]->id_akun_keuangan == $value->id_akun_keuangan) { ?>                                                               
                                                                    <?php if ($value->status_acc_proposal == 2 && $value->status_acc_lpj == 0) { ?>
                                                                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/budget/upload_lpj_fondation/" . paramEncrypt($value->id_anggaran)); ?>"><i class="nav-icon la la-upload text-success"></i><span class="nav-text text-success font-weight-bold text-hover-primary">Upload LPJ</span></a></li>
                                                                    <?php } ?>
                                                                    <?php if ($value->status_acc_lpj == 1) { ?>
                                                                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/budget/upload_lpj_fondation/" . paramEncrypt($value->id_anggaran)); ?>"><i class="nav-icon la la-pencil-ruler text-warning"></i><span class="nav-text text-warning font-weight-bold text-hover-primary">Edit LPJ</span></a></li>
                                                                    <?php } else if ($value->status_acc_lpj == 3) { ?>
                                                                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/budget/upload_lpj_fondation/" . paramEncrypt($value->id_anggaran)); ?>"><i class="nav-icon la la-pencil-ruler text-warning"></i><span class="nav-text text-warning font-weight-bold text-hover-primary">Revisi LPJ</span></a></li>
                                                                    <?php } ?>
                                                                    <?php if ($value->status_acc_proposal == 0) { ?>
                                                                        <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/budget/edit_proposal_fondation/" . paramEncrypt($value->id_anggaran)); ?>"><i class="nav-icon la la-pencil-ruler text-warning"></i><span class="nav-text text-warning font-weight-bold text-hover-primary">Edit Anggaran</span></a></li>
                                                                        <li class="nav-item"><a class="nav-link" href="javascript:act_delete_budget('<?php echo paramEncrypt($value->id_anggaran); ?>', '<?php echo strtoupper($value->nama_anggaran); ?>')"><i class="nav-icon la la-trash text-danger"></i><span class="nav-text text-danger font-weight-bold text-hover-primary">Hapus Anggaran</span></a></li>
                                                                    <?php } ?>
                                                                <?php } ?>                                                            
                                                                <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/budget/detail_budget_fondation/" . paramEncrypt($value->id_anggaran)); ?>"><i class="nav-icon la la-eye "></i><span class="nav-text text-hover-primary font-weight-bold">Lihat Anggaran</span></a></li>
                                                            </ul>
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
                                        <th class="font-weight-boldest text-danger"><b>TOTAL DANA</b></th>
                                        <th></th>
                                        <th class="font-weight-boldest text-danger">Dana Awal</th>
                                        <th></th>
                                        <th class="font-weight-boldest text-danger">Dana Eksternal</th>
                                        <th class="font-weight-boldest text-danger">Dana Acc</th>
                                        <th class="font-weight-boldest text-danger">Dana Terpakai</th>
                                        <th class="font-weight-boldest text-danger">Dana Sisa</th>
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
<!--end::Content-->
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/crud/datatables/search-options/budget-division.js">
</script>
