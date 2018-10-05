<?php
$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');

if ($buildr->connect_errno) {
	printf("Connect failed: %s\n", $buildr->connect_error);
	exit();
}

#if ($mysqli->query("CREATE TABLE haha (motto VARCHAR(32))") === TRUE) {
#	printf("Table haha successfully created.\n");
#} else {
#	printf("Error creating table haha\n");
#}

#$buildr->query("INSERT INTO user (username, password, email, firstName, lastName) VALUES (\"teaera\", \"popcornchicken\", \"teaera@gmail.com\", \"Tea\", \"Era\")");

#if ($result = $buildr->query("SELECT * FROM user LIMIT 10")) {
#	printf("Select returned %d rows.\n", $result->num_rows);
#	while ($row = $result->fetch_array()) {
#		printf("%s  %s  %s  %s  %s\n", $row['username'], $row['password'], $row['email'], $row['firstName'], $row['lastName']);
#	}
#	$result->close();
#}

if ($result = $buildr->query("SELECT * FROM user")) {
	printf("Select returned %d rows.\n", $result->num_rows);
	while ($row = $result->fetch_array()) {
		printf("%s %s %s %s %s\n", $row['username'], $row['password'], $row['email'], $row['firstName'], $row['lastName']);
	}
	$result->close();
}

#if ($result = $mysqli->query("SELECT * FROM haha", MYSQLI_USER_RESULT)) {
#	if (!$mysqli->query("SET @2:='this will not work'")) {
#		printf("Error: %s\n", $mysqli->error);
#	}
#	$result->close();
#}

$buildr->close();
?>
