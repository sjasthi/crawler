<?php
require "header.php";

// Bring in DB support.
require "db_fns.php";

$option = $_GET['t'];
//$col1 = "Serial No."; TODO
$col1 = "Character";
$col2 = "Count";
$message = "";

// Include the word processor file.
include('indic-wp-master/word_processor.php');

// When the "frequency" action has been executed...
if ($option == "frequency") {
    // Run frequency operation.
    calculateFrequencies();
}

// Run frequency operation.
function calculateFrequencies()
{
    // Query the telegu table and bring back every word.
    $conn = db_connect();
    $query = "SELECT * FROM telugu";
    $result = $conn->query($query);

    // Keep track of how many new words were parsed.
    $newlyParsedWordCount = 0;

    // If the query succeeds and results are returned...
    if ($result && $result->num_rows > 0) {

        // Create a word_processor instance.
        $language = "Telugu";
        $wordProcessor = new wordProcessor("", $language);

        // Loop through the telugu words...              
        for ($i = 0; $i < $result->num_rows; $i++) {
            $row = $result->fetch_array();

            // Only parse this word if it is not already counted.
            $counted = $row[5];
            if ($counted == 0) {

                // Get the Telugu word.
                $word = strtolower($row[1]);

                // Set the word_processor to process that word.
                $wordProcessor->setWord($word, $language);

                // Get the logical characters.
                $logical_characters = $wordProcessor->getLogicalChars();

                // Search for matches in the logical character array.
                for ($k = 0; $k < count($logical_characters); $k++) {

                    $character = $logical_characters[$k];

                    // Query the telugucount table.
                    $query = "SELECT * FROM telugucount WHERE ch = '" . $character . "'";
                    $queryResult = $conn->query($query);

                    // Indicate failure if failure exists...
                    if (!$queryResult) {
                        //echo "Searching telegucount DB failed :[";
                        continue;
                    }

                    // If the character is already in the table...                                    
                    if ($queryResult->num_rows > 0) {
                        $row = $queryResult->fetch_array();
                        $count = $row['ch_count'] + 1;

                        $updateQuery = "UPDATE telugucount SET ch_count = '" . $count . "' WHERE telugucount.ch = '" . $character . "'";
                        $conn->query($updateQuery);
                    }
                    // If the character is not already in the <table class=""></table>                    
                    else {
                        $insertQuery = "INSERT INTO telugucount (ch, ch_count) VALUES ('" . $character . "', '1')";
                        $conn->query($insertQuery);
                    }
                }

                // Increment 'counted'
                $newlyParsedWordCount += 1;
            }
        }
    }

    // Handle set 'counted'
    $updateQuery = "UPDATE telugu SET counted = '1'";
    $conn->query($updateQuery);

    // Inform the user on what has happened.
    global $message;
    $message = "Frequency calculation operation complete. ";
    if ($newlyParsedWordCount == 0) {
        $message .= "No new words were parsed.";
    } else if ($newlyParsedWordCount == 1) {
        $message .= "1 new word was parsed.";
    } else {
        $message .= "$newlyParsedWordCount new words were parsed.";
    }
}

?>

<!DOCTYPE html>

<html>

<head>
    <title>Telegu Count</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=c863b7da7e72b0e94c16b81c38293467">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

    <!-- JS -->
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            // Data table declaration that includes export buttons.
            $('#info').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                'order': [
                    [1, 'desc']
                ]
            });
        });
    </script>
</head>

<header>
    <link href="css/parse_style.css" rel="stylesheet" type="text/css" />
</header>

<body class="body_background" style="line-height: 2.8">
    <div id="wrap">
        <div class="container">
            <span id="message"><?php echo $message ?></span>
            <h3>Telegu Count</h3>

            <table id="info" cellpadding="0" cellspacing="0" class="display table table-striped table-bordered" width="100%">

                <thead>

                    <tr>

                        <?php

                        if (isset($col1)) {
                            echo "<th>$col1</th>";
                        }
                        if (isset($col2)) {
                            echo "<th>$col2</th>";
                        }
                        if (isset($col3)) {
                            echo "<th>$col3</th>";
                        }

                        ?>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    $dbcn = db_connect();

                    $dbcn->set_charset("utf8");
                    if (mysqli_connect_errno()) {
                        echo "<p>Error creating database connection: </p>";
                        exit;
                    }

                    // Query DB.
                    $sql = "SELECT * FROM telugucount ORDER BY ch_count DESC";
                    $result = $dbcn->query($sql);
                    if (!$result) {
                        echo "Cannot Create Database";
                        exit;
                    }

                    // If 1 or more results returned...
                    $numRows = $result->num_rows;
                    if ($numRows > 0) {

                        // ...Print results as rows in the table.
                        for ($i = 0; $i < $numRows; $i++) {
                            $row = $result->fetch_array();
                            $character = $row[0];
                            $character_count = $row[1];

                            print "
                                <tr>
                                    <td >$character</td>
                                    <td >$character_count</td>
                                </tr>";
                        }
                    }
                    // If no results were found in the DB...
                    else
                        echo "Empty Database";
                    ?>

                </tbody>

            </table>

        </div>

    </div>
</body>

</html>