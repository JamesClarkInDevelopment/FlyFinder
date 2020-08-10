<?php

session_start();
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
		
	include('secure/conn.php');
	
	$username= $_SESSION['40083514_FlyUser'];
	$userid = $_SESSION['40083514_FlyID'];
	$uploadpic = $_SESSION['40083514_FlyUploadPic'];
	$membertype = $_SESSION['40083514_FlyMemType'];
	
	
	$ran = rand(0,1000);

	$species = $conn->real_escape_string($_POST['species']);
	$location = $conn->real_escape_string($_POST['location']);
	$desc = $conn->real_escape_string($_POST['description']);
	$approved = 2;
	
	if(isset($_GET['uploadID'])){
	$uploadID = $_GET['uploadID'];
	}
	
	$filename = $_FILES['uploadimg']['name'];
	$filename = $ran.$filename;
	
	$filetmp = $_FILES['uploadimg']['tmp_name'];
	move_uploaded_file($filetmp,"customerimages/".$filename);
	
	if($membertype==1){
		
		$date= date("y-m-d");
		$time=0;
		$weather = 1;
		
		$update = "UPDATE FLY_UserUploads SET LocationID = '$location', SpeciesID = '$species', Description = '$desc', ImagePath = '$filename', TimeOfDay = '$time', TimeOfYear = '$date', WeatherID = '$weather', ApprovalID = '$approved' WHERE UploadID = '$uploadID'";
		
	} else{
		
		$date = $conn->real_escape_string($_POST['date']);
		$date2 = str_replace('/', '-', $date );
		$newDate = date("Y-m-d", strtotime($date2));

		$time = $conn->real_escape_string($_POST['time']);
		$weather = $conn->real_escape_string($_POST['weather']);
	
		$update = "UPDATE FLY_UserUploads SET  LocationID = '$location', SpeciesID = '$species', Description = '$desc', ImagePath = '$filename', TimeOfDay = '$time', TimeOfYear = '$newDate', WeatherID = '$weather', ApprovalID = '$approved' WHERE UploadID = '$uploadID'";
	}
	
	
	if(!$update){
		echo$conn->error;
	}
	
	
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
							
							if(!$result){
							echo $conn->error;}
							else{
								echo"<h3 class='display-3 text-light text-center font-italic'> Upload Updated </h3> ";
								
								
							}
					?>
					<p class= 'text-center' >Be sure to follow us on Instagram @FlyFinder</p>
					<a class="btn btn-light"  href="profile.php" role="button">Your Profile</a>
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