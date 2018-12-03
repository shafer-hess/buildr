<?php

$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');

if(file_exists('/var/www/html/models.json')) { unlink('/var/www/html/models.json'); }

if ($buildr->connect_errno) {
    printf("Connection to database failed: %s\n", $buildr->connect_error);
    exit();
}

$query_request = "SELECT * FROM models";
$response = array();
$models = array();

if ($result = $buildr->query($query_request)) {
    while($row = $result->fetch_array()) {
	$id = $row['id'];
        $buildData = $row['buildData'];
        $buildName = $row['buildName'];
        $username = $row['username'];
        $location = $row['location'];
        $privacy = $row['privacy'];
        $avatar = $row['avatar'];
        $upvotes = $row['upvotes'];

        $models[] = array('Model ID' => $id,'Build Data' => $buildData, 'Build Name' => $buildName, 'Username' => $username,
         'Location' => $location, 'Privacy' => $privacy, 'Avatar' => $avatar, 'Upvotes' => $upvotes);
    }

    $response['models'] = $models;
    
    $file = fopen('/var/www/html/models.json', 'x+');
    fwrite($file, json_encode($response, JSON_PRETTY_PRINT));
    fclose($file);
}

$buildr->close();

header('Location: dashboard.html#model');

?>
