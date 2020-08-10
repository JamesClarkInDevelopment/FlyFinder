<?php
	
	session_start();
	
	include('../secure/conn.php');
	
	if(!isset($_SESSION['40083514_FlyUserAdmin'])){
		header('Location: index.php');
	}

	//ADMIN SECTION
	//Gets all uploads that are currently unapproved
	$read="SELECT * FROM FLY_UserUploads INNER JOIN FLY_User ON FLY_User.UserID = FLY_UserUploads.UserID WHERE ApprovalID = 2  ORDER BY TimeOfYear ASC LIMIT 10";
	$result= $conn -> query($read);
	
	if(!$result){
	echo$conn->error;
	}
	
	$readfilter = "SELECT FLY_UserUploads.UploadID, FLY_UserUploads.SpeciesID, FLY_UserUploads.ImagePath, FLY_User.UserID FROM FLY_UserUploads INNER JOIN FLY_User ON FLY_User.UserID = FLY_UserUploads.UserID;";
	$resultfilter= $conn -> query($readfilter);
	
	if(!$resultfilter){
	echo$conn->error;
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>Admin Approval</title>
		
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
								//dropdown to search uploads by user
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
								//dropdown to search uploads by species
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
				<a href='viewalladmin.php' class='btn btn-outline-dark btn-lg' role='button' aria-disabled='true'>View All Uploads</a>
			</div>
				<?php
						while($row =$result->fetch_assoc()){
								
								//loops all unapproved uploads
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
						if ($result->num_rows == 10){
								//if there are more than 10 results the view all button appears to view all uploads
								echo "
								<div class='row'>
									<div class='col-12 text-center border' >
										<a href='viewalladmin.php' class='btn btn-outline-dark btn-lg' role='button' aria-disabled='true'>View All Uploads</a>
									</div>
								</div>";
							}
						
						
					?>
			
		</div>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>