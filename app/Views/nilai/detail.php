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
                            <div class="card-title">Input Kelas</div>
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
                        <form action="<?= base_url('admin/nilai/add') ?>" method="POST">
                            <div class="card-body">
                            <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Kelas</label>
                                            <select disabled class="form-control form-control" id="id_kelas" name="id_kelas">
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
                                            <select disabled class="form-control form-control" id="id_mapel" name="id_mapel">
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
                                            <select disabled value="<?php $nilai['id_guru']?>" class="form-control form-control" id="id_guru" name="id_guru">
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
                                    <?php for($i=1; $i < 8 ; $i++) : ?> 
                                        
                                        <th colspan='3' class='text-center'>
                                            <input type="text" class='form-control text-center' id="input-kd-<?= $i ?>" value='KD <?= $i ?>'>
                                        </th>
                                    <?php endfor; ?>
                                </tr>
                                <tr>
                                    <?php for($i=1; $i < 8 ; $i++) : ?> 
                                        <?php foreach($rf_nilai_detail as $rf) :?>
                                            <th nowrap class='text-center'><?= $rf['rf_nilai_detail_desc']?></th>
                                        <?php endforeach ?>
                                    <?php endfor; ?>
                                </tr>
                            </thead>
                            <tbody class='tbody-nilai'>
                                <?php foreach($siswa as $sis) : ?>
                                    <tr>
                                        <td>
                                            <?php echo $sis['nama_siswa']; ?>
                                        </td>
                                        <?php for($i=1; $i < 8 ; $i++) : ?>
                                            <?php foreach($rf_nilai_detail as $rf) :?>
                                                <td class='p-0' class='data-nilai'>
                                                    <input type="text" class='form-control td-input td-input-<?= $sis['id_siswa'] ?>' data-idsiswa="<?= $sis['id_siswa']?>" data-inputkd="input-kd-<?= $i ?>" data-rfnilaidetailid='<?= $rf['rf_nilai_detail_id']?>'>
                                                </td>
                                            <?php endforeach ?>
                                            
                                        <?php endfor ?>
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
    async function postData(data){
        let postAPI = await fetch("http://localhost:8080/admin/nilai/store", {
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

    $('.td-input').on('change',async function(e){
        // console.log(e)
        // return false;
        let idsiswa = e.target.dataset.idsiswa;
        let data = {
            id_nilai : e.target.dataset.idnilai,
            nilai_detail_id : e.target.dataset.nilaidetailid,
            id_siswa : idsiswa,
            rf_nilai_detail_id : e.target.dataset.rfnilaidetailid,
            kd_name : $('#'+e.target.dataset.inputkd).val(),
            id_mapel : $('#id_mapel').val(),
            id_guru  : $('#id_guru').val(),
            id_kelas  : $('#id_kelas').val(),
            nilai : e.target.value || '',
        }

        console.log('DATA POST',data);
        
        let postNilai =await postData(data);
        if(postNilai.status == 'OKE'){
            e.target.dataset.nilaidetailid = postNilai.nilai_detail_id
            e.target.dataset.idnilai = postNilai.id_nilai

            $(`.td-input-${idsiswa}`).data('idnilai',postNilai.id_nilai)

            $('#'+e.target.dataset.inputkd).data('nilaidetailid',postNilai.nilai_detail_id)
            $('#'+e.target.dataset.idnilai).data('nilaidetailid',postNilai.id_nilai)
        }
    })
</script>