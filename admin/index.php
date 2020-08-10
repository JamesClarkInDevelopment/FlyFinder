<?php

	session_start();

	include('../secure/conn.php'); 

	
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Admin Login</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/colors-css/2.2.0/colors.min.css">
		<link rel="stylesheet" href="../styles/styles.css">
		
		<style>
			
			
		</style>
		
	</head>
	
	<body class="backgroundadmin" >
	
			<div class="container-fluid" >
				<div class="row  text-center " id='filler'>
				</div>
				<div class="row">
					<div class="col-lg text-center" >
						<h2 class="display-3 text-dark font-italic">FlyFinder Admin</h2>
					</div>
				</div>
				
				<form class="text-center" action='signinadmin.php' method='POST' enctype='multipart/form-data'>
					<div class="row justify-content-md-center">
						<div class="col-3 text-center">
						</div>
						<div class="col-6 text-center">
						
							<label class=" font-weight-bold" for="exampleInputEmail1">Username</label>
							<input  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username " name="postuser">

							<label class=" font-weight-bold" for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" name="postpass">
							<div class="row  text-center " id='filler'>
							</div>
						<button type="submit" class="btn btn-dark">Login</button>
				</form>
							<div class="row  text-center " id='filler'>
							</div>
						</div>
						<div class="col-3 text-center">
						</div>
					</div>
				<div id="filler">	
				</div>
			</div>
		
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>