<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="bootstrap-5.2.0/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="registercss.css">
	<title></title>
	<style>
		body{font: 14px sans-serif;}
		.wrapper{width: 360px; padding: 20px; margin: 0 auto;}
	</style>
</head>
<body>
	<div class="wrapper">
		<div class="login-box">
			<h2>Register</h2>
			<form>
				<div class="user-box">
					<input type="text" name="" required="">
					<label>Username</label>
				</div>
				<div class="user-box">
					<input type="password" name="" required="">
					<label>Password</label>
				</div>
				<div class="user-box" id="email">
					<input type="text" name="" required="">
					<label>Email</label>
				</div>
				<div class="button-form">
					<a id="submit" href="#">Register Now</a>
					<div id="logins">
						Already have an account ?
						<a href="login.php"> Login</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>