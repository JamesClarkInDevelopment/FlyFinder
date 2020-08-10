<?php
	
	session_start();
	
	include('../secure/conn.php');
	
	if(!isset($_SESSION['40083514_FlyUserAdmin'])){
		header('Location: index.php');
	}
	
	//ADMIN SECTION
	//gets information on the chosen upload
	if(isset($_GET['uploadID'])){
	$getID = $_GET['uploadID'];
	

	$read ="SELECT * FROM FLY_UserUploads INNER JOIN FLY_Species 
	ON FLY_UserUploads.SpeciesID = FLY_Species.SpeciesID 
	INNER JOIN FLY_Weather ON FLY_Weather.WeatherID = FLY_UserUploads.WeatherID
	WHERE UploadID = '$getID';";
	
	$result= $conn -> query($read);
	} else {
		header('location: approval.php');
	}
	
	$readlocation = "SELECT * FROM FLY_Location";
	$resultlocation = $conn->query($readlocation);
	if(!$readlocation){
		echo$conn->error;
	}
	
	$readspecies = "SELECT * FROM FLY_Species";
	$resultspecies = $conn->query($readspecies);
	if(!$readspecies){
		echo$conn->error;
	}
	
	if(!$result){
	echo$conn->error;
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>Admin More Info</title>
		
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
		
		<h2 class="display-3 text-dark text-center font-italic" >Full Upload Details</h2>
		
		<div class="container-fluid" id="width80">
			
			<div class="row" id="filler">
			</div>
			
					<?php  while($row =$result->fetch_assoc()){
								
								//shows all information on the chosen upload
								$species = $row['Name'];
								$Desc = $row['Description'];
								$img = $row['ImagePath'];
								$ID = $row['UploadID'];
								$userID = $row['UserID'];
								$weather = $row['Weather'];
								$date =  $row['TimeOfYear'];
								$time = $row['TimeOfDay'];
								$location = $row['LocationID'];
								
								$readuserID = "SELECT MemberTypeID FROM FLY_User WHERE UserID = '$userID'";
								$result2= $conn -> query($readuserID);
								if(!$result2){
									echo$conn->error;
									}
								$row2 =$result2->fetch_assoc();
								$memberID = $row2['MemberTypeID'];
								
								$readlocation = "SELECT * FROM FLY_Location WHERE LocationID = '$location'";
								$result3= $conn -> query($readlocation);
								if(!$result3){
									echo$conn->error;
									}
								$row3 =$result3->fetch_assoc();
								$location = $row3['Location'];

								$newDesc = wordwrap($Desc, 70, "<br/>",true);
								
							echo "	<div class='row '>
									<div class='col-8 text-center border ' >
									<h4 class='text-dark'>Species: $species</h4>
									<p>Location: $location</p>
									<p>Description: $newDesc</p>";
										//if the user is an enthusiast these extra details are shown
										if($memberID==2){
											echo"<p>Weather: $weather</p>
											<p>Date Spotted: $date</p>
											<p>Time Spotted: $time</p>";
										}
									echo"<a href='uploaderprofile.php?userID=$userID' class='btn btn-outline-dark btn-lg' role='button' aria-disabled='true'>USER'S PROFILE</a>";
					}	
								echo"	<div class='row' id='filler'>
										
										</div>
										
										<h2 class='display-4 text-dark text-center font-italic' >Edit Details Below If Needed</h2>		
					 <form action='admineditupload.php?uploadID=$getID' method='POST' enctype='multipart/form-data' class='border-bottom' >
					
					
							<div class='form-group'>
								<label for='exampleFormControlSelect2'Edit Species</label>
								<select multiple class='form-control' id='exampleFormControlSelect2'name='species' required>";
								
								//gives the species to choose from for editing purpose
									while($row =$resultspecies->fetch_assoc()){
							
										$species = $row['Name'];
										$speciesID = $row['SpeciesID'];
										
										echo "<option>$speciesID) $species</option>";
							  
									}
								
							echo"	</select>
							</div> 
							
							<div class='form-group'
								<label for='xampleFormControlSelect2'>Edit Location</label>
								<select multiple class='form-control' id='exampleFormControlSelect2' name='location' required>";
									
									//gives the locations for editing purposes
									while($row =$resultlocation->fetch_assoc()){
							
										$loc = $row['Location'];
										$locID = $row['LocationID'];
										
										echo "<option>$locID) $loc</option>";
							  
									}
							
							echo"	</select>
							</div>
						
							<label for='exampleFormControlTextarea1'>Description</label>
							<textarea class='form-control' name ='description' id='exampleFormControlTextarea1' rows='3' 
							placeholder='Edit The Description' type='text' required ></textarea>
		
							<div class='row  text-center '>
								<div class='row' id='filler'>
								</div>
								<div class='col'>
								
								</div>
								<div class='col-4  text-center'>
									<button href='admineditupload.php?userID=$userID' type='submit' class='btn btn-outline-dark btn-lg'>Edit and Approve</button>
								</div>
								<div class='col' >
								
								</div>
								<div class='row' id='filler'>
								</div>
							</div>
						</div>
					
				</form>	
								<div class='col-4 text-center ' >
									<img class='img-fluid w-100 ' src='../customerimages/$img' id='tableUserUploads'>
								<p>Approve or Decline?</p>";
					
					?>
						<div class='row  text-center '>
							<div class='col text-center ' >
							<form name="form" method="post">
								<input type="submit" class='btn btn-outline-dark btn-lg' name="Approve" value="Approve"/>	
							</form>	
							<?php echo "<button onclick='decline()' class='btn btn-outline-dark btn-lg'>Decline</button>";?>
							</div>
						</div>
								<script>
								//gets the php id for the url
								var name='<?php echo $getID; ?>';
								
								
								function decline() {
								  if (confirm('This will delete the upload from the system. Are you sure?')) {
										
										window.location="http://jclark07.lampt.eeecs.qub.ac.uk/FlyFinder/admin/decline.php?uploadID="+name;
									} else {
										//stays on the same page if they choose cancel
									}
								}

								</script>
							
							
							<?php
									//receives info from the form above to approve the upload
										if(isset($_POST['Approve'])){

											$approval = 1;
											$update = "UPDATE FLY_UserUploads SET ApprovalID = '$approval' WHERE UploadID = '$getID'";
											$result= $conn -> query($update);
											
											echo"<h2 class='display-3 text-dark text-center ' id='approving' >Upload Approved</h2>
												 <p id='return'>Return To Approval</p>";
											
											if(!$result){
											echo $conn->error;
											}
										}


									  ?> 
							
							
							<a href='approval.php' class='btn btn-outline-dark btn-lg' role='button' aria-disabled='true'>Approval Home</a>
							<a href='viewalladmin.php' class='btn btn-outline-dark btn-lg' role='button' aria-disabled='true'>View All Uploads</a>
								

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