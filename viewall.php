<?php
	
	session_start();
	
	include('secure/conn.php');
	
	
	//returns all approved uploads live in the system 
	$read ="SELECT * FROM FLY_UserUploads 
	INNER JOIN FLY_Species ON FLY_UserUploads.SpeciesID = FLY_Species.SpeciesID 
	INNER JOIN FLY_Weather ON FLY_Weather.WeatherID = FLY_UserUploads.WeatherID
	INNER JOIN FLY_Location ON FLY_Location.LocationID = FLY_UserUploads.LocationID
	INNER JOIN FLY_User ON FLY_User.UserID = FLY_UserUploads.UserID
	WHERE ApprovalID = 1 ORDER BY Likes DESC;";
	
	$result= $conn -> query($read);
	
	if(!$result){
	echo$conn->error;
	}


?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder View All</title>
		
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
	
	<body class="backgroundsearch">
	
		<?php 
				include('nav.php');
			?>
		
		<h2 class="display-3 text-light text-center font-italic" >All Live Uploads </h2>
		
		<div class="container-fluid" id="width80">
			<div class="row" id="filler">
			</div>
			<div class="row">
				<div class='col-3 text-center '>
					<a href='search.php' class='btn btn-outline-light btn-lg' role='button' aria-disabled='true'>Search Home</a>
				</div>
				<div class='col-3 text-center '>
					<div class="dropdown text-center">
					<button class="btn btn-light btn-large btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Location Search</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<?php
								//populates location dropdown
								$nav= "SELECT * FROM FLY_Location";
								$navresult = $conn->query($nav);
							
								
								if(!$navresult){
									echo $conn->error;
								}
								
								while($nav = $navresult->fetch_assoc()){
								
								$loc = $nav['Location'];
								$locID = $nav['LocationID'];
								
								echo "<a class='dropdown-item' href='viewalllocation.php?filter=$locID'>$loc</a>";
								
								}
							?>
						</div>
					</div>
				</div>
				<div class='col-3 text-center '>
				<div class="dropdown text-center">
					<button class="btn btn-light btn-large btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User Search</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<?php
								//populates location dropdownUserLocation";
								$nav= "SELECT * FROM FLY_User";
								$navresult = $conn->query($nav);
							
								
								if(!$navresult){
									echo $conn->error;
								}
								
								while($nav = $navresult->fetch_assoc()){
								
								$user = $nav['Username'];
								$userID = $nav['UserID'];
								
								echo "<a class='dropdown-item' href='viewalluser.php?filter=$userID'>$user</a>";
								
								}
							?>
						</div>
					</div>
				</div>
				<div class='col-3 text-center '>
					<div class="dropdown text-center">
					<button class="btn btn-light btn-large btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Species Search</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<?php
							//populates species dropdown
								$nav1= "SELECT * FROM FLY_Species ORDER BY Name ASC";
								$navresult1 = $conn->query($nav1);
							
								
								if(!$navresult1){
									echo $conn->error;
								}
								
								while($nav1 = $navresult1->fetch_assoc()){
								
								$spec = $nav1['Name'];
								$specID = $nav1['SpeciesID'];
								
								echo "<a class='dropdown-item' href='viewallspecies.php?filter=$specID'>$spec</a>";
								
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="filler">
			</div>
			<div class='row'>
				<div class='col-12 text-center '>
					<table class="table" id="table">
						  <thead>
							<tr>
							  <th scope="col">User</th>
							  <th scope="col">MemberType</th>
							  <th scope="col">Species</th>
							  <th scope="col">Location</th>
							  <th scope="col">Time Of Day</th>
							  <th scope="col">Time Of Year</th>
							  <th scope="col">Weather</th>
							  <th scope="col">More Information</th>
							</tr>
						  </thead>
						  <?php
							 while($row =$result->fetch_assoc()){
								
								//shows all results to user in a table format
								$species = $row['Name'];
								$ID = $row['UploadID'];
								$userID = $row['UserID'];
								$weather = $row['Weather'];
								$date =  $row['TimeOfYear'];
								$time = $row['TimeOfDay'];
								$location = $row['Location'];
								$username = $row['Username'];
								
								$readuserID = "SELECT * FROM FLY_User INNER JOIN FLY_MemberType ON FLY_User.MemberTypeID = FLY_MemberType.MemberTypeID
												WHERE UserID = '$userID'";
								$result2= $conn -> query($readuserID);
								if(!$result2){
									echo$conn->error;
									}
								$row2 =$result2->fetch_assoc();
								$memberID = $row2['MemberType'];

							echo" <tbody>
								<tr>
								  <th scope='row'>$username</th>
								  <td>$memberID</td>
								  <td>$species</td>
								  <td>$location</td>
								  <td>$time</td>
								  <td>$date</td>
								  <td>$weather</td>
								  <td><a href='moreinfosearch.php?uploadID=$ID' class='btn btn-light ' role='button' aria-disabled='true'>More Info</a></td>
								</tr>
							  </tbody>";
							 }
						  ?>
						</table>
				</div>
			</div>
			<div class="row" id="filler">
			</div>
			<div class="row" >
				<div class='col-12 text-center '>
					<a href='approval.php' class='btn btn-outline-light btn-lg' role='button' aria-disabled='true'>Search Home</a>
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