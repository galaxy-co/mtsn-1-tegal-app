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
                                    <th colspan='<?php echo count($header_project)+3 ?>'><?= $hd['dimensi'] ?></th>
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
                                <?php $nilai_rahmatan_lil_alamin= [] ?>
                                <?php $sub_nilai = [] ?>
                                <?php for($i=0;$i< count($header_dimensi) ;$i++): ?>
                                    <?php $hd=$header_dimensi[$i]; ?>
                                    <?php
                                        if($hd['dimensi'] == $header_dimensi[$i > 0 ? $i-1 : $i]['dimensi']){
                                            array_push($nilai_rahmatan_lil_alamin,$hd['nilai_rahmatan_lil_alamin']);
                                            array_push($sub_nilai,$hd['sub_nilai']);
                                        }else{
                                            $nilai_rahmatan_lil_alamin = [];
                                            $sub_nilai = [];
                                            array_push($nilai_rahmatan_lil_alamin,$hd['nilai_rahmatan_lil_alamin']);
                                            array_push($sub_nilai,$hd['sub_nilai']);
                                        }

                                    ?>
                                    <?php if($hd['dimensi'] !== $header_dimensi[ isset($header_dimensi[$i+1]) ? $i+1 : $i]['dimensi'] || $i == count($header_dimensi)-1 ) : ?> 
                                        <th colspan="<?php echo count($header_project)+1?>" id='th-rla-<?= $hd['id_dimensi']?>'>
                                            <?php echo implode(", ",array_unique($nilai_rahmatan_lil_alamin)) ?>
                                        </th>
                                        <th colspan='2' id='th-subnilai-<?= $hd['id_dimensi']?>'>
                                            <?= implode(", ",array_unique($sub_nilai)) ?>
                                        </th>
                                    <?php endif ?>
                                <?php endfor ?>
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
                                           
                                        ?>
                                        <td class='td-modus' data-idsiswa="<?= $sis['id_siswa']?>" data-iddimensi ="<?= $hd['id_dimensi'];?>"><?php echo $modus?></td>
                                        <td id='td-rla-<?= $hd['id_dimensi'].'-'.$sis['id_siswa'] ?>'></td>
                                        <td id='td-subnilai-<?= $hd['id_dimensi'].'-'.$sis['id_siswa'] ?>'></td>
                                        <?php $temp=$hd['dimensi'];endif ?>
                                    <?php endforeach ?>
                                    <td class='td-modus-gab' data-idsiswa='<?= $sis['id_siswa']?>' data-predikat='<?php echo getPredikat($predikat,getModus($dataModusGabungan))?>'><?php echo getModus($dataModusGabungan);?></td>
                                    <td><?php echo getPredikat($predikat,getModus($dataModusGabungan))?></td>
                                    <td class='text-left' id='td-deskripsi1-<?= $sis['id_siswa'] ?>' nowrap></td>
                                    <td class='text-left' id='td-deskripsi2-<?= $sis['id_siswa'] ?>' nowrap></td>
                                    <td class='text-left' id='td-akhir-deskripsi-<?= $sis['id_siswa'] ?>' nowrap></td>
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
 <script src="<?= base_url('assets/')?>assets/js/core/jquery.3.2.1.min.js"></script>
<script>
        let deskripsi1 = [];
        let deskripsi2 = [];
        const tdModus = document.getElementsByClassName('td-modus')
        const tdModusGab = document.getElementsByClassName('td-modus-gab')
        for (let index = 0; index < tdModus.length; index++) {
            const tdM = tdModus[index];
            let value = tdM.innerText;
            let idDimensi = tdM.dataset.iddimensi
            let idSiswa = tdM.dataset.idsiswa
   
            if(value){
                let headerRLA = document.getElementById(`th-rla-${idDimensi}`).innerText;
                let headerSubNilai =document.getElementById(`th-subnilai-${idDimensi}`).innerText;
                 console.log(idDimensi)
                 document.getElementById(`td-rla-${idDimensi}-${idSiswa}`).innerText = headerRLA
                 document.getElementById(`td-subnilai-${idDimensi}-${idSiswa}`).innerText = headerSubNilai
                 deskripsi1.push(...headerRLA.split(','))
                 deskripsi2.push(...headerSubNilai.split(','))
            }
        }

        for (let i = 0; i < tdModusGab.length; i++) {
            const tdMG = tdModusGab[i];
            let value = tdMG.innerText;
            let idSiswa = tdMG.dataset.idsiswa
            let predikat = tdMG.dataset.predikat
            console.log('DESC',deskripsi1)
            if(value){
                let akhirDeskripsi = `Ananda menunjukkan pribadi yang ${predikat} dalam ${[...new Set(deskripsi1)]}  dengan perwujudan sebagai seorang yang memiliki sikap ${[...new Set(deskripsi2)]}  yang senantiasa perlu dibimbing dan dikembangkan untuk kesuksesannya di masa depan`
                document.getElementById(`td-deskripsi1-${idSiswa}`).innerText= [...new Set(deskripsi1)]            
                document.getElementById(`td-deskripsi2-${idSiswa}`).innerText= [...new Set(deskripsi2)]
                document.getElementById(`td-akhir-deskripsi-${idSiswa}`).innerText= akhirDeskripsi
            }
        }
        
    
</script>