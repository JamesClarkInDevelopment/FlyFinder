<?php
session_start();
	
	include('secure/conn.php');
	
	
	if(!isset($_SESSION['40083514_FlyUser'])){
		header('Location: login.php');
	}
	
	
	$user = $conn->real_escape_string($_POST['postuser']);
	$pass = $conn->real_escape_string($_POST['postpass']);
		
	$checkuser = "SELECT FLY_MemberType.MemberTypeID, FLY_MemberType.MemberType, FLY_User.UserID, FLY_User.Username, FLY_User.Password,  FLY_User.Email, FLY_User.ProfilePicture, FLY_User.Likes FROM FLY_MemberType INNER JOIN FLY_User ON FLY_MemberType.MemberTypeID = FLY_User.MemberTypeID WHERE FLY_User.Username = '$user';";
	
	
	$result = $conn->query($checkuser);
	
	if(!$result){
		echo$conn->error;
	}
	
	$num = $result->num_rows;
	
	if($num>0){
		
		while($row=$result->fetch_assoc()){
			
			if(password_verify($pass, $row['Password'])){
			
			//User
			$myuser = $row['Username'];
			$myid = $row['UserID'];
			$mypic = $row['ProfilePicture'];
			$myemail = $row['Email'];
			$mymembertype = $row['MemberTypeID'];
			$mymembertypename = $row['MemberType'];
			$likes = $row['Likes'];
			$pass= $row['Password'];
			
			//Birds
			$uploadpic = $row['ImagePath'];
			
			//User
			
			$_SESSION['40083514_FlyUser']= $myuser;
			$_SESSION['40083514_FlyID']= $myid;
			$_SESSION['40083514_FlyPass']= $pass;
			$_SESSION['40083514_FlyMemType']= $mymembertype;
			$_SESSION['40083514_FlyProPic']= $mypic;
			$_SESSION['40083514_FlyEmail']= $myemail;
			$_SESSION['40083514_FlyMemTypeName']= $mymembertypename;
			$_SESSION['40083514_FlyLikes']= $likes;
			
			//Birds
			$_SESSION['40083514_FlyUploadPic']=$uploadpic;
			
		}
		
		 header('Location: profile.php');
		}
		
	}else{
		header('Location: index.php');
		
	}

?>