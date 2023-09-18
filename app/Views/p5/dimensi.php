
        
<div class="main-panel">
    <!-- Form -->
    <div class="content">
       <div class="page-inner">
            <ul class="nav nav-tabs ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('admin/p5/view/dimensi?tingkat='.$tingkat) ?>">DIMENSI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="<?= base_url('admin/p5/view/elemen?tingkat='.$tingkat) ?>">ELEMEN DAN CAPAIAN</a>
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
                <div class="card mt-10">
                  <div class="card-header">
                    <h5 class="card-title">
                      FORM DIMENSI
                    </h5>
                  </div>
                  <form action="<?= base_url('admin/p5/store/dimensi?tingkat='.$tingkat)?>" method="post">
                    <input type="hidden" name="id_dimensi">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="dimensi">KODE DIMENSI</label>
                        <input type="text" name="kode_dimensi" class='form-control'>
                      </div>
                      <div class="form-group">
                        <label for="dimensi">DIMENSI</label>
                        <input type="text" name="dimensi" class='form-control'>
                      </div>
                      <div class="form-group">
                        <label for="dimensi">TINGKAT</label>
                        <input type="text" value="<?php echo $tingkat ?>" name="id_kelas" class='form-control' readonly>
                       
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
                              <th>KODE</th>
                              <th>DIMENSI</th>
                              <th>TINGKAT</th>
                              <th>ACTION</th>
                          </thead>
                          <tbody>
                            <?php foreach($dimensi as $dimen) : ?>
                              <tr>
                                <td><?= $dimen['kode_dimensi']?></td>
                                <td><?= $dimen['dimensi']?></td>
                                <td><?= $dimen['id_kelas'] ?></td>
                                <td>
                                    <button 
                                      class='btn btn-info btn-sm btn-edit-dimensi'
                                      data-kode="<?= $dimen['kode_dimensi']?>" 
                                      data-dimensi="<?= $dimen['dimensi']?>" 
                                      data-idkelas="<?= $dimen['id_kelas']?>" 
                                      data-iddimensi="<?= $dimen['id_dimensi']?>" 
                                      style="text-decoration:none"
                                      >
                                      <i class="icon-note"></i> Edit
                                    </button>  
                                    <a href="<?= base_url('admin/p5/delete/dimensi/') . $dimen['id_dimensi'].'?tingkat='.$tingkat ?>" class="btn btn-danger btn-sm"  style="text-decoration:none" onclick="return konfirmasiHapus()"><i class="icon-trash"></i> Hapus</a>
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
  $('.btn-edit-dimensi').on('click',function(e){
    $('input[name=kode_dimensi]').val(e.target.dataset.kode)
    $('input[name=dimensi]').val(e.target.dataset.dimensi)
    $('input[name=id_kelas]').val(e.target.dataset.idkelas)
    $('input[name=id_dimensi]').val(e.target.dataset.iddimensi)

  })
</script>