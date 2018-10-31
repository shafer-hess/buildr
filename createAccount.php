<?php
	#				  ===== USAGE =====
	#	 POST or GET "username", "password", "email", "firstName", "lastName" forms
	#			to "IPv4 address"/createAccount.php
	# use $_GET for URL data
	$first = $_GET["firstName"];
	$last = $_GET["lastName"];
	$username = $_GET["username"];
	$pass = $_GET["password"];
	$addr = $_GET["email"];
	
	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		exit();
	}
	if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$username\"")) {
		if ($result->num_rows > 0) {
			echo 2;
			$result->close();
			$buildr->close();
			exit();
		}
		$result->close();
	}
	if ($result = $buildr->query("SELECT * FROM user WHERE email = \"$addr\"")) {
		if ($result->num_rows > 0) {
			echo 3;
			$result->close();
			$buildr->close();
			exit();
		}
		$result->close();
	}

	$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
	$buildr->query("INSERT INTO user (username, password, email, firstName, lastName) VALUES (\"$username\", \"$hashed_pass\", \"$addr\", \"$first\", \"$last\")");
	$buildr->close();
	echo 1;
?>
