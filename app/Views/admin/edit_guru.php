<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
            
                <h4 class="page-title">Edit Kelas</h4>
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
                        <a href="#">Kelas</a>
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
                            <div class="card-title">Edit Kelas</div>
                        </div>
                        <form action="<?= base_url('admin/guru/update/') . $guru['id_guru']?>" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id_guru" value="<?= $guru['id_guru']?>">
                                
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="largeInput">Nama Guru</label>
                                            <input type="text" class="form-control form-control" value="<?= $guru['nama_guru']?>" id="nama_guru" name="nama_guru" placeholder="Nama Guru..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="largeInput">NUPTK</label>
                                            <input type="text" class="form-control form-control" value="<?= $guru['nuptk']?>" id="nuptk" name="nuptk" placeholder="NUPTK..." required>
                                        </div>
                                    </div>
                                </div>    
                                            
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">Simpan</button><a href="/admin/kelas" class="btn btn-danger">Cancel</a>		
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>