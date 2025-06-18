<?php
require_once __DIR__ . '/vendor/autoload.php';
require 'function.php';

$pemain = query("SELECT * FROM pemain");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pemain Bola</title>
    <link rel="stylesheet" href="index.css">
    <style>
        img {
            width: 50px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<h1>Daftar Pemain Bola</h1>
<table>
   <tr>
    <th>NO.</th>
    <th>Gambar</th>
    <th>Nama</th>
    <th>No Punggung</th>
    <th>Kebangsaan</th>
    <th>Club</th>
   </tr>';

$i = 1;
foreach ($pemain as $row) {
    $gambarPath = 'img/' . $row["gambar"];
    $html .= '<tr>
        <td>' . $i++ . '</td>
        <td><img src="' . $gambarPath . '" alt="gambar"></td>
        <td>' . $row["nama"] . '</td>
        <td>' . $row["nopung"] . '</td>
        <td>' . $row["kebangsaan"] . '</td>
        <td>' . $row["club"] . '</td>
    </tr>';
}

$html .= '</table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('daftar-pemainbola.pdf', \Mpdf\Output\Destination::INLINE);


?>