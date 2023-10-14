<?php
    $url = base_url('admin/');
    if(session('role_id') == 3){
        $url = base_url('guru/');
    }
?>
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
                            <div class="card-title">Nilai Semester</div>
                        </div>
                        <form action="<?= $url.'/pas/update'?>" method="POST">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Siswa</th>
                                                <th>Mapel</th>
                                                <th>KKM</th>
                                                <th>Guru Pengampu</th>
                                                <th>Kelas</th>
                                                <th>Nilai Semester</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             $idNilaitoUpdate = []; 
                                             $nilaiToUpdate = [];
                                             ?>
                                            <?php $no = 0; foreach($nilai_pas as $s) : ?>
                                                <tr>
                                                    <td scope="row"><?= ++$no ?></td>
                                                    <td><?= $s['nama_siswa']?></td>
                                                    <td><?= $s['nama_mapel']?></td>
                                                    <td><?= $s['kkm']?></td>
                                                    <td><?= $s['nama_guru']?></td>
                                                    <td><?= $s['tingkat'] . $s['nama_kelas']?></td>
                                                    <td>
                                                        <?php if($s['nilai'] < $s['kkm']) : ?>
                                                        <input type="text" class="form-control" name="nilai[]" style="color:red" value="<?= $s['nilai']?>">
                                                        <?php else : ?>
                                                            <input type="text" class="form-control" name="nilai[]" value="<?= $s['nilai']?>">
                                                            <?php endif ?>
                                                    <input type="hidden" class="form-control" name="id_nilai_pas[]" value="<?= $s['id_nilai_pas']?>">
                                                    <input type="hidden" class="form-control" name="id_kelas[]" value="<?= $s['id_kelas']?>">
                                                    <input type="hidden" class="form-control" name="id_mapel[]" value="<?= $s['id_mapel']?>">
                                                    <input type="hidden" class="form-control" name="id_siswa[]" value="<?= $s['id_siswa']?>">
                                                    <input type="hidden" class="form-control" name="id_guru[]" value="<?= $s['id_guru']?>">
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success" type="submit">SIMPAN</button>   
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

            
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