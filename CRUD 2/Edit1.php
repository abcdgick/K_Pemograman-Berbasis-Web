<html>
<head><style>
    .tampilan{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12pt;
        border-collapse: collapse;
        margin-left: auto;
        margin-right: auto;
    }

    .tampilan tr:hover {
        background-color: coral;
    }

    .tampilan tr:nth-child(even){
        background-color: #f2f2f2;
    }

    .tampilan tr:nth-child(even):hover{
        background-color: coral;
    }

    .tampilan th{
        font-weight: bold;
        background-color: #04AA6D;
        padding: 10px;
        font-size: 14pt;
        color: white;
    }

    .tampilan td{
        padding:10px;
    }

    .button {
        font-weight: bold;
        background-color: #2196f3;
        font-size: 14;
        color: white;
    }

    .button:hover{
        font-weight: bold;
        background-color: white;
        font-size: 16;
        color: #2196f3;
        border-radius: 20;
        border-width: 3;
    }
</style></head>
<body>
<?php
    $no = $_GET['NoPeminjaman'];

    require 'Koneksi.php';

    $sql = "select NoPeminjaman, NPM, KdKategori, TglPinjam,TglKembali from PERPUS where NoPeminjaman='$no'";
    $query = mysqli_query($koneksi,$sql) or die('SQL Error: '.mysqli_error($koneksi));
    $row = mysqli_fetch_array($query);

    echo "<form method='GET' action='Edit2.php'>
    <h2 align=center>Data Peminjaman Perpustakaan LIKMI</h2>
    <table>
        <tr>
            <td>No. Peminjaman : </td>
            <td><input type='text' name='no' value='$row[NoPeminjaman]'></td>
        </tr>
        <tr>
            <td>NPM : </td>
            <td><input type='text' name='npm' value='$row[NPM]'></td>
        </tr>
        <tr>
            <td>Kode Kategori : </td>
            <td><input type='text' name='kode' value='$row[KdKategori]'></td>
        </tr>
        <tr>
            <td>Tanggal Pinjam : </td>
            <td><input type='text' name='pnjm' value='$row[TglPinjam]'></td>
        </tr>
        <tr>
            <td>Tanggal Kembali : </td>
            <td><input type='text' name='kmbl' value='$row[TglKembali]'></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type='submit' value='Submit' class=button>
                <input type='reset' value='Reset' class=button>
            </td>
        </tr>
    </table>
    </form>";

    $sql = "select NoPeminjaman, NPM, KdKategori, TglPinjam,TglKembali, datediff(TglKembali, TglPinjam) as LamaPinjam from PERPUS";
    $query = mysqli_query($koneksi,$sql) or die('SQL Error: '.mysqli_error($koneksi));

    $total = 0;

    echo "<table class=tampilan>
    <tr>
        <th>Nomor Peminjaman</th>
        <th>NPM</th>
        <th>Kode Kategori</th>
        <th>Kategori</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Lama Pinjam</th>
        <th>Jumlah Denda</th>
        <th>Edit & Delete</th>
    </tr>";

    while($row = mysqli_fetch_array($query)){
        switch($row['KdKategori']){
            case 'A':
                $ktg = "Sains";
                $dph = 1000;
                break;
            case 'B':
                $ktg = "Fiksi";
                $dph = 500;
                break;
            case 'C':
                $ktg = "Agama";
                $dph = 750;
                break;
            default:
                $ktg = "";
                $dph = 0;
        }

        if($row['LamaPinjam'] > 7) $denda = ($row['LamaPinjam'] - 7) * $dph;
        else $denda = 0;

        echo "
        <tr>
            <td>$row[NoPeminjaman]</td>
            <td>$row[NPM]</td>
            <td>$row[KdKategori]</td>
            <td>$ktg</td>
            <td>$row[TglPinjam]</td>
            <td>$row[TglKembali]</td>
            <td>$row[LamaPinjam]</td>
            <td>$denda</td>
            <td>
                <a href='Edit1.php?NoPeminjaman=$row[NoPeminjaman]'>Edit</a>&nbsp;
                <a href='Delete.php?NoPeminjaman=$row[NoPeminjaman]' onClick='return confirm(\"Hapus Data Peminjaman $row[NoPeminjaman]?\")'>Hapus</a>
            </td>
        </tr> ";

        $total += $denda;
    }

    if($total == 0) $rata2 = 0;
    else $rata2 = $total / mysqli_num_rows($query);
    echo "
    <tr>
        <th colspan=7 align=right>TOTAL : </th>
        <td>$total</td>
    </tr>
    <tr>
        <th colspan=7 align=right>RATA-RATA : </th>
        <td>$rata2</td>
    </tr>
    </table>
    ";

    mysqli_close($koneksi);
?>
</body>
</html>