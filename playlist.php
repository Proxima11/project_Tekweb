<!--HARUS LEWAT library.php UNTUK KE SINI. playlist.php BAKAL TERIMA PARAMETER DARI library.php.
playlist.php untuk melihat playlist tertentu-->
<?php
require "connection.php"
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="bootstrap-5.2.0/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="library.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<style>
		body{font: 14px sans-serif;}
		.wrapper{width: 1500px; padding: 20px; margin: 0 auto;}
	</style>
</head>
<body>
	<div class="wrapper">
		<div class="row">
			<div class="col-4">
				<h2>Tekweb Home Music</h2>
				<nav class="nav flex-column">
  					<a class="nav-link" aria-current="page" href="homepage.php"><i class="fa-light fa-house"></i><div class="nav-text">Home</div></a>
  					<a class="nav-link" href="search.php"><i class="fa-regular fa-magnifying-glass"></i><div class="nav-text">Search</div></a>
  					<a class="nav-link active" href="library.php"><i class="fa-light fa-books"></i><div class="nav-text">Library</div></a>
				</nav>
			</div>
			<div class="col-8">
				<div id="account">...</div>
				<div id="playlist">
					<?php
						$playlist_id=$_GET['id'];
				 			$res=mysqli_query($con,"select * from playlists where id=$playlist_id");
							if(!empty($res)){		
								while($row=mysqli_fetch_array($res)){
									$playlist_id=$row[0];
									$playlist_nama=$row[1];
									$pict=$row[2];
									$desc=$row[3];
								}
							}
					?>
					<h3><?php echo $playlist_nama; ?></h3> <!--Ini emang error karena belum ada datanya, ygy-->
					<div class="row">
						<div class="col-4">
							<img src="..."> <!--Tampilin gambar playlist-->
							<div class="d-grid gap-2">
							  <button class="btn btn-success" type="button">Play</button>
							</div>
						</div>
						<div class="col-8">
							<?php
				 				$res=mysqli_query($con,"select * from playlists_audios pa, audios a where pa.audio_id = a.id and pa.playlist_id=$playlist_id");
				 				$count = 1;
								if(!empty($res)){	
									echo '<div class="row">';
									while($row=mysqli_fetch_array($res)){
										echo '<div class="col-9">
													'.$count.'.'.$row["a.nama"].'
												</div>
												<div class="col-3">
													<button type="button" class="btn btn-success">Add</button>
											        <button type="button" class="btn btn-secondary">Down</button>
												</div>';
										$count+=1;
									}
									echo '</div>';

									if($count == 1){
										echo '<p><h3>Tambahkan lagu terlebih dahulu</h3></p>';
									}
								}
								mysqli_close($con);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>