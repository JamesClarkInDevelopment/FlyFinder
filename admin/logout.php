<?php

	session_start();

	session_destroy();

?>

<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Admin Logout</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="../styles/styles.css">
		
	</head>
	
	<body class="backgroundadmin">
	
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-lg text-center" >
					<h2 class="display-3 text-dark text-center">Logged Out!</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-lg text-center" >
					<p class="display-5 text-dark">Check back soon!</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg text-center" >
					<a href="index.php" class="btn btn-outline-dark btn-lg" tabindex="-1" role="button" aria-disabled="true">Admin Home</a>	
				</div>
			</div>
			<div class="row" id="filler">	
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>