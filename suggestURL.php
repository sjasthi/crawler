<?php
require "header.php";
include ('suggest_fns.php');
$messagePrompt = "";

if(isset ($_POST["suggestInput"])) {
    $suggestInput = explode(" ", $_POST["suggestInput"]);
    $suggestURL = "suggesturl";
    $crawlURL = "crawlurl";

    if (empty($_POST["suggestInput"])) {
        $messagePrompt = "Please try again";
    }

    foreach ($suggestInput as $input) {
        if (checkURLAgainstSuggested($input, $suggestURL) == true) {
            $messagePrompt = "This has already been suggested.";

        }
        elseif (checkURLAgainstCrawled($input, $crawlURL) == true) {
            $messagePrompt = "This has already been crawled.";

        }
        elseif (checkURLAgainstSuggested($input, $suggestURL) == false) {
            insertURLToSuggestDB($input, $suggestURL);
            $messagePrompt = "Added";

        }
        elseif (checkURLAgainstSuggested($input, $suggestURL) == "") {
            //insertURLToSuggestDB($input, $suggestURL);
            $messagePrompt = "Must enter URL";


        }
        elseif (checkURLAgainstCrawled($input, $crawlURL) == false) {
            insertURLToSuggestDB($input, $suggestURL);
            $messagePrompt = "Added";

        }
        elseif (checkURLAgainstCrawled($input, $crawlURL) == "") {
            //insertURLToSuggestDB($input, $suggestURL);
            $messagePrompt = "Must enter URL";

        }

        else {
            insertURLToSuggestDB($input, $suggestURL);
            $messagePrompt = "Added";
            //echo "<script type='text/javascript'>alert('URL entered into suggested Database! An admin will review the URL for crawling')</script>";
             }
        }
    }


?>

<div id="container">
    <div id="body">
        <div id="indexDiv"><h1>Suggest a URL (or more) <?php
                $insert_date = date("m/d/Y");
                echo $insert_date;?></h1>
            Enter a URL to suggest for crawling.<br> To enter multiple, please separate each URL by a space.
            <form action="<?=$_SERVER['PHP_SELF']; ?>" method="POST" id="suggestForm">
                <textarea id="suggestInput" name="suggestInput" placeholder="http://www.example.com http://www.anotherexample.com"></textarea></br>
                <span class="userMessage"><br/><?php echo $messagePrompt ?><br/></span>
                <input type="submit" id="suggestSubmitButton"/><br/></form>
        </div>
    </div>
</div>

<?php
require "footer.php";
?>