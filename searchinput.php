<?php

	session_start();

	include('secure/conn.php');

	$GET = $conn->real_escape_string($_POST['search']);

	$output ='';
	$noresult ='';
	
	if(isset($_POST['search'])){
		
		//code below returns the most reasonable data that can be found in the database
		$searchq = $conn->real_escape_string($_POST['search']);
		
		
		$readapprovedsearchuploads="SELECT * FROM FLY_UserUploads 
						INNER JOIN FLY_Species ON FLY_UserUploads.SpeciesID = FLY_Species.SpeciesID 
						INNER JOIN FLY_Location ON FLY_UserUploads.LocationID = FLY_Location.LocationID
						INNER JOIN FLY_User ON FLY_UserUploads.UserID = FLY_User.UserID
						WHERE ApprovalID = 1 AND Name LIKE '%$searchq%' OR Location LIKE '%$searchq%' OR  Description LIKE '%$searchq%'OR TimeOfDay LIKE '%$searchq%' OR TimeOfYear LIKE '%$searchq%' ORDER BY Likes DESC;";
		
		$resultquery = $conn -> query($readapprovedsearchuploads);
	
			if ($resultquery->num_rows > 0){
			while($row = $resultquery->fetch_assoc()){
				$name = $row['Name'];
				$Desc = $row['Description'];
				$uploadID = $row['UploadID'];
				$image = $row['ImagePath'];
				$location = $row['Location'];

				$output .= "
									<div class='row text-center'>
									<div class='col-1 text-center ' >
									</div>
									
									<div class='col-6 text-center border' >
										<h5 class='display-4 text-light'> $name</h5>
										<p class='text-light'>Desc:  $Desc</p>
										<p class='text-light'>Location:  $location</p>
										<a href='moreinfosearch.php?uploadID=$uploadID' class='btn btn-light btn-lg' role='button' aria-disabled='true'>More Info</a>
									</div>
									
									<div class='col-4 text-center border' >
										<img class='img-fluid w-100 ' src='customerimages/$image' id='tableUserUploads'>
									</div>
									<div class='col-1 text-center ' >
									</div>
									<div class='row' id='filler'>
				
									</div>
								</div>";
				
			}
			} else{
				//echos out if there are no results returned
				$noresult="<h5 class='display-4 text-light text-center'> No Results to Show</h5>";
			}
		
	}

?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder User Search </title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="styles/styles.css">
		
	</head>
	
	<body class="backgroundsearch">
	
		<?php
			include('nav.php');
		?>
		
		<div class="container-fluid center-text" id="tableUserUploads">
			<div class='row'>
				<div class='col-lg text-center' >
					<h2 class='display-3 text-light font-italic' >Your <?php echo $GET; ?> Search Results</h2>
					<p>Higher Level Members have their Uploads closer to the top of the search results</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg text-center" >
					<?php
						echo $noresult;
						echo $output;
					?>
				</div>
			</div>
			<div class="row" id="filler">
			</div>
			<div class="row">
				<div class="col text-center " >
					<form action="searchinput.php" method="post">
						<input required = 'true' type="text" name= "search" placeholder ="Search Uploads">
						<input class="btn btn-light" type="submit" value="Go">
					</form>
				</div>
			</div>
			<div class="row" id="filler">
			</div>
			<div class="row">
				<div class="col text-center " >
					<a class="btn btn-light btn-large" href="search.php" role="button">Return to Search Home Page</a>
					<div class="row" id="filler">
					</div>
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