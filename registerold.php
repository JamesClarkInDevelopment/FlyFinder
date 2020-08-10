<?php

	include('secure/conn.php');
	
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Register</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/styles.css">
		
		<style>
			form{
				color:white;
			}
		
		</style>
		
	</head>
	
	<body class="backgroundregister">
	
		
		<?php
			include('nav.php');
		?>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-8 text-center">
					<h2 class="display-3 text-light font-italic">Register</h2>
					<h5 class="display-5 text-light font-italic">Enter your details below</h5>
				</div>
				<div class="col-4 text-center">
					<h2 class="display-4 text-light font-italic">Member Details</h2>
					<h5 class="display-5 text-light font-italic">What type of Member are you?</h5>
				</div>
			</div>
			<form action='registered.php' method='POST' enctype='multipart/form-data'>
				<div class="row ">
					<div class="col-8 text-center">
						<label for="exampleInputPassword1">Username</label>
						<input  class="form-control" id="exampleInputPassword1" placeholder="Enter a Username" name="username" required>
					
						<label for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Create Password" name="password" required>
					
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email " name="email" required>
						
						<div class="row justify-content-md-center ">
							<label> Member Type</label>
						</div>
						<div class="row justify-content-md-center ">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="membertype" id="inlineRadio1" value="1" required>
								<label class="form-check-label" for="inlineRadio1">Family Member</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="membertype" id="inlineRadio1" value="2" required>
								<label class="form-check-label" for="inlineRadio1">Enthusiast Member</label>
							</div>
						</div>
						<label for="exampleFormControlFile1">Upload Profile Picture</label>
						<input type="file" class="form-control-file " id="exampleFormControlFile1" name="profilepic" required>
						<div class="row" id="filler">
						</div>
						<div class="row  text-center ">
							<div class="col-lg  text-center">
								<input type="submit" class="btn btn-light" value ="Register"></input>
							</div>
						</div>
						<div class="row" id="filler">
						</div>
						<div class="row  text-center ">
							<div class="col-lg text-center">
								<p>Already Registered?</p>
								<a class="btn btn-light" type="submit" href="index.php" role="button">Login Here</a>
							</div>
						</div>
				</div>
				<div class="col-4 text-center border-left">
					<p> Choose to be a family, or enthusiast member! Check out the difference below! </p>
					<h2 class="display-5 text-light font-italic ">Family</h2>
					<h5 class="display-6 text-light font-italic">Upload Names, Images, Locations, Descriptions and Vote!</h5>
					<h2 class="display-5 text-light font-italic ">Enthusiast</h2>
					<h5 class="display-6 text-light font-italic">Upload the same as the Family Member PLUS, the Time of Year, Time of Day and Weather! </h5>
					<div class="row" id="filler">
						
					</div>
					<div class="row ">
						<div class="col text-center " >
							<img src="images/enthusiast.jpg"id="Registerimages">
							<h5 class="display-5 text-light font-italic">Enthusiast</h5>
						</div>
						<div class="col text-center " >
							<img src="images/family.png"id="Registerimages">
							<h5 class="display-5 text-light font-italic">Family</h5>
						</div>
					</div>
				</div>	
			</div>
			</form>
			<div class="row  text-center " id='filler'>
			</div>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>