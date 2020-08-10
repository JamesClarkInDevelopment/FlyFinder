<?php

	session_start();
	
	include('secure/conn.php');
	
	//shows only approved uploads to the search page
	$readapproveduploads="SELECT * FROM FLY_UserUploads INNER JOIN FLY_Species ON FLY_UserUploads.SpeciesID = FLY_Species.SpeciesID WHERE ApprovalID = 1 ORDER BY  TimeOfYear LIMIT 4;";

	$resultapproveduploads= $conn -> query($readapproveduploads);

	if(!$resultapproveduploads){
	echo$conn->error;
	}
	
	echo $header='';
	echo $output='';

?>
<!DOCTYPE html>
<html>
	<head>
		<title>FlyFinder Search </title>
	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
		<link rel="stylesheet" href="styles/styles.css">
	
		<meta name="viewport" content="initial-scale=1.0">
		<meta charset="utf-8">

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
	
	<div class="container-fluid" >
			<div class="row text-center">
				<div class="col-xs text-center" >
					<h2 class="display-3 text-light font-italic">FlyFinder Search</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-8 text-center" >
					<div id="map">
						<iframe class="well well-sm" src="https://www.google.co.uk/maps/d/embed?mid=1vyUr3MJw7AMKUX97Lz8h_u0Giw1kSpjj" height="480"width="100%"></iframe>
					</div>		
				</div>
				<div class="col-4 ">
					<h3 class="display-5 text-light font-italic text-center">Find a Location</h3>
					<p> 1. Click a Bird on the Map </p>
					<p> 2. See the Location </p>
					<p> 3. Open the Google Maps for Directions  </p>
					<p> 4. Check the dropdown below, and see what uploads are live there!! </p>
					
					<div class="dropdown text-center">
					<button class="btn btn-light btn-large btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Location Search</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<?php
								//populates the dropdown for location
								$nav= "SELECT * FROM FLY_Location";
								$navresult = $conn->query($nav);
							
								
								if(!$navresult){
									echo $conn->error;
								}
								
								while($nav = $navresult->fetch_assoc()){
								
								$loc = $nav['Location'];
								$locID = $nav['LocationID'];
								
								echo "<a class='dropdown-item' href='location.php?filter=$locID'>$loc</a>";
								
								}
							?>
						</div>
					</div>
					<div class="row" id="filler">
					</div>
					<div class="dropdown text-center">
					<button class="btn btn-light btn-large btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Species Search</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<?php
								//populates the dropdown for species
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
					<div class="row" id="filler">
					</div>
					<div class= "text-center">
						<a href='viewall.php?' class='btn btn-light btn-lg' role='button' aria-disabled='true'>View All Uploads</a>
						<div class="row" id="filler">
					
						</div>
						<form action="searchinput.php" method="post">
							<input required = 'true' type="text" name= "search" placeholder ="Search Uploads">
							<input class="btn btn-light" type="submit" value="Go">
						</form>
					</div>
					<?php
						echo $header;
						echo $output;
					?>
				</div>
			</div>
			<div class="row" id="filler">
			</div>
				<div class="row text-center">
					<div class="col-1 text-center" id="width80">
					</div>					
					<div class="col-10 text-center" id="width80">	
						<h3 class='display-3 text-light font-italic'>Recent Uploads</h3>
						<?php
						
								while($row =$resultapproveduploads->fetch_assoc()){
								if(!$readapproveduploads){
								echo $conn->error;}	

								$name = $row['Name'];
								$img = $row['ImagePath'];
								$ID = $row['UploadID'];
				
								
							echo "<div class='row text-center'>
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
				<div class="col-1 text-center" id="width80">
				</div>		
			</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
		
		
		
</body>
</html>