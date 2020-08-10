<?php

session_start();
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
		
	include('secure/conn.php');
	
	//Page edits the profile from the recived form information
	$userID = $_SESSION['40083514_FlyID'];
	$user = $conn->real_escape_string($_POST['username']);
	$pass = $conn->real_escape_string($_POST['password']);
	//hash the password
	$hashed_password= password_hash($pass,PASSWORD_DEFAULT);
	$email = $conn->real_escape_string($_POST['email']);
	$membertype = $conn->real_escape_string($_POST['membertype']);
	
	$filename = $_FILES['profilepic']['name'];
	
	$filetmp = $_FILES['profilepic']['tmp_name'];
	
	move_uploaded_file($filetmp,"customerimages/".$filename);
		
	$read = "SELECT * FROM Fly_User WHERE UserID ='$userID'";
	$result = $conn-> query($read);
	
	if(!$result){
		$conn->error;
	}
	
	//changes the password to null for the update in the md5 encryption to avoid an unavailable login
	$updatepass="UPDATE `FLY_User` SET `Password` = '' WHERE `FLY_User`.`UserID` = $userID; ";
	$resultupdate = $conn-> query($updatepass);


	$update = "UPDATE FLY_User SET MemberTypeID = '$membertype',Username = '$user',Password = '$hashed_password',Email = '$email', ProfilePicture = '$filename' WHERE UserID = '$userID'";
	
	
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Profile Edited</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/styles.css">
		
	</head>
	
	<body class="backgroundregistered">
	
		<?php
			include('nav.php');
		?>
		
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-12 text-center">
					<div class="row" id="filler">
					</div>
					<?php
							$result= $conn -> query($update);
							
							//profile is updated and users session is destroyed so they can login and reset their details through the sign in page
							if(!$result){
							echo $conn->error;}
							else{
								echo"<h3 class='display-3 text-light text-center font-italic'> Profile Updated </h3> 
								<p>Please login to view your new details! </p>
								
								";
								session_destroy();
								
							}
					?>
					<p class= 'text-center' >Be sure to follow us on Instagram @FlyFinder</p>
					<a class="btn btn-light"  href="index.php" role="button">Login</a>
					<div class= "row" id ="filler">
					</div>
				</div>
			</div>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>