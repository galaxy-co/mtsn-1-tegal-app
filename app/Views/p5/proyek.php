
        
<div class="main-panel">
    <!-- Form -->
    <div class="content">
       <div class="page-inner">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/dimensi?tingkat='.$tingkat) ?>">DIMENSI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="<?= base_url('admin/p5/view/elemen?tingkat='.$tingkat) ?>">ELEMEN DAN CAPAIAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/nilai?tingkat='.$tingkat) ?>">NILAI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('admin/p5/view/proyek?tingkat='.$tingkat) ?>">PROYEK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/penilaian?tingkat='.$tingkat) ?>">PENILAIAN</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="card mt-10">
                  <div class="card-header">
                    <h5 class="card-title">
                      FORM MASTER PROYEK
                    </h5>
                  </div>
                  <form action="<?= base_url('admin/p5/store/proyek?tingkat='.$tingkat)?>" method="post">
                    <input type="hidden" name="id_project">
                    <input type="hidden" name="tingkat" value="<?php echo $tingkat ?>">
                    <input type="hidden" name="semester" value="<?= $setting['semester']?>">
                    <input type="hidden" name="tahun_ajaran" value="<?= $setting['tahun_ajaran']?>">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">JUDUL PROYEK</label>
                        <textarea name="name" id="" cols="30" rows="3" class="form-control"></textarea>
                        
                      </div>
                      <div class="form-group">
                        <label for="theme">TEMA PROYEK</label>
                        <textarea name="theme" id="" cols="30" rows="3" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class='btn btn-info btn-submit'>SAVE</button>
                    </div>
                  </form>
                </div>
                
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">MASTER PROYEK</div>
                  </div> 
                  <div class="card-body">
                    <div class="accordion" id="accordionExample">
                      <?php foreach($proyek as $proy) : ?>
                        <div class="card">
                          <div class="card-header row" id="headingOne">
                            <div class="col-md-10">
                              <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#<?= $proy['id_project'] ?>" aria-expanded="true" aria-controls="<?= $proy['id_project'] ?>">
                                  <?php echo $proy['name'] ?>
                                </button>
                              </h5>
                            </div>
                            <div class="col-md-2 d-flex justify-content-end">
                              <button 
                                class='btn btn-info btn-xs btn-edit-proyek mr-2'
                                data-name="<?= $proy['name']?>" 
                                data-theme="<?= $proy['theme']?>" 
                                data-idproject="<?= $proy['id_project']?>" 
                                style="text-decoration:none"
                                >
                                <i class="icon-note"></i> Edit
                              </button>  
                              <a href="<?= base_url('admin/p5/delete/proyek/') . $proy['id_project']?>?tingkat=<?= $tingkat ?>" class="btn btn-danger btn-xs"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a>
                            </div>
                          </div>

                          <div id="<?= $proy['id_project'] ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                              <div class="form-group">
                                <label for="name">JUDUL PROYEK</label>
                                <textarea name="name" id="" cols="30" rows="3" class="form-control" disabled><?= $proy['name'] ?></textarea>
                                
                              </div>
                              <div class="form-group">
                                <label for="theme">TEMA PROYEK</label>
                                <textarea name="theme" id="" cols="30" rows="3" class="form-control" disabled><?= $proy['theme'] ?></textarea>
                              </div>

                              <div class="card">
                                  <div class="card-header">
                                    <button 
                                      class='btn btn-info btn-xs btn-tambah-penilaian-proyek'
                                      data-name="<?= $proy['name']?>" 
                                      data-theme="<?= $proy['theme']?>" 
                                      data-idproject="<?= $proy['id_project']?>" 
                                      style="text-decoration:none"
                                      data-toggle="modal" data-target="#exampleModal"
                                      >
                                      <i class="icon-note"></i> Tambah Penilaian
                                    </button>
                                  </div>
                                  <div class="card-body">
                                    <div class="table-responsive">
                                      <table class='table table-bordered'>
                                        <thead>
                                          <th>DIMENSI</th>
                                          <th>KODE CAPAIAN FASE</th>
                                          <th>NILAI RLA</th>
                                          <th>SUB NILAI</th>
                                        </thead>
                                        <tbody>
                                          <?php foreach($project_dimensi as $prodim): ?>
                                            <?php if($proy['id_project'] == $prodim['id_project']) : ?>
                                              <tr>
                                                <td><?= $prodim['kode_dimensi'].' - '.$prodim['dimensi'] ?></td>
                                                <td>
                                                  <?= $prodim['kode_capaian'] ?>
                                                  <button 
                                                    class='btn btn-info btn-sm btn-edit-penilaian-proyek'
                                                    data-name="<?= $proy['name']?>" 
                                                    data-theme="<?= $proy['theme']?>"
                                                    data-iddimensi="<?= $prodim['id_dimensi'] ?>" 
                                                    data-idproject="<?= $proy['id_project']?>" 
                                                    data-idcapaian="<?= $prodim['id_capaian']?>" 
                                                    data-idprojectdimensi="<?= $prodim['id_project_dimensi']?>" 
                                                    style="text-decoration:none"
                                                    data-toggle="modal" data-target="#exampleModal"
                                                    >
                                                    <i class="icon-note"></i>
                                                  </button>
                                                </td>
                                                <td><?= $prodim['nilai_rahmatan_lil_alamin'] ?></td>
                                                <td><?= $prodim['sub_nilai'] ?></td>
                                              </tr>
                                            <?php endif ?>
                                          <?php endforeach ?>

                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      <?php endforeach ?>
                    </div>
                  </div> 
                </div>
            </div>
       </div> 
    </div>
<!-- Tabel -->
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">FORM CAPAIAN PROYEK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/p5/store/capaian_proyek?tingkat='.$tingkat)?>" method="post">
          <div class="modal-body">
        
          
            <input type="hidden" name="id_project">
            <div class="form-group">
              <label for="name">JUDUL PROYEK</label>
              <input type="hidden" name="id_project_dimensi">
              <input type="hidden" name="id_project">
              <textarea readonly name="name" id="" cols="30" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="theme">DIMENSI</label>
              <select name="id_dimensi" id="" class='form-control'>
                <option value=""></option>
                <?php foreach($dimensi as $dimen) : ?>
                  <option value="<?php echo $dimen['id_dimensi']?>"> <?= $dimen['kode_dimensi'].' - '.$dimen['dimensi']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label for="theme">CAPAIAN</label>
              <select name="kode_capaian_fase" id="" class='form-control'>
                <option value=""></option>
                <?php foreach($capaian as $dimen) : ?>
                  <option class='option-capaian option-capaian-<?= $dimen['id_dimensi'] ?> d-none' value="<?php echo $dimen['id_capaian']?>"> <?= $dimen['kode_capaian'].' - '.$dimen['desc']?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>


<!-- Modal -->
<script src="<?= base_url('assets/')?>assets/js/core/jquery.3.2.1.min.js"></script>
<script>
  $('.btn-edit-proyek').on('click',function(e){
    
    $('textarea[name=name]').val(e.target.dataset.name)
    $('textarea[name=theme]').val(e.target.dataset.theme)
    $('input[name=id_project]').val(e.target.dataset.idproject)
  })

  $('.btn-tambah-penilaian-proyek').on('click',function(e){
    
    $('input[name=id_project]').val(e.target.dataset.idproject)
    $('textarea[name=name]').val(e.target.dataset.name)
    $('.form-capaian-proyek').removeClass('d-none')
  });

  function showOption(e){
    $('.option-capaian').addClass('d-none');
    $('.option-capaian-'+e).removeClass('d-none');
  }

  $('select[name=id_dimensi]').change(function(e){
    console.log('CHANGE FIRE')
    showOption(e.target.value)
  });

  $('.btn-edit-penilaian-proyek').on('click',function(e){
    console.log("FIRE",e.target.dataset)
    $('input[name=id_project]').val(e.target.dataset.idproject)
    $('textarea[name=name]').val(e.target.dataset.name)
    $('select[name=id_dimensi]').val(e.target.dataset.iddimensi).trigger('change');
    $('select[name=id_dimensi]').trigger('change');
    $('select[name=kode_capaian_fase]').val(e.target.dataset.idcapaian)
    $('input[name=id_project_dimensi]').val(e.target.dataset.idprojectdimensi)

    showOption(e.target.dataset.iddimensi)

    $('.form-capaian-proyek').removeClass('d-none')
  });

 
</script>