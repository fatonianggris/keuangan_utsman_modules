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
							<a href="" class="text-muted">Detail DU Siswa</a>
						</li>
					</ul>
					<!--end::Breadcrumb-->
				</div>
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->

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
						<div class="card-header pt-4 pb-1" style="justify-content: center">
							<div class="card-title">
								<h2 class="card-label font-size-h1 text-center font-weight-bolder text-danger">KONFIRMASI IMPOR DATA TAGIHAN DU SEKOLAH
									<span class="text-dark-75 pt-1 font-size-h6 font-weight-bold d-block">Berikut merupakan hasil impor tagihan DU siswa Sekolah Utsman</span>
								</h2>
							</div>

						</div>
						<div class="card-body">
							<div class="alert alert-success text-center font-weight-bolder " role="alert">
								Data Import Pembayaran DU Yang Akan Terinput Ke Dalam Database Tanpa Duplikat
							</div>
							<!--begin: Datatable-->
							<table class="table table-separate table-hover table-light-success table-checkable" id="kt_datatable_income_du_invoice_success">
								<thead>
									<tr>
										<th>ID Invoice</th>
										<th>No Pembayaran</th>
										<th>Nama</th>
										<th>Tgl Invoice</th>
										<th>Tingkat</th>
										<th>Kelas</th>
										<th>Rincian</th>
										<th>Total Nominal</th>
										<th>Status Transaksi</th>
										<th>TA</th>
										<th>Semester</th>
										<th>Bulan</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (!empty($income_insert)) {
										foreach ($income_insert as $key => $value) {
									?>
											<tr>
												<td class="font-weight-bolder">
													<?php echo $value->id_invoice; ?>
												</td>
												<td class="font-weight-bolder text-warning"><?php echo (($value->nomor_pembayaran_dpb)); ?></td>
												<td class="font-weight-bolder"><?php echo ucwords(strtolower($value->nama)); ?></td>
												<td class="font-weight-bolder text-danger"><?php echo $value->tanggal_invoice; ?></td>
												<td class="font-weight-bolder">
													<?php $tingkat = explode(" ", $value[0]->informasi);
													echo $tingkat[0]; ?>
												</td>
												<td class="font-weight-bolder"><?php echo (($value->informasi)); ?></td>
												<td class="font-weight-bolder"><?php echo strtoupper(strtolower($value->rincian)); ?></td>
												<td class="font-weight-bolder"><?php echo number_format($value->nominal_tagihan, 0, ',', '.'); ?></td>
												<td><?php echo $value->status_pembayaran; ?></td>
												<td><?php echo $value->tahun_ajaran; ?></td>
												<td class="font-weight-bolder"><?php echo $value->semester; ?></td>
												<td class="font-weight-bolder"><?php echo bulanindo($value->bulan_invoice); ?></td>
											</tr>
									<?php
										}  //ngatur nomor urut
									}
									?>
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th colspan="2" class="font-weight-boldest text-danger"><b>TOTAL TAGIHAN</b></th>
										<th></th>
										<th></th>
										<th></th>
										<th class="font-weight-boldest text-danger">Nominal Pemasukan</th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>

									</tr>
								</tfoot>
							</table>
							<!--end: Datatable-->
							<?php if (!empty($income_update)) { ?>
								<div class="alert alert-warning text-center font-weight-bolder " role="alert">
									Data Import Pembayaran DU Yang Akan Memperbarui Data Database Yang Telah Ada Dengan Kode Invoice Sama & Status "MENUNGGU"
								</div>
								<!--begin: Datatable-->
								<table class="table table-separate table-hover table-light-warning table-checkable" id="kt_datatable_income_du_invoice_warning">
									<thead>
										<tr>
											<th>ID Invoice</th>
											<th>No Pembayaran</th>
											<th>Nama</th>
											<th>Waktu Berlaku</th>
											<th>Info Kelas</th>
											<th>Rincian</th>
											<th>Total Nominal</th>
											<th>Status Transaksi</th>
											<th>TA</th>
											<th>Semester</th>
											<th>Bulan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($income_update as $key => $value) {
										?>
											<tr>
												<td class="font-weight-bolder">
													<?php echo $value->id_invoice; ?>
												</td>
												<td class="font-weight-bolder text-warning"><?php echo (($value->nomor_pembayaran_dpb)); ?></td>
												<td class="font-weight-bolder"><?php echo ucwords(strtolower($value->nama)); ?></td>
												<td class="font-weight-bolder text-danger"><?php echo $value->tanggal_invoice; ?></td>
												<td class="font-weight-bolder"><?php echo (($value->informasi)); ?></td>
												<td class="font-weight-bolder"><?php echo strtoupper(strtolower($value->rincian)); ?></td>
												<td class="font-weight-bolder"><?php echo number_format($value->nominal_tagihan, 0, ',', '.'); ?></td>
												<td><?php echo $value->status_pembayaran; ?></td>
												<td><?php echo $value->tahun_ajaran; ?></td>
												<td class="font-weight-bolder"><?php echo $value->semester; ?></td>
												<td class="font-weight-bolder"><?php echo bulanindo($value->bulan_invoice); ?></td>
											</tr>
										<?php
										}  //ngatur nomor urut
										?>
									</tbody>
									<tfoot>
										<tr>
											<th></th>
											<th colspan="2" class="font-weight-boldest text-danger"><b>TOTAL TAGIHAN</b></th>
											<th></th>
											<th></th>
											<th></th>
											<th class="font-weight-boldest text-danger">Nominal Pemasukan</th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</tfoot>
								</table>
								<!--end: Datatable-->
							<?php }
							?>
							<?php if (!empty($income_delete)) { ?>
								<div class="alert alert-danger text-center font-weight-bolder " role="alert">
									Data Import Pembayaran DU Yang Tidak Terinput Kedalam Database Dengan Kode Invoice Sama & Status "SUKSES"
								</div>
								<!--begin: Datatable-->
								<table class="table table-separate table-hover table-light-danger table-checkable" id="kt_datatable_income_du_invoice_danger">
									<thead>
										<tr>
											<th>ID Invoice</th>
											<th>No Pembayaran</th>
											<th>Nama</th>
											<th>Waktu Berlaku</th>
											<th>Info Kelas</th>
											<th>Rincian</th>
											<th>Total Nominal</th>
											<th>Status Transaksi</th>
											<th>TA</th>
											<th>Semester</th>
											<th>Bulan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($income_delete as $key => $value) {
										?>
											<tr>
												<td class="font-weight-bolder">
													<?php echo $value->id_invoice; ?>
												</td>
												<td class="font-weight-bolder text-warning"><?php echo (($value->nomor_pembayaran_dpb)); ?></td>
												<td class="font-weight-bolder"><?php echo ucwords(strtolower($value->nama)); ?></td>
												<td class="font-weight-bolder text-danger"><?php echo $value->tanggal_invoice; ?></td>
												<td class="font-weight-bolder"><?php echo (($value->informasi)); ?></td>
												<td class="font-weight-bolder"><?php echo strtoupper(strtolower($value->rincian)); ?></td>
												<td class="font-weight-bolder"><?php echo number_format($value->nominal_tagihan, 0, ',', '.'); ?></td>
												<td><?php echo $value->status_pembayaran; ?></td>
												<td><?php echo $value->tahun_ajaran; ?></td>
												<td class="font-weight-bolder"><?php echo $value->semester; ?></td>
												<td class="font-weight-bolder"><?php echo bulanindo($value->bulan_invoice); ?></td>
											</tr>
										<?php
										}  //ngatur nomor urut
										?>
									</tbody>
									<tfoot>
										<tr>
											<th></th>
											<th colspan="2" class="font-weight-boldest text-danger"><b>TOTAL TAGIHAN</b></th>
											<th></th>
											<th></th>
											<th></th>
											<th class="font-weight-boldest text-danger">Nominal Pemasukan</th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</tfoot>
								</table>
								<!--end: Datatable-->
							<?php }
							?>
							<div class="pb-1 text-center" style="justify-content: center">
								<button onclick="act_confirm_data_payment()" class="btn btn-success btn-lg font-weight-bold mr-10"><i class="fas fa-check-circle "></i>KONFIRMASI DATA TAGIHAN</button>
								<button onclick="act_reject_data_payment()" class="btn btn-danger btn-lg font-weight-bold ml-10"><i class="fas fa-window-close"></i>BATALKAN DATA TAGIHAN</button>
							</div>
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
<script src="<?php echo base_url(); ?>assets/finance/dist/assets/js/pages/crud/datatables/search-options/budget-income-du-transition.js">
</script>

<script>
	function act_confirm_data_payment() {
		var csrfName = $('.txt_csrfname').attr('name');
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash
		
		Swal.fire({
			title: "Peringatan!",
			text: "Apakah anda yakin ingin MENYETUJUI Impor Data Tagihan ini?",
			icon: "warning",
			input: 'password',
			inputLabel: 'Password Anda',
			inputPlaceholder: 'Masukkan password Anda',
			inputAttributes: {
				'aria-label': 'Masukkan password Anda'
			},
			inputValidator: (value) => {
				if (!value) {
					return 'Password Anda diperlukan!'
				}
			},
			showCancelButton: true,
			confirmButtonColor: "#1BC5BD",
			confirmButtonText: "Ya, Setuju!",
			cancelButtonText: "Tidak, Nanti saja!",
			showLoaderOnConfirm: true,
			closeOnConfirm: false,
			closeOnCancel: true,
			preConfirm: (text) => {
				return $.ajax({
					type: "post",
					url: "<?php echo site_url("finance/income/income/accept_import_payment_du") ?>",
					data: {
						password: text,
						[csrfName]: csrfHash
					},
					dataType: 'html',
					success: function(result) {
						if (result == 1) {
							Swal.fire("Berhasil!", "Persetujuan Impor Data Tagihan telah dilakukan.", "success");
							setTimeout(function() {
								window.location.replace("<?php echo site_url("finance/income/income/list_income_du") ?>");
							}, 1000);
						} else {
							Swal.fire("Opsss!", "Password Anda Salah. Ulangi kembali", "error");
						}
					},
					error: function(result) {
						console.log(result);
						Swal.fire("Opsss!", "Koneksi Internet Bermasalah.", "error");
					}
				});
			},
			allowOutsideClick: () => !Swal.isLoading()
		}).then(function(result) {
			if (!result.isConfirm) {
				Swal.fire("Dibatalkan!", "Persetujuan Impor Data Tagihan telah dibatalkan.", "error");
			}
		});
	}
</script>
<script>
	function act_reject_data_payment() {
		var csrfName = $('.txt_csrfname').attr('name');
		var csrfHash = $('.txt_csrfname').val(); // CSRF hash

		Swal.fire({
			title: "Peringatan!",
			text: "Apakah anda yakin ingin MEMBATALKAN Impor Data Tagihan ini?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Ya, Batalkan!",
			cancelButtonText: "Tidak, Nanti saja!",
			showLoaderOnConfirm: true,
			closeOnConfirm: false,
			closeOnCancel: true,
			preConfirm: (text) => {
				return $.ajax({
					type: "post",
					url: "<?php echo site_url("finance/income/income/reject_import_payment_du") ?>",
					data: {
						[csrfName]: csrfHash
					},
					dataType: 'html',
					success: function(result) {
						Swal.fire("Berhasil!", "Pembatalan Impor Data Tagihan telah dilakukan.", "success");
						setTimeout(function() {
							window.location.replace("<?php echo site_url("finance/income/income/list_income_du") ?>");
						}, 1000);
					},
					error: function(result) {
						console.log(result);
						Swal.fire("Opsss!", "Koneksi Internet Bermasalah.", "error");
					}
				});
			},
			allowOutsideClick: () => !Swal.isLoading()
		}).then(function(result) {
			if (!result.isConfirm) {
				Swal.fire("Dibatalkan!", "Pembatalan Impor Data Tagihan telah dibatalkan.", "error");
			}
		});
	}
</script>
