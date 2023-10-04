
        
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
                        <?php if($role_id == 1) : ?>
                        <form action="<?= base_url('admin/pas/detail')?>" method="GET">
                        <?php else : ?>
                            <form action="<?= base_url('guru/pas/detail') ?>" method="GET">
                        <?php endif ?>   
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <input type="hidden" name="id_kelas" value="<?= $id_kelas?>">
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
                                    <!-- <?php if($role_id == 1) : ?> -->
                                    <!-- <div class="col-md-4 col-lg-4">
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
                                    </div> -->
                                    <!-- <?php endif ?> -->
                                   
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
                                            <th>Mata Pelajaran</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0; foreach($nilaipas as $n) : ?>
                                            <tr>
                                                <td><?= ++$no ?></td>
                                                <td><?= $n['semester'] ?></td>
                                                <td><?= $n['tahun_ajaran'] ?></td>
                                                <td><?= $n['nama_mapel'] ?></td>
                                                <td><a href="" class="btn btn-sm btn-primary"><i class="icon-note"></i>Detail</a></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>No</th>
                                        <th>Semester</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Mata Pelajaran</th>
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