
        
<div class="main-panel">
    <!-- Form -->
    <div class="content">
       <div class="page-inner">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/dimensi') ?>">DIMENSI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('admin/p5/view/elemen') ?>">ELEMEN DAN CAPAIAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/nilai') ?>">NILAI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/proyek') ?>">PROYEK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/penilaian') ?>">PENILAIAN</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="card mt-10">
                  <div class="card-header">
                    <h5 class="card-title">
                      FORM ELEMEN
                    </h5>
                  </div>
                  <form action="<?= base_url('admin/p5/store/elemen')?>" method="post">
                    <input type="hidden" name="id_element">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="dimensi">DIMENSI</label>
                            <select name="dimensi" id="" class='form-control'>
                              <?php foreach($dimensi as $dimen) : ?>
                                <option value=""></option>
                                <option value="<?php echo $dimen['id_dimensi']?>"> <?= $dimen['kode_dimensi'].' - '.$dimen['dimensi']?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="dimensi">Kode</label>
                            <input type="text" name="kode_element" class='form-control'>
                          </div>
                          <div class="form-group">
                            <label for="dimensi">Parent Elemen</label>
                            <select name="id_parent_element" id="" class='form-control'>
                              <option value="null"></option>
                              <?php foreach($elemen as $el): ?>
                                <option value="<?= $el['id_element']?>"><?php echo $el['kode_element'].' '. $el['desc'] ?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="dimensi">Elemen</label>
                            <input type="text" name="desc" class='form-control'>
                          </div>
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
                    <div class="card-footer">
                      <button type="submit" class='btn btn-info btn-submit'>SAVE</button>
                    </div>
                  </form>
                </div>
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">DIMENSI</div>
                  </div> 
                  <div class="card-body">
                    <div class="table-responsive col-md-12">
                      <table class='table table-responsive table-striped'>
                          <thead>
                              <th>DIMENSI</th>
                              <th>KODE ELEMEN</th>
                              <th>ELEMEN</th>
                              <th>SUB ELEMEN</th>
                              <th>NILAI RAHMATAN LIL ALAMIN</th>
                              <th>SUB NILAI</th>
                              <th>ACTION</th>
                          </thead>
                          <tbody>
                            <?php foreach($elemen as $el) : ?>
                              
                              <tr>
                                <td><?= $el['dimensi']?></td>
                                <td><?= $el['kode_element']?></td>
                                <td><?= $el['id_parent_element'] ? '' : $el['desc'] ?></td>
                                <td><?= $el['id_parent_element'] ? $el['desc'] : '' ?> </td>
                                <td><?= $el['nilai_rahmatan_lil_alamin'] ?></td>
                                <td><?= $el['sub_nilai'] ?></td>
                                <td>
                                    <button 
                                      class='btn btn-info btn-sm btn-edit-element'
                                      data-dimensi="<?= $el['dimensi']?>"
                                      data-idelement="<?= $el['id_element']?>"
                                      data-kodeelement="<?= $el['kode_element']?>"
                                      data-idparentelement="<?= $el['id_parent_element']?>"
                                      data-desc="<?= $el['desc']  ?>"
                                      data-nilairahmatanlilalamin="<?= $el['nilai_rahmatan_lil_alamin'] ?>"
                                      data-subnilai="<?=$el['sub_nilai']?> "
                                      style="text-decoration:none"
                                      >
                                      <i class="icon-note"></i> Edit
                                    </button>  
                                    <a href="<?= base_url('admin/p5/delete/elemen/') . $el['id_element']?>" class="btn btn-danger btn-sm"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a>
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
<script src="<?= base_url('assets/')?>assets/js/core/jquery.3.2.1.min.js"></script>
<script>
  $('.btn-edit-element').on('click',function(e){
    $('select[name=dimensi]').val(e.target.dataset.dimensi).change()
    $('input[name=kode_element]').val(e.target.dataset.kodeelement)
    $('input[name=id_element]').val(e.target.dataset.idelement)
    $('select[name=id_parent_element]').val(e.target.dataset.idparentelement).change()
    $('input[name=desc]').val(e.target.dataset.desc)
    $('input[name=sub_nilai]').val(e.target.dataset.subnilai)
    $('input[name=nilai_rahmatan_lil_alamin]').val(e.target.dataset.nilairahmatanlilalamin)

  })
</script>