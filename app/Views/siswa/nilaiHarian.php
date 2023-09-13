<div class="main-panel">
<div class="content">
        <div class="page-inner">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Nilai Harian</h4>
                                
                            </div>

                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class='table-responsive table-bordered table-sm w-full'>
                                    <thead>
                                        <tr>
                                            <th rowspan='2' nowrap>No</th>
                                            <th rowspan='2' nowrap>Nama Mapel</th>
                                            <th rowspan='2' nowrap>KKM</th>
                                            <?php foreach($header as $head) : ?>
                                        
                                                <th colspan='<?php echo count($rf_nilai_detail) + 1?>' class='text-center'>
                                                    <input 
                                                        type="text" 
                                                        class='form-control text-center kd-name-input' 
                                                        data-nilaidetailids="<?php echo implode(",",$head['nilai_detail_ids']) ?>" 
                                                        id="input-kd-<?= $head['kd_name'] ?>" 
                                                        value='<?= $head['kd_name'] ?>'>
                                                </th>
                                        
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <?php foreach($header as $head) : ?>
                                                <?php foreach($rf_nilai_detail as $rf) :?>
                                                    <th nowrap class='text-center'><?= $rf['rf_nilai_detail_desc']?></th>
                                                <?php endforeach ?>
                                                <th nowrap class='text-center'>Nilai Akhir</th>
                                            <?php endforeach; ?>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; foreach($nilai as $n) : ?>
                                            <tr>
                                                <td><?= ++$i?></td>
                                                <td><?= $n['nama_mapel']?></td>
                                                <td><?= $n['kkm']?></td>
                                                <?php $nilai_total = 0;
                                                $jumlah_nilai_detail = 0; 
                                                foreach($nilai_detail as $nilai_d) :  ?>
                                                    <?php if($n['id_nilai'] == $nilai_d['id_nilai']) : $nilai_total += $nilai_d['nilai'];
                                                    $jumlah_nilai_detail++; ?>
                                                    <td><?=$nilai_d['nilai']?></td>
                                                    
                                                    <?php endif ?>
                                                    <td><?= $jumlah_nilai_detail;?></td>
                                                <?php endforeach ?>
                                                
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
</div>