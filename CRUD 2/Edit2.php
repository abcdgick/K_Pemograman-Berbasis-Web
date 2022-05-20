<?php
    require 'Koneksi.php';

    $no = $_GET['no'];
    $npm = $_GET['npm'];
    $kode = $_GET['kode'];
    $pnjm = $_GET['pnjm'];
    $kmbl = $_GET['kmbl'];

    $sql = "update PERPUS set
        NPM='$npm',
        KdKategori='$kode',
        TglPinjam='$pnjm',
        TglKembali='$kmbl'
        where NoPeminjaman='$no'";

    mysqli_query($koneksi, $sql) or die('SQL Error: '.mysqli_error($koneksi));

    header("location:Index.php");
?>