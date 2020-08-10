<?php

session_start();
	
	//if there are issure with login remove the if statement checking if user is signed in!
	include('../secure/conn.php');
	
	
	if(!isset($_SESSION['40083514_FlyUserAdmin'])){
		header('Location: index.php');
	}
	
	
	$user = $conn->real_escape_string($_POST['postuser']);
	$pass = $conn->real_escape_string($_POST['postpass']);
	
	$checkuser = "SELECT * FROM FLY_Admin WHERE Username = '$user' AND Password = '$pass';";
	
	
	$result = $conn->query($checkuser);
	
	if(!$result){
		echo$conn->error;
	}
	
	$num = $result->num_rows;
	
	if($num>0){
		
		while($row=$result->fetch_assoc()){
			
			//User
			$myuser = $row['Username'];
			$myid = $row['UserID'];
			
			//User
			
			$_SESSION['40083514_FlyUserAdmin']= $myuser;
			$_SESSION['40083514_FlyID']= $myid;
			
			
		}
		
		
		header('Location: approval.php');
		
	}else{
		header('Location: index.php');
	}

?>