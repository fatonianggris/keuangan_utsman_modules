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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Tabungan</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Pengajuan Tambah Tabungan Bersama</a>
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
                <div class="col-lg-12" id="kt_form">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header mt-2">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Formulir Pengajuan Tabungan Bersama
                                    <span class="text-muted pt-2 font-size-sm d-block">Silahakan isi formulir tabungan
                                        bersama sesuai dengan inputan</span>
                                </h3>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate"
                            action="<?php echo site_url('finance/outcome/post_nota_outcome'); ?>"
                            enctype="multipart/form-data" method="post" id="kt_add_joint_saving">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nomor Rekening Bersama</label>
                                            <input type="text" name="inputNomorRekeningBersama"
                                                class="form-control form-control-lg"
                                                placeholder="Isikan Nomor Rekening" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Nomor Rekening Bersama</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Nama Rekening Bersama</label>
                                            <input type="text" name="inputNamaRekeningBersama"
                                                class="form-control form-control-lg"
                                                placeholder="Isikan Nama Rekening Bersama" />
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Nama Rekening Bersama</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Nominal Saldo Awal</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text font-weight-bolder">
                                                        Rp
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-control-lg kt_money_input_kredit"
                                                    name="inputNominalSaldoAwal" id="inputNominalSaldoAwal"
                                                    placeholder="Input nominal saldo" />
                                            </div>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                                    DIISI,</b>
                                                isikan
                                                nominal saldo</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Tahun Ajaran</label>
                                            <select name="inputTahunAjaran" class="form-control form-control-lg">
                                                <option value="">Pilih Tahun Ajaran</option>
                                                <?php
                                                if (!empty($schoolyear)) {
                                                    foreach ($schoolyear as $key => $value) {
                                                        ?>
                                                <option value="<?php echo $value->id_tahun_ajaran; ?>">
                                                    <?php echo $value->tahun_awal; ?>/<?php echo $value->tahun_akhir; ?>
                                                </option>
                                                <?php
                                                    }  //ngatur nomor urut
                                                }
                                                ?>
                                            </select>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIISI,
                                                </b>isikan Tahun Ajaran</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Jenjang</label>
                                            <select name="inputJenjang" class="form-control form-control-lg">
                                                <option value="">Pilih Jenjang</option>
                                                <option value="1">KB</option>
                                                <option value="2">TK</option>
                                                <option value="3">SD</option>
                                                <option value="4">SMP</option>
                                                <!-- <option value="5">SMA</option> -->
                                            </select>
                                            <span class="form-text text-dark"><b class="text-danger">*WAJIB DIPILIH,
                                                </b>pilih Jenjang</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Nama Wali/Orang Tua Penanggung Jawab</label>
                                                    <input class="form-control" name="inputNamaWaliPenanggungJawab"
                                                        placeholder='Inputkan Nama Wali Penanggung Jawab' />
                                                    <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                                            DIISI,</b>
                                                        isikan
                                                        nama Penanggung Jawab</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Nomor HP Wali/Orang Tua Penanggung Jawab</label>
                                                    <input class="form-control" name="inputNomorWaliPenanggungJawab"
                                                        placeholder='Inputkan Nomor HP Wali Penanggung Jawab' />
                                                    <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                                            DIISI,</b>
                                                        isikan
                                                        nomor HP Penanggung Jawab</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Nama Siswa Penanggung Jawab</label>
                                                    <select name="inputNamaSiswaPenanggungJawab"
                                                        id="inputNamaSiswaPenanggungJawab"
                                                        class="form-control form-control-lg select2 inputNamaSiswaPenanggungJawab">
                                                    </select>
                                                    <span class="form-text text-dark"><b class="text-danger">*WAJIB
                                                            DIISI,
                                                        </b>isikan Siswa Penanggung Jawab, boleh lebih dari
                                                        satu</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Keterangan Tabungan Bersama</label>
                                                    <textarea class="form-control" id="inputCatatanKredit"
                                                        placeholder="Isikan Catatan Kredit" name="uraian"
                                                        rows="7"></textarea>
                                                    <span class="form-text text-dark"><b class="text-dark">*TIDAK WAJIB
                                                            DIISI,
                                                        </b>Isikan
                                                        Keterangan Tabungan Bersama</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button id="kt_login_signin_submit"
                                    class="btn btn-success font-weight-bold px-9 py-4 my-3 mx-4">Simpan</button>
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
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/custom/login/add-joint-saving.js"></script>
<script>
list_join_saving();

$('#inputNamaSiswaPenanggungJawab').select2({
    placeholder: "Pilih Siswa Penanggung Jawab",
});

function list_join_saving() {
    $.ajax({
        type: "GET",
        url: `${HOST_URL}finance/savings/savings/get_all_student`,
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        success: function(data) {
            var html = "";
            var option = "<option></option>";
            var i;
            for (i = 0; i < data.length; i++) {
                html +=
                    '<option value="' +
                    data[i].id_siswa +
                    '"> ' + `${data[i].nama_lengkap} ` + `(${data[i].nis})` +
                    "</option>";
            }
            $("#inputNamaSiswaPenanggungJawab").html(option + html);
        },
    });
}
</script>
