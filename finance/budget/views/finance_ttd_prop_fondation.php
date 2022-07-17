<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta
            name="og:title"
            content="<?php echo strtoupper(strtolower($budget[0]->nama_anggaran)); ?>"
            />
        <meta
            name="og:description"
            content="<?php echo strtoupper(strtolower($budget[0]->nama_anggaran)); ?>"
            />
        <meta
            name="description"
            content="<?php echo strtoupper(strtolower($budget[0]->nama_anggaran)); ?>"
            />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>
            <?php echo strtoupper(strtolower($budget[0]->nama_anggaran)); ?>
        </title>
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
        <link href="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/finance/dist/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/pdfeditor/build/bundle.css">" />
        <script src="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/global/plugins.bundle.js"></script>
        <script src="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
        <script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/scripts.bundle.js"></script>
        <script>var HOST_redirect = "<?php echo site_url("finance/budget/confirm_ketua_prop_fondation/" . paramEncrypt($budget[0]->id_anggaran)); ?>";</script>
        <script>var HOST_view = "<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/pdfeditor/";</script>
        <script>var HOST_name = "<?php echo strtoupper(strtolower($budget[0]->nama_anggaran)); ?>"</script>
        <script>var HOST_src = "<?php
            if ($budget[0]->file_laporan_proposal_acc != "" || $budget[0]->file_laporan_proposal_acc != NULL) {
                echo base_url() . $budget[0]->file_laporan_proposal_acc;
            } else {
                echo base_url() . $budget[0]->file_laporan_proposal;
            }
            ?>"
        </script>
        <script>var HOST_id = "<?php echo paramEncrypt($budget[0]->id_anggaran); ?>"</script>
        <script>
            var HOST_file_name = "<?php
            if ($budget[0]->file_laporan_proposal_acc != "" || $budget[0]->file_laporan_proposal_acc != NULL) {
                $name_path_prop = explode('/', $budget[0]->file_laporan_proposal_acc);
                $name_file_prop = $name_path_prop[3];
                echo ($name_file_prop);
            } else {
                $name_path_prop = explode('/', $budget[0]->file_laporan_proposal);
                $name_file_prop = $name_path_prop[3];
                echo ($name_file_prop);
            }
            ?>";
        </script>
        <script>var HOST_upload = "<?php echo site_url("/finance/budget/accept_proposal_acc"); ?>"</script>
        <script defer src="<?php echo base_url(); ?>assets/finance/dist/assets/plugins/custom/pdfeditor/build/bundle.js"></script>
    </head>
    <body class="bg-gray-100">
        <div class="text-center">
            <a onclick="window.history.back();" class="btn btn-warning btn-sm font-weight-bold mt-10"><i class="fas fa-backward "></i> Kembali</a>
        </div>
    </body>
</html>
