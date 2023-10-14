<!-- Sidebar -->
<?php $session = session();
    $role_id = $session->get('role_id');?>
<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="<?=base_url('assets/')?>assets/img/logo.png" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<?php if($role_id == 3 ) :?>
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<span class="user-level">Guru</span>
									
								</span>
							</a>
							<div class="clearfix"></div>
							<?php else : ?>
								<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<span class="user-level">Administrator</span>
									
								</span>
							</a>
							<div class="clearfix"></div>
							<?php endif ?>
							
						</div>
					</div>
					<ul class="nav nav-success">
						<li class="nav-item">
							<a href="<?= base_url('/admin')?>" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<?php if($role_id == 1 ) :?>
						<li class="nav-item">
							<a href="<?= base_url('/admin/settings')?>" aria-expanded="false">
								<i class="fa fa-cogs"></i>
								<p>Settings</p>
							</a>
						</li>
						
						<li class="nav-item">
							<a href="<?= base_url('/admin/guru')?>">
								<i class="icon-people"></i>
								<p>Guru</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/kelas')?>">
								<i class="icon-home"></i>
								<p>Kelas</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						
						<li class="nav-item">
							<a href="<?= base_url('/admin/mapel')?>">
								<i class="icon-layers"></i>
								<p>Mapel</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/siswa')?>">
								<i class="icon-people"></i>
								<p>Siswa</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<?php endif ?>
						<?php if($role_id == 3 ) :?>
						<li class="nav-item">
							<a href="<?= base_url('/guru/nilai')?>">
								<i class="fas fa-list-ol"></i>
								<p>Nilai Pengetahuan</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/guru/nilai')?>">
								<i class="fas fa-list-ol"></i>
								<p>Nilai Ketrampilan</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/guru/pas')?>">
								<i class="fas fa-list-ol"></i>
								<p>Nilai PAS</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<?php endif ?>
						<?php if($role_id == 1 ) :?>
						<li class="nav-item">
							<a href="<?= base_url('/admin/nilai')?>">
								<i class="fas fa-list-ol"></i>
								<p>Nilai Pengetahuan</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/nilaiKetrampilan')?>">
								<i class="fas fa-list-ol"></i>
								<p>Nilai Ketrampilan</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/pas')?>">
								<i class="fas fa-list-ol"></i>
								<p>Nilai PAS</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a  href="<?= base_url('/admin/p5')?>">
								<i class="fas fa-list-ol"></i>
								<p>Nilai P5</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/absen')?>">
								<i class="fas fa-tasks"></i>
								<p>Absensi & Catatan</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/kenaikan')?>">
								<i class="fas fa-sort-amount-up"></i>
								<p>Kenaikan dan Kelulusan</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/raportp5')?>">
								<i class="fas fa-book-open"></i>
								<p>Raport P5</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<?php endif ?>
						<!-- <li class="nav-item">
							<a href="<?= base_url('/admin/user')?>">
								<i class="icon-home"></i>
								<p>Users</p> -->
								<!-- <span class="caret"></span> -->
							<!-- </a>
						</li> -->
						<!-- <li class="nav-item">
							<a href="<?= base_url('/admin/inputNilai')?>">
								<i class="icon-note"></i>
								<p>Input Nilai</p>
								<span class="caret"></span>
							</a>
						</li> -->
					</ul>
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