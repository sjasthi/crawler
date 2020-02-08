<?php 
	require "header.php";
	$email = $_GET['edit'];
	$table = $_GET['t'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$new_email = $_POST['email'];
	$password = sha1($_POST['pass']);
	$privilege = "";
	$active = "";
DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_DATABASE', 'crawler');
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');
	
	if(isset($_POST['privilege'])){
		$privilege = $_POST['privilege'];	
	}
	
	if(isset($_POST['active'])){
		$active = $_POST['active'];
	}
	
if(isset($_POST['edit-user'])){

    $connect = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $connect -> set_charset("utf8");
	if(mysqli_connect_errno()){
        	echo "<p>Error creating database connection: </p>";
        	exit;
    	}
    	
    	if($new_email != ""){
    		$sql = "update users set email='$new_email' where email='$email';";
    		$result = $connect->query($sql);
    		if(!$result){
    			echo "cannot create users database";
    			exit;
    		}
    		
    		$email = $new_email;
    	}
    	
    	
    	if($fname != ""){
    		$sql2 = "update users set fname='$fname' where email='$email';";
    		$result2 = $connect->query($sql2);
    		if(!$result2){
    			echo "cannot create users database";
    			exit;
    		}
    	}
    	
    	if($lname != ""){
    		$sql3 = "update users set lname='$lname' where email='$email';";
    		$result3 = $connect->query($sql3);
    		if(!$result3){
    			echo "cannot create users database";
    			exit;
    		}
    	}
    	
    	if($password != ""){
    		$sql4 = "update users set pass='$password' where email='$email';";
    		$result4 = $connect->query($sql4);
    		if(!$result4){
    			echo "cannot create users database";
    			exit;
    		}
    	}
    	
    	if($privilege != ""){
    		$sql6 = "update users set privilege='$privilege' where email='$email';";
    		$result6 = $connect->query($sql6);
    		if(!$result6){
    			echo "cannot create users database";
    			exit;
    		}
    	}
    	
    	if($active != ""){
    		$sql7 = "update users set active='$active' where email='$email';";
    		$result7 = $connect->query($sql7);
    		if(!$result7){
    			echo "cannot create users database";
    			exit;
    		}
    	}
    	
    	
    	header("Location: /list.php?t=users");
    			
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>user edit | spider</title>
	<style>
		form{
			margin-left: 20px;
			margin-top: 20px;
		}
	</style>
</head>
<body>
	<form action="<? $_SERVER['PHP_SELF'] ?>" method="post" name="edit-user">
		<label>Email:</label>
		<input type="text" id="email-text" name="email" placeholder="sample@email.com"><br />
		<label>First Name:</label>
		<input type="text" id="first" name="fname" placeholder="First Name"><br />
		<label>Last Name:</label>
		<input type="text" id="last" name="lname" placeholder="Last Name"><br />
		<label>Password:</label>
		<input type="text" id="pwordt" name="pass" placeholder="New Password"><br />
		<label>Privilege: </label>
		<input type="radio" name="privilege" value="user"><label>User</label>
		<input type="radio" name="privilege" value="admin"><label>Administrator</label></br >
		<label>Active: <label>
		<input type="radio" name="active" value="yes" ><label>Yes</label>
		<input type="radio" name="active" value="no"><label>No</label><br />
		<input id="act-submit" name="edit-user" type="submit" value="edit">
	</form>
</body>
</html>
