<?php 
usleep(500000);
  require '../function.php';

  $keyword = $_GET["keyword"];

  $query = "SELECT * FROM pemain WHERE
       nama LIKE '%$keyword%' OR
       nopung LIKE '%$keyword%' OR
       kebangsaan LIKE  '%$keyword%' OR
       club LIKE  '%$keyword%'
       ";
  $pemain = query($query);
  ?>
  <table border="1" cellpadding="10" cellspacing="0">
       <tr>
        <th>NO.</th>
        <th>Aksi</th>
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
