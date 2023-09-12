<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            <div class="page-header">     
                <h4 class="page-title">Nilai</h4>
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
                        <a href="#">Nilai</a>
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
                            <div class="row">
                                <div class="card-title col-11">Nilai Kelas</div>
                                <div class="btn btn-delete btn-danger">Hapus</div>

                            </div>
                        </div>
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
                        <form action="<?= base_url('admin/nilai/delete') ?>" method="POST" id="form-delete">
                                
                            <div class="card-body">
                            <div class="row">
                                    <input type="hidden" name="id_kelas" value="<?= $nilai['id_kelas']?>">
                                    <input type="hidden" name="id_guru" value="<?= $nilai['id_guru']?>">
                                    <input type="hidden" name="id_mapel" value="<?= $nilai['id_mapel']?>">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Kelas</label>
                                            <select disabled class="form-control form-control" id="id_kelas">
                                               <?php foreach($kelas as $ke) : ?>
                                                    <?php if($nilai['id_kelas'] == $ke['id_kelas']) : ?>
                                                        <option value="<?= $ke['id_kelas']; ?>">
                                                            <?= $ke['tingkat'] .''. $ke['nama_kelas'] ?>
                                                        </option>
                                                    <?php endif ?>
                                               <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Mapel</label>
                                            <select disabled class="form-control form-control" value="<?= $nilai['id_mapel']?>" id="id_mapel" >
                                               <?php foreach($mapel as $ke) : ?>
                                                    <?php if($nilai['id_mapel'] == $ke['id_mapel']) : ?>
                                                        <option value="<?= $ke['id_mapel']; ?>">
                                                            <?= $ke['nama_mapel'] ?>
                                                        </option>
                                                    <?php endif ?>
                                               <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Guru</label>
                                            <select disabled value="<?php $nilai['id_guru']?>" class="form-control form-control" id="id_guru" >
                                               <?php foreach($guru as $ke) : ?>
                                                    <?php if($nilai['id_guru'] == $ke['id_guru']) : ?>
                                                        <option value="<?= $ke['id_guru']; ?>" selected>
                                                            <?= $ke['nama_guru'] ?>
                                                        </option>
                                                    <?php endif ?>
                                               <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Nilai</div>
                    </div>
                    <div class="card-body">
                        <table class='table-responsive table-bordered table-sm w-full'>
                            <thead>
                                <tr>
                                    <th rowspan='2' nowrap>Nama Siswa</th>
                                    <?php foreach($header as $head) : ?>
                                        
                                            <th colspan='3' class='text-center'>
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
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody class='tbody-nilai'>
                                <?php foreach($nilai_get as $sis) : ?>
                                    <tr>
                                        <td>
                                            <?php echo $sis['nama_siswa']; ?>
                                        </td>
                                        
                                            <?php foreach($nilai_detail as $nilai_d) : ?>
                                                <?php if($sis['id_nilai'] == $nilai_d['id_nilai']) : ?>
                                                    <td class='p-0' class='data-nilai'>
                                                        <input type="text" 
                                                            class='form-control td-input td-input-<?= $sis['id_siswa'] ?>' 
                                                            data-idsiswa="<?= $sis['id_siswa']?>"
                                                            data-nilaidetailid = "<?= $nilai_d['nilai_detail_id'] ?>" 
                                                            data-inputkd="input-kd-<?= $nilai_d['kd_name'] ?>" 
                                                            data-rfnilaidetailid='<?= $nilai_d['rf_nilai_detail_id']?>'
                                                            value="<?= $nilai_d['nilai'] ?>"
                                                            >
                                                    </td>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                            
                                        
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <!-- <button class='btn btn-primary' id='save-data'>SAVE</button>    -->
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
        let changeKDName =await postData("http://localhost:8080/admin/nilai/storekdname",data);
        console.log("KD NAME CHANGED",changeKDName);
    });

    $('.td-input').on('change',async function(e){
        // console.log(e)
        // return false;
        data ={
            nilai_detail_id : e.target.dataset.nilaidetailid,
            nilai : e.target.value
        }
        let updateNilai = await  postData("http://localhost:8080/admin/nilai/storenilai",data);
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