<?php
require "header.php";
include('search_fns.php');
include('indic-wp-master/word_processor.php');
include('indic-wp-master/telugu_parser.php');

$searchDropdown = isset($_POST['searchOptions']);
$searchRadio =  isset($_POST['langRadio']);
$input = "@#$";
$message = "No Result Found";
$word = "";
$language = "english";
$option = "contains";
$contain_value = 1;
$prefix = "prefix";
$suffix = "suffix";
$min_letter = 2;
$max_letter = 10;
$result_limit = isset($_POST['limit']);
$relimit = 100;
$class = new wordProcessor($word, $language);

?>

<?php
if (isset($_POST['search'])) {

    if (isset($_POST['language'])) {
        $language = $_POST['language'];
    }

    if (isset($_POST['option'])) {
        $option = $_POST['option'];

        if (isset($_POST['spinner1'])) {
            $contain_value = $_POST['spinner1'];
        }
    }

    if (isset($_POST['spinner2'])) {
        $min_letter = $_POST['spinner2'];
    }

    if (isset($_POST['spinner3'])) {
        $max_letter = $_POST['spinner3'];
    }

    if (isset($_POST['limit'])) {
        $result_limit = $_POST['limit'];
    }


    $input = stripslashes($_POST['search-bar']);
    $input = preg_replace('/^[\s]+$/', '', $input);
    $input = explode(" ", $input);
    $input = implode($input);
}
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <link href="css/search_style.css" rel="stylesheet" type="text/css" />
</header>

<body>
    <div id="container">
        <div id="body">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" id="searchForm" autocomplete="off">
                <div id="filter">
                    <label>Select Language</label><br>
                    <input type="radio" name="language" value="english" id="rad-1" checked <?php if (isset($_POST['language']) && $_POST['language'] == 'english') echo ' checked="checked"'; ?>>English<br>
                    <input type="radio" name="language" value="telugu" id="rad-2" <?php if (isset($_POST['language']) && $_POST['language'] == 'telugu') echo ' checked="checked"'; ?>>Telugu<br><br>

                    <label>Search By</label><br>
                    <input type="radio" name="option" value="contains-sub" id="rad-3" checked <?php if (isset($_POST['option']) && $_POST['option'] == 'contains-sub') echo ' checked="checked"'; ?>>Contains substring<br />
                    <input type="radio" name="option" value="contains-subs" id="rad-4" <?php if (isset($_POST['option']) && $_POST['option'] == 'contains-subs') echo ' checked="checked"'; ?>>Contains substrings<br />

                    <input type="radio" name="option" value="contains" id="rad-5" <?php if (isset($_POST['option']) && $_POST['option'] == 'contains') echo ' checked="checked"'; ?>>Contains Characters<br />
                    <input type="radio" name="option" value="contains-at" id="rad-6" <?php if (isset($_POST['option']) && $_POST['option'] == 'contains-at') echo ' checked="checked"'; ?>>Contains Character at
                    <input type="number" name="spinner1" value=<?php echo $contain_value ?> id="contain_spinner" min="1" max="99" size="6"><br>
                    <input type="radio" name="option" value="prefix" id="rad-7" <?php if (isset($_POST['option']) && $_POST['option'] == 'prefix') echo ' checked="checked"'; ?>>Prefix<br>
                    <input type="radio" name="option" value="suffix" id="rad-8" <?php if (isset($_POST['option']) && $_POST['option'] == 'suffix') echo ' checked="checked"'; ?>>Suffix<br>
                    <input type="radio" name="option" value="whole" id="rad-9" <?php if (isset($_POST['option']) && $_POST['option'] == 'whole') echo ' checked="checked"'; ?>>Whole words<br><br>

                    <label>Length of words</label><br>
                    Minimum <input type="number" name="spinner2" value=<?php echo $min_letter ?> id="letter_spiner1" min="2" max="99"><br>
                    Maximum <input type="number" name="spinner3" value=<?php echo $max_letter ?> id="letter_spiner2" min="2" max="10"><br><br>

                    <label>Result Limit</label>
                    <input type="number" name="limit" value=<?php echo $relimit ?> min="1" max="100">

                </div>

                <div id="search-bar-pane">
                    <input type="text" id="search-bar" name="search-bar" placeholder="Enter Search Criteria" <?php if (isset($_POST['search-bar'])) {
                                                                                                                    echo "value='" . $_POST['search-bar'] . "'";
                                                                                                                } ?>>
                    <button type="sumit" id="search-button" value="search" name="search">
                        <img src="images/search.png" alt="Search Icon" height="42" width="42">
                    </button>
                </div>
            </form>

            <div id="display">

                <!-- Results -->
                <table id="result-table">
                    <!-- Header -->
                    <tr>
                        <td colspan="2" id="table-header">Result Words</td>
                    </tr>

                    <!-- Processing User Request -->
                    <?php

                    // Process search criteria.
                    if ($language == "english" && $option == "contains-subs") {
                        $input = explode(",", $input);
                        $input = implode($input);
                    }

                    if ($language == "english" && $option === "contains") {
                        $input = explode(" ", $input);
                        $input = implode($input);
                    }

                    if ($language == "telugu" && $option == "contains-subs") {
                        $input = explode(",", $input);
                        $input = implode($input);
                    }

                    if ($language == "telugu" && $option == "contains") {
                        $input = explode(" ", $input);
                        $input = implode($input);
                    }

                    // Connect to DB
                    DEFINE('DATABASE_HOST', 'localhost');
                    DEFINE('DATABASE_DATABASE', 'crawler');
                    DEFINE('DATABASE_USER', 'root');
                    DEFINE('DATABASE_PASSWORD', '');
                    $dbcn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
                    $dbcn->set_charset("utf8");
                    if (mysqli_connect_errno()) {
                        echo "<p>Error creating database connection</p>";
                        exit;
                    }

                    // Get all English and Telugu words within the specified word length range.
                    $sql = "SELECT E.en_id, E.word, E.char_len FROM english AS E WHERE E.char_len >= $min_letter AND E.char_len <= $max_letter UNION 
                        SELECT T.tel_id, T.word, T.char_len FROM telugu AS T WHERE T.char_len >= $min_letter AND T.char_len <= $max_letter";
                    $result = $dbcn->query($sql);
                    if (!$result) {
                        echo ("<p>Unable to query database at this time.</p>");
                        exit;
                    }

                    // How many rows were retrieved.
                    $numRows = $result->num_rows;

                    // If any were found...
                    if ($numRows > 0) {
                        $index = $numRows;
                        $no_result_found = 0;
                        $limit_conat = 0;
                        $limit_con = 0;
                        $limit_pre = 0;
                        $limit_suf = 0;
                        $limit_whole = 0;
                        $count = 0;

                        // Loop over each row.
                        for ($i = 0; $i < $index; $i++) {

                            // Collect substrings from the word to be compared
                            // against the user's search criteria.
                            // $row[1] is the word.
                            $row = $result->fetch_array();
                            $prefix_string = substr($row[1], 0, strlen($input));
                            $suffix_string = substr($row[1], (strlen($row[1]) - strlen($input)));
                            $contain_at = $row[1]{
                            $contain_value - 1};
                            $row[1] = strtolower($row[1]);

                            // If the Telugu language is selected...
                            if ($language === "telugu") {

                                // Parse the word (from the DB) into logical characters.
                                $word_from_db = parseToLogicalCharacters($row[1]);

                                // Parse the user's input (search criteria) into logical characters.
                                $user_search_string = parseToLogicalCharacters($input);

                                // Handle encounters with unknown characters.
                                if (count($word_from_db) > $contain_value - 1) {
                                    $contain_at = $word_from_db[$contain_value - 1];
                                }

                                // =========================================================================
                            }

                            if ($input === "") {
                                $no_result_found = 0;
                            } else if ($language == "english" && strcasecmp($contain_at, $input) == 0 && $option === "contains-at" && $limit_con < $result_limit) {
                                echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                $no_result_found++;
                                $limit_con++;
                            } else if ($language == "telugu" && $option === "contains-at" && $limit_con < $result_limit && isset($word_from_db[0]) && $word_from_db[$contain_value - 1] == $user_search_string[0]) {
                                echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                $no_result_found++;
                                $limit_con++;
                            } else if ($language == "english" && strcasecmp($prefix_string, $input) == 0 && $option === "prefix" && $limit_pre < $result_limit) {
                                echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                $no_result_found++;
                                $limit_pre++;
                            } else if ($language == "telugu" && $option === "prefix" && $limit_pre < $result_limit) {
                                // For each prefix character...
                                $match = true;
                                if (isset($word_from_db[0])) {
                                    for ($i = 0; $i < count($user_search_string); $i++) {
                                        //... compare against characters in the word from the DB.
                                        if ($word_from_db[$i] != $user_search_string[$i]) {
                                            // No match. break.
                                            $match = false;
                                            break;
                                        }
                                    }
                                } else {
                                    $match = false;
                                }

                                // If successful...
                                if ($match == true) {
                                    echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                    $no_result_found++;
                                    $limit_pre++;
                                }
                            } else if ($language == "english" && strcasecmp($suffix_string, $input) == 0 && $option === "suffix" && $limit_suf < $result_limit) {
                                echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                $no_result_found++;
                                $limit_suf++;
                            } else if ($language == "telugu" && strcasecmp($suffix_string, $input) == 0 && $option === "suffix" && $limit_suf < $result_limit) {
                                // For each suffix character...
                                $match = true;
                                $search_string_length = count($user_search_string) - 1;
                                $word_from_db_length = count($word_from_db) - 1;
                                if (isset($word_from_db[0])) {
                                    for ($i = 0; $i < count($user_search_string); $i++) {
                                        //... compare against characters in the word from the DB.
                                        if ($word_from_db[$word_from_db_length - $i] != $user_search_string[$search_string_length - $i]) {
                                            // No match. break.
                                            $match = false;
                                            break;
                                        }
                                    }
                                } else {
                                    $match = false;
                                }

                                // If successful...
                                if ($match == true) {
                                    echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                    $no_result_found++;
                                    $limit_suf++;
                                }
                            } else if ($language == "english" && strcasecmp($row[1], $input) == 0 && strcasecmp($option, "whole") == 0 && $limit_whole < $result_limit) {
                                echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                $no_result_found++;
                                $limit_whole++;
                            } else if ($language == "telugu" && strcasecmp($option, "whole") == 0 && $limit_whole < $result_limit) {
                                $match = true;
                                if (isset($word_from_db[$i]) && count($user_search_string) == count($word_from_db)) {
                                    for ($i = 0; $i < count($user_search_string); $i++) {
                                        //... compare against characters in the word from the DB.
                                        if ($word_from_db[$i] != $user_search_string[$i]) {
                                            // No match. break.
                                            $match = false;
                                            break;
                                        }
                                    }
                                } else {
                                    $match = false;
                                }

                                // If successful...
                                if ($match == true) {
                                    echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                    $no_result_found++;
                                    $limit_whole++;
                                }
                            } else if ($language == "english" && preg_match("/$input/i", $row[1]) && $option === "contains-sub" && $limit_conat < $result_limit) {
                                echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                $no_result_found++;
                                $limit_conat++;
                            } else if ($language == "telugu" && preg_match("/$input/i", $row[1]) && $option === "contains-sub" && $limit_conat < $result_limit) {
                                echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                $no_result_found++;
                                $limit_conat++;
                            } else if ($language == "english" && preg_match("/$input/i", $row[1]) && $option === "contains-subs" && $limit_conat < $result_limit) {
                                echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                $no_result_found++;
                                $limit_conat++;
                            } else if ($language == "telugu" && preg_match("/$input/i", $row[1]) && $option === "contains-subs" && $limit_conat < $result_limit) {
                                echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                $no_result_found++;
                                $limit_conat++;
                            } else if ($language == "english" && preg_match("/$input/i", $row[1]) && $option === "contains" && $limit_con < $result_limit) {
                                echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                $no_result_found++;
                                $limit_con++;
                            } else if ($language == "telugu" && $option === "contains" && $limit_conat < $result_limit) {
                                $match = true;
                                if (isset($word_from_db[0])) {
                                    for ($i = 0; $i < count($user_search_string); $i++) {

                                        // If the character exists in the word...
                                        $x = false;
                                        for ($j = 0; $j < count($word_from_db); $j++) {
                                            if ($user_search_string[$i] == "," || $user_search_string[$i] == $word_from_db[$j]) {
                                                $x = true;
                                                break;
                                            }
                                        }

                                        // The character the user entered was not found in the word.
                                        if ($x == false) {
                                            $match = false;
                                            break;
                                        }
                                    }
                                } else {
                                    $match = false;
                                }

                                // If successful...
                                if ($match == true) {
                                    echo "<tr><td colspan='2'>$row[1]</td></tr>";
                                    $no_result_found++;
                                    $limit_con++;
                                }
                            }
                        }


                        if ($no_result_found === 0) {
                            echo "<tr><td colspan='2'>$message</td></tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>

        <div id="foot">
            <?php require "footer.php"; ?>
        </div>

    </div>
</body>

</html>