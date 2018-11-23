<?php

$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');

if(file_exists('/var/www/html/reports.json')) { unlink('/var/www/html/reports.json'); }

if ($buildr->connect_errno) {
    printf("Connection to database failed: %s\n", $buildr->connect_error);
    exit();
}

$query_request = "SELECT * FROM reports";
$response = array();
$reports = array();

if ($result = $buildr->query($query_request)) {
    while($row = $result->fetch_array()) {
        $id = $row['id'];
        $username = $row['username'];
        $report_text = $row['report_text'];

        $reports[] = array('ID' => $id, 'Username' => $username, 'Report Text' => $report_text);
    }

    $response['reports'] = $reports;
    
    $file = fopen('/var/www/html/reports.json', 'x+');
    fwrite($file, json_encode($response, JSON_PRETTY_PRINT));
    fclose($file);
}

$buildr->close();

header('Location: dashboard.html#reports');

?>