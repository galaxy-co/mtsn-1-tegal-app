<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            
            <div class="page-header">
            
                <h4 class="page-title">Input Absen Siswa</h4>
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
                        <a href="#">Input Absen Siswa</a>
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
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title">Input Absen
                            
                            </div>
                            <div class=""><a href="<?= base_url('admin/absen/historyAbsen/') . $id_siswa?>" class="btn btn-sm btn-info">History Absen</a></div>
                            
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
                        <form action="<?= base_url('admin/absen/add') ?>" method="POST">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4">
                                        <input type="hidden" value="<?=$id_siswa?>" id="id_siswa" name="id_siswa">
                                        <input type="hidden" name="id_absen" >
                                        <div class="form-group">
                                            <label for="largeInput">Izin</label>
                                            <input type="text" class="form-control form-control" id="izin" name="izin" placeholder="Hari.." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="largeInput">Sakit</label>
                                            <input type="text" class="form-control form-control" id="sakit" name="sakit" placeholder="Hari.." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="largeInput">Alfa</label>
                                            <input type="text" class="form-control form-control" id="alpa" name="alpa" placeholder="Hari.." required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="largeInput">Catatan</label>
                                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">SAVE</button>		
                            </div>
                            
                        </div>
                    </form>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Absen</h4>   
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th> 
                                            <th>Alpa</th>
                                            <th>Izin</th>
                                            <th>Sakit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th> 
                                            <th>Alpa</th>
                                            <th>Izin</th>
                                            <th>Sakit</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $i = 0;?>
                                        <?php foreach($absen as $k) :?>
                                            <tr>
                                                <td><?= ++$i ?></td>
                                                <td><?= $k['alpa'] ?></td>
                                                <td><?= $k['izin'] ?></td>
                                                <td><?= $k['sakit'] ?></td>
                                                <td><?= $k['catatan'] ?></td>
                                                <td>
                                                    <button
                                                        data-idabsen="<?= $k['id_absen']?>"
                                                        data-alpa="<?= $k['alpa']?>"
                                                        data-izin="<?= $k['izin']?>"
                                                        data-sakit="<?= $k['sakit']?>"
                                                        data-catatan="<?= $k['catatan']?>"
                                                        class="btn-absen-edit btn-primary btn-sm"
                                                    >
                                                        Edit
                                                    </button>
                                                    
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
    const btnEdit = document.getElementsByClassName('btn-absen-edit');
    for (let index = 0; index < btnEdit.length; index++) {
        const element = btnEdit[index];
        element.addEventListener("click", function(e){
            
            let dataset = e.target.dataset;
            console.log('HALO',dataset)
            document.getElementsByName('id_absen')[0].value = dataset.idabsen;
            document.getElementsByName('alpa')[0].value = dataset.alpa;
            document.getElementsByName('izin')[0].value = dataset.izin;
            document.getElementsByName('sakit')[0].value = dataset.sakit
            document.getElementsByName('catatan')[0].value = dataset.catatan
        })
        
    }
</script>