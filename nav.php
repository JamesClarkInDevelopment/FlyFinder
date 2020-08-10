<?php
	
	include('secure/conn.php');
	
	if(isset($_SESSION['40083514_FlyUser'])){
		$username = $_SESSION['40083514_FlyUser'];
	}

?>

<head>
	<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/colors-css/2.2.0/colors.min.css">
</head>
	<nav class="navbar navbar-expand-lg navbar-light " >
	  <a class="navbar-brand text-light" href="index.php">FlyFinder</a>
		  <button class="navbar-toggler bg-light" type="button-light" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon "></span>
		  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				
					<?php 
						if(isset($_SESSION['40083514_FlyUser'])){
								$username = $_SESSION['40083514_FlyUser'];
							echo "<li class='nav-item active'>
									<a class='nav-link text-light' href='profile.php'>$username's Profile </a>
								</li> ";}
					?>
				<li class="nav-item">
					<a class="nav-link text-light" href="search.php">Search</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-light" href="upload.php">Upload</a>
				</li>
				<?php
					//lists the logout button if a user is logged in
					if(isset($_SESSION['40083514_FlyUser'])){
						
						echo "<li class='nav-item'>
							<a class='nav-link text-light' href='logout.php'>Logout</a>
						</li>
						";
					}
				?>
			</ul>
		</div>
	</nav>
	
		
	

