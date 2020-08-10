<?php 

	session_start();
	
	include('secure/conn.php');


	
	$readlocation = "SELECT * FROM FLY_Location";
	
	$resultlocation = $conn->query($readlocation);
	
	if(!$readlocation){
		echo$conn->error;
	}
	
	
		

	$pass ="pass";
	echo $pass;
	$hashedpassword= password_hash($pass,PASSWORD_DEFAULT);
	echo $hashedpassword;
	
	$password ="pass";
	echo $password;
	$hashedpassword= password_hash($password,PASSWORD_DEFAULT);
	echo $hashedpassword;
	
	
	
	

?>
<!DOCTYPE html>
<html>
	<head>
	
		<title>FlyFinder Upload Page</title>
		
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
			form{
				color:white;
			}
		
		</style>
		
	</head>
	
	<body class="backgroundlogout">
	
		<?php
			include('nav.php');
		?>

		
		<form id="formABC" action="#" method="POST">
			<input type="submit" id="btnSubmit" value="Submit"></input>
		</form>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

		<input type="button" value="i am normal abc" id="btnTest"></input>

		<script>
			$(document).ready(function () {

				$("#formABC").submit(function (e) {

					//stop submitting the form to see the disabled button effect
					e.preventDefault();

					//disable the submit button
					$("#btnSubmit").attr("disabled", true);

					//disable a normal button
					$("#btnTest").attr("disabled", true);

					return true;

				});
			});
		</script>
		
		<?php
		date_default_timezone_set("America/New_York");
		echo "The time is " . date("h:i:sa");
		?>
		
		<button id="bind"> Bind</button>
		<button id="unbind"> UnBind</button>
		<script>
					$( "#bind" ).click(function() {
			   $(this).attr("disabled", "disabled");
			   $("#unbind").removeAttr("disabled");
			});
			$( "#unbind" ).click(function() {
				 $(this).attr("disabled", "disabled");
				 $("#bind").removeAttr("disabled");
			});
		</script>
		
		<button id="bind" OnClientClick="this.disabled = true;"> Test</button>
		
		
		<button onclick="myFunction()" href ="search.php">Alert Me</button>

			<script>
			function myFunction() {
			  if (confirm('This will delete the upload from the system. Are you sure?')) {
					window.location="http://jclark07.lampt.eeecs.qub.ac.uk/FlyFinder/search.php";
				} else {
					
				}
			}
			
			
			
			</script>
			
		<form method="post" enctype="multipart/form-data" autocomplete="off">
		<form action='insertsomething.php' method='POST' enctype='multipart/form-data' autocomplete="off">
		
							<label for="exampleFormControlTextarea1">Description</label>
							<textarea class="form-control" name ="description" id="exampleFormControlTextarea1" rows="3" placeholder="Describe your spotting experience" type="text" required></textarea>
						
						
			
		<button type="submit" class="btn btn-light">Upload Your Spotting</button>		
				
		</form>		
				
				
				
				
				
				
				
				
	</body>
</html>