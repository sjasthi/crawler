<?php

//test file to hold progress indicator
$file = "./progress indicator.txt";

session_start();

// if ($_SESSION['loggedIn'] != "adminIN") {
//     header("Location:/login.php");
// }

require "header.php";
include('crawl_fns.php');
include('indic-wp-master/telugu_parser.php');
$language = "english";
if (isset($_POST['lapseOptions'])) $sunset = $_POST['lapseOptions'];
else $sunset = "";
if (isset($_POST['depthOptions'])) $depth = $_POST['depthOptions'];
else $depth = "";
$crawlURL = "crawlurl";
$messagePrompt = "";
$visitedUrls = [];

$totalURLCrawled = 0;
$totalUniqueWords = 0;
$totalExistingWords = 0;

if ($sunset === 'infinite') { //if drop down is set to infinite, send 0 to inserturlDB
    $sunset = 0;
} elseif ($sunset === 'day') { //if drop down is set to day, send 1 to inserturlDB
    $sunset = 1;
} elseif ($sunset === 'week') { //if drop down is set to week, send 7 to inserturlDB
    $sunset = 7;
} elseif ($sunset === 'month') { //if drop down is set to month, send 30 to inserturlDB
    $sunset = 30;
} elseif ($sunset === 'year') { //if drop down is set to year, send 365 to inserturlDB
    $sunset = 365;
}

//get admin url input from text area*************************
if (isset($_POST['crawlInput'])) {
    $crawlInput = explode(" ", $_POST['crawlInput']);

    if (isset($_POST['langRadio'])) {
        $language = $_POST['langRadio'];

        if ($language == "english") {
            $crawlURL = "crawlurl";
        } else if ($language == "telugu") {
            $crawlURL = "crawlurl";
        }
    }

    foreach ($crawlInput as $input) {
        if (checkURLExists($input, $crawlURL) == true) {  //if the url exists, it will not crawl.
            $messagePrompt = "Duplicate Found! Not added to database.";
        } else {


            //append to progress indicator
            file_put_contents($file,"START\n",FILE_APPEND);
            file_put_contents($file,"Crawl Started\n",FILE_APPEND);
            file_put_contents($file,"Crawling started for $input\n",FILE_APPEND);

            //progress message
            echo "<script type='text/javascript'>alert('Crawl started')</script>";
            echo "<br>";
            echo "CRAWLING.  Please wait, prompt will appear when finished.";
            echo "<br>";
            echo "Crawling started for $input";
            crawl($input, $language, $sunset, $depth);
            echo "<br>";
            echo "<script type='text/javascript'>alert('Crawl is finished!!')</script>";
        }
    }

    //End process message


    echo "<br>";
    echo "All URLs are crawled.";
    echo "<br>";
    echo "$totalUniqueWords new words are inserted.";
    echo "<br>";
    echo "$totalExistingWords words are ignored.";
    echo "<br>";
    echo "Number of URLs processed in this crawl: $totalURLCrawled";
    echo "<br>";
    echo "END.";

    //append to progress indicator
    file_put_contents($file, "All URLs are crawled.\n", FILE_APPEND);
    file_put_contents($file, "$totalUniqueWords new words are inserted.\n", FILE_APPEND);
    file_put_contents($file, "$totalExistingWords words are ignored.\n", FILE_APPEND);
    file_put_contents($file, "Number of URLs processed in this crawl: $totalURLCrawled\n", FILE_APPEND);
    file_put_contents($file, "END\n", FILE_APPEND);
	file_put_contents($file, "==================================================================================\n\n", FILE_APPEND);
}


function get_url_contents($url)
{
    $crl = curl_init();
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

function crawl($input, $language, $sunset, $depth)
{
    $uniqueWords = 0;
    $existingWords = 0;
    global $totalURLCrawled;
    $totalURLCrawled++;
    global $totalExistingWords;
    global $totalUniqueWords;
    global $file;

    $seen = array();
    global $crawlURL;
    if (($depth == 0) or (in_array($input, $seen))) {
        return;
    }

    // Grab ALL html style tags and strip them.
    $html = get_url_contents($input);
    $stripReady = preg_replace('/(<\/[^>]+?>)(<[^>\/][^>]*?>)/', '$1 $2', $html);
    $strippedHTML = strip_tags($stripReady);

    // English
    if ($language === 'english') {

        // Sanatize and split the words by space.
        $cleanCrawl = sanitizeInput($strippedHTML);
        $text = explode(" ", $cleanCrawl);

        // Iterate over each word split..
        foreach ($text as $item) {

            // Ensure that special characters have been removed.
            $item = preg_replace('/[][(){},.;:""_\s=!?<>%\/]/', "", $item);

            // Check if word (or characters) exists in database.
            checkWordEngExists($item);

            if(checkWordEngExists($item) == true){
                $existingWords++;
                $totalExistingWords++;
            }

            // If not, add it to the database.
            if (checkWordEngExists($item) == false) {
                $uniqueWords++;
                $totalUniqueWords++;
                insertEngTXTToDB($item);
            }
        }

        $uniqueWordsMessage = "$uniqueWords unique words are inserted";

        echo "<br>";
        echo "$uniqueWords unique words are inserted";
        echo "<br>";
        echo "$existingWords existing words are ignored";

        //add to text file
        file_put_contents($file, "$uniqueWords unique words are inserted\n", FILE_APPEND);
        file_put_contents($file, "$existingWords existing words are ignored\n\n", FILE_APPEND);
    }

    // Telugu.
    else if ($language === 'telugu') {

        // Sanatize and split the words by space.
        $cleanCrawl = sanitizeTelInput($strippedHTML);
        $text = explode(" ", $cleanCrawl);

        // Iterate over each word split...
        foreach ($text as $item) {

            // Ensure that special characters have been removed.
            $item = preg_replace('/[][(){},.;:""_\s=!?<>%\/]/', "", $item);

            // Check if word (or characters) exists in database.
            checkWordTelExists($item);

            if(checkWordTelExists($item)){
                $existingWords++;
                $totalExistingWords++;
            }

            // If not, add it to the database.
            if (checkWordTelExists($item) == false) {
                $uniqueWords++;
                $totalUniqueWords++;
                if (inTelRange($item) == true) {
                    insertTelTXTToDB($item);
                }
            }
        }

        echo "<br>";
        echo "$uniqueWords unique words are inserted";
        echo "<br>";
        echo "$existingWords existing words are ignored";

        file_put_contents($file, "$uniqueWords unique words are inserted\n", FILE_APPEND);
        file_put_contents($file, "$existingWords existing words are ignored\n\n", FILE_APPEND);
    }


    // Insert the URL to the DB.
    insertURLToDB($input, $sunset, $crawlURL);

    //check depth by putting URLS found into an array, and crawl new url found, by depth.
    if ($html) {

        // Pull URL from file.
        $stripped_file = strip_tags($html, "<a>");
        
        // Check URL.
        preg_match_all("/<a[\s]+[^>]*?href[\s]?=[\s\"\']+" . "(.*?)[\"\']+.*?>" . "([^<]+|.*?)?<\/a>/", $stripped_file, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $href = $match[1];

            // If the URL doesn't start with http, it is a relative path.
            // Use the input path to create the new target.
            if (0 !== strpos($href, 'http')) {

                // Parse the input URL into parts for reassembly later.
                $inputParts = parse_url($input);

                // Explode the path.
                $explodedPath = explode('/', $inputParts['path']);

                // The new path.
                $newPath = "";

                // Exclude the first and the last...                
                for ($i = 1; $i < count($explodedPath) - 1; $i++) {
                    $newPath .= '/' . $explodedPath[$i];
                }

                // Reassemble.
                $href = $inputParts['scheme'] . '://' . $inputParts['host'] . $newPath . '/' . $href;
            }

            // If we haven't already been here...
            global $visitedUrls;
            if (!in_array($href, $visitedUrls)) {

                // Push the link to the stored array.
                array_push($visitedUrls, $href);
                $totalURLCrawled++;

                // TESTING? UNCOMMENT THE LINES BELOW Spit out some useful info.
                echo "<br>";
                echo "<br>";
                echo "Processing link " . $href;
                file_put_contents($file, "Processing link " . $href, FILE_APPEND);
                ob_flush();

                // Crawl the new target.
                crawl($href, $language, $sunset, $depth - 1);
            }
        }
    }
}

?>

<header>
    <link href="css/crawl_style.css" rel="stylesheet" type="text/css">
</header>
<div id="container">
    <div id="body">
        <div id="page_header">
            <h1>Enter a URL for crawling</h1>
            To enter multiple, <b>please separate each URL by a space.</b>
        </div>
        <span class="userMessage" id="errorMessage"><br /><?php echo $messagePrompt; ?></span>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" id="crawlForm">
            <textarea id="crawlInput" name="crawlInput" placeholder="www.example.com www.anotherexample.com"></textarea></br>
            <select id="depthOptions" name="depthOptions" required>
                <option value="">Depth...</option>
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <select id="lapseOptions" name="lapseOptions" required>
                <option value="" selected="selected">Time Lapse...</option>
                <option value="infinite">Infinite</option>
                <option value="day">1 day</option>
                <option value="week">1 week</option>
                <option value="month">1 month</option>
                <option value="year">1 year</option>
            </select>
            <input type="radio" name="langRadio" value="english" id="radioEng" required <?php if (isset($_POST['langRadio']) === 'eng') {
                                                                                            print ' checked="checked"';
                                                                                        } ?> checked /><label class="radio">English</label>
            <input type="radio" name="langRadio" value="telugu" id="radioTel" required <?php if (isset($_POST['langRadio']) === 'tel') {
                                                                                            print ' checked="checked"';
                                                                                        } ?> /><label class="radio">Telugu</label>
            <input type="submit" value="Crawl" id="crawlFormButton" /></form>
    </div>
</div>
<?php
require "footer.php";
?>