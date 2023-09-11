<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">  
            <div class="page-header">
                <h4 class="page-title">Absensi</h4>
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
                        <a href="#">Absensi</a>
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
        <div class="page-inner">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Siswa</h4>   
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 0;?>
                                        <?php foreach($siswa as $k) :?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $k['nama_siswa'] ?></td>
                                            
                                            <td>
                                            
                                                <?php $siswaId = $k['id_siswa'];
                                                $isSiswaInAbsen = false;
                                                foreach ($absensi as $absen) {
                                                    if ($absen['id_siswa'] == $siswaId) {
                                                        $isSiswaInAbsen = true;
                                                        break;
                                                    }
                                                }
                                                if ($isSiswaInAbsen) {
                                                    echo '<a href="' . base_url('admin/absen/edit/') . $absen['id_absen'] . '" class="btn btn-success btn-sm" style="text-decoration:none"><i class="icon-pencil"></i> Edit Absensi</a>';
                                                } else {
                                                    echo '<a href=" ' . base_url('admin/absen/addAbsen/') . $k['id_siswa'] . '" class="btn btn-primary btn-sm" style="text-decoration:none"><i class="icon-note"></i> Input Absensi</a>  ';
                                                }
                                                ?>
                                                
                                                
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