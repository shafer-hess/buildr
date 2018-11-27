<?php

$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');

if(file_exists('/var/www/html/users.json')) { unlink('/var/www/html/users.json'); }

if ($buildr->connect_errno) {
    printf("Connection to database failed: %s\n", $buildr->connect_error);
    exit();
}

$query_request = "SELECT * FROM user";
$response = array();
$users = array();

if ($result = $buildr->query($query_request)) {
    while($row = $result->fetch_array()) {
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['email'];
        $username = $row['username'];
        $rank = $row['rank'];
        $status = $row['status'];

        $users[] = array('First Name' => $firstName, 'Last Name' => $lastName, 'Email' => $email, 
        'Username' => $username, 'Rank' => $rank, 'Status' => $status);
    }

    $response['users'] = $users;
    
    $file = fopen('/var/www/html/users.json', 'x+');
    fwrite($file, json_encode($response, JSON_PRETTY_PRINT));
    fclose($file);
}

$buildr->close();

header('Location: dashboard.html#users');

?>