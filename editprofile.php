<?php
session_start();
	
	include('secure/conn.php');
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
	
	$read="SELECT * FROM FLY_MemberType";

	$result= $conn -> query($read);

	if(!$result){
	echo$conn->error;
	}
	
	$UserID = $_SESSION['40083514_FlyID'];
	
	$read2 = "SELECT * FROM FLY_User WHERE UserID ='$UserID'";
	$result2= $conn -> query($read2);
	
	if(!$result2){
	echo$conn->error;
	}

?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Profile Edit</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/styles.css">
		
		<style>
			form{
				color:white;
			}
		
		</style>
		
	</head>
	
	<body class="backgroundeditdetails">
	
		<?php
			include('nav.php');
		?>
		
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-12">
					<h3 class='display-3 text-light text-center font-italic'>Edit Profile Details</h3> 
					<form action='editedprofile.php' method='POST' enctype='multipart/form-data'>
						<div class="row justify-content-md-center ">
							<div class="col-8 text-center">
					<?php
						//builds the form to edit the profile with original placeholders
						$populate =$result2->fetch_assoc();
						
						$user = $populate['Username'];
						$email = $populate['Email'];
		
						echo"<label for='exampleInputPassword1'>Username</label>
							<input required='true' class='form-control' id='exampleInputPassword1' placeholder='$user' name='username'>
						
						
							<label for='exampleInputPassword1'>Password</label>
							<input required='true' type='password' class='form-control' id='exampleInputPassword1' placeholder='New Password' name='password'>
						
							<label for='exampleInputEmail1'>Email address</label>
							<input required='true' type='email' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='$email' name='email'>
						
							
							
							<div class='row justify-content-md-center '>
								<label> Member Type</label>
							</div>
							<div class='row justify-content-md-center '>
								<div class='form-check form-check-inline'>
									<input class='form-check-input' input required='true' type='radio' name='membertype' id='inlineRadio1' value='1'>
									<label class='form-check-label' for='inlineRadio1'>Family Member</label>
								</div>
									
								<div class='form-check form-check-inline'>
									<input class='form-check-input' input required='true' type='radio' name='membertype' id='inlineRadio1'value='2'>
									<label class='form-check-label' for='inlineRadio1'>Enthusiast Member</label>
								</div>
							</div>		

							<label for='exampleFormControlFile1'>Profile Picture</label>
							<input type='file' input required='true' class='form-control-file ' id='exampleFormControlFile1' name='profilepic'>
							<p>Finished?</p>
							<input type='submit' class='btn btn-light' value='UPDATE PROFILE'></input>";
						?>						
						</div>
					</div>	
					<div class="row" id="filler">
					</div>
					</form>
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