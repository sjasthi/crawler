<?php 
	require "header.php";

	DEFINE('DATABASE_HOST', 'localhost');
	DEFINE('DATABASE_DATABASE', 'crawler');
    DEFINE('DATABASE_USER', 'root');
    DEFINE('DATABASE_PASSWORD', '');



	
	$option = $_GET['t'];
	$col1 = "";
	$col2 = "";
	$action = (isset($_GET['action']));
	$delete_op = (isset($_GET['doption']));
	$col_attr ="";
	
	if($option === "english" || $option === "telugu"){
		$col1 = "Word";
		$col2 = "Length";
		$col_attr = "word";
	}
	else if($option === "users"){
		$col1 = "Full Name";
		$col2 = "Email";
		$col_attr = "email";
	}
	else if($option === "crawlurl" || $option === "suggesturl"){
		$col1 = "URL";
		$col2 = "Last Modified";
		$col_attr = "id";
	}
	
	if($action == "delete"){
		$connect = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
		$connect -> set_charset("utf8");
		if(mysqli_connect_errno()){
        	echo "<p>Error creating database connection: </p>";
        		exit;
    		}	
		$query = "delete from $option where $col_attr = '" . $delete_op ."';";
		$re = $connect->query($query);
		if(!$re){
			echo "Cannot create delete database";
			exit;
		}
				
	}
?>
<!DOCTYPE html>

<html>

<head>
<title>list | spider</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>

		<script type="text/javascript">

		$(document).ready(function() {

  $('#info').DataTable();

});

		</script>
</head>
<body class="body_background" style="line-height: 2.8">
	<div id="wrap">

			<div class="container">

            <h3>English Words in Database</h3>

				<table id="info" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered" width="100%">

					<thead>

						<tr>

							<th><?php echo $col1; ?></th>

							<th><?php echo $col2; ?></th>

							<th>Action</th>

						</tr>

					</thead>

<tbody>

<?php

    $dbcn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

	$dbcn -> set_charset("utf8");
	if(mysqli_connect_errno()){
        	echo "<p>Error creating database connection: </p>";
        		exit;
    		}
    			
	$sql = "select * from $option";
	$result = $dbcn->query($sql);
	if(!$result){
	echo "Cannot Create Database";
	exit;
	}
			
	$numRows = $result->num_rows;
	if($numRows > 0){
		for($i = 0; $i < $numRows; $i++){
			$row = $result->fetch_array();
			if($option === "english" || $option === "telugu"){
				$word = strtolower($row[1]);
				$length = $row[2];
				$id = $row[0];
				
				print "
				<tr>
					<td class='word'>$word</td>
					<td class='length'>$length</td>
					<td class='edit'><a href='edit.php?edit=$word&id=$id&t=$option'>edit</a> | <a href='list.php?action=delete&t=$option&doption=$word'>delete</a></td>
				</tr>";
			}
			else if($option === "users"){
				$fname = $row[0];
				$lname = $row[1];
				$email = $row[2];

				print "
				<tr>
					<td class='word'>$lname, $fname</td>
					<td class='length'>$email</td>
					<td class='edit'><a href='edit_user.php?edit=$email&t=users'>edit</a> | <a href='list.php?action=delete&t=users&doption=$email'>delete</a></td>
				</tr>";
			}
			else if($option === "crawlurl" || $option === "suggesturl"){
				$url = $row[1];
				$date_modified = $row[2];
				$url_id = $row[0];
				
				print "
				<tr>
					<td class='word'>$url</td>
					<td class='length'>$date_modified</td>
					<td class='edit'><a href='edit.php?edit=$url&t=$option&id=$url_id'>edit</a> | <a href='list.php?action=delete&t=$option&doption=$url_id'>delete</a></td>
				</tr>";
			}
		}
	}
	else
		echo "Empty Database";	
		
?>

  </tbody>

	<tfoot>

		<tr>

			<th><?php echo $col1; ?></th>

			<th><?php echo $col2; ?></th>

			<th>Action</th>

		</tr>

	</tfoot>

	</table>

	</div>

	</div>
</body>
</html>
