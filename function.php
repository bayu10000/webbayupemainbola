<?php
// Koneksi database (sesuaikan dengan config kamu)
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

// Fungsi untuk ambil data (SELECT)
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Fungsi tambah data pemain
function tambah($data) {
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $nopung = htmlspecialchars($data["nopung"]);
    $kebangsaan = htmlspecialchars($data["kebangsaan"]);
    $club = htmlspecialchars($data["club"]);
    
    // up gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

    $query = "INSERT INTO pemain (nama, nopung, kebangsaan, club, gambar) VALUES 
                ('$nama', '$nopung', '$kebangsaan', '$club', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // cek ekstensi file
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Yang Anda upload bukan gambar!');
              </script>";
        return false;
    }

    // cek ukuran file
    if ($ukuranfile > 1000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    // generate nama file baru agar tidak bentrok
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

    // pindahkan file
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}







// Fungsi ubah data pemain
function ubah($data) {
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nopung = htmlspecialchars($data["nopung"]);
    $kebangsaan = htmlspecialchars($data["kebangsaan"]);
    $club = htmlspecialchars($data["club"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $gambarlama =htmlspecialchars($data["gambarlama"]);

    if( $_FILES['gambar']['error'] === 4) {
          $gambar = $gambarlama;

    } else {
        $gambar = upload();
    }

    $query = "UPDATE pemain SET 
                nama = '$nama',
                nopung = '$nopung',
                kebangsaan = '$kebangsaan',
                club = '$club',
                gambar = '$gambar'
              WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM pemain WHERE id = $id");
    return mysqli_affected_rows($conn);
}



   function cari($keyword) {

       $query = "SELECT * FROM pemain WHERE
       nama LIKE '%$keyword%' OR
       nopung LIKE '%$keyword%' OR
       kebangsaan LIKE  '%$keyword%' OR
       club LIKE  '%$keyword%'
       ";
    return query($query);
   }

   function registrasi($data) {
       global $conn;
       
       $username = strtolower(stripslashes($data["username"]));
       $password = mysqli_real_escape_string($conn, $data["password"]);
       $password2 = mysqli_real_escape_string($conn, $data["password2"]);


       // cek username sudah ada atau belum
       $result = mysqli_query($conn, "SELECT username FROM user 
       WHERE username = '$username'");

       if(mysqli_fetch_assoc($result) ) {
         echo "<script>
           alert('username sudah terdaftar')     
         </script>";
        return false;
       }
       

       // cek confirm password
       if( $password !== $password2 ) {
          echo "
          <script>
             alert('konfirmasi password tidak sesuai');
          </script>";
       return false;
       }
     // enkripsi password
     $password = password_hash($password, PASSWORD_DEFAULT);
     // tambahkan userbaru ke database
       mysqli_query($conn, "INSERT INTO user (username, password)VALUES('$username', '$password')");

       return mysqli_affected_rows($conn);
  
    }





?>
