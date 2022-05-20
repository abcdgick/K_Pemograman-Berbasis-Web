<?php
    $no = $_GET['no'];
    $npm = $_GET['npm'];
    $kode = $_GET['kode'];
    $pnjm = $_GET['pnjm'];
    $kmbl = $_GET['kmbl'];

    require 'Koneksi.php';
    $sql = "insert into PERPUS values('$no','$npm','$kode','$pnjm', '$kmbl')";
    mysqli_query($koneksi,$sql) or die('SQL Error: '.mysqli_error($koneksi));

    header("location:Index.php")
?>