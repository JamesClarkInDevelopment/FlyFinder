<?php 

	session_start();
	
	include('secure/conn.php');
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
	
	$user = $_SESSION['40083514_FlyUser'];
	$userid = $_SESSION['40083514_FlyID'];
	
	//Page is for uploading a new spotting to the website
	
	$read = "SELECT * FROM FLY_User WHERE UserID = $userid";
	$result = $conn->query($read);
	if(!$read){
		echo$conn->error;
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
	
	$readweather = "SELECT * FROM FLY_Weather";
	$resultweather = $conn->query($readweather);
	if(!$readweather){
		echo$conn->error;
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Upload Page</title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		
		<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
		
		<script src="https://cdn.alloyui.com/3.0.1/aui/aui-min.js"></script>
		<link href="https://cdn.alloyui.com/3.0.1/aui-css/css/bootstrap.min.css" rel="stylesheet"></link>	
		
		<link rel="stylesheet" href="styles/styles.css">
		
		<style>
			form{
				color:white;
			}
			
			#time{
				color:black;
			}
			
			#date{
				background: none !important;
			}
		
		</style>
		
	</head>
	
	<body class="backgroundlogout">
	
		<?php
			include('nav.php');
		?>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col text-center " >
				<h2 class="display-3 text-light font-italic">Add A Spotting</h2>
				<form action='insert.php' method='POST' enctype='multipart/form-data'>
					<div class="row justify-content-md-center ">
						<div class="col-8 text-center">
							<?php $user = $_SESSION['40083514_FlyUser'];?>
							<div class="form-group">
								<label for="exampleFormControlSelect2">Species</label>
								<select multiple class="form-control" id="exampleFormControlSelect2" name='species' required>
								  <?php
										while($row =$resultspecies->fetch_assoc()){
								
											$species = $row['Name'];
											$speciesID = $row['SpeciesID'];
											
											echo "<option>$speciesID) $species</option>";
								  
										}
									?>
								</select>
							</div> 
							<div class="form-group">
								<label for="exampleFormControlSelect2">Location</label>
								<select multiple class="form-control" id="exampleFormControlSelect2" name='location' required>
		
							
							  <?php
									while($row =$resultlocation->fetch_assoc()){
							
										$loc = $row['Location'];
										$locID = $row['LocationID'];
										
										echo "<option>$locID) $loc</option>";
							  
									}
							?>
								</select>
							</div>
						
							<label for="exampleFormControlTextarea1">Description</label>
							<textarea class="form-control" name ="description" id="exampleFormControlTextarea1" rows="3" placeholder="Describe your spotting experience" type="text" required></textarea>
						
							<label for="exampleFormControlFile1">Bird Image</label>
							<input type="file" class="form-control-file" id="exampleFormControlFile1" name="uploadimg" required>
							
							<?php
								
								$membertype = $_SESSION['40083514_FlyMemType'];
								if($membertype==2){
									
									echo "	<div class='row' id='filler'>
											</div>
											<div class='row justify-content-md-center'>
												<div class='col-4 text-center'>
													<label for='exampleFormControlFile1'>When was it Spotted?</label>
													<input type='time' name='time' id='time' required>
												</div>
									
												<div class='col-4 text-center'>
													<div class='bootstrap-iso'>
														<div class='form-group'>
															<div class='input-group'>
															
																<div class='input-group-addon'>
																	<i class='fa fa-calendar'></i>
																</div>
																<input class='form-control' id='date' name='date' placeholder='Pick a Date' type='text' required/>
															</div>
														 </div>
													</div>
												</div>
											</div>
										<div class='row' id='filler'>
										</div>
									<div class='form-group'>
											<label for='exampleFormControlSelect2'>Weather</label>
												<select multiple class='form-control' id='exampleFormControlSelect2' name='weather' required>";

													while($row =$resultweather->fetch_assoc()){
											
														$weather = $row['Weather'];
														$weatherID = $row['WeatherID'];
														
														echo "<option>$weatherID) $weather</option>";
											  
													}
											
									echo"		</select>
											</div>";
								}
								
							
							?>
							
									<script>
										//builds the calendar form
										//implemented/edited from w3schools.com referenced in appendix of the dissertation
										$(document).ready(function(){
											var date_input=$('input[name="date"]'); 
											var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
											date_input.datepicker({
												format: 'dd/mm/yyyy',
												container: container,
												todayHighlight: true,
												autoclose: true,
											})
										})
										
									</script>
									
							<div class="row  text-center ">
								<div class="col">
								</div>
								<div class="col-4  text-center">
									<p>Finished?</p>
									<button type="submit" class="btn btn-light">Upload Your Spotting</button>
								</div>
								<div class="col" >
								</div>
							</div>
						</div>
					</div>
				</form>
			<div class="row" id="filler">
			</div>
			</div>
		</div>		
	</div>
		
	</body>
</html>