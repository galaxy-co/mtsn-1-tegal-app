
		

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-info-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
								<h5 class="text-white op-7 mb-2">Aplikasi Management Nilai MTs N 1 Tegal v.1.1</h5>
							</div>
							<div class="ml-md-auto py-2 py-md-0">
								<img src="<?=base_url('assets/')?>assets/img/logo.png" alt="" height="70px" width="70px">
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Statistic</div>
									<div class="card-category"></div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<h1><?= $jumlahSiswa ?></h1>
											<h6 class="fw-bold mt-3 mb-0">Jumlah Siswa</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<h1><?= $jumlahKelas ?></h1>
											<h6 class="fw-bold mt-3 mb-0">Jumlah Kelas</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<h1><?= $jumlahMapel ?></h1>
											<h6 class="fw-bold mt-3 mb-0">Jumlah Mapel</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Settings</div>
									<div class="card-category">
										<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
											<?php if($settings) : ?>
												
												<h1>Tahun Ajaran <?= $settings['tahun_ajaran']?></h1>
												<h1>Semester <?= $settings['semester']?></h1>
											<?php else :?>
												<h1>Anda Belum Melakukan Setting</h1>
											<?php endif ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-header">
									<div class="card-title">Langkah Penggunaan Aplikasi Sebelum Isi Nilai</div>
								</div>
								<div class="card-body">
									<ol class="activity-feed">
										<li class="feed-item feed-item-success">
											<time class="date" datetime="9-25">1</time>
											<span class="text">Lakukan Setting Untuk Kepala Sekolah, Semester, Tahun Ajaran, dan Tanggal Cetak Raport di Menu Settings</span>
										</li>
										<li class="feed-item feed-item-success">
											<time class="date" datetime="9-25">2</time>
											<span class="text">Input Data Guru</span>
										</li>
										<li class="feed-item feed-item-success">
											<time class="date" datetime="9-25">3</time>
											<span class="text">Input Data Kelas</span>
										</li>
										<li class="feed-item feed-item-success">
											<time class="date" datetime="9-25">4</time>
											<span class="text">Input Data Mapel</span>
										</li>
										<li class="feed-item feed-item-success">
											<time class="date" datetime="9-25">5</time>
											<span class="text">Input Data Siswa</span>
										</li>
										
									</ol>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Untuk Jadi Perhatian</div>
									</div>
								</div>
								<div class="card-body">
									<div class="d-flex">
										<div class="flex-1 ml-3 pt-1">
											<h6 class="text-uppercase fw-bold mb-1"><span class="text-warning pl-3">MASUKAN NILAI ANGKA DENGAN BILANGAN BULAT (ex: 80 / 85 / 76)</span></h6>
										</div>
									</div>
									<div class="d-flex">
										<div class="flex-1 ml-3 pt-1">
											<h6 class="text-uppercase fw-bold mb-1"><span class="text-warning pl-3">JANGAN HAPUS KELAS JIKA TIDAK INGIN NILAI SISWA HILANG</span></h6>
										</div>
									</div>
									<div class="d-flex">
										<div class="flex-1 ml-3 pt-1">
											<h6 class="text-uppercase fw-bold mb-1"><span class="text-warning pl-3">SISWA LOGIN DENGAN USERNAME DAN PASSWORD NISM</span></h6>
										</div>
									</div>
									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- End Custom template -->
	</div>
