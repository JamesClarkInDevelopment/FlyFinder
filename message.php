<?php
	
	session_start();
	
	include('secure/conn.php');
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
	
	//gets the messages linked with the user
	$myid = $_SESSION['40083514_FlyID'];
	
	$read ="SELECT * FROM FLY_Message WHERE UserID ='$myid'";
	$result= $conn -> query($read);
	
	
	if(!$result){
	echo$conn->error;
	}


?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Messages</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/styles.css">
		
		<style>
			p{
				color:white;
			}
			
			#table{
				color:white;
			}
		
		</style>
		
	</head>
	
	<body class="backgroundgeese">
	
		<?php 
				include('nav.php');
			?>
		<div class="container-fluid" id="width80">
			<div class="row" id="filler">
			</div>
			<div class='row'>
				<div class='col-12 text-center '>
					<table class="table" id="table">
						  <thead>
							<tr>
							  <th scope="col">Reason For Unapproval</th>
							  <th scope="col">Admin Description</th>
							  <th scope="col">Permanently Remove</th>
							</tr>
						  </thead>
						  <?php
							 if ($result->num_rows > 0) {
								
								//the reason for an unapproved upload is shown here in table format
							while($row =$result->fetch_assoc()){
								
								$ID = $row['MessageID'];
								$reasonID = $row['ReasonID'];
								$userID = $row['UserID'];
								$desc = $row['Description'];
								
								$newDesc = wordwrap($desc, 60, "<br/>",true);
								
								$readreason = "SELECT * FROM FLY_Reason WHERE ReasonID = '$reasonID'";				
								$resultreason= $conn -> query($readreason);
								if(!$resultreason){
									echo$conn->error;
									}
								$row1 =$resultreason->fetch_assoc();
								$reason = $row1['Reason'];
								

							echo" <tbody>
								<tr>
								  <td>$reason</td>
								  <td>$newDesc</td>
								  <td><a href='removemessage.php?uploadID=$ID'  class='btn btn-light ' role='button' aria-disabled='true'>Remove </a></td>
								</tr>
							  </tbody>";
							 }
						 }else{
							//if there are no messages
							echo"<h5 class='display-4 text-light text-center'> No Messages</h5>";
						}
						  ?>
						</table>
				</div>
			</div>
			<div class="row" id="filler">
			</div>
			<div class="row" >
				<div class='col-12 text-center '>
					<a href='profile.php' class='btn btn-outline-light btn-lg' role='button' aria-disabled='true'>Return to Profile</a>
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