<?php
	#				  ===== USAGE =====
	#		php simpleHashVerify.php <username> <password>
	#			$argv[0]       $argv[1]   $argv[2]
	$username = $argv[1];
	$password = $argv[2];

	printf("Attempting to login to %s with input password %s\n", $username, $password);

	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		exit();
	}

	if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$username\"")) {
		if ($row = $result->fetch_array()) {
			printf("User exists... Verifying passwords...\n");
			$hashed_pass = $row['password'];
			printf("Returned hash: %s\n", $hashed_pass);
			if (password_verify($password, $hashed_pass)) {
				echo "Password is valid!\n";
			} else {
				echo "Invalid password!\n";
			}
			$result->close();
		} else {
			printf("User was not found!\n");
		}
	}
	$buildr->close();
?>
