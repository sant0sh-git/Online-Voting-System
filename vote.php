<?php
session_start();
require 'conn.inc.php';
if (!isset($_SESSION['username'])) 
{
	header("refresh:2;url=login.php");
	echo "<center>To Vote, You Will Have To Login First. Wait While We Redirect You To Login page.</center>";
}
else
{
	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="index.css">
    <style>
        .percent svg circle{fill:#1589ff;stroke-width:20;stroke: #000;
			transform: translate(10px,10px);stroke-dasharray: 440;stroke-dashoffset:440;}.percent svg circle:nth-child(1){
				stroke-dashoffset:0;stroke: #a5a5a5;}
		.percent svg circle:nth-child(2){stroke-dashoffset:calc(440 - (440 * <?php
     require 'conn.inc.php';
     $query2="SELECT AVG(voted) AS voted FROM public";
     $query2=mysqli_query($conn,$query2);
     $row2=mysqli_fetch_assoc($query2);echo $row2['voted'] *100;?>)/100);stroke: #4f3ab7}
     .no{font-size:30px;text-align:left}
    </style>
</head>
<body>
	<nav class="navbar" id="navbar">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://vrjs.000webhostapp.com/" id="brand">Online Voting System</a>
      <div class="btn-group pull-right">
     <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
       Profile <span class="caret"></span></button>	
 	  <ul class="dropdown-menu" role="menu">
 		<li style="border-bottom: 1px solid #a1a1a1;text-align: center"><a href="?page_id=profile"><?php echo $_SESSION['name']; ?></a></li>
 		<li style="border-bottom: 1px solid #a1a1a1;text-align: center"><a href="?page_id=vote">Vote</a></li>
 		<li style="border-bottom: 1px solid #a1a1a1;text-align: center"><a href="?page_id=result">Result</a></li>
 		<li style="border-bottom: 1px solid #a1a1a1;text-align: center"><a href="login.php?id=logout">Logout</a></li>
 	</ul>
 </div>
    </div>
    
  </div>
</nav>
<?php
if($_GET['page_id']=='vote' or $_GET['page_id']==''){
    
?>
 <div class="jumbotron" style="background:#fff;" id="vote">
 <div class="container" >
     <?php
     $query="select * from controls";
     $query=mysqli_query($conn,$query);
     $resulc=mysqli_fetch_assoc($query);
     if($resulc['status']=='1')
     {
     ?>
     
     
      <form action="vote.php?page_id=vote" method="get">
     <table class="table table-bordered">
         <tr>
             <th>Serial no</th>
             <th>Party</th>
             <th>Candidate Name</th>
             <th>Vote</th>
         </tr>
        
             <?php
    require 'conn.inc.php';
     $query="select * from candidates";
     $query=mysqli_query($conn,$query);
     while($result=mysqli_fetch_assoc($query))
     {
      echo "<tr>";
      echo "<td>".$result['id']."</td>";
      echo "<td>".$result['party']."</td>";
      echo "<td>".$result['name']."</td>";
      echo "<td><input type='radio' name='id' value='{$result['id']}' required></td>";
      echo "</tr>";
     }
     if(isset($_GET['voting'])){
          $id=$_GET['id'];
      $query2="select * from candidates where id='$id'";
      $query2=mysqli_query($conn,$query2);
      $result2=mysqli_fetch_assoc($query2);
      $votes=$result2['votes'];
      $votes++;
         $username=$_SESSION['username'];
         $query5="select * from public where voterid='$username'";
         $query5=mysqli_query($conn,$query5);
         $result5=mysqli_fetch_assoc($query5);
         $flag=$result5['voted'];
      if($flag==0 && isset($_SESSION['username']) && $id)
      {
          $query4="update candidates set votes='$votes' where id='$id'";
         $query4=mysqli_query($conn,$query4);
         $query3="update public set voted='1' where voterid='$username'";
         $query3=mysqli_query($conn,$query3);
          if($query3 && $query4){
          echo "<center style='color:green'>your vote has been successfully stored to your candidate,go to home page and check the result</center>";
          }
          else
          {
              echo "wrong";
          }
      }
      else
      {
          echo "<center style='color:red'>you have already voted, you can't vote again</center>";
      }
     }
    
     ?>
     
        
     </table>
     <center>
     <input type="submit" name="voting" class="btn btn-primary">
     </center>
     </form>
     <?php
     }
     else
     {
        echo "<h4><center>voting will be started on ".$resulc['start_timing']."</center></h4>";  
     }
    ?> 
     
     
 </div>
</div>
<?php
}
else if($_GET['page_id']=='profile')
{?>
<?php
 if(isset($_POST['changepass']))
{
    $pass1=mysqli_real_escape_string($conn,$_POST['password1']);
    $pass2=mysqli_real_escape_string($conn,$_POST['password2']);
    if($pass1==$pass2)
    {
      $username=$_SESSION['username'];
        $pass1=md5($pass1);
        $query="update public set password='$pass1' where voterid='$username'";
        $query=mysqli_query($conn,$query);
        if($query)
        {
            echo "<script>alert('password successfully changed.')</script>";
            header("refresh:2;url=vote.php?id=profile");
        }
        else
        {
            echo "<script>alert('something went wrong.')</script>";
            header("refresh:2;url=vote.php?id=profile");
        }
    }
    else
    {
        echo "<script>alert('password didnot match.')</script>";
            header("refresh:2;url=vote.php?id=profile");
    }
}
?>
  <div class="jumbotron" style="background:white">
      <div class="container">
          <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
              <img src="4448.png" style="width:100%">
          </div>
      <div class="row"><div class="col-lg-5 col-md-7 col-sm-12 col-xs-12">
      <form action="" method="post">
	<center><h3 class="text-primary">Change password</h3></center><hr>
		Enter Password
		<input class="form-control" type="password" name="password1" required>

    <br>
		Confirm Password
		<input class="form-control" type="password" name="password2" required>

<br>
		<input class="form-control btn btn-primary" type="submit" name="changepass" value="change">
</form>
  </div></div>
  </div>
  </div>
<?php
    
}
else if($_GET['page_id']=='result')
{
?>
<div class="jumbotron" style="background:#fff;padding:5% 1%;">
    <div class="container ">
    <h4><center>Resluts-</center></h4>
    <div class="table-responsive">
    <table class="table table-bordered table-hover">
         <tr>
             <th>Serial no</th>
             <th>Party</th>
             <th>Candidate Name</th>
             <th>Vote</th>
         </tr>
             <?php
     require 'conn.inc.php';
     $query="select * from candidates";
     $query=mysqli_query($conn,$query);
     while($result=mysqli_fetch_assoc($query))
     {
      echo "<tr>";
      echo "<td>".$result['id']."</td>";
      echo "<td>".$result['party']."</td>";
      echo "<td>".$result['name']."</td>";
      echo "<td>".$result['votes']."</td>";
      echo "</tr>";
     }
     ?>
         </tr>
     </table></div>
     <br>
     <?php
     require 'conn.inc.php';
     $query2="SELECT AVG(voted) AS voted FROM public";
     $query2=mysqli_query($conn,$query2);
     $row2=mysqli_fetch_assoc($query2);

     
     if($query2)
     {?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="circle">
 	               <div class="percent">
 		             <svg>
 		              	<circle cx="60" cy="60" r="60"></circle>
 		             	<circle cx="60" cy="60" r="60"></circle>
 		             	<div class="no text-primary">
 	               	    <?php echo "Total voted: " .$row2['voted'] *100 ."<span> %</span>";?>
 	               	    </div>
 	               	</svg>
     	     </div>
        </div>
            </div>

        </div>
     <?php 
     }
     ?>
     </div>
</div><br>
<?php } ?>
<div class="row" style="background:#fff;padding:5% 1%;">
    <div class="container text-center">
      <h5 align="center">Made with <span class="fa fa-heart heart-beat" style="color:red"></span> by SoE,CUSAT</t11></h4>
        <h6 align="center">E-Vote <span class="fa fa-copyright"></span> 2020</h6>
    </div>
</div>
</body>
</html>
<?php
}
?>