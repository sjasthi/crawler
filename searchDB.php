<?php
require "header.php";
include('search_fns.php');
include('indic-wp-master/word_processor.php');
include('telugu_parser.php');

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
if(isset ($_POST['search'])) {

    if(isset ($_POST['language'])){
        $language = $_POST['language'];
    }

    if(isset ($_POST['option'])){
        $option = $_POST['option'];

        if(isset($_POST['spinner1'])){
            $contain_value = $_POST['spinner1'];
        }
    }

    if(isset ($_POST['spinner2'])){
        $min_letter = $_POST['spinner2'];
    }

    if(isset ($_POST['spinner3'])){
        $max_letter = $_POST['spinner3'];
    }

    if(isset ($_POST['limit'])){
        $result_limit = $_POST['limit'];
    }


    $input = stripslashes($_POST['search-bar']);
    $input = preg_replace('/^[\s]+$/','', $input);
    $input = explode(" ", $input);
    $input = implode($input);


}
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <link href="css/search_style.css" rel="stylesheet" type="text/css"/>
</header>
<body>
<div id="container">
    <div id="body">
        <form action="<?=$_SERVER['PHP_SELF']; ?>" method="POST" id="searchForm" autocomplete="off">
            <div id="filter">
                <label>Select Language</label><br>
                <input type="radio" name="language" value="english" id="rad-1" checked <?php if (isset($_POST['language']) && $_POST['language']=='english') echo ' checked="checked"';?>>English<br>
                <input type="radio" name="language" value="telugu" id="rad-2" <?php if (isset($_POST['language']) && $_POST['language']=='telugu') echo ' checked="checked"';?>>Telugu<br><br>

                <label>Search By</label><br>
                <input type="radio" name="option" value="contains-sub" id="rad-3" checked <?php if (isset($_POST['option']) && $_POST['option']=='contains-sub') echo ' checked="checked"';?>>Contains substring<br />
                <input type="radio" name="option" value="contains-subs" id="rad-4" <?php if (isset($_POST['option']) && $_POST['option']=='contains-subs') echo ' checked="checked"';?>>Contains substrings<br />

                <input type="radio" name="option" value="contains" id="rad-5"  <?php if (isset($_POST['option']) && $_POST['option']=='contains') echo ' checked="checked"';?>>Contains Characters<br />
                <input type="radio" name="option" value="contains-at" id="rad-6" <?php if (isset($_POST['option']) && $_POST['option']=='contains-at') echo ' checked="checked"';?>>Contains Character at
                <input type="number" size="6" name="spinner1" value=<?php echo $contain_value?> id="contain_spinner" min="1" max="99"><br>
                <input type="radio" name="option" value="prefix" id="rad-7" <?php if (isset($_POST['option']) && $_POST['option']=='prefix') echo ' checked="checked"';?>>Prefix<br>
                <input type="radio" name="option" value="suffix" id="rad-8" <?php if (isset($_POST['option']) && $_POST['option']=='suffix') echo ' checked="checked"';?>>Suffix<br>
                <input type="radio" name="option" value="whole" id="rad-9" <?php if (isset($_POST['option']) && $_POST['option']=='whole') echo ' checked="checked"';?>>Whole words<br><br>

                <label>Length of words</label><br>
                Minimum  <input type="number" name="spinner2" value=<?php echo $min_letter?> id="letter_spiner1" min="2" max="99"><br>
                Maximum  <input type="number" name="spinner3" value=<?php echo $max_letter?> id="letter_spiner2" min="2" max="10"><br><br>

                <label>Result Limit</label>
                <input type="number" name="limit" value=<?php echo $relimit?> min="1" max="100">

            </div>

            <div id="search-bar-pane">
                <input type="text" id="search-bar" name="search-bar" placeholder="Enter Search Criteria">
                <button type="sumit" id="search-button" value="search" name="search">
                    <img src="images/search.png" alt="Search Icon" height="42" width="42">
                </button>
            </div>
        </form>

        <div id="display">
            <table id="result-table">
                <tr>
                    <td colspan="2" id="table-header">Result Words</td>
                </tr>


                <?php

                /*if($option == "contains-subs") {
                    $input = explode(",", $input);
                    $input = implode($input);
                }

                if($option === "contains"){
                    $input = explode(" ", $input);
                    $input = implode($input);
                }*/

                if($language == "english" && $option == "contains-subs") {
                    $input = explode(",", $input);
                    $input = implode($input);
                }

                if($language == "english" && $option === "contains"){
                    $input = explode(" ", $input);
                    $input = implode($input);
                }

                if($language == "telugu" && $option == "contains-subs"){
                    $input = explode(",", $input);
                    $input = implode($input);
                }

                if($language == "telugu" && $option == "contains"){
                    $input = explode(" ", $input);
                    $input = implode($input);
                }

                DEFINE('DATABASE_HOST', 'localhost');
                DEFINE('DATABASE_DATABASE', 'crawler');
                DEFINE('DATABASE_USER', 'root');
                DEFINE('DATABASE_PASSWORD', '');


                $dbcn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD,DATABASE_DATABASE );
                $dbcn -> set_charset("utf8");
                if(mysqli_connect_errno()){
                    echo "<p>Error creating database connection</p>";
                    exit;
                }
                $sql = "SELECT E.en_id, E.word, E.char_len FROM english AS E WHERE E.char_len >= $min_letter AND E.char_len <= $max_letter UNION 
                        SELECT T.tel_id, T.word, T.char_len FROM telugu AS T WHERE T.char_len >= $min_letter AND T.char_len <= $max_letter";
                $result = $dbcn -> query($sql);

                if(!$result){
                    echo ("<p>Unable to query database at this time.</p>");
                    exit;
                }

                $numRows = $result -> num_rows;

                if($numRows > 0){
                    $index = $numRows;
                    $no_result_found = 0;
                    $limit_conat = 0;
                    $limit_con = 0;
                    $limit_pre = 0;
                    $limit_suf = 0;
                    $limit_whole = 0;
                    $count = 0;

                    for($i = 0; $i<$index; $i++){
                        $row = $result -> fetch_array();
                        $prefix_string = substr($row[1], 0, strlen($input));
                        $suffix_string = substr($row[1], (strlen($row[1]) - strlen($input)));
                        $contain_at = $row[1]{$contain_value - 1};
                        $row[1] = strtolower($row[1]);

                        if($language === "telugu"){
                            $tel_logic = parseToLogicalCharacters($row[1]);
                            $tel_input = parseToLogicalCharacters($input);
                            $contain_at = $tel_logic[$contain_value -1];
                            $bcount = 0;
                            for($a = 0; $a < count($tel_input); $a++){
                                for($b = $bcount; $b < count($tel_logic); $b++){
                                    if(isset($tel_logic[$a], $tel_logic[$b]) == 0 && $count < count($tel_input)){
                                        $count++;
                                        $bcount ++;
                                        break;
                                    }
                                    else if($count == count($tel_input)){
                                        break;
                                    }
                                    else
                                        $count = 0;
                                }
                            }

                        }

                        if($input === "") {
                            $no_result_found = 0;
                        }
                        /*
                         ***TAKEOUT***
                         *                       *
                         * else if(strcasecmp($contain_at, $input) == 0 && $option === "contains-sub" && $limit_conat < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_conat++;
                        }*/
                        /*else if(strcasecmp($contain_at, $input) == 0 && $option === "contains-subs" && $limit_conat < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_conat++;
                        }*/
                        /*else if(strcasecmp($contain_at, $input) == 0 && $option === "contains" && $limit_con < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_con++;
                        }*/
                        else if(strcasecmp($contain_at, $input ) == 0 && $option === "contains-at" && $limit_con < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_con++;
                        }
                        else if(strcasecmp($prefix_string, $input) == 0 && $option === "prefix" && $limit_pre < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_pre++;
                        }
                        else if(strcasecmp($suffix_string, $input) == 0 && $option === "suffix" && $limit_suf < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_suf++;
                        }
                        else if(strcasecmp($row[1], $input) == 0 && strcasecmp($option, "whole") == 0 && $limit_whole < $result_limit){

                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_whole++;
                        }
                        else if($language == "english" && preg_match("/.$input./i", $row[1])&& $option === "contains-sub" && $limit_conat < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_conat++;
                        }
                        else if($language == "telugu" && preg_match("/.$input./i", $row[1])&& $option === "contains-sub" && $limit_conat < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_conat++;
                        }
                        else if($language == "english" && preg_match("/.$input./i", $row[1])&& $option === "contains-subs" && $limit_conat < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_conat++;
                        }
                        else if($language == "telugu" && preg_match("/.$input./i", $row[1])&& $option === "contains-subs" && $limit_conat < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_conat++;
                        }
                        else if($language == "english" && preg_match("/.$input./i", $row[1])&& $option === "contains" && $limit_con < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_con++;
                        }
                        else if($language == "telugu" && preg_match("/.$input./i", $row[1])&& $option === "contains" && $limit_conat < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_con++;
                        }
                        /*else if($language == "english" && preg_match("/.$input./i", $row[1])&& $option === "contains-at" && $limit_con < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_con++;
                        }*/
                        else if($language == "telugu" && preg_match("/.$input./i", $row[1])&& $option === "contains-at" && $limit_con < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_con++;
                        }
                        /*else if($language == "telugu" && $count == count($tel_input) && $option === "contains" && $limit_con < $result_limit){
                            echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_con++;
                        }
                        else if($language == "telugu" && $count == count($tel_input) && $option === "contains-subs" && $limit_conat < $result_limit){
                           echo "<tr><td colspan='2'>$row[1]</td></tr>";
                            $no_result_found++;
                            $limit_conat++;
                        }*/

                    }


                    if($no_result_found === 0){
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