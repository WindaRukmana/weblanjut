
<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$hb_kdmk=$_POST["hb-kdmk"];
$kdmk=$hb_kdmk . "." . $_POST["kdmk"];
$nama=$_POST["nama"];
$sks=$_POST["sks"];
$jns=$_POST["jns"];
$smt=$_POST["smt"];
$uploadOk=1;

$q = "SELECT * FROM matkul WHERE idmatkul='" . $kdmk . "'";

$rs = mysqli_query($koneksi,$q);
if(mysqli_num_rows($rs) == 0)
{
        //jika npp tidak ditemukan,simpan data
        $sql = "INSERT INTO matkul VALUES ('" . $kdmk . "','" . $nama . "','" . $sks . "','" . $jns . "','" . $smt . "')";
        mysqli_query($koneksi,$sql);
        header("location: updateMatkul.php");
}
else
{
        //jika npp sudah ada, tampilkan peringatan
        echo '<script>
                     alert("NPP yang diinput sudah ada")
                      javascript:history.go(-1)
              </script>';
}
?>