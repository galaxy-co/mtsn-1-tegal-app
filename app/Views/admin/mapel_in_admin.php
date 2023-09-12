
        
<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">  
            <div class="page-header">
                <h4 class="page-title">Mapel</h4>
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
                        <a href="#">Mapel</a>
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
                            <div class="card-title">Input Mapel</div>
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
                        <form action="<?= base_url('admin/mapel/add') ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="largeInput">Nama Mapel</label>
                                            <input type="text" class="form-control form-control" id="nama_guru" name="nama_mapel" placeholder="Mata Pelajaran..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="largeInput">Tingkat Kelas</label>
                                            <select name="tingkal_kelas" class='form-control' id="tingkal_kelas">
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
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
                            <h4 class="card-title">Data Mappel</h4>   
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mapel</th>
                                            <th>Tingkat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mapel</th>
                                            <th>Tingkat</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 0;?>
                                        <?php foreach($mapel as $k) :?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $k['nama_mapel'] ?></td>
                                            <td><?= $k['tingkal_kelas'] ?></td>
                                            
                                            <td>
                                                <a href="<?= base_url('admin/mapel/edit/') . $k['id_mapel']?>" class="btn btn-primary btn-sm" style="text-decoration:none"><i class="icon-note"></i> Edit</a>  
                                                <a href="<?= base_url('admin/mapel/delete/') . $k['id_mapel']?>" class="btn btn-danger btn-sm"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a></td>
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
      <form action="<?= base_url('admin/uploadGuru')?>" method="POST" enctype="multipart/form-data">
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


