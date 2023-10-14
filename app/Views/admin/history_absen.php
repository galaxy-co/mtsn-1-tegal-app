<div class="main-panel">
    <!-- Form -->
    <div class="content">
        <div class="page-inner">  
            <div class="page-header">
                <h4 class="page-title">History Absen</h4>
            </div>
            <div class="page-inner">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">History Absen</h4>   
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
                                            <th>Semester</th>
                                            <th>Tahun Ajaran</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Alpa</th>
                                            <th>Izin</th>
                                            <th>Sakit</th>
                                            <th>Semester</th>
                                            <th>Tahun Ajaran</th>
                                            
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
                                            <td><?= $k['semester'] ?></td>
                                            <td><?= $k['tahun_ajaran'] ?></td> 
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
</div>