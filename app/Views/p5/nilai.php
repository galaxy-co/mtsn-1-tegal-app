?tingkat='.$tingkat        
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
                    <a class="nav-link active" aria-current="page" href="<?= base_url('admin/p5/view/nilai?tingkat='.$tingkat) ?>">NILAI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/proyek?tingkat='.$tingkat) ?>">PROYEK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/p5/view/penilaian?tingkat='.$tingkat) ?>">PENILAIAN</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
            <div class="card mt-10">
                  <div class="card-header">
                    <h5 class="card-title">
                      FORM NILAI
                    </h5>
                  </div>
                  <form action="<?= base_url('admin/p5/store/nilai')?>" method="post">
                    <!-- <input type="hidden" name="id_nilaip5_options"> -->
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="kode">KODE NILAI</label>
                            <input type="text" readonly name="id_nilaip5_option" class='form-control'>
                          </div>
                          
                          <div class="form-group">
                            <label for="desc">KETERANGAN</label>
                            <textarea name="desc" id="" cols="30" class='form-control' rows="3"></textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="nilai">NILAI</label>
                            <input type="text" name="nilai" class='form-control'>
                          </div>
                          <div class="form-group">
                            <label for="arti">ARTI</label>
                            <textarea name="arti" id="" cols="30" class='form-control' rows="3"></textarea>
                          </div>
                          <div class="form-group d-none">
                            <label for="dimensi">KELAS</label>
                            <select name="id_kelas" id="" class='form-control'>
                              <?php foreach($kelas as $kel) : ?>
                                <option value="<?php echo $kel['id_kelas']?>"> <?= $kel['tingkat'] .''. $kel['nama_kelas'] ?></option>
                              <?php endforeach ?>
                            </select>
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
                    <div class="card-title">NILAI</div>
                  </div> 
                  <div class="card-body">
                    <div class="table-responsive col-md-12">
                      <table class='table table-responsive table-striped'>
                          <thead>
                              <th>KODE</th>
                              <th>NILAI</th>
                              <th>KETERANGAN</th>
                              <th>ARTI</th>
                              <th>ACTION</th>
                          </thead>
                          <tbody>
                            <?php foreach($nilai as $dimen) : ?>
                              <tr>
                                <td><?= $dimen['id_nilaip5_option']?></td>
                                <td><?= $dimen['nilai']?></td>
                                <td><?= $dimen['desc'] ?></td>
                                <td><?= $dimen['arti'] ?></td>
                                <td>
                                    <button 
                                      class='btn btn-info btn-sm btn-edit-nilai'
                                      data-kode="<?= $dimen['kode']?>" 
                                      data-nilai="<?= $dimen['nilai']?>" 
                                      data-desc="<?= $dimen['desc']?>" 
                                      data-arti="<?= $dimen['arti']?>" 
                                      data-idnilaip5option="<?= $dimen['id_nilaip5_option']?>"
                                      style="text-decoration:none"
                                      >
                                      <i class="icon-note"></i> Edit
                                    </button>  
                                    <a href="<?= base_url('admin/p5/delete/nilai/') . $dimen['id_nilaip5_option']?>" class="btn btn-danger btn-sm"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a>
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
</div>
<script src="<?= base_url('assets/')?>assets/js/core/jquery.3.2.1.min.js"></script>
<script>
  $('.btn-edit-nilai').on('click',function(e){
    $('input[name=kode]').val(e.target.dataset.kode)
    $('input[name=nilai]').val(e.target.dataset.nilai)
    $('textarea[name=desc]').val(e.target.dataset.desc)
    $('textarea[name=arti]').val(e.target.dataset.arti)
    $('input[name=id_nilaip5_option]').val(e.target.dataset.idnilaip5option)

    console.log(e.target.dataset)

  })
</script>