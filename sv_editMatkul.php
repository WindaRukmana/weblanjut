<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$kdmk=$_POST["kdmk"];
$nama=$_POST["nama"];
$sks=$_POST["sks"];
$jns=$_POST["jns"];
$smt=$_POST["smt"];
$uploadOk=1;

//membuat query
$sql="update matkul set namamatkul='$nama',
					 sks='$sks',
					 jns='$jns',
					 smt='$smt'
					 where idmatkul='$kdmk'";
mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
header("location:updateMatkul.php");
?>