<?php

session_start();
	
	include('secure/conn.php');
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['userID'])){
	$getID = $_GET['userID'];
	
	//Page so that users can view other uploaders profiles
	$readuser ="SELECT UserID FROM FLY_UserUploads INNER JOIN FLY_Species WHERE UploadID = '$getID' LIMIT 1;";
	$result = $conn->query($readuser);
	
	$row =$result->fetch_assoc();							
	$myid = $row['UserID'];
	}

	$read = "SELECT * FROM FLY_User WHERE UserID='$myid'";
	
	$result = $conn->query($read);
	
	if(!$read){
		echo$conn->error;
	}
	
	//gets info on the chosen profile
	$row =$result->fetch_assoc();							
	$likes = $row['Likes'];
	$myuser= $row['Username'];
	$mymembertype= $row['MemberTypeID'];
	$mypic= $row['ProfilePicture'];
	$myemail= $row['Email'];
	
	$readapproveduploads="SELECT * FROM FLY_UserUploads INNER JOIN FLY_Species ON FLY_UserUploads.SpeciesID = FLY_Species.SpeciesID WHERE UserID = '$myid'AND ApprovalID = 1 LIMIT 5;";

	$resultapproveduploads= $conn -> query($readapproveduploads);

	if(!$resultapproveduploads){
	echo$conn->error;
	}
	
	
	
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Profile</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/styles.css">
		
		<style>
			
			
		</style>
		
	</head>
	
	<body class="backgroundprofile">
	
		
		<?php
			include('nav.php');
		?>
		
		<div class="container-fluid" id="content">
			
				<div class="row">
					<div class="col-8 text-center border-right" >
						<h2 class="display-3 text-light font-italic">Profile Page</h2>
					</div>
					<div class="col-2 " >
						<p>Member Level</p>
						<?php 
						//shows the correct icon for the user
						$newbie = 20;
						$bronze = 50;
						$silver = 100;
						$gold = 500;
						
						if($likes<$newbie){
							echo" <img src='images/newbie.jpg' id='membericon'>"; 
						}else if($likes<$bronze&& $likes>$newbie){
							echo" <img src='images/bronze.jpg' id='membericon'>";
						}else if($likes<$silver&& $likes>=$bronze){
							echo" <img src='images/silver.jpg' id='membericon'>";
						}else if($likes<$gold&& $likes>=$silver){
							echo" <img src='images/gold.jpg' id='membericon'>";
						}else if($likes>$gold){
							echo" <img src='images/platinum.jpg' id='membericon'>";
						}
						
						?>
					</div>
					<div class="col-2 text-center" >
						<?php 
							//shows the users amount of likes
							echo "<p>$myuser 's Likes!!</p>"; 
							echo" <h1 class='text-light'>$likes</h1>"; 
						?>
					</div>
				</div>
				<div id="filler">
				</div>
				<div class="row">
					<div class="col-8 border-right">
						<div class="row" id="filler">
						</div>
						<?php
								$result= $conn -> query($read);
								
								if(!$result){
								echo $conn->error;}
								else{
									echo"<h3 class='display-4 text-light text-center'>$myuser's Profile</h3> ";
									//Shows the correct icon for member
									if($mymembertype==2){
										echo "<p class= 'text-center'>Member Type: Enthusiast</p>
												<div class= 'text-center'><img src='images/enthusiast.jpg' id='ratingbutton'></div>";
									} else {
										echo "<p class= 'text-center'>Member Type: Family</p>
												<div class= 'text-center'><img src='images/family.png' id='ratingbutton'></div>";
									}
									echo"
									<p class= 'text-center'>Email: $myemail</p>";
								}
								
						?>
					</div>
					<div class="col-4">
						<?php 
						//users profile pic
							echo " <img src='customerimages/$mypic' id='registered'>"; 
						
						?>
					</div>
				</div>		
				<div class="row text-center" id="width80">
					<div class="col-12" id="width80">	
						<h3 class='display-3 text-light font-italic'>Recent Live Uploads</h3>
						
						<?php
						//shows some of the users approved uploads
								while($row =$resultapproveduploads->fetch_assoc()){
								if(!$readapproveduploads){
								echo $conn->error;}	

								$name = $row['Name'];
								$img = $row['ImagePath'];
								$ID = $row['UploadID'];
				
								
							echo "<div class='row'>
									<div class='col-8 text-center border' >
										<h5 class='display-4 text-light'> $name</h5>
										<a href='moreinfosearch.php?uploadID=$ID' class='btn btn-light btn-lg' role='button' aria-disabled='true'>More Info</a>
									</div>
									
									<div class='col-4 text-center border' >
										<img class='img-fluid w-100 ' src='customerimages/$img' id='tableUserUploads'>
									</div>
									<div class='row' id='filler'>
				
									</div>
								</div>";
								
					
							}
							
						?>
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