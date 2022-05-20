<?php
    require 'Koneksi.php';

    $no = $_GET['NoPeminjaman'];

    mysqli_query($koneksi, "delete from PERPUS where NoPeminjaman='$no'") or die('SQL Error: '.mysqli_error($Koneksi));

    header("location:Index.php");
?>
