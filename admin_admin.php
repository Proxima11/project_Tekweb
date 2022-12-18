<?php
session_start();
require "connection.php";
if (!isset ($_SESSION["id"])){
	header("location: login-admin.php");
}

if (isset($_POST['showdata'])){
	$sql="select * from admin";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result)){
		echo '
		<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['email'].'</td>
			<td>'.$row['code'].'</td>
			<td>'.$row['status'].'</td>
            <td>
                <button type="button" ide="'.$row['ID'].'" class="btn btn-success" name="edit">Edit</button>
                <button type="button" idd="'.$row['ID'].'" class="btn btn-danger" name="delete">Delete</button>
            </td>
		</tr>';
	}
	exit();
}
if (isset($_POST['insert'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $code = $_POST['code'];
    $status = $_POST['status'];
	$sql="insert into admin values(NULL, '$name', '$email', '12345678', $code, '$status')";
	$result=mysqli_query($con,$sql);
	exit();
}
if (isset($_POST['edit'])){
	$id=$_POST['id'];
	$sql="select * from admin where ID=$id";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	echo json_encode($row);
	exit();
}
if(isset($_POST['update'])){
	$id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $code = $_POST['code'];
    $status = $_POST['status'];
    $sql="update admin set name='$name', email='$email', code='$code', status='$status' where ID=$id";
	$result=mysqli_query($con,$sql);
}
if(isset($_POST['delete'])){
	$id=$_POST['id'];
	$sql="delete from admin where ID=$id";
	$result=mysqli_query($con,$sql);
	exit();
}
if(isset($_POST['search'])){
    $search_query = $_POST['search_query'];
    $sql="select * from admin where username like '%$search_query%'";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result)){
		echo '
		<tr>
			<td>'.$row['name'].'</td>
			<td>'.$row['email'].'</td>
			<td>'.$row['code'].'</td>
			<td>'.$row['status'].'</td>
            <td>
                <button type="button" ide="'.$row['ID'].'" class="btn btn-success" name="edit">Edit</button>
                <button type="button" idd="'.$row['ID'].'" class="btn btn-danger" name="delete">Delete</button>
            </td>
		</tr>';
	}
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
			min-height: 100vh;
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
				<li><a href="admin_lagu.php"><i class="fa-solid fa-music"></i>Lagu</a></li>
				<li><a href="admin_penyanyi.php"><i class="fa-solid fa-microphone-lines"></i>Penyanyi</a></li>
				<li><a href="admin_category.php"><i class="fa-solid fa-puzzle-piece"></i>Category</a></li>
				<li><a href="admin_admin.php" class="active"><i class="fa-solid fa-key"></i>Admin</a></li>
				<div class="mt-3 mb-3" style="border-top: 1px solid white; margin-right: 30px;"></div>
				<!-- <li><a href="#"><i class="fa-solid fa-square-plus"></i>New Playlist</a></li> -->
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
						<li><a href="admin_change_password.php"><button class="dropdown-item" type="button" style="color:white;">Change Password</button></a></li>
						<li><a href="logout-admin.php"><button class="dropdown-item" type="button" style="color:white;">Logout</button></a></li>
					</ul>
				</div>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="#">Edit Profile</a>
					<a class="dropdown-item" href="#">Logout</a>
				</div>
				<div style=" float: left; margin-left: 15px;">
					<form class="d-flex" role="search">
						<input class="form-control me-2" type="search" id="search_query" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline" type="submit" id="search"><i class="fa-solid fa-magnifying-glass"></i></button>
					</form>
				</div>
			</div>
			<h3 style="float:left; color: white; height: 0 auto; margin-left: 30px; position:relative;" class="mt-2">Data Admin</h3>
			<div class="wrap mt-5" style="background-color: rgba(96, 96, 96, 0.7); height: 0 auto; margin-left: 30px; margin-right:30px; border-radius: 20px; margin-top: 70px; position: relative; padding-left: 20px; padding-right:20px; padding-top: 20px; padding-bottom: 10px;">
				<div class="mb-3">
					<label class="form-label" style="color:white;">ID: <span id="id"></span></label>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:white;">Name</label>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:white;">Email</label>
                    <input type="text" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:white;">Code</label>
                    <input type="text" class="form-control" id="code">
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:white;">Status</label>
                    <textarea class="form-control" id="status" rows="1"></textarea>
                </div>
                <div class="form-group">
                    <button type="button" id="insert" class="btn btn-primary">Insert</button>
                    <button type="button" id="update" class="btn btn-success">Update</button>
                </div>
			</div>

			<table class="table" style="color: white;">
			  <thead>
			    <tr>
			      <th scope="col">Name</th>
			      <th scope="col">Email</th>
			      <th scope="col">Code</th>
			      <th scope="col">Status</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody id="showtable">
			  </tbody>
			</table>

			<h3 style="float:left; color: white; height: 0 auto; position: relative; margin-left: 0 auto; margin-right: 0 auto;">Hasil Search Query</h3>
			<table class="table" style="color: white;">
			  <thead>
			    <tr>
			      <th scope="col">Name</th>
			      <th scope="col">Email</th>
			      <th scope="col">Code</th>
			      <th scope="col">Status</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody id="searchtable">
			  </tbody>
			</table>
		</section>
		</div>
		<!--  -->
		<script>
		$(document).ready(function(){
			showdata();

			$('#insert').click(function(){
				var name_in = $('#name').val();
				var email_in = $('#email').val();
				var code_in = $('#code').val();
				var status_in = $('#status').val();

				$.ajax({
					url : "admin_admin.php",
					type : "POST",
					async : true,
					data : {
						insert : 1,
						name : name_in,
						email : email_in,
						code : code_in,
						status : status_in
					},
					success : function(result){
						alert("Success Insert");
						showdata();
					}
				});
			});

			$('#showtable').delegate('[name="edit"]', 'click', function(){
				id_in = $(this).attr('ide');
				$.ajax({
					url : "admin_admin.php",
					type : "POST",
					data : {
						edit : 1,
						id : id_in
					},
					success : function(result){
						myObj=$.parseJSON(result);
						$('#id').text(myObj.ID);
						$('#name').val(myObj.name);
						$('#email').val(myObj.email);
						$('#code').val(myObj.code);
						$('#status').val(myObj.status);
					}
				});
			});

            $('#update').click(function(){
            	var id_in = $('#id').text();
                var name_in = $('#name').val();
				var email_in = $('#email').val();
				var code_in = $('#code').val();
				var status_in = $('#status').val();

                $.ajax({
					url : "admin_admin.php",
					type : "POST",
					data : {
						update : 1,
                        id : id_in,
                        name : name_in,
						email : email_in,
						code : code_in,
						status : status_in
					},
					success : function(result){
						alert("Success Update");
						$('#id').text('');
						showdata();
					}
				});
            });

            $('#showtable').delegate('[name="delete"]', 'click', function(){
				id_in = $(this).attr('idd');
				conf = window.confirm("Are You Sure ?");
				if (conf){
					$.ajax({
						url : "admin_admin.php",
						type : "POST",
						async : true,
						data : {
							delete : 1,
							id : id_in
						},
						success : function(result){
							alert("Success Delete");
							showdata();
						}
					});
				}
			});

            $('#search').click(function(){
                search_query_in = $('#search_query').val();

                if (search_query_in == ""){
                    showdata();
                }
                else{
                    $.ajax({
                        url		: "admin_admin.php",
                        type 	: "POST",
                        async	: true,
                        data    : {
                            search : 1,
                            search_query :search_query_in
                        },
                        success	: function(result)
                        { 
                            alert("Searching...");
                            $('#searchtable').html(result);
                        }
                    });
                }
            });
		});

        function showdata(){
			$.ajax({
				url	  : "admin_admin.php",
				type  : "POST",
				async : true,
				data  : {
					showdata : 1
				},
				success : function(res){
					$("#showtable").html(res);
				}	
			});
		};
			
		</script>
	</div>
</body>
</html>