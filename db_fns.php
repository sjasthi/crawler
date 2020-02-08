<?php
/**
 * Created by PhpStorm.
 * User: June
 * Date: 10/11/2016
 * Time: 6:40 PM
 */


function db_connect() {
    DEFINE('DATABASE_HOST', 'localhost');
    DEFINE('DATABASE_DATABASE', 'crawler');
    DEFINE('DATABASE_USER', 'root');
    DEFINE('DATABASE_PASSWORD', '');

   $result = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    if (!$result) {
        return false;
    }
    $result->autocommit(TRUE);
    return $result;
}
    
function db_result_to_array($result) {
   $res_array = array();

    for ($count=0; $row = $result->fetch_assoc(); $count++) {
        $res_array[$count] = $row;
   }

    return $res_array;
}

?>
