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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Detail Dashboard Admin</a>
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
            <?php if ($user[0]->id_role_struktur == 7) { ?>
            <?php } else { ?>            
                <div class="row">
                    <!--begin::Stats Widget 28-->
                    <div class="col-xl-3 col-6">
                        <!--begin::Tiles Widget 11-->
                        <div class="card card-custom bg-info gutter-b" >
                            <div class="card-body">
                                <span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                                            <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3 text-white">
                                    <?php if ($budget_total[0]->dana_terpakai == NULL || $budget_total[0]->dana_terpakai == "") { ?>
                                        Rp. 0
                                    <?php } else { ?>
                                        Rp. <?php echo number_format($budget_total[0]->dana_terpakai, 0, ',', '.'); ?>
                                    <?php } ?>
                                </div>
                                <a href="#" class="text-inverse-primary font-weight-bold font-size-lg mt-1 text-white">TOTAL ANGGARAN TERPAKAI</a>
                            </div>
                        </div>
                        <!--end::Tiles Widget 11-->
                    </div>

                    <!--end::Stats Widget 25-->
                    <div class="col-xl-3 col-6">
                        <!--begin::Stats Widget 26-->                    
                        <div class="card card-custom bg-warning gutter-b">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <rect fill="#000000" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/>
                                            <rect fill="#000000" x="2" y="8" width="20" height="3"/>
                                            <rect fill="#000000" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3 text-white">
                                    <?php if ($budget_total[0]->dana_eksternal == NULL || $budget_total[0]->dana_eksternal == "") { ?>
                                        Rp. 0
                                    <?php } else { ?>
                                        Rp. <?php echo number_format($budget_total[0]->dana_eksternal, 0, ',', '.'); ?>
                                    <?php } ?>
                                </div>
                                <a href="#" class="text-inverse-primary font-weight-bold font-size-lg mt-1 text-white">TOTAL ANGGARAN EKSTERNAL</a>
                            </div>
                        </div>
                        <!--end::Tiles Widget 11-->
                    </div>
                    <!--end::Stats Widget 26-->
                    <!--end::Stats Widget 25-->
                    <div class="col-xl-3 col-6">
                        <!--begin::Stats Widget 26-->                    
                        <div class="card card-custom bg-success gutter-b">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <rect fill="#000000" opacity="0.3" x="2" y="2" width="20" height="20" rx="10"/>
                                            <path d="M6.16794971,14.5547002 C5.86159725,14.0951715 5.98577112,13.4743022 6.4452998,13.1679497 C6.90482849,12.8615972 7.52569784,12.9857711 7.83205029,13.4452998 C8.9890854,15.1808525 10.3543313,16 12,16 C13.6456687,16 15.0109146,15.1808525 16.1679497,13.4452998 C16.4743022,12.9857711 17.0951715,12.8615972 17.5547002,13.1679497 C18.0142289,13.4743022 18.1384028,14.0951715 17.8320503,14.5547002 C16.3224187,16.8191475 14.3543313,18 12,18 C9.64566871,18 7.67758127,16.8191475 6.16794971,14.5547002 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3 text-white">
                                    <?php if ($budget_total[0]->dana_acc == NULL || $budget_total[0]->dana_acc == "") { ?>
                                        Rp. 0
                                    <?php } else { ?>
                                        Rp. <?php echo number_format($budget_total[0]->dana_acc, 0, ',', '.'); ?>
                                    <?php } ?>
                                </div>
                                <a href="#" class="text-inverse-primary font-weight-bold font-size-lg mt-1 text-white">TOTAL ANGGARAN ACC</a>
                            </div>
                        </div>
                        <!--end::Tiles Widget 11-->
                    </div>
                    <!--end::Stats Widget 26-->
                    <!--end::Stats Widget 25-->
                    <div class="col-xl-3 col-6">
                        <!--begin::Stats Widget 26-->                    
                        <div class="card card-custom bg-danger gutter-b">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-3x svg-icon-white ml-n2">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <rect fill="#000000" opacity="0.3" x="2" y="2" width="20" height="20" rx="10"/>
                                            <path d="M6.16794971,14.5547002 C5.86159725,14.0951715 5.98577112,13.4743022 6.4452998,13.1679497 C6.90482849,12.8615972 7.52569784,12.9857711 7.83205029,13.4452998 C8.9890854,15.1808525 10.3543313,16 12,16 C13.6456687,16 15.0109146,15.1808525 16.1679497,13.4452998 C16.4743022,12.9857711 17.0951715,12.8615972 17.5547002,13.1679497 C18.0142289,13.4743022 18.1384028,14.0951715 17.8320503,14.5547002 C16.3224187,16.8191475 14.3543313,18 12,18 C9.64566871,18 7.67758127,16.8191475 6.16794971,14.5547002 Z" fill="#000000" transform="translate(12.000000, 15.499947) scale(1, -1) translate(-12.000000, -15.499947) "/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3 text-white">
                                    <?php if ($budget_total[0]->dana_sisa == NULL || $budget_total[0]->dana_sisa == "") { ?>
                                        Rp. 0
                                    <?php } else { ?>
                                        Rp. <?php echo number_format($budget_total[0]->dana_sisa, 0, ',', '.'); ?>
                                    <?php } ?>
                                </div>
                                <a href="#" class="text-inverse-primary font-weight-bold font-size-lg mt-1 text-white">TOTAL ANGGARAN PENGEMBALIAN</a>
                            </div>
                        </div>
                        <!--end::Tiles Widget 11-->
                    </div>
                    <!--end::Stats Widget 26-->                
                </div>
            <?php } ?>     
            <!--end::Notice-->
            <div class="row">
                <?php if ($user[0]->id_role_struktur == 7) { ?>
                <?php } else { ?>   
                    <div class="col-lg-6 col-12">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto">
                                <!--begin::Title-->
                                <div class="card-title py-5">
                                    <h3 class="card-label">Grafik Anggaran Terpakai Tiap 3 Tahun</h3>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body">
                                <!--begin::Chart-->
                                <div id="chart_budget_terpakai"></div>
                                <!--end::Chart-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <div class="col-lg-6 col-12">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto">
                                <!--begin::Title-->
                                <div class="card-title py-5">
                                    <h3 class="card-label">Grafik Anggaran Eksternal Tiap 3 Tahun</h3>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body">
                                <!--begin::Chart-->
                                <div id="chart_budget_eksternal"></div>
                                <!--end::Chart-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <div class="col-lg-6 col-12">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto">
                                <!--begin::Title-->
                                <div class="card-title py-5">
                                    <h3 class="card-label">Grafik Anggaran ACC Tiap 3 Tahun</h3>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body">
                                <!--begin::Chart-->
                                <div id="chart_budget_acc"></div>
                                <!--end::Chart-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <div class="col-lg-6 col-12">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto">
                                <!--begin::Title-->
                                <div class="card-title py-5">
                                    <h3 class="card-label">Grafik Anggaran Sisa Tiap 3 Tahun</h3>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body">
                                <!--begin::Chart-->
                                <div id="chart_budget_sisa"></div>
                                <!--end::Chart-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                <?php } ?>  
                <div class="col-lg-8 col-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header h-auto">
                            <!--begin::Title-->
                            <div class="card-title py-5">
                                <h3 class="card-label">Grafik Pengeluaran Sisa Tiap 3 Tahun</h3>
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <div class="card-body">
                            <!--begin::Chart-->
                            <div id="chart_outcome_graf"></div>
                            <!--end::Chart-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-lg-4 col-12">
                    <!--begin::Card-->
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="card card-custom mt-0">
                                <!--begin::Header-->
                                <div class="card-header h-auto">
                                    <!--begin::Title-->
                                    <div class="card-title py-5">
                                        <h3 class="card-label">Persentase Total Pengeluaran</h3>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->
                                <div class="card-body">
                                    <!--begin::Chart-->
                                    <div id="chart_outcome_persen" class="d-flex justify-content-center"></div>
                                    <!--end::Chart-->
                                </div>
                            </div>
                            <!--end::Card-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    <input type="hidden" class="txt_csrfname" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
</div>
<!--end::Content-->
<?php
$arr_seketaris_1 = [];
$arr_bendahara_1 = [];
$arr_pendidikan_1 = [];
$arr_keagamaan_1 = [];
$arr_sosial_1 = [];
$arr_sarpras_1 = [];
$arr_dana_usaha_1 = [];
$arr_binus_1 = [];
$arr_th_1 = [];

if (!empty($budget_terpakai)) {
    foreach ($budget_terpakai as $key => $values) {
        $arr_seketaris_1[] = $values->sekertaris;
        $arr_bendahara_1[] = $values->bendahara;
        $arr_pendidikan_1[] = $values->b_pendidikan;
        $arr_keagamaan_1[] = $values->b_keagamaan;
        $arr_sosial_1[] = $values->b_sosial;
        $arr_sarpras_1[] = $values->b_sarpras;
        $arr_dana_usaha_1[] = $values->b_dana_usaha;
        $arr_binus_1[] = $values->b_binus;
        $arr_th_1[] = $values->tahun_ajaran;
    }
}
?>  
<?php
$arr_seketaris_2 = [];
$arr_bendahara_2 = [];
$arr_pendidikan_2 = [];
$arr_keagamaan_2 = [];
$arr_sosial_2 = [];
$arr_sarpras_2 = [];
$arr_dana_usaha_2 = [];
$arr_binus_2 = [];
$arr_th_2 = [];

if (!empty($budget_eksternal)) {
    foreach ($budget_eksternal as $key => $values) {
        $arr_seketaris_2[] = $values->sekertaris;
        $arr_bendahara_2[] = $values->bendahara;
        $arr_pendidikan_2[] = $values->b_pendidikan;
        $arr_keagamaan_2[] = $values->b_keagamaan;
        $arr_sosial_2[] = $values->b_sosial;
        $arr_sarpras_2[] = $values->b_sarpras;
        $arr_dana_usaha_2[] = $values->b_dana_usaha;
        $arr_binus_2[] = $values->b_binus;
        $arr_th_2[] = $values->tahun_ajaran;
    }
}
?> 
<?php
$arr_seketaris_3 = [];
$arr_bendahara_3 = [];
$arr_pendidikan_3 = [];
$arr_keagamaan_3 = [];
$arr_sosial_3 = [];
$arr_sarpras_3 = [];
$arr_dana_usaha_3 = [];
$arr_binus_3 = [];
$arr_th_3 = [];

if (!empty($budget_acc)) {
    foreach ($budget_acc as $key => $values) {
        $arr_seketaris_3[] = $values->sekertaris;
        $arr_bendahara_3[] = $values->bendahara;
        $arr_pendidikan_3[] = $values->b_pendidikan;
        $arr_keagamaan_3[] = $values->b_keagamaan;
        $arr_sosial_3[] = $values->b_sosial;
        $arr_sarpras_3[] = $values->b_sarpras;
        $arr_dana_usaha_3[] = $values->b_dana_usaha;
        $arr_binus_3[] = $values->b_binus;
        $arr_th_3[] = $values->tahun_ajaran;
    }
}
?> 
<?php
$arr_seketaris_4 = [];
$arr_bendahara_4 = [];
$arr_pendidikan_4 = [];
$arr_keagamaan_4 = [];
$arr_sosial_4 = [];
$arr_sarpras_4 = [];
$arr_dana_usaha_4 = [];
$arr_binus_4 = [];
$arr_th_4 = [];

if (!empty($budget_sisa)) {
    foreach ($budget_sisa as $key => $values) {
        $arr_seketaris_4[] = $values->sekertaris;
        $arr_bendahara_4[] = $values->bendahara;
        $arr_pendidikan_4[] = $values->b_pendidikan;
        $arr_keagamaan_4[] = $values->b_keagamaan;
        $arr_sosial_4[] = $values->b_sosial;
        $arr_sarpras_4[] = $values->b_sarpras;
        $arr_dana_usaha_4[] = $values->b_dana_usaha;
        $arr_binus_4[] = $values->b_binus;
        $arr_th_4[] = $values->tahun_ajaran;
    }
}
?> 
<?php
$arr_seketaris_5 = [];
$arr_bendahara_5 = [];
$arr_pendidikan_5 = [];
$arr_keagamaan_5 = [];
$arr_sosial_5 = [];
$arr_sarpras_5 = [];
$arr_dana_usaha_5 = [];
$arr_binus_5 = [];
$arr_th_5 = [];

if (!empty($outcome)) {
    foreach ($outcome as $key => $values) {
        $arr_seketaris_5[] = $values->sekertaris;
        $arr_bendahara_5[] = $values->bendahara;
        $arr_pendidikan_5[] = $values->b_pendidikan;
        $arr_keagamaan_5[] = $values->b_keagamaan;
        $arr_sosial_5[] = $values->b_sosial;
        $arr_sarpras_5[] = $values->b_sarpras;
        $arr_dana_usaha_5[] = $values->b_dana_usaha;
        $arr_binus_5[] = $values->b_binus;
        $arr_th_5[] = $values->tahun_ajaran;
    }
}
?> 
<script>

    var sekertaris_1 = [<?php echo implode(',', $arr_seketaris_1) ?>];
    var bendahara_1 = [<?php echo implode(',', $arr_bendahara_1) ?>];
    var pendidikan_1 = [<?php echo implode(',', $arr_pendidikan_1) ?>];
    var keagamaan_1 = [<?php echo implode(',', $arr_keagamaan_1) ?>];
    var sosial_1 = [<?php echo implode(',', $arr_sosial_1) ?>];
    var sarpras_1 = [<?php echo implode(',', $arr_sarpras_1) ?>];
    var danausaha_1 = [<?php echo implode(',', $arr_dana_usaha_1) ?>];
    var binus_1 = [<?php echo implode(',', $arr_binus_1) ?>];
    var th_1 = [<?php echo '"' . implode('","', $arr_th_1) . '"' ?>];

    var sekertaris_2 = [<?php echo implode(',', $arr_seketaris_2) ?>];
    var bendahara_2 = [<?php echo implode(',', $arr_bendahara_2) ?>];
    var pendidikan_2 = [<?php echo implode(',', $arr_pendidikan_2) ?>];
    var keagamaan_2 = [<?php echo implode(',', $arr_keagamaan_2) ?>];
    var sosial_2 = [<?php echo implode(',', $arr_sosial_2) ?>];
    var sarpras_2 = [<?php echo implode(',', $arr_sarpras_2) ?>];
    var danausaha_2 = [<?php echo implode(',', $arr_dana_usaha_2) ?>];
    var binus_2 = [<?php echo implode(',', $arr_binus_2) ?>];
    var th_2 = [<?php echo '"' . implode('","', $arr_th_2) . '"' ?>];

    var sekertaris_3 = [<?php echo implode(',', $arr_seketaris_3) ?>];
    var bendahara_3 = [<?php echo implode(',', $arr_bendahara_3) ?>];
    var pendidikan_3 = [<?php echo implode(',', $arr_pendidikan_3) ?>];
    var keagamaan_3 = [<?php echo implode(',', $arr_keagamaan_3) ?>];
    var sosial_3 = [<?php echo implode(',', $arr_sosial_3) ?>];
    var sarpras_3 = [<?php echo implode(',', $arr_sarpras_3) ?>];
    var danausaha_3 = [<?php echo implode(',', $arr_dana_usaha_3) ?>];
    var binus_3 = [<?php echo implode(',', $arr_binus_3) ?>];
    var th_3 = [<?php echo '"' . implode('","', $arr_th_3) . '"' ?>];

    var sekertaris_4 = [<?php echo implode(',', $arr_seketaris_4) ?>];
    var bendahara_4 = [<?php echo implode(',', $arr_bendahara_4) ?>];
    var pendidikan_4 = [<?php echo implode(',', $arr_pendidikan_4) ?>];
    var keagamaan_4 = [<?php echo implode(',', $arr_keagamaan_4) ?>];
    var sosial_4 = [<?php echo implode(',', $arr_sosial_4) ?>];
    var sarpras_4 = [<?php echo implode(',', $arr_sarpras_4) ?>];
    var danausaha_4 = [<?php echo implode(',', $arr_dana_usaha_4) ?>];
    var binus_4 = [<?php echo implode(',', $arr_binus_4) ?>];
    var th_4 = [<?php echo '"' . implode('","', $arr_th_4) . '"' ?>];

    var sekertaris_5 = [<?php echo implode(',', $arr_seketaris_5) ?>];
    var bendahara_5 = [<?php echo implode(',', $arr_bendahara_5) ?>];
    var pendidikan_5 = [<?php echo implode(',', $arr_pendidikan_5) ?>];
    var keagamaan_5 = [<?php echo implode(',', $arr_keagamaan_5) ?>];
    var sosial_5 = [<?php echo implode(',', $arr_sosial_5) ?>];
    var sarpras_5 = [<?php echo implode(',', $arr_sarpras_5) ?>];
    var danausaha_5 = [<?php echo implode(',', $arr_dana_usaha_5) ?>];
    var binus_5 = [<?php echo implode(',', $arr_binus_5) ?>];
    var th_5 = [<?php echo '"' . implode('","', $arr_th_5) . '"' ?>];

    "use strict";
// Shared Colors Definition
    const primary = '#6993FF';
    const success = '#1BC5BD';
    const info = '#8950FC';
    const warning = '#FFA800';
    const danger = '#F64E60';
    const dark = '#000000';
    const grey = '#808080';
    const yellow = '#ffff00';

    var KTApexChartsDemo = function () {
        // Private functions

        var _demo1 = function () {
            const apexChart = "#chart_budget_terpakai";
            var options = {
                series: [{
                        name: 'Sekertaris',
                        data: sekertaris_1
                    }, {
                        name: 'Bendahara',
                        data: bendahara_1
                    }, {
                        name: 'B.Pendidikan',
                        data: pendidikan_1
                    }, {
                        name: 'B.Keagamaan',
                        data: keagamaan_1
                    }, {
                        name: 'B.Sosial',
                        data: sosial_1
                    }, {
                        name: 'B.SarPras',
                        data: sarpras_1
                    }, {
                        name: 'B.Dana Usaha',
                        data: danausaha_1
                    }, {
                        name: 'DU/Kegiatan',
                        data: binus_1
                    }],
                chart: {
                    type: 'bar',
                    height: 320
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '70%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: th_1,
                },
                yaxis: {
                    title: {
                        text: 'Total (Rp)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val.toLocaleString("id-ID") + " Rupiah"
                        }
                    }
                },
                colors: [primary, success, warning, info, danger, dark, grey, yellow, ]
            };

            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        };

        var _demo2 = function () {
            const apexChart = "#chart_budget_eksternal";
            var options = {
                series: [{
                        name: 'Sekertaris',
                        data: sekertaris_2
                    }, {
                        name: 'Bendahara',
                        data: bendahara_2
                    }, {
                        name: 'B.Pendidikan',
                        data: pendidikan_2
                    }, {
                        name: 'B.Keagamaan',
                        data: keagamaan_2
                    }, {
                        name: 'B.Sosial',
                        data: sosial_2
                    }, {
                        name: 'B.SarPras',
                        data: sarpras_2
                    }, {
                        name: 'B.Dana Usaha',
                        data: danausaha_2
                    }, {
                        name: 'DU/Kegiatan',
                        data: binus_2
                    }],
                chart: {
                    type: 'bar',
                    height: 320
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '70%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: th_2,
                },
                yaxis: {
                    title: {
                        text: 'Total (Rp)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val.toLocaleString("id-ID") + " Rupiah"
                        }
                    }
                },
                colors: [primary, success, warning, info, danger, dark, grey, yellow, ]
            };

            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        };
        var _demo3 = function () {
            const apexChart = "#chart_budget_acc";
            var options = {
                series: [{
                        name: 'Sekertaris',
                        data: sekertaris_3
                    }, {
                        name: 'Bendahara',
                        data: bendahara_3
                    }, {
                        name: 'B.Pendidikan',
                        data: pendidikan_3
                    }, {
                        name: 'B.Keagamaan',
                        data: keagamaan_3
                    }, {
                        name: 'B.Sosial',
                        data: sosial_3
                    }, {
                        name: 'B.SarPras',
                        data: sarpras_3
                    }, {
                        name: 'B.Dana Usaha',
                        data: danausaha_3
                    }, {
                        name: 'DU/Kegiatan',
                        data: binus_3
                    }],
                chart: {
                    type: 'bar',
                    height: 320
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '70%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: th_3,
                },
                yaxis: {
                    title: {
                        text: 'Total (Rp)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val.toLocaleString("id-ID") + " Rupiah"
                        }
                    }
                },
                colors: [primary, success, warning, info, danger, dark, grey, yellow, ]
            };

            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        };

        var _demo4 = function () {
            const apexChart = "#chart_budget_sisa";
            var options = {
                series: [{
                        name: 'Sekertaris',
                        data: sekertaris_4
                    }, {
                        name: 'Bendahara',
                        data: bendahara_4
                    }, {
                        name: 'B.Pendidikan',
                        data: pendidikan_4
                    }, {
                        name: 'B.Keagamaan',
                        data: keagamaan_4
                    }, {
                        name: 'B.Sosial',
                        data: sosial_4
                    }, {
                        name: 'B.SarPras',
                        data: sarpras_4
                    }, {
                        name: 'B.Dana Usaha',
                        data: danausaha_4
                    }, {
                        name: 'DU/Kegiatan',
                        data: binus_4
                    }],
                chart: {
                    type: 'bar',
                    height: 320
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '70%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: th_4,
                },
                yaxis: {
                    title: {
                        text: 'Total (Rp)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val.toLocaleString("id-ID") + " Rupiah"
                        }
                    }
                },
                colors: [primary, success, warning, info, danger, dark, grey, yellow, ]
            };

            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        };

        var _demo5 = function () {
            const apexChart = "#chart_outcome_graf";
            var options = {
                series: [{
                        name: 'Sekertaris',
                        data: sekertaris_5
                    }, {
                        name: 'Bendahara',
                        data: bendahara_5
                    }, {
                        name: 'B.Pendidikan',
                        data: pendidikan_5
                    }, {
                        name: 'B.Keagamaan',
                        data: keagamaan_5
                    }, {
                        name: 'B.Sosial',
                        data: sosial_5
                    }, {
                        name: 'B.SarPras',
                        data: sarpras_5
                    }, {
                        name: 'B.Dana Usaha',
                        data: danausaha_5
                    }, {
                        name: 'DU/Kegiatan',
                        data: binus_5
                    }],
                chart: {
                    type: 'bar',
                    height: 261
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '70%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: th_5,
                },
                yaxis: {
                    title: {
                        text: 'Total (Rp)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val.toLocaleString("id-ID") + " Rupiah"
                        }
                    }
                },
                colors: [primary, success, warning, info, danger, dark, grey, yellow, ]
            };

            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        };

        var outcome = [<?php echo $outcome_persen[0]->sekertaris; ?>, <?php echo $outcome_persen[0]->bendahara; ?>,
<?php echo $outcome_persen[0]->b_pendidikan; ?>,<?php echo $outcome_persen[0]->b_keagamaan; ?>,
<?php echo $outcome_persen[0]->b_sosial; ?>,<?php echo $outcome_persen[0]->b_sarpras; ?>,
<?php echo $outcome_persen[0]->b_dana_usaha; ?>,<?php echo $outcome_persen[0]->b_binus; ?>];

        var _demo6 = function () {
            const apexChart = "#chart_outcome_persen";
            var options = {
                series: outcome,
                chart: {
                    width: 450,
                    type: 'pie',
                },
                labels: ['Sekertaris', 'Bendahara', 'B.Pendidikan', 'B.Keagamaan', 'B.Sosial', 'B.SarPras', 'B.Dana Usaha', 'DU/Kegiatan'],
                responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 370
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                colors: [primary, success, warning, danger, info, dark, grey, yellow]
            };

            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        }


        return {
            // public functions
            init: function () {

                _demo1();
                _demo2();
                _demo3();
                _demo4();
                _demo5();
                _demo6();
            }
        };
    }();

    jQuery(document).ready(function () {
        KTApexChartsDemo.init();
    });
</script>
