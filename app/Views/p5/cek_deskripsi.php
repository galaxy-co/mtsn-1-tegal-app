<div class="main-panel">
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
                    <a class="nav-link" href="<?= base_url('admin/p5/view/proyek?tingkat='.$tingkat) ?>">PROYEK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('admin/p5/view/penilaian?tingkat='.$tingkat) ?>">PENILAIAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('admin/p5/view/cek_deskripsi?tingkat='.$tingkat) ?>">CEK DESKRIPSI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= base_url('admin/p5/view/raport?tingkat='.$tingkat) ?>">RAPORT</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="table-responsive">
                    <table class='table table-responsive'>
                        <th>NISM</th>
                        <th>NAMA SISWA</th>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CATATAN -->
<!-- 
Ananda menunjukkan pribadi yang ${AP9} dalam ${AQ9}  dengan perwujudan sebagai seorang yang memiliki sikap ${AR9}  yang senantiasa perlu dibimbing dan dikembangkan untuk kesuksesannya di masa depan
 -->