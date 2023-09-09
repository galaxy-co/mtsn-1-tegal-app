<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            <div class="page-header">     
                <h4 class="page-title">Nilai</h4>
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
                        <a href="#">Nilai</a>
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
                        <form action="<?= base_url('admin/nilai/add') ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Kelas</label>
                                            <input type="text" disabled class="form-control" value="<?= $nilai['id_kelas'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Mapel</label>
                                            <input type="text" disabled class="form-control" value="<?= $nilai['id_mapel'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Guru</label>
                                            <input type="text" disabled class="form-control" value="<?= $nilai['id_guru'] ?>">
                                        </div>
                                    </div>
                                    
                                </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Nilai</div>
                        <div class="card-body">
                            <table class='table table-responsive table-bordered'>
                                <thead>
                                    <tr>
                                        <th rowspan='2'>Nama Siswa</th>
                                        <?php for($i=0; $i < 5 ; $i++) : ?> 
                                            
                                            <th colspan='3' class='text-center'>KD</th>
                                        <?php endfor; ?>
                                    </tr>
                                    <tr>
                                        <?php for($i=0; $i < 5 ; $i++) : ?> 
                                            <th nowrap>Tes Tertulis</th>
                                            <th>Tugas</th>
                                            <th>Remidi</th>
                                        <?php endfor; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($siswa as $sis) : ?>
                                        <tr>
                                            <td>
                                                <?php echo $sis['nama_siswa']; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>