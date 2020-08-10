<?php

	session_start();
	
		
	include('secure/conn.php');
	
	//a user will be signed up with the details they have given
	$user = $conn->real_escape_string($_POST['username']);
	$pass = $conn->real_escape_string($_POST['password']);
	//hash the password
	$hashed_password= password_hash($pass,PASSWORD_DEFAULT);
	$email = $conn->real_escape_string($_POST['email']);
	$membertype = $conn->real_escape_string($_POST['membertype']);
	$memberlevel = 1;
	$likes = 0;
	
	$filename = $_FILES['profilepic']['name'];
	
	$filetmp = $_FILES['profilepic']['tmp_name'];
	
	move_uploaded_file($filetmp,"customerimages/".$filename);
	
	$insert = "INSERT INTO FLY_User (MemberTypeID,MemberLevelID,Username,Password,Email,ProfilePicture,Likes) VALUES ('$membertype','$memberlevel','$user','$hashed_password','$email','$filename','$likes')";
	

	
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Registered</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/styles.css">
		
		<style>
		
			p{
				color:white;
			}
		
		</style>
		
	</head>
	
	<body class="backgroundregistered">
	
		
		<nav class="navbar navbar-expand-lg navbar-light " >
			<a class="navbar-brand text-light" href="index.php">FlyFinder</a>
				<button class="navbar-toggler bg-light" type="button-light" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon "></span>
				</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link text-light" href="profile.php">Profile </a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-light" href="search.php">Search</a>
					</li>		  
				</ul>
			</div>
		</nav>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-8 text-center">
					<div class="row" id="filler">
					</div>
					<?php
							$resultinsert= $conn -> query($insert);
							
							if(!$resultinsert){
							echo $conn->error;}
							else{
								echo"<h3 class='display-4 text-light text-center '> Welcome $user</h3> ";
							}
					?>
				
				<h3 class='display-5 text-light text-center '> Thanks for Joining FlyFinder! </h3>
					<p class= 'text-center' >Login to get Started!!</p>
					<a class="btn btn-light"  href="search.php" role="button">Search Birds</a>
					<a class="btn btn-light"  href="index.php" role="button">Login</a>
					<p class= 'text-center' >Be sure to follow us on Instagram @FlyFinder</p>
					<div class= "row" id ="filler">
					
					</div>
				</div>
				<div class="col-4">
					<?php echo " <img src='customerimages/$filename' id='registered'>"; ?>
				</div>
			</div>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>