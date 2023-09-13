
        
<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
                <h4 class="page-title">KELAS</h4>
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
                            <div class="card-title">Input Kelas</div>
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
                        <form action="<?= base_url('admin/kelas/add') ?>" method="POST">
                            <div class="card-body">
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
                                            <input type="text" class="form-control form-control" id="nama_kelas" name="nama_kelas" placeholder="Contoh.. A/B/C">
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
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Wali Kelas</label>
                                            <select class="form-control form-control" id="id_guru" name="id_guru">
                                                <?php foreach($kelas_guru as $g) : ?>
                                                <option value="<?= $g['id_guru']?>"><?= $g['nama_guru']?></option>
                                                <?php endforeach ?>
                                            </select>
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
    </div>
<!-- Tabel -->
    <div class="content">
        <div class="page-inner">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Kelas</h4>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kurikulum</th>
                                            <th>Wali Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelas</th>
                                            <th>Kurikulum</th>
                                            <th>Wali Kelas</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 0; $kurikulum = '';?>
                                        <?php foreach($kelas_guru as $k) :?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $k['tingkat'] ?><?= $k['nama_kelas'] ?></td>
                                            <?php 
                                            if ($k['kurikulum'] == 1) {
                                                $kurikulum = 'Kurtilas';
                                            } else {
                                                $kurikulum = 'Kurikulum Merdeka';
                                            }
                                            ?>
                                            <td><?=$kurikulum?></td>
                                            <td><?= $k['nama_guru']?></td>
                                            <td>
                                                <a href="<?= base_url('admin/kelas/edit/') . $k['id_kelas']?>" class="btn btn-primary btn-sm" style="text-decoration:none"><i class="icon-note"></i> Edit</a>  
                                                <a href="<?= base_url('admin/kelas/delete/') . $k['id_kelas']?>" class="btn btn-danger btn-sm"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a></td>
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


