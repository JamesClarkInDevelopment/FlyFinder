<?php

session_start();
	
	if(!isset($_SESSION['40083514_FlyUserAdmin'])){
		header('Location: index.php');
	}
		
	include('../secure/conn.php');
	
	//ADMIN SECTION
	//Page sends a message to  user with the reason for their decline
	$reason = $conn->real_escape_string($_POST['reason']);
	$desc = $conn->real_escape_string($_POST['description']);
	
	if(isset($_GET['userID'])){
	$getID = $_GET['userID'];
	}
	
	$insert = "	INSERT INTO FLY_Message (ReasonID,UserID ,Description) VALUES ('$reason','$getID','$desc');";

?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>Admin Message Sent</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="../styles/styles.css">
		
		<style>
			p{
				color:black;
			}
		</style>
		
	</head>
	
	<body class="backgroundadmin">
	
		<?php 
				include('adminnav.php');
			?>
		
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-12 text-center">
					<div class="row" id="filler">
					</div>
					<?php
							$result= $conn -> query($insert);
							
							if(!$result){
							echo $conn->error;}
							else{
								echo"<h3 class='display-3 text-dark text-center font-italic'>Message Sent</h3> 
								<p>Return to Approval Page! </p>
								<a href='approval.php' class='btn btn-outline-dark btn-lg' role='button' aria-disabled='true'>Approval Home</a>
								
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