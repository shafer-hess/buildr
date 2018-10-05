<?php
	#				  ===== USAGE =====
	#		php simpleInsert.php <firstName> <lastName> <password>
	#			$argv[0]       $argv[1]   $argv[2]   $argv[3]
	$first = $argv[1];
	$last = $argv[2];
	$pass = $argv[3];
	$addr = $last . "@gmail.com";

	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		exit();
	}

	$buildr->query("INSERT INTO user (username, password, email, firstName, lastName) VALUES (\"$last$first\", \"$pass\", \"$addr\", \"$first\", \"$last\")");
	$buildr->close();
?>
