<?php 
session_start();

require 'function.php'; // pastikan path benar sesuai struktur folder kamu

if( isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if( isset($_POST["register"])) {
    $hasil = registrasi($_POST);

    if( $hasil > 0 ) {
        $_SESSION["login"] = true; // jika mau langsung login
        echo "
            <script>
                alert('User baru berhasil didaftarkan!');
                window.location.href = 'index.php';
            </script>
        ";
        exit;
    } elseif( $hasil === 0 ) {
        // registrasi gagal karena username sudah ada (ditangani di function.php)
        echo "
            <script>
                alert('Username sudah digunakan!');
                window.location.href = 'index.php';
            </script>
        ";
        exit;
    } else {
        echo mysqli_error($conn); // error lain (misal: koneksi database)
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="regis.css">;
    <style>
     body {
  font-family: helvetica;
  background-color: whitesmoke;
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
  background-color: #fff;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
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

input[type="text"],
input[type="password"] {
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
a button {
    width: 100%;
  margin: top;
  background-color: lime;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

a button:hover {

    background-color: limegreen;
}


button:hover {
  background-color: royalblue;
}

p {
  text-align: center;
  color: red;
  font-style: italic;
}

    </style>

</head>
<body>
   <h1>Registrasi</h1>
   
   <form action="" method="post">

    <ul>
        <li>
            <label for="username">Username : </label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <label for="password2">Confirm : </label>
            <input type="password" name="password2" id="password2">
        </li>
        <li>
            <button type="submit" name="register">Register</button>
        </li>
        <li style="display: block;
                   text-align:center;
                   font-weight: bold;
                   color: black;">
            Atau Sudah Punya User?
        </li>
    <li>
       <a href="login.php"> <button type="button" name="login">Masuk</button></a>
    </li>
    </ul>

   </form>

</body>
</html>