<?php
	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		echo -1;
		$buildr->close();
		exit();
	}
	//$buildr->query("CREATE TABLE changelog (date VARCHAR(100), added VARCHAR(2000), deprecated VARCHAR(2000))");
	//$buildr->query("CREATE TABLE friends (user_one VARCHAR(100), user_two VARCHAR(100))");
	$buildr->query("CREATE TABLE messages (user_one VARCHAR(100), user_two VARCHAR(100), text VARCHAR(2000))");
	$buildr->close();
	echo 1;
?>
