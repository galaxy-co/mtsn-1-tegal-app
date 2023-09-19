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
                                <?php $temp ='' ?>
                                <?php foreach($header_dimensi as $hd): ?>
                                    <?php if($hd['dimensi'] !== $temp) : ?>
                                    <th colspan='6'><?= $hd['dimensi'] ?></th>
                                    <?php $temp=$hd['dimensi'];endif ?>
                                <?php endforeach ?>
                                <th rowspan='4'>MODUS GAB</th>
                                <th rowspan='4'>PREDIKAT</th>
                                <th rowspan='4'>DESKRIPSI 1</th>
                                <th rowspan='4'>DESKRIPSI 2</th>
                                <th rowspan='4'>AKHIR DESKRIPSI</th>
                            </tr>
                            <tr>
                                <?php $temp ='' ?>
                                <?php $nilai_rahmatan_lil_alamin= '' ?>
                                <?php $sub_nilai = '' ?>
                                <?php foreach($header_dimensi as $hd): ?>
                                    <?php
                                        $nilai_rahmatan_lil_alamin .= $hd['nilai_rahmatan_lil_alamin'];
                                        $sub_nilai .= $hd['sub_nilai'];
                                    ?>
                                    <?php if($hd['dimensi'] !== $temp) : ?>
                                    <th colspan="<?php echo count($header_project)+1?>">
                                        <?php echo $nilai_rahmatan_lil_alamin ?>
                                    </th>
                                    <th colspan='2'>
                                        <?= $sub_nilai ?>
                                    </th>
                                    <?php $temp=$hd['dimensi'];endif ?>
                                <?php endforeach ?>
                            </tr>
                            <tr>
                                <?php $temp ='' ?>
                                <?php foreach($header_dimensi as $hd): ?>
                                    <?php if($hd['dimensi'] !== $temp) : ?>
                                    <?php $index=1; foreach($header_project as $hp): ?>
                                        <th><?php echo 'PROYEK'. $index; $index++; ?></th>
                                    <?php endforeach ?>
                                    <th>MODUS</th>
                                    <th nowrap>Rahmatan Lil Alamin</th>
                                    <th nowrap>Sub Nilai</th>
                                    <?php $temp=$hd['dimensi'];endif ?>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <?php 
                            function getModus($data){
                                $frekuensi = array_count_values($data);
                                arsort($frekuensi); 
                                $nilai_terbanyak = key($frekuensi); 
                                return $nilai_terbanyak;
                            }

                            function getPredikat($pred,$dt){
                                foreach($pred as $pre){
                                    if($dt == $pre['id_nilaip5_option']){
                                        return $pre['arti'];
                                    }
                                }
                            }
                        ?>
                        <tbody>
                            <?php foreach($siswa as $sis): ?>
                                <tr>
                                    <td><?php echo $sis['nism']?></td>
                                    <td nowrap><?php echo $sis['nama_siswa']?></td>
                                    <?php $dataModusGabungan = [] ?>
                                    <?php $temp ='' ?>
                                    <?php foreach($header_dimensi as $hd): ?>
                                        <?php if($hd['dimensi'] !== $temp) : ?>
                                        <?php $dataNilaiPerDimensi = [] ?>
                                        <?php foreach($header_project as $hp): ?>
                                            <?php 
                                                $nilaiTemp='';
                                                foreach($nilai as $nil){
                                                    if($nil['id_siswa'] == $sis['id_siswa'] && $nil['id_dimensi'] == $hd['id_dimensi'] && $nil['id_project'] == $hp['id_project']){
                                                        $nilaiTemp = $nil['nilai'];
                                                        array_push($dataNilaiPerDimensi,$nilaiTemp);
                                                    }
                                                }
                                            ?>
                                            <td><?php echo $nilaiTemp ?></td>
                                        <?php endforeach ?>
                                        <?php 
                                            $modus = getModus($dataNilaiPerDimensi);
                                            if($modus){
                                                array_push($dataModusGabungan,$modus);
                                            }
                                            // var_dump($dataModusGabungan)
                                            // dd($dataModusGabungan);
                                            // array_push($dataNilaiPerDimensi,$nilaiTemp);
                                        ?>
                                        <td><?php echo $modus?></td>
                                        <td>rahmatan lil alamin</td>
                                        <td>sub nilai</td>
                                        <?php $temp=$hd['dimensi'];endif ?>
                                    <?php endforeach ?>
                                    <td><?php echo getModus($dataModusGabungan);?></td>
                                    <td><?php echo getPredikat($predikat,getModus($dataModusGabungan))?></td>
                                    <td>DESKRIPSI 1</td>
                                    <td>DESKRIPSI 2</td>
                                    <td>AKHIR DESKRIPSI</td>
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