<?php
	require "header.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>admin portal | spider</title>
	<style>
		#portal{
			width: 70%;
			margin-right: auto;
			margin-left: auto;
			padding-top: 10px;
			padding-left: 20px	
		}
		img{
			display: inline;
		}
	</style>
</head>
<body>
	<div id="portal">
		<a href="list_english_words.php"><img src="images/enword_logo.PNG" alt="enword" height="120" width="15%"></a>
		<a href="list_telugu_words.php"><img src="images/telword_log.PNG" alt="telword" height="120" width="15%"></a>
		<a href="list_crawled_urls.php"><img src="images/crawlurl_logo.PNG" alt="crawlurl" height="120" width="15%"></a>
		<a href="list_suggested_urls.php"><img src="images/suggest_logo.PNG" alt="suggest" height="120" width="15%"></a>
		<a href="user_admin.php"><img src="images/useradmin_logo.PNG" alt="useradmin" height="120" width="15%"></a><br />
		<a href=""><img src="images/configure_logo.PNG" alt="configure" height="120" width="15%"></a>
		<a href=""><img src="images/import_logo.PNG" alt="import" height="120" width="15%"></a>
		<a href=""><img src="images/export_logo.PNG" alt="export" height="120" width="15%"></a>
		<a href=""><img src="images/backup_logo.PNG" alt="backup" height="120" width="15%"></a>
		<a href=""><img src="images/help_logo.PNG" alt="help" height="120" width="15%"></a><br />
		<a href="telugu_characters_frequency_table.php?t=frequency"><img src="images/telegu_frequency_logo.PNG" alt="frequency" height="120" width="15%"></a>
		<a href="telugu_characters_frequency_table.php?t=null"><img src="images/telugu_count_logo.PNG" alt="count" height="120" width="15%"></a>
	</div>
</body>
</html>