<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("Location:index.php");
}
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$npp=$_GET["kode"];

//membuat query hapus data
$sql="delete from dosen where npp='$npp'";
mysqli_query($koneksi,$sql);
header("location:updateDosen.php");
?>