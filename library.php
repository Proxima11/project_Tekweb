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
					<h3>Daftar putar</h3>
					<?php
						$sql="Select * from playlists"; //tabel playlist
		 				$res=mysqli_query($con,$sql);
		 				$count = 0;
						if(!empty($res)){	
							echo '<div class="row row-cols-1 row-cols-md-5 g-4">';
							while($row=mysqli_fetch_array($res)){
								echo '<div class="col">
										    <div class="card h-100">
										    	<a href="playlist.php?id='.$row["id"].'"">
											      <img src="..." class="card-img-top" alt="...">
											      <div class="card-body">
											        <h5 class="card-title">'.$row["name"].'</h5>
											        <p class="card-text">'.$row["description"].'</p>
											        <br>
											        <button type="button" class="btn btn-success">Play</button>
											        <button type="button" class="btn btn-dark">Set</button>
											      </div>
											     </a>
										    </div>
										  </div>';
								$count+=1;
							}
							echo '</div>';

							if($count == 0){
								echo '<p><h3>Tambahkan playlist terlebih dahulu</h3></p>';
							}
						}
						mysqli_close($con);
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>