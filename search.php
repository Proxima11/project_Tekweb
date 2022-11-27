<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="bootstrap-5.2.0/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="home.css">
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
  					<a class="nav-link" href="home.php"><i class="fa-light fa-house"></i><div class="nav-text">Home</div></a>
  					<a class="nav-link active" aria-current="page" href="search.php"><i class="fa-regular fa-magnifying-glass"></i><div class="nav-text">Search</div></a>
  					<a class="nav-link" href="library.php"><i class="fa-light fa-books"></i><div class="nav-text">Library</div></a>
				</nav>
			</div>
			<div class="col-8">
				<div id="account">...</div>
				<nav class="navbar navbar-dark bg-dark">
					<div class="container-fluid">
					  <form class="d-flex" role="search">
					    <input class="form-control me-2" type="search" placeholder="Cari judul/album/penyanyi kesukaanmu" aria-label="Search">
					    <button class="btn btn-light" type="submit">Cari</button>
					  </form>
					</div>
				</nav>
				<br>
				<h3>Browse</h3>
			</div>
		</div>
	</div>
</body>
</html>