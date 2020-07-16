<?php 
include_once 'classes/User.php';
 ?>
<?php
$user=new User(); 
if(isset($_POST['signup'])){

	$username=$_POST['username'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	$country=$_POST['country'];
	$gender=$_POST['gender'];
	$rand=rand(1,2);
	if($username==""){
		echo "<script>alert('Username Must Not Be Empty!!!')</script>";
	}
	if(strlen($password)<4){
		echo "<script>alert('Password Must Be 4 characters!!!')</script>";
		exit();
	}

	$emailchk=$user->emailcheck($email);
	if($emailchk){
		echo "<script>alert('Email Already Exists...Try With Another Email!!!')</script>";
		echo "<script>window.open('signup.php','_self')</script>";
		exit();
	}

	if($rand==1){
		$profile_pic="img/avater1.jpg";
	}
	elseif ($rand==2) {
		$profile_pic="img/avater2.jpg";
	}



	$insert=$user->insertuser($username, $email, $password, $profile_pic, $country, $gender);

	if($insert){
		echo "<script>alert('Congratulation $username, Your Account Has Been Successfully Created!!!')</script>";
		echo "<script>window.open('signin.php','_self')</script>";
	}
	else{
		echo "<script>alert('Registration failed!!!Try Again....')</script>";
		echo "<script>window.open('signup.php','_self')</script>";
	}
	
}
 ?>








<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>ChatWith | Sign Up</title>
<link rel="stylesheet" href="style/bootstrap.min.css">
<link rel="stylesheet" href="style/signup.css">
</head>
<body>
<div class="signup-form">
    <form action="" method="post">
		<h2>Sign Up</h2>
		<!-- <p>It's free and only takes a minute.</p> -->
		<hr>
        <div class="form-group">
			<label>Username</label>
        	<input type="text" class="form-control" name="username" >
        </div>
        <div class="form-group">
			<label>Email Address</label>
        	<input type="email" class="form-control" name="email" >
        </div>
		<div class="form-group">
			<label>Password</label>
            <input type="password" class="form-control" name="password" >
        </div>
		<div class="form-group">
	      <label>Country</label>
	      <select class="form-control" name="country">
	        <option selected value="0">Choose...</option>
	        <option value="1">Bangladesh</option>
	        <option value="2">India</option>
	        <option value="3">Pakistan</option>
	        <option value="4">Nepal</option>
	        <option value="5">Bhutan</option>
	      </select>
    	</div>
        <div class="form-group">
	      <label>Gender</label>
	      <select class="form-control" name="gender">
	        <option selected value="0">Choose...</option>
	        <option value="1">Male</option>
	        <option value="2">Female</option>
	        <option value="3">Others</option>
	      </select>
    	</div>
		<div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg" name="signup">Sign Up</button>
        </div>
		<!-- <p class="small text-center">By clicking the Sign Up button, you agree to our <br><a href="#">Terms &amp; Conditions</a>, and <a href="#">Privacy Policy</a></p> -->
    </form>
	<div class="text-center">Already have an account? <a href="signin.php">Sign In here</a></div>
</div>
</body>
</html>