<?php
session_start();
require 'conn.inc.php';
if(isset($_POST['add_c']))
		    {
		    $party=mysqli_real_escape_string($conn,$_POST['party']);
		    $candidate=mysqli_real_escape_string($conn,$_POST['candidate']);
		    $query="insert into candidates(id,party,name,votes) values('0','$party','$candidate','0')";
		    
		    if(!empty($party) AND !empty($candidate))
		    {
		        $query=mysqli_query($conn,$query);
		   
		    if($query)
		    {
		         header("refresh:0,url=admin.php?id=chngc");
		        echo "<script>alert('successuly added.')</script>";
		       
		        
		    }
		    }
		    else
		    {
		         header("refresh:0,url=admin.php?id=chngc");
		        echo "<script>alert('enter all the fields.')</script>";
		        
		    }
		     
		    }
		   else if(isset($_POST['fstart']))
{
   $query="update controls set status='1' where id='1'";
   $query=mysqli_query($conn,$query);
   if($query)
   {
       header("refresh:0,url=admin.php?id=controls");
       echo "<script>alert('successuly changed.')</script>";
       
   }
}
else if(isset($_POST['fstop']))
{
    $query="update controls set status='0' where id='1'";
   $query=mysqli_query($conn,$query);
   if($query)
   {
       header("refresh:0,url=admin.php?id=controls");
       echo "<script>alert('successuly changed.')</script>";
       
   }
}
else if(isset($_POST['verify']))
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
        header("refresh:0,url=admin.php?id=requests");
       echo "<script>alert('successuly added to the database.')</script>";
       
    }
    
}
else if(isset($_POST['remove']))
{
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $query="DELETE FROM public WHERE email='$email'";
    $query=mysqli_query($conn,$query);
    if($query){
        header("refresh:0,url=admin.php?id=requests");
       echo "<script>alert('successuly removed from the database.')</script>";
    }
}

?>