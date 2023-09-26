<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
            
                <h4 class="page-title">Settings</h4>
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
                        <a href="#">Settings</a>
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
                                <div class="card-title"></div>
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
                            <form action="<?= base_url('admin/settings/update') . $settings['id_settings'] ?>" method="POST">
                                <div class="card-body">
                                <input type="hidden" name="id_settings" value="<?= $settings['id_settings']?>">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="largeInput">Kepala Sekolah</label>
                                                <input type="text" class="form-control form-control" value="<?= $settings['nama_kepsek']?>" id="nama_kepsek" name="nama_kepsek" placeholder="..." required>
                                            </div>
                                            <div class="form-group">
                                                <label for="largeInput">Tanggal Cetak Raport</label>
                                                <input type="date" class="form-control form-control" id="tanggal_cetak_raport" name="tanggal_cetak_raport" placeholder="..." required value="<?= $settings['tanggal_cetak_raport']?>">
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                                <label for="defaultSelect">Semester</label>
                                                <div class="form-check">
                                                <input class="form-check-input" type="radio" name="semester" id="semester1" value="1">
                                                <label class="form-check-label" for="semester1">
                                                    Ganjil
                                                </label>
                                                </div>

                                                <div class="form-check">
                                                <input class="form-check-input" type="radio" name="semester" id="semester1" value="2">
                                                <label class="form-check-label" for="semester1">
                                                    Genap
                                                </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                                <input type="text" name="tahun_ajaran1" id="tahun_ajaran1"> / <input type="text" name="tahun_ajaran2" id="tahun_ajaran">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="card-action">
                                            <button class="btn btn-success" type="submit">EDIT</button>		
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
    </div>
</div>