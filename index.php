<?php 
session_start();

if( !isset($_SESSION["login"])) {
    header("Location: registrasi.php");
    exit;
}
require 'function.php';
$pemain = query("SELECT * FROM pemain");
// pagination
// konfigurasi

$jumlahdataperhalaman = 5;
$jumlahdata = count(query("SELECT * FROM pemain"));
$jumlahhalaman = ceil ($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = isset($_GET["halaman"]) ? $_GET["halaman"] : 1;

// halaman = 2, awaldata = 3
// halaman = 3, awaldata = 4
$awaldata = ( $jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;

$pemain = query("SELECT * FROM pemain LIMIT $awaldata, $jumlahdataperhalaman");

if(isset($_POST["cari"])) {

     $pemain = cari($_POST["keyword"]);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        @media print {
  .logout, .tambah, .formcari, .aksi {
    display: none;
  }
}
body {
  font-family: Arial, sans-serif;

  padding: 20px;
  color: black;
}

h1 {
  color: black;
  text-align: center;
  margin-bottom: 20px;
}


a {
  text-decoration: none;
  color: blue;
  font-weight: bold;
}

form {
  margin-bottom: 20px;
}

input[type="text"] {
  padding: 8px;
  width: 250px;
  border: 1px solid #ccc;
  border-radius: 4px;
  border-color: darkblue;
}

button {
  padding: 8px 16px;
  border: none;
  background-color: darkblue;
  color: white;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: white;
}

table {
  border-collapse: collapse;
  width: 100%;
  background-color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

th,
td {
  padding: 12px;
  border: 1px solid #ddd;
  text-align: center;
}

th {
  background-color: dodgerblue;
  color: white;
}

.loader {
  width: 100px;

  top: 165px;
  display: none;
}
.pagination {
  margin-top: 20px;
  text-align: center;
}

.pagination a {
  display: inline-block;
  padding: 8px 12px;
  margin: 0 5px;
  text-decoration: none;
  background-color: #f2f2f2;
  color: #333;
  border: 1px solid #ccc;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.pagination a:hover {
  background-color: darkblue;
  color: white;
}

.pagination a.active {
  font-weight: bold;
  background-color: darkblue;
  color: white;
  border: 1px solid #007bff;
}
.logout {
    background-color: red;
     width: 80%;
  padding: 8px;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
}
.tambah {
     background-color: limegreen;
     width: 80%;
  padding: 8px;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
}
.aksi .ubahh {
    background-color: limegreen;
     width: 80%;
  padding: 8px;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  cursor: pointer;
}

.aksi .ubah:hover {
   font-style: normal;
   color: white;


}
.aksi .hapuss {
     background-color: red;
     width: 80%;
  padding: 8px;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
}
.logout:hover {
  color: white;
  border: 1px solid red;
}

.tambah:hover {
  color: white;
  border: 1px solid limegreen;
}

.ubahh:hover {
  color: white;
  border: 1px solid limegreen;
}

.hapuss:hover {
  color: white;
  border: 1px solid red;
}


    </style>
    
    <script src="js/jquery-3.7.1.min.js"></script>    
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="index.css">
</head>
<body>

   
    <h1>Daftar Pemain Bola</h1>
    <a href="logout.php" class="logout">Log Out</a> <br> <br>
    <a href="tambah.php" class="tambah">Tambah Data Pemain</a> | <a href="cetak.php"class="tambah" target="_blank">Cetak</a>
    <br><br>

    <form action="" method="post" class="formcari">
  <div style="display: inline-flex; align-items: center;">
    <input type="text" name="keyword" size="30" autofocus
        placeholder="Masukan Keyword" autocomplete="off" id="keyword">
    <img src="img/load.GIF" class="loader" style="margin-left: 268px;">
  </div>
  <button type="submit" name="cari" id="tombolcari">Cari</button>
</form>
    </form>


    <br>
    <div id="container">
    <table border="1" cellpadding="10" cellspacing="0">
       <tr style="background-color: dodgerblue;">
        <th>NO.</th>
        <th class="aksi">Aksi</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>No Punggung</th>
        <th>Kebangsaan</th>
        <th>Club</th>
       </tr>

       <?php $i = 1; ?>
       <?php foreach( $pemain as $row ): ?>
       <tr>
        <td><?= $i; ?></td>
        <td class="aksi">
            <a href="ubah.php?id=<?= $row["id"]; ?>" class="ubahh">Ubah</a> |
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');" class="hapuss">Hapus</a>
        </td>
        <td><img src="img/<?= $row["gambar"]; ?>" width="50" alt="<?= $row["nama"]; ?>"></td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["nopung"]; ?></td>
        <td><?= $row["kebangsaan"]; ?></td>
        <td><?= $row["club"]; ?></td>
       </tr>
       <?php $i++; ?>
       <?php endforeach; ?>
    </table>
</div>
<div class="pagination">
    <?php if( $halamanaktif > 1 ) : ?>
        <a href="?halaman=<?= $halamanaktif -1; ?>">&laquo;</a>
    <?php endif; ?>

    <?php for($i = 1; $i <= $jumlahhalaman; $i++ ) : ?>
        <?php if( $i == $halamanaktif) : ?>
            <a href="?halaman=<?= $i;?>" class="active"><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i;?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if( $halamanaktif < $jumlahhalaman ) : ?>
        <a href="?halaman=<?= $halamanaktif + 1; ?>">&raquo;</a>
    <?php endif; ?>
</div>


</body>
</html>
