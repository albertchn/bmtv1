<?php 

    require '../vendor/autoload.php';
    require '../assets/functions/function.php';

    use Dompdf\Dompdf;

    $dompdf = new Dompdf();

    $html = '
    <style>
        table {
            border-collapse: collapse;
        }
        table th {
            border: 1px solid black;
        }
        table td {
            border: 1px solid black;
        }

    </style>

    <h1>Bank Dubes</h1>
    ';
    
    if(isset($_GET['norek'])){
        $result = mysqli_query($conn, 'SELECT no_rekening, kode_transaksi, nama, debit, kredit, tanggal, transaksi.teller FROM transaksi JOIN rekening WHERE transaksi.id_nasabah = rekening.id_nasabah && tanggal BETWEEN "'. $_GET['awal'].' 00:00:00" AND "'.$_GET['akhir'].' 23:59:59" && no_rekening = "'.$_GET['norek'].'"');
    } else {
        $result = mysqli_query($conn, 'SELECT no_rekening, kode_transaksi, nama, debit, kredit, tanggal, transaksi.teller FROM transaksi JOIN rekening WHERE transaksi.id_nasabah = rekening.id_nasabah && tanggal BETWEEN "'. $_GET['awal'].' 00:00:00" AND "'.$_GET['akhir'].' 23:59:59"');
    }

    

    $html .= '
    <table style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Nama</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Tanggal</th>
                <th>Teller</th>
            </tr>
        </thead>
        <tbody>
        ';
        $no = 1;
        while($d = mysqli_fetch_array($result)){
            
            $html .= '
            <tr>
                <td>'.$no++.'</td>
                <td>'.$d['kode_transaksi'].'</td>
                <td>'.$d['nama'].'</td>
                <td>'.$d['debit'].'</td>
                <td>'.$d['kredit'].'</td>
                <td>'.$d['tanggal'].'</td>
                <td>'.$d['teller'].'</td>
            </tr> 

            ';
        }

        




    $dompdf->loadHTML($html);
    $dompdf->setPaper('A4', 'potrait');
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();

?>