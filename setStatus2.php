<?php
	#				====== USAGE ======
	#		POST or GET "username", "currpass", "newpass" forms 
	#			to "IPv4 Address"/changePassword.php
	$username = $_GET["username"];
	$status = $_GET["status"];

	$buildr = new mysqli('buildr.cuxgs3tcx7pv.us-east-2.rds.amazonaws.com', 'youseethat', 'X2mJaMNR4oCRYXVFrKt6', 'buildr', '3306');
	if ($buildr->connect_errno) {
		printf("Connect failed: %s\n", $buildr->connect_error);
		exit();
	}

	if ($result = $buildr->query("SELECT * FROM user WHERE username = \"$username\"")) {
		if ($row = $result->fetch_array()) { # username exists, continue
			if ($buildr->query("UPDATE user SET status = \"$status\" WHERE username = \"$username\"")) {
				#echo 1; # successfully changed, process code = 1
				header('Location: dashboard.html#users');
			} else { # there was an error ???, abort
				#echo -1;
				header('Location: dashboard.html#users');
			}
			$result->close();
		} else { # username was not found, abort
			#echo 3;
			header('Location: dashboard.html#users');
			$result->close();
		}
	} else { # error during query ???, abort
		header('Location: dashboard.html#users');
		#echo -1;
	}
	$buildr->close();
?>