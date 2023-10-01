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
									<span class="user-level">Guru</span>
									
								</span>
							</a>
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
							<a href="<?= base_url('/admin/nilai')?>">
								<i class="fas fa-list-ol"></i>
								<p>Nilai</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/admin/pas')?>">
								<i class="fas fa-list-ol"></i>
								<p>Semester</p>
								<!-- <span class="caret"></span> -->
							</a>
						</li>
						
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