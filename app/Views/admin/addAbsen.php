<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
            
                <h4 class="page-title">Input Absen Siswa</h4>
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
                        <a href="#">Input Absen Siswa</a>
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
                        <form action="<?= base_url('admin/absen/add') ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <input type="hidden" value="<?=$id_siswa?>" id="id_siswa" name="id_siswa">
                                        <div class="form-group">
                                            <label for="largeInput">Izin</label>
                                            <input type="text" class="form-control form-control" id="izin" name="izin" placeholder="Hari.." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="largeInput">Sakit</label>
                                            <input type="text" class="form-control form-control" id="sakit" name="sakit" placeholder="Hari.." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="largeInput">Alfa</label>
                                            <input type="text" class="form-control form-control" id="alpa" name="alpa" placeholder="Hari.." required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="largeInput">Catatan</label>
                                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
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
</div>