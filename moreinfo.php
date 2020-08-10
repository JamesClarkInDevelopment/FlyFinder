<?php
	
	session_start();
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
	
	include('secure/conn.php');
	
	$userID = $_SESSION['40083514_FlyID'];
	
	//gets the information on the upload chosen by the user
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
	
	//kicks url ID hackers away
	$readuser ="SELECT * FROM FLY_UserUploads WHERE UploadID = '$getID';";
	$resultuser= $conn -> query($readuser);
	$row1 =$resultuser->fetch_assoc();
	$correctID = $row1['UserID'];
	if($correctID!=$userID){
		header('Location: profile.php');
	}
	
	if(!$result){
	echo$conn->error;
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder More Info</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
				
				//shows the information stored on the upload
						$row =$result->fetch_assoc();
								
								$species = $row['Name'];
								$Desc = $row['Description'];
								$img = $row['ImagePath'];
								$ID = $row['UploadID'];
								$userID = $row['UserID'];
								$weather = $row['Weather'];
								$date =  $row['TimeOfYear'];
								$time = $row['TimeOfDay'];
								$location= $row['Location'];
								
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
										if($memberID==2){
											echo"<p>Weather: $weather</p>
											<p>Date Spotted: $date</p>
											<p>Time Spotted: $time</p>";
										}
									echo"<a href='editupload.php?uploadID=$ID' class='btn btn-light' role='button' aria-disabled='true'>Edit Spotting</a>
						
									<button onclick='deleting()' class='btn btn-light'>Delete Spotting</button>;
									
									
								</div>
								
								<div class='col-4 text-center ' >
									<img class='img-fluid w-100 ' src='customerimages/$img' id='tableUserUploads'>
								</div>
								</div>";
								
					
						
					?>
					<div class="row border-bottom" id="filler">
					</div>
						<script>
								//gets the php id for the url
								//researched from w3schools.com referenced in appendix of dissertation
								var name='<?php echo $ID; ?>';

								function deleting() {
								  if (confirm('This will delete the upload from the system. Are you sure?')) {
										
										window.location="http://jclark07.lampt.eeecs.qub.ac.uk/FlyFinder/deleteupload.php?uploadID="+name;
									} else {
										//stays on the same page if they choose cancel
									}
								}

						</script>		
		</div>
		
	
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>