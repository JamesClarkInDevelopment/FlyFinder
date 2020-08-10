<?php
	
	session_start();
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
	
	include('secure/conn.php');
	
	//gets all information on the chosen upload by the user
	if(isset($_GET['uploadID'])){
	$getID = $_GET['uploadID'];
	
	$read ="SELECT * FROM FLY_UserUploads INNER JOIN FLY_Species 
	ON FLY_UserUploads.SpeciesID = FLY_Species.SpeciesID 
	INNER JOIN FLY_Weather ON FLY_Weather.WeatherID = FLY_UserUploads.WeatherID
	INNER JOIN FLY_Location ON FLY_Location.LocationID = FLY_UserUploads.LocationID
	WHERE UploadID = '$getID';";
	
	$result= $conn -> query($read);
	} else {
		header('location: profile.php');
	}
	
	if(!$result){
	echo$conn->error;
	}
	
	//gives the ability to update a members status if their likes reach a certain threshold
	$updatemember= "SELECT Likes FROM FLY_User INNER JOIN FLY_UserUploads ON FLY_UserUploads.UserID=FLY_User.UserID WHERE UploadID = '$getID';";
	$resultlikes = $conn -> query($updatemember);
	
	//Gets the current likes
	$rowlikes =$resultlikes->fetch_assoc();							
	$likes = $rowlikes['Likes'];

?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder More Info</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		
		<link rel="stylesheet" href="styles/styles.css">
		
		<style>
			
		
		</style>
		
	</head>
	
	<body class="backgroundgeese">
	
		<?php
			include('nav.php');
		?>
		
		<h2 class="display-3 text-light text-center font-italic" >Full Upload Details</h2>
		
		<div class="container-fluid" id="width80">
			<div class="row" id="filler">
			</div>
				<?php
						while($row =$result->fetch_assoc()){
								
								//shows details on the upload
								$species = $row['Name'];
								$Desc = $row['Description'];
								$img = $row['ImagePath'];
								$ID = $row['UploadID'];
								$userID = $row['UserID'];
								$weather = $row['Weather'];
								$date =  $row['TimeOfYear'];
								$time = $row['TimeOfDay'];
								$location = $row['Location'];
								
								$readuserID = "SELECT MemberTypeID FROM FLY_User WHERE UserID = '$userID'";
								$result2= $conn -> query($readuserID);
								if(!$result2){
									echo$conn->error;
									}
								$row2 =$result2->fetch_assoc();
								$memberID = $row2['MemberTypeID'];

								$newDesc = wordwrap($Desc, 100, "<br/>",true);
								
							echo "	<div class='row border-top'>
										<div class='col-8 text-center ' >
										<h4 class='text-light'>Species: $species</h4>
										<p>Description: $newDesc</p>
										<p>Location: $location</p>";
											//shows extra data if the user is an enthusiast
											if($memberID==2){
												echo"<p>Weather: $weather</p>
												<p>Date Spotted: $date</p>
												<p>Time Spotted: $time</p>";
											}
										echo"<a href='uploadersprofile.php?userID=$ID' class='btn btn-light btn-lg' role='button' aria-disabled='true'>Uploaders's Profile</a>
										</div>
								
										<div class='col-4 text-center ' >
											<img class='img-fluid w-100 ' src='customerimages/$img' id='tableUserUploads'>
										</div>
									</div>";
								
					
						}
					?>
					<div class="row" id="filler">
					</div>
					<div class='row border-top'>
						<div class='col-4 text-center ' >
							<form name='form' method='post' id='disableButton'>
								<input type="submit"  class='btn btn-light btn-lg' name="Like" value="Like IT!" id='ratingbutton' <?php echo isset($_POST['Like']) ? 'disabled="true"' : ''; ?>/>	
								<img class='img-fluid  ' src='images/like.jpg' id='ratingbutton'>
							</form>
						</div>
						<div class='col-4 text-center ' >	
							<form name='form' method='post' id='disableButton'>			
								<input type="submit" class='btn btn-light btn-lg' name="Dislike" value="Dislike IT!" id='ratingbutton' <?php echo isset($_POST['Dislike']) ? 'disabled="true"' : ''; ?>/>
								<img class='img-fluid  ' src='images/dislike.jpg' id='ratingbutton'>
							</form>
						</div>	
					
									<?php
									//increases the amount of likes on the user
										if(isset($_POST['Like'])){
										
											$update = "UPDATE FLY_User SET Likes = Likes+1 WHERE UserID = '$userID';";
											$result= $conn -> query($update);
											
											//changes the member level if necessary
											$updatemember = "UPDATE FLY_User SET MemberLevelID = MemberLevelID+1 WHERE UserID = '$userID';";
										
												$newbie = 20;
												$bronze = 50;
												$silver = 100;
												$gold = 500;
												
												if($likes=$newbie){
													
													$resultmember= $conn -> query($updatemember); 
												}else if($likes=$bronze){
													
													$resultmember= $conn -> query($updatemember); 
												}else if($likes=$silver){
													
													$resultmember= $conn -> query($updatemember); 
												}else if($likes=$gold){
													
													$resultmember= $conn -> query($updatemember); 
												}

											if(!$result){
											echo $conn->error;
											}
											
										
											echo"<h2 class='display-3 text-light text-center ' id='approving' >Liked</h2>";
											}
										
										//decreases the likes of the user
										if(isset($_POST['Dislike'])){
											$update = "UPDATE FLY_User SET Likes = Likes-1 WHERE UserID = '$userID';";
											$result= $conn -> query($update);
											
											//changes the member level if necessary
											$updatemember = "UPDATE FLY_User SET MemberLevelID = MemberLevelID-1 WHERE UserID = '$userID';";
											
												$newbie = 20;
												$bronze = 50;
												$silver = 100;
												$gold = 500;
												
												if($likes==$newbie){
													$resultmember= $conn -> query($updatemember); 
												}else if($likes=$bronze){
													$resultmember= $conn -> query($updatemember); 
												}else if($likes=$silver){
													$resultmember= $conn -> query($updatemember); 
												}else if($likes=$gold){
													$resultmember= $conn -> query($updatemember); 
												}
											
											
											if(!$result){
											echo $conn->error;
											}
											
											echo"<h2 class='display-3 text-light text-center ' id='approving' >Disliked</h2>";
										}

									  ?> 
					</div>	
					<div class="row" id="filler">
					</div>
					<div class="row" id="filler">
						<div class='col-12 text-center ' >	
							<a href='search.php' class='btn btn-light btn-lg' role='button' >Return To Search</a>
						</div>							
					</div>		
		</div>
		
	
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>