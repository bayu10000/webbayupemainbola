<?php 
session_start();

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;

}
require 'function.php';


//cek apakah tombol submit sudah ditekan atau belum

if( isset($_POST["submit"])) {

  
  
   // cek kkeberhasilan
  if( tambah($_POST) > 0) {
    echo "
       <script>
             alert('data berhasil Ditambahkan');
             document.location.href ='index.php';
       </script>

    
    ";
  } else {
    echo "<script>
             alert('data gagal Ditambahkan');
             document.location.href ='index.php';
       </script>";
  }
  

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pemain</title>
    <style>
    body {
  background-color: whitesmoke;
  font-family: helvetica;
}

h1 {
  text-align: center;
  margin-top: 50px;
  color: black;
}
form {
  width: 500px;
  margin: 50px auto;
  padding: 50px;
  background-color: white;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
  transition: 0.4s;
  border-radius: 5px;
}
form:hover {
  width: 520px;
  padding: 52px;
  margin: 52px auto;
  border-radius: 12px;
  background-color: aliceblue;
}
ul {
  list-style: none;
  padding: 0;
}
li {
  margin-bottom: 20px;
}
label {
  display: block;
  margin-bottom: 6px;
  font-weight: bold;
  color: black;
}
input {
  width: 100%;
  padding: 10px;
  border: 1px solid black;
  border-radius: 5px;
  box-sizing: border-box;
}
button {
   width: 100%;
  padding: 10px;
  background-color: dodgerblue;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
button:hover {
  background-color: royalblue;
}
</style>

</head>
<body>

<h1> Tambah Data Pemain</h1>

<form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="nama">Nama    </label>
            <input type="text" name="nama" id="nama">
        </li>
        <li>
            <label for="nopung">No Punggung             </label>
            <input type="text" name="nopung" id="nopung">
        </li>
        <li>
            <label for="kebangsaan">Kebangsaan </label>
            <input type="text" name="kebangsaan" id="kebangsaan">
        </li>
        <li>
            <label for="club">Club </label>
            <input type="text" name="club" id="club">
        </li>
        <li>
            <label for="gambar">Gambar </label>
            <input type="file" name="gambar" id="gambar">
        </li>
        <li>
            <button type="submit" name="submit"> Tambah Data </button>
        </li>
    </ul>
</form>
    
</body>
</html>