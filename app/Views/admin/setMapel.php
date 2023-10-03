
        
<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
                <h4 class="page-title">Mapel Kelas</h4>
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
                        <a href="#">Mapel Kelas</a>
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
                            <div class="card-title">Input Mapel Kelas</div>
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
                        <form action="<?= base_url('admin/kelas/addrfMapel') ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" value="<?=$kelas['id_kelas']?>" name="id_kelas">
                                    <input type="hidden" name="id_rfmapel" id="id_rfmapel">
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Mapel</label>
                                            <select class="form-control form-control" id="id_mapel" name="id_mapel">
                                                <option value=""> -- Mapel --</option>
                                                <?php foreach($mapel as $g) : ?>
                                                <option value="<?= $g['id_mapel']?>"><?= $g['nama_mapel']?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Guru Pengampu</label>
                                            <select class="form-control form-control" id="id_guru" name="id_guru">
                                                <option value=""> -- Guru Pengampu --</option>
                                                <?php foreach($guru as $g) : ?>
                                                <option value="<?= $g['id_guru']?>"><?= $g['nama_guru']?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">KKM</label>
                                            <input type="text" name="kkm" id="kkm" class='form-control' placeholder='KKM...'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">SAVE</button>		
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
   
<!-- Tabel -->
    <div class="content">
        <div class="page-inner">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Mapel</h4>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mapel</th>
                                            <th>Guru Pengampu</th>
                                            <th>KKM</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Mapel</th>
                                            <th>Guru Pengampu</th>
                                            <th>KKM</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 0;?>
                                        <?php foreach($rfmapel as $k) :?>
                                        <tr>
                                            <td><?= ++$i ?></td>
                                            <td><?= $k['nama_mapel'] ?></td>
                                            <td><?= $k['nama_guru']?></td>
                                            <td><?= $k['kkm']?></td>
                                            <td>
                                                <button 
                                                    class='btn btn-info btn-sm btn-edit-set-mapel'
                                                    data-idguru = '<?= $k['id_guru']; ?>'
                                                    data-idmapel = '<?= $k['id_mapel']; ?>'
                                                    data-kkm = '<?= $k['kkm']; ?>'
                                                    data-idrfmapel = '<?= $k['id_rfmapel']; ?>'
                                                    >
                                                    Edit
                                                </button>     
                                                <a href="<?= base_url('admin/kelas/deleteRfMapel/') . $k['id_rfmapel']?>" class="btn btn-danger btn-sm"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                        
                                        <?php endforeach?>
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

<script>
    const btnEditMapel = document.getElementsByClassName('btn-edit-set-mapel');
    console.log(btnEditMapel)
    for (let index = 0; index < btnEditMapel.length; index++) {
        const element = btnEditMapel[index];
        element.addEventListener('click',function(e){
            let data = e.target.dataset
            document.getElementById('id_mapel').value = data.idmapel
            document.getElementById('id_guru').value = data.idguru
            document.getElementById('kkm').value = data.kkm
            document.getElementById('id_rfmapel').value = data.idrfmapel
        })
    }
    // btnEditMapel.map((edit)=>{
    //     edit.addEventListener('click',function(e){
    //         console.log(e.target.dataset)
    //     })
    // })
</script>


