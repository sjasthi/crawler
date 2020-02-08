<?php 
	require "header.php";
	
	$password = $_POST['password'];
	$encrypted_pass = sha1($_POST['password']);
	$con_password = $_POST['confirm-password'];
	$email = $_GET['email'];
	$token = $_GET['token'];

DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_DATABASE', 'crawler');
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');
	
	if(isset($_POST['reset-password'])){
		$dbcn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
		$sql2 = "select * from users where email='$email' AND token='$token' AND active='no';";
		$sql = "update users set pass='$encrypted_pass', active='yes' where email='$email' AND token='$token';";
		
		$result2 = $dbcn->query($sql2);
		if(!result2){
			echo "Cannot create Database";
			exit;
		}
		
		$numRows = $result2->num_rows;
		
		if($password === $con_password && $numRows > 0){
			$result = $dbcn->query($sql);
			if(!$result){
				echo "Cannot create Database";
				exit;
			}
			else{
				header("Location: /login.php");
			}
		}
		else if($password === $con_password & $numRows <= 0)
			echo "Password Reset Expired";
		else
			echo "Password not Matched";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password | Spider</title>
	<style type="text/css" rel="stylesheet">
		form{
			margin-left: 30px;
			margin-top: 30px;
			border: 2px solid red:
		}
		label{
			display: inline-block;
			width: 150px;
		}
		legend{
			font-size: 14pt;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<form action="<? $_SERVER['PHP_SELF'] ?>" method="post" name="reset_password_form">
		<legend>Reset Password</legend><br />
		<label id="password-label">New Password:</label>
       		<input type="text" name="password" required><br /><br />
       		<label id="confirm-password-label">Confirm Password:</label>
       		<input name="confirm-password" type="text" required>
       		<input id="submit-reset-password" name="reset-password" type="submit" value="Reset">
	</form>
</body>
</html>

<?php 
	require "footer.php";
?>




