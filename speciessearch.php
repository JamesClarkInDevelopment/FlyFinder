<?php

	session_start();
	
	include('secure/conn.php');

	$getcat = $conn->real_escape_string($_GET['filter']);
	
	//returns uploads from the species chosen on previous page
	$read="SELECT * FROM FLY_UserUploads INNER JOIN FLY_User ON FLY_UserUploads.UserID = FLY_User.UserID WHERE ApprovalID = 1 AND SpeciesID = '$getcat' ORDER BY Likes DESC LIMIT 10  ;";
	
	$result = $conn->query($read);
	
	if(!$result){
	echo$conn->error;
	}
	
	//used for the loop 
	$read2 = "SELECT * FROM FLY_Species WHERE SpeciesID = '$getcat'";
	$result2 = $conn->query($read2);
	
	if(!$result2){
	echo$conn->error;
	}
	
	$row =$result2->fetch_assoc();
	$specsearch = $row['Name'];
	

?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Species Search </title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/styles.css">
			<style>

			#map {
			height:100%;
			width:100%;
			}
			  
			p{
				color:white;
			}
			
			
	
		</style>
	</head>
	
	<body class="backgroundsearch">
	
		<?php
			include('nav.php');
		?>
		
		<div class="container-fluid center-text" id="tableUserUploads">
			<div class="row">
				<div class="col-lg text-center" >
					<h2 class="display-3 text-light font-italic" ><?php echo $specsearch; ?> Uploads</h2>
				</div>
			</div>
			<div class="row">
				<div class="col text-center " >
					<a class="btn btn-light btn-large" href="search.php" role="button">Return to Search Home Page</a>
					<div class="row" id="filler">
					</div>
					<div class="dropdown text-center">
						<button class="btn btn-secondary btn-large btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Change Species</button>
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
									
									echo "<a class='dropdown-item' href='speciessearch.php?filter=$specID'>$spec</a>";
									
									}
								?>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="filler">
			</div>
				<?php
						//shows the results of chosen species to the screen
						if ($result->num_rows > 0) {

						while($row =$result->fetch_assoc()){
								
								$img = $row['ImagePath'];
								$ID = $row['UploadID'];
				
							echo "<div class='row text-center'>
									<div class='col-1 text-center ' >
									</div>
									<div class='col-6 text-center border' >
										<h5 class='display-4 text-light'> $specsearch</h5>
										<a href='moreinfosearch.php?uploadID=$ID' class='btn btn-light btn-lg' role='button' aria-disabled='true'>More Info</a>
									</div>
									
									<div class='col-4 text-center border' >
										<img class='img-fluid w-100 ' src='customerimages/$img' id='tableUserUploads'>
									</div>
									<div class='col-1 text-center ' >
									</div>
									<div class='row' id='filler'>
				
									</div>
								</div>";
								
						}
						//gives option to view all uploads if more than 10 are returned
						if ($result->num_rows == 10){
								echo "
								<div class='row' id='filler'>
								</div>
								<div class='row'>
									<div class='col-12 text-center' >
										<a href='viewall.php' class='btn btn-light btn-lg' role='button' aria-disabled='true'>View All Uploads</a>
									</div>
								</div>
								<div class='row' id='filler'>
								</div>";
							}
						} else{
							echo"<h5 class='display-4 text-light text-center'> No Results</h5>";
						}
					?>
		</div>
	
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>