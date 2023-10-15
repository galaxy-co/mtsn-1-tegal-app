<?php
    $url = base_url('admin/nilaiKetrampilan/');
    if(session('role_id') == 3){
        $url = base_url('guru/nilai/');
    }
?>
        
<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">
            <div class="page-header">     
                <h4 class="page-title">Nilai Ketrampilan</h4>
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
                        <a href="#">Nilai Ketrampilan</a>
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
                            <div class="card-title">From Nilai Ketrampilan</div>
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
                        <form action="<?= $url.'detail' ?>" method="GET">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Kelas</label>
                                            <select class="form-control form-control" id="id_kelas" name="id_kelas" require>
                                                <option value=""> --Kelas-- </option>
                                                <?php foreach($kelas as $ke) : ?>
                                                    <option value="<?= $ke['id_kelas']; ?>">
                                                        <?= $ke['tingkat'] .''. $ke['nama_kelas'] ?>
                                                    </option>
                                               <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Mapel</label>
                                            <select class="form-control form-control" id="id_mapel" name="id_mapel" require>
                                                <option value=""> - Mapel - </option>
                                               <?php foreach($mapel as $ke) : ?>
                                                    <option value="<?= $ke['id_mapel']; ?>" class='opt-mapel d-none' id='opt-mapel-<?= $ke['id_mapel']?>'>
                                                        <?= $ke['nama_mapel'] ?>
                                                    </option>
                                               <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="defaultSelect">Guru</label>
                                            <select class="form-control form-control" id="id_guru" name="id_guru" readonly>
                                                <?php if(session('role_id') != 3) :?>
                                                    <option value=""> - Guru - </option>
                                                <?php endif ?>
                                                <?php foreach($guru as $ke) : ?>
                                                    <option value="<?= $ke['id_guru']; ?>">
                                                        <?= $ke['nama_guru'] ?>
                                                    </option>
                                               <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success" type="submit">TAMBAH</button>		
                            </div>
                            
                        </form>
                </div>
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
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Nilai Ketrampilan</h4>                
                            </div>

                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Guru</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($nilaiketrampilan as $n) : ?>
                                            <tr>
                                                <td><?= $n['id_nilai'];?></td>
                                                <td><?= $n['tingkat'].''.$n['nama_kelas'];?></td>
                                                <td><?= $n['nama_mapel'];?></td>
                                                <td><?= $n['nama_guru'];?></td>
                                                <td >
                                                    <div class="flex">
                                                        
                                                        <form action="<?= $url.'detail' ?>" method="GET">
                                                            <input type="hidden" name="id_kelas" value="<?= $n['id_kelas']?>">
                                                            <input type="hidden" name="id_mapel" value="<?= $n['id_mapel']?>">
                                                            <input type="hidden" name="id_guru" value="<?= $n['id_guru']?>">
                                                            <button type="submit"  class="btn btn-primary btn-sm" style="text-decoration:none"><i class="icon-note"></i> Detail</a>  
                                                            <!-- <button type="button" class="btn btn-danger btn-sm col-6"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</button> -->
                                                        </form>
                                                        <form action="<?= $url.'export' ?>" method="post">
                                                            <input type="hidden" name="id_kelas" value="<?= $n['id_kelas']?>">
                                                            <input type="hidden" name="id_guru" value="<?= $n['id_guru']?>">
                                                            <input type="hidden" name="id_mapel" value="<?= $n['id_mapel']?>">
                                                            <button type='submit' class="btn btn-sm btn-info ml-2"><i class="fas fa-download"></i> Export</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/guru/upload')?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleFormControlFile1">Pilih File Template Guru</label>
                <input type="file" name="upload_guru" class="form-control-file" id="exampleFormControlFile1" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/')?>assets/js/core/jquery.3.2.1.min.js"></script>
<script>
    $('#id_kelas').on('change',async function(e){
        $('#id_mapel').val(null).change()
        $('#id_guru').val(null).change()
        let idKelas = e.target.value;
        let urlBase = 'admin';
        if(<?php echo session('role_id')?> == 3){
            urlBase = 'guru';
        }
        let getRF = await fetch(`<?= base_url() ?>${urlBase}/nilai/rfmapel/${idKelas}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        });
        let response = await getRF.json()
        console.log('RES',response)
        $('.opt-mapel').addClass('d-none')
        response?.data?.map(res =>{
            $(`#opt-mapel-${res.id_mapel}`).removeClass('d-none');
            $(`#opt-mapel-${res.id_mapel}`).attr('data-idguru',res.id_guru);
        })
    });

    $('#id_mapel').on('change',function(e){
        let idMapel = e.target.value
        let idGuru = $(`#opt-mapel-${idMapel}`).attr('data-idguru');
        console.log(idGuru)
        $('#id_guru').val(idGuru).change()
    })
</script>