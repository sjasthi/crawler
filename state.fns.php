<?php

$alphabet = array();

// Bring in DB support.
require "db_fns.php";

$conn = db_connect();
$conn->set_charset("utf8");

$query = "SELECT count(word), char_len FROM english GROUP BY char_len ORDER BY count(*) DESC LIMIT 10;";
$query2 = "SELECT count(word), char_len FROM telugu GROUP BY char_len ORDER BY count(*) DESC LIMIT 10;";
$query3 = "SELECT word FROM english;";
$query4 = "select * from telugucount order by ch_count desc limit 10;";

$result = $conn->query($query);
$result2 = $conn->query($query2);
$result3 = $conn->query($query3);
$result4 = $conn->query($query4);

if (!$result && !$result2 && !$result3 && !$result4) {
    echo ("<p>Unable to query database at this time.</p>");
    exit;
}

$numRows = $result->num_rows;
$numRows2 = $result2->num_rows;
$numRows3 = $result3->num_rows;
$numRows4 = $result4->num_rows;


//English words count by characters
if ($numRows > 0) {
    $index = $numRows;
    $i;

    for ($i = 0; $i < $index; $i++) {
        $row = $result->fetch_array();

        if ($i == 0) {
            $eTopWord1 = $row[0];
            $eLeng1 = $row[1];
        } else if ($i == 1) {
            $eTopWord2 = $row[0];
            $eLeng2 = $row[1];
        } else if ($i == 2) {
            $eTopWord3 = $row[0];
            $eLeng3 = $row[1];
        } else if ($i == 3) {
            $eTopWord4 = $row[0];
            $eLeng4 = $row[1];
        } else if ($i == 4) {
            $eTopWord5 = $row[0];
            $eLeng5 = $row[1];
        } else if ($i == 5) {
            $eTopWord6 = $row[0];
            $eLeng6 = $row[1];
        } else if ($i == 6) {
            $eTopWord7 = $row[0];
            $eLeng7 = $row[1];
        } else if ($i == 7) {
            $eTopWord8 = $row[0];
            $eLeng8 = $row[1];
        } else if ($i == 8) {
            $eTopWord9 = $row[0];
            $eLeng9 = $row[1];
        } else if ($i == 9) {
            $eTopWord10 = $row[0];
            $eLeng10 = $row[1];
        }
    }
}

//Telugu words count by characters
if ($numRows2 > 0) {

    $tTopWord8 = "";
    $tLeng8 = 0;
    $index2 = $numRows2;
    $i;

    for ($i = 0; $i < $index2; $i++) {
        $row2 = $result2->fetch_array();

        if ($i == 0) {
            $tTopWord1 = $row2[0];
            $tLeng1 = $row2[1];
        } else if ($i == 1) {
            $tTopWord2 = $row2[0];
            $tLeng2 = $row2[1];
        } else if ($i == 2) {
            $tTopWord3 = $row2[0];
            $tLeng3 = $row2[1];
        } else if ($i == 3) {
            $tTopWord4 = $row2[0];
            $tLeng4 = $row2[1];
        } else if ($i == 4) {
            $tTopWord5 = $row2[0];
            $tLeng5 = $row2[1];
        } else if ($i == 5) {
            $tTopWord6 = $row2[0];
            $tLeng6 = $row2[1];
        } else if ($i == 6) {
            $tTopWord7 = $row2[0];
            $tLeng7 = $row2[1];
        } else if ($i == 7) {
            $tTopWord8 = $row2[0];
            $tLeng8 = $row2[1];
        } else if ($i == 8) {
            $tTopWord9 = $row2[0];
            $tLeng9 = $row2[1];
        } else if ($i == 9) {
            $tTopWord10 = $row2[0];
            $tLeng10 = $row2[1];
        }
    }
}

//count top 10 english characters showed up in database
if ($numRows3 > 0) {
    $index3 = $numRows3;
    $a = 0;
    $b = 0;
    $c = 0;
    $d = 0;
    $e = 0;
    $f = 0;
    $g = 0;
    $h = 0;
    $i = 0;
    $j = 0;
    $k = 0;
    $l = 0;
    $m = 0;
    $n = 0;
    $o = 0;
    $p = 0;
    $q = 0;
    $r = 0;
    $s = 0;
    $t = 0;
    $u = 0;
    $v = 0;
    $w = 0;
    $x = 0;
    $y = 0;
    $z = 0;

    for ($i = 0; $i < $index3; $i++) {
        $row3 = $result3->fetch_array();
        $a += substr_count(strtolower($row3[0]), 'a');
        $n += substr_count(strtolower($row3[0]), 'n');
        $b += substr_count(strtolower($row3[0]), 'b');
        $o += substr_count(strtolower($row3[0]), 'o');
        $c += substr_count(strtolower($row3[0]), 'c');
        $p += substr_count(strtolower($row3[0]), 'p');
        $d += substr_count(strtolower($row3[0]), 'd');
        $q += substr_count(strtolower($row3[0]), 'q');
        $e += substr_count(strtolower($row3[0]), 'e');
        $r += substr_count(strtolower($row3[0]), 'r');
        $f += substr_count(strtolower($row3[0]), 'f');
        $s += substr_count(strtolower($row3[0]), 's');
        $g += substr_count(strtolower($row3[0]), 'g');
        $t += substr_count(strtolower($row3[0]), 't');
        $h += substr_count(strtolower($row3[0]), 'h');
        $u += substr_count(strtolower($row3[0]), 'u');
        $i += substr_count(strtolower($row3[0]), 'i');
        $v += substr_count(strtolower($row3[0]), 'v');
        $j += substr_count(strtolower($row3[0]), 'j');
        $w += substr_count(strtolower($row3[0]), 'w');
        $k += substr_count(strtolower($row3[0]), 'k');
        $x += substr_count(strtolower($row3[0]), 'x');
        $l += substr_count(strtolower($row3[0]), 'l');
        $y += substr_count(strtolower($row3[0]), 'y');
        $m += substr_count(strtolower($row3[0]), 'm');
        $z += substr_count(strtolower($row3[0]), 'z');
    }

    $alphabet = array(
        "A" => $a, "B" => $b, "C" => $c, "D" => $d, "E" => $e, "F" => $f, "G" => $g, "H" => $h, "I" => $i, "J" => $j, "K" => $k, "L" => $l, "M" => $m,
        "N" => $n, "O" => $o, "P" => $p, "Q" => $q, "R" => $r, "S" => $s, "T" => $t, "U" => $u, "V" => $v, "W" => $w, "X" => $x, "Y" => $y, "Z" => $z,
    );
    $test = array("A" => $a, "B" => $b);
    arsort($alphabet);

    $counter = "";

    while ($counter++ < 10 && list($key, $val) = each($alphabet)) {

        if ($counter == 1) {
            $eTopAlpha1 = $val;
            $eAlphabet1 = $key;
        } else if ($counter == 2) {
            $eTopAlpha2 = $val;
            $eAlphabet2 = $key;
        } else if ($counter == 3) {
            $eTopAlpha3 = $val;
            $eAlphabet3 = $key;
        } else if ($counter == 4) {
            $eTopAlpha4 = $val;
            $eAlphabet4 = $key;
        } else if ($counter == 5) {
            $eTopAlpha5 = $val;
            $eAlphabet5 = $key;
        } else if ($counter == 6) {
            $eTopAlpha6 = $val;
            $eAlphabet6 = $key;
        } else if ($counter == 7) {
            $eTopAlpha7 = $val;
            $eAlphabet7 = $key;
        } else if ($counter == 8) {
            $eTopAlpha8 = $val;
            $eAlphabet8 = $key;
        } else if ($counter == 9) {
            $eTopAlpha9 = $val;
            $eAlphabet9 = $key;
        } else if ($counter == 10) {
            $eTopAlpha10 = $val;
            $eAlphabet10 = $key;
        }
    }
}


//count top 10 telugu characters showed up in database
if ($numRows4 > 0) {
    for ($i = 0; $i < $numRows4; $i++) {
        $row4 = $result4->fetch_array();

        if ($i == 0) {
            $tTopAlpha1 = $row4[0];
            $tTopCount1 = $row4[1];
        } else if ($i == 1) {
            $tTopAlpha2 = $row4[0];
            $tTopCount2 = $row4[1];
        } else if ($i == 2) {
            $tTopAlpha3 = $row4[0];
            $tTopCount3 = $row4[1];
        } else if ($i == 3) {
            $tTopAlpha4 = $row4[0];
            $tTopCount4 = $row4[1];
        } else if ($i == 4) {
            $tTopAlpha5 = $row4[0];
            $tTopCount5 = $row4[1];
        } else if ($i == 5) {
            $tTopAlpha6 = $row4[0];
            $tTopCount6 = $row4[1];
        } else if ($i == 6) {
            $tTopAlpha7 = $row4[0];
            $tTopCount7 = $row4[1];
        } else if ($i == 7) {
            $tTopAlpha8 = $row4[0];
            $tTopCount8 = $row4[1];
        } else if ($i == 8) {
            $tTopAlpha9 = $row4[0];
            $tTopCount9 = $row4[1];
        } else if ($i == 9) {
            $tTopAlpha10 = $row4[0];
            $tTopCount10 = $row4[1];
        }
    }
}

function getENGWordsInBank()
{
    // inserts a new crawled url into the database
    $conn = db_connect();
    $conn->set_charset("utf8");
    $query = "SELECT word FROM english;";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        $result = db_result_to_array($result);
        return $result;
    }
}

function getTELWordsInBank()
{

    $conn = db_connect();
    $conn->set_charset("utf8");
    $query = "SELECT word FROM telugu;";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        $result = db_result_to_array($result);
        return $result;
    }
}

function getURLArray()
{
    $conn = db_connect();
    $conn->set_charset("utf8");
    $query = "SELECT crawledurl FROM crawlurl;";
    $result = $conn->query($query);
    if (!$result) {
        return false;
    } else {
        $result = db_result_to_array($result);
        return $result;
    }
}

//get functions to display in the english top 10 charactor length piechart
function getEngLeng1()
{
    global $eLeng1;
    return $eLeng1;
}
function getEngLeng2()
{
    global $eLeng2;
    return $eLeng2;
}
function getEngLeng3()
{
    global $eLeng3;
    return $eLeng3;
}
function getEngLeng4()
{
    global $eLeng4;
    return $eLeng4;
}
function getEngLeng5()
{
    global $eLeng5;
    return $eLeng5;
}
function getEngLeng6()
{
    global $eLeng6;
    return $eLeng6;
}
function getEngLeng7()
{
    global $eLeng7;
    return $eLeng7;
}
function getEngLeng8()
{
    global $eLeng8;
    return $eLeng8;
}
function getEngLeng9()
{
    global $eLeng9;
    return $eLeng9;
}
function getEngLeng10()
{
    global $eLeng10;
    return $eLeng10;
}

function getEngTop1()
{
    global $eTopWord1;
    return $eTopWord1;
}
function getEngTop2()
{
    global $eTopWord2;
    return $eTopWord2;
}
function getEngTop3()
{
    global $eTopWord3;
    return $eTopWord3;
}
function getEngTop4()
{
    global $eTopWord4;
    return $eTopWord4;
}
function getEngTop5()
{
    global $eTopWord5;
    return $eTopWord5;
}
function getEngTop6()
{
    global $eTopWord6;
    return $eTopWord6;
}
function getEngTop7()
{
    global $eTopWord7;
    return $eTopWord7;
}
function getEngTop8()
{
    global $eTopWord8;
    return $eTopWord8;
}
function getEngTop9()
{
    global $eTopWord9;
    return $eTopWord9;
}
function getEngTop10()
{
    global $eTopWord10;
    return $eTopWord10;
}

//get function to display in the telugu top 10 charactor length piechart
function getTelLeng1()
{
    global $tLeng1;
    return $tLeng1;
}
function getTelLeng2()
{
    global $tLeng2;
    return $tLeng2;
}
function getTelLeng3()
{
    global $tLeng3;
    return $tLeng3;
}
function getTelLeng4()
{
    global $tLeng4;
    return $tLeng4;
}
function getTelLeng5()
{
    global $tLeng5;
    return $tLeng5;
}
function getTelLeng6()
{
    global $tLeng6;
    return $tLeng6;
}
function getTelLeng7()
{
    global $tLeng7;
    return $tLeng7;
}
function getTelLeng8()
{
    global $tLeng8;
    return $tLeng8;
}
function getTelLeng9()
{
    global $tLeng9;
    return $tLeng9;
}
function getTelLeng10()
{
    global $tLeng10;
    return $tLeng10;
}

function getTelTop1()
{
    global $tTopWord1;
    return $tTopWord1;
}
function getTelTop2()
{
    global $tTopWord2;
    return $tTopWord2;
}
function getTelTop3()
{
    global $tTopWord3;
    return $tTopWord3;
}
function getTelTop4()
{
    global $tTopWord4;
    return $tTopWord4;
}
function getTelTop5()
{
    global $tTopWord5;
    return $tTopWord5;
}
function getTelTop6()
{
    global $tTopWord6;
    return $tTopWord6;
}
function getTelTop7()
{
    global $tTopWord7;
    return $tTopWord7;
}
function getTelTop8()
{
    global $tTopWord8;
    return $tTopWord8;
}
function getTelTop9()
{
    global $tTopWord9;
    return $tTopWord9;
}
function getTelTop10()
{
    global $tTopWord10;
    return $tTopWord10;
}

function getEngTopAlphaCount1()
{
    global $eTopAlpha1;
    return $eTopAlpha1;
}
function getEngTopAlphaCount2()
{
    global $eTopAlpha2;
    return $eTopAlpha2;
}
function getEngTopAlphaCount3()
{
    global $eTopAlpha3;
    return $eTopAlpha3;
}
function getEngTopAlphaCount4()
{
    global $eTopAlpha4;
    return $eTopAlpha4;
}
function getEngTopAlphaCount5()
{
    global $eTopAlpha5;
    return $eTopAlpha5;
}
function getEngTopAlphaCount6()
{
    global $eTopAlpha6;
    return $eTopAlpha6;
}
function getEngTopAlphaCount7()
{
    global $eTopAlpha7;
    return $eTopAlpha7;
}
function getEngTopAlphaCount8()
{
    global $eTopAlpha8;
    return $eTopAlpha8;
}
function getEngTopAlphaCount9()
{
    global $eTopAlpha9;
    return $eTopAlpha9;
}
function getEngTopAlphaCount10()
{
    global $eTopAlpha10;
    return $eTopAlpha10;
}

function getEngTopAlpha1()
{
    global $eAlphabet1;
    return $eAlphabet1;
}
function getEngTopAlpha2()
{
    global $eAlphabet2;
    return $eAlphabet2;
}
function getEngTopAlpha3()
{
    global $eAlphabet3;
    return $eAlphabet3;
}
function getEngTopAlpha4()
{
    global $eAlphabet4;
    return $eAlphabet4;
}
function getEngTopAlpha5()
{
    global $eAlphabet5;
    return $eAlphabet5;
}
function getEngTopAlpha6()
{
    global $eAlphabet6;
    return $eAlphabet6;
}
function getEngTopAlpha7()
{
    global $eAlphabet7;
    return $eAlphabet7;
}
function getEngTopAlpha8()
{
    global $eAlphabet8;
    return $eAlphabet8;
}
function getEngTopAlpha9()
{
    global $eAlphabet9;
    return $eAlphabet9;
}
function getEngTopAlpha10()
{
    global $eAlphabet10;
    return $eAlphabet10;
}

function getTelTopAlpha1()
{
    global $tTopAlpha1;
    return $tTopAlpha1;
}
function getTelTopAlpha2()
{
    global $tTopAlpha2;
    return $tTopAlpha2;
}
function getTelTopAlpha3()
{
    global $tTopAlpha3;
    return $tTopAlpha3;
}
function getTelTopAlpha4()
{
    global $tTopAlpha4;
    return $tTopAlpha4;
}
function getTelTopAlpha5()
{
    global $tTopAlpha5;
    return $tTopAlpha5;
}
function getTelTopAlpha6()
{
    global $tTopAlpha6;
    return $tTopAlpha6;
}
function getTelTopAlpha7()
{
    global $tTopAlpha7;
    return $tTopAlpha7;
}
function getTelTopAlpha8()
{
    global $tTopAlpha8;
    return $tTopAlpha8;
}
function getTelTopAlpha9()
{
    global $tTopAlpha9;
    return $tTopAlpha9;
}
function getTelTopAlpha10()
{
    global $tTopAlpha10;
    return $tTopAlpha10;
}

function getTelTopCount1()
{
    global $tTopCount1;
    return $tTopCount1;
}
function getTelTopCount2()
{
    global $tTopCount2;
    return $tTopCount2;
}
function getTelTopCount3()
{
    global $tTopCount3;
    return $tTopCount3;
}
function getTelTopCount4()
{
    global $tTopCount4;
    return $tTopCount4;
}
function getTelTopCount5()
{
    global $tTopCount5;
    return $tTopCount5;
}
function getTelTopCount6()
{
    global $tTopCount6;
    return $tTopCount6;
}
function getTelTopCount7()
{
    global $tTopCount7;
    return $tTopCount7;
}
function getTelTopCount8()
{
    global $tTopCount8;
    return $tTopCount8;
}
function getTelTopCount9()
{
    global $tTopCount9;
    return $tTopCount9;
}
function getTelTopCount10()
{
    global $tTopCount10;
    return $tTopCount10;
}
