<?php
require "connection.php";

if (isset($_POST['showsong'])){
	$sql="select * from audios order by tanggal_rilis DESC";
	$result=mysqli_query($con,$sql);
	$counter=0;
	while($row=mysqli_fetch_array($result)){
		$counter += 1;
		$didengar = $row['didengar'];
		$pendengar = " ";
		if ($didengar/1000 >= 1){
			$didengar = $didengar/1000;
			if($didengar/1000 >= 1){
				$didengar = $didengar/1000;
				if($didengar/1000 >= 1){
					$didengar = $didengar/1000;
					$pendengar = $didengar." B";
				}
				else{
					$pendengar = $didengar." M";
				}
			}
			else{
				$pendengar = $didengar." K";
			}
		}
		else{
			$pendengar = $didengar;
		}
		if($counter <= 6){
		echo "
		<div class='col-sm-8 col-md-4 col-lg-2'>
			<div class='card mb-3 ml-5 mu-5'>
				<img class='card-img' src='".$row['gambar']."'>
				<div class='details'>
					<button type='button' class='btn btn-secondary btn-lg mb-2' id='play' songID='".$row['ID']."'><i class='fa-solid fa-play'></i></button>
					<div class='row'>
					<divstyle='max-height: 0px; color:white;'>
						<i class='fa-solid fa-headphones' style='color: white;' id='heard'></i>
					</div>
					<div style='max-height: 0px; color:white;'>
						".$pendengar."
					</div>
					</div>
				</div>
			</div>
		</div>";
		}
		else{
			break;
		}
	}
	exit();
}

if (isset($_POST['popularsong'])){
	$sql="select * from audios order by didengar DESC";
	$result=mysqli_query($con,$sql);
	$counter=0;
	while($row=mysqli_fetch_array($result)){
		$counter += 1;
		$didengar = $row['didengar'];
		$pendengar = " ";
		if ($didengar/1000 >= 1){
			$didengar = $didengar/1000;
			if($didengar/1000 >= 1){
				$didengar = $didengar/1000;
				if($didengar/1000 >= 1){
					$didengar = $didengar/1000;
					$pendengar = $didengar." B";
				}
				else{
					$pendengar = $didengar." M";
				}
			}
			else{
				$pendengar = $didengar." K";
			}
		}
		else{
			$pendengar = $didengar;
		}
		if($counter <= 6){
		echo "
		<div class='col-sm-8 col-md-4 col-lg-2'>
			<div class='card mb-3 ml-5 mu-5'>
				<img class='card-img' src='".$row['gambar']."'>
				<div class='details'>
					<button type='button' class='btn btn-secondary btn-lg mb-2' id='play' songID='".$row['ID']."'><i class='fa-solid fa-play'></i></button>
					<div class='row'>
					<divstyle='max-height: 0px; color:white;'>
						<i class='fa-solid fa-headphones' style='color: white;' id='heard'></i>
					</div>
					<div style='max-height: 0px; color:white;'>
						".$pendengar."
					</div>
					</div>
				</div>
			</div>
		</div>";
		}
		else{
			break;
		}
	}
	exit();
}

if(isset($_POST['songicon']))
{
	$id=$_POST['songid'];
	$sql="select * from audios where ID like '%$id%'";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result))
	{
		echo "<img id='playimage' src='".$row['gambar']."'>";
	}
	exit();
}
if(isset($_POST['songinfo']))
{
	$id=$_POST['songid'];
	$sql="select * from audios where ID like '%$id%'";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result))
	{
		echo "
		<h4 id='playtitle'>".$row['nama']."</h4>
		<h7 id='playsinger'>".$row['penyanyi']."</h7>";
	}
	exit();
}

if(isset($_POST['playsong']))
{
	$id=$_POST['songid'];
	$sql="select * from audios where ID like '%$id%'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
		echo "<button class='btn btn-empty border-0'>
						<i class='fa-solid fa-backward-step' style='color:white'></i>
					</button>
					<button class='btn btn-empty border-0' id='playbarplaybutton'>
						<i class='fa-solid fa-play' style='color:white'></i>
					</button>
					<button class='btn btn-empty border-0'>
						<i class='fa-solid fa-forward-step' style='color:white'></i>
					</button>";
		echo '<audio id="playingsong" autoplay="true" style="display:none;">
         <source src="'.$row[2].'" type="audio/wav">
      </audio>';
	exit();
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap-5.2.0/css/bootstrap.css">
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<script src="jquery-3.6.1.js" type="text/javascript"></script>
	<script src="https://kit.fontawesome.com/8111334eea.js" crossorigin="anonymous"></script>
	<style type="text/css">
		body{
			font-family: 'Roboto', sans-serif;
			height: 600px;
		}
		* {
    scrollbar-width: auto;
    scrollbar-color: #712985 #000000;
  }

  /* Chrome, Edge, and Safari */
  *::-webkit-scrollbar {
    width: 10px;
  }

  *::-webkit-scrollbar-track {
    background: #000000;
  }

  *::-webkit-scrollbar-thumb {
    background-image: linear-gradient(#000000 0%, #5D1E94 50%, #000000 100%);
    border-radius: 10px;
    border: 0px solid #ffffff;
  }
		*{
			margin: 0;
			padding: 0;
			list-style: none;
			text-decoration: none;
		}
		.sidebar{
			background-image: linear-gradient(#404040 0%, #202020 80%);
			position: fixed;
			left: 0;
			width:200px;
			height: 100%;
			transition: all .5s ease;
		}
		.sidebar header{
			font-size: 20px;
			color: white;
			text-align: center;
			line-height: 65px;
			user-select: none;
			margin-bottom: 50px;
			padding-right: 30px;
		}

		.sidebar ul.menu a{
			display: block;
			height: 100%;
			width: 100%;
			line-height: 50px;
			font-size: 18px;
			color: white;
			box-sizing: border-box;
			transition: .5s;
			text-decoration: none;
			padding-left: 0px;
		}
		ul.menu li:hover a{
			padding-left: 10px;
			text-decoration: none;
			border-right: 2px solid white;
		}

		.sidebar ul a i{
			margin-right: 15px;
		}

		ul.menu li a.active{
			color: #B266FF;
			border-right: 2px solid #B266FF;
		}
		section{
			background-color: #202020;
			height: 200vh;
			transition: all .5s ease;
			margin-left: 200px;
		}
		.card {
			height: 10rem;
			width: 10rem;
			overflow: hidden;
			position: relative;
			cursor: pointer;
			border: none;
		}

		.view .card img {
			height: 100%;
			width: 100%;
		}

		.view .card:hover .details {
			opacity: 1;
			height: 100%;
		}

		.view .details {
			position: absolute;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			bottom: 0;
			width: 100%;
			height: 0%;
			background: rgba(0, 0, 0, 0.7);
			opacity: 0;
			transition: 0.5s ease;
		}

		.top_bar{
			height: 70px;
			background-color: rgba(0, 0, 0, 0.2);
			position: relative;
		}
		section .top_bar .d-flex #search{
			margin-left:0 auto; 
			margin-right:0 auto;
			margin-top: 15px;
			margin-bottom: 15px;
			border-radius: 50%;
			color: #B266FF;
			background-color: transparent;
			border-color: #B266FF;
			transition: .4s;
		}
		section .top_bar .d-flex #search:hover{
			border-radius: 50%;
			color: #FFFFFF;
			background-color: #B266FF;
			transition: .4s;
		}
		section .top_bar .d-flex input{
			margin-top: 15px;
			margin-bottom: 15px;
			width: 70%;
			border-radius: 30px;
			color: white;
			border-color: #B266FF;
			background-color: transparent;
			transition: .4s;
		}
		section .top_bar .d-flex input::placeholder{
			color: #C0C0C0;
		}
		section .top_bar .d-flex input:focus{
			border-radius: 30px;
			color: black;
			border-color: #FFFFFF;
			background-color: #FFFFFF;
			transition: .4s;
		}
		.wrapper section .top_bar .dropdown #user_menu{
			background-color: transparent;
			border-color: transparent;
			transition: .5s;
		}
		.wrapper section .top_bar .dropdown #user_menu:hover{
			background-color: transparent;
			border: 1px solid #B266FF;
		}
		.wrapper section .top_bar #profile img:hover{
			scale: 1.1;
		}
		.wrapper section .top_bar .dropdown ul li button:hover{
			transition: .5s;
		}
		.wrapper section .top_bar .dropdown ul li button:hover{
			background-color: #B266FF;
			font-color: black;
		}

		.playbar{
			position: fixed;
			right: 0;
			left:0;
			bottom: 0;
			height: 100px;
			background-color: black;
			color: white;
		}
		.lol{
			height: 5000px;
		}
		#playbarcenter{
			text-align: center;
		}
		#playbarleft{

		}
		#playbarright{
			
		}
		#coverimage{
			margin-left: 30px;
			margin-top: 15px;
			height: 70px;
			width: 70px;
		}
		#playimage{
			margin-right: 30px;
			height: 70px;
			width: 70px;
		}
		#songinfo{
			margin-left: 10px;
			margin-top: 20px;
		}

		/*#check{
			display: none;
		}
		label #btn, label #cancel{
			position: absolute;
			cursor: pointer;
			background: rgba(0, 0, 0, 0.2);
			border-radius: 3px;
		}
		label #btn{
			left: 40px;
			top: 25px;
			font-size: 35px;
			color: white;
			padding: 6px 12px;
			}
		label #cancel{
			z-index: 1111;
			left: 165px;
			top: 17px;
			font-size: 20px;
			color: white;
			padding: 4px 9px;
		}
		#check:checked ~ .sidebar{
			left: 0;
		}
		#check:checked ~ label #btn{
			left: 200px;
			opacity: 0;
			pointer-events: none;
		}
		#check:checked ~ label #btn{
			left: -165px;
			opacity: 0;
			pointer-events: none;
		}*/
	</style>
</head>
<body>
	<div class="wrapper">
		<div class="sidebar">
			<ul class="menu">
				<header>Music Player</header>
				<div class="mb-3"style="border-top: 1px solid white; margin-right: 30px;"></div>
				<li><a href="homepagefix.php" class="active"><i class="fa-solid fa-house"></i>Home</a></li>
				<li><a href="#"><i class="fa-solid fa-book"></i>Library</a></li>
				<li><a href="#"><i class="fa-solid fa-heart"></i>Favourite</a></li>
				<div class="mt-3 mb-3" style="border-top: 1px solid white; margin-right: 30px;"></div>
				<li><a href="#"><i class="fa-solid fa-square-plus"></i>New Playlist</a></li>
			</ul>
		</div>
		<section class="view">
			<!-- bar atas -->
			<div class="top_bar">
				<!-- <div style="width:200px; height: 50px; float: left; margin-top: 20px; margin-bottom: 10px; margin-left: 20px; color: white; font-size: 20px;">
					Listen, Feel, Happy
				</div> -->
				<div id="profile" style="width:50px; height: 50px; float: right; margin-top: 10px; margin-bottom: 10px; margin-right: 20px;">
					<img src="picture/imgSementara.jpg" width="100%" style="border-radius: 50%;">
				</div>
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="user_menu" data-bs-toggle="dropdown" aria-expanded="false"  style="float: right; margin-top: 15px; margin-bottom: 15px; margin-right:20px;">
						<i class="fa-solid fa-gear"></i>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu2" style="background-color: rgba(0, 0, 0, 1);">
						<li><button class="dropdown-item" type="button" style="color:white;">Edit Profile</button></li>
						<li><button class="dropdown-item" type="button" style="color:white;">Logout</button></li>
					</ul>
				</div>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="#">Edit Profile</a>
					<a class="dropdown-item" href="#">Logout</a>
				</div>
				<div style=" float: left; margin-left: 15px;">
					<form class="d-flex" role="search">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline" type="submit" id="search"><i class="fa-solid fa-magnifying-glass"></i></button>
					</form>
				</div>
			</div>
			<h3 style="float:left; color: white; height: 0 auto; margin-left: 30px; position:relative;" class="mt-2">New Releases</h3>
			<div class="wrap mt-5" style="background-color: rgba(96, 96, 96, 0.7); height: 0 auto; margin-left: 30px; margin-right:30px; border-radius: 20px; margin-top: 70px; position: relative; padding-left: 20px; padding-right:20px; padding-top: 20px; padding-bottom: 10px;">
				<div class="row" id="newarrival">
				</div>
			</div>
			<h3 style="float:left; color: white; height: 0 auto; margin-left: 30px; position:relative;" class="mt-2">Most Played</h3>
			<div class="wrap mt-5" style="background-color: rgba(96, 96, 96, 0.7); height: 0 auto; margin-left: 30px; margin-right:30px; border-radius: 20px; margin-top: 70px; position: relative; padding-left: 20px; padding-right:20px; padding-top: 20px; padding-bottom: 10px;">
				<div class="row" id="popular">
				</div>
			</div>
		</section>
		<div class="playbar">
			<div class="row">
				<div class="col-md-4" id="playbarleft">
					<div class="row">
						<div class="col-md-4" id="coverimage"></div>
						<div class="col-md-6" id="songinfo"></div>
					</div>
				</div>
				<div class="col-md-4" style='margin-top: 10px' id ="playbarcenter">
				</div>
				<div class="col-md-4" id="playbarright">

				</div>
			</div>
		</div>
		<!--  -->
		<script>
		$(document).ready(function(){
			showsongs();
			popularsongs();
			function showsongs(){
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						showsong : 1
					},
					success : function(res){
						$("#newarrival").html(res);
					}	
				});
			};
			function playsong(){

			}
			function popularsongs(){
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						popularsong : 1
					},
					success : function(res){
						$("#popular").html(res);
					}	
				});
			}
			$("#newarrival").delegate('#play', 'click', function(){
				var v_songid=$(this).attr('songID');
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						songicon : 1,
						songid	: v_songid
					},
					success : function(res){
						$("#coverimage").html(res);
					}	
				});
			});
			$("#newarrival").delegate('#play', 'click', function(){
				var v_songid=$(this).attr('songID');
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						songinfo : 1,
						songid	: v_songid
					},
					success : function(res){
						$("#songinfo").html(res);
					}	
				});
			});

			$("#newarrival").delegate('#play', 'click', function(){
				var v_songid=$(this).attr('songID');
				$.ajax({
					url	  : "homepagefix.php",
					type  : "POST",
					async : true,
					data  : {
						playsong : 1,
						songid	: v_songid
					},
					success : function(res){
						$("#playbarcenter").html(res);
					}
				});
			});

			$("#playbarcenter").delegate('#playbarplaybutton', 'click', function(){
				var music=document.getElementById('playingsong');
				if (music.paused){
					music.play();
				}
				else{
					music.pause();
				}
			});
		});
			
		</script>
	</div>
</body>
</html>