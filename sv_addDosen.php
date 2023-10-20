<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("Location:index.php");
}
//memanggil file pustaka fungsi
require "fungsi.php";
//memindahkan data kiriman dari form ke var biasa
$tahun=$_POST["tahun"];
$kode=$_POST["kode"];
if ($kode < 10) {
	$kode = "00" . $kode;
}else if ($kode < 100) {
	$kode = "0" . $kode; 
}
$npp = "0686.11.$tahun.$kode";
$nama=$_POST["nama"];
$homebase=$_POST["homebase"];
$uploadOk=1;
$sql = mysqli_query($koneksi, "SELECT npp FROM dosen");
$i = 0;
while ($datas = mysqli_fetch_row($sql)) {
	$data[$i] = substr(trim($datas[0]), 8) ;
	$i++;
}


if (array_search("$tahun.$kode", $data)) {
	header("location:addMhs.php?error=1&npp=$npp");
}

//Set lokasi dan nama file foto
// $folderupload ="foto/";
// $fileupload = $folderupload . basename($_FILES['foto']['name']); // foto/A12.2018.05555.jpg
// $filefoto = basename($_FILES['foto']['name']);                  // A12.2018.0555.jpg

//ambil jenis file
// $jenisfilefoto = strtolower(pathinfo($fileupload,PATHINFO_EXTENSION)); //jpg,png,gif

// Check jika file foto sudah ada
// if (file_exists($fileupload)) {
//     echo "Maaf, file foto sudah ada<br>";
//     $uploadOk = 0;
// }

// Check ukuran file
// if ($_FILES["foto"]["size"] > 1000000) {
//     echo "Maaf, ukuran file foto harus kurang dari 1 MB<br>";
//     $uploadOk = 0;
// }

// Hanya file tertentu yang dapat digunakan
// if($jenisfilefoto != "jpg" && $jenisfilefoto != "png" && $jenisfilefoto != "jpeg"
// && $jenisfilefoto != "gif" ) {
//     echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan<br>";
//     $uploadOk = 0;
// }

// Check jika terjadi kesalahan
// if ($uploadOk == 0) {
//     echo "Maaf, file tidak dapat terupload<br>";
// jika semua berjalan lancar
// } else {
//     if (move_uploaded_file($_FILES["foto"]["tmp_name"], $fileupload)) {        
        //membuat query
		$sql="insert dosen values('$npp','$nama','$homebase')";
		mysqli_query($koneksi,$sql);
		header("location:updateDosen.php");
		//echo "File ". basename( $_FILES["foto"]["name"]). " berhasil diupload";
//     } else {
//         echo "Data gagal tersimpan";
//     }
// }
?>