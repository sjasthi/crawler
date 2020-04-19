<?php

// Decides what format the results should be printed in based on what
// screen is searching for those results.
function printDecision($row)
{
    if ($_SESSION['searchPage'] == "lucky") printLine($row);
    else printRow($row);
}

// Prints a row in the results table.
function printRow($row)
{
    $id = $row[0];
    $word = $row['word'];
    $length = $row['char_len'];
    $strength = $row['strength'];
    $weight = $row['weight'];

    print "
        <tr>
            <td >$id</td>
            <td >$word</td>
            <td >$length</td>
            <td >$strength</td>
            <td >$weight</td>
        </tr>";
}

// Prints each result on it's own line
function printLine($row)
{
    $word = $row['word'];
    echo "<p>" . $word . "</p>";
}

// Handles Logical Characters Search [E] for Telugu language.
function teluguSearch($row, $user_search_string, $option)
{
    // Telugu words must be parsed into logical characters
    // before this search can be run.
    $word = parseToLogicalCharacters($row['word']);
    $user_search_string = parseToLogicalCharacters($user_search_string);

    switch ($option) {
            // Contains character
        case "E1":
            for ($i = 0; $i < count($word); $i++) {
                // If any character in the $word matches $user_search_string[0]...
                if ($word[$i] == $user_search_string[0]) {
                    //... the word is a match.
                    printDecision($row);
                    return;
                }
            }
            break;
            // Contains characters in any order
        case "E2":
            $matchFound = true;
            // For each character in the $user_search_string...
            for ($i = 0; $i < count($user_search_string); $i++) {

                // ... check every character in the $word, searching for matches
                for ($j = 0; $j < count($word); $j++) {
                    if ($user_search_string[$i] == $word[$j]) {
                        // Match found. Continue...
                        $matchFound = true;
                        break;
                    }
                    $matchFound = false;
                }

                // If the character in $user_search_string at index $i was not found in the $word,
                // the criteria has not been met. Bail!
                if ($matchFound == false) {
                    return;
                }
            }
            // If we make it this far, then it is a match.
            printDecision($row);
            break;
            // Contains characters in the given order
        case "E3":
            $matchFound = true;
            $previousIndex = 0;
            // For each character in the $user_search_string...
            for ($i = 0; $i < count($user_search_string); $i++) {

                // ... check every character in the $word, searching for matches
                for ($j = $previousIndex; $j < count($word); $j++) {
                    if ($user_search_string[$i] == $word[$j]) {
                        // Match found. Continue...   
                        $previousIndex = $j;
                        $matchFound = true;
                        break;
                    }
                    $matchFound = false;
                }

                // If the character in $user_search_string at index $i was not found in the $word,
                // the criteria has not been met. Bail!
                if ($matchFound == false) {
                    return;
                }
            }
            // If we make it this far, then it is a match.
            printDecision($row);
            break;
            // Contains character at given index (uses $contain_at_index)
        case "E4":
            // Get global variable $contain_at_index (direct from user input).
            global $contain_at_index;

            // Invalid input -> No results
            if ($contain_at_index < 1) return;

            // If the current word does not have a value for the given index, bail.
            if (count($word) <= $contain_at_index) return;

            // If the criteria is met...
            if ($word[$contain_at_index - 1] == $user_search_string[0]) {
                //... print.
                printDecision($row);
            }
            break;
            // Prefix
        case "E5":
            teluguPrefix($word, $user_search_string, $row);
            break;
            // Suffix
        case "E6":
            teluguSuffix($word, $user_search_string, $row);
            break;
            // Contains substring
        case "D1":
            teluguSubstring($word, $user_search_string, $row);
            break;
            // Contains substrings (any order)
        case "D2":
            teluguSubstringsAnyOrder($word, $user_search_string, $row);
            break;
            // Contains substrings in the given order
        case "D3":
            teluguSubstringsGivenOrder($word, $user_search_string, $row);
            break;
            // Contains character at given index (uses $contain_at_index)
        case "D4":
            teluguFullWord($word, $user_search_string, $row);
            break;
            // Prefix
        case "D5":
            teluguPrefix($word, $user_search_string, $row);
            break;
            // Suffix
        case "D6":
            teluguSuffix($word, $user_search_string, $row);
            break;
    };
}

// Handles searches in English
function englishSearch($row, $user_search_string, $option)
{
    // Get the word.
    $word = $row['word'];

    // Different cases.
    switch ($option) {
            // Contains character
        case "E1":
            englishSubstring($word, $user_search_string, $row);
            break;
            // Contains characters (any order)
        case "E2":
            englishSubstringsAnyOrder($word, $user_search_string, $row);
            break;
            // Contains characters in the given order
        case "E3":
            englishSubstringsGivenOrder($word, $user_search_string, $row);
            break;
            // Contains character at given index (uses $contain_at_index)
        case "E4":
            englishContainAt($word, $user_search_string, $row);
            break;
            // Prefix
        case "E5":
            englishPrefix($word, $user_search_string, $row);
            break;
            // Suffix
        case "E6":
            englishSuffix($word, $user_search_string, $row);
            break;
            // Contains character
        case "D1":
            englishSubstring($word, $user_search_string, $row);
            break;
            // Contains characters (any order)
        case "D2":
            englishSubstringsAnyOrder($word, $user_search_string, $row);
            break;
            // Contains characters in the given order
        case "D3":
            englishSubstringsGivenOrder($word, $user_search_string, $row);
            break;
            // Contains character at given index (uses $contain_at_index)
        case "D4":
            englishFullWord($word, $user_search_string, $row);
            break;
            // Prefix
        case "D5":
            englishPrefix($word, $user_search_string, $row);
            break;
            // Suffix
        case "D6":
            englishSuffix($word, $user_search_string, $row);
            break;
    }
}

// Handles searches that are the same for both languages.
function sharedSearch($row, $user_search_string, $option)
{

    // Get the word.
    $word = $row['word'];

    // Different cases.
    switch ($option) {
            // Contains Substring
        case "C1":
            englishSubstring($word, $user_search_string, $row);
            break;
        case "C2":
            englishSubstringsAnyOrder($word, $user_search_string, $row);
            break;
            // Contain substrings (given order)
        case "C3":
            englishSubstringsGivenOrder($word, $user_search_string, $row);
            break;
        case "C4":
            englishFullWord($word, $user_search_string, $row);
            break;
            // Prefix
        case "C5":
            englishPrefix($word, $user_search_string, $row);
            break;
            // Suffix
        case "C6":
            englishSuffix($word, $user_search_string, $row);
            break;
    }
}

// ======================================= Auxillary Functions =======================================

// Reusable telugu substrings in given order
function teluguFullWord($word, $user_search_string, $row)
{
    // If the search string is longer than the word, it can't be a match.
    if (count($word) != count($user_search_string)) return;

    if (teluguWordContainsSubstring($word, $user_search_string))
        // If we make it this far, then it is a match.
        printDecision($row);
}

// Reusable telugu substring
function teluguSubstring($word, $user_search_string, $row)
{
    // If the search string is longer than the word, it can't be a match.
    if (count($word) < count($user_search_string)) return;

    if (teluguWordContainsSubstring($word, $user_search_string))
        // If we make it this far, then it is a match.
        printDecision($row);
}

// Checks if a telugu logical characters array contains a $user_search_string logical characters array
// returns true or false.
function teluguWordContainsSubstring($word, $user_search_string)
{
    $match = false;
    // for each character in the word...
    for ($i = 0; $i < count($word); $i++) {
        //... Loop over each character in the search string.
        for ($k = 0; $k < count($user_search_string); $k++) {
            // if each value in the search string is found...
            if (isset($word[$i + $k]) && $word[$i + $k] == $user_search_string[$k]) {
                $match = true;
                if ($k == count($user_search_string) - 1) {
                    break;
                }
            } else {
                $match = false;
                break;
            }
        }
        if ($match == true) break;
    }

    return $match;
}

// Returns an array of integer indexes where the given substrings were found
// in the target word. For Telugu only!
function teluguWordContainsSubstringPosition($word, $user_search_string)
{
    $indexArray = [];
    $match = false;

    // $user_search_string is expected to be a 2D array of telugu words...
    for ($j = 0; $j < count($user_search_string); $j++) {
        // for each character in the word...
        for ($i = 0; $i < count($word); $i++) {
            //... Loop over each character in the search string.
            for ($k = 0; $k < count($user_search_string[$j]); $k++) {
                // if each value in the search string is found...
                if (isset($word[$i + $k]) && $word[$i + $k] == $user_search_string[$j][$k]) {
                    $match = true;
                    if ($k == 0) {
                        $indexArray[$j] = $i;
                    }
                    if ($k == count($user_search_string[$j]) - 1) {
                        break;
                    }
                } else {
                    $match = false;
                    break;
                }
            }
            if ($match == true) break;
        }
    }

    return $indexArray;
}

// Reusable telugu substrings in given order [D2]
function teluguSubstringsAnyOrder($word, $user_search_string, $row)
{
    // Handle multiple inputs.
    $user_search_string = teluguHandleMultipleInputs($user_search_string);

    // Ensure that all inputs exist in the word before printing.
    for ($i = 0; $i < count($user_search_string); $i++) {
        // If the search string is longer than the word, it can't be a match.
        if (count($word) < count($user_search_string[$i])) return;
        // Check for existence of the substring in the word
        if (teluguWordContainsSubstring($word, $user_search_string[$i]) == false) return;
    }

    // If we make it this far, we have a match
    printDecision($row);
}

// Reusable telugu substrings in given order
function teluguSubstringsGivenOrder($word, $user_search_string, $row)
{
    // Handle multiple inputs.
    $user_search_string = teluguHandleMultipleInputs($user_search_string);

    // Ensure that all inputs exist in the word before printing.
    for ($i = 0; $i < count($user_search_string); $i++) {
        // If the search string is longer than the word, it can't be a match.
        if (count($word) < count($user_search_string[$i])) return;
        // Check for existence of the substring in the word
        if (teluguWordContainsSubstring($word, $user_search_string[$i]) == false) return;
    }

    // Get array of start indexes for the component substrings
    $indexArray = teluguWordContainsSubstringPosition($word, $user_search_string);

    // Ensure that the indexArray is linear. This would
    // suggest the search criteria was met in given order.
    $prevIndex = -1;
    for ($i = 0; $i < count($indexArray); $i++) {
        if ($indexArray[$i] < $prevIndex) return;
        else {
            $prevIndex = $indexArray[$i];
        }
    }

    // If we make it this far, then it is a match.
    printDecision($row);
}

// When the user inputs multiple telugu strings, each has to be parsed into logical characters.
// This function handles that operation.
function teluguHandleMultipleInputs($user_search_string)
{
    $user_search_string = implode($user_search_string);
    $user_search_string = explode(",", $user_search_string);

    for ($i = 0; $i < count($user_search_string); $i++) {
        $user_search_string[$i] = parseToLogicalCharacters($user_search_string[$i]);
    }

    return $user_search_string;
}

// Reusable telugu prefix function
function teluguPrefix($word, $user_search_string, $row)
{
    // For each prefix character...
    for ($i = 0; $i < count($user_search_string); $i++) {
        //... compare against characters in the word from the DB.
        if ($word[$i] != $user_search_string[$i]) {
            // No match. break.
            return;
        }
    }
    // If we make it this far, then it is a match.
    printDecision($row);
}

// Reusable telugu suffix function
function teluguSuffix($word, $user_search_string, $row)
{
    for ($i = 1; $i <= count($user_search_string); $i++) {
        //... compare against characters in the word from the DB.
        if ($word[count($word) - $i] != $user_search_string[count($user_search_string) - $i]) {
            // No match. break.
            return;
        }
    }
    // If we make it this far, then it is a match.
    printDecision($row);
}

// Contain at (E4)
function englishContainAt($word, $user_search_string, $row)
{
    // Get global variable $contain_at_index (direct from user input).
    global $contain_at_index;

    // Invalid input -> No results
    if ($contain_at_index < 1) return;

    // If the current word does not have a value for the given index, bail.
    if (strlen($word) <= $contain_at_index) return;

    // If the criteria is met...
    if ($word[$contain_at_index - 1] == $user_search_string[0]) {
        //... print.
        printDecision($row);
    }
}

// Reusable code for substring search criteria.
function englishSubstring($word, $user_search_string, $row)
{
    // If the search string is longer than the word, it can't be a match.
    if (strlen($word) < strlen($user_search_string)) return;

    if (!preg_match("/$user_search_string/i", $word)) return;

    // If we make it this far, then it is a match.
    printDecision($row);
}

// Reusable code for substrings in any order search criteria.
function englishSubstringsAnyOrder($word, $user_search_string, $row)
{
    // Explode user input around ','
    $user_search_string = explode(",", $user_search_string);

    for ($i = 0; $i < count($user_search_string); $i++) {
        if (!preg_match("/$user_search_string[$i]/i", $word)) return;
    }

    // If we make it this far, then it is a match.
    printDecision($row);
}

// Reusable code for substrings in the given order search criteria.
function englishSubstringsGivenOrder($word, $user_search_string, $row)
{
    // Explode user input around ','
    $user_search_string = explode(",", $user_search_string);
    $indexArray = [];

    // Ensure all parts are actually in the word
    // Also construct an array of values of where in the word
    // the search criteria substrins were found
    for ($i = 0; $i < count($user_search_string); $i++) {
        if (!preg_match("/$user_search_string[$i]/i", $word)) return;
        else {
            $indexArray[$i] = strrpos($word, $user_search_string[$i]);
        }
    }

    // Ensure that the indexArray is linear. This would
    // suggest the search criteria was met in given order.
    $prevIndex = -1;
    for ($i = 0; $i < count($indexArray); $i++) {
        if ($indexArray[$i] < $prevIndex) return;
        else {
            $prevIndex = $indexArray[$i];
        }
    }

    // If we make it this far, then it is a match.
    printDecision($row);
}

// Reusable code for full word search criteria.
function englishFullWord($word, $user_search_string, $row)
{
    // If the search string isn't the same length as the word, it can't be a match.
    if (strlen($word) != strlen($user_search_string)) return;

    if (!preg_match("/$user_search_string/i", $word)) return;

    // If we make it this far, then it is a match.
    printDecision($row);
}

// Reusable code to filter by prefix for english words.
function englishPrefix($word, $user_search_string, $row)
{
    // If the search string is longer than the word, it can't be a match.
    if (strlen($word) < strlen($user_search_string)) return;

    // For each prefix character...
    for ($i = 0; $i < strlen($user_search_string); $i++) {
        //... compare against characters in the word from the DB.
        if ($word[$i] != $user_search_string[$i]) {
            // No match. break.
            return;
        }
    }
    // If we make it this far, then it is a match.
    printDecision($row);
}

// Reusable code to filter by suffix for english words.
function englishSuffix($word, $user_search_string, $row)
{
    // If the search string is longer than the word, it can't be a match.
    if (strlen($word) < strlen($user_search_string)) return;

    $suffix_string = substr($word, (strlen($word) - strlen($user_search_string)));
    if (strcasecmp($suffix_string, $user_search_string) == 0) {
        // If we make it this far, then it is a match.
        printDecision($row);
    }
}
