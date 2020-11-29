<?php
session_start();
if(!isset($_SESSION['vivek']))
{
    header("refresh:3,url=login_admin.php");
    echo "<center>Please login first.Wait while redirecting you on login page</center>";
    
}
else
{?>
<?php
$email='';
require 'conn.inc.php';
if(isset($_POST['verify']))
{
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $query="update public set status='1' where email='$email'";
    $query=mysqli_query($conn,$query);
    $emailtrimmed=substr($email,0,6);
    $code='1234567890';
    $code=str_shuffle($code);
    $code=substr($code,0,4);
    $voterid=$emailtrimmed.$code;
    $sub="Respond from Online Voting System";
    $text="your username is ".$voterid." use it to login now.";
    $header="Respond from Online Voting System";
    $query2="update public set voterid='$voterid' where email='$email'";
    $query2=mysqli_query($conn,$query2);
    if($query && $query2)
    {
        mail($email,$sub,$text,$header);
       echo "<script>alert('successuly changed.')</script>";
       
    }
    
}
?>
<html>
<head>
	<title>CUSAT | Online Voting System | Admin</title>
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
				stroke-dashoffset:0;stroke: orange;}
		.percent svg circle:nth-child(2){stroke-dashoffset:calc(440 - (440 * <?php
     require 'conn.inc.php';
     $query2="SELECT AVG(voted) AS voted FROM public";
     $query2=mysqli_query($conn,$query2);
     $row2=mysqli_fetch_assoc($query2);echo $row2['voted'] *100;?>)/100);stroke: #4f3ab7}
     .no{font-size:20px;text-align:left}
   .fa-check{position:relative;font-size:100px;bottom:130px;left:20px;color:white}.ftop{position;relative;top:-130px;}
    </style>
</head>
<body onload="postloader()">
	<div id="preloader">
		<center><p style="color: #fcfafc;margin-top:27%;font-size: 21px;font-family: georgia;font-weight: 200">Online Voting System<br>CUSAT</p></center>

		</div>
<nav class="navbar" id="navbar">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href='' id="brand"><h4>   Admin</h4></a>
      <div class="btn-group pull-right">
     <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
       Profile <span class="caret"></span></button>	
 	  <ul class="dropdown-menu" role="menu">
 		<li style="border-bottom: 1px solid #a1a1a1;text-align: center"><a href="?id=profile"><?php echo $_SESSION['vivek']; ?></a></li>
 		<li style="border-bottom: 1px solid #a1a1a1;text-align: center"><a href="?id=requests">Requests</a></li>
 		<li style="border-bottom: 1px solid #a1a1a1;text-align: center"><a href="?id=controls">Controls</a></li>
 		<li style="border-bottom: 1px solid #a1a1a1;text-align: center"><a href="?id=chngc">Add candidates</a></li>
 		<li style="border-bottom: 1px solid #a1a1a1;text-align: center"><a href="login_admin.php?id=logout">Logout</a></li>
 	</ul>
 </div>
    </div>
    
  </div>
</nav>
<?php
if($_GET['id']=='requests'){?>
	  
		<div class="jumbotron " style="background:white;height:100%">
		           
        
		<br>
		<p style="color:red"><i class="fas fa-bell" aria-hidden="true"></i> Requests:<hr></p>
         <div class="table-responsive">
             <table class="table table-bordered">
         	<tr style="color:red;">
         		<td>id</td>
         		<td>Firstname</td>
         		<td>Lastname</td>
         		<td>Age</td>
         		<td>Mobile no</td>
         		<td>Email id</td>
         		<td>Status</td>
         	</tr>
         	<?php
         	require 'conn.inc.php';
			 $query="select * from public where status=0";
			 $results=mysqli_query($conn,$query);
			 while($row=mysqli_fetch_assoc($results))
			 {
			     echo "<tr>";
			     echo "<td>".$row['id']."</td>";
			     echo "<td>".$row['firstname']."</td>";
			     echo "<td>".$row['lastname']."</td>";
			     echo "<td>".$row['age']."</td>";
			     echo "<td>".$row['mobileno']."</td>";
			     echo "<td>".$row['email']."</td>";
			     echo "<td>".$row['status']."</td>";
			     echo "</tr>";
			 }
            ?>
         </table>
         </div>
           <div class="row">
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
               <div class="panel panel-primary" id="panel">
                <div class="panel-heading">Add/Remove Users</div>
                <div class="panel-body">
             <br>
                   <form  action="add.php" method="post">
            <input type="email" class="form-control" placeholder="Email-id*" name="email" required><br>
            <input type="submit"class="btn btn-primary form-control " value="Verify users" name="verify">
            <div class="devider">OR</div>
            <input type="submit"class="btn form-control" style="background:red;color:white" value="Remove users" name="remove"><br>
            </form> 
               </div>
               </div>
               </div>
           </div>
		</div>
		<?php 
		} 
		else if($_GET['id']=='controls')
		{
		?>
		<div class="jumbotron" style="background:white;padding:5% 1%" >
		    <div class="container">
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
     </table>
     </div>
     <br>
     <?php
     require 'conn.inc.php';
     $query2="SELECT AVG(voted) AS voted FROM public";
     $query2=mysqli_query($conn,$query2);
     $row2=mysqli_fetch_assoc($query2);

     
     if($query2)
     {?>
                <div class="circle">
 	               <div class="percent">
 		             <svg>
 		              	<circle cx="60" cy="60" r="60"></circle>
 		             	<circle cx="60" cy="60" r="60"></circle>
 		             	<div class="no text-primary">
 		             	    <i class="fa fa-check" aria-hidden="true"></i><br>
 		             	    <p class="ftop">
 	               	    <?php echo "Total voted: " .$row2['voted'] *100 ."<span> %</span>";?>
 	               	    </p>
 	               	    </div>
 	               	</svg>
     	     </div>
        </div>
            
     <?php 
     }
     ?>
		    <h4 style="color:red">Voting Controls Forcefully:</h4><hr>
		    <form action="add.php" method="post">
		        <input type="submit" class='btn btn-primary' name='fstop' value="stop voting">
		        <br><br>
		        <input type="submit" class='btn btn-warning' name='fstart' value="start voting">
		        
		    </form>
		</div>
		</div>
		<?php
		}
		else if($_GET['id']=='chngc')
		{?>
		<div class="jumbotron" style="background:white">

		   <p style="color:red">Add candiadtes</p> <hr>
		   <form action='add.php' method="post" class="form-inline">
		       <div class="form-group">
		       <input type="text" class="form-control" placeholder="party name*" name="party" required>
		       </div>
		       <div class="form-group">
		       <input type="text" class="form-control" placeholder="candidate name*" name="candidate" required>
		       </div>
		       <div class="form-group">
		           <input class="form-control btn btn-primary" value="add candidate" type="submit" name="add_c">
		       </div>
		       </form><br>
		   <table class="table table-bordered">
         <tr>
             <th>Serial no</th>
             <th>Party</th>
             <th>Candidate Name</th>
         </tr>
		   <?php
		   $query_c="select * from candidates";
		   $query_c=mysqli_query($conn,$query_c);
		   while($result=mysqli_fetch_assoc($query_c))
		   {
		      echo "<tr>";
              echo "<td>".$result['id']."</td>";
             echo "<td>".$result['party']."</td>";
             echo "<td>".$result['name']."</td>"; 
             echo "</tr>";
		   }
		   ?>
		   </table>
		</div>
		<?php
		} 
		else if($_GET['id']=='profile' or $_GET['id']=='' )
		{
		?>
		<div class="jumbotron" style="background:white;height:80%">
		   <center><h4>Welcome <?php echo $_SESSION['vivek'];?></h4></center>
		   <ul><p style="color:red">Notifications:</p><hr>
		   <?php
		   require 'conn.inc.php';
			 $query="select * from public where status=0";
			 $results=mysqli_query($conn,$query);
			 while($row=mysqli_fetch_assoc($results))
			 {
			     echo "<li class='text-muted'>You have notifications from  <a href='?id=requests'>".$row['firstname']." ".$row['lastname']."</a>. Please check details  by clicking the link and verify the account.</li><br>";
			 }
		   ?>
		   </ul>
		</div>
		<?php } ?>
		<br>
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
</html>
<?php
}
?>