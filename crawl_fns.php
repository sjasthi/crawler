<?php
//ini_set('max_execution_time', 300);
//ini_set("display_errors","On");
//error_reporting(E_ALL);
require ('db_fns.php');
DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_DATABASE', 'crawler');
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');

function checkURLExists($crawlInput, $crawlURL){
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $query = "SELECT * FROM $crawlURL WHERE crawledurl='".$crawlInput."'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function checkWordEngExists($queriedResult){
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $query = "SELECT * FROM english WHERE word='".$queriedResult."'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function checkWordTelExists($queriedResult){
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $query = "SELECT * FROM telugu WHERE word='".$queriedResult."'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function insertURLToDB($crawlInput, $sunset, $crawlURL){
// inserts a new crawled url into the database
    
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $insert_date = date("m/d/Y");
    // check crawled url does not already exist
    // checkExists($crawlInput);
    // insert new crawled url
    $query = "INSERT INTO $crawlURL VALUES(null, '".$crawlInput."', '".$insert_date."')";


    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        //$result = array($result);
        // return db2_fetch_array($result);
        return array_values(array($result));
    }
}

include('indic-wp-master/word_processor.php');

function insertEngTXTToDB($textFound){
// inserts a new crawled url into the database
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    // check crawled url does not already exist
    // checkExists($crawlInput);
    // insert new crawled url

    $myclass = new wordProcessor($textFound, 'English');    
    $strength = $myclass->getWordStrength('English');
    $weight = $myclass->getWordWeight('English');

    $query = "INSERT INTO english (word, char_len, strength, weight) VALUES('".$textFound."', '".strlen($textFound)."', $strength, $weight)";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        //$result = array($result);
        // return db2_fetch_array($result);
        set_time_limit(0);
        return array_values(array($result));
    }
}

function insertTelTXTToDB($input){
// inserts a new crawled url into the database
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    // check crawled url does not already exist
    // checkExists($crawlInput);
    // insert new crawled url

    $myclass = new wordProcessor($input, 'Telugu');    
    $strength = $myclass->getWordStrength('Telugu');
    $weight = $myclass->getWordWeight('Telugu');

    $query = "INSERT INTO telugu (word, char_len, strength, weight) VALUES('".$input."', '".strlen($input)."', $strength, $weight)";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        //$result = array($result);
        // return db2_fetch_array($result);
        set_time_limit(0);
        return array_values(array($result));
    }
}

function sanitizeInput($data) {
    $data = trim($data); //delete spaces before and after
    $data = stripslashes($data); //get rid of slashes
    $data = htmlspecialchars($data); //get rid of html special characters
    $data = html_entity_decode($data); //get rid of html spaces and quotes etc
    $data = preg_replace('/[^A-Za-z]/', ' ', $data); //leave alpha and space only
    $data = preg_replace('/ +/', ' ', $data);

    return $data;
}

function sanitizeTelInput($data) {
    $data = trim($data); //delete spaces before and after
    $data = stripslashes($data); //get rid of slashes
    $data = html_entity_decode($data); //get rid of html spaces and quotes etc
    $data = preg_replace('/[A-Za-z0-9]/', ' ', $data); //leave alpha and space only
    $data = preg_replace('/ +/', ' ', $data);


    return $data;
}

function inTelRange($word){
    if(preg_match('/[\x{0C00}-\x{0C7F}]/u', $word) > 0) {
        return true;
    }
    else {
        return false;
    }
}