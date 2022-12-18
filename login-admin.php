<!DOCTYPE html>
<?php
session_start();
require 'connection.php';
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql=mysqli_query($con, "SELECT * FROM admin WHERE email='$email' and password='$password'");
    $row=mysqli_fetch_array($sql);

    if(is_array($row)){
        $_SESSION["id"] = $row['ID'];
        $_SESSION["email"] = $row['email'];
        $_SESSION["password"] = $row['password'];
        header("Location: admin_lagu.php");
    }
    else{
        echo("<script LANGUAGE='JavaScript'>
            window.alert('Invalid Username/Password');
            window.location.href='login-admin.php';
            </script>");
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="login-usercss.css">
    <style>
        .float {
            -webkit-animation-name: Floating;
            -webkit-animation-duration: 6s;
            -webkit-animation-iteration-count: infinite;
            -webkit-animation-timing-function: ease-in-out;
        }

        @-webkit-keyframes Floating{
            from {-webkit-transform:translate(0, 0px);}
            65% {-webkit-transform:translate(0, 50px);}
            to {-webkit-transform: translate(0, -0px);    }    
        }

        .spin1 {
            -webkit-animation-name: Spinning;
            -webkit-animation-duration: 12s;
            -webkit-animation-iteration-count: infinite;
            -webkit-animation-timing-function: ease-in-out;
        }

        .spin2 {
            -webkit-animation-name: Spinning;
            -webkit-animation-duration: 25s;
            -webkit-animation-iteration-count: infinite;
            -webkit-animation-timing-function: ease-in-out;
        }

        .spin3 {
            -webkit-animation-name: Spinning;
            -webkit-animation-duration: 16s;
            -webkit-animation-iteration-count: infinite;
            -webkit-animation-timing-function: ease-in-out;
        }

        .spin4 {
            -webkit-animation-name: Spinning;
            -webkit-animation-duration: 19s;
            -webkit-animation-iteration-count: infinite;
            -webkit-animation-timing-function: ease-in-out;
        }

        @-webkit-keyframes Spinning{
            0% {
            -webkit-transform: rotate(0deg);
        }
            100% {
                -webkit-transform: rotate(360deg);
            } 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="float col-md-4 offset-md-4" style="min-width: 0px; max-height: 0px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="spin1" style="fill: white; width: 30px; height: 30px; position: relative; left: 425px;"><path d="M499.1 6.3c8.1 6 12.9 15.6 12.9 25.7v72V368c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V147L192 223.8V432c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V200 128c0-14.1 9.3-26.6 22.8-30.7l320-96c9.7-2.9 20.2-1.1 28.3 5z"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="spin2" style="fill: white; width: 60px; height: 60px; position: relative; right: 150px;"><path d="M499.1 6.3c8.1 6 12.9 15.6 12.9 25.7v72V368c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V147L192 223.8V432c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V200 128c0-14.1 9.3-26.6 22.8-30.7l320-96c9.7-2.9 20.2-1.1 28.3 5z"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="spin3" style="fill: white; width: 60px; height: 60px; position: relative; left: 275px; bottom: -325px;"><path d="M499.1 6.3c8.1 6 12.9 15.6 12.9 25.7v72V368c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V147L192 223.8V432c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V200 128c0-14.1 9.3-26.6 22.8-30.7l320-96c9.7-2.9 20.2-1.1 28.3 5z"/></svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="spin4" style="fill: white; width: 30px; height: 30px; position: relative; right: 325px; bottom: -300px;"><path d="M499.1 6.3c8.1 6 12.9 15.6 12.9 25.7v72V368c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V147L192 223.8V432c0 44.2-43 80-96 80s-96-35.8-96-80s43-80 96-80c11.2 0 22 1.6 32 4.6V200 128c0-14.1 9.3-26.6 22.8-30.7l320-96c9.7-2.9 20.2-1.1 28.3 5z"/></svg>
        </div>
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="login-admin.php" method="POST" autocomplete="">
                    <h2 class="text-center">Petra Music Player</h2>
                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Login with your username and password.</p>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login" id="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>