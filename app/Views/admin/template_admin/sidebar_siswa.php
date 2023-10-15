	<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="<?=base_url('assets/')?>assets/img/logo.png" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<span class="user-level"><?= $name ?></span>
									<!-- <span class="caret"></span> -->
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav nav-success">
						<li class="nav-item">
							<a href="<?= base_url('/siswa')?>" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						
						<li class="nav-item">
							<a href="<?= base_url('/siswa/nilaiHarian')?>">
								<i class="fas fa-edit"></i>
								<p>Nilai Pengetahuan</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/siswa/nilaiKetrampilan')?>">
								<i class="fas fa-edit"></i>
								<p>Nilai Ketrampilan</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/siswa/nilaiSemester')?>">
								<i class="fas fa-edit"></i>
								<p>Nilai PAS</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/siswa/absenSiswa')?>">
								<i class="fas fa-list-ol"></i>
								<p>Absen & Catatan</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<?php if($kurikulum == 2) : ?>
						<li class="nav-item">
							<a href="<?= base_url('/siswa/siswap5')?>">
								<i class="fas fa-edit"></i>
								<p>Nilai P5</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<?php endif ?>
						<!-- <li class="nav-item">
							<a href="<?= base_url('/siswa/raport')?>">
								<i class="icon-layers"></i>
								<p>Raport</p> -->
								<!-- <span class="caret"></span> -->
							<!-- </a>
						</li> -->
					<ul class="nav nav-warning">
						<li class="nav-item">
							<a href="<?= base_url('index.php/logout')?>">
								<i class="fas fa-sign-out-alt"  style="color: #DC143C;" ></i>
								<p style="color: #DC143C; font-family: Times;">Logout</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->