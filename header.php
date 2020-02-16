<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <link href="css/style.css" rel="stylesheet" type="text/css"/></head>
<table width="100%" border="0" cellspacing="0" class="headerTable">
    <tr>
        <td rowspan="2">
            <a href="index.php"><img src="images/silc_logo.jpg" width="100%" ></a>
        </td>
    </tr>
</table>
<table width="100%" cellspacing="0" class="menubar" id="menu-table">
    <?php
    if(!isset($_SESSION)){
        session_start();
    }
    if (isset($_SESSION['loggedIn']) == "adminIN"){
        print "
    			 <tr>
				<td align='left' valign='bottom'>
            				<a href='index.php'>Home</a>
        			</td>
            			<td align='left' valign='bottom'>
            				<a href='searchDB.php'>Search DB</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='parse.php'>Parse</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='suggestURL.php'>Suggest URL</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='stats.php'>Summary</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='crawl.php'>Crawl</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='admin.php'>Admin</a>
        			</td>
        			<td aligh='left' valign='bottom'>
            				<a href='logout.php'>Log Out</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='about.php'>About</a>
        			</td>
		    </tr>
    		";
    	}
    	else if (isset($_SESSION['loggedIn']) == "userIN"){
        print "
    			<tr>
				<td align='left' valign='bottom'>
            				<a href='index.php'>Home</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='searchDB.php'>Search DB</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='list.php'>List View</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='suggestURL.php'>Suggest URL</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='stats.php'>Summary</a>
        			</td>
        			<td aligh='left' valign='bottom'>
            				<a href='logout.php'>Log Out</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='about.php'>About</a>
        			</td>
		    </tr>
    		";
    	}
    	else{
        print "
    			<tr>
				<td align='left' valign='bottom'>
            				<a href='index.php'>Home</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='searchDB.php'>Search DB</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='suggestURL.php'>Suggest URL</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='stats.php'>Summary</a>
        			</td>
        			<td aligh='left' valign='bottom'>
            				<a href='login.php'>Log In</a>
        			</td>
        			<td align='left' valign='bottom'>
            				<a href='about.php'>About</a>
        			</td>
		    </tr>
    		";
    	}

    ?>
</table>
</html>