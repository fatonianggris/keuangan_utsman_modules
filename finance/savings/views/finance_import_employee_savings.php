<!--begin::Content-->
<?php $user = $this->session->userdata('sias-finance');?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">

                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Tabungan Pegawai</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Hasil Import Tabungan Pegawai</a>
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
            <!--begin::Notice-->
            <?php echo $this->session->flashdata('flash_message'); ?>
            <!--end::Notice-->
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Entry-->
                    <div class="px-mobile">
                        <div class="alert alert-custom alert-light-default shadow-sm alert-shadow fade show"
                            role="alert">
                            <div class="alert-text font-weight-bolder text-center text-dark">
                                <h1 class="font-weight-boldest text-danger">
                                    <li class="fas fa-exclamation-triangle"></li> HASIL IMPORT NASABAH TABUNGAN PEGAWAI
                                    <li class="fas fa-exclamation-triangle"></li>
                                </h1>
                                MOHON UNTUK DIPERHATIKAN!!.<br> Silahkan
                                Melakukan Pengecekan Kembali dengan data Asli, Terima Kasih!
                            </div>
                        </div>
                    </div>
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-layers-1 text-primary"></i>
                                </span>
                                <h3 class="card-label">Hasil Import Nasabah Tabungan Pegawai</h3>

                            </div>

                            <div class="card-toolbar">
                                <div class="buttons">

                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="paper">
                            <div class="card-body">
                                <!--begin: Search Form-->
                                <div class="row mb-4">
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Nomor Rekening/NIP:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nomor Rekening" data-col-index="1" />
                                    </div>
                                    <div class="col-lg-4 mb-lg-0 mb-6">
                                        <label>Nama Pegawai:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nama Pegawai" data-col-index="2" />
                                    </div>
									<div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Jenis Kelamin</label>
                                        <select type="text" class="form-control datatable-input" data-col-index="3">
                                            <option value="">Pilih JK</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                            <option value="">SEMUA</option>
                                            <!-- <option value="5">SMA</option> -->
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Tahun Ajaran:</label>
                                        <select class="form-control datatable-input" data-col-index="4">
                                            <option value="">Pilih Tahun Ajaran</option>
                                            <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value) {
        ?>
                                            <option
                                                value="<?php echo $value->tahun_awal . "/" . $value->tahun_akhir; ?>">
                                                <?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?>
                                            </option>
                                            <?php
} //ngatur nomor urut
}
?>
                                            <option value="">Semua</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Tingkat</label>
                                        <select name="input_tingkat" class="form-control datatable-input"
                                            data-col-index="5">
                                            <option value="">Pilih Tingkat</option>
                                            <option value="DC">DC</option>
                                            <option value="KB/TK">KB/TK</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="UMUM">UMUM</option>
                                            <option value="">SEMUA</option>
                                            <!-- <option value="5">SMA</option> -->
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Status Nasabah</label>
                                        <select class="form-control datatable-input" data-col-index="12">
                                            <option value="">Pilih Status</option>
                                            <option value="DUPLIKAT">DUPLIKAT</option>
                                            <option value="NON DUPLIKAT">NON DUPLIKAT</option>
                                            <option value="">SEMUA</option>
                                            <!-- <option value="5">SMA</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-8">
                                    <div class="row col-lg-7">
                                        <div class="col-lg-12 mb-lg-0 mb-6">
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
                                    </div>
                                    <div class="row col-lg-5">
                                        <div class="col-lg-4 mb-lg-0 mb-6 text-right">

                                        </div>
                                        <div class="col-lg-6 mb-lg-0 mb-6">

                                        </div>
                                        <div class="col-lg-2 mb-lg-0 mb-6">

                                        </div>
                                    </div>
                                </div>

                                <!--begin: Datatable-->
                            </div>
                            <div class="table-responsive">
                                <table class="table table-separate table-hover table-light-default table-checkable"
                                    id="table_transcation">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>NIP</th>
                                            <th>Nama Nasabah/Pegawai</th>
											<th>JK</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Tingkat</th>
                                            <th>Status Pegawai</th>
                                            <th>Nomor HP</th>
                                            <th>Email</th>
                                            <th>Saldo</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tb_transaksi">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
											<th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="font-weight-bolder">TOTAL SALDO</th>
                                            <th class="font-weight-bolder text-dark">-</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="pb-1 text-center" style="justify-content: center">
                                <button id="btn_accept_import" class="btn btn-success btn-lg font-weight-bold mr-7"><i
                                        class="fas fa-check-circle "></i>KONFIRMASI IMPOR DATA NASABAH</button>
                                <button id="btn_reject_import" class="btn btn-danger btn-lg font-weight-bold ml-7"><i
                                        class="fas fa-window-close"></i>BATALKAN IMPOR DATA NASABAH</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
        value="<?php echo $this->security->get_csrf_hash(); ?>">
</div>
<!--end::Content-->

<!-- Modal Debet  -->
<div class="modal fade" tabindex="" role="dialog" id="modalEditImportNasabah">
    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
        value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_edit_import_pegawai">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="modal-title font-weight-bolder">Edit Profil Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_form_edit_pegawai">
                <div class="modal-body">
                    <input type="hidden" class="hidden" name="id_nasabah">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> NIP Nasabah</label>
                                <input type="text" class="form-control form-control-lg nip_pegawai" name="nip_pegewai">
                                <input type="hidden" name="old_nip">
                                </input>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Isikan NIP
                                    Pegawai</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Nama Pegawai/Nasabah</label>
                                <input type="text" name="nama_pegawai" class="form-control form-control-lg nama_pegawai"
                                    placeholder="Inputkan Nama Lengkap Pegawai" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Isikan Nama
                                    Pegawai/Nasabah</span>
                            </div>
                        </div>
						<div class="col-lg-2">
                            <div class="form-group">
                                <label> Jenis Kelamin </label>
                                <select name="jenis_kelamin" class="form-control form-control-lg jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
									<option value="1">Laki-Laki</option>
									<option value="2">Perempuan</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH</b></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="th_ajaran" class="form-control form-control-lg th_ajaran" disabled>
                                    <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value_sch) {

        ?>
                                    <option value="<?php echo $value_sch->id_tahun_ajaran; ?>">
                                        <?php echo $value_sch->tahun_awal; ?>/<?php echo $value_sch->tahun_akhir; ?>
                                    </option>
                                    <?php
}
}
?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="level_tingkat" class="form-control form-control-lg level_tingkat">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="7">DC</option>
                                    <option value="1">KB/TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                    <option value="6">UMUM</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH</b></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tanggal Transaksi </label>
                                <input type="text" name="tanggal_transaksi"
                                    class="form-control form-control-lg tanggal_transaksi"
                                    placeholder="Inputkan Tanggal Transaksi" disabled />
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <label> Status Pegawai </label>
                                <select name="status_pegawai" class="form-control form-control-lg status_pegawai">
                                    <option value="">Pilih Status Pegawai</option>
                                    <option value="1">Tetap</option>
                                    <option value="2">Tidak Tetap</option>
                                    <option value="3">Honorer</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIPILIH</b></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Nomor Handphone </label>
                                <input type="text" name="nomor_handphone"
                                    class="form-control form-control-lg nomor_handphone"
                                    placeholder="Inputkan Nomor Handphone" />
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b> Isikan
                                    Nomor Handphone
                                    Wali/Nasabah</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Email Nasabah/Pegawai </label>
                                <input type="text" name="email_pegawai"
                                    class="form-control form-control-lg email_pegawai"
                                    placeholder="Inputkan Email Pegawai" />
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b> Isikan
                                    Email
                                    Pegawai/Nasabah</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label> Saldo </label>
                                <input type="text" name="saldo_umum" class="form-control form-control-lg saldo_umum"
                                    placeholder="Inputkan Saldo" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Isikan
                                    Nominal Saldo</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success font-weight-bolder" id="btnUpdateNasabah"
                        disabled="disabled">Simpan
                        !</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Debet  -->
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/blur.pin.js"></script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/list-import-personal-saving.js">
</script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/edit-import-personal.js">
</script>
