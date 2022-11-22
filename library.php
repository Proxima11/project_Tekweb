<?php
require "connect.php"
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
  					<a class="nav-link" aria-current="page" href="home.php"><i class="fa-light fa-house"></i>Home</a>
  					<a class="nav-link" href="search.php"><i class="fa-regular fa-magnifying-glass"></i>Search</a>
  					<a class="nav-link active" href="library.php"><i class="fa-light fa-books"></i>Library</a>
				</nav>
			</div>
			<div class="col-8">
				<div id="account">...</div>
				<div id="playlist">
					<h3>Daftar putar</h3>
					<?php
						$sql="Select * from ..."; //tabel playlist
		 				$res=mysqli_query($con,$sql);
						if(!empty($res))
						{		
							while($row=mysqli_fetch_array($res)){
								echo "<div class="row row-cols-1 row-cols-md-5 g-4">
										  <div class="col">
										    <div class="card h-100">
										      <img src="..." class="card-img-top" alt="...">
										      <div class="card-body">
										        <h5 class="card-title">...</h5>
										        <p class="card-text">...</p>
										      </div>
										    </div>
										  </div>
										</div>";
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