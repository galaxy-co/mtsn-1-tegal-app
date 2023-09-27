<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">  
            <div class="page-header">
                <h4 class="page-title">Kenaikan</h4>
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
                        <a href="#">Kenaikan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Data Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a href="#"></a>
                    </li>
                </ul>
            </div>
        </div>
    <!-- Tabel -->
    <form action="<?= base_url('admin/kenaikan/add')?>" method="POST">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Cheklist</th>
                                        <th>NISM</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Cheklist</th>
                                        <th>NISM</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach($siswa as $k) : ?>
                                        <tr>
                                            <td><input type="checkbox" name="siswa[]" value="<?= $k['id_siswa'] ?>"></td>
                                            <td><?= $k['nism'] ?></td>
                                            <td><?= $k['nama_siswa'] ?></td>
                                            <td><?= $k['jenis_kelamin'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Naikan Kelas</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="defaultSelect">Naik Ke Kelas</label>
                                
                                <select class="form-control form-control" id="kelas" name="kelas" required>
                                        <?php if($tocheck == 9) : ?>
                                            <option value="0">Lulus</option>
                                        <?php else : ?>
                                        <?php foreach($tingkatan as $t) : ?>
                                            <option value="<?= $t['id_kelas'] ?>"><?= $t['tingkat'] ?><?= $t['nama_kelas'] ?></option>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" type="submit">Naikan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

    </div>
</div>