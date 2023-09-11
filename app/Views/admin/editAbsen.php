<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
            
                <h4 class="page-title">Edit Absen Siswa</h4>
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
                        <a href="#">Edit Absen Siswa</a>
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
                            <div class="card-title">Edit Absen</div>
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
                        <form action="<?= base_url('admin/absen/update/' . $absen['id_absen']) ?>" method="POST">
                            <input type="hidden" value="<?=$absen['id_absen']?>" id="id_absen" name="id_absen">
                            <input type="hidden" value="<?=$absen['id_siswa']?>" id="id_siswa" name="id_siswa">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="largeInput">Izin</label>
                                            <input type="text" class="form-control" id="izin" name="izin" placeholder="" required value="<?= $absen['izin'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="largeInput">Sakit</label>
                                            <input type="text" class="form-control" id="sakit" name="sakit" placeholder="Hari.." required value="<?= $absen['sakit'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="largeInput">Alfa</label>
                                            <input type="text" class="form-control" id="alpa" name="alpa" placeholder="Hari.." required value="<?= $absen['alpa'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="largeInput">Catatan</label>
                                            <textarea class="form-control" id="catatan" name="catatan" rows="3"><?= $absen['catatan'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">SIMPAN</button>
                                <a href="<?=base_url('admin/absen/dataSiswa/' . $absen['id_siswa'])?>" class="btn btn-info">BATAL</a>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>