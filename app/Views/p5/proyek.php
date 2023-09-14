
        
<div class="main-panel">
    <!-- Form -->
    <div class="content">
       <div class="page-inner">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/dimensi') ?>">DIMENSI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="<?= base_url('admin/p5/view/elemen') ?>">ELEMEN DAN CAPAIAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/nilai') ?>">NILAI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('admin/p5/view/proyek') ?>">PROYEK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/penilaian') ?>">PENILAIAN</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="card mt-10">
                  <div class="card-header">
                    <h5 class="card-title">
                      FORM MASTER PROYEK
                    </h5>
                  </div>
                  <form action="<?= base_url('admin/p5/store/proyek')?>" method="post">
                    <input type="hidden" name="id_project">
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
                <div class="card mt-10 form-capaian-proyek d-none">
                  <div class="card-header">
                    <h5 class="card-title">
                      FORM CAPAIAN PROYEK
                    </h5>
                  </div>
                  <form action="<?= base_url('admin/p5/store/capaian_proyek')?>" method="post">
                    <input type="hidden" name="id_project">
                    <div class="card-body">
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
                    <div class="table-responsive col-md-12">
                      <table class='table phtable-bordered text-center' border="1">
                          <thead>
                            <tr>
                              <th rowspan="2">JUDUL PROYEK</th>
                              <th rowspan="2">TEMA PROYEK</th>
                              <?php foreach($project_dimensi as $prodim): ?>
                                <th colspan="4"><?= $prodim['dimensi']?></th>
                              <?php endforeach ?>
                              <th rowspan="2">ACTION</th>
                            </tr>
                            <tr>
                            <?php foreach($project_dimensi as $prodim): ?>
                              <th>KODE</th>
                              <th>KODE CAPAIAN FASE</th>
                              <th>NILAI RLA</th>
                              <th>SUB NILAI</th>
                            <?php endforeach ?>
                              
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($proyek as $proy) : ?>
                              <tr>
                                <td><?= $proy['name'] ?></td>
                                <td><?= $proy['theme'] ?></td>
                                <?php foreach($project_dimensi as $prodim): ?>
                                  <td><?php echo $prodim['kode_dimensi']?></td>
                                  <td>
                                    <?php echo $prodim['kode_capaian']?>
                                    <button 
                                      class='btn btn-info btn-sm btn-edit-penilaian-proyek'
                                      data-name="<?= $proy['name']?>" 
                                      data-theme="<?= $proy['theme']?>"
                                      data-iddimensi="<?= $prodim['id_dimensi'] ?>" 
                                      data-idproject="<?= $proy['id_project']?>" 
                                      data-idcapaian="<?= $prodim['id_capaian']?>" 
                                      data-idprojectdimensi="<?= $prodim['id_project_dimensi']?>" 
                                      style="text-decoration:none"
                                      >
                                      <i class="icon-note"></i>
                                    </button>
                                  </td>
                                  <td><?php echo $prodim['nilai_rahmatan_lil_alamin']?></td>
                                  <td><?php echo $prodim['sub_nilai']?></td>
                                <?php endforeach ?>
                                <td>
                                    <button 
                                      class='btn btn-info btn-sm btn-tambah-penilaian-proyek'
                                      data-name="<?= $proy['name']?>" 
                                      data-theme="<?= $proy['theme']?>" 
                                      data-idproject="<?= $proy['id_project']?>" 
                                      style="text-decoration:none"
                                      >
                                      <i class="icon-note"></i> Tambah Penilaian
                                    </button>
                                    <button 
                                      class='btn btn-info btn-sm btn-edit-proyek'
                                      data-name="<?= $proy['name']?>" 
                                      data-theme="<?= $proy['theme']?>" 
                                      data-idproject="<?= $proy['id_project']?>" 
                                      style="text-decoration:none"
                                      >
                                      <i class="icon-note"></i> Edit
                                    </button>  
                                    <a href="<?= base_url('admin/p5/delete/proyek/') . $proy['id_project']?>" class="btn btn-danger btn-sm"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a>
                                </td>
                              </tr>
                            <?php endforeach ?>
                          </tbody>
                      </table>
                    </div>
                  </div> 
                </div>
            </div>
       </div> 
    </div>
<!-- Tabel -->
    <div class="content">
      <div class="page-inner">

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