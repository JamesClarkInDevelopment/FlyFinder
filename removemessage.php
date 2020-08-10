<?php
session_start();
	
	include('secure/conn.php');
	
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: index.php');
	}
	
	//deletes the message from the system
	$_GET['uploadID'];
	$getID = $_GET['uploadID'];
	
	$delete = "DELETE FROM FLY_Message WHERE MessageID = '$getID'";

	$result= $conn -> query($delete);

	if(!$result){
	echo$conn->error;
	}
	
	header('Location: message.php');
	
?>