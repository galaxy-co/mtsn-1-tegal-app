<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            <div class="page-header">     
                <h4 class="page-title">Nilai Semester</h4>
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
                        <a href="#">Nilai Semester</a>
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
                            <div class="card-title d-flex justify-content-center">Daftar Absensi</div>
                        </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Semester</th>
                                                <th>Izin</th>
                                                <th>Sakit</th>
                                                <th>Alfa</th>
                                                <th>Catatan</th>
                                            </tr>
                                        </thead>
                                        <?php $no = 0; foreach ($absen as $a) : ?>
                                            <tr>
                                                <td><?= ++$no ?></td>
                                                <td><?= $a['tahun_ajaran']?></td>
                                                <td><?= $a['semester']?></td>
                                                <td><?= $a['izin']?></td>
                                                <td><?= $a['sakit']?></td>
                                                <td><?= $a['alpa']?></td>
                                                <td><?= $a['catatan']?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <div class="card-title d-flex justify-content-end"></div>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="content">
        <div class="page-inner">
            
    </div>
    </div>
</div>