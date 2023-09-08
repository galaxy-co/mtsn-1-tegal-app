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
                        <form action="<?= base_url('admin/addKelas') ?>" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas']?>">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Tingkat</label>
                                            <select class="form-control form-control" id="tingkat" name="tingkat">
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="largeInput">Bagian / Nama</label>
                                            <input type="text" class="form-control form-control" id="nama_kelas" name="nama_kelas" placeholder="Contoh.. A/B/C" value="<?= $kelas['nama_kelas']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Kurikulum</label>
                                            <select class="form-control form-control" id="kurikulum" name="kurikulum">
                                                <option value="1">Kurtilas</option>
                                                <option value="2">Kurmer</option>
                                            </select>
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