<?php

// ============== Includes ==============

// Bring in DB support.
require "db_fns.php";

// Search functions
require "search_fns.php";

// ============== Variables ==============

$user_search_string;
$type = "";

if (isset($_GET['input'])) $user_search_string = $_GET['input'];
if (isset($_GET['type'])) $type = $_GET['type'];

// Set session searchPage variable.
$_SESSION['searchPage'] = "lucky";

// IMPORTANT: User search string
$user_search_string = stripslashes($user_search_string);
$user_search_string = preg_replace('/^[\s]+$/', '', $user_search_string);
$user_search_string = explode(" ", $user_search_string);
$user_search_string = implode($user_search_string);

// Determine what category of search is being requested. 
// Possible results -> "C", "D", "E", or "F"
$category = substr($type, 0, 1);

// If the $type input is invalid or missing...
if ($category != "C" && $category != "D" && $category != "E" && $category != "F") {
    // ... insert default value.
    $type = "F2";

    // Determine what category of search is being requested. 
    // Possible results -> "C", "D", "E", or "F"
    $category = substr($type, 0, 1);
}

// ============== Operations ==============

// Connect to DB.
$connection = db_connect();

// Run query.
$query = "SELECT * FROM telugu";
$queryResult = $connection->query($query);
if (!$queryResult) {
    echo "An error occurred during the query operation :{";
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Search Results</title>
</head>

<body>

    <?php

    // If 1 or more results returned...
    $numRows = $queryResult->num_rows;
    if ($numRows > 0) {        

        echo "<h2>Search Results</h2>";

        // ...Print results as rows in the table.
        for ($i = 0; $i < $numRows; $i++) {
            $row = $queryResult->fetch_array();

            // For some categories, the two languages can use the same
            // filter functions. For others, they must be different.
            switch ($category) {
                case "C":
                    sharedSearch($row, $user_search_string, $type);
                    break;
                case "D":
                    teluguSearch($row, $user_search_string, $type);
                    break;
                case "E":
                    teluguSearch($row, $user_search_string, $type);
                    break;
                case "F":
                    teluguSearch($row, $user_search_string, $type);
                    break;
            }
        }
    }
    else{
        echo "No results found :(";
    }

    ?>

</body>

</html>