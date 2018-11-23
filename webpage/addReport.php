<?php

$username = $_GET['username'];
$report_text = $_GET['report_text'];

$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
if ($buildr->connect_errno) {
    printf("Connection to database failed: %s\n", $buildr->connect_error);
    exit();
}

$query = "INSERT INTO reports (username, report_text) VALUES (\"$username\", \"$report_text\")";
$buildr->query($query);
$buildr->close();

header('Location: login.html');

?>