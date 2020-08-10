<?php

session_start();
	
	include('secure/conn.php');
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
	
	//data set when the user has signed in
	$myuser= $_SESSION['40083514_FlyUser'];
	$myid= $_SESSION['40083514_FlyID'];
	$mymembertype= $_SESSION['40083514_FlyMemType'];
	$mymembertypename = $_SESSION['40083514_FlyMemTypeName'];
	$mypic= $_SESSION['40083514_FlyProPic'];
	$myemail= $_SESSION['40083514_FlyEmail'];
	
	
	$read = "SELECT * FROM FLY_User WHERE UserID='$myid'";
	
	$result = $conn->query($read);
	
	if(!$read){
		echo$conn->error;
	}
	

	//Gets the current likes
	$row =$result->fetch_assoc();							
	$likes = $row['Likes'];

	//shows the live approved uploads
	$readapproveduploads="SELECT * FROM FLY_UserUploads INNER JOIN FLY_Species ON FLY_UserUploads.SpeciesID = FLY_Species.SpeciesID WHERE UserID = '$myid'AND ApprovalID = 1 LIMIT 5;";

	$resultapproveduploads= $conn -> query($readapproveduploads);

	if(!$resultapproveduploads){
	echo$conn->error;
	}
	
	//shows the uploads awaiting approval
	$readotheruploads="SELECT * FROM FLY_UserUploads INNER JOIN FLY_Species ON FLY_UserUploads.SpeciesID = FLY_Species.SpeciesID WHERE UserID = '$myid'AND ApprovalID = 2 LIMIT 5;";

	$resultotheruploads= $conn -> query($readotheruploads);

	if(!$resultotheruploads){
	echo$conn->error;
	}
	
	//works out what member icon to show
	$readmember="SELECT * FROM FLY_User WHERE UserID = '$myid'";
	$resultmember= $conn -> query($readmember);

	if(!$resultmember){
	echo$conn->error;
	}
	$row =$resultmember->fetch_assoc();
	$memicon = $row['MemberTypeID'];

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
						//shows the appropriate icon for the amount of likes the user has
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
						<p>Likes until next Level!!</p>
						<?php
							//shows the amount of likes until the users next level
							if($likes<$newbie){
							$upgrade = $newbie-$likes;
							echo" <h1 class='text-light'>$upgrade</h1>"; 
						}else if($likes<$bronze&& $likes>$newbie){
							$upgrade = $bronze-$likes;
							echo" <h1 class='text-light'>$upgrade</h1>";
						}else if($likes<$silver&& $likes>=$bronze){
							$upgrade = $silver-$likes;
							echo" <h1 class='text-light'>$upgrade</h1>";
						}else if($likes<$gold&& $likes>=$silver){
							$upgrade = $gold-$likes;
							echo" <h1 class='text-light'>$upgrade</h1>";
						}else if($likes>$gold){
							echo"<h3>MAX</h3>";
						}
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
						//users information
								$result= $conn -> query($read);
								
								if(!$result){
								echo $conn->error;}
								else{
									echo"<h3 class='display-4 text-light text-center'>$myuser's Profile</h3> 
									<p class= 'text-center'>Member Type: $mymembertypename</p>";
									if($memicon==2){
										echo "<div class= 'text-center'><img src='images/enthusiast.jpg' id='ratingbutton'></div>";
									} else {
										echo "<div class= 'text-center'><img src='images/family.png' id='ratingbutton'></div>";
									}
									echo"<p class= 'text-center'>Email: $myemail</p>";
								}
						?>
						<div class='row'>
							<div class='col-12 text-center ' >
								<a class="btn btn-light"  href="editprofile.php" role="button">Edit Profile</a>
								<a class="btn btn-light"  href="upload.php" role="button">Upload</a>
								<a class="btn btn-light"  href="logout.php" role="button">Logout</a>
							</div>
						</div>
						<div class="row" id="filler">
						</div>
						<div class='row'>
							<div class='col-12 text-center ' >
								<a class="btn btn-light btn-lg"  href="message.php" role="button">Messages</a>
							</div>
						</div>
					</div>
					<div class="col-4">
						<?php 
						//profile picture
							echo " <img src='customerimages/$mypic' id='registered'>"; 
						
						?>
					</div>
				</div>		
				<div class="row text-center" id="width80">
					<div class="col-12" id="width80">	
						<h3 class='display-3 text-light font-italic'>Live Uploads</h3>
							<?php
							//the approved live uploads
									while($row =$resultapproveduploads->fetch_assoc()){
									if(!$readapproveduploads){
									echo $conn->error;}	

									$name = $row['Name'];
									$img = $row['ImagePath'];
									$ID = $row['UploadID'];
					
									
								echo "<div class='row'>
										<div class='col-1 text-center ' ></div>
										<div class='col-6 text-center border' >
											<h5 class='display-4 text-light'> $name</h5>
											<a href='moreinfo.php?uploadID=$ID' class='btn btn-light btn-lg' role='button' aria-disabled='true'>More Info</a>
										</div>
										
										<div class='col-4 text-center border' >
											<img class='img-fluid w-100 ' src='customerimages/$img' id='tableUserUploads'>
										</div>
										<div class='col-1 text-center ' ></div>
										<div class='row' id='filler'>
					
										</div>
									</div>";
									
						
								}
								
							?>
					</div>	
				</div>	
				<div class="row text-center" id="width80">
					<div class="col-12" id="width80">	
						<h3 class='display-3 text-light font-italic'>Pending Approval Uploads</h3>
							<?php
							//the approval pending uploads
									while($row =$resultotheruploads->fetch_assoc()){
									if(!$readotheruploads){
									echo $conn->error;}	

									$name = $row['Name'];
									$img = $row['ImagePath'];
									$ID = $row['UploadID'];
					
									
								echo "<div class='row'>
										<div class='col-1 text-center ' ></div>
										<div class='col-6 text-center border' >
											<h5 class='display-4 text-light'> $name</h5>
											<a href='moreinfo.php?uploadID=$ID' class='btn btn-light btn-lg' role='button' aria-disabled='true'>More Info</a>
										</div>
										
										<div class='col-4 text-center border' >
											<img class='img-fluid w-100 ' src='customerimages/$img' id='tableUserUploads'>
										</div>
										<div class='col-1 text-center ' ></div>
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