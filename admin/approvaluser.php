<?php

	session_start();
	
	if(!isset($_SESSION['40083514_FlyUserAdmin'])){
		header('Location: index.php');
	}
		
	include('../secure/conn.php');
	
	//ADMIN SECTION
	//Page for the admin to search uploads by user
	$getcat = $conn->real_escape_string($_GET['filter']);

	$read="SELECT * FROM FLY_UserUploads WHERE ApprovalID = 2 AND UserID = '$getcat' ;";
	
	$result = $conn->query($read);
	
	if(!$result){
	echo$conn->error;
	}
	
	$read2 = "SELECT * FROM FLY_Species WHERE SpeciesID = '$getcat'";
	$result2 = $conn->query($read2);
	
	if(!$result2){
	echo$conn->error;
	}
	
	$row =$result2->fetch_assoc();
	$spec = $row['Name'];

?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>Admin Approval User</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="../styles/styles.css">
		
	</head>
	
	<body class="backgroundadmin">
	
			<?php 
				include('adminnav.php');
			?>

		<h2 class="display-3 text-dark text-center font-italic" >Admin Approval</h2>
		
		<div class="container-fluid" id="padding10">
			
			<div class="row" id="filler">
			</div>
			<div class="row  text-center" >
				<div class="dropdown text-center">
					<button class="btn btn-dark-outline btn-large btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Uploads By Username</button>

						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<?php
								//populates user dropdown
								$nav= "SELECT * FROM FLY_User";
								$navresult = $conn->query($nav);
							
								
								if(!$navresult){
									echo $conn->error;
								}
								
								while($nav = $navresult->fetch_assoc()){
								
								$user = $nav['Username'];
								$userID = $nav['UserID'];
								
								echo "<a class='dropdown-item' href='approvaluser.php?filter=$userID'>$userID) $user</a>";
								
								}
							?>
						</div>
					</div>
					<div class="dropdown text-center">
					<button class="btn btn-dark-outline btn-large btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Uploads By Species</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<?php
								//populates species dropdown
								$nav2= "SELECT * FROM FLY_Species ORDER BY Name ASC";
								$navresult2 = $conn->query($nav2);
							
								
								if(!$navresult2){
									echo $conn->error;
								}
								
								while($nav2 = $navresult2->fetch_assoc()){
								
								$species = $nav2['Name'];
								$specID = $nav2['SpeciesID'];
								
								echo "<a class='dropdown-item' href='approvalspecies.php?filter=$specID'>$species</a>";
								
								}
							?>
							
						</div>
					</div>
				<a href='approval.php' class='btn btn-outline-dark btn-lg' role='button' aria-disabled='true'>All Uploads</a>
			</div>
				<?php
						if ($result->num_rows > 0) {
						while($row =$result->fetch_assoc()){
							
								//shows uploads	by chosen user					
								$species = $row['SpeciesID'];
								$user = $row['UserID'];
								$img = $row['ImagePath'];
								$ID = $row['UploadID'];
								
								$readuser = "SELECT Username FROM FLY_User WHERE UserID = $user";
								$resultuser= $conn -> query($readuser);
								$row1 =$resultuser->fetch_assoc();
								$username= $row1['Username'];
								
								$readspecies = "SELECT Name FROM FLY_Species WHERE SpeciesID = $species";
								$resultspecies= $conn -> query($readspecies);
								$rowspecies =$resultspecies->fetch_assoc();
								$species= $rowspecies['Name'];
								
							echo "<div class='row'>
									<div class='col-8 text-center border' >
									<h3 class='display-4 text-dark text-center'> $species</h3>
									<h4>User: $username</h4>
									
									<a href='moreinfoadmin.php?uploadID=$ID' class='btn btn-outline-dark btn-lg' role='button' aria-disabled='true'>MORE INFO</a>
								</div>
								<div class='col-4 text-center border' id='userupload'>
									<img class='img-fluid w-100 ' src='../customerimages/$img' id='userupload'>
								</div>
								</div>";
								
					
						}
						} else{
							echo "<h3 class='display-4 text-dark text-center'> No Results to Show</h3>";
						}
						
						
					?>
			
		</div>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>