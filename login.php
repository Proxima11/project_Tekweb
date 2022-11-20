<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="bootstrap-5.2.0/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="logincss.css">
	<title></title>
	<style>
		body{font: 14px sans-serif;}
		.wrapper{width: 360px; padding: 20px; margin: 0 auto;}
	</style>
</head>
<body>
	<div class="wrapper">
		<div class="login-box">
			<h2>Login</h2>
			<form>
				<div class="user-box">
					<input type="text" name="" required="">
					<label>Username</label>
				</div>
				<div class="user-box">
					<input type="password" name="" required="">
					<label>Password</label>
				</div>
				<div id="forget_pass">
					<a href="forgetpassword.php"> Forget Password?</a>
				</div>
				<div class="button-form">
					<a id="submit" href="#">Submit</a>
					<div id="register">
						Don't have an account ?
						<a href="register.php"> Register</a>
					</div>
				</div>
			</form>
		</div>
		<!-- <form action="loginprocess.php" method="post">
			<h2>Login</h2>
			<p class="hint-text">Enter Login Details</p>
			<div class="mb-3">
				<label class="form-label">Username</label>
				<input type="text" class="form-control" name="username">
				<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
			</div>
			<div class="mb-3">
				<label class="exampleInputPassword1" class="form-label">Password</label>
				<input type="password" class="form-control" name="password">
			</div>
			<div class="form-group">
				<button type="submit" name="save" class="btn btn-success btn-lg btn-block">Login</button>
			</div>
			<p>Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form> -->
	</div>
</body>
</html>