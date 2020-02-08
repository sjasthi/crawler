<?php
//ini_set("display_errors","On");
//error_reporting(E_ALL);
require ('db_fns.php');
DEFINE('DATABASE_HOST', 'localhost');
DEFINE('DATABASE_DATABASE', 'crawler');
DEFINE('DATABASE_USER', 'root');
DEFINE('DATABASE_PASSWORD', '');

function checkURLAgainstSuggested($suggestInput, $suggestURL){
        $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
        $query = "select suggestedurl from $suggestURL where suggestedurl='".$suggestInput."'";
        $result = $conn->query($query);
        if ((!$result) || ($result->num_rows != 0)) {
            return true;
        }
        else {
            return false;
        }
}

function checkURLAgainstCrawled($suggestInput, $crawlURL){
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $query = "select crawledurl from $crawlURL where crawledurl='".$suggestInput."'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    }
    else {
        return false;
    }
}

function insertURLToSuggestDB($suggestInput, $suggestURL){
// inserts a new url into the database SuggestURL
    $insert_date = date("m/d/Y");
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    $query = "insert into $suggestURL values(null, '".$suggestInput."', '".$insert_date."')";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        return array_values(array($result));
    }
}

