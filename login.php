<?php 
session_start();
require 'function.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];
// ambil username berdasarkan id
   $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
   $row = mysqli_fetch_assoc($result);
// cek cookie dan username
   if( $key === hash('sha256', $row['username'])) {
       $_SESSION['login'] = true;
   }
}


if( isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}



if(isset($_POST["login"])) {

   $username = $_POST["username"];
   $password = $_POST["password"];


   $result= mysqli_query($conn, "SELECT * FROM user WHERE
   username = '$username'");


if( mysqli_num_rows($result) ===1 ){

    // cek password
    $row = mysqli_fetch_assoc($result);
   if( password_verify($password, $row["password"])) {
    // set session
    $_SESSION["login"] = true;

    // cek remember me
    if( isset($_POST['remember'])) {
       // buat cookie
       setcookie('id', $row['id'], time()+3600);
       setcookie('key', hash('sha256', $row['username']), time()+3600);

    }
      header("Location: index.php");
      exit;

   }
}

$error = true;

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
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
  <h1>Log In</h1>  

  <?php if( isset($error)) : ?>
    <p style="color:red; font-style:italic">username/password salah</p>
    <?php endif; ?>


  <form action="" method="post">

   <ul>
    <li>
        <label for="username"> Username</label>
        <input type="text" name="username" id="username">
    </li>
    <li>
        <label for="password"> Password</label>
        <input type="password" name="password" id="password">
    </li>
    <li>
        
        <input type="checkbox" name="remember" id="remember">
        <label for="remember"> Remember Me</label>
    </li>
    <br>
    <li>
        <button type="submit" name="login" >Login</button>
    </li>
    <li style="display: block;
                   text-align:center;
                   font-weight: bold;
                   color: black">
            ~ Belum Registrasi? ~
        </li>
    <li>
       <a href="registrasi.php"> <button type="button" name="login">Registrasi</button></a>
    </li>
    </ul>
   </ul>
  </form>
</body>
</html>