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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Tabungan Bersama</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Daftar Tabungan Bersama</a>
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
                        <div class="alert alert-custom alert-light-dark shadow-sm alert-shadow fade show" role="alert">
                            <div class="alert-text font-weight-bolder text-center text-dark">
                                <h1 class="font-weight-boldest text-danger">
                                    <li class="fas fa-exclamation-triangle"></li> DAFTAR TABUNGAN BERSAMA <li
                                        class="fas fa-exclamation-triangle">
                                </h1>
                                MOHON UNTUK DIPERHATIKAN!!.<br> Silahkan
                                Melakukan Pengecekan Kembali Untuk Transaksi KREDIT/DEBET Terima Kasih!
                            </div>
                        </div>
                    </div>
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-layers-1 text-primary"></i>
                                </span>
                                <h3 class="card-label">Daftar Nasabah Tabungan Bersama</h3>
                            </div>
                            <div class="card-toolbar">
                                <div class="buttons">
                                    <a href="<?php echo site_url("/finance/savings/add_joint_saving") ?>"
                                        class="btn btn-success mr-2">
                                        <i class="fa fa-plus"></i> Tambah Tabungan Baru
                                    </a>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalRekap"
                                        id="btnRekap">
                                        <i class="fa fa-suitcase"></i> Lihat Rekap
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="paper">
                            <div class="card-body">
                                <!--begin: Search Form-->

                                <div class="row mb-4">
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Nomor Rekening Bersama:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nomor Rekening" data-col-index="1" />
                                    </div>
                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>Nama Tabungan:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nama Tabungan" data-col-index="2" />
                                    </div>
                                    <div class="col-lg-3 mb-lg-0 mb-6">
                                        <label>Penanggung Jawab:</label>
                                        <input type="text" class="form-control datatable-input"
                                            placeholder="Inputkan Nama Penanggung Jawab" data-col-index="3" />
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Tahun Ajaran:</label>
                                        <select class="form-control datatable-input" data-col-index="6">
                                            <option value="">Pilih Tahun Ajaran</option>
                                            <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value) {
        ?>
                                            <option
                                                value="<?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?>">
                                                <?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?>
                                            </option>
                                            <?php
} //ngatur nomor urut
}
?>
                                            <option value="">SEMUA</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 mb-lg-0 mb-6">
                                        <label>Tingkat</label>
                                        <select class="form-control datatable-input" data-col-index="7">
                                            <option value="">Pilih Tingkat</option>
                                            <option value="DC">DC</option>
                                            <option value="KB">KB</option>
                                            <option value="TK">TK</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
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
                                            <span class="font-weight-bolder">Tampilkan Perhitungan Dari Tanggal</span>
                                        </div>
                                        <div class="col-lg-6 mb-lg-0 mb-6">
                                            <div class="input-group" id="kt_daterangepicker_6">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="la la-calendar-check-o"></i></span>
                                                </div>
                                                <input type="text" class="form-control font-weight-bolder" readonly=""
                                                    placeholder="Select date range">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mb-lg-0 mb-6">
                                            <div class="btn-group">
                                                <button class="btn btn-warning font-weight-bold dropdown-toggle"
                                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="true">
                                                    <i class="flaticon2-download"></i>
                                                    Export
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button id="btn_excel" class="dropdown-item" role="button"
                                                        type="submit"><i class="flaticon2-checking"></i> Laporan
                                                        .csv</button>

                                                    <button id="btn_pdf" class="dropdown-item" role="button"
                                                        type="submit"><i class="flaticon-doc"></i> Laporan
                                                        .pdf</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--begin: Datatable-->
                            </div>
                            <div class="table-responsive">
                                <table class="table table-separate table-hover table-light-dark table-checkable"
                                    id="table_transcation">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>No. Rekening</th>
                                            <th>Nama Tabungan</th>
                                            <th>Penanggung Jawab</th>
                                            <th>No. Handphone</th>
                                            <th>Email</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Tingkat</th>
                                            <th>Kredit (Rp)</th>
                                            <th>Debet (Rp)</th>
                                            <th>Saldo (Rp)</th>
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
                                            <th class="font-weight-bolder">TOTAL TRANSAKSI</th>
                                            <th class="font-weight-bolder text-success">-</th>
                                            <th class="font-weight-bolder text-danger">-</th>
                                            <th class="font-weight-bolder text-dark">-</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->

<!-- Modal Debet  -->
<div class="modal fade" tabindex="" role="dialog" id="modalEditJoint">
    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
        value="<?php echo $this->security->get_csrf_hash(); ?>">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_edit_joint">
        <div class="modal-content">
            <div class="modal-header bg-default">
                <h5 class="modal-title font-weight-bolder">Edit Tabungan Bersama</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form needs-validation" novalidate="novalidate" action="#" id="kt_form_edit_joint">
                <div class="modal-body">
                    <input type="hidden" class="hidden" name="id_tabungan_bersama">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Nomor Rekening Bersama</label>
                                <input class="form-control form-control-lg nomor_rekening_bersama form-control-solid"
                                    name="nomor_rekening_bersama" readonly>
                                </input>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label> Nama Tabungan Bersama</label>
                                <input type="text" name="nama_tabungan_bersama"
                                    class="form-control form-control-lg nama_tabungan_bersama"
                                    placeholder="Inputkan Nama Tabungan Bersama" />
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Isikan Nama
                                    Tabungan Bersama</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label> Tingkat </label>
                                <select name="id_tingkat" class="form-control form-control-lg id_tingkat">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="6">DC</option>
                                    <option value="1">KB</option>
                                    <option value="2">TK</option>
                                    <option value="3">SD</option>
                                    <option value="4">SMP</option>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH</b></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tahun Ajaran</label>
                                <select name="id_th_ajaran" class="form-control form-control-lg id_th_ajaran">
                                    <option value="">Pilih TA</option>
                                    <?php
if (!empty($schoolyear)) {
    foreach ($schoolyear as $key => $value) {
        ?>
                                    <option value="<?php echo $value->id_tahun_ajaran; ?>">
                                        <?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?>
                                    </option>
                                    <?php
} //ngatur nomor urut
}
?>
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,
                                    </b>isikan Tahun Ajaran</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Siswa Penanggung Jawab</label>
                                <select name="id_siswa_penanggung_jawab" id="id_siswa_penanggung_jawab"
                                    class="form-control form-control-lg select2 id_siswa_penanggung_jawab">
                                </select>
                                <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                        DIISI,
                                    </b>isikan Siswa Penanggung Jawab, Perwakilan salah satu
                                    satu</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Wali/Orang Tua Penanggung Jawab</label>
                                <input type="text" name="nama_wali" class="form-control form-control-lg"
                                    placeholder="Inputkan Nama Wali" />
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b> Isikan
                                    Nama
                                    Wali/Nasabah</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nomor HP Wali/Orang Tua Penanggung Jawab</label>
                                <input type="text" name="nomor_handphone_wali" class="form-control form-control-lg"
                                    placeholder="Inputkan Nomor Handphone Wali" />
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB DIISI,</b> Isikan
                                    Nomor Handphone
                                    Wali/Nasabah</span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Keterangan Tabungan Bersama</label>
                                <textarea class="form-control" name="keterangan_tabungan_bersama"
                                    placeholder="Isikan Keterangan Tabungan Bersama" rows="4"></textarea>
                                <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                        DIISI,
                                    </b>Isikan
                                    Keterangan Tabungan Bersama</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-whitesmoke ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success font-weight-bolder" id="btnUpdateTabungan">Simpan
                        !</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Debet  -->

<!-- Modal Rekap -->
<div class="modal fade" tabindex="" role="dialog" id="modalRekap">
    <div class="modal-dialog modal-lg" role="document" id="kt_form_recap">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title font-weight-bolder"> Lihat Rekap Tabungan Bersama</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" novalidate="novalidate"
                action="<?php echo site_url('finance/savings/get_joint_transaction_recap'); ?>"
                enctype="multipart/form-data" method="post" id="kt_add_transaction_recap">
                <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label> Input Nomor Rekeming Bersama</label>
                            <select name="nomor_rekening_bersama" class="form-control select2 findRekapTabungan"
                                id="findRekapTabungan">
                            </select>
                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,</b> Inpukan
                                Nomor Rekening Bersama</span>
                        </div>
                        <div class="col-md-12">
                            <div class="alert alert-secondary text-center" role="alert">
                                <b>INFO TABUNGAN BERSAMA</b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            Nama Tabungan: <label class="font-weight-bold" id="infoNamaTabunganRekap">-</label><br>
                            PJ: <label class="font-weight-bold timeago"
                                id="infoPenanggungJawabRekap">-</label><br>
                            Tingkat: <label class="font-weight-bold" id="infoTingkatRekap">-</label>
                        </div>
                        <div class="col-md-6">
                            Catatan: <label class="font-weight-bold" id="infoCatatanRekap">-</label><br>
                            Transaksi Terakhir: <label class="font-weight-bold timeago"
                                id="infoTerakhirTransaksiRekap">-</label><br>
                            Saldo: <label class="font-weight-bold" id="infoSaldoRekap">-</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary font-weight-bolder" id="kt_login_signin_submit"> LIHAT DATA
                        !</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Rekap -->
<script>
<?php if ($user[0]->id_role_struktur == 5) {?>
var id_role = 5;
<?php } else {?>
var id_role = 7;
<?php }?>

</script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/list-joint-saving.js">
</script>
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/edit-joint-saving.js"></script>
