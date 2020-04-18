<?php
// Bring in DB support.
require "db_fns.php";

function checkURLAgainstSuggested($suggestInput, $suggestURL)
{
    $conn = db_connect();
    $query = "select suggestedurl from $suggestURL where suggestedurl='" . $suggestInput . "'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    } else {
        return false;
    }
}

function checkURLAgainstCrawled($suggestInput, $crawlURL)
{
    $conn = db_connect();
    $query = "select crawledurl from $crawlURL where crawledurl='" . $suggestInput . "'";
    $result = $conn->query($query);
    if ((!$result) || ($result->num_rows != 0)) {
        return true;
    } else {
        return false;
    }
}

function insertURLToSuggestDB($suggestInput, $suggestURL)
{
    // inserts a new url into the database SuggestURL
    $insert_date = date("m/d/Y");
    $conn = db_connect();
    $query = "insert into $suggestURL values(null, '" . $suggestInput . "', '" . $insert_date . "')";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        return array_values(array($result));
    }
}
