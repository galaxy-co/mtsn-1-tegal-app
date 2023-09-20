<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Raport</title>
    <style type='text/css'>
    .tg {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }

    .tg .tg-headerlogo {
        text-align: right;
        border-right: none;
        border-left: none;
        border-top: none;
        border-bottom: none;
    }

    .tg .tg-img-logo {
        width: 195px;
        height: 90px;
        object-fit: cover;
    }

    .tg .tg-headerrow {
        text-align: right;
        font-size: 12px;
    }

    .tg .tg-headerrow_legalName {
        text-align: right;
        font-size: 13px;
        word-break: break-all;
        font-weight: bold;
    }

    .tg .tg-headerrow_Total {
        text-align: right;
        font-size: 16px;
        word-break: break-all;
        font-weight: bold;
    }

    .tg .tg-headerrow_left {
        text-align: left;
        font-size: 12px;
    }

    .tg .tg-head_body {
        text-align: left;
        font-size: 12px;
        font-weight: bold;
        border-top: 3px solid black;
        border-bottom: 3px solid black;
    }

    .tg .tg-b_body {
        text-align: left;
        font-size: 12px;
        border-bottom: solid black 2px;
    }

    .tg .tg-f_body {
        text-align: right;
        font-size: 14px;
        border-bottom: solid black 2px;
    }

    .tg .tg-foot {
        font-size: 11px;
        color: #808080;
        position: absolute;
        bottom: 0;
    }

    /* Center-align the text and reduce margin between <p> elements */
    .center-text p {
        text-align: center;
        margin: 5px 0; /* Adjust the margin as needed */
    }

    /* Style the horizontal line */
    .horizontal-line {
        border-top: 1px solid black;
        margin: 5px 0;
    }
    .center-table-cell {
        text-align: center;
    }
    .bordered-td {
        border: 1px solid black;
        padding: 5px; /* Optional: Add padding for better spacing */
        background-color: grey;
    }
</style>

</head>
<body>
    <table class="tg" width="100%"  style="table-layout:fixed;">
    <thead>
        <tr>
            <td style="width: 15%;"></td>
            <td style="width: 70%;"></td>
            <td style="width: 15%;"></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><img src="<?= base_url('assets/')?>assets/img/kemenag_logo.png" alt=""></td>
            <td class="center-text">
                <p><b>KEMENTRIAN AGAMA</b></p>
                <p><b>KANTOR KEMENTRIAN AGAMA KABUPATEN TEGAL</b></p>
                <p><b>MADRASAH TSANAWIYAH NEGERI 1 TEGAL</b><br></p>
                <p style="font-size: x-small;">Jl. Ponpes Babakan-Lebaksiu Tegal</p>
                <!-- Horizontal line -->
            </td>
            <td><img src="" alt=""></td>
        </tr>
        <tr>
            <td class="horizontal-line"></td>
            <td class="horizontal-line"></td>
            <td class="horizontal-line"></td>
        </tr>
    </tbody>
    </table>
    <table class="tg" width="100%"  style="table-layout:fixed;" >
        <thead>
            <tr>
                <td style="width: 10%;"></td>
                <td style="width: 80%;"></td>
                <td style="width: 10%;"></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td class="center-table-cell" style="font-size: small;"><b>RAPORT PROYEK PENGUATAN PROFIL PELAJAR PANCASILA DAN PROFIL PELAJAR RAHMATAN LIL ALAMIN</b></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table class="tg" width="100%"  style="table-layout:fixed; margin-top: 30px;">
        <thead>
            <tr>
                <td style="width: 15%;"></td>
                <td style="width: 1%;"></td>
                <td style="width: 25%;"></td>
                <td style="width: 18%;"></td>
                <td style="width: 15%;"></td>
                <td style="width: 1%;"></td>
                <td style="width: 25%;"></td>
            </tr>
        </thead>
        <tbody>
            <tr style="font-size: smaller;">
                <td style="font-size:x-small;">Nama Siswa</td>
                <td style="font-size:x-small;">:</td>
                <td style="font-size:x-small;"><?= $siswa['nama_siswa']?></td>
                <td></td>
                <td style="font-size:x-small;">Fase</td>
                <td style="font-size:x-small;">:</td>
                <td style="font-size:x-small;">D</td>
            </tr>
            <tr>
                <td style="font-size:x-small;">NISM</td>
                <td style="font-size:x-small;">:</td>
                <td style="font-size:x-small;"><?= $siswa['nism']?></td>
                <td></td>
                <td style="font-size:x-small;">Kelas</td>
                <td style="font-size:x-small;">:</td>
                <td style="font-size:x-small;"><?= $siswa['tingkat'] .' '. $siswa['nama_kelas']?></td>
            </tr>
            <tr>
                <td style="font-size:x-small;">Semester</td>
                <td style="font-size:x-small;">:</td>
                <td style="font-size:x-small;"><?= $nilai[0]['semester']?></td>
                <td></td>
                <td style="font-size:x-small;">Tahun Ajaran</td>
                <td style="font-size:x-small;">:</td>
                <td style="font-size:x-small;"><?= $nilai[0]['tahun_ajaran']?></td>
            </tr>
        </tbody>
    </table>
    
    <table class="tg" width="100%"  style="table-layout:fixed; margin-top: 30px;">
        <thead>
            <tr>
                <td style="width: 5%;"></td>
                <td style="width: 35%;"></td>
                <td style="width: 25%;"></td>
                <td style="width: 35%;"></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="background-color:grey;" class="bordered-td">No</td>
                <td style="background-color:grey;" class="bordered-td">DIMENSI P5 PPRA</td>
                <td style="background-color:grey;" class="bordered-td">NILAI</td>
                <td style="background-color:grey;" class="bordered-td">DESKRIPSI CAPAIAN</td>
            </tr>
            <tr>
                <td style="background-color:grey;" class="bordered-td"></td>
                <td style="background-color:grey;" class="bordered-td"></td>
                <td style="background-color:grey;" class="bordered-td"></td>
                <td style="background-color:grey;" class="bordered-td"></td>
            </tr>
        </tbody>

    </table>

</body>
</html>
