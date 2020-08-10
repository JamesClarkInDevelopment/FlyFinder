<?php

	session_start();

	include('secure/conn.php'); 

	$read="SELECT * FROM FLY_UserUploads INNER JOIN FLY_Species ON FLY_UserUploads.SpeciesID = FLY_Species.SpeciesID WHERE ApprovalID = 1 ORDER BY  TimeOfYear LIMIT 4;";
	
	$result= $conn -> query($read);
	
	if(!$result){
	echo$conn->error;
	}

?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Home</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/colors-css/2.2.0/colors.min.css">
		<link rel="stylesheet" href="styles/styles.css">
		
		<style type="text/css">
			
			
		</style>
		
	</head>
	
	<body class="backgroundhome" >
	
		
		<?php
			include('nav.php');
		?>
		
		<div class="container-fluid" id="content">
			
			<div class="row">
				<div class="col-lg text-center" >
					<h2 class="display-3 text-light font-italic">FlyFinder</h2>
				</div>
			</div>
				
				<?php 
				
				if(!isset($_SESSION['40083514_FlyUser'])){
						
					
				echo" <form class='text-center' action='signin.php' method='POST' enctype='multipart/form-data'>
					
					<div class='row justify-content-md-center'>
						<div class='col-3 text-center'>
						</div>
						<div class='col-6 text-center'>
						
							<label class='text-light font-weight-bold' for='exampleInputEmail1'>Enter Username</label>
							<input  class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter Username' name='postuser'>
						
						
							<label class='text-light font-weight-bold' for='exampleInputPassword1'>Enter Password</label>
							<input type='password' class='form-control' id='exampleInputPassword1' placeholder='Enter Password' name='postpass'>
							<div class='row  text-center ' id='filler'>
							</div>
								
							<button type='submit' class='btn btn-light'>Login</button>
							
							
				</form>

							<div class='row  text-center ' id='filler'>
							</div>
							<div class='row justify-content-md-center'>
								<p class = 'text-light font-weight-normal'>Haven't Registered?</p>
							</div>
							<div class='row justify-content-md-center'>
								<a class='btn btn-light' type='submit' href='register.php' role='button'>Register Here</a>	
							</div>
							<div class='row justify-content-md-center'>
								<div class='col-lg text-center'>
									<p>Make sure to like uploads you thought were helpful! The more likes your uploads recieve, the higher your member level will increase! Meaning your search results will be closer to the top of the search!!</p>
								</div>
							</div>
							<div class='row justify-content-md-center' id='filler'>
							</div>
						</div>
						<div class='col-3 text-center'>
						</div>
					</div>";
				}	else {
					echo 	"<div class='row justify-content-md-center' id='padding10'>
								<a class='btn btn-light' id='padding10'href='search.php' role='button'>Search</a>
								<a class='btn btn-light' id='padding10'href='upload.php' role='button'>Upload</a> 
								<a class='btn btn-light' id='padding10'href='logout.php' role='button'>Logout</a>
							</div>
							<div class='row justify-content-md-center'>
								<div class='col-6 text-center'>
									<p>Make sure to like uploads you thought were helpful! The more likes your uploads recieve, the higher your member level will increase! Meaning your search results will be closer to the top of the search!!</p>
								</div>
							</div>";
					}
				
				
				?>
				
				<div id="filler">
				</div>
				
				<?php 
				
				if(!isset($_SESSION['40083514_FlyUser'])){
				
				echo "<div class='row'>
					<div class='col-lg text-center' >
						<h3 class='display-5 text-light font-weight-normal'>Login or Register to get Started</h3>	
					</div>
				</div>";
				}
				?>
				
				<div id="filler">
				</div>
				<div class="row">
					<div class="col-lg text-center" >
						<h3 class="display-4 text-light font-weight-normal">Recent Birds spotted around Strangford Lough</h3>
					</div>
				</div>			
				<div id="filler">
				</div>
			
				<div class='row'>
						<?php
								//shows the 4 most recent uploads
									while($row =$result->fetch_assoc()){
											
										$name = $row['Name'];
										$img = $row['ImagePath'];
										$ID = $row['UploadID'];
							
										$count=0;
									
									if($count<=4){
											
										echo 
												"<div class='col-3 text-center border' >
												<h4 class='text-light' > $name</h4>
												<img class='img-fluid w-100 ' src='customerimages/$img' id='tableUserUploads'>
																				
												<a href='moreinfosearch.php?uploadID=$ID' class='btn btn-outline-light btn' role='button' aria-disabled='true'>MORE INFO</a>
												<div id='filler'>
						
												</div>
												</div>
											
											";
									}	
								
									}
							?>
			
				</div>
				<div id="filler">
					
				</div>
				<div class="row text-center">
					<p>If you're having any issues with uploads please Contact Us through FlyFinderHelp@hotmail.com</p>
				</div>
		</div>
	
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>