<?php
require ('db_fns.php');

function exportEngToCSV(){
    $conn = db_connect();
    $filename = "EnglishWords-CSV". date('Ymd').".csv";

    header('Content-type: text/csv charset=utf-8');
    header('Content-Disposition: attachment; filename='.$filename);

    $out = fopen('php://output', 'w');
    //$out = fopen("C:\\Users\\June\\Desktop\\export dump\\".$filename, 'w');

    $query = "SELECT word FROM english order by word";
    $result = $conn->query($query);
    ob_end_clean();

    while($row = mysqli_fetch_assoc($result)) {
        fputcsv($out, $row);
    }
    fclose($out);
    exit;
}

function exportTelToCSV(){
    $conn = db_connect();
    $filename = "TeluguWords-CSV". date('Ymd').".csv";

    header('Content-type: application/csv charset=utf-8');
    header('Content-Type: text/html; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$filename);

    $out = fopen('php://output', 'w');

    $query = "SELECT word FROM telugu order by word COLLATE utf8_bin ";
    $result = $conn->query($query);

    ob_end_clean();

    while($row = mysqli_fetch_assoc($result)) {
        fputcsv($out, $row);
    }

    fclose($out);
    exit;
}

?>
