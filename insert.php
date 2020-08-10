<?php
session_start();
	
	include('secure/conn.php');
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
	
	//kicks users to the home page if they tamper with the url
	if (empty($_POST)){
		header('Location: index.php');
	}
	
	
	$username= $_SESSION['40083514_FlyUser'];
	$userid = $_SESSION['40083514_FlyID'];
	$uploadpic = $_SESSION['40083514_FlyUploadPic'];
	$membertype = $_SESSION['40083514_FlyMemType'];
	
	//puts a random number infront of images to avoid duplicate names being uploaded
	$ran = rand(0,1000);

	$species = $conn->real_escape_string($_POST['species']);
	$location = $conn->real_escape_string($_POST['location']);
	$desc = $conn->real_escape_string($_POST['description']);
	
	//sets the approval of the uplaod in the database to no
	$approved = 2;
	
	$filename = $_FILES['uploadimg']['name'];
	$filename = $ran.$filename;
	
	$filetmp = $_FILES['uploadimg']['tmp_name'];
	move_uploaded_file($filetmp,"customerimages/".$filename);
	
	if($membertype==1){
		
		//For family members their extra fields are set automatically
		$date= date("y-m-d");
		$time= date("h:i:sa");;
		$weather = 1;
		
		$insert = "INSERT INTO FLY_UserUploads (UserID,LocationID,SpeciesID,Description,ImagePath,TimeOfDay,TimeOfYear,WeatherID, ApprovalID) VALUES ('$userid','$location','$species','$desc','$filename','$time','$date','$weather','$approved')";
		
	} else{
		
		//enthusiast members have their time and date taken from the form
		$date = $conn->real_escape_string($_POST['date']);
		$date2 = str_replace('/', '-', $date );
		$newDate = date("Y-m-d", strtotime($date2));

		$time = $conn->real_escape_string($_POST['time']);
		$weather = $conn->real_escape_string($_POST['weather']);
		
		$insert = "INSERT INTO FLY_UserUploads (UserID,LocationID,SpeciesID,Description,ImagePath,TimeOfDay,TimeOfYear,WeatherID,ApprovalID) VALUES ('$userid','$location','$species','$desc','$filename','$time','$newDate','$weather','$approved')";
		
	}
	
	
	if(!$insert){
		echo$conn->error;
	}
	

?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Uploaded</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/styles.css">
		
	</head>
	
	<body class="backgroundregister">
	
		<?php
			include('nav.php');
			
		?>
		
		<div class="container-fluid">
			<div class="row text-center">
				<div class="col-12 text-center" >
					<?php
					
					//upload is put into the database and awaits approval from admin
						$resultinsert= $conn -> query($insert);
						
						if(!$resultinsert){
						echo $conn->error;
					}	else {
						echo"<h2 class='display-3 text-light font-italic'>$species Awaiting Approval</h2>";
						echo"<div id='userupload'><img src='customerimages/$filename' id='userupload'></div>";
					}
					
					?>
					<div class="row text-center">
						<div class="col-12 text-center" >
							<a href="upload.php" class="btn btn-outline-light btn-lg text-center" tabindex="-1" role="button" aria-disabled="true">Upload Another Spotting</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="filler">
			</div>
			<div class="row">
				<div class="col-12">
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