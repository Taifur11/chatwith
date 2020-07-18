<?php 
include_once 'classes/User.php';
include_once 'libs/Session.php';
Session::init();
 ?>
<?php

$user=new User();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])){
    
    $loginuser=$user->userlogin($_POST);
    if($loginuser){
        /*var_dump($loginuser);
        echo "<br>";
        echo "<pre>";
        $loginuser;
        echo "</pre>";*/
        if($user->updatestatus($loginuser['email'])){
            Session::set("login",true);
            Session::set("username",$loginuser['username']);
            Session::set("email",$loginuser['email']);
            $username=$loginuser['username'];
            echo "<script>alert('$username Successfully Signed In')</script>";
            echo "<script>window.open('home.php','_self')</script>";
        }
        
        //echo "Loged In";
    }
    else{
        echo "<script>alert('Sign In Failed....Try Again')</script>";
        echo "<script>window.open('signin.php','_self')</script>";
    }
}
?>














<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>ChatWith | Sign In</title>
<link rel="stylesheet" href="style/bootstrap.min.css">
<link rel="stylesheet" href="style/style.css">
</head>
<body>


<div class="login-form">
    <form action="" method="post">
        <h2 class="text-center">Sign in</h2>       
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" name="email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="signin">Sign In</button>
        </div>
        <div class="clearfix">
            <!-- <label class="float-left form-check-label"><input type="checkbox"> Remember me</label> -->
            <a href="#" class="float-right">Forgot Password?</a>
        </div>        
    </form>
    <p class="text-center"><a href="signup.php">Create an Account</a></p>
</div>








    <script src="inc/js/jquery-3.5.1.slim.min.js"></script>
    <script src="inc/js/popper.min.js"></script>
    <script src="inc/js/bootstrap.min.js"></script>
</body>
</html>