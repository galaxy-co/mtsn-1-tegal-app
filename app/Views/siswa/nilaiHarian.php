<div class="main-panel">
<div class="content">
        <div class="page-inner">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-center">
                                <h4 class="card-title">Nilai Harian Pengetahuan</h4>
                                
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
                                            <th rowspan='2' nowrap>Guru Pengampu</th>
                                            <?php foreach($header as $head) : ?>
                                        
                                                <th colspan='<?php echo count($rf_nilai_detail)?>' class='text-center'>
                                                    <input 
                                                        type="text" 
                                                        class='form-control text-center kd-name-input' 
                                                        data-nilaidetailids="<?php echo implode(",",$head['nilai_detail_ids']) ?>" 
                                                        id="input-kd-<?= $head['kd_name'] ?>" 
                                                        value='<?= $head['kd_name'] ?>'
                                                        disabled
                                                        >
                                                </th>
                                        
                                            <?php endforeach; ?>
                                        </tr>
                                        <tr>
                                            <?php foreach($header as $head) : ?>
                                                <?php foreach($rf_nilai_detail as $rf) :?>
                                                    <th nowrap class='text-center'><?= $rf['rf_nilai_detail_desc']?></th>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; foreach($nilai as $n) : ?>
                                            <tr>
                                                <td><?= ++$i ?></td>
                                                <td><b><?= $n['nama_mapel'] ?></b></td>
                                                <td><b><?= $n['kkm'] ?></b></td>
                                                <td><b><?= $n['nama_guru'] ?></b></td>
                                                <?php foreach($nilai_detail as $nilai_d) : ?>
                                                    <?php if($n['id_nilai'] == $nilai_d['id_nilai']) : ?>
                                                        <?php if($nilai_d['nilai'] <= $n['kkm']) :?>
                                                            <td style="color:red"><?= $nilai_d['nilai'] == 0 ? '-' : $nilai_d['nilai'] ?></td>
                                                        <?php elseif($nilai_d['nilai'] >= $n['kkm']) : ?>
                                                            <td><?= $nilai_d['nilai'] == 0 ? '-' : $nilai_d['nilai'] ?></td>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
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