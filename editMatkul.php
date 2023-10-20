<?php
$kodemk = ["A11", "A12", "A14", "A15"];
$sks = [2,3,4,6];
$jns = ["T", "P", "T/P"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Akademik::Edit Data Mata Kuliah</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/styleku.css">
	<script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script>
	<script src="bootstrap4/js/bootstrap.js"></script>
</head>
<body>
	<?php
	require "fungsi.php";
	require "head.html";
	$id=deskripsiurl($_GET['kode']);
	$sql="select * from matkul where idmatkul='$id'";
	$qry=mysqli_query($koneksi,$sql);
	$row=mysqli_fetch_assoc($qry);
	?>
	<div class="utama">
	<br><br><br>		
		<h3>EDIT DATA MATA KULIAH</h3>
		<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
		</div>	
		<form method="post" action="sv_editMatkul.php" enctype="multipart/form-data">
			<div class="form-group">
				<label for="npp">Kode Mata Kuliah</label>
				<div class="form-group input-group">
					<input class="form-control" type="text" name="kdmk" id="kdmk" value="<?=$row["idmatkul"]?>">
				</div>
				<label class="text-danger" style="display:none; margin-bottom: 0" id="info">Diharapkan memasukkan 5 Karakter</label>
			</div>
			<div class="form-group">
				<label for="nama">Nama Mata Kuliah:</label>
				<input class="form-control" type="text" name="nama" id="nama" value="<?=$row["namamatkul"]?>">
				</div>
				<div class="form-group">
					<label for="nama">SKS:</label>
					<div class="form-group">
						<select name="sks" id="sks" class="custom-select">
							<?php foreach($sks as $i) {
								if($i == $row["sks"]):
								?>
								<option value="<?= $i; ?>" selected><?= $i; ?></option>
									<?php else: ?>
									<option value="<?= $i; ?>"><?= $i; ?></option>
									<?php endif; ?>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="nama">Jenis:</label>
					<div class="form-group">
						<select name="jns" id="jns" class="custom-select">
							<?php foreach($jns as $i) {
								if($i == $row["jns"]):
								?>
								<option value="<?= $i; ?>" selected><?= $i; ?></option>
								<?php else: ?>
								<option value="<?= $i; ?>"><?= $i; ?></option>
								<?php endif; ?>
								<?php } ?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="nama">Semester:</label>
							<div class="form-group">
								<select name="smt" id="smt" class="custom-select">
									<?php for($i = 1; $i <= 8; $i++) {
								if($i == $row["smt"]):
								?>
									<option value="<?= $i; ?>" selected><?= $i; ?></option>
								<?php else: ?>
									<option value="<?= $i; ?>"><?= $i; ?></option>
									<?php endif; ?>
									<?php } ?>
								</select>
					</div>
				</div>
			<div>		
				<button type="submit" class="btn btn-primary" id="tombol" value="Simpan">Simpan</button>
			</div>
		</form>
	</div>
	<script>
		$('#submit').on('click',function(){
			var id 		= $('#id').val();
			var nama	= $('#nama').val();
			var email 	= $('#email').val();
			$.ajax({
				method	: "POST",
				url		: "sv_editMatkul.php",
				data	: {id:id, nama:nama, email:email}
			});
		});
	</script>
</body>
</html>