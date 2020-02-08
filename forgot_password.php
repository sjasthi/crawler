<?php
	require "header.php";
	include ("functions.php");
	$email = stripslashes($_POST['email']);
	$con_email = stripslashes($_POST['confirm-email']);
	$token = tokenGenerater();
	$process = false;
DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_DATABASE', 'crawler');
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');

	if(isset($_POST['password-resend'])){
		$email = stripslashes($_GET['resend']);
	}
	
	if (isset($_POST['fgot-password']) || isset($_POST['password-resend'])){



	    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
       		if (mysqli_connect_errno()) {
           		echo("<p>Error creating Database Connection</p>");
           		exit;
       		}
       		
       		$sql = "select * from users where email='$email';";
       		$result = $conn->query($sql);
       		
       		if ((!$result)) {
           		echo "Cannot create Database";
           		exit;
       		}
       		
       		if($email === $con_email){
       			$sql2 = "UPDATE users SET token='$token', active='no' WHERE email='$email';";
       			$result2 = $conn->query($sql2);
       			if((!$result)){
       				echo "Cannot Create Database";
       				exit;
       			}
       			
       			$process = true;
       			$url = "www.spider.microcustomized.com/password_reset?email=" . $email . "&token=" . $token;
       			$email_message = "To reset password please click on the link below\n\n$url";
       			$email_subject = "Spider Password Reset";
       			$email_message = wordwrap($email_message,70);
       			mail($email,$email_subject,$email_message);
       		}
       		else
       			echo "Email not Match" . $email . " " . $con_email;
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
			width: 120px;
		}
		legend{
			font-size: 14pt;
			font-weight: bold;
		}
		a{
			text-decoration: none;
		}
	</style>
</head>
<body>
	<form action="<? $_SERVER['PHP_SELF'] ?>" method="post" name="forgot_password_form">
	
		<?php
			if($process == false)
				print "
					<legend>Forgot Password Retrieve</legend><br />
					<label id='email-label'>Email:</label>
					<input type='email' name='email' pattern='[^ @]*@[^ @]*' placeholder='sample@domain.com' required><br /><br />
       					<label id='confirm-email-label'>Confirm Email:</label>
       					<input name='confirm-email' type='email' pattern='[^ @]*@[^ @]*' placeholder='sample@domain.com' required>
       					<input id='submit-forgot' name='fgot-password' type='submit' value='Send'>
				";
			else{
				print "
					<span>Message has been sent to " . $email . "<br />
					If you don't see the message click</span>
					<a href='forgot_password.php' name='password-resend'>Resend</a>";
				
			}
						
		?>
	</form>
</body>
</html>

<?php 
	require "footer.php";
?>