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
                            <a href="" class="text-muted">Detail Pemasukan Sekolah</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="Quick actions" data-placement="top">
                <a onclick="window.history.back();" class="btn btn-light-danger btn-sm font-weight-bold"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        class="fa fa-backward"></i>Kembali</a>
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
                <div class="col-lg-12" id="kt_form">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header mt-2" style="justify-content: center">
                            <div class="card-title text-center">
                                <h2 class="card-label font-size-h1 font-weight-bolder">
                                    Detail Tagihan DU "<?php echo strtoupper(strtolower($income[0]->nama)); ?>" -
                                    <?php echo $income[0]->nis; ?>
                                    <span class="pt-2 font-size-sm d-block text-warning">Berikut detail Tagihan DU Siswa
                                        sesuai kode Invoice</span>
                                </h2>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" enctype="multipart/form-data" method="post">

                            <div class="card-body text-center">
                                <div class="row border-bottom">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="font-weight-bolder">Invoice</label>
                                            <input type="text" id="kt_input_nop" name="nomor_nop" disabled=""
                                                value="<?php echo $income[0]->id_invoice; ?>"
                                                class="form-control form-control-solid form-control-lg" />
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="font-weight-bolder">Tanggal Invoice</label>
                                            <input type="text" name="tahun_pajak" disabled=""
                                                value="<?php echo $income[0]->tanggal_invoice; ?>"
                                                class="input-reset form-control-solid  form-control form-control-lg" />
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="font-weight-bolder">Waktu Transaksi</label>
                                            <input type="text" name="nik_wajib_pajak" id="kt_input_nik" disabled=""
                                                value="<?php echo $income[0]->waktu_transaksi; ?>"
                                                class="form-control form-control-solid  form-control-lg" />
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="text-center">
                                            <label class="font-weight-bolder font-size-h6 ">Tahun Ajaran</label>
                                        </div>
                                        <p class="font-weight-boldest font-size-h1 text-info">
                                            <?php echo $income[0]->tahun_ajaran; ?></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="text-center">
                                            <label class="font-weight-bolder font-size-h6 ">Semester</label>
                                        </div>
                                        <p class="font-weight-boldest font-size-h1 text-info">
                                            <?php echo strtoupper($income[0]->semester); ?></p>
                                    </div>
                                </div>
                                <div class="row border-bottom">
                                    <div class="col-lg-6 border-right border-left">
                                        <div class="row mt-2">
                                            <div class="col-lg-12">
                                                <h6
                                                    class="text-center font-weight-bolder mb-5 mt-5 font-size-h4 text-warning">
                                                    Identitas Siswa
                                                </h6>
                                            </div>
                                            <div class="form-group col-lg-12 col-12">
                                                <label class="font-weight-bold">Nama Siswa</label>
                                                <textarea class="form-control form-control-solid" disabled=""
                                                    name="letak_objek_pajak"
                                                    rows="2"><?php echo $income[0]->nama; ?></textarea>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">NIS</label>
                                                <input type="text" name="tahun_pajak" disabled=""
                                                    value="<?php echo $income[0]->nis; ?>"
                                                    class="input-reset form-control-solid  form-control form-control-lg" />

                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Tingkat</label>
                                                <input type="text" name="" disabled="" value="<?php
																								if ($income[0]->level_tingkat == '6') {
																									echo 'DC';
																								} else if ($income[0]->level_tingkat == '1') {
																									echo'KB';
																								} else if ($income[0]->level_tingkat == '2') {
																									echo 'TK';
																								} else if ($income[0]->level_tingkat == '3') {
																									echo 'SD';
																								} else if ($income[0]->level_tingkat == '4') {
																									echo 'SMP';
																								}
																								?>" class="input-reset form-control-solid  form-control form-control-lg" />
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Kelas</label>
                                                <input type="text" name="tahun_pajak" disabled=""
                                                    value="<?php $tingkat = explode(" ", $income[0]->informasi); echo $tingkat[1]." ".@$tingkat[2]; ?>"
                                                    class="input-reset form-control-solid  form-control form-control-lg" />
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Nama Kelas</label>
                                                <input type="text" name="tahun_pajak" disabled=""
                                                    value="<?php echo $income[0]->nama_kelas; ?>"
                                                    class="input-reset form-control-solid  form-control form-control-lg" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 border-right border-left">
                                        <div class="row mt-2">
                                            <div class="col-lg-12">
                                                <h6
                                                    class="text-center font-weight-bolder mb-5 mt-5 font-size-h4 text-warning">
                                                    Identitas Transfer Tagihan
                                                </h6>
                                            </div>
                                            <div class="form-group col-lg-12 col-12">
                                                <label class="font-weight-bold">Rincian</label>
                                                <textarea class="form-control" disabled="" name="alamat_wajib_pajak"
                                                    rows="2"><?php echo $income[0]->rincian; ?></textarea>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Tanggal Invoice</label>
                                                <input type="text" name="nama_wajib_pajak" disabled=""
                                                    value="<?php echo $income[0]->tanggal_invoice; ?>"
                                                    class="form-control  form-control-lg" />

                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Nomor Jurnal Pembukuan</label>
                                                <input type="text" name="nama_wajib_pajak" disabled=""
                                                    value="<?php echo $income[0]->nomor_jurnal_pembukuan; ?>"
                                                    class="form-control  form-control-lg" />
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Informasi</label>
                                                <textarea class="form-control" disabled="" name="alamat_wajib_pajak"
                                                    rows="2"><?php echo $income[0]->informasi; ?></textarea>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label class="font-weight-bold">Catatan</label>
                                                <textarea class="form-control" disabled="" name="alamat_wajib_pajak"
                                                    rows="2"><?php echo $income[0]->catatan; ?></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 row">
                                    <div class="col-lg-2 text-center">
                                        <div class="text-center">
                                            <label class="font-weight-bolder font-size-h6 ">Tipe Tagihan</label>
                                        </div>
                                        <?php if ($income[0]->tipe_tagihan == 2) { ?>
                                        <p class="font-weight-boldest display-3 mb-1 text-warning text-center">DU</p>
                                        <?php } elseif ($income[0]->tipe_tagihan == 1) { ?>
                                        <p class="font-weight-boldest display-3 mb-1 text-success text-center">DPB</p>
                                        <?php } ?>
                                    </div>
                                    <div class="col-lg-3 text-center">
                                        <div class="text-center">
                                            <label class="font-weight-bolder font-size-h6 ">Chanel Pembayaran</label>
                                        </div>
                                        <p class="font-weight-boldest display-3 mb-1 text-warning text-center">
                                            <?php if($income[0]->channel_pembayaran=="" || $income[0]->channel_pembayaran==null) {
												echo "-";
											} else {
												echo strtoupper($income[0]->channel_pembayaran);
											}?>
                                        </p>
                                    </div>
                                    <div class="col-lg-4 text-center">
                                        <div class="text-center">
                                            <label class="font-weight-bolder font-size-h6 ">Nominal Tagihan</label>
                                        </div>
                                        <p class="font-weight-boldest display-3 mb-1 text-warning text-danger">Rp.
                                            <?php echo number_format($income[0]->nominal_tagihan, 0, ',', '.'); ?></p>
                                    </div>
                                    <div class="col-lg-3 text-center">
                                        <div class="text-center">
                                            <label class="font-weight-bolder font-size-h6">Status Pembayaran</label>
                                        </div>
                                        <div class=" text-center ">
                                            <?php if ($income[0]->status_pembayaran == "MENUNGGU") { ?>
                                            <p class="font-weight-boldest display-3 mb-1 text-warning text-center">
                                                MENUNGGU</p>
                                            <?php } else if ($income[0]->status_pembayaran == "SUKSES") { ?>
                                            <p class="font-weight-boldest display-3 mb-1 text-success">SUKSES</p>
                                            <?php } else if ($income[0]->status_pembayaran == "GAGAL") { ?>
                                            <p class="font-weight-boldest display-3 mb-1 text-danger">GAGAL</p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
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
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/panzoom/dist/panzoom.min.js">
</script>
