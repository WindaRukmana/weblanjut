<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sistem Informasi Akademik: Daftar Dosen</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styleku.css">
	<script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
	<script src="bootstrap4/js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <title>Document</title>
    <style>
        .kontent{
            margin-left: 170px
        }
    </style>
</head>
<body>
    
<?php
include "head.html"
?>

<?php
include "fungsi.php";



// Jumlah data per halaman
$jmlDataPerHal = 5;

// Halaman aktif (default ke halaman 1)
$halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;

// Mencari jumlah data
$sqlTotalData = "SELECT COUNT(*) AS total FROM dosen";
$resultTotalData = mysqli_query($koneksi, $sqlTotalData) or die(mysqli_error($koneksi));
$totalData = mysqli_fetch_assoc($resultTotalData)['total'];

// Jumlah halaman
$jmlHal = ceil($totalData / $jmlDataPerHal);

// Menghitung awal data
$awalData = ($jmlDataPerHal * $halAktif) - $jmlDataPerHal;

// Query untuk mengambil data pada halaman saat ini
$sqlHalamanIni = "SELECT * FROM dosen LIMIT $awalData, $jmlDataPerHal";
$queryHalamanIni = mysqli_query($koneksi, $sqlHalamanIni) or die(mysqli_error($koneksi));

// Inisialisasi variabel pencarian
$cari = "";


// Jika form pencarian disubmit
if (isset($_POST['submit'])) {
    $cari = $_POST['cari'];
    // Query untuk mencari data berdasarkan kata kunci
    $sql = "SELECT * FROM dosen WHERE namadosen LIKE '%$cari%' OR npp LIKE '%$cari%' OR homebase LIKE '%$cari%' 
        limit $awalData,$jmlDataPerHal";
            $halAktif = 1;

} else {
    // Jika form tidak disubmit, tampilkan semua data
	$sql="select * from dosen limit $awalData,$jmlDataPerHal";		
}

$hasil=mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));

?>

<div class="utama">
    <h2 class="text-center">Daftar Dosen</h2>
	<div class="text-center"><a href="prnDosen.php"><span class="fas fa-print">&nbsp;Print</span></a></div>
    <span class="float-left">

        <a href="addDosen.php" class="btn btn-success">Tambah Data</a>
</span>
    <span class="float-right">
    <form method="POST" action="" class="form-inline">
        <button class="btn btn-success" type="submit" name="submit" value="Cari">Cari</button>
        <input class="form-control ml-2 mr-2" type="text" name="cari" placeholder="cari data dosen...">
    </form>
    </span>
    <br><br>


    <ul class="pagination">
        <?php
        // Navigasi pagination
        // Cetak navigasi back
        if ($halAktif > 1) {
            $back = $halAktif - 1;
            echo "<li class='page-item'><a class='page-link' href='?hal=$back&cari=$cari'>&laquo;</a></li>";
        }
        // Cetak angka halaman
        for ($i = 1; $i <= $jmlHal; $i++) {
            if ($i == $halAktif) {
                echo "<li class='page-item '><a class='page-link' href='?hal=$i&cari=$cari' style='font-weight: bold; color: red;'>$i</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='?hal=$i&cari=$cari'>$i</a></li>";
            }
        }
        // Cetak navigasi forward
        if ($halAktif < $jmlHal) {
            $forward = $halAktif + 1;
            echo "<li class='page-item'><a class='page-link' href='?hal=$forward&cari=$cari'>&raquo;</a></li>";
        }
        ?>
    </ul>

	<table class="table table-hover">
	<thead class="thead-light">
            <tr>
                <th>No.</th>
                <th>NPP</th>
                <th>Nama Dosen</th>
                <th>Homebase</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
                if($awalData==0){
                    $no=$awalData+1;
                }else{
                    $no=$awalData;
                }
                while($row=mysqli_fetch_assoc($hasil)){
                    ?>
                    <tr>
                    <td><?php echo $no?></td>

                    <td><?php echo $row["npp"]?></td>
                    <td><?php echo $row["namadosen"]?></td>
                    <td><?php echo $row["homebase"]?></td>
                    <td>
                    <a class="btn btn-outline-primary btn-sm" href="editDosen.php?kode=<?php echo $row['npp']?>">Edit</a>
                    <a class="btn btn-outline-danger btn-sm" href="hpsDosen.php?kode=<?php echo $row["npp"]?>" id="linkHps" onclick="return confirm('Anda ingin menghapus data ini?')">Hapus</a>
                    </td>

                    </tr>
                <?php
                $no++;

                }
            
            ?>
	
            
        </tbody>
    </table>
</div>


</body>
</html>