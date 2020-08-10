<?php

session_start();
	
	include('../secure/conn.php');
	
	if(!isset($_SESSION['40083514_FlyUserAdmin'])){
		header('Location: index.php');
	}
	
	//ADMIN SECTION
	//Code similar to the profile page just so te admin has the option to view a users profile
	if(isset($_GET['userID'])){
	$getID = $_GET['userID'];
	
	$read="SELECT * FROM FLY_User WHERE UserID ='$getID'";

	$result= $conn -> query($read);

	if(!$read){
		echo$conn->error;
	}
	
	} else {
		header('location: moreinfoadmin.php');
	}
	
	//Gets the current likes
	$row =$result->fetch_assoc();							
	$likes = $row['Likes'];
	
								
		if(!$row){
			echo$conn->error;
		}
								
		$user= $row['Username'];
		$membertype = $row['MemberTypeID'];
		$email= $row['Email'];
		$pic = $row['ProfilePicture'];
							

	$readuploads="SELECT * FROM FLY_UserUploads INNER JOIN FLY_Species ON FLY_UserUploads.SpeciesID = FLY_Species.SpeciesID WHERE UserID = '$getID' LIMIT 10;";
	
	$resultuploads= $conn -> query($readuploads);

	if(!$resultuploads){
	echo$conn->error;
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>Admin Profile Check</title>
		
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
		
		<div class="container-fluid" id="content">
			
				<div class="row">
					<div class="col-8 text-center border-right" >
						<h2 class="display-3 text-dark font-italic">Profile Page</h2>
						
					</div>
					<div class="col-2 " >
						<p>Member Level</p>
						<?php 
						
						$newbie = 20;
						$bronze = 50;
						$silver = 100;
						$gold = 500;
						
						if($likes<$newbie){
							echo" <img src='../images/newbie.jpg' id='membericon'>"; 
						}else if($likes<$bronze&& $likes>$newbie){
							echo" <img src='../images/bronze.jpg' id='membericon'>";
						}else if($likes<$silver&& $likes>=$bronze){
							echo" <img src='../images/silver.jpg' id='membericon'>";
						}else if($likes<$gold&& $likes>=$silver){
							echo" <img src='../images/gold.jpg' id='membericon'>";
						}else if($likes>$gold){
							echo" <img src='../images/platinum.jpg' id='membericon'>";
						}
						
						?>
					</div>
					<div class="col-2 text-center" >
						<p>Likes until next Level!!</p>
						<?php
							if($likes<$newbie){
							$upgrade = $newbie-$likes;
							echo" <h1 class='text-dark'>$upgrade</h1>"; 
						}else if($likes<$bronze&& $likes>$newbie){
							$upgrade = $bronze-$likes;
							echo" <h1 class='text-dark'>$upgrade</h1>";
						}else if($likes<$silver&& $likes>=$bronze){
							$upgrade = $silver-$likes;
							echo" <h1 class='text-dark'>$upgrade</h1>";
						}else if($likes<$gold&& $likes>=$silver){
							$upgrade = $gold-$likes;
							echo" <h1 class='text-dark'>$upgrade</h1>";
						}else if($likes>$gold){
							echo"<h3>MAX</h3>";
						}
						?>
					</div>
				</div>
	
				<div id="filler">
				</div>
			
				<div class="container-fluid">
					<div class="row">
						<div class="col-8 border-right">
							<div class="row" id="filler">
							</div>
							<?php
									if($membertype==1){
										$memtype = 'Family';
									} else{
										$memtype = 'Enthusiast';
									}
									
										echo"<h3 class='display-5 text-dark text-center'>$user's Profile</h3> 
										<p class= 'text-center'>Member Type: $memtype</p>
										<p class= 'text-center'>Email: $email</p>";
			
							?>
							
						</div>
						<div class="col-4">
							<?php 
							
								echo " <img src='../customerimages/$pic' id='registered'>"; 
							
							?>	
						</div>	
					</div>		
						<div class="row text-center" id="width80">
							<div class="col-12" id="width80">	
								<h3 class='display-3 text-dark font-italic'><?php echo $user; ?>'s Uploads</h3>
								
								<?php
								
										while($row =$resultuploads->fetch_assoc()){
										if(!$readuploads){
										echo $conn->error;}	
											
										
										$name = $row['Name'];
										$img = $row['ImagePath'];
										$ID = $row['UploadID'];
						
										
									echo "<div class='row'>
											<div class='col-8 text-center border' >
												<h5 class='display-4 text-dark'> $name</h5>
												
											</div>
											
											<div class='col-4 text-center border' >
												<img class='img-fluid w-100 ' src='../customerimages/$img' id='tableUserUploads'>
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
		
		</div>
		
	
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	</body>
</html>