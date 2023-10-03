<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
            
                <h4 class="page-title">Edit Mapel</h4>
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
                        <a href="#">Edit Mapel</a>
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
                            <div class="card-title">Edit Mapel</div>
                        </div>
                        <form action="<?= base_url('admin/mapel/update/') . $mapel['id_mapel']?>" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id_kelas" value="<?= $mapel['id_mapel']?>">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                            <label for="largeInput">NAMA MAPEL</label>
                                            <input type="text" class="form-control form-control" id="nama_mapel" name="nama_mapel" placeholder="<?= $mapel['nama_mapel']?>" value="<?= $mapel['nama_mapel']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success mg-r-2" type="submit">Simpan</button>
                                <a href="/admin/siswa" class="btn btn-danger">Cancel</a>		
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>