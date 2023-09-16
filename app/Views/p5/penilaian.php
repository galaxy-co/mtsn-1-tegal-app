
        
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
                    <a class="nav-link" href="<?= base_url('admin/p5/view/proyek') ?>">PROYEK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('admin/p5/view/penilaian') ?>">PENILAIAN</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <ul class="nav nav-tabs">
                <?php foreach($proyek as $pro): ?>
                  <li class="nav-item">
                      <a class="nav-link <?php echo $pro['id_project'] == $proyek_detail['id_project'] ?  'active' :  '' ?>" href="<?= base_url('admin/p5/view/penilaian/').$pro['id_project'] ?>"><?php echo $pro['name']?></a>
                  </li>
                <?php endforeach ?>
              </ul>
              <div class="tab-content" id="myTabContent2">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title"></div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name">JUDUL PROYEK</label>
                          <textarea name="name" id="" cols="30" rows="3" class="form-control" disabled><?php echo $proyek_detail['name'] ?></textarea>
                          
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="theme">TEMA PROYEK</label>
                          <textarea name="theme" id="" cols="30" rows="3" class="form-control" disabled><?php echo $proyek_detail['theme'] ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header text-end row">
                    <div class="col-8">
                      <div class="card-title">PENILAIAN</div>
                    </div>
                    
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8"></div>
                      <div class="col-4">
                            <form action="<?= base_url('admin/p5/view/penilaian/'.$proyek_detail['id_project'])?>" method="get">
                              <div class="input-group mb-3">
                                <select name="id_kelas" id="" class='form-control'>
                                  <?php foreach($kelas as $kel) :?>
                                    <option value="<?= $kel['id_kelas']?>"><?= $kel['tingkat'] .$kel['nama_kelas']?></option>
                                  <?php endforeach?>
                                </select>
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">SUBMIT</button>
                              </div>
                            </form>
                      </div>
                    </div>
                    <div class="table-responsive col-md-12">
                      <table class='table phtable-bordered text-center fs-6 table-sm' border="1">
                          <thead>
                            <tr>
                              <th rowspan="4">NAMA SISWA</th>
                              <?php foreach($project_dimensi as $prodim): ?>
                                <th colspan="2"><?= $prodim['dimensi']?></th>
                              <?php endforeach ?>
                            </tr>
                            <tr>
                            <?php foreach($project_dimensi as $prodim): ?>
                              <th>DIMENSI</th>
                              <th>CAPAIAN</th>
                            <?php endforeach ?>
                            </tr>
                            <tr>
                            <?php foreach($project_dimensi as $prodim): ?>
                              <th><p class='fs-6'><?php echo $prodim['dimensi'] ?></p></th>
                              <th><p class='fs-6'><?php echo $prodim['desc'] ?></p></th>
                            <?php endforeach ?>
                            </tr>
                            <tr>
                            <?php foreach($project_dimensi as $prodim): ?>
                              <th>NILAI</th>
                              <th>DESKRIPSI</th>
                            <?php endforeach ?>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($siswa as $sis):?>
                              <tr>
                                <td>
                                  <?php echo $sis['nama_siswa'] ?>
                                </td>
                                <?php foreach($project_dimensi as $prodim): ?>

                                  <?php
                                    $id_nilai = '';
                                    $nilaiSelected='';
                                    $arti_nilai='';
                                    foreach ($penilaian as $pen) {
                                      if($prodim['id_project_dimensi'] == $pen['id_project_dimensi'] && $sis['id_siswa']== $pen['id_siswa']){
                                        $id_nilai = $pen['id_nilai'];
                                        $nilaiSelected = $pen['nilai'];
                                        $arti_nilai = $pen['desc'];
                                      }
                                    }  
                                  ?>
                                  <td>
                                    <select 
                                      name="" id="" 
                                      class='form-control select-nilai' 
                                      value="<?= $nilaiSelected ?>" 
                                      data-id_nilai="<?= $id_nilai ?>"
                                      >
                                      
                                      <?php foreach($nilai as $ni) :?>
                                        <!-- nilai desc value must be from nilai desc instead from dimensi desc, but, in showcase project(xls app), the desc is from dimensi -->
                                        
                                        <option 
                                          value="<?php echo $ni['id_nilaip5_option']?>" 
                                          class='opt-nilai' 
                                          data-desc="<?= $ni['desc']?> <?= $prodim['desc']?>" 
                                          data-idsiswa='<?= $sis['id_siswa']?>' 
                                          data-idprojectdimensi='<?= $prodim['id_project_dimensi']?>'
                                          <?php if($nilaiSelected == $ni['id_nilaip5_option']) :?> selected <?php endif ?>
                                          >
                                          <?php echo $ni['nilai']?>
                                        </option>
                                      <?php endforeach ?>
                                    </select>
                                  </td>
                                  <td>
                                      <p id="<?= 'desc-'.$sis['id_siswa'].'-'.$prodim['id_project_dimensi'] ?>"><?php echo $arti_nilai ?><?php echo $prodim['desc'] ?></p>
                                  </td>
                                <?php endforeach ?>
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

    $('.select-nilai').on('input',async function(e){
        let selectedOption = $(this).find(':selected').attr('data-kodeelement')
        let data={
            id_nilai : e.target.dataset.id_nilai,
            id_siswa : $(this).find(':selected').attr('data-idsiswa'),
            id_project_dimensi : $(this).find(':selected').attr('data-idprojectdimensi'),
            nilai : e.target.value,
            desc : $(this).find(':selected').attr('data-desc')
        }
        console.log('DATA',data);

        $(`#desc-${data.id_siswa}-${data.id_project_dimensi}`).text(data.desc)
        let storeNilai =await postData("http://localhost:8080/admin/p5/penilaian",data);
        console.log("Respon",storeNilai);
        e.target.dataset.id_nilai = storeNilai.id_nilai;
    });

    // $('.td-input').on('change',async function(e){
    //     // console.log(e)
    //     // return false;
    //     data ={
    //         nilai_detail_id : e.target.dataset.nilaidetailid,
    //         nilai : e.target.value
    //     }
    //     let updateNilai = await  postData("http://localhost:8080/admin/nilai/storenilai",data);
    //     console.log('UPDATE NILAI',updateNilai);
    // })

    // $('.btn-delete').click(async function(){
    //     let confirm = window.confirm("Are you sure want to delete this data?");
    //     if (confirm) {
    //         $('#form-delete').trigger('submit')
    //     }else{
    //         return false;
    //     }
    // })
</script>