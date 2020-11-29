<?php
session_start();
$firstname="";
$lastname="";
$age="";
$mobile="";
$emailid="";
$fault = array();
require 'conn.inc.php';
 if (isset($_POST['login'])) 
{
	$username=mysqli_real_escape_string($conn,$_POST['username']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);
	$password=md5($password);
	$query="select * from public where voterid='$username' AND password='$password' AND status='1'";
	$query=mysqli_query($conn,$query);
	$result=mysqli_fetch_assoc($query);
	if(mysqli_num_rows($query)>0)
	{
		$_SESSION['username']=$username;
		$_SESSION['name']=$result['firstname'];
		header("refresh:2,url=vote.php");
		
	}
	else
	{
		echo "<script>alert('wrong credentials')</script>";
		
	}

}

else if(isset($_POST['signup']))
{
 $firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
 $lastname=mysqli_real_escape_string($conn,$_POST['lastname']);
 $age=mysqli_real_escape_string($conn,$_POST['age']);
 $email=mysqli_real_escape_string($conn,$_POST['email']);
 $mobile=mysqli_real_escape_string($conn,$_POST['mobileno']);
 $status=0;
 $password1=mysqli_real_escape_string($conn,$_POST['password1']);
 $password2=mysqli_real_escape_string($conn,$_POST['password2']);
 if (empty($firstname)) 
 {
 	array_push($fault, "First Name is Required");
 }
 if (empty($lastname)) 
 {
 	array_push($fault, "Last Name is Required");
 }
 if (empty($age)) 
 {
 	array_push($fault, "Age is Required");
 }
 if (empty($email)) 
 {
 	array_push($fault, "Email is Required");
 }
 if (empty($password1)) 
 {
 	array_push($fault, "First Password is Required");
 }
 if (empty($password2)) 
 {
 	array_push($fault, "Confirm Password is Required");
 }
 if ($password1!=$password2) 
 {
 	array_push($fault, "Confirm Password doesn't match");
 }
 if (count($fault)==0) 
 {
 	$password=md5($password1);
 	$query="insert into public(firstname,lastname,age,mobileno,email,password,status,voterid,voted) values('$firstname','$lastname','$age','$mobile','$email','$password','0','0','0')";
 	$query=mysqli_query($conn,$query);
 	if ($query) {
 		
 		header("refresh:2,url=index.php");
 		echo "<center><h5 style='color:green;text-align:center'>Account Created Successfully. Wait 30min while we approve you<i class='fa fa-check' aria-hidden='true'></i></h5></center>";
 	}
 
 }
}
else if($_GET['id']=='logout')
{
    
    session_unset();
    echo "<script>alert('You are logged out now.')</script>";
    header("refresh:2;url=index.php");
}
?>
<?php
session_start();
if (isset($_SESSION['username'])) 
{
	header("refresh:2;url=vote.php");
 echo "<h5 style='color:green;text-align:center'>you are Logged in now.Wait while we redirect you on voting page......<i class='fa fa-check' aria-hidden='true'></i></h5>";
}
else
{
	?>	
<html>
<head>
	<title>CUSAT | Online Voting System | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="index.css">
</head>
<body onload="postloader()">
	     <div id="preloader">
		<center><p style="color: #fcfafc;margin-top:27%;font-size: 21px;font-family: georgia;font-weight: 200">Online Voting System<br>CUSAT</p></center>
		</div>
		<nav class="navbar" id="navbar">
  <div class="container">
    <div class="navbar-header">
        <button type="button" class=" navbar-toggle" data-toggle="collapse" data-target="#navbar-link" id="btn">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://vrjs.000webhostapp.com/" id="brand">Online Voting System</a>
    </div>
    <div class="collapse navbar-collapse navbar-right" id="navbar-link">
    <ul class="nav navbar-nav">
                <li><a href="index.php"> <i class="fa fa-home home"></i> Home</a></li>
				<li><a href="login.php"> <i class="fa fa-user"></i> User</a></li>
				<li><a href="vote.php"> <i class="fa fa-vote-yea vote"></i> Vote</a></li>
				<li><a href="about.php"> <i class="fa fa-align-left"></i> About</a></li>
				<li><a href="contact.php"> <i class="fa fa-envelope"></i> Contact</a></li>
    </ul>
    </div>
  </div>
</nav>

<div class="jumbotron" style="background:#1589ff;padding:7% 1%;">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 text-center"  style="background:#fff;padding:2% 1%;">
            <span class="glyphicon glyphicon-user" id="fa-user"></span><br>
           <div class="panel panel-primary" id="panel">
                <div class="panel-heading">Login/Signup Accounts</div>
                <div class="panel-body">
             <br>
             <?php
             if($_GET['id']=='' or $_GET['id']=='login'){?>
             <div id="login">
                   <form  action="" method="post">
            <input type="text" name="username" class="form-control" placeholder="Username*" required><br>
            <input type="password" name="password" class="form-control" placeholder="Password*"  required><br>
            <input type="submit" class="form-control btn-primary" name="login" value="Login">
            <div class="devider">OR</div>
            </form> 
            <a href="?id=signup" class="btn form-control" style="background:red;color:white" id="showsignup">Register Account</a>
            </div>
            <?php } else if($_GET['id']=='signup'){?>
            <div id="signup">
                <div class=" text-danger">
                    <?php
	            	
			          include('fault.php');
			         ?>
                </div>
                   <form  action="" method="post">
                       
                </form> 
            <a href="?id=login" class="btn form-control" style="background:red;color:white" id="showlogin">Already having Account</a>
            </div>
            <?php } ?>
               </div>
               </div>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
            
        </div>
    </div>
</div>
	   <div class="row" style="background:#fff;padding:5% 1%;">
    <div class="container text-center">
      <h5 align="center">Made with <span class="fa fa-heart heart-beat" style="color:red"></span> by SoE,CUSAT</t11></h4>
        <h6 align="center">E-Vote <span class="fa fa-copyright"></span> 2020</h6>
    </div>
</div> 
</body>
<script>
    var loader= document.getElementById('preloader');
    function  postloader(){
        loader.style.display='none';
    }
    
    </script>
    <script>
          
    </script>
</html>
<?php
}
?>