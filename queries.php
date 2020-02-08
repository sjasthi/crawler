<?php
require ('db_fns.php');
header('Content-Type: text/html; charset=utf-8');

$queryDropdown = $_POST['queryOptions'];

function getCount($query){
    $conn = db_connect();
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        $result = db_result_to_array($result);
        return count($result);
    }
}


function showQueryResults($query){
    $conn = db_connect();
    //$query = "select * from teluguwords where word LIKE '%{$queriedResult}%' AND length(word) <= $inputLength";
    $result = $conn->query($query);

    echo "<table>"; // start a table tag in the HTML

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['word'] . "</td><td>";  //$row['index'] the index here is a field name
    }

    echo "</table>"; //Close the table in HTML
}

function showURLQueryResults($query){
    $conn = db_connect();
    //$query = "select * from teluguwords where word LIKE '%{$queriedResult}%' AND length(word) <= $inputLength";
    $result = $conn->query($query);

    echo "<table>"; // start a table tag in the HTML

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['crawledurl'] . "</td><td>";  //$row['index'] the index here is a field name from the database
    }

    echo "</table>"; //Close the table in HTML
}


?>

<div id="container">
    <div id="body">
        <div id="indexDiv"><h1>Get Queries</h1>
            <form action="<?=$_SERVER['PHP_SELF']; ?>" method="POST" id="queryForm">
                <label class="queryLabels">Select all from:</label>
                </br><select id="queryOptions" name="queryOptions" required>
                    <option value="">Select...</option>
                    <option value="urls"  selected="selected">URLs</option>
                    <option value="eng">English Words</option>
                    <option value="tel">Telugu Words</option>
                </select>
               </br></br><input type="submit" id="queryButton" name="queryButton" value="Run Query"/></form>

            <div>
                <span class="userMessage"><br/><?php echo $messagePrompt;?></span>
                <div>
                    <?php
                    if(isset ($_POST["queryButton"])){
                        if ($queryDropdown === "urls") {
                            echo $messagePrompt = "Found " . getCount("select crawledurl from CRAWLURL") . " URLs in the database!";
                            showURLQueryResults("select crawledurl from CRAWLURL");

                        }
                        elseif($queryDropdown === "eng") {
                            echo $messagePrompt = "Found " . getCount("select * from englishwords") . " English words in the database!";
                            showQueryResults("select * from englishwords order by word");
                        }
                        elseif($queryDropdown === "tel") {
                            echo $messagePrompt = "Found " . getCount("select * from teluguwords") . " Telugu words in the database!";
                            showQueryResults("select * from teluguwords order by word COLLATE utf8_bin");
                        }
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>
</div>