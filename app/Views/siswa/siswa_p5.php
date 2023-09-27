<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            <div class="page-header">     
                <h4 class="page-title">Nilai P5</h4>
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
                        <a href="#">Nilai P5</a>
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
                <?php foreach($groupedData as $sesesterTahun => $nilaiPas) : list($semster, $tahunAjaran) = explode('-', $sesesterTahun);?>
                <div class="card">
                        <div class="card-header">
                            <div class="card-title d-flex justify-content-center">Daftar Nilai P5 Semester <?php if($semster == 1){echo 'Ganjil';}else{echo 'Genap';}?> Tahun Ajaran  <?=$tahunAjaran?></div>
                        </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>DIMENSI P5 PPRA</th>
                                                <th>NILAI</th>
                                                <th>DESKRIPSI CAPAIAN</th>
                                            </tr>
                                        </thead>
                                        <?php $no = 0; foreach ($nilaip5 as $n) : ?>
                                            <tr>
                                                <td><?= ++$no ?></td>
                                                <td><?= $n['dimensi']?></td>
                                                <td><?= $n['nilai']?></td>
                                                <td>Ananda <?= $n['arti']?> dalam <?=$n['desc']?></td>
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
                <?php endforeach ?>
        </div>
    </div>

    <div class="content">
        <div class="page-inner">
            
    </div>
    </div>
</div>