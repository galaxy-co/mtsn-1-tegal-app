<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            <div class="page-header">     
                <h4 class="page-title">Nilai PAS</h4>
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
                        <a href="#">Nilai PAS</a>
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
                            <div class="card-title d-flex justify-content-center">Daftar Nilai PAS <?php if($semster == 1){echo 'Ganjil';}else{echo 'Genap';}?> Tahun Ajaran  <?=$tahunAjaran?></div>
                        </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Mapel</th>
                                                <th>KKM</th>
                                                <th>Guru Pengampu</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; foreach($nilaiPas as $s) : ?>
                                                <tr>
                                                    <td scope="row"><?= ++$no ?></td>
                                                    <td><?= $s['nama_mapel']?></td>
                                                    <td><?= $s['kkm']?></td>
                                                    <td><?= $s['nama_guru']?></td>
                                                    <?php if($s['nilai'] < $s['kkm']) : ?>
                                                    <td style="color: red;"><?= $s['nilai']?></td>
                                                    <?php else : ?>
                                                        <td><?= $s['nilai']?></td>
                                                    <?php endif ?>

                                                    
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end">
                                        <h6>Wali Kelas:</h6>
                                    </div>
                                    
                                    <div class="card-title d-flex justify-content-end"><?=$wali_kelas?></div>
                                </div>
                            </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="page-inner">
            
    </div>
    </div>
</div>
<script src="<?= base_url('assets/')?>assets/js/core/jquery.3.2.1.min.js"></script>
<script>
    async function postData(url,data){
        let postAPI = await fetch(url, {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        });
        let response = await postAPI.json()
        return response;
    }

    $('.kd-name-input').on('change',async function(e){
        let data={
            nilai_detail_ids : e.target.dataset.nilaidetailids,
            kd_name : e.target.value,
        }
        console.log('DATA',data);
        let changeKDName =await postData("<?= base_url('admin/nilai/storekdname')?>",data);
        console.log("KD NAME CHANGED",changeKDName);
    });

    $('.td-input').on('change',async function(e){
        // console.log(e)
        // return false;
        data ={
            nilai_detail_id : e.target.dataset.nilaidetailid,
            nilai : e.target.value
        }
        let updateNilai = await  postData("<?= base_url('admin/nilai/storekdname')?>",data);
        console.log('UPDATE NILAI',updateNilai);
    })

    $('.btn-delete').click(async function(){
        let confirm = window.confirm("Are you sure want to delete this data?");
        if (confirm) {
            $('#form-delete').trigger('submit')
        }else{
            return false;
        }
    })
</script>