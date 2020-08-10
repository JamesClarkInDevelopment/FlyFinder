<?php 

	session_start();
	
	if(!isset($_SESSION['40083514_FlyUserAdmin'])){
		header('Location: index.php');
	}
		
	include('../secure/conn.php');
	
	//ADMIN SECTION
	//Page deletes the upload if it's inappropriate
	if(isset($_GET['uploadID'])){
	$getID = $_GET['uploadID'];
	
	$read="SELECT * FROM FLY_UserUploads WHERE UploadID ='$getID'";
	
	
	$result= $conn -> query($read);
	} else {
		header('location: profile.php');
	}
	$row =$result->fetch_assoc();							
	$userid = $row['UserID'];
	
	if(!$result){
	echo$conn->error;
	}
	
	$delete = "DELETE FROM FLY_UserUploads WHERE UploadID = '$getID'";

?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>Admin Decline Upload</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="../styles/styles.css">
		
		<style>
			p{
				color:black;
			}
		</style>
		
	</head>
	
	<body class ='backgroundadmin' >
	
		<?php 
				include('adminnav.php');
		?>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-2 text-center">
				</div>
				<div class="col-8 text-center">
					<div class="row" id="filler">
					</div>
					<?php
							$result= $conn -> query($delete);
							
							//produces a form with options of why the post was deleted
							if(!$result){
							echo $conn->error;}
							else{
								echo"<h3 class='display-3 text-dark font-italic text-center'> Upload Declined </h3> ";
							}
							
							echo"<form action='declined.php?userID=$userid' method='POST' enctype='multipart/form-data'>
							<div class='row justify-content-md-center '>
								<label> Reason for Decline</label>
							</div>
							<div class='row justify-content-md-center '>
								<div class='form-check form-check-inline'>
									<input class='form-check-input' input required='true' type='radio' name='reason' id='inlineRadio1' value='1'>
									<label class='form-check-label' for='inlineRadio1'>Inappropriate Image</label>
								</div>
									
								<div class='form-check form-check-inline'>
									<input class='form-check-input' input required='true' type='radio' name='reason' id='inlineRadio1'value='2'>
									<label class='form-check-label' for='inlineRadio1'>Inappropriate Content</label>
								</div>
								<div class='form-check form-check-inline'>
									<input class='form-check-input' input required='true' type='radio' name='reason' id='inlineRadio1'value='3'>
									<label class='form-check-label' for='inlineRadio1'>False Information</label>
								</div>
							</div>
							
							<label for='exampleFormControlTextarea1'>Description</label>
							<textarea class='form-control' name ='description' id='exampleFormControlTextarea1' rows='3' placeholder='Extra reasoning for decline?' type='text' required></textarea>
							
							<p> Click below to notify the User why their post was declined</p>
							<input type='submit' class='btn btn-light btn-large' value='Notify User'></input>	";	
					?>
				
					<div class= "row" id ="filler">
					</div>
				</div>
				<div class="col-2 text-center">
				</div>
			</div>
			
		</div>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>