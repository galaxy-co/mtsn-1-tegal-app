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
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-success">
						<li class="nav-item">
							<a href="<?= base_url('/admin')?>" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
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
						<li class="nav-item">
							<a href="<?= base_url('/admin/nilai')?>">
								<i class="icon-people"></i>
								<p>Nilai</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a  href="<?= base_url('/admin/p5')?>">
								<i class="icon-people"></i>
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
							<a href="<?= base_url('/admin/user')?>">
								<i class="icon-home"></i>
								<p>Users</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
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