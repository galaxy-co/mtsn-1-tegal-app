<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/dimensi?tingkat='.$tingkat) ?>">DIMENSI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="<?= base_url('admin/p5/view/elemen?tingkat='.$tingkat) ?>">ELEMEN DAN CAPAIAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/nilai?tingkat='.$tingkat) ?>">NILAI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/proyek?tingkat='.$tingkat) ?>">PROYEK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('admin/p5/view/penilaian?tingkat='.$tingkat) ?>">PENILAIAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('admin/p5/view/cek_deskripsi?tingkat='.$tingkat) ?>">CEK DESKRIPSI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('admin/p5/view/raport?tingkat='.$tingkat) ?>">RAPORT</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="table-responsive">
                    <table class='table table-bordered text-center' >
                        <thead>
                            <tr>
                                <th rowspan='4'>NISM</th>
                                <th rowspan='4'>NAMA SISWA</th>
                                <?php foreach($header_dimensi as $hd): ?>
                                    <th colspan='6'><?= $hd['dimensi'] ?></th>
                                <?php endforeach ?>
                            </tr>
                            <tr>
                                <?php foreach($header_dimensi as $hd): ?>
                                    <th colspan="<?php echo count($header_project)+1?>">TEST</th>
                                    <th colspan='2'>TEST</th>
                                <?php endforeach ?>
                            </tr>
                            <tr>
                                <?php foreach($header_dimensi as $hd): ?>
                                    <?php $index=1; foreach($header_project as $hp): ?>
                                        <th><?php echo 'PROYEK'. $index; $index++; ?></th>
                                    <?php endforeach ?>
                                    <th>MODUS</th>
                                    <th nowrap>Rahmatan Lil Alamin</th>
                                    <th nowrap>Sub Nilai</th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($siswa as $sis): ?>
                                <tr>
                                    <td><?php echo $sis['nism']?></td>
                                    <td nowrap><?php echo $sis['nama_siswa']?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CATATAN -->
<!-- 
Ananda menunjukkan pribadi yang ${AP9} dalam ${AQ9}  dengan perwujudan sebagai seorang yang memiliki sikap ${AR9}  yang senantiasa perlu dibimbing dan dikembangkan untuk kesuksesannya di masa depan
 -->