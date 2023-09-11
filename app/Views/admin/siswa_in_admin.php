
        
<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
            
                <h4 class="page-title">Siswa</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">siswa</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#"></a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Input Siswa</div>
                        </div>
                        <?php if(session()->getFlashdata('success')) : ?>
                            <button type="button" class="btn btn-success" id="alertSuccess" style="display: none;"> Success</button>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    var button = document.getElementById('alertSuccess');
                                    if (button) {
                                        button.click();
                                    }
                                });
                            </script>
                        <?php endif ?>
                        <?php if (session()->getFlashdata('warning')) : ?>
                            <button type="button" id="alertWarning" style="display: none;"></button>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    var button = document.getElementById('alertWarning');
                                    if (button) {
                                        button.click();
                                    }
                                });
                            </script>
                        <?php endif ?>
                        <form action="<?= base_url('admin/siswa/add') ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
										<div class="form-group">
											<label for="largeInput">NISM</label>
											<input type="text" class="form-control form-control" id="nism" name="nism" placeholder="NISM..." required>
										</div>
										<div class="form-group">
											<label for="largeInput">Nama Siswa</label>
											<input type="text" class="form-control form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa..." required>
										</div>
										
                                    </div>
									<div class="col-md-6 col-lg-4">
										<div class="form-group">
											<label for="defaultSelect">Jenis Kelamin</label>
											<select class="form-control form-control" id="jenis_kelamin" name="jenis_kelamin">
												<option value="L">Laki - laki</option>
												<option value="P">Perempuan</option>
											</select>
										</div>
										<div class="form-group">
											<label for="defaultSelect">Kelas</label>
											<select class="form-control form-control" id="kelas" name="kelas">
												<?php foreach ($kelas as $k) : ?>
													<option value="<?=$k['id_kelas']?>"><?=$k['tingkat']?> <?=$k['nama_kelas']?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
                        		</div>
								<div class="card-action">
										<button class="btn btn-success" type="submit">TAMBAH</button>		
									</div>
							</div>
                    	</form>
                	</div>
            	</div>
        	</div>
    	</div>
<!-- Tabel -->
    <div class="content">
        <div class="page-inner">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Siswa</h4>
                                <div class="ml-auto">
                                    <a href="<?= base_url('/template/template_siswa.xlsx')?>" class="btn btn-primary btn-round">
                                        <i class="flaticon-download"></i>
                                        Download Template Siswa
                                    </a>
                                    <button class="btn btn-success btn-round" data-toggle="modal" data-target="#exampleModal">
                                        <i class="flaticon-upward"></i>
                                        Upload Template Siswa
                                    </button>
                                </div>
                                
                            </div>

                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NISM</th>
                                            <th>Nama Siswa</th>
                                            <th>Jenis Kelamin</th>
											<th>Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>No</th>
                                            <th>NISM</th>
                                            <th>Nama Siswa</th>
											<th>Jenis Kelamin</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 0;?>
                                        <?php foreach($siswa_kelas as $k) :?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $k['nism'] ?></td>
                                            <td><?= $k['nama_siswa'] ?></td>
											<td><?= $k['jenis_kelamin'] ?></td>
											<td><?= $k['tingkat'] ?> <?= $k['nama_kelas'] ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/siswa/edit/') . $k['id_siswa']?>" class="btn btn-primary btn-sm" style="text-decoration:none"><i class="icon-note"></i> Edit</a>  
                                                <a href="<?= base_url('admin/siswa/delete/') . $k['id_siswa']?>" class="btn btn-danger btn-sm"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a></td>
                                        </tr>
                                        
                                        <?php endforeach?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/siswa/upload')?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleFormControlFile1">Pilih File Template Guru</label>
                <input type="file" name="upload_guru" class="form-control-file" id="exampleFormControlFile1" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>


