<?php
require "header.php";

$edit = $_GET['edit'];
$new_word = $_POST['new-word'];
$id = $_GET['id'];
$option = $_GET['t'];
$t_id = "";
$set_col = "";

// Bring in DB support.
require "db_fns.php";

if ($option == "english") {
	$t_id = "en_id";
	$set_col = "word";
} else if ($option == "telugu") {
	$t_id = "tel_id";
	$set_col = "word";
} else if ($option == "crawlurl") {
	$t_id = "id";
	$set_col = "crawledurl";
} else if ($option == "suggesturl") {
	$t_id = "id";
	$set_col = "suggestedurl";
}

if (isset($_POST['edit'])) {
	$connect = db_connect();
	$connect->set_charset("utf8");
	if (mysqli_connect_errno()) {
		echo "<p>Error creating database connection: </p>";
		exit;
	}

	$query = "update $option set $set_col='" . $new_word . "' where $t_id='" . $id . "';";
	$result = $connect->query($query);
	if (!$result) {
		echo "Cannot create database";
		exit;
	}

	mysqli_close($connect);
	echo "successfully edit";
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>edit | spider</title>
	<style>
		form {
			margin-left: 20px;
			margin-top: 20px;
		}
	</style>
</head>

<body>
	<form action="<? $_SERVER['PHP_SELF'] ?>" method="post" name="edit-form">
		<span><Strong>Edit Word: </Strong><?php echo $edit ?> <Strong>to</Strong></span>
		<input type="text" id="activation-text" name="new-word" placeholder="Enter new word">
		<input id="act-submit" name="edit" type="submit" value="edit">
	</form>
</body>

</html>