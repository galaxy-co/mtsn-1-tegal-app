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
                            <div class="row">
                                <div class="card-title col-11">Nilai Semester</div>
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
                      <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label for="">Mapel</label>
                                    <input type="text" class="form-control" value="<?= $mapel['nama_mapel']?>" disabled>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="">KKM</label>
                                    <input type="text" class="form-control" value="<?= $mapel['kkm']?>" disabled>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="">Guru Pengampu</label>
                                    <input type="text" class="form-control" value="<?= $guru['nama_guru']?>" disabled>
                                </div>
                            </div>

                      </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Nilai Semester</div>
                        </div>
                        <form action="<?= base_url('admin/pas/store')?>" method="POST">
                        <input type="hidden" name="semester" value="<?= $input['semester']?>">
                        <input type="hidden" name="tahun_ajaran" value="<?= $input['tahun_ajaran']?>">
                        <input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas']?>">
                        <input type="hidden" name="id_mapel" value="<?= $mapel['id_mapel']?>">
                        <input type="hidden" name="id_guru" value="<?= $guru['id_guru']?>">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Siswa</th>
                                                <th>Nilasi Semester</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; foreach($siswa as $s) : ?>
                                                <tr>
                                                    <td scope="row"><?= ++$no ?></td>
                                                    <td><?= $s['nama_siswa']?></td>
                                                    <td><input type="text" class="form-control" name="nilai[]">
                                                    <input type="hidden" class="form-control" name="id_siswa[]" value="<?= $s['id_siswa']?>">
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