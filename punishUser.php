<?php
	$username = $_GET["username"];
	$status = $_GET["status"];
	
	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		echo -1;
		$buildr->close();
		exit();
	}
	if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$username\"")) {
		if ($result->num_rows < 1) {
			echo 0;
			$result->close();
			$buildr->close();
			exit();
		}
	}
	if ($buildr->query("UPDATE user SET status = \"$status\" WHERE username = \"$username\"")) {
		echo 1;
	} else {
		printf("Error: %s\n", $buildr->error);
	}
	$buildr->close();
?>
