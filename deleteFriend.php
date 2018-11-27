<?php
	$userOne = $_GET["userOne"];
	$userTwo = $_GET["userTwo"];
	
	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		echo -1;
		$buildr->close();
		exit();
	}
	
	if ($buildr->query("DELETE FROM friends WHERE user_one = \"$userOne\" AND user_two = \"$userTwo\"")) {
		echo 1;
	} else {
		printf("Error: %s\n", $buildr->error);
	}
	$buildr->close();
?>
