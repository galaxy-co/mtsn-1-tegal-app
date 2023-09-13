<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
            
                <h4 class="page-title">Edit Siswa</h4>
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
                        <a href="#">Edit Siswa</a>
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
                            <div class="card-title">Edit Siswa</div>
                        </div>
                        <form action="<?= base_url('admin/siswa/update/') . $siswa['id_siswa']?>" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id_kelas" value="<?= $siswa['id_siswa']?>">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                            <label for="largeInput">NISM</label>
                                            <input type="text" class="form-control form-control" id="nism" name="nism" placeholder="<?= $siswa['nism']?>" value="<?= $siswa['nism']?>">
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="largeInput">Nama Siswa</label>
                                            <input type="text" class="form-control form-control" id="nama_siswa" name="nama_siswa" placeholder="Contoh.. A/B/C" value="<?= $siswa['nama_siswa']?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Jenis Kelamin</label>
                                            <select class="form-control form-control" id="kurikulum" name="kurikulum">
                                                <option value="1">L</option>
                                                <option value="2">P</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Kelas</label>
                                            <select class="form-control form-control" id="id_guru" name="id_guru">
                                                <?php foreach($kelas as $g) : ?>
                                                <option value="<?= $g['id_kelas']?>"><?= $g['tingkat'] ?><?= $g['nama_kelas'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">Simpan</button><a href="/admin/siswa" class="btn btn-danger">Cancel</a>		
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>