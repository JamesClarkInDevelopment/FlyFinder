<?php 

	session_start();
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
		
	include('secure/conn.php');
	
	//page deletes the upload
	$userid = $_SESSION['40083514_FlyID'];
	
	if(isset($_GET['uploadID'])){
	$getID = $_GET['uploadID'];
	
	$read="SELECT * FROM FLY_UserUploads WHERE UploadID ='$getID'";

	$result= $conn -> query($read);
	} else {
		header('location: profile.php');
	}
	
	//Kicks out anyone from trying to delete posts from editing the web address uploadID
	$row = $result->fetch_assoc();
	$ID = $row['UploadID'];
	$correctID = $row['UserID'];
	if($correctID!=$userid){
		header('Location: profile.php');
	}
	
	
	if(!$result){
	echo$conn->error;
	}
	
	$delete = "DELETE FROM FLY_UserUploads WHERE UploadID = '$getID'";

	$userID = $_SESSION['40083514_FlyID'];

	
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Delete Upload</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/styles.css">
		
	</head>
	
	<body class ='backgroundgeese' >
	
		<?php
			include('nav.php');
		?>
		
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-12 text-center">
					<div class="row" id="filler">
					</div>
					<?php
							$result= $conn -> query($delete);
							
							if(!$result){
							echo $conn->error;}
							else{
								echo"<h3 class='display-3 text-light font-italic text-center'> Upload Deleted </h3> 
								<p>Add a new Spotting! </p>
								<a class='btn btn-light'  href='upload.php' role='button'>Add Spotting</a>
								<a class='btn btn-light'  href='profile.php' role='button'>Profile</a>
								<p class= 'text-center' >Be sure to follow us on Instagram @FlyFinder</p>

								";
							}
					?>

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