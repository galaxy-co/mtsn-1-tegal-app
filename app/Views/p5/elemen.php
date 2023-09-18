
        
<div class="main-panel">
    <!-- Form -->
    <div class="content">
       <div class="page-inner">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/dimensi?tingkat='.$tingkat) ?>">DIMENSI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('admin/p5/view/elemen?tingkat='.$tingkat) ?>">ELEMEN DAN CAPAIAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/nilai?tingkat='.$tingkat) ?>">NILAI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/proyek?tingkat='.$tingkat) ?>">PROYEK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/penilaian?tingkat='.$tingkat) ?>">PENILAIAN</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                
                <div class="card">
                  <div class="card-header row">
                    <div class="col-md-10">
                      <div class="card-title">ELEMEN</div>

                    </div>
                    <div class="col-md-2">
                      <button type="button" class="btn btn-primary action-element" data-toggle="modal"  data-target="#modal-element">
                        ADD ELEMEN
                      </button>
                    </div>
                  </div> 
                  <div class="card-body">
                    <div class="table-responsive col-md-12">
                      <table class='table table-responsive table-striped'>
                          <thead>
                              <th>DIMENSI</th>
                              <th>KODE ELEMEN</th>
                              <th>ELEMEN</th>
                              <th>ACTION</th>
                          </thead>
                          <tbody>
                            <?php $temp=''; foreach($elemen as $el) : ?>
                              <?php if(!$el['kode_parent_element']  && $el['id_dimensi']):?>
                              <tr>
                                <td><?= $el['dimensi']?></td>
                                <td><?= $el['kode_element']?></td>
                                <td><?= $el['desc'] ?></td>
                                <td>
                                    <button 
                                      class='btn btn-info btn-sm btn-edit-element action-element'
                                      data-dimensi="<?= $el['id_dimensi']?>"
                                      data-idelement="<?= $el['id_element']?>"
                                      data-kodeelement="<?= $el['kode_element']?>"
                                      data-desc="<?= $el['desc']  ?>"
                                      data-nilairahmatanlilalamin=""
                                      data-subnilai=""
                                      style="text-decoration:none"
                                      data-toggle="modal" data-target="#modal-element"
                                      >
                                      <i class="icon-note"></i> Edit
                                    </button>  
                                    <a href="<?= base_url('admin/p5/delete/elemen/') . $el['id_element']?>" class="btn btn-danger btn-sm"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a>
                                </td>
                              </tr>
                              <?php $temp =$el['kode_parent_element']; ?>
                              <?php endif ?>
                            <?php endforeach ?>
                          </tbody>
                      </table>
                    </div>
                  </div> 
                </div>
                <div class="card">
                  <div class="card-header row">
                    <div class="col-md-10">
                      <div class="card-title">SUB ELEMEN</div>

                    </div>
                    <div class="col-md-2">
                      <button type="button" class="btn btn-primary action-sub-element" data-toggle="modal" data-target="#modal-element">
                        ADD SUB ELEMEN
                      </button>
                    </div>
                  </div> 
                  <div class="card-body">
                    <div class="table-responsive col-md-12">
                      <table class='table table-responsive table-striped'>
                          <thead>
                              <th>DIMENSI</th>
                              <th>ELEMEN</th>
                              <th>KODE</th>
                              <th>SUB ELEMEN</th>
                              <th>NILAI RAHMATAN LIL ALAMIN</th>
                              <th>SUB NILAI</th>
                              <th>ACTION</th>
                          </thead>
                          <tbody>
                            <?php $tempSub=''; ?>
                            <?php $tempSubElementParent=''; ?>
                            <?php foreach($elemen as $el) : ?>
                              <?php if($el['kode_parent_element'] && $el['id_dimensi']): ?>
                              <tr>
                                <td class='fw-bold'><?= $tempSub !== $el['id_dimensi'] ? $el['dimensi'] : ''?></td>
                                <td class='fw-bold'><?= $tempSubElementParent !== $el['element_parent_desc'] ? $el['element_parent_desc'] : '' ?></td>
                                <td><?= $el['kode_element']?></td>
                                <td><?= $el['desc'] ?> </td>
                                <td><?= $el['nilai_rahmatan_lil_alamin'] ?></td>
                                <td><?= $el['sub_nilai'] ?></td>
                                <td>
                                    <button 
                                      class='btn btn-info btn-sm btn-edit-element action-sub-element'
                                      data-dimensi="<?= $el['id_dimensi']?>"
                                      data-idelement="<?= $el['id_element']?>"
                                      data-kodeelement="<?= $el['kode_element']?>"
                                      data-idparentelement="<?= $el['id_parent_element']?>"
                                      data-desc="<?= $el['desc']  ?>"
                                      data-nilairahmatanlilalamin="<?= $el['nilai_rahmatan_lil_alamin'] ?>"
                                      data-subnilai="<?=$el['sub_nilai']?> "
                                      style="text-decoration:none"
                                      data-toggle="modal" 
                                      data-target="#modal-element"
                                      >
                                      <i class="icon-note"></i> Edit
                                    </button>  
                                    <a href="<?= base_url('admin/p5/delete/elemen/') . $el['id_element']?>" class="btn btn-danger btn-sm"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a>
                                </td>
                              </tr>
                              <?php $tempSub = $el['id_dimensi']; ?>
                              <?php $tempSubElementParent = $el['element_parent_desc']; ?>
                              <?php endif ?>
                            <?php endforeach ?>
                          </tbody>
                      </table>
                    </div>
                  </div> 
                </div>

                
                <div class="card">
                  <div class="card-header row">
                  <div class="col-md-10">
                      <div class="card-title">CAPAIAN</div>

                    </div>
                    <div class="col-md-2">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-capaian">
                        ADD CAPAIAN
                      </button>
                    </div>
                  </div> 
                  <div class="card-body">
                    <div class="table-responsive col-md-12">
                      <table class='table table-responsive table-striped'>
                          <thead>
                              
                              <th>KODE</th>
                              <th>ELEMEN</th>
                              <th>CAPAIAN</th>
                              <th>NILAI RAHMATAN LIL ALAMIN</th>
                              <th>SUB NILAI</th>
                              <th>ACTION</th>
                          </thead>
                          <tbody>
                            <?php foreach($capaian as $el) : ?>
                              <?php if($el['id_dimensi']) :?>
                              <tr>
                                <td><?= $el['kode_capaian']?></td>
                                <td><?= $el['element_desc'] ?></td>
                                <td><?= $el['desc'] ?> </td>
                                <td><?= $el['nilai_rahmatan_lil_alamin'] ?></td>
                                <td><?= $el['sub_nilai'] ?></td>
                                <td>
                                    <button 
                                      class='btn btn-info btn-sm btn-edit-capaian'
                                      data-idcapaian="<?= $el['id_capaian']?>"
                                      data-kodecapaian="<?= $el['kode_capaian']?>"
                                      data-idparentelement="<?= $el['id_parent_element']?>"
                                      data-desc="<?= $el['desc']  ?>"
                                      data-nilairahmatanlilalamin="<?= $el['nilai_rahmatan_lil_alamin'] ?>"
                                      data-subnilai="<?=$el['sub_nilai']?> "
                                      style="text-decoration:none"
                                      data-toggle="modal" data-target="#modal-capaian"
                                      >
                                      <i class="icon-note"></i> Edit
                                    </button>  
                                    <a href="<?= base_url('admin/p5/delete/capaian/') . $el['id_capaian']?>" class="btn btn-danger btn-sm"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a>
                                </td>
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
    
   
</div>

<!-- Modal -->
<div class="modal fade" id="modal-element" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">FORM ELEMENT</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('admin/p5/store/elemen')?>" id='form-elemen' method="post">
        <div class="modal-body">  
            <input type="hidden" name="id_element">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="dimensi">DIMENSI</label>
                    <select name="dimensi" id="" class='form-control'>
                      <option value=""></option>
                      <?php foreach($dimensi as $dimen) : ?>
                        <option value="<?php echo $dimen['id_dimensi']?>"> <?= $dimen['kode_dimensi'].' - '.$dimen['dimensi']?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="dimensi">Kode</label>
                    <input type="text" name="kode_element" class='form-control'>
                  </div>
                  <div class="form-group">
                    <label for="dimensi">Elemen</label>
                    <textarea name="desc" id="desc" class='form-control' cols="30" rows="3"></textarea>
                  </div>
                  
                </div>
                <div class="col-md-6">
                  <?php if(count($elemen) > 0): ?>
                  <div class="form-group d-none sub-element-input">
                    <label for="dimensi">Parent Elemen</label>
                    <select name="id_parent_element" id="" class='form-control'>
                      <option value="null"></option>
                      <?php foreach($elemen as $el): ?>
                        <?php if($el['id_parent_element'] == null): ?>
                          <option value="<?= $el['id_element']?>"><?php echo $el['kode_element'].' '. $el['desc'] ?></option>
                        <?php endif ?>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <?php endif ?>
                  <div class="form-group d-none sub-element-input">
                    <label for="dimensi">Nilai Rahmatan Lil Alamin</label>
                    <input type="text" name="nilai_rahmatan_lil_alamin" class='form-control'>
                  </div>
                  <div class="form-group d-none sub-element-input">
                    <label for="dimensi">Sub Nilai</label>
                    <input type="text" name="sub_nilai" class='form-control'>
                  </div>

                </div>
              </div>
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


<!-- modal capaian -->
<div class="modal fade" id="modal-capaian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">FORM ELEMENT</h1>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('admin/p5/store/capaian')?>" method="post">
      <div class="modal-body">  
          <input type="hidden" name="id_capaian">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="dimensi">Kode Capaian</label>
                <input type="text" readonly name="kode_capaian" class='form-control'>
              </div>
              
              
              <div class="form-group">
                <label for="dimensi">Elemen</label>
                <select name="id_parent_element" id="parent-element-capaian" class='form-control'>
                  <option value="null"></option>
                  <?php foreach($elemen as $el): ?>
                    <?php if($el['id_parent_element']): ?>
                      <option data-kodeelement='<?php echo $el['kode_element'] ?>' value="<?= $el['id_element']?>"><?php echo $el['kode_element'].' '. $el['desc'] ?></option>
                    <?php endif ?>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="dimensi">Capaian</label>
                <textarea name="desc" id="" class='form-control' cols="30" rows="10">
                  
                </textarea>
              </div>
            </div>
            <div class="col-md-6">
              
              <div class="form-group">
                <label for="dimensi">Nilai Rahmatan Lil Alamin</label>
                <input type="text" name="nilai_rahmatan_lil_alamin" class='form-control'>
              </div>
              <div class="form-group">
                <label for="dimensi">Sub Nilai</label>
                <input type="text" name="sub_nilai" class='form-control'>
              </div>

            </div>
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
<script src="<?= base_url('assets/')?>assets/js/core/jquery.3.2.1.min.js"></script>
<script>
  $('.btn-edit-element').on('click',function(e){
    $('select[name=dimensi]').val(e.target.dataset.dimensi).change()
    $('input[name=kode_element]').val(e.target.dataset.kodeelement)
    $('input[name=id_element]').val(e.target.dataset.idelement)
    $('select[name=id_parent_element]').val(e.target.dataset.idparentelement).change()
    $('textarea[name=desc]').val(e.target.dataset.desc)
    $('input[name=sub_nilai]').val(e.target.dataset.subnilai)
    $('input[name=nilai_rahmatan_lil_alamin]').val(e.target.dataset.nilairahmatanlilalamin)
    showInputSubElemen(e.target.dataset.idparentelement)
  })

  $('.btn-edit-capaian').on('click',function(e){
    $('input[name=kode_capaian]').val(e.target.dataset.kodecapaian)
    $('input[name=id_capaian]').val(e.target.dataset.idcapaian)
    $('select[name=id_parent_element]').val(e.target.dataset.idparentelement).change()
    $('textarea[name=desc]').val(e.target.dataset.desc)
    $('input[name=sub_nilai]').val(e.target.dataset.subnilai)
    $('input[name=nilai_rahmatan_lil_alamin]').val(e.target.dataset.nilairahmatanlilalamin)

  })

  $('#parent-element-capaian').on('change',function(e){
    
    $('input[name=kode_capaian]').val($(this).find(':selected').attr('data-kodeelement'))
  })

  $('.action-element').click(function(){
    showInputSubElemen(false)
  })
  $('.action-sub-element').click(function(){
    showInputSubElemen(true)
  })

  // $('select[name=id_parent_element]').on('change',function(e){
  //   showInputSubElemen(e.target.value)
  // })

  function showInputSubElemen(val){
    if(val){
      $('.sub-element-input').removeClass('d-none')
    }else{
      $('.sub-element-input').addClass('d-none')
    }
  }
</script>