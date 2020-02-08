<?php
   require "header.php";
   include('functions.php');
DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_DATABASE', 'crawler');
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');

   if(isset($_POST['submit'])){
       $firstName = trim($_POST['fName']);
       $lastName = trim($_POST['lName']);
       $email = trim($_POST['email']);
       $password = trim(sha1($_POST['pass']));
       $comfirmPassword = trim($_POST['comPass']);

       $url = "www.spider.microcustomized.com/activation.php?email=" . $email;
       $token = tokenGenerater();
       $validate_email = false;
       $email_message = "Thank you for register to spider.microcustomized.com. Please enter the code below to activate your account:\nSecure code: ". $token . "\n\nActivation Link: " . $url;
       $email_subject = "Spider Account Activation";
       $email_message = wordwrap($email_message,70);


       $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
       if (mysqli_connect_errno()) {
           echo("<p>Error creating Database Connection</p>");
           exit;
       }
          
       $sql = "select * from users";
       $sql2 = "insert into users values('$firstName', '$lastName', '$email', '$password', 'user', '2017-07-20 13:03:44', '$token', 'no', null);";
       
       $result = $conn->query($sql);

       if (!$result) {
           echo "Cannot create Database";
           exit;
       }
           
       $numRows = $result->num_rows;
       
       for($i = 0; $i < $numRows; $i++){
       		$row = $result->fetch_assoc();
       		
       		if(!strcasecmp($row[2], $email) == 0)
       			$validate_email = true;
       		else{
       			$validate_email = false;
       			break;
       		}
       }
       
       if($validate_email == true){
       		
       		$result2 = $conn->query($sql2);
       		
       		if(!$result2){
       			echo "Cannot Create Database88";
       			exit;
       		}
       		else{
           		mail($email,$email_subject,$email_message);
           		header("Location: /activation.php?email=$email");
           	}
       }
       else if($validate_email == false){
       		echo "Email Entered Already Used";
       }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register Form</title>
	<link href="" rel="stylesheet" type="text/css"/>
    	<script type="text/javascript" src="register.fns.js"></script>
</head>
<body>
    <div id="container">
        <div id="body">
            <form id="register-form" name="regForm" method="post" onsubmit="return inlineError()">
    		<fieldset>
        		<legend>Register Information</legend>
        		
        		<span id="message"><label class="star">*</label> Indicates required</span><br /><br />
        		<div id="fblock">
        			<label class="star">*</label>
        			<label id="fn">First Name:</label>
        			<input id="fName" name="fName" type="text" placeholder="First Name" pattern="([A-Za-z\s?])+" required >
        		</div>
        		<div id="lblock">
        			<label class="star">*</label>
        			<label id="ln">Last Name:</label>
        			<input id="lName" name="lName" type="text" placeHolder="Last Name" pattern="([A-Za-z\s?])+" required>
        		</div><br /><br />
        		<div id="emblock">
        			<label class="star">*</label>
        			<label id="email-label">E-mail:</label>
        		        <input id="e-mail" name="email" type="email" pattern="[^ @]*@[^ @]*" placeholder="sample@domain.com" required>
        		</div><br /><br />
        		<div id="psblock">
        			<label class="star">*</label>
        			<label id="pw-label">Password:</label>
        			<input id="pw" type="password" name="pass" maxlength="36" required>
        		</div>
        		<div id="cpwblock">
        			<label class="star">*</label>
        			<label id="cpw-label">Confirm Password:</label>
        			<input id="cpw" type="password" name="comPass" maxlength="36" required>
        		</div><br /><br />
        		<span id="passError"></span><br />
        		
        		<textarea id="terms" readonly>You agreed that you will not shared your login information to other people.</textarea><br /><br />
        		<input id="agree" name="agreeTerm" type="checkbox">Agree</input>
        		<input id="disagree" name="disagreeTerm" type="checkbox">Disagree</input>
        		<a href="Confirmation Page.php"></a><input id="regButton" name="submit" type="submit" value="Register"></a>
        		<span id="errorMessage"></span>
    		</fieldset
	</form>
        </div>
    </div>
</body>
</html>