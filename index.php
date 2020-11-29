<html>
	<head>
    <title>CUSAT | Online Voting System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
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
<div class="jumbotron" style="background:#fff;padding-top:10%">
    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 ">
            <h4>Secure Online Voting Platform</h4>
            <div class="text-muted text-justify" style="padding:10% 60% 0 0">
                Cast vote for your favourite candidate
                from anywhere in the world at the ease
                of your fingertips.
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <img src="4449.jpg" style="width:100%">
        </div>
    </div>
</div>
<div class="jumbotron" style="background:#fff;padding-top:10%">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">
            <h4>How to Vote?</h4><br>
            <ul class="text-muted">
                <li>Create an account by providing your basic details.</li><br>
                <li>After the details are verified by our administrator,you will receive your unique Login-ID on your registered E-mail ID.</li><br>
                <li>Use the Login-ID to login into the server.</li><br>
                <li>After successfully login,Vote for your favourite candidate.</li><br>
                <li>Please,logout before leaving the site.</li><br>
            </ul>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
            <img src="4448.png" style="width:100%">
        </div>
    </div>
</div><br>

<div class="row" style="background:#fff;padding:5% 1%;">
    <div class="container text-center">
      <h5 align="center">Made with <span class="fa fa-heart heart-beat" style="color:red"></span> by SoE,CUSAT</t11></h4>
        <h6 align="center">E-Vote <span class="fa fa-copyright"></span> 2020</h6>
    </div>
</div>		
			<script>
    var loader= document.getElementById('preloader');
    function  postloader(){
        loader.style.display='none';
    }
    </script>
    <script>
        $(window).scroll(function(){
    if ($(this).scrollTop() > 200) {
       $('#navbar').addClass('afternav');
    } else {
       $('#navbar').removeClass('afternav');
    }
});
    </script>
	</body>
</html>