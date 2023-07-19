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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Pengeluaran</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Daftar Pengeluaran Sekolah</a>
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
                                <h3 class="card-label">Daftar Pengeluaran Sekolah</h3>
                            </div>
                            <div class="card-toolbar">
                                <?php if ($user[0]->id_role_struktur == 7 || $user[0]->id_role_struktur == 5) { ?>
                                    <a href="<?php echo site_url("/finance/outcome/add_nota_outcome") ?>" class="btn btn-primary btn-md">
                                        <i class="flaticon2-add"></i>Ajukan Pengeluaran
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Search Form-->
                            <form class="mb-6">
                                <div class="row mb-6">
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Nama Pengeluaran:</label>
                                        <input type="text" class="form-control datatable-input" placeholder="Inputkan Nama Pengeluaran" data-col-index="1" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Kategori:</label>
                                        <select class="form-control datatable-input" data-col-index="2">
                                            <option value="">Pilih Kategori</option>
                                            <?php
                                            if (!empty($structure)) {
                                                foreach ($structure as $key => $value) {
                                            ?>
                                                    <option value="<?php echo $value->nama_struktur; ?>"><?php echo ucwords(strtolower($value->nama_struktur)); ?></option>
                                            <?php
                                                }  //ngatur nomor urut
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Nominal Pengeluaran:</label>
                                        <input type="text" class="form-control datatable-input" placeholder="Inputkan Dana Pengeluaran" data-col-index="3" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Jenjang Pengeluaran:</label>
                                        <select class="form-control datatable-input" data-col-index="4">
                                            <option value="">Pilih Jenjang</option>
                                            <option value="KB">KB</option>
                                            <option value="TK">TK</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="UMUM">UMUM</option>
                                            <option value="">SEMUA</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Jenis Pembayaran:</label>
                                        <select class="form-control datatable-input" data-col-index="5">
                                            <option value="">Pilih Jenis Pembayaran</option>
                                            <option value="Transfer">Transfer</option>
                                            <option value="Tunai">Tunai</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Status ACC:</label>
                                        <select class="form-control datatable-input" data-col-index="6">
                                            <option value="">Pilih Status Acc</option>
                                            <option value="Diproses">Diproses</option>
                                            <option value="Diterima">Diterima</option>
                                            <option value="Ditolak">Ditolak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Bulan:</label>
                                        <select class="form-control datatable-input" data-col-index="10">
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
                                        <label>Tahun Ajaran:</label>
                                        <select class="form-control datatable-input" data-col-index="7">
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
                            <table class="table table-separate table-hover table-light-warning table-checkable" id="kt_datatable_outcome">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Nama Pengeluaran</th>
                                        <th>Kategori</th>
                                        <th>Nominal Pengeluaran</th>
                                        <th>Jenjang</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Status ACC</th>
                                        <th>TA</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal ACC</th>
                                        <th>Bulan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($outcome)) {
                                        foreach ($outcome as $key => $value) {
                                    ?>
                                            <tr>
                                                <td><?php echo $value->id_pengeluaran; ?></td>
                                                <td class="font-weight-bolder"><?php echo ucwords(strtolower($value->nama_pengeluaran)); ?></td>
                                                <td class="font-weight-bolder text-primary"><?php echo strtoupper(strtolower($value->kategori_bidang)); ?></td>
                                                <td class="font-weight-bolder"><?php echo number_format($value->nominal_pengeluaran, 0, ',', '.'); ?></td>
                                                <td><?php echo $value->jenjang_pengeluaran; ?></td>
                                                <td><?php echo $value->status_pembayaran; ?></td>
                                                <td><?php echo $value->status_pengeluaran; ?></td>
                                                <td class="font-weight-bolder"><?php echo $value->tahun_ajaran; ?></td>
                                                <td class="font-weight-bolder"><?php echo $value->tanggal_pengajuan; ?></td>
                                                <td class="font-weight-bolder">
                                                    <?php if ($value->tanggal_acc_pengeluaran == NULL || $value->tanggal_acc_pengeluaran == "") { ?>
                                                        MENUNGGU
                                                    <?php } else { ?>
                                                        <?php echo $value->tanggal_acc_pengeluaran; ?>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo bulanindo($value->bulan); ?></td>
                                                <td nowrap="nowrap">
                                                    <div class="dropdown dropdown-inline">
                                                        <a href="javascript:;" class="btn btn-xs  btn-clean btn-icon btn-outline-primary" data-toggle="dropdown">
                                                            <i class="la la-cog"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <ul class="nav nav-hover flex-column">
                                                                <?php if ($user[0]->id_role_struktur == 7) { ?>
                                                                    <?php if ($user[0]->id_akun_keuangan == $value->id_akun_keuangan) { ?>
                                                                        <?php if ($value->status_pengeluaran == 0 && $user[0]->id_role_struktur == 7) { ?>
                                                                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/outcome/edit_nota_outcome/" . paramEncrypt($value->id_pengeluaran)); ?>"><i class="nav-icon la la-pencil-ruler text-warning"></i><span class="nav-text text-warning font-weight-bold text-hover-primary">Edit</span></a></li>
                                                                            <li class="nav-item"><a class="nav-link" href="javascript:act_delete_outcome('<?php echo paramEncrypt($value->id_pengeluaran); ?>', '<?php echo strtoupper($value->nama_pengeluaran); ?>')"><i class="nav-icon la la-trash text-danger"></i><span class="nav-text text-danger font-weight-bold text-hover-primary">Hapus</span></a></li>
                                                                        <?php } else if ($value->status_pengeluaran == 1 && $user[0]->id_role_struktur == 7) { ?>
                                                                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/outcome/edit_nota_outcome/" . paramEncrypt($value->id_pengeluaran)); ?>"><i class="nav-icon la la-pencil-ruler text-warning"></i><span class="nav-text text-warning font-weight-bold text-hover-primary">Edit</span></a></li>
                                                                        <?php } else if ($value->status_pengeluaran == 2 && $user[0]->id_role_struktur == 7) { ?>
                                                                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/outcome/edit_nota_outcome/" . paramEncrypt($value->id_pengeluaran)); ?>"><i class="nav-icon la la-pencil-ruler text-warning"></i><span class="nav-text text-warning font-weight-bold text-hover-primary">Revisi</span></a></li>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } else if ($user[0]->id_role_struktur == 5) { ?>
                                                                    <?php if ($user[0]->id_akun_keuangan == $value->id_akun_keuangan) { ?>
                                                                        <?php if ($value->status_pengeluaran == 0 && $user[0]->id_role_struktur == 5) { ?>
                                                                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/outcome/acc_outcome/" . paramEncrypt($value->id_pengeluaran)); ?>"><i class="nav-icon la la-hand-pointer text-success"></i><span class="nav-text text-success font-weight-bold text-hover-primary">Upload & Acc</span></a></li>
                                                                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/outcome/edit_nota_outcome/" . paramEncrypt($value->id_pengeluaran)); ?>"><i class="nav-icon la la-pencil-ruler text-warning"></i><span class="nav-text text-warning font-weight-bold text-hover-primary">Edit</span></a></li>
                                                                        <?php } else if ($value->status_pengeluaran == 1 && $user[0]->id_role_struktur == 5) { ?>
                                                                            <?php if ($value->status_pembayaran == 1) { ?>
                                                                                <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/outcome/acc_outcome/" . paramEncrypt($value->id_pengeluaran)); ?>"><i class="nav-icon la la-pencil-ruler text-warning"></i><span class="nav-text text-warning font-weight-bold text-hover-primary">Ubah Bukti</span></a></li>
                                                                            <?php } ?>
                                                                            <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/outcome/edit_nota_outcome/" . paramEncrypt($value->id_pengeluaran)); ?>"><i class="nav-icon la la-pencil-ruler text-warning"></i><span class="nav-text text-warning font-weight-bold text-hover-primary">Edit</span></a></li>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                    <li class="nav-item"><a class="nav-link" href="javascript:act_delete_outcome('<?php echo paramEncrypt($value->id_pengeluaran); ?>', '<?php echo strtoupper($value->nama_pengeluaran); ?>')"><i class="nav-icon la la-trash text-danger"></i><span class="nav-text text-danger font-weight-bold text-hover-primary">Hapus</span></a></li>
                                                                <?php } ?>
                                                                <li class="nav-item"><a class="nav-link" href="<?php echo site_url("/finance/outcome/detail_outcome/" . paramEncrypt($value->id_pengeluaran)); ?>"><i class="nav-icon la la-eye"></i><span class="nav-text text-hover-primary font-weight-bold">Lihat Detail</span></a></li>
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
                                        <th class="font-weight-boldest text-danger">Nominal Pengeluaran</th>
                                        <th></th>
                                        <th></th>
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
<!--end::Content-->
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/crud/datatables/search-options/budget-outcome.js">
</script>
<script>
    function act_delete_outcome(id, name) {
        var csrfName = $('.txt_csrfname').attr('name');
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        Swal.fire({
            title: "Peringatan!",
            text: "Apakah anda yakin ingin menghapus Anggaran atas nama " + name + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Tidak, batal!",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url("/finance/outcome/delete_outcome") ?>",
                    data: {
                        id: id,
                        [csrfName]: csrfHash
                    },
                    dataType: 'html',
                    success: function(result) {
                        Swal.fire("Terhapus!", "Anggaran atas nama '" + name + "' telah terhapus.", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(result) {
                        console.log(result);
                        Swal.fire("Opsss!", "Koneksi Internet Bermasalah.", "error");
                    }
                });

            } else {
                Swal.fire("Dibatalkan!", "Anggaran atas nama " + name + " batal dihapus.", "error");
            }
        });
    }
</script>
