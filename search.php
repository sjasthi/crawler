<?php


//ini_set("display_errors","On");
//error_reporting(E_ALL);

require "header.php";
include('search_fns.php');
include('word_processor.php');



$class = new wordProcessor();
$searchDropdown = $_POST['searchOptions'];
$searchRadio =  $_POST['langRadio'];



?>

<!DOCTYPE html>
<html lang="en">

<div id="container">
    <div id="body">
            <form action="<?=$_SERVER['PHP_SELF']; ?>" method="POST" id="searchForm">
       <label class="searchLabels">Choose to search word that is a whole word, begins, ends, or contains your input.</label>
                </br><select id="searchOptions" name="searchOptions" required>
                    <!--<option value="">Select...</option> -->
                    <option value="whole" <?php if($searchDropdown == 'whole') { ?> selected <?php } ?>>Whole Word</option>
                    <option value="begins" <?php if($searchDropdown == 'begins') { ?> selected <?php } ?>> Begins with</option>
                    <option value="ends" <?php if($searchDropdown == 'ends') { ?> selected <?php } ?>> Ends with</option>
                    <option value="contains" <?php if($searchDropdown == 'contains') { ?> selected <?php } ?>> Contains</option>

                </select>

                </br></br><label class="searchLabels">Select a language to search:</label>
                        <input type="radio" name="langRadio" value="english" id="radioEng" required <?php if($_POST['langRadio'] === 'english') { print ' checked="checked"'; } ?> checked/><label class="radio">English</label>
                <input type="radio" name="langRadio" value="telugu" id="radioTel" required <?php if($_POST['langRadio'] === 'telugu') { print ' checked="checked"'; } ?>/><label class="radio">Telugu</label>
                </br> </br> <label class="searchLabels">How many letters in a word do you want, max? (does not apply to whole word)</label>
                </br>Search for <input type="text" name="lengthMinInput" id="lengthMinInput" value="<?php if(isset($_POST['term'])) { print $_POST['lengthMinInput']; } else {print  '2'; } ?>" style="width: 25px;" />
                min characters and
                <input type="text" name="lengthMaxInput" id="lengthMaxInput" value="<?php if(isset($_POST['term'])) { print $_POST['lengthMaxInput']; } else {print  '10'; } ?>" style="width: 25px;" />
                max characters.
                </br></br><label class="searchLabels">Enter input search criteria:</label>
                </br><input type="text" name="term" id="searchInput"/></br><input type="submit" id="searchSubmitButton" value="Search the database!"/></form>

            <div>
                <span class="userMessage"><br/><?php echo $messagePrompt;?></span>
                <div>

                    <?php
                    if(isset ($_POST["term"]) AND isset ($_POST["lengthMinInput"]) AND isset ($_POST["lengthMaxInput"])) {
                        $term = explode(" ", $_POST["term"]);
                        $lengthMinInput = $_POST['lengthMinInput'];
                        $lengthMaxInput = $_POST['lengthMaxInput'];

                        foreach ($term as $input) {
                            if ($searchDropdown === "whole" and $searchRadio === "english") {
                                if (checkWordExistsE($input) == true) {
                                    echo $messagePrompt = $input . " found!";
                                    showResults1E($input);

                                } else {
                                    echo $messagePrompt = $input . " NOT Found!";
                                }

                            }

                            if ($searchDropdown === "whole" and $searchRadio === "telugu") {

                                if (checkWordExistsT($input) == true) {
                                    echo $messagePrompt = $input . " found!";
                                    showResults1T($input);
                                } else {
                                    echo $messagePrompt = $input . " NOT Found!";
                                }

                            }

                            if ($searchDropdown === "begins" and $searchRadio === "english") {
                               // $startsWith = $class->startsWith($input); <--only use this for telugu
                                if (checkWordExistsE($input) == true) {
                                    //$englishCount = countEngQuery($input); <--ghost code for attempted count
                                    echo $messagePrompt = "There are words that begin with: " . $input;
                                    showResults2E($input,$lengthMinInput,$lengthMaxInput);

                                } else {
                                    echo $messagePrompt = "No words begin with: " . $input;
                                }

                            }

                            if ($searchDropdown === "begins" and $searchRadio === "telugu") {
                                // $startsWith = $class->startsWith($input); <--only use this for telugu
                                if (beginsWithT($input) == true) {
                                    echo $messagePrompt = "There are words that begin with: " . $input;
                                        showResults2T($input, $lengthMinInput, $lengthMaxInput);
                                } else {
                                    echo $messagePrompt = "No words begin with: " . $input;
                                }

                            }

                            if ($searchDropdown === "ends" and $searchRadio === "english") {
                                if (endsWithE($input) == true) {
                                    echo $messagePrompt = "There are words that ends with: " . $input;
                                    showResults3E($input, $lengthMinInput, $lengthMaxInput);
                                } else {
                                    echo $messagePrompt = "No words ends with " . $input;
                                }

                            }

                            if ($searchDropdown === "ends" and $searchRadio === "telugu") {
                                if (endsWithT($input) == true) {
                                    echo $messagePrompt = "There are words that ends with: " . $input;
                                    showResults3T($input, $lengthMinInput, $lengthMaxInput);
                                } else {
                                    echo $messagePrompt = "No words ends with: " . $input;
                                }

                            }

                            if ($searchDropdown === "contains" and $searchRadio === "english") {
                                if (containsE($input) == true) {
                                    echo $messagePrompt = "There are words that contains: " . $input;
                                    showResults4E($input, $lengthMinInput, $lengthMaxInput);
                                } else {
                                    echo $messagePrompt = "No words contains: " . $input;
                                }

                            }

                            if ($searchDropdown === "contains" and $searchRadio === "telugu") {
                                if (containsT($input) == true) {
                                    echo $messagePrompt = "There are words that contains: " . $input;
                                    showResults4T($input, $lengthMinInput, $lengthMaxInput);
                                } else {
                                    echo $messagePrompt = "No words contains: " . $input;
                                }

                            }

                        }
                    }
                    ?>

                    <div id="foot">
                        <?php
                        require "footer.php";
                        ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

</html>