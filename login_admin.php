<?php
session_start();
if(isset($_POST['login']))
{
    if($_POST['email']=='jaishvivek@zubako.com' && $_POST['password']=='jaishvivek@zubako.com')
    {
        	header("refresh:3,url=admin.php");
        	echo "<p style='color:green;text-align:center;padding:10px'>you are looged in please wait while we redirect you on dashboard</p>";
        	$_SESSION['vivek']="Jaishvivek";
        	
    }
    else
    {
        echo "<center>Wrong Credentials.</center>";
    }
}
 else if($_GET['id']=='logout')
{
echo "<script>alert('You are logged out now.')</script>";
  session_destroy();
}
?>
<html>
    <body>
        <center>
            <form action="" method="post" style="box-shadow:5px 5px 5px 5px #00000078;padding:5%;margin:5%">
            <p style="color:red">Admin Email*</p>
            <input type="email" name="email" required><br>
             <p style="color:red">Admin Password*</p>
            <input type="password" name="password" required><br><br>
            <input type="submit" name="login" value="Login">
            </form>
        </center>
    </body>
</html>