<?php

require ('db_fns.php');


function checkWordExistsE($queriedResult){
    $conn = db_connect();
    $query = "SELECT * FROM english WHERE word='".$queriedResult."'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function checkWordExistsT($queriedResult){
    $conn = db_connect();
    $query = "SELECT * FROM telugu WHERE word='".$queriedResult."'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function beginsWithE($queriedResult){
    $conn = db_connect();
    $query = "SELECT * FROM english WHERE word LIKE '{$queriedResult}%'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function beginsWithT($queriedResult){
    $conn = db_connect();
    $query = "SELECT * FROM telugu WHERE word LIKE '{$queriedResult}%'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function endsWithE($queriedResult){
    $conn = db_connect();
    $query = "SELECT * FROM english WHERE word LIKE '%{$queriedResult}'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function endsWithT($queriedResult){
    $conn = db_connect();
    $query = "SELECT * FROM telugu WHERE word LIKE '%{$queriedResult}'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function containsE($queriedResult){
    $conn = db_connect();
    $query = "SELECT * FROM english WHERE word LIKE '%{$queriedResult}%'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function containsT($queriedResult){
    $conn = db_connect();
    $query = "SELECT * FROM telugu WHERE word LIKE '%{$queriedResult}%'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function showResults1E($queriedResult){
    $conn = db_connect();
    $query = "SELECT * FROM english WHERE word='".$queriedResult."'";
    $result = $conn->query($query);
    $rcounter = 0;
    $dcounter = 0;

    echo "<table>"; // start a table tag in the HTML

    while($row = mysqli_fetch_array($result) and $dcounter <= 99){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['word'] . "</td><td>";//$row['index'] the index here is a field name
        $dcounter ++;

    }

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        $rcounter ++;

    }

    echo "</table> <br>"; //Close the table in HTML

    if($rcounter > 100){
        echo "There are more than 100 results. Please refine search.";
    }
    else{
        echo "There are $dcounter results.";
    }
}

function showResults1T($queriedResult){
    $conn = db_connect();
    $query = "SELECT * FROM telugu WHERE word='".$queriedResult."'";
    $result = $conn->query($query);
    $rcounter = 0;
    $dcounter = 0;

    echo "<table>"; // start a table tag in the HTML

    while($row = mysqli_fetch_array($result) and $dcounter <= 99){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['word'] . "</td><td>";//$row['index'] the index here is a field name
        $dcounter ++;

    }

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        $rcounter ++;

    }

    echo "</table> <br>"; //Close the table in HTML

    if($rcounter > 100){
        echo "There are more than 100 results. Please refine search.";
    }
    else{
        echo "There are $dcounter results.";
    }
}

//BEGINS WITH ENGLISH WORD RESULTS
function showResults2E($queriedResult, $inputMinLength,  $inputMaxLength){
    $conn = db_connect();
    $query = "SELECT * FROM english WHERE word LIKE '{$queriedResult}%' AND CHAR_LENGTH(word) >= $inputMinLength AND CHAR_LENGTH(word) <= $inputMaxLength";
    $result = $conn->query($query);
    $rcounter = 0;
    $dcounter = 0;

    echo "<table>"; // start a table tag in the HTML

    while($row = mysqli_fetch_array($result) and $dcounter <= 99){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['word'] . "</td><td>";//$row['index'] the index here is a field name
        $dcounter ++;

    }

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        $rcounter ++;

    }

    echo "</table> <br>"; //Close the table in HTML

    if($rcounter > 100){
        echo "There are more than 100 results. Please refine search.";
    }
    else{
        echo "There are $dcounter results.";
    }
}

//BEGINS WITH TELUGU WORD RESULTS
function showResults2T($queriedResult, $inputMinLength,  $inputMaxLength){
    $conn = db_connect();
    $query = "SELECT * FROM telugu WHERE word LIKE '{$queriedResult}%' AND CHAR_LENGTH(word) >= $inputMinLength AND CHAR_LENGTH(word) <= $inputMaxLength";
    $result = $conn->query($query);
    $rcounter = 0;
    $dcounter = 0;

    echo "<table>"; // start a table tag in the HTML

    while($row = mysqli_fetch_array($result) and $dcounter <= 99){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['word'] . "</td><td>";//$row['index'] the index here is a field name
        $dcounter ++;

    }

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        $rcounter ++;

    }

    echo "</table> <br>"; //Close the table in HTML

    if($rcounter > 100){
        echo "There are more than 100 results. Please refine search.";
    }
    else{
        echo "There are $dcounter results.";
    }
}

//ENDS WITH ENGLISH WORD RESULTS
function showResults3E($queriedResult, $inputMinLength,  $inputMaxLength){
    $conn = db_connect();
    $query = "SELECT * FROM english WHERE word LIKE '%{$queriedResult}' AND CHAR_LENGTH(word) >= $inputMinLength AND CHAR_LENGTH(word) <= $inputMaxLength";
    $result = $conn->query($query);
    $rcounter = 0;
    $dcounter = 0;

    echo "<table>"; // start a table tag in the HTML

    while($row = mysqli_fetch_array($result) and $dcounter <= 99){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['word'] . "</td><td>";//$row['index'] the index here is a field name
        $dcounter ++;

    }

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        $rcounter ++;

    }

    echo "</table> <br>"; //Close the table in HTML

    if($rcounter > 100){
        echo "There are more than 100 results. Please refine search.";
    }
    else{
        echo "There are $dcounter results.";
    }
}

//ENDS WITH TELUGU WORD RESULTS
function showResults3T($queriedResult, $inputMinLength, $inputMaxLength){
    $conn = db_connect();
    $query = "SELECT * FROM telugu WHERE word LIKE '%{$queriedResult}' AND CHAR_LENGTH(word) >= $inputMinLength AND CHAR_LENGTH(word) <= $inputMaxLength";
    $result = $conn->query($query);
    $rcounter = 0;
    $dcounter = 0;

    echo "<table>"; // start a table tag in the HTML

    while($row = mysqli_fetch_array($result) and $dcounter <= 99){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['word'] . "</td><td>";//$row['index'] the index here is a field name
        $dcounter ++;

    }

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        $rcounter ++;

    }

    echo "</table> <br>"; //Close the table in HTML

    if($rcounter > 100){
        echo "There are more than 100 results. Please refine search.";
    }
    else{
        echo "There are $dcounter results.";
    }
}

//CONTAINS ENGLISH WORD
function showResults4E($queriedResult, $inputMinLength, $inputMaxLength){
    $conn = db_connect();
    $query = "SELECT * FROM english WHERE word LIKE '%{$queriedResult}%' AND CHAR_LENGTH(word) >= $inputMinLength AND CHAR_LENGTH(word) <= $inputMaxLength";
    $result = $conn->query($query);
    $rcounter = 0;
    $dcounter = 0;

    echo "<table>"; // start a table tag in the HTML

    while($row = mysqli_fetch_array($result) and $dcounter <= 99){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['word'] . "</td><td>";//$row['index'] the index here is a field name
        $dcounter ++;

    }

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        $rcounter ++;

    }

    echo "</table> <br>"; //Close the table in HTML

    if($rcounter > 100){
        echo "There are more than 100 results. Please refine search.";
    }
    else{
        echo "There are $dcounter results.";
    }
}

//CONTAINS TELUGU WORD
function showResults4T($queriedResult, $inputMinLength, $inputMaxLength){
    $conn = db_connect();
    $query = "SELECT * FROM telugu WHERE word LIKE '%{$queriedResult}%' AND CHAR_LENGTH(word) >= $inputMinLength AND CHAR_LENGTH(word) <= $inputMaxLength";
    $result = $conn->query($query);
    $rcounter = 0;
    $dcounter = 0;

    echo "<table>"; // start a table tag in the HTML

    while($row = mysqli_fetch_array($result) and $dcounter <= 99){   //Creates a loop to loop through results
        echo "<tr><td>" . $row['word'] . "</td><td>";//$row['index'] the index here is a field name
        $dcounter ++;

    }

    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
        $rcounter ++;

    }

    echo "</table> <br>"; //Close the table in HTML

    if($rcounter > 100){
        echo "There are more than 100 results. Please refine search.";
    }
    else{
        echo "There are $dcounter results.";
    }
}
