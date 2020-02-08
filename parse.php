<?php
/**
 * Created by PhpStorm.
 * User: Fue Lee
 * Date: 06/01/2017
 * Time: 6:40 PM
 */
session_start();

if($_SESSION['loggedIn'] != "adminIN"){
    header("Location:/login.php");
}

require "header.php";
include('telugu_parser.php');
$message = "";
$inserted_words = "";
$inserted_message = "";
$existed_words = "";
$existed_message = "";

DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_DATABASE', 'crawler');
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');

if(isset($_POST['parse'])){
    $lauguage = "english";


    if(isset($_POST['language']))
    {
        $language = $_POST['language'];
    }

    $text = nl2br($_POST['parsing_text']);
    $text = preg_replace("/[\/\:\,\(\)\'\[\]\"\'\@\#\$\%\;\.0-9\<\>\-\*\;\-\_]/", " ", $text);
    $words = preg_split("/\s+/", $text, null, PREG_SPLIT_NO_EMPTY);

    $dbcn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $dbcn -> set_charset("utf8");
    if(mysqli_connect_errno()){
        echo "<p>Error creating database connection</p>";
        exit;
    }

    foreach ($words as $word) {
        $word = str_replace('/>', "", $word);
        $word = str_replace('<br', "", $word);
        $word = str_replace('br', "", $word);

        if($language == "telugu"){
            $tcount = parseToLogicalCharacters($word);
            $len = count($tcount);
        }
        else
            $len = strlen($word);

        if($word !== "" && $len > 1) {

            $sql = "SELECT * FROM $language";
            $result = $dbcn -> query($sql);

            if(!$result){
                echo ("<p>Unable to query database at this time.</p>");
                exit;
            }

            $numRows = $result -> num_rows;

            if($numRows > 0){
                $index = $numRows;
                $hold_word = "";

                for($i = 0; $i < $index; $i++){
                    $row = $result -> fetch_array();

                    if(!strcasecmp($row[1], $word) == 0) {
                        $hold_word = $word;
                    }
                    else {
                        $hold_word = "";
                        break;
                    }
                }

                if($hold_word !== "") {
                    $char_len = $len;
                    $sql2 = "INSERT INTO $language VALUES(null, '$word', '$char_len')";
                    $result2 = $dbcn->query($sql2);

                    if(!$result2){
                        echo "<p>Unable to Query Database at This Time</p>";
                        exit;
                    }

                    if($language == "english")
                        $inserted_words = $inserted_words . strtolower($word) . "\n";
                    else if($language == "telugu")
                        $inserted_words = $inserted_words . $word . "\n";

                    $message = "Successfully Parsing";
                }
                else{

                    if($language == "english")
                        $existed_words = $existed_words . strtolower($word) . "\n";
                    else if($language == "telugu")
                        $existed_words = $existed_words . $word . "\n";

                    $message = "Successfully Parsing";
                }

                if($language == "telugu"){
                    $sql3 = "select * from telugucount";
                    $result3 = $dbcn->query($sql3);
                    if(!$result3){
                        echo "Cannot created Database";
                        exit;
                    }

                    $numRow3 = $result3->num_rows;

                    for($i = 0; $i < $numRow3; $i++){
                        $each_row = $result3->fetch_assoc();
                        $t_char = parseToLogicalCharacters($word);
                        $word_len = count($t_char);

                        for($j = 0; $j < $word_len; $j++){
                            if(isset($each_row[0]) === $t_char[$j]){
                                $sql4 = "update telugucount set='" . ($each_row[1] + 1) . "' where ch='" . $each_row[0] . "';";
                                $result4 = $dbcn->query($sql4);
                                if(!$result4){
                                    echo "Cannot create database";
                                    exit;
                                }
                            }
                            /*else if(isset($each_row[0]) !== $t_char[$j]){
                                $sql5 = "insert into telugucount values('" . $t_char[$j] . "', 1);";
                                $result5 = $dbcn->query($sql5);
                                if(!$result5){
                                    echo "Cannot create database";
                                    exit;
                                }

                            }*/
                        }
                    }
                }
            }
        }
    }

    if($inserted_words === "")
        $inserted_words = "NO WORDS INSERTED\n";

    if($existed_words == '')
        $existed_words = "NO WORDS EXISTED IN DATABASE";

    $inserted_message = "*Words Inserted to Database (Unique Words)*\n";
    $existed_message = "\n*Words not Inserted to Database (Existed Words)*\n";

}
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <link href="parse_style.css" rel="stylesheet" type="text/css"/>
</header>

<div id="container">
    <div id="body">
        <span id="message"><?php echo $message ?></span>
        <span id="message2">Enter Or Copy/Paste Text Here</span>
        <textarea id="parse_text_area" name="parsing_text" form="parsing">
<?php
echo $inserted_message;
echo $inserted_words;
echo $existed_message;
echo $existed_words;
?>
        </textarea>
        <form action="<? $_SERVER['PHP_SELF'] ?>" method="post" mane="parsing_form" id="parsing">
            <input type="radio" name="language" value="english" checked>English
            <input type="radio" name="language" value="telugu">Telugu
            <button type="submit" value="parse" name="parse">Parse</button>
        </form>
    </div>
    <div id="footer">
        <?php
        require "footer.php";
        ?>

    </div>
</div>
</html>

