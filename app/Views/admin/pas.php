
        
<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            <div class="page-header">     
                <h4 class="page-title">Nilai Semester</h4>
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
                        <a href="#">Nilai Semester</a>
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
                            <div class="card-title">Pilih Kelas, Mapel dan Guru</div>
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
                        <form action="<?= base_url('admin/pas/detail') ?>" method="GET">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Kelas</label>
                                            <select class="form-control form-control" id="id_kelas" name="id_kelas">
                                               <?php foreach($kelas as $ke) : ?>
                                                    <option value="<?= $ke['id_kelas']; ?>">
                                                        <?= $ke['tingkat'] .''. $ke['nama_kelas'] ?>
                                                    </option>
                                               <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Mapel</label>
                                            <select class="form-control form-control" id="id_mapel" name="id_mapel">
                                               <?php foreach($mapel as $ke) : ?>
                                                    <option value="<?= $ke['id_mapel']; ?>">
                                                        <?= $ke['nama_mapel'] ?>
                                                    </option>
                                               <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Guru</label>
                                            <select class="form-control form-control" id="id_guru" name="id_guru">
                                               <?php foreach($guru as $ke) : ?>
                                                    <option value="<?= $ke['id_guru']; ?>">
                                                        <?= $ke['nama_guru'] ?>
                                                    </option>
                                               <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                   
                                </div>
                                
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">TAMBAH</button>		
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
                                <h4 class="card-title">Data Nilai</h4>                
                            </div>

                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Semester</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Kelas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Guru</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0; foreach($nilai_pas as $n) : ?>
                                            <tr>
                                                <td><?= ++$no ?></td>
                                                <td><?= $n['semester']?></td>
                                                <td><?= $n['tahun_ajaran']?></td>
                                                <td><?= $n['tingkat'].''.$n['nama_kelas'];?></td>
                                                <td><?= $n['nama_mapel'];?></td>
                                                <td><?= $n['nama_guru'];?></td>
                                                <td >
                                                   <a href="<?= base_url('admin/pas/edit/') . $n['id_nilai_pas']?>" class="btn btn-info">Detail</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>No</th>
                                        <th>Semester</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    
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
      <form action="<?= base_url('admin/guru/upload')?>" method="POST" enctype="multipart/form-data">
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