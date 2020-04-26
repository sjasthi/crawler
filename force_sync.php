<?php

// ================ Includes ================

// Include the word processor file.
include('indic-wp-master/word_processor.php');
include('indic-wp-master/telugu_parser.php');

echo '<link href="css/parse_style.css" rel="stylesheet" type="text/css" />';

require "header.php";
require "db_fns.php";

// ================ Variables ================

$headerMessage = "";
$headerColor = "#ffae42";

// ================ Operations ================

// Perform sync operations requested by the user.
runSync();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Force Sync</title>
</head>

<body>
    <!-- Message -->
    <div class="text-center" style="width: 500px; height:30px; margin: 0 auto; margin-top: 25px; margin-bottom:25px; background-color:<?php echo $headerColor ?>; color: white;"><?php echo $headerMessage; ?></div>

    <?php

    // Reset message.
    $headerColor = "#ffae42";
    $headerMessage = "";

    ?>

    <!-- Form -->
    <div class="text-center" style="border:1px solid; Width: 500px; margin: 0 auto;">
        <h2>Force Sync</h2>

        <form method="post">
            <!-- Length -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="sync_length" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Length
                </label>
            </div>

            <!-- Strength -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="sync_strength" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Strength
                </label>
            </div>

            <!-- Weight -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="sync_weight" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Weight
                </label>
            </div>

            <!-- Character Frequency -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" name="sync_frequency" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Character Frequency
                </label>
            </div><br><br>

            <!-- Submit -->
            <button type="submit" class="btn btn-outline-warning" style="margin-bottom: 10px;">Sync</button>
        </form>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>

<!-- FUNCTIONS -->
<?php

// Retrives words from the DB.
function getWords()
{
    global $headerMessage;
    global $headerColor;

    // Establish db connection.
    $dbcn = db_connect();

    // Get all Telugu words.
    $sql = "SELECT * FROM telugu";

    // Run query.
    $result = $dbcn->query($sql);
    if (!$result) {
        $headerMessage = "Failed to query DB";
        $headerColor = "pink";
    }

    return $result;
}

// Performs the actual sync operations.
function runSync()
{
    if (isset($_POST['sync_length'])) $sync_length = $_POST['sync_length'];
    if (isset($_POST['sync_strength'])) $sync_strength = $_POST['sync_strength'];
    if (isset($_POST['sync_weight'])) $sync_weight = $_POST['sync_weight'];
    if (isset($_POST['sync_frequency'])) $sync_frequency = $_POST['sync_frequency'];

    global $headerColor;
    global $headerMessage;

    // Set to true if any operation is performed.
    // Used when setting the message for the user.
    $syncExecuted = false;

    // Establish db connection.
    $dbcn = db_connect();

    // sync_length operation
    if (isset($sync_length)) {

        // An operation is being performed.
        // Used when setting the message for the user.
        $syncExecuted = true;

        // Retrive all Telugu words from the DB.
        $result = getWords();

        // How many rows were retrieved?
        $numRows = $result->num_rows;

        // If any were found...
        if ($numRows > 0) {

            // Perform the operation each word.        
            for ($i = 0; $i < $numRows; $i++) {
                $row = $result->fetch_array();
                $id = $row['tel_id'];
                $word = $row['word'];

                // Find the word's length.
                $tcount = parseToLogicalCharacters($word);
                $len = count($tcount);

                // Update that value in the DB.
                $sql = "UPDATE `telugu` SET `char_len` = '$len' WHERE `telugu`.`tel_id` = $id";
                $dbcn->query($sql);
            }
        }
    }

    // sync_strength operation
    if (isset($sync_strength)) {

        // An operation is being performed.
        // Used when setting the message for the user.
        $syncExecuted = true;

        // Retrive all Telugu words from the DB.
        $result = getWords();

        // How many rows were retrieved?
        $numRows = $result->num_rows;

        // If any were found...
        if ($numRows > 0) {

            // Perform the operation each word.        
            for ($i = 0; $i < $numRows; $i++) {
                $row = $result->fetch_array();
                $id = $row['tel_id'];
                $word = $row['word'];

                // Find the word's strength.
                $processor = new wordProcessor($word, 'telugu');
                $strength = $processor->getWordStrength('telugu');

                // Update that value in the DB.
                $sql = "UPDATE `telugu` SET `strength` = '$strength' WHERE `telugu`.`tel_id` = $id";
                $dbcn->query($sql);
            }
        }
    }

    // sync_weight operation
    if (isset($sync_weight)) {
        
        // An operation is being performed.
        // Used when setting the message for the user.
        $syncExecuted = true;

        // Retrive all Telugu words from the DB.
        $result = getWords();

        // How many rows were retrieved?
        $numRows = $result->num_rows;

        // If any were found...
        if ($numRows > 0) {

            // Perform the operation each word.        
            for ($i = 0; $i < $numRows; $i++) {
                $row = $result->fetch_array();
                $id = $row['tel_id'];
                $word = $row['word'];

                // Find the word's weight.
                $processor = new wordProcessor($word, 'telugu');
                $weight = $processor->getWordWeight('telugu');

                // Update that value in the DB.
                $sql = "UPDATE `telugu` SET `weight` = '$weight' WHERE `telugu`.`tel_id` = $id";
                $dbcn->query($sql);
            }
        }
    }

    // sync_frequency operation
    if (isset($sync_frequency)) {
        
        // An operation is being performed.
        // Used when setting the message for the user.
        $syncExecuted = true;

        // Clear existing values in telugu_count table.
        $sql = "DELETE FROM `telugucount`";
        $dbcn->query($sql);

        // Retrive all Telugu words from the DB.
        $result = getWords();

        // How many rows were retrieved?
        $numRows = $result->num_rows;

        // If any were found...
        if ($numRows > 0) {

            // Perform the operation each word.        
            for ($i = 0; $i < $numRows; $i++) {
                $row = $result->fetch_array();
                $id = $row['tel_id'];
                $word = $row['word'];

                // Set processor onto this word.
                $processor = new wordProcessor($word, 'telugu');

                // Get the logical characters.
                $logical_characters = $processor->getLogicalChars();

                // Search for matches in the logical character array.
                for ($k = 0; $k < count($logical_characters); $k++) {

                    $character = $logical_characters[$k];

                    // Query the telugucount table.
                    $query = "SELECT * FROM telugucount WHERE ch = '" . $character . "'";
                    $queryResult = $dbcn->query($query);

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
                        $dbcn->query($updateQuery);
                    }
                    // If the character is not already in the <table class=""></table>                    
                    else {
                        $insertQuery = "INSERT INTO telugucount (ch, ch_count) VALUES ('" . $character . "', '1')";
                        $dbcn->query($insertQuery);
                    }
                }
            }
        }
    }

    // If the header message isn't set at this point, all operations were a success.
    // Indicate as much to the user.
    if ($syncExecuted && $headerMessage == "") {
        $headerMessage = "Operation succeeded!";
        $headerColor = "lightgreen";
    }
}

?>